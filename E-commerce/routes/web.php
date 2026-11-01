<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'home'])->name('home');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('../admin/dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/products', function () {
        return view('../admin/products');
    })->name('products');

    Route::get('/categories', function () {
        return view('../admin/categories');
    })->name('categories');
});

require __DIR__ . '/auth.php';

