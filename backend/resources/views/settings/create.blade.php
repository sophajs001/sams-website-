@extends('layouts.app')

@section('content')
    <div class="settings-form">
        <h1>Create Settings</h1>
        <form method="POST" action="{{ route('settings.store') }}">
            @csrf
            <div>
                <label>Site Name</label>
                <input name="site_name" value="{{ old('site_name') }}" required>
            </div>
            <div>
                <label>Footer Text</label>
                <textarea name="footer_text" rows="3">{{ old('footer_text') }}</textarea>
            </div>
            <div>
                <label>Contact Email</label>
                <input type="email" name="contact_email" value="{{ old('contact_email') }}">
            </div>
            <div>
                <label>Contact Phone</label>
                <input name="contact_phone" value="{{ old('contact_phone') }}">
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
