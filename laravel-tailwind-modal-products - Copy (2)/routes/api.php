<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

use App\Http\Controllers\UserController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/me', fn(Request $r) => $r->user());

    Route::get('/orders', function () {
        return ['Order 1', 'Order 2'];
    });

    Route::post('/product-save', [ProductController::class, 'store']);
});

/* Route::middleware('auth:sanctum')->group(function () {
    Route::get('/users/list', [UserController::class, 'list']);

}); 
*/
/* Route::get('/users', [UserController::class, 'index']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']); 
*/
