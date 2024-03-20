<?php

use Illuminate\Support\Facades\Route;
use Modules\Client\src\Http\Controllers\Auth\RegisterController;
use Modules\Client\src\Http\Controllers\Auth\ResetPasswordController;
use Modules\Client\src\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Client\src\Http\Controllers\Auth\LoginController;
use Modules\Client\src\Http\Controllers\ClientController;


Route::group(['as' => 'clients.'], function () {

    Route::get('/thanh-toan', [ClientController::class, 'index'])->middleware('auth.client')->name('index');

    Route::get('/login', [LoginController::class, 'loginForm'])->middleware('guest:clients')->name('login');

    Route::post('/login', [LoginController::class, 'login'])->middleware('guest:clients')->name('login');

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');

    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.client')->name('logout');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('forgot_password');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('forgot_password');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('reset_password');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('update_password');

});
