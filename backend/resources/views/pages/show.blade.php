<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->meta_title ?: $page->title }}</title>
    @if($page->meta_description)
        <meta name="description" content="{{ $page->meta_description }}">
    @endif
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
    <main class="container py-5">
        <article>
            <header class="mb-4">
                <h1 class="display-5">{{ $page->title }}</h1>
                @if($page->excerpt)
                    <p class="lead text-muted">{{ $page->excerpt }}</p>
                @endif
                @if($page->featured_image)
                    <img src="{{ asset('storage/' . $page->featured_image) }}" alt="{{ $page->title }}" class="img-fluid rounded my-3">
                @endif
            </header>

            <div class="page-content">
                {!! $page->content !!}
            </div>
        </article>
    </main>
</body>
</html>
