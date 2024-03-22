<?php

use Illuminate\Support\Facades\Route;
use Modules\News\src\Http\Controllers\NewController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'news'], function () {
        Route::get('/', [NewController::class, 'index'])->name('admin.news.index');

        Route::get('/create', [NewController::class, 'create'])->name('admin.news.create');

        Route::post('/store', [NewController::class, 'store'])->name('admin.news.store');
        Route::get('/edit/{new}', [NewController::class, 'edit'])->name('admin.news.edit');
        Route::put('/update/{new}', [NewController::class, 'update'])->name('admin.news.update');
        Route::delete('/delete/{new}', [NewController::class, 'delete'])->name('admin.news.delete');

    });
});
