<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderManagementController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SocialController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Ganti rute ini dari 'dashboard' menjadi 'home'
Route::get('/', [HomeController::class, 'index'])->name('home');

// Rute untuk halaman About
Route::view('/about', 'about')->name('about');

// Rute untuk menampilkan detail produk
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show');

// Rute untuk menampilkan semua produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Rute untuk produk berdasarkan kategori
Route::get('/category/{category}', [ProductController::class, 'category'])->name('products.category');

// Rute untuk pencarian produk
Route::get('/search', [ProductController::class, 'search'])->name('products.search');

// Rute untuk Socialite OAuth - Redirect
Route::get('/auth/{provider}', [SocialController::class, 'redirectToProvider'])->name('socialite.redirect')->where('provider', 'google|facebook|github');

// Rute untuk Socialite OAuth - Callback (specific routes first)
Route::get('/auth/google/callback', [SocialController::class, 'handleProviderCallback'])->name('google.callback');
Route::get('/auth/{provider}/callback', [SocialController::class, 'handleProviderCallback'])->name('socialite.callback')->where('provider', 'facebook|github');

// Rute untuk Keranjang Belanja
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'store'])->name('cart.store');
    
    // Rute baru: Menggunakan POST untuk update dan delete
    Route::post('/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove', [CartController::class, 'destroy'])->name('cart.destroy');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup rute yang membutuhkan Login
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/orders/history', [CheckoutController::class, 'history'])->name('checkout.history');
    
    // Rute Riwayat Pesanan (Order History)
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Rute yang hanya dapat diakses oleh Petugas Rutan (Admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard Admin
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Manajemen Pesanan
    Route::get('/orders', [OrderManagementController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderManagementController::class, 'show'])->name('orders.show');
    Route::post('/orders/{id}/update-status', [OrderManagementController::class, 'updateStatus'])->name('orders.updateStatus');
    
    // Manajemen Produk (CRUD)
    Route::resource('products', AdminProductController::class)->except(['show']);
    
    // Manajemen Kategori (CRUD)
    Route::resource('categories', CategoryController::class);
});

require __DIR__.'/auth.php';