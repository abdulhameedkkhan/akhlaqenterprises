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
    
    // Restricted to admin only
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
        Route::delete('products/{product}/gallery/{index}', [App\Http\Controllers\Admin\ProductController::class, 'deleteGalleryImage'])->name('products.gallery.destroy');
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::resource('gallery', App\Http\Controllers\Admin\GalleryController::class);
    });

    // Accessible by admin and contact_viewer
    Route::middleware(['role:admin,contact_viewer'])->group(function () {
        Route::get('/contact-submissions', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'index'])->name('contact_submissions.index');
        Route::get('/contact-submissions-data', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'data'])->name('contact_submissions.data');
        Route::get('/contact-submissions/{submission}', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'show'])->name('contact_submissions.show');
        Route::post('/contact-submissions/{submission}/toggle-read', [App\Http\Controllers\Admin\ContactSubmissionController::class, 'toggleRead'])->name('contact_submissions.toggle_read');
    });
});

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/products', [App\Http\Controllers\ProductController::class, 'index'])->name('products.index'); // Updated to use ProductController
Route::get('/products/{slug}', [App\Http\Controllers\ProductController::class, 'show'])->name('products.show'); // New Product Details Route
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');
