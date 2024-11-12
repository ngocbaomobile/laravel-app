<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// return home view
Route::view('/', 'home');

// return product view
Route::get('/products', [ProductController::class, 'index']) -> name('products.index');

// return create product view
Route::get('/products/create',[ProductController::class,'create']) -> name('products.create');

// create post route
Route::post('/products/store', [ProductController::class, 'store']) -> name('products.store');

Route::get('/products/{product}', [ProductController::class, 'showProduct'])
 -> name('products.show');

 Route:: get('/products/{product}/edit', [ProductController::class, 'edit']) -> name('products.edit');

 // not found page route

 Route::get('/products/notfound', [ProductController::class, 'notfoundView']) -> name('products.notfound');

 // update product route
Route::patch('products/{product}', [ProductController::class, 'update']) -> name('products.update') -> name('products.update');