@extends('layouts.app')

@section('content')
    <div class="department-form">
        <h1>Edit Department</h1>
        <form method="POST" action="{{ route('departments.update', $department) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Name</label>
                <input name="name" value="{{ old('name', $department->name) }}" required>
            </div>
            <div>
                <label>Description</label>
                <textarea name="description" rows="4">{{ old('description', $department->description) }}</textarea>
            </div>
            <div>
                <label>Image</label>
                <input name="image" value="{{ old('image', $department->image) }}">
            </div>
            <div>
                <label>Head of Department</label>
                <input name="head_of_department" value="{{ old('head_of_department', $department->head_of_department) }}">
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
