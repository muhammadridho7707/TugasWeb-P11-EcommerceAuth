<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ---------- Publik ----------
Route::get('/', [ProductController::class, 'index'])->name('home');

// ---------- Harus login (semua role) ----------
Route::middleware('auth')->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // Profile (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Order milik user sendiri
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

    // Posts: semua yang login boleh melihat daftar
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

    // Posts: kelola -> hanya admin & editor (middleware) + PostPolicy (ownership)
    Route::middleware('role:admin,editor')->group(function () {
        Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
        Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    });
});

// ---------- Khusus admin ----------
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/eager-demo', [AdminDashboardController::class, 'eagerDemo'])->name('eager-demo');
});

require __DIR__.'/auth.php';