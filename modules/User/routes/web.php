<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'users'], function () {
        Route::get('/', [UserController::class, 'index'])->name('admin.users.index');
        Route::get('/data', [UserController::class, 'data'])->name('admin.users.data');

        Route::get('/create', [UserController::class, 'create'])->name('admin.users.create');

        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('admin.users.delete');

    });
});
