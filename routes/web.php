<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\PageController;

// Auth Routes
Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Admin Routes (Protected)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::delete('products/{product}/gallery/{index}', [App\Http\Controllers\Admin\ProductController::class, 'deleteGalleryImage'])->name('products.gallery.destroy');
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
});

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index'); // Updated to use ProductController
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show'); // New Product Details Route
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
