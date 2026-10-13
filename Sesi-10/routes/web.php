<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');

Route::get('/products', function () {
    return 'ini route products';
});

Route::get('/checkout', function () {
    return 'ini route checkout' ;
});


Route::resource('products-resource', \App\Http\Controllers\ProductController::class);
