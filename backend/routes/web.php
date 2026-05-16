<?php

use App\Http\Controllers\PageController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\AlumniController;
use App\Http\Controllers\ReflectionController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'showLanding'])->name('landing');

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
