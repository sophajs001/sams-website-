@extends('layouts.app')

@section('content')
    <div class="post-form">
        <h1>Edit Post</h1>
        <form method="POST" action="{{ route('posts.update', $post) }}">
            @csrf
            @method('PUT')
            <div>
                <label>Title</label>
                <input name="title" value="{{ old('title', $post->title) }}" required>
            </div>
            <div>
                <label>Category</label>
                <input name="category" value="{{ old('category', $post->category) }}">
            </div>
            <div>
                <label>Body</label>
                <textarea name="body" rows="6" required>{{ old('body', $post->body) }}</textarea>
            </div>
            <div>
                <label>User ID</label>
                <input name="user_id" value="{{ old('user_id', $post->user_id) }}" required>
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection
