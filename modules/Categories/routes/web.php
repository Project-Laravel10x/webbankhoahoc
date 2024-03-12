<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');

        Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');

        Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('/edit/{category}', [CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('/update/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])->name('admin.categories.delete');

    });
});
