<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index()
    {
        $alumni = Alumni::all();
        return view('alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ordination_date' => 'required|date',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Alumni::create($request->only(['name', 'ordination_date', 'role', 'bio']));
        return redirect()->route('alumni.index');
    }

    public function edit(Alumni $alumnus)
    {
        return view('alumni.edit', ['alumnus' => $alumnus]);
    }

    public function update(Request $request, Alumni $alumnus)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'ordination_date' => 'required|date',
            'role' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $alumnus->update($request->only(['name', 'ordination_date', 'role', 'bio']));
        return redirect()->route('alumni.index');
    }

    public function destroy(Alumni $alumnus)
    {
        $alumnus->delete();
        return redirect()->route('alumni.index');
    }
}
