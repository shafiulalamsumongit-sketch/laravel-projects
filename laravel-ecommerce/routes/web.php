<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\CategoryController;
// use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TodoController;
// use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RolepermissionController;
use App\Http\Controllers\Admin\UserController;



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/dashboard-v2', function () {
    return view('dashboardv3');
})->middleware(['auth', 'verified'])->name('dashboard-v2');
Route::get('/dashboard-v3', function () {
    return view('dashboardv2', ['title' => 'Dashboard']);
});
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/todos', [TodoController::class, 'index'])->name('todos.index');
// Route::get('/users', [UserController::class, 'index'])->name('users-index');
// Route::get('/products', [ProductController::class, 'index'])->name('products-index');
Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/login-manual', [LoginController::class, 'show'])->name('login-manual');
Route::post('/login-manual', [LoginController::class, 'login']);
Route::post('/logout-manual', [LoginController::class, 'logout']);

// manual login with sanctum
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::post('login', [LoginController::class, 'login'])->middleware('throttle:login-custom'); // custom login + app service provider

Route::get('/users', [UserController::class, 'index'])->name('users-index');
Route::get('/users/list', [UserController::class, 'list']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::post('/users/{id}/update', [UserController::class, 'update']);
Route::delete('/users/{id}/delete', [UserController::class, 'destroy']);

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminLoginController::class, 'logout'])->name('logout');
    // Protected routes for admin gaurd
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        //Route::get('/products', [ProductController::class, 'index'])->name('products-index');
        // direct restrictions - no guard - role -permission needed
        Route::middleware(['role:super_admin'])->group(function () {
            Route::resource('admins', AdminController::class);
            Route::resource('roles', RoleController::class);
            Route::get('/roles/{role}/permissions', [RolepermissionController::class, 'edit'])->name('roles.permissions.edit');
            Route::post('/roles/{role}/permissions', [RolepermissionController::class, 'update'])->name('roles.permissions.update');
            Route::resource('permissions', PermissionController::class);
            Route::resource('users', UserController::class);
        });
    });
});  // Role Permission Matrix UI rolewise and model crude wise

use App\Http\Controllers\Vendor\Auth\VendorLoginController;

Route::prefix('vendor')->name('vendor.')->group(function () {
    Route::get('/login', [VendorLoginController::class, 'showLoginForm'])
        ->name('login');
    Route::post('/login', [VendorLoginController::class, 'login'])
        ->name('login.submit');
    Route::post('/logout', [VendorLoginController::class, 'logout'])
        ->name('logout');
    Route::middleware('auth:vendor')->group(function () {
        Route::get('/dashboard', function () {
            return view('vendor.dashboard');
        })->name('dashboard');
    });
});
// Route::middleware(['auth:vendor','role:vendor'])->group(function(){
// });
require __DIR__ . '/auth.php';
