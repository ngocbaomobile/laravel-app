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