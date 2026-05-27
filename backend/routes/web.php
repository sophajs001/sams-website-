<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
// Serve frontend static assets (style.css, images/*) from the sibling frontend/ folder
Route::get('/site/{path}', function (string $path) {
    $file = realpath(base_path('../frontend/' . $path));
    $root = realpath(base_path('../frontend'));
    if (!$file || !$root || !str_starts_with($file, $root) || !is_file($file)) {
        abort(404);
    }
    $mime = match (strtolower(pathinfo($file, PATHINFO_EXTENSION))) {
        'css'   => 'text/css',
        'js'    => 'application/javascript',
        'png'   => 'image/png',
        'jpg', 'jpeg' => 'image/jpeg',
        'webp'  => 'image/webp',
        'gif'   => 'image/gif',
        'svg'   => 'image/svg+xml',
        'avif'  => 'image/avif',
        'mp4'   => 'video/mp4',
        'pdf'   => 'application/pdf',
        'woff'  => 'font/woff',
        'woff2' => 'font/woff2',
        'ttf'   => 'font/ttf',
        default => mime_content_type($file) ?: 'application/octet-stream',
    };
    return response()->file($file, [
        'Content-Type'  => $mime,
        'Cache-Control' => 'public, max-age=3600',
    ]);
})->where('path', '.*')->name('site.asset');

Route::get('/', [PageController::class, 'showLanding'])->name('landing');
Route::get('/p/{slug}', [PageController::class, 'showBySlug'])->name('pages.show');

// Public friendly URLs for each system page slug (e.g. /history, /admission, /reflection)
Route::get('/page/{slug}', [PageController::class, 'showBySlug'])->name('site.page');
=======
Route::get('/', [PageController::class, 'showLanding'])->name('landing');
>>>>>>> 8783bc1e92df78ff526aca92b0cbd1f45f4c566f

Route::middleware(['auth'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::resource('pages', PageController::class);
    Route::resource('departments', DepartmentController::class);
    Route::resource('posts', PostController::class);
    Route::resource('media', MediaController::class);
    Route::resource('alumni', AlumniController::class);
    Route::get('reflections', [ReflectionController::class, 'index'])->name('reflections.index');
    Route::get('reflections/create', [ReflectionController::class, 'create'])->name('reflections.create');
    Route::post('reflections', [ReflectionController::class, 'store'])->name('reflections.store');
    Route::resource('settings', SettingsController::class);
});
