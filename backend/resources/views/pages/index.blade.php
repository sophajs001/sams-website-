@extends('layouts.app')

@section('page_title', 'Manage Pages')

@section('content')
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-file-text"></i>
                Page Management
            </h2>
            <div class="section-actions">
                <a href="{{ route('pages.create') }}" class="btn btn-primary-custom">
                    <i class="bi bi-plus-circle"></i>
                    Add New Page
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

<<<<<<< HEAD
        @php $sections = \App\Models\Page::SECTIONS; @endphp

        @forelse($grouped as $sectionKey => $sectionPages)
            <div class="card mb-4">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">
                        <i class="bi bi-folder2-open"></i>
                        {{ $sections[$sectionKey] ?? ucfirst($sectionKey) }}
                        <span class="badge bg-secondary ms-2">{{ $sectionPages->count() }}</span>
                    </h5>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Updated</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sectionPages as $page)
                                <tr>
                                    <td>
                                        <strong>{{ $page->title }}</strong>
                                        @if($page->is_homepage)
                                            <span class="badge bg-primary ms-2">Homepage</span>
                                        @endif
                                        @if($page->is_system)
                                            <span class="badge bg-info ms-1" title="Built-in page">System</span>
                                        @endif
                                    </td>
                                    <td><code>{{ $page->slug }}</code></td>
                                    <td>
                                        @if($page->status === 'published')
                                            <span class="badge bg-success">Published</span>
                                        @elseif($page->status === 'draft')
                                            <span class="badge bg-warning text-dark">Draft</span>
                                        @else
                                            <span class="badge bg-secondary">{{ ucfirst($page->status) }}</span>
                                        @endif
                                    </td>
                                    <td>{{ $page->updated_at?->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        <div class="action-buttons d-inline-flex gap-1">
                                            <a href="{{ route('pages.edit', $page) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                                <i class="bi bi-pencil"></i>
                                            </a>
                                            @if($page->status === 'published')
                                                <a href="{{ url('p/' . $page->slug) }}" target="_blank" class="btn btn-sm btn-outline-secondary" title="View">
                                                    <i class="bi bi-eye"></i>
                                                </a>
                                            @endif
                                            @unless($page->is_system)
                                                <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline"
                                                      onsubmit="return confirm('Delete this page?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </form>
                                            @endunless
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                <p class="text-muted mt-2">No pages found. <a href="{{ route('pages.create') }}">Create your first page</a></p>
            </div>
        @endforelse
=======
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>
                                <strong>{{ $page->title }}</strong>
                                @if($page->is_homepage)
                                    <span class="badge bg-primary ms-2">Homepage</span>
                                @endif
                            </td>
                            <td><code>{{ $page->slug }}</code></td>
                            <td>
                                @if($page->status === 'published')
                                    <span class="badge bg-success">Published</span>
                                @elseif($page->status === 'draft')
                                    <span class="badge bg-warning">Draft</span>
                                @else
                                    <span class="badge bg-secondary">{{ ucfirst($page->status) }}</span>
                                @endif
                            </td>
                            <td>{{ $page->created_at->format('M d, Y') }}</td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('pages.edit', $page) }}" class="btn btn-edit btn-sm-custom" title="Edit">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this page?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-delete btn-sm-custom" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    @if($page->status === 'published')
                                        <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-outline-primary btn-sm-custom" title="View">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="bi bi-file-earmark-x fs-1 text-muted"></i>
                                <p class="text-muted mt-2">No pages found. <a href="{{ route('pages.create') }}">Create your first page</a></p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f

        @if($pages->hasPages())
            <div class="d-flex justify-content-center mt-4">
                {{ $pages->links() }}
            </div>
        @endif
    </div>
@endsection
