@extends('layouts.app')

@section('content')
    <div class="post-detail">
        <h1>{{ $post->title }}</h1>
        <p>Category: {{ $post->category }}</p>
        <p>Author: {{ $post->user->name ?? 'Unknown' }}</p>
        <article>{{ $post->body }}</article>

        @if($post->media->count())
            <section>
                <h2>Media</h2>
                <ul>
                    @foreach($post->media as $media)
                        <li>{{ $media->type }}: {{ $media->file_path }}</li>
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
@endsection
