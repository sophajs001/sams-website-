<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f

class PageController extends Controller
{
    public function index()
    {
<<<<<<< HEAD
        $pages = Page::orderBy('section')
            ->orderBy('sort_order')
            ->orderBy('title')
            ->paginate(50);

        $grouped = $pages->getCollection()->groupBy(fn ($p) => $p->section ?: 'other');

        return view('pages.index', compact('pages', 'grouped'));
=======
        $pages = Page::all();
        return view('pages.index', compact('pages'));
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
<<<<<<< HEAD
        $data = $this->validateData($request);
        $data['featured_image'] = $this->handleUpload($request, null);

        if (!empty($data['is_homepage'])) {
            Page::where('is_homepage', true)->update(['is_homepage' => false]);
        }

        $page = Page::create($data);

        return redirect()->route('pages.edit', $page)
            ->with('success', 'Page created successfully.');
=======
        $request->validate([
            'slug' => 'required|unique:pages,slug',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create($request->only(['slug', 'title', 'content']));

        return redirect()->route('pages.index');
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
<<<<<<< HEAD
        $data = $this->validateData($request, $page);
        $data['featured_image'] = $this->handleUpload($request, $page->featured_image);

        if ($page->is_system) {
            unset($data['slug'], $data['section'], $data['is_system']);
        }

        if (!empty($data['is_homepage'])) {
            Page::where('is_homepage', true)
                ->where('id', '!=', $page->id)
                ->update(['is_homepage' => false]);
        }

        $page->update($data);

        return redirect()->route('pages.edit', $page)
            ->with('success', 'Page updated successfully.');
=======
        $request->validate([
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update($request->only(['slug', 'title', 'content']));

        return redirect()->route('pages.index');
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
    }

    public function destroy(Page $page)
    {
<<<<<<< HEAD
        if ($page->is_system) {
            return redirect()->route('pages.index')
                ->with('error', 'System pages cannot be deleted.');
        }

        $page->delete();

        return redirect()->route('pages.index')
            ->with('success', 'Page deleted successfully.');
=======
        $page->delete();
        return redirect()->route('pages.index');
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
    }

    public function showLanding()
    {
<<<<<<< HEAD
        $homepage = Page::where('is_homepage', true)
            ->where('status', 'published')
            ->first();

        if ($homepage) {
            return view('site.show', ['page' => $homepage]);
        }

        return view('pages.landing');
    }

    public function showBySlug(string $slug)
    {
        $page = Page::where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('site.show', compact('page'));
    }

    protected function validateData(Request $request, ?Page $page = null): array
    {
        $slugRule = 'required|string|max:255|unique:pages,slug';
        if ($page) {
            $slugRule .= ',' . $page->id;
        }

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => $slugRule,
            'section' => 'nullable|string|max:50',
            'excerpt' => 'nullable|string|max:1000',
            'content' => 'required|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'status' => 'required|in:draft,published,archived',
            'is_homepage' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'featured_image' => 'nullable|image|max:4096',
        ]);

        $data['slug'] = Str::slug($data['slug']);
        $data['is_homepage'] = $request->boolean('is_homepage');
        $data['sort_order'] = $data['sort_order'] ?? 0;

        return $data;
    }

    protected function handleUpload(Request $request, ?string $existing): ?string
    {
        if ($request->hasFile('featured_image')) {
            return $request->file('featured_image')->store('pages', 'public');
        }

        return $existing;
    }
=======
        return view('pages.landing');
    }
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
}
