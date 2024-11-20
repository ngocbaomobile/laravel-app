<?php

use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\JsonResponse;

// return home view
Route::view('/', 'home');

Route::controller(ProductController::class)->prefix('products')->name('products.')->group(function () {

// return product view
    Route::get('/', 'index')->name('index');

// return create product view
    Route::get('/create', 'create')->name('create');

// create post route
    Route::post('/store',  'store')->name('store');

    Route::get('/{product}',  'showProduct')
        ->name('show');

    Route::get('/{product}/edit',  'edit')->name('edit');

    // not found page route

    Route::get('/notfound',  'notfoundView')->name('notfound');

    // update product route
    Route::patch('/{product}',  'update')->name('update');

    Route::delete('/{product}',  'destroy')->name('destroy');
});