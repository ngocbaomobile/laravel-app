<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/products/large', [ProductController::class, 'getLargeProducts']);

