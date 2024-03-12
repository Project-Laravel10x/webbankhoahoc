<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin', 'middleware' => 'web', 'name' => 'admin.'], function () {
    Route::group(['prefix' => 'categories', 'name' => 'categories.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/data', [CategoryController::class, 'data'])->name('data');

        Route::get('/create', [CategoryController::class, 'create'])->name('create');

        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('delete');

    });
});
