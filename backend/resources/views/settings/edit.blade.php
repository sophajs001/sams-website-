@extends('layouts.app')

@section('content')
    <div class="settings-form">
        <h1>Edit Settings</h1>
        <form method="POST" action="{{ route('settings.update', $setting) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Site Name</label>
                <input name="site_name" value="{{ old('site_name', $setting->site_name) }}" required>
            </div>
            <div>
                <label>Footer Text</label>
                <textarea name="footer_text" rows="3">{{ old('footer_text', $setting->footer_text) }}</textarea>
            </div>
            <div>
                <label>Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email', $setting->contact_email) }}">
            </div>
            <div>
                <label>Contact Phone</label>
                <input name="contact_phone" value="{{ old('contact_phone', $setting->contact_phone) }}">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
