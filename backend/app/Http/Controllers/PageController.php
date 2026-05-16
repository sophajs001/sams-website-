<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::all();
        return view('pages.index', compact('pages'));
    }

    public function create()
    {
        return view('pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Page::create($request->only(['slug', 'title', 'content']));

        return redirect()->route('pages.index');
    }

    public function edit(Page $page)
    {
        return view('pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([
            'slug' => 'required|unique:pages,slug,' . $page->id,
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $page->update($request->only(['slug', 'title', 'content']));

        return redirect()->route('pages.index');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('pages.index');
    }

    public function showLanding()
    {
        return view('pages.landing');
    }
}
