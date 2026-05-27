@extends('layouts.app')

@section('page_title', 'Dashboard')

@section('content')
    <!-- Welcome Section -->
    <div class="content-section">
        <div class="section-header">
            <h2 class="section-title">
                <i class="bi bi-house-door"></i>
                Welcome to SAMS CMS Dashboard
            </h2>
            <small class="text-muted">Manage your seminary content efficiently</small>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <p class="mb-4">Welcome back, {{ Auth::user()?->name ?? 'Administrator' }}! Here's an overview of your content management system.</p>

                <div class="row">
                    <div class="col-md-6">
                        <div class="alert alert-info">
                            <h6><i class="bi bi-info-circle"></i> Quick Start Guide</h6>
                            <ul class="mb-0 mt-2">
                                <li>Manage pages, posts, and departments</li>
                                <li>Upload media files to the library</li>
                                <li>Track alumni information</li>
                                <li>Configure system settings</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="alert alert-success">
                            <h6><i class="bi bi-check-circle"></i> System Status</h6>
                            <p class="mb-0">All systems are running normally. Database connected, file uploads enabled.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card">
                    <div class="card-body text-center">
                        <img src="{{ asset('images/sams-logo.jpeg') }}" alt="SAMS Logo" class="img-fluid rounded-circle mb-3" style="max-width: 80px;">
                        <h5>St Augustine's Major Seminary</h5>
                        <p class="text-muted small">Content Management System</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-cards">
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Page::count() }}</div>
            <div class="stat-label">Pages</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Post::count() }}</div>
            <div class="stat-label">Blog Posts</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Department::count() }}</div>
            <div class="stat-label">Departments</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Alumni::count() }}</div>
            <div class="stat-label">Alumni</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\Media::count() }}</div>
            <div class="stat-label">Media Files</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ \App\Models\User::count() }}</div>
            <div class="stat-label">Users</div>
        </div>
    </div>

    <!-- Management Cards -->
    <div class="dashboard-cards">
        <div class="dashboard-card">
            <div class="card-icon pages">
                <i class="bi bi-file-text"></i>
            </div>
            <h5 class="card-title">Page Management</h5>
            <p class="card-description">Create and manage website pages, edit content, and organize page hierarchy.</p>
            <a href="{{ route('pages.index') }}" class="card-link">
                Manage Pages <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon posts">
                <i class="bi bi-newspaper"></i>
            </div>
            <h5 class="card-title">Blog Posts</h5>
            <p class="card-description">Write and publish blog articles, news, and announcements for the seminary.</p>
            <a href="{{ route('posts.index') }}" class="card-link">
                Manage Posts <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon departments">
                <i class="bi bi-building"></i>
            </div>
            <h5 class="card-title">Departments</h5>
            <p class="card-description">Manage philosophy and theology departments, faculty, and academic programs.</p>
            <a href="{{ route('departments.index') }}" class="card-link">
                Manage Departments <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon alumni">
                <i class="bi bi-people"></i>
            </div>
            <h5 class="card-title">Alumni Network</h5>
            <p class="card-description">Track seminary graduates, their achievements, and maintain alumni records.</p>
            <a href="{{ route('alumni.index') }}" class="card-link">
                Manage Alumni <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon reflections">
                <i class="bi bi-book-half"></i>
            </div>
            <h5 class="card-title">Reflections</h5>
            <p class="card-description">Create and manage devotional reflections, prayers, and spiritual resources.</p>
            <a href="{{ route('reflections.index') }}" class="card-link">
                Manage Reflections <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon media">
                <i class="bi bi-images"></i>
            </div>
            <h5 class="card-title">Media Library</h5>
            <p class="card-description">Upload and organize images, documents, and other media files for the website.</p>
            <a href="{{ route('media.index') }}" class="card-link">
                Open Media Library <i class="bi bi-arrow-right"></i>
            </a>
        </div>

        <div class="dashboard-card">
            <div class="card-icon settings">
                <i class="bi bi-gear"></i>
            </div>
            <h5 class="card-title">System Settings</h5>
            <p class="card-description">Configure website settings, contact information, and system preferences.</p>
            <a href="{{ route('settings.index') }}" class="card-link">
                System Settings <i class="bi bi-arrow-right"></i>
            </a>
        </div>
    </div>

    <!-- Recent Activity -->
    <div class="content-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="bi bi-activity"></i>
                Recent Activity
            </h3>
            <div class="section-actions">
                <button class="btn btn-primary-custom btn-sm">
                    <i class="bi bi-arrow-clockwise"></i>
                    Refresh
                </button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Action</th>
                        <th>Item</th>
                        <th>User</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><span class="badge bg-success">Created</span></td>
                        <td>Welcome Page</td>
                        <td>{{ Auth::user()?->name ?? 'Administrator' }}</td>
                        <td>{{ now()->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-info">Updated</span></td>
                        <td>System Settings</td>
                        <td>{{ Auth::user()?->name ?? 'Administrator' }}</td>
                        <td>{{ now()->subHours(2)->format('M d, Y H:i') }}</td>
                    </tr>
                    <tr>
                        <td><span class="badge bg-primary">Uploaded</span></td>
                        <td>SAMS Logo</td>
                        <td>{{ Auth::user()?->name ?? 'Administrator' }}</td>
                        <td>{{ now()->subDay()->format('M d, Y H:i') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="content-section">
        <div class="section-header">
            <h3 class="section-title">
                <i class="bi bi-lightning"></i>
                Quick Actions
            </h3>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <a href="{{ route('pages.create') }}" class="btn btn-primary-custom w-100 p-3">
                    <i class="bi bi-plus-circle d-block fs-1 mb-2"></i>
                    <strong>Add New Page</strong>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('posts.create') }}" class="btn btn-primary-custom w-100 p-3">
                    <i class="bi bi-pencil-square d-block fs-1 mb-2"></i>
                    <strong>Write New Post</strong>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('media.create') }}" class="btn btn-primary-custom w-100 p-3">
                    <i class="bi bi-cloud-upload d-block fs-1 mb-2"></i>
                    <strong>Upload Media</strong>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('reflections.create') }}" class="btn btn-primary-custom w-100 p-3">
                    <i class="bi bi-book-half d-block fs-1 mb-2"></i>
                    <strong>Create Reflection</strong>
                </a>
            </div>
            <div class="col-md-3 mb-3">
                <a href="{{ route('settings.index') }}" class="btn btn-primary-custom w-100 p-3">
                    <i class="bi bi-gear d-block fs-1 mb-2"></i>
                    <strong>System Settings</strong>
                </a>
            </div>
        </div>
    </div>
@endsection
