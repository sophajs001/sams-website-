<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

/**
 * Pull the main content section out of each frontend HTML file and
 * store it as the corresponding Page's content so admins can edit it.
 *
 * Strategy:
 *  - Find <body>...</body>
 *  - Slice out everything from end of the LAST top-level <nav>...</nav>
 *    (main navbar) up to the start of <footer ...>.
 *  - Rewrite asset/link URLs to point at our /site/* and /page/* routes.
 */
class PageContentSeeder extends Seeder
{
    /** slug => frontend filename */
    protected array $map = [
        'home'                  => 'index.html',
        'history'               => 'history.html',
        'administration'        => 'administration.html',
        'vocation-formation'    => 'vocation-formation.html',
        'admission'             => 'admission.html',
        'philosophy-department' => 'philosophy-department.html',
        'theology'              => 'theology.html',
        'library'               => 'library.html',
        'farm'                  => 'farm.html',
        'publications'          => 'publications.html',
        'contact'               => 'contact.html',
        'blog'                  => 'blog.html',
        'blog-detail'           => 'blog-detail.html',
        'gallery'               => 'gallery.html',
        'alumni'                => 'alumni.html',
        'reflection'            => 'reflection.html',
    ];

    /** slug -> href rewrites (slug => path-to-route map for nav links inside content) */
    protected array $linkMap = [
        'index.html'                  => '/',
        'history.html'                => '/page/history',
        'administration.html'         => '/page/administration',
        'vocation-formation.html'     => '/page/vocation-formation',
        'admission.html'              => '/page/admission',
        'philosophy-department.html'  => '/page/philosophy-department',
        'theology.html'               => '/page/theology',
        'library.html'                => '/page/library',
        'farm.html'                   => '/page/farm',
        'publications.html'           => '/page/publications',
        'contact.html'                => '/page/contact',
        'blog.html'                   => '/page/blog',
        'blog-detail.html'            => '/page/blog-detail',
        'gallery.html'                => '/page/gallery',
        'external-links.html'         => '/page/external-links',
        'alumni.html'                 => '/page/alumni',
        'reflection.html'             => '/page/reflection',
        'reflections-archive.html'    => '/page/reflection',
    ];

    public function run(): void
    {
        $base = realpath(base_path('../frontend'));
        if (!$base) {
            $this->command?->warn('frontend/ folder not found, skipping content extraction.');
            return;
        }

        foreach ($this->map as $slug => $file) {
            $path = $base . DIRECTORY_SEPARATOR . $file;
            if (!is_file($path)) {
                $this->command?->warn("Missing: {$file}");
                continue;
            }

            $html = file_get_contents($path);
            $content = $this->extractMain($html);
            if ($content === null) {
                $this->command?->warn("Could not extract main content from {$file}");
                continue;
            }

            $content = $this->rewriteUrls($content);

            $page = Page::where('slug', $slug)->first();
            if (!$page) {
                $this->command?->warn("Page row not found for slug: {$slug}");
                continue;
            }
            $page->content = $content;
            $page->save();
            $this->command?->info("Updated content for {$slug} (" . strlen($content) . " bytes)");
        }
    }

    protected function extractMain(string $html): ?string
    {
        // Get body
        if (!preg_match('/<body[^>]*>(.*)<\/body>/is', $html, $m)) return null;
        $body = $m[1];

        // Slice from after the LAST top-level main <nav ...>...</nav> (navbar)
        // The first nav in the frontend pages is the navbar; we cut after its </nav>.
        if (preg_match('/<nav[^>]*class="[^"]*navbar[^"]*"[^>]*>/i', $body, $nm, PREG_OFFSET_CAPTURE)) {
            $afterNavStart = $nm[0][1];
            $closing = strpos($body, '</nav>', $afterNavStart);
            if ($closing !== false) {
                $body = substr($body, $closing + strlen('</nav>'));
            }
        }

        // Drop loading overlay if present (layout already provides one)
        $body = preg_replace('/<div\s+id="loading-overlay".*?<\/div>\s*<\/div>\s*<\/div>/is', '', $body);
        // Drop standalone preloader div (home page has its own)
        $body = preg_replace('/<div\s+id="preloader".*?<\/div>\s*<\/div>/is', '', $body);
        // Drop top header bar (header-top) if it leaked into content
        $body = preg_replace('/<div\s+class="header-top".*?<\/div>\s*<\/div>\s*<\/div>/is', '', $body);

        // Cut at <footer ...>
        if (($fp = stripos($body, '<footer')) !== false) {
            $body = substr($body, 0, $fp);
        }

        // Trim inline scripts (layout supplies AOS + Bootstrap)
        $body = preg_replace('/<script\b[^>]*>.*?<\/script>/is', '', $body);
        // Trim inline <style> blocks if any (rare but possible)
        // (leave them in case page-specific styles exist; comment out if needed)

        return trim($body);
    }

    protected function rewriteUrls(string $html): string
    {
        // Rewrite href="something.html" -> mapped route (case-insensitive)
        $html = preg_replace_callback('/href="([^"#?]+\.html)([#?][^"]*)?"/i', function ($m) {
            $file = $m[1];
            $tail = $m[2] ?? '';
            $key  = strtolower($file);
            $map  = array_change_key_case($this->linkMap, CASE_LOWER);
            return 'href="' . ($map[$key] ?? ('/page/' . strtolower(pathinfo($file, PATHINFO_FILENAME)))) . $tail . '"';
        }, $html);

        // Rewrite src="images/x" / href="images/x" -> /site/images/x
        $html = preg_replace('/(src|href)="(images\/[^"]+)"/i', '$1="/site/$2"', $html);
        // Rewrite srcset entries: "images/foo 1x, images/bar 2x" -> "/site/images/foo 1x, /site/images/bar 2x"
        $html = preg_replace_callback('/srcset="([^"]+)"/i', function ($m) {
            $parts = array_map('trim', explode(',', $m[1]));
            $parts = array_map(function ($p) {
                if (preg_match('/^(images\/[^\s]+)(\s+.*)?$/i', $p, $mm)) {
                    return '/site/' . $mm[1] . ($mm[2] ?? '');
                }
                return $p;
            }, $parts);
            return 'srcset="' . implode(', ', $parts) . '"';
        }, $html);
        // Rewrite background-image: url('images/x') / url("images/x") inside inline styles
        $html = preg_replace('/url\((\'|")(images\/[^\'")]+)(\'|")\)/i', 'url($1/site/$2$3)', $html);
        // Rewrite style.css references
        $html = preg_replace('/(src|href)="style\.css"/i', '$1="/site/style.css"', $html);

        return $html;
    }
}
