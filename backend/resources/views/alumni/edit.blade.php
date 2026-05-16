@extends('layouts.app')

@section('content')
    <div class="alumni-form">
        <h1>Edit Alumni Record</h1>
        <form method="POST" action="{{ route('alumni.update', $alumnus) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Name</label>
                <input name="name" value="{{ old('name', $alumnus->name) }}" required>
            </div>
            <div>
                <label>Ordination Date</label>
                <input type="date" name="ordination_date" value="{{ old('ordination_date', $alumnus->ordination_date) }}">
            </div>
            <div>
                <label>Role</label>
                <input name="role" value="{{ old('role', $alumnus->role) }}">
            </div>
            <div>
                <label>Bio</label>
                <textarea name="bio" rows="4">{{ old('bio', $alumnus->bio) }}</textarea>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
