@extends('layouts.app')

@section('page_title', 'Write New Blog Post')

@section('content')
    <div class="form-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-pencil-square"></i>
                Write New Blog Post
            </h2>
            <div class="section-actions">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left"></i>
                    Back to Posts
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

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="row">
                <div class="col-lg-8">
                    <!-- Basic Information -->
                    <div class="form-group">
                        <label for="title" class="form-label">Post Title *</label>
                        <input type="text" class="form-control" id="title" name="title"
                               value="{{ old('title') }}" required
                               placeholder="Enter an engaging title for your post">
                        <small class="form-text text-muted">This will be displayed as the post heading and in search results</small>
                    </div>

                    <div class="form-group">
                        <label for="slug" class="form-label">URL Slug</label>
                        <input type="text" class="form-control" id="slug" name="slug"
                               value="{{ old('slug') }}"
                               placeholder="post-url-slug">
                        <small class="form-text text-muted">Leave empty to auto-generate from title</small>
                    </div>

                    <!-- Content -->
                    <div class="form-group">
                        <label for="content" class="form-label">Post Content *</label>
                        <textarea class="form-control" id="content" name="content" rows="20" required>{{ old('content') }}</textarea>
                        <small class="form-text text-muted">Write your blog post content here. HTML is supported.</small>
                    </div>

                    <!-- Excerpt -->
                    <div class="form-group">
                        <label for="excerpt" class="form-label">Excerpt</label>
                        <textarea class="form-control" id="excerpt" name="excerpt" rows="3"
                                  placeholder="Brief summary of your post">{{ old('excerpt') }}</textarea>
                        <small class="form-text text-muted">Short summary for previews and meta descriptions (recommended: 150-160 characters)</small>
                    </div>

                    <!-- Tags -->
                    <div class="form-group">
                        <label for="tags" class="form-label">Tags</label>
                        <input type="text" class="form-control" id="tags" name="tags"
                               value="{{ old('tags') }}"
                               placeholder="tag1, tag2, tag3">
                        <small class="form-text text-muted">Separate tags with commas</small>
                    </div>
                </div>

                <div class="col-lg-4">
                    <!-- Settings Sidebar -->
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-gear"></i> Post Settings</h6>
                        </div>
                        <div class="card-body">
                            <!-- Status -->
                            <div class="form-group">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="draft" {{ old('status') === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ old('status') === 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="scheduled" {{ old('status') === 'scheduled' ? 'selected' : '' }}>Scheduled</option>
                                </select>
                            </div>

                            <!-- Publish Date -->
                            <div class="form-group" id="publishDateGroup" style="display: none;">
                                <label for="published_at" class="form-label">Publish Date & Time</label>
                                <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                       value="{{ old('published_at') }}">
                            </div>

                            <!-- Featured Post -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="featured" name="featured" value="1"
                                       {{ old('featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="featured">
                                    Featured Post
                                </label>
                                <small class="form-text text-muted d-block">Display this post prominently on the blog</small>
                            </div>

                            <!-- Featured Image -->
                            <div class="form-group mt-3">
                                <label for="featured_image" class="form-label">Featured Image</label>
                                <input type="file" class="form-control" id="featured_image" name="featured_image"
                                       accept="image/*">
                                <small class="form-text text-muted">Upload a featured image for this post</small>
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
                                <div class="seo-title">{{ old('title', 'Post Title') }}</div>
                                <div class="seo-url">{{ url('/blog/') }}{{ old('slug', 'post-slug') }}</div>
                                <div class="seo-description">{{ old('excerpt', 'Post excerpt will appear here...') }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Categories -->
                    <div class="card mt-3">
                        <div class="card-header">
                            <h6 class="mb-0"><i class="bi bi-tags"></i> Categories</h6>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="category_news" name="categories[]" value="news">
                                <label class="form-check-label" for="category_news">
                                    News & Announcements
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="category_spirituality" name="categories[]" value="spirituality">
                                <label class="form-check-label" for="category_spirituality">
                                    Spirituality
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="category_education" name="categories[]" value="education">
                                <label class="form-check-label" for="category_education">
                                    Education
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="category_community" name="categories[]" value="community">
                                <label class="form-check-label" for="category_community">
                                    Community
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-group mt-4">
                <button type="submit" class="btn btn-primary-custom">
                    <i class="bi bi-check-circle"></i>
                    Publish Post
                </button>
                <button type="submit" name="save_draft" value="1" class="btn btn-outline-secondary ms-2">
                    <i class="bi bi-save"></i>
                    Save as Draft
                </button>
                <a href="{{ route('posts.index') }}" class="btn btn-outline-secondary ms-2">
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
            updateSEO();
        });

        // Show/hide publish date based on status
        document.getElementById('status').addEventListener('change', function() {
            const publishDateGroup = document.getElementById('publishDateGroup');
            if (this.value === 'scheduled') {
                publishDateGroup.style.display = 'block';
            } else {
                publishDateGroup.style.display = 'none';
            }
        });

        // Update SEO preview
        function updateSEO() {
            const title = document.getElementById('title').value || 'Post Title';
            const slug = document.getElementById('slug').value || 'post-slug';
            const excerpt = document.getElementById('excerpt').value || 'Post excerpt will appear here...';

            document.querySelector('.seo-title').textContent = title;
            document.querySelector('.seo-url').textContent = '{{ url("/blog/") }}' + slug;
            document.querySelector('.seo-description').textContent = excerpt;
        }

        document.getElementById('slug').addEventListener('input', updateSEO);
        document.getElementById('excerpt').addEventListener('input', updateSEO);

        // Auto-save draft functionality (optional enhancement)
        let autoSaveTimer;
        document.addEventListener('input', function() {
            clearTimeout(autoSaveTimer);
            autoSaveTimer = setTimeout(() => {
                // Could implement auto-save here
                console.log('Auto-save triggered');
            }, 30000); // 30 seconds
        });
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
