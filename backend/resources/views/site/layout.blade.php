@php
    use App\Models\Page;
    $sitePages = \Illuminate\Support\Facades\Cache::remember('site.nav.pages', 60, function () {
        if (!\Illuminate\Support\Facades\Schema::hasTable('pages')) return collect();
        return Page::where('status', 'published')->orderBy('sort_order')->orderBy('title')->get();
    });
    $bySlug = $sitePages->keyBy('slug');
    $title = $page->meta_title ?? ($page->title ?? "St Augustine's Major Seminary Jos Nigeria | Catholic Seminary");
    $desc  = $page->meta_description ?? "St Augustine's Major Seminary in Jos, Nigeria offers Catholic priestly formation, philosophy and theology programs, vocation training, and spiritual resources for seminarians and the wider Church.";
    function siteLink($slug) {
        return $slug === 'home' ? url('/') : url('/page/' . $slug);
    }
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>{{ $title }}</title>
  <meta name="description" content="{{ $desc }}">
  <meta name="robots" content="index, follow">
  <meta property="og:title" content="{{ $title }}">
  <meta property="og:description" content="{{ $desc }}">
  <meta property="og:image" content="{{ url('/site/images/sams logo.jpeg') }}">
  <meta property="og:type" content="website">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ url('/site/style.css') }}">
  @stack('head')
</head>
<body>
  <!-- Loading Overlay -->
  <div id="loading-overlay" class="loading-overlay">
    <div class="loading-spinner">
      <div class="spinner-border text-light" role="status"><span class="visually-hidden">Loading...</span></div>
      <p class="loading-text">Loading...</p>
    </div>
  </div>

  <!-- Top Header Bar -->
  <div class="header-top">
    <div class="container-fluid">
      <div class="row align-items-center">
        <div class="col-md-6">
          <div class="follow-us">
            <span>Follow Us:</span>
            <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-youtube"></i></a>
            <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
          </div>
        </div>
        <div class="col-md-6 text-end">
          <div class="contact-info">
            <span><i class="bi bi-geo-alt"></i> Jos, Nigeria</span>
            <span><i class="bi bi-envelope"></i> info@samsjos.edu.ng; Tel: 090800000001 </span>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
      <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
        <img src="{{ url('/site/images/sams logo.jpeg') }}" alt="Logo" class="me-2 rounded-circle" height="40" width="40" loading="lazy">
        <span class="fw-bold fs-6 d-none d-md-inline">St Augustine's Major Seminary</span>
        <span class="fw-bold fs-6 d-inline d-md-none">SAMS</span>
      </a>
      <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="toggler-bar"></span><span class="toggler-bar"></span><span class="toggler-bar"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto align-items-center">
          <li class="nav-item"><a class="nav-link" href="{{ url('/') }}">Home</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#about" role="button" data-bs-toggle="dropdown">About Us</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ siteLink('history') }}"><i class="bi bi-arrow-right-short"></i> History</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('administration') }}"><i class="bi bi-arrow-right-short"></i> Administration</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('vocation-formation') }}"><i class="bi bi-arrow-right-short"></i> Vocation & Formation</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#academics" role="button" data-bs-toggle="dropdown">Academics</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ siteLink('admission') }}"><i class="bi bi-arrow-right-short"></i> Admission</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('philosophy-department') }}"><i class="bi bi-arrow-right-short"></i> Philosophy Department</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('theology') }}"><i class="bi bi-arrow-right-short"></i> Theology Department</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#resources" role="button" data-bs-toggle="dropdown">Resources</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ siteLink('library') }}"><i class="bi bi-arrow-right-short"></i> Library</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('farm') }}"><i class="bi bi-arrow-right-short"></i> Farm</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('publications') }}"><i class="bi bi-arrow-right-short"></i> Publications</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#info" role="button" data-bs-toggle="dropdown">Info</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ siteLink('contact') }}"><i class="bi bi-arrow-right-short"></i> Contact & Support</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('blog') }}"><i class="bi bi-arrow-right-short"></i> News & Events</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('blog-detail') }}"><i class="bi bi-arrow-right-short"></i> Event Details</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('gallery') }}"><i class="bi bi-arrow-right-short"></i> Gallery</a></li>
              <li><a class="dropdown-item" href="{{ siteLink('external-links') }}"><i class="bi bi-arrow-right-short"></i> External Links</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ siteLink('alumni') }}">Alumni</a></li>
          <li class="nav-item"><a class="reflection-btn" href="{{ siteLink('reflection') }}">📖 Reflection</a></li>
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')

  <!-- Footer -->
  @include('site.partials.footer')

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
  <script>
    AOS.init();
    window.addEventListener('load', function() {
      const loader = document.getElementById('loading-overlay');
      if (loader) { loader.style.opacity = '0'; setTimeout(() => loader.style.display = 'none', 500); }
    });
    setTimeout(() => {
      const loader = document.getElementById('loading-overlay');
      if (loader && loader.style.display !== 'none') { loader.style.opacity = '0'; setTimeout(() => loader.style.display = 'none', 500); }
    }, 5000);
  </script>
  @stack('scripts')
</body>
</html>
