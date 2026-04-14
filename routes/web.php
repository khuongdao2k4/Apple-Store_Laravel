<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return redirect('/home');
});

// Static Pages
Route::get('/home', [PageController::class, 'home'])->name('home');
Route::get('/mac', [PageController::class, 'mac'])->name('mac');
Route::get('/store', [PageController::class, 'store'])->name('store');
Route::get('/mua-iphone', [PageController::class, 'muaIphone'])->name('mua-iphone');
Route::get('/bag', [PageController::class, 'bag'])->name('bag');

// Auth Flow
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/reset-password', [AuthController::class, 'showResetPassword'])->name('reset-password');

// Order Flow
Route::get('/order', [OrderController::class, 'order'])->name('order');
Route::post('/process-order', [OrderController::class, 'processOrder'])->name('process-order');
Route::get('/order-detail', [OrderController::class, 'orderDetail'])->name('order-detail');

// Admin / Products (we will map these as simple placeholders for now)
Route::match(['get', 'post'], '/add-product', [PageController::class, 'addProduct'])->name('add-product');
Route::match(['get', 'post'], '/edit-product', [PageController::class, 'editProduct'])->name('edit-product');
Route::match(['get', 'post'], '/delete-product', [PageController::class, 'deleteProduct'])->name('delete-product');
Route::get('/statistics', [PageController::class, 'statistics'])->name('statistics');
