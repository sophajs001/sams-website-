@extends('layouts.app')

@section('page_title', 'Reflections')

@section('breadcrumb')
    <li class="breadcrumb-item active" aria-current="page">Reflections</li>
@endsection

@section('content')
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-book-half"></i> Reflections</h2>
            <div class="section-actions">
                <a href="{{ route('reflections.create') }}" class="btn btn-primary-custom btn-sm">Create Reflection</a>
            </div>
        </div>

        <p class="text-muted">Manage devotional reflections, prayers, and spiritual insights for the seminary website.</p>

        <div class="alert alert-info">
            No reflection content has been added yet. Use the button above to create your first reflection.
        </div>
    </div>
@endsection
