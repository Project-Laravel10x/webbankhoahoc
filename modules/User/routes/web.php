<?php

use Illuminate\Support\Facades\Route;
use Modules\User\src\Http\Controllers\UserController;
use Modules\User\src\Models\User;

Route::group(['prefix' => 'admin'], function () {
        Route::group(['prefix' => 'users', 'middleware' => 'can:users'], function () {
        Route::get('/', [UserController::class, 'index'])->can('viewAny',User::class)->name('admin.users.index');

        Route::get('/create', [UserController::class, 'create'])->can('create',User::class)->name('admin.users.create');

        Route::post('/store', [UserController::class, 'store'])->name('admin.users.store');
        Route::get('/edit/{user}', [UserController::class, 'edit'])->name('admin.users.edit');
        Route::put('/update/{user}', [UserController::class, 'update'])->name('admin.users.update');
        Route::delete('/delete/{user}', [UserController::class, 'delete'])->name('admin.users.delete');

    });
});
