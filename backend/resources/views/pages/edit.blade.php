@extends('layouts.app')

@section('page_title', 'Edit Page: ' . $page->title)

@section('content')
    <div class="form-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-pencil-square"></i>
                Edit Page: {{ $page->title }}
            </h2>
            <div class="section-actions">
                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to Pages
                </a>
                @if($page->status === 'published')
                    <a href="{{ url($page->slug) }}" target="_blank" class="btn btn-outline-primary">
                        <i class="bi bi-eye"></i>
                        View Page
                    </a>
                @endif
            </div>
        </div>

        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('pages.update', $page) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label for="title" class="form-label">Page Title *</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title', $page->title) }}" required
                               placeholder="Enter page title">
                        <small class="form-text text-muted">This will be displayed as the page heading</small>
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">URL Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                               value="{{ old('slug', $page->slug) }}" required
<<<<<<< HEAD
                               placeholder="page-url-slug" {{ $page->is_system ? 'readonly' : '' }}>
                        <small class="form-text text-muted">
                            URL-friendly version of the title.
                            @if($page->is_system) Slug is locked on system pages. @endif
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="section" class="form-label">Section</label>
                        <select class="form-control" id="section" name="section" {{ $page->is_system ? 'disabled' : '' }}>
                            <option value="">— Unassigned —</option>
                            @foreach(\App\Models\Page::SECTIONS as $key => $label)
                                <option value="{{ $key }}" {{ old('section', $page->section) === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @if($page->is_system)
                            <input type="hidden" name="section" value="{{ $page->section }}">
                        @endif
                    </div>

                    <div class="form-group">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2"
                                  placeholder="Short summary used in listings and previews">{{ old('excerpt', $page->excerpt) }}</textarea>
=======
                               placeholder="page-url-slug">
                        <small class="form-text text-muted">URL-friendly version of the title (no spaces or special characters)</small>
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
                    </div>

                    <!-- Content -->
                    <div class="form-group">
                        <label for="content" class="form-label">Page Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="15" required>{{ old('content', $page->content) }}</textarea>
                        <small class="form-text text-muted">Write your page content here. HTML is supported.</small>
                    </div>

                    <!-- Meta Information -->
                    <div class="form-group">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                               value="{{ old('meta_title', $page->meta_title) }}"
                               placeholder="SEO title (leave empty to use page title)">
                        <small class="form-text text-muted">Title for search engines (recommended: 50-60 characters)</small>
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description"
                                  rows="3" placeholder="Brief description for search engines">{{ old('meta_description', $page->meta_description) }}</textarea>
                        <small class="form-text text-muted">Description for search engines (recommended: 150-160 characters)</small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Settings Sidebar -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-gear"></i> Page Settings</h6>
                        </div>
                        <div class="card-body">
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="draft" {{ old('status', $page->status) === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status', $page->status) === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status', $page->status) === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <!-- Homepage -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_homepage" name="is_homepage" value="1"
                                       {{ old('is_homepage', $page->is_homepage) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_homepage">
                                    Set as Homepage
                                </label>
                                <small class="form-text text-muted d-block">This page will be displayed on the home route (/)</small>
                            </div>

                            <!-- Current Featured Image -->
                            @if($page->featured_image)
                                <div class="form-group mt-3">
                                    <label class="form-label">Current Featured Image</label>
                                    <div class="current-image">
                                        <img src="{{ asset('storage/' . $page->featured_image) }}" alt="Featured Image" class="img-fluid rounded">
                                    </div>
                                </div>
                            @endif

                            <!-- Featured Image -->
                            <div class="form-group mt-3">
                                <label for="featured_image" class="form-label">{{ $page->featured_image ? 'Replace' : 'Upload' }} Featured Image</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image"
                                       accept="image/*">
                                <small class="form-text text-muted">{{ $page->featured_image ? 'Leave empty to keep current image' : 'Upload a featured image for this page' }}</small>
                            </div>
                        </div>
                    </div>

                    <!-- SEO Preview -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-search"></i> SEO Preview</h6>
                        </div>
                        <div class="card-body">
                            <div id="seo-preview">
                                <div class="seo-title">{{ old('meta_title', $page->meta_title ?: $page->title) }}</div>
                                <div class="seo-url">{{ url('/') }}/{{ old('slug', $page->slug) }}</div>
                                <div class="seo-description">{{ old('meta_description', $page->meta_description ?: 'Page description will appear here...') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Page Info -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-info-circle"></i> Page Information</h6>
                        </div>
                        <div class="card-body">
                            <div class="info-item">
                                <strong>Created:</strong> {{ $page->created_at->format('M d, Y H:i') }}
                            </div>
                            <div class="info-item">
                                <strong>Last Updated:</strong> {{ $page->updated_at->format('M d, Y H:i') }}
                            </div>
                            <div class="info-item">
                                <strong>ID:</strong> {{ $page->id }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle"></i>
                    Update Page
                </button>
                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-x-circle"></i>
                    Cancel
                </a>
<<<<<<< HEAD
<<<<<<< HEAD
                @unless($page->is_system)
                    <div class="float-end">
                        <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">
                                <i class="bi bi-trash"></i>
                                Delete Page
                            </button>
                        </form>
                    </div>
                @endunless
=======
=======
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
                <div class="float-end">
                    <form action="{{ route('pages.destroy', $page) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this page? This action cannot be undone.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <i class="bi bi-trash"></i>
                            Delete Page
                        </button>
                    </form>
                </div>
<<<<<<< HEAD
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
=======
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
            </div>
        </form>
    </div>

    <script>
<<<<<<< HEAD
<<<<<<< HEAD
        const slugInput = document.getElementById('slug');
        // Auto-generate slug from title (skipped if slug field is readonly, e.g. system pages)
        document.getElementById('title').addEventListener('input', function() {
            if (slugInput.readOnly) return;
=======
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
=======
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
<<<<<<< HEAD
<<<<<<< HEAD
            slugInput.value = slug;
=======
            document.getElementById('slug').value = slug;
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
=======
            document.getElementById('slug').value = slug;
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
        });

        // Update SEO preview
        function updateSEO() {
            const title = document.getElementById('title').value || 'Page Title';
            const slug = document.getElementById('slug').value || 'page-slug';
            const metaTitle = document.getElementById('meta_title').value || title;
            const metaDesc = document.getElementById('meta_description').value || 'Page description will appear here...';

            document.querySelector('.seo-title').textContent = metaTitle;
            document.querySelector('.seo-url').textContent = '{{ url("/") }}/' + slug;
            document.querySelector('.seo-description').textContent = metaDesc;
        }

        document.getElementById('title').addEventListener('input', updateSEO);
        document.getElementById('slug').addEventListener('input', updateSEO);
        document.getElementById('meta_title').addEventListener('input', updateSEO);
        document.getElementById('meta_description').addEventListener('input', updateSEO);
    </script>

    <style>
        .seo-title {
            color: #1a0dab;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .seo-url {
            color: #006621;
            font-size: 14px;
            margin-bottom: 4px;
        }
        .seo-description {
            color: #545454;
            font-size: 13px;
            line-height: 1.4;
        }
        .card-header {
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }
        .current-image img {
            max-width: 100%;
            height: auto;
            border: 1px solid #e9ecef;
        }
        .info-item {
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .info-item:last-child {
            margin-bottom: 0;
        }
    </style>
@endsection
