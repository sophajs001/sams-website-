@extends('layouts.app')

@section('content')
    <section class="landing-page">
        <h1>Welcome to {{ config('app.name', 'Our Site') }}</h1>
        <p>This is the public landing page for visitors.</p>
    </section>
@endsection
