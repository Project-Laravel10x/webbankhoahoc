<?php

use Darryldecode\Cart\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Modules\Cart\src\Http\Controllers\CartController;


Route::group(['prefix' => 'gio-hang','middleware' => 'auth.client'], function () {

    Route::get('/', [CartController::class, 'showCart'])->name('cart.show');
    Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('addToCart');
    Route::post('/update-cart', [CartController::class, 'updateCart'])->name('updateCart');
    Route::post('/remove-cart', [CartController::class, 'removeCart'])->name('removeCart');
    Route::get('/clear-cart', [CartController::class, 'clearCart'])->name('clearCart');

});

