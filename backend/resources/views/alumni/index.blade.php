@extends('layouts.app')

@section('content')
    <div class="alumni">
        <h1>Alumni</h1>
        <a href="{{ route('alumni.create') }}">Create Alumni Record</a>
        <ul>
            @foreach($alumni as $alumnus)
                <li>
                    <strong>{{ $alumnus->name }}</strong>
                    <p>{{ $alumnus->role }} - Ordained {{ $alumnus->ordination_date }}</p>
                    <a href="{{ route('alumni.edit', $alumnus) }}">Edit</a>
                </li>
            @endforeach
        </ul>
    </div>
@endsection
