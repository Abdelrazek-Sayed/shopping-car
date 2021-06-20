<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::prefix('user')->group(function () {


    Route::middleware('guest')->group(function () {
        Route::get('/register', [UserController::class, 'getRegister'])->name('get.register');
        Route::post('/register', [UserController::class, 'postRegister'])->name('register');
        Route::get('/login', [UserController::class, 'getLogin'])->name('get.login');
        Route::post('/login', [UserController::class, 'postLogin'])->name('login');
    });


    Route::middleware('auth')->group(function () {
        Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
        Route::get('/logout', [UserController::class, 'Logout'])->name('logout');
    });
});


Route::middleware('auth')->group(function () {
    Route::resources([
        'product' => ProductController::class,
    ]);

    Route::get('/add_to_cart/{id}', [ProductController::class, 'AddToCart'])->name('add.to.cart');
    Route::get('/show_cart', [ProductController::class, 'showCart'])->name('cart.show');

    Route::get('checkout', [ProductController::class, 'Checkout'])->name('cart.checkout');
    Route::post('charge', [ProductController::class, 'Charge'])->name('cart.charge');
});
