@extends('layouts.app')

@section('content')
    <div class="department-form">
        <h1>Create Department</h1>
        <form method="POST" action="{{ route('departments.store') }}">
            @csrf
            <div>
                <label>Name</label>
                <input name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description') }}</textarea>
            </div>
            <div>
                <label>Image</label>
                <input name="image" value="{{ old('image') }}">
            </div>
            <div>
                <label>Head of Department</label>
                <input name="head_of_department" value="{{ old('head_of_department') }}">
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
