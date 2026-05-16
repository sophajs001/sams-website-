@extends('layouts.app')

@section('content')
    <div class="departments">
        <h1>Departments</h1>
        <a href="{{ route('departments.create') }}">Create Department</a>
        <ul>
            @foreach($departments as $department)
                <li>
                    <strong>{{ $department->name }}</strong>
                    <div>{{ $department->head_of_department }}</div>
                    <a href="{{ route('departments.edit', $department) }}">Edit</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
