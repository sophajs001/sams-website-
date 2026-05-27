@extends('layouts.app')

@section('content')
    <div class="alumni-form">
        <h1>Create Alumni Record</h1>
        <form method="POST" action="{{ route('alumni.store') }}">
            @csrf
            <div>
                <label>Name</label>
                <input name="name" value="{{ old('name') }}" required>
            </div>
            <div>
                <label>Ordination Date</label>
                <input type="date" name="ordination_date" value="{{ old('ordination_date') }}">
            </div>
            <div>
                <label>Role</label>
                <input name="role" value="{{ old('role') }}">
            </div>
            <div>
                <label>Bio</label>
                <textarea name="bio" rows="4">{{ old('bio') }}</textarea>
            </div>
            <button type="submit">Save</button>
        </form>
    </div>
@endsection
