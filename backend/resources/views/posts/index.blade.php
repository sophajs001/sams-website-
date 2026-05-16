@extends('layouts.app')

@section('page_title', 'Manage Blog Posts')

@section('content')
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-newspaper"></i>
                Blog Posts Management
            </h2>
            <div class="section-actions">
                <a href="{{ route('posts.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle"></i>
                    Write New Post
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                {{ session('error') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Status</th>
                        <th>Published</th>
                        <th>Views</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td>
                                <div class="post-title">
                                    <strong>{{ $post->title }}</strong>
                                    @if($post->featured)
                                        <span class="badge bg-warning ms-2">Featured</span>
                                    @endif
                                    <br>
                                    <small class="text-muted">{{ Str::limit(strip_tags($post->content), 100) }}</small>
                                </div>
                            </td>
                            <td>{{ $post->user->name ?? 'Unknown' }}</td>
                            <td>
                                @if($post->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($post->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @elseif($post->status === 'scheduled')
                                    <span class="badge bg-info">Scheduled</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($post->status) }}</span>
                                @endif
                            </td>
                            <td>
                                @if($post->published_at)
                                    {{ $post->published_at->format('M d, Y') }}
                                @else
                                    <em>Not published</em>
                                @endif
                            </td>
                            <td>{{ $post->views ?? 0 }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-edit btn-sm-custom" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    @if($post->status === 'published')
                                        <a href="{{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm-custom" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @endif
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm-custom" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <i class="bi bi-newspaper fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No blog posts yet. <a href="{{ route('posts.create') }}">Write your first post</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($posts->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    <style>
        .post-title {
            max-width: 300px;
        }
        .post-title strong {
            display: block;
            margin-bottom: 2px;
        }
    </style>
@endsection
