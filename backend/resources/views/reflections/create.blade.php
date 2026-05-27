@extends('layouts.app')

@section('page_title', 'Create Reflection')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('reflections.index') }}">Reflections</a></li>
    <li class="breadcrumb-item active" aria-current="page">Create Reflection</li>
@endsection

@section('content')
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title"><i class="bi bi-book-half"></i> New Reflection</h2>
        </div>

        <form action="{{ route('reflections.store') }}" method="POST" class="row g-4">
            @csrf

            <div class="col-12">
                <label for="title" class="form-label">Title</label>
                <input id="title" name="title" type="text" class="form-control" placeholder="Enter reflection title" required>
            </div>

            <div class="col-12">
                <label for="excerpt" class="form-label">Excerpt</label>
                <textarea id="excerpt" name="excerpt" class="form-control" rows="3" placeholder="Short summary or description"></textarea>
            </div>

            <div class="col-12">
                <label for="content" class="form-label">Content</label>
                <textarea id="content" name="content" class="form-control" rows="8" placeholder="Write the reflection content here" required></textarea>
            </div>

            <div class="col-12 d-flex gap-2">
                <button type="submit" class="btn btn-primary-custom">Save Reflection</button>
                <a href="{{ route('reflections.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
@endsection
