@extends('layouts.app')

@section('content')
    <div class="settings">
        <h1>Site Settings</h1>
        <a href="{{ route('settings.create') }}">Create Settings</a>

        @if($settings)
            <div>
                <p><strong>Site Name:</strong> {{ $settings->site_name }}</p>
                <p><strong>Footer Text:</strong> {{ $settings->footer_text }}</p>
                <p><strong>Contact Email:</strong> {{ $settings->contact_email }}</p>
                <p><strong>Contact Phone:</strong> {{ $settings->contact_phone }}</p>
                <a href="{{ route('settings.edit', $settings) }}">Edit Settings</a>
            </div>
        @else
            <p>No settings found yet.</p>
        @endif
    </div>
@endsection
