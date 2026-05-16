<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::with('post')->get();
        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file_path' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'post_id' => 'required|exists:posts,id',
        ]);

        Media::create($request->only(['file_path', 'type', 'post_id']));
        return redirect()->route('media.index');
    }

    public function edit(Media $medium)
    {
        return view('media.edit', ['media' => $medium]);
    }

    public function update(Request $request, Media $medium)
    {
        $request->validate([
            'file_path' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'post_id' => 'required|exists:posts,id',
        ]);

        $medium->update($request->only(['file_path', 'type', 'post_id']));
        return redirect()->route('media.index');
    }

    public function destroy(Media $medium)
    {
        $medium->delete();
        return redirect()->route('media.index');
    }
}
