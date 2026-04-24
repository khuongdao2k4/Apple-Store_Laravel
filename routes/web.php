<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;

Route::get('/', function () {
    return redirect('/home');
});

// Static Pages
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/mac', [PageController::class, 'mac'])->name('mac');
Route::get('/store', [PageController::class, 'store'])->name('store');
Route::get('/mua-iphone', [PageController::class, 'muaIphone'])->name('mua-iphone');
Route::get('/bag', [CartController::class, 'index'])->name('bag');
Route::get('/api/search', [PageController::class, 'search'])->name('api.search');
Route::get('/mua-mac', [PageController::class, 'muaMac'])->name('mua-mac');
Route::get('/config-mac/{id}', [PageController::class, 'configMac'])->name('config-mac');

// Auth Flow
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');

// Order Flow
Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::post('/cart-add', [CartController::class, 'add'])->name('cart-add');
Route::post('/cart-update', [CartController::class, 'updateQuantity'])->name('cart-update');
Route::post('/cart-remove', [CartController::class, 'remove'])->name('cart-remove');
Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::post('/process-order', [OrderController::class, 'processOrder'])->name('process-order');
Route::get('/vnpay-return', [OrderController::class, 'vnpayReturn'])->name('vnpay-return');
Route::post('/vnpay-ipn', [OrderController::class, 'vnpayIPN'])->name('vnpay-ipn');
Route::get('/order-detail', [OrderController::class, 'orderDetail'])->name('order-detail');
Route::get('/delete-order', [OrderController::class, 'deleteOrder'])->name('delete-order');

// Admin Section
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [\App\Http\Controllers\AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/order/update-status', [\App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.order.update-status');
    Route::get('/products', [\App\Http\Controllers\AdminController::class, 'products'])->name('admin.products');
    
    // Product Management
    Route::get('/add-product', [\App\Http\Controllers\AdminController::class, 'addProduct'])->name('add-product');
    Route::post('/store-product', [\App\Http\Controllers\AdminController::class, 'storeProduct'])->name('store-product');
    Route::get('/edit-product/{id}', [\App\Http\Controllers\AdminController::class, 'editProduct'])->name('edit-product');
    Route::post('/update-product', [\App\Http\Controllers\AdminController::class, 'updateProduct'])->name('update-product');
    Route::post('/delete-product', [\App\Http\Controllers\AdminController::class, 'deleteProduct'])->name('delete-product');
    
    Route::get('/statistics', [\App\Http\Controllers\AdminController::class, 'statistics'])->name('statistics');
});
