<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AmenityController;
use Illuminate\Support\Facades\Route;

Route::get('/products/large', [ProductController::class, 'getLargeProducts']);

//login route
Route::post('/login', [AuthController::class, 'login']);


Route::prefix('amenities')->group(function () {
    Route::post('/', [AmenityController::class, 'store']);
    Route::put('/{id}', [AmenityController::class, 'update']);
    Route::delete('/{id}', [AmenityController::class, 'destroy']);
    Route::get('/', [AmenityController::class, 'index']);
});

// Lazy loading and Egear loading
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

Route::prefix('posts')->group(function () {
    Route::get('/', [PostController::class, 'index']);
    Route::post('/', [PostController::class, 'store']);
    Route::post('/comments', [CommentController::class, 'store']);
});


