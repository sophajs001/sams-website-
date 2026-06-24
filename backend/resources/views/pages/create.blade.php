@extends('layouts.app')

@section('page_title', 'Create New Page')

@section('content')
    <div class="form-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-plus-circle"></i>
                Create New Page
            </h2>
            <div class="section-actions">
                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to Pages
                </a>
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

        <form method="POST" action="{{ route('pages.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label for="title" class="form-label">Page Title *</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title') }}" required
                               placeholder="Enter page title">
                        <small class="form-text text-muted">This will be displayed as the page heading</small>
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">URL Slug *</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                               value="{{ old('slug') }}" required
                               placeholder="page-url-slug">
                        <small class="form-text text-muted">URL-friendly version of the title (no spaces or special characters)</small>
                    </div>

<<<<<<< HEAD
                    <div class="form-group">
                        <label for="section" class="form-label">Section</label>
                        <select class="form-control" id="section" name="section">
                            <option value="">— Unassigned —</option>
                            @foreach(\App\Models\Page::SECTIONS as $key => $label)
                                <option value="{{ $key }}" {{ old('section') === $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <small class="form-text text-muted">Where this page belongs in the site navigation</small>
                    </div>

                    <div class="form-group">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="2"
                                  placeholder="Short summary used in listings and previews">{{ old('excerpt') }}</textarea>
                    </div>

=======
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f
                    <!-- Content -->
                    <div class="form-group">
                        <label for="content" class="form-label">Page Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="15" required>{{ old('content') }}</textarea>
                        <small class="form-text text-muted">Write your page content here. HTML is supported.</small>
                    </div>

                    <!-- Meta Information -->
                    <div class="form-group">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                               value="{{ old('meta_title') }}"
                               placeholder="SEO title (leave empty to use page title)">
                        <small class="form-text text-muted">Title for search engines (recommended: 50-60 characters)</small>
                    </div>

                    <div class="form-group">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control" id="meta_description" name="meta_description"
                                  rows="3" placeholder="Brief description for search engines">{{ old('meta_description') }}</textarea>
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
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="archived" {{ old('status') === 'archived' ? 'selected' : '' }}>Archived</option>
                                </select>
                            </div>

                            <!-- Homepage -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="is_homepage" name="is_homepage" value="1"
                                       {{ old('is_homepage') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_homepage">
                                    Set as Homepage
                                </label>
                                <small class="form-text text-muted d-block">This page will be displayed on the home route (/)</small>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group mt-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image"
                                       accept="image/*">
                                <small class="form-text text-muted">Upload a featured image for this page</small>
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
                                <div class="seo-title">{{ old('meta_title', old('title', 'Page Title')) }}</div>
                                <div class="seo-url">{{ url('/') }}/{{ old('slug', 'page-slug') }}</div>
                                <div class="seo-description">{{ old('meta_description', 'Page description will appear here...') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle"></i>
                    Create Page
                </button>
                <a href="{{ route('pages.index') }}" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-x-circle"></i>
                    Cancel
                </a>
            </div>
        </form>
    </div>

    <script>
        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
            document.getElementById('slug').value = slug;
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
    </style>
@endsection
