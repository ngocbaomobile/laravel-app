<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/products/large', [ProductController::class, 'getLargeProducts']);

//login route
Route::post('/login', [AuthController::class, 'login']);