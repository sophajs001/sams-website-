<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PagesSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            // MAIN
            ['slug' => 'home', 'title' => 'Home', 'section' => 'main', 'is_homepage' => true, 'sort_order' => 1,
                'excerpt' => 'Welcome to St Augustine\'s Major Seminary, Jos.',
                'content' => '<h2>Welcome to St Augustine\'s Major Seminary</h2><p>Rooted in prayer, discipline, and academic excellence. Discover our rich history and tradition of priestly formation.</p>'],

            // ABOUT US
            ['slug' => 'history', 'title' => 'History', 'section' => 'about', 'sort_order' => 1,
                'excerpt' => 'The history of St Augustine\'s Major Seminary Jos.',
                'content' => '<h2>Our History</h2><p>St Augustine\'s Major Seminary has a long tradition of priestly formation. Use this page to share the founding story, milestones, and legacy.</p>'],
            ['slug' => 'administration', 'title' => 'Administration', 'section' => 'about', 'sort_order' => 2,
                'excerpt' => 'Meet the leadership and administration of the seminary.',
                'content' => '<h2>Administration</h2><p>Introduce the Rector, Vice-Rector, Deans, Formators, and administrative staff here.</p>'],
            ['slug' => 'vocation-formation', 'title' => 'Vocation & Formation', 'section' => 'about', 'sort_order' => 3,
                'excerpt' => 'The four pillars of priestly formation at SAMS.',
                'content' => '<h2>Vocation &amp; Formation</h2><p>Describe the human, spiritual, intellectual, and pastoral pillars of formation.</p>'],

            // ACADEMICS
            ['slug' => 'admission', 'title' => 'Admission', 'section' => 'academics', 'sort_order' => 1,
                'excerpt' => 'How to apply to St Augustine\'s Major Seminary.',
                'content' => '<h2>Admission</h2><p>List entry requirements, the application process, deadlines, and required documents.</p>'],
            ['slug' => 'philosophy-department', 'title' => 'Philosophy Department', 'section' => 'academics', 'sort_order' => 2,
                'excerpt' => 'Foundational philosophical studies for future priests.',
                'content' => '<h2>Philosophy Department</h2><p>Outline the philosophy curriculum, faculty, and learning outcomes.</p>'],
            ['slug' => 'theology', 'title' => 'Theology Department', 'section' => 'academics', 'sort_order' => 3,
                'excerpt' => 'Sacred theology, scripture, and pastoral studies.',
                'content' => '<h2>Theology Department</h2><p>Outline the theology curriculum, faculty, and degree pathways.</p>'],

            // RESOURCES
            ['slug' => 'library', 'title' => 'Library', 'section' => 'resources', 'sort_order' => 1,
                'excerpt' => 'The seminary library and study resources.',
                'content' => '<h2>Library</h2><p>Describe collections, opening hours, and digital catalogues.</p>'],
            ['slug' => 'farm', 'title' => 'Farm', 'section' => 'resources', 'sort_order' => 2,
                'excerpt' => 'The seminary farm and agricultural projects.',
                'content' => '<h2>Farm</h2><p>Showcase agricultural projects, livestock, and community impact.</p>'],
            ['slug' => 'publications', 'title' => 'Publications', 'section' => 'resources', 'sort_order' => 3,
                'excerpt' => 'Books, journals, and articles published by the seminary.',
                'content' => '<h2>Publications</h2><p>List journals, books, and other publications.</p>'],

            // INFO
            ['slug' => 'contact', 'title' => 'Contact & Support', 'section' => 'info', 'sort_order' => 1,
                'excerpt' => 'Get in touch with St Augustine\'s Major Seminary.',
                'content' => '<h2>Contact &amp; Support</h2><p>Provide addresses, phone numbers, email, and a contact form.</p>'],
            ['slug' => 'blog', 'title' => 'News & Events', 'section' => 'info', 'sort_order' => 2,
                'excerpt' => 'Latest news and upcoming events at the seminary.',
                'content' => '<h2>News &amp; Events</h2><p>This landing page introduces the news and events feed. Individual posts are managed under Blog Posts.</p>'],
            ['slug' => 'blog-detail', 'title' => 'Event Details', 'section' => 'info', 'sort_order' => 3,
                'excerpt' => 'Detailed information on a specific event.',
                'content' => '<h2>Event Details</h2><p>Template for individual event detail pages.</p>'],
            ['slug' => 'gallery', 'title' => 'Gallery', 'section' => 'info', 'sort_order' => 4,
                'excerpt' => 'Photo gallery of life at the seminary.',
                'content' => '<h2>Gallery</h2><p>Curate images from the seminary, liturgies, and events.</p>'],
            ['slug' => 'external-links', 'title' => 'External Links', 'section' => 'info', 'sort_order' => 5,
                'excerpt' => 'Useful external resources for the seminary community.',
                'content' => '<h2>External Links</h2><p>List partner institutions, dioceses, and helpful resources.</p>'],

            // COMMUNITY
            ['slug' => 'alumni', 'title' => 'Alumni', 'section' => 'community', 'sort_order' => 1,
                'excerpt' => 'Our alumni and their global ministry.',
                'content' => '<h2>Alumni</h2><p>This landing page introduces alumni stories. Individual alumni profiles are managed under Alumni.</p>'],
            ['slug' => 'reflection', 'title' => 'Reflection', 'section' => 'community', 'sort_order' => 2,
                'excerpt' => 'Daily reflections from the seminary community.',
                'content' => '<h2>Reflection</h2><p>Landing page for daily reflections.</p>'],
        ];

        foreach ($pages as $data) {
            Page::updateOrCreate(
                ['slug' => $data['slug']],
                array_merge($data, [
                    'status' => 'published',
                    'is_system' => true,
                    'meta_title' => $data['title'] . ' | St Augustine\'s Major Seminary Jos',
                    'meta_description' => $data['excerpt'] ?? null,
                ])
            );
        }
    }
}
