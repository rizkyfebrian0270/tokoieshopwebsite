<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

// Rute Publik (Login)
// Middleware 'guest' memastikan orang yang sudah login tidak bisa membuka halaman login lagi
Route::get('/login', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'processLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute Rahasia (Hanya bisa diakses jika SUDAH LOGIN)
Route::middleware('auth')->group(function () {
    
    // Pindahkan SEMUA rute adminmu ke dalam blok ini
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    
    // Dan rute-rute POST/PUT/DELETE lainnya...
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk halaman detail produk
Route::get('/produk/{id}', [\App\Http\Controllers\HomeController::class, 'show'])->name('product.detail');

Route::get('/cart', function () {
    return view('cart');
})->name('cart');

Route::get('/tentang-kami', function () {
    return view('about');
});

Route::get('/kontak', function () {
    return view('contact');
});

// Rute Halaman Katalog (Menampilkan semua produk)
Route::get('/katalog', [\App\Http\Controllers\HomeController::class, 'katalog'])->name('katalog');

Route::get('/admin/login', function () { return view('admin.login'); });
Route::get('/admin/dashboard', function () { return view('admin.dashboard'); });
Route::get('/admin/products', function () { return view('admin.products'); });
Route::get('/admin/categories', function () { return view('admin.categories'); });

// Rute Admin Panel (Menyambung ke Database)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/products', [AdminController::class, 'products']);
Route::get('/admin/categories', [AdminController::class, 'categories']);

// Rute Login (Bisa dibiarkan statis dulu untuk tampilan)
Route::get('/admin/login', function () { return view('admin.login'); });

// Rute untuk menerima data dari form popup
Route::post('/admin/categories/store', [AdminController::class, 'storeCategory'])->name('category.store');
Route::post('/admin/products/store', [AdminController::class, 'storeProduct'])->name('product.store');

// Rute untuk Kategori (Edit & Hapus)
Route::put('/admin/categories/{id}', [App\Http\Controllers\AdminController::class, 'updateCategory'])->name('category.update');
Route::delete('/admin/categories/{id}', [App\Http\Controllers\AdminController::class, 'destroyCategory'])->name('category.destroy');

// Rute untuk Produk (Edit & Hapus)
Route::put('/admin/products/{id}', [App\Http\Controllers\AdminController::class, 'updateProduct'])->name('product.update');
Route::delete('/admin/products/{id}', [App\Http\Controllers\AdminController::class, 'destroyProduct'])->name('product.destroy');
