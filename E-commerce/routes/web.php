<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoriesController;
use Illuminate\Support\Facades\Storage;

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
    Route::resource('products', \App\Http\Controllers\ProductController::class);

    Route::get('/categories', function () {
        return view('../admin/categories');
    })->name('categories');
    Route::resource('categories', \App\Http\Controllers\CategoriesController::class);
});

Route::get('/media/{path}', function (string $path) {
    $contents = Storage::disk('public')->get($path);
    $mimeType = (new \finfo(FILEINFO_MIME_TYPE))->buffer($contents);

    return response($contents, 200, ['Content-Type' => $mimeType]);
})->where('path', '.*')->name('media');

require __DIR__ . '/auth.php';

