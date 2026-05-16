<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReflectionController extends Controller
{
    public function index()
    {
        return view('reflections.index');
    }

    public function create()
    {
        return view('reflections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:500',
            'content' => 'required|string',
        ]);

        return redirect()->route('reflections.index')->with('success', 'Reflection entry saved successfully (placeholder).');
    }
}
