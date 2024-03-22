<?php

use Illuminate\Support\Facades\Route;
use Modules\NewsCategories\src\Http\Controllers\NewCategoryController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'news_categories'], function () {

        Route::get('/', [NewCategoryController::class, 'index'])->name('admin.news_categories.index');

        Route::get('/create', [NewCategoryController::class, 'create'])->name('admin.news_categories.create');

        Route::post('/store', [NewCategoryController::class, 'store'])->name('admin.news_categories.store');
        Route::get('/edit/{new_category}', [NewCategoryController::class, 'edit'])->name('admin.news_categories.edit');
        Route::put('/update/{new_category}', [NewCategoryController::class, 'update'])->name('admin.news_categories.update');
        Route::delete('/delete/{new_category}', [NewCategoryController::class, 'delete'])->name('admin.news_categories.delete');
    });
});

