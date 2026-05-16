<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('settings.index', compact('settings'));
    }

    public function create()
    {
        return view('settings.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'footer_text' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
        ]);

        Setting::create(array_merge($request->only(['site_name', 'footer_text', 'contact_email', 'contact_phone']), [
            'social_links' => $request->input('social_links', []),
        ]));

        return redirect()->route('settings.index');
    }

    public function edit(Setting $setting)
    {
        return view('settings.edit', compact('setting'));
    }

    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'footer_text' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string|max:50',
            'social_links' => 'nullable|array',
        ]);

        $setting->update(array_merge($request->only(['site_name', 'footer_text', 'contact_email', 'contact_phone']), [
            'social_links' => $request->input('social_links', []),
        ]));

        return redirect()->route('settings.index');
    }

    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('settings.index');
    }
}
