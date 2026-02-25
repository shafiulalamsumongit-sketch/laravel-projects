<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


use App\Http\Controllers\Auth\LoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard-v2', function () {
    return view('dashboardv2');
})->middleware(['auth', 'verified'])->name('dashboard-v2');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/todos', [TodoController::class, 'index'])
    ->name('todos.index');

Route::get('/users', [UserController::class, 'index'])->name('users-index');
Route::get('/users/list', [UserController::class, 'list']);
Route::post('/users/store', [UserController::class, 'store']);
Route::get('/users/{id}/edit', [UserController::class, 'edit']);
Route::post('/users/{id}/update', [UserController::class, 'update']);
Route::delete('/users/{id}/delete', [UserController::class, 'destroy']);

// routes/web.php
Route::get('/products', [ProductController::class, 'index'])->name('products-index');
//Route::post('/products', [ProductController::class, 'store']);
Route::get('/categories', [CategoryController::class, 'index']);


Route::get('/login-manual', [LoginController::class, 'show'])->name('login-manual');
Route::post('/login-manual', [LoginController::class, 'login']);
Route::post('/logout-manual', [LoginController::class, 'logout']);

//manual login with sanctum
Route::post('logout', [LoginController::class, 'logout'])
        ->name('logout');
        
Route::post('login', [LoginController::class, 'login']);

require __DIR__.'/auth.php';
