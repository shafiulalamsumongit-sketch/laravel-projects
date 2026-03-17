<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReviewController;
use Illuminate\Support\Facades\Route;

// Admin auth
Route::get('/admin/login', fn() => view('admin.auth.login'))->name('admin.login');
Route::post('/admin/login', [DashboardController::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [DashboardController::class, 'logout'])->name('admin.logout');

// Protected admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('products',   ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders',     OrderController::class)->only(['index', 'show', 'update']);
    Route::resource('customers',  CustomerController::class)->only(['index', 'show']);
    Route::resource('reviews',    ReviewController::class)->only(['index', 'update', 'destroy']);

    Route::post('orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.status');
});
