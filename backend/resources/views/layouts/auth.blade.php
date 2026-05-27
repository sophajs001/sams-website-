<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'SAMS CMS') }} - Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-panel">
            <div class="auth-branding text-center mb-4">
                <img src="{{ asset('images/sams-logo.jpeg') }}" alt="SAMS Logo" class="auth-logo">
                <h1>SAMS CMS</h1>
                <p class="text-muted">Secure admin access for your seminary website.</p>
            </div>

            <div class="auth-card">
                <div class="auth-card-header">
                    <h2 class="mb-1">Administrator Login</h2>
                    <p class="text-muted mb-0">Enter your credentials to continue to the admin dashboard.</p>
                </div>

                @yield('content')
            </div>

            <div class="auth-footer text-center mt-4 text-muted">
                <small>Powered by St Augustine's Major Seminary</small>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>