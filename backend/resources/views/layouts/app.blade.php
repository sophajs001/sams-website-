<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SAMS CMS') }} - {{ $page_title ?? 'Dashboard' }}</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="admin-container">
        <!-- Sidebar -->
        <nav class="admin-sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/sams-logo.jpeg') }}" alt="SAMS Logo" class="sidebar-logo">
                <h5 class="sidebar-title">SAMS CMS</h5>
            </div>

            <ul class="sidebar-menu">
                <li class="menu-section">MAIN</li>
                <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <a href="{{ route('dashboard') }}" class="menu-link">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="menu-section">CONTENT</li>
                <li class="menu-item {{ request()->routeIs('pages.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('pages.index') }}" class="menu-link">
                        <i class="bi bi-file-text"></i>
                        <span>Pages</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('pages.index') }}" class="submenu-link">All Pages</a></li>
                        <li><a href="{{ route('pages.create') }}" class="submenu-link">Create Page</a></li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('posts.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('posts.index') }}" class="menu-link">
                        <i class="bi bi-newspaper"></i>
                        <span>Blog Posts</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('posts.index') }}" class="submenu-link">All Posts</a></li>
                        <li><a href="{{ route('posts.create') }}" class="submenu-link">Create Post</a></li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('departments.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('departments.index') }}" class="menu-link">
                        <i class="bi bi-building"></i>
                        <span>Departments</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('departments.index') }}" class="submenu-link">All Departments</a></li>
                        <li><a href="{{ route('departments.create') }}" class="submenu-link">Create Department</a></li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('alumni.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('alumni.index') }}" class="menu-link">
                        <i class="bi bi-people"></i>
                        <span>Alumni</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('alumni.index') }}" class="submenu-link">All Alumni</a></li>
                        <li><a href="{{ route('alumni.create') }}" class="submenu-link">Create Alumni</a></li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('media.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('media.index') }}" class="menu-link">
                        <i class="bi bi-images"></i>
                        <span>Media Library</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('media.index') }}" class="submenu-link">Library</a></li>
                        <li><a href="{{ route('media.create') }}" class="submenu-link">Upload Media</a></li>
                    </ul>
                </li>

                <li class="menu-item {{ request()->routeIs('reflections.*') ? 'active expanded' : '' }}">
                    <a href="{{ route('reflections.index') }}" class="menu-link">
                        <i class="bi bi-book-half"></i>
                        <span>Reflections</span>
                    </a>
                    <ul class="submenu">
                        <li><a href="{{ route('reflections.index') }}" class="submenu-link">All Reflections</a></li>
                        <li><a href="{{ route('reflections.create') }}" class="submenu-link">Create Reflection</a></li>
                    </ul>
                </li>

                <li class="menu-section">SETTINGS</li>
                <li class="menu-item {{ request()->routeIs('settings.*') ? 'active' : '' }}">
                    <a href="{{ route('settings.index') }}" class="menu-link">
                        <i class="bi bi-gear"></i>
                        <span>System Settings</span>
                    </a>
                </li>
            </ul>

            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-logout">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="admin-main">
            <!-- Top Header -->
            <header class="admin-header">
                <div class="header-content">
                    <button class="sidebar-toggle d-md-none" onclick="toggleSidebar()">
                        <i class="bi bi-list"></i>
                    </button>

                    <div class="header-info">
                        <h4 class="page-title">{{ $page_title ?? 'Dashboard' }}</h4>
                        <div class="breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="{{ route('dashboard') }}">Dashboard</a>
                                    </li>
                                    @hasSection('breadcrumb')
                                        @yield('breadcrumb')
                                    @endif
                                </ol>
                            </nav>
                        </div>
                    </div>

                    <div class="header-actions">
                        <div class="user-info">
                            <span class="user-name">{{ Auth::user()?->name ?? 'Administrator' }}</span>
                            <small class="user-role">Administrator</small>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="admin-content">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom JS -->
    <script>
        function toggleSidebar() {
            document.querySelector('.admin-container').classList.toggle('sidebar-collapsed');
        }

        function initSubmenuToggle() {
            document.querySelectorAll('.menu-item').forEach(item => {
                const submenu = item.querySelector('.submenu');
                if (!submenu) {
                    return;
                }

                const toggleButton = document.createElement('button');
                toggleButton.type = 'button';
                toggleButton.className = 'submenu-toggle';
                toggleButton.innerHTML = '<i class="bi bi-chevron-down"></i>';
                item.querySelector('.menu-link').appendChild(toggleButton);

                toggleButton.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    item.classList.toggle('expanded');
                });
            });
        }

        initSubmenuToggle();

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.opacity = '0';
                setTimeout(() => alert.remove(), 300);
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>
