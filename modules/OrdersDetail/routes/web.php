<?php

use Illuminate\Support\Facades\Route;
use Modules\NewsCategories\src\Http\Controllers\NewCategoryController;
use Modules\Orders\src\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'news_categories','middleware' => 'can:news_categories'], function () {

        Route::get('/', [NewCategoryController::class, 'index'])->name('admin.news_categories.index');
        Route::get('/create', [NewCategoryController::class, 'create'])
            ->middleware('can:news_categories.add')->name('admin.news_categories.create');

        Route::post('/store', [NewCategoryController::class, 'store'])
            ->middleware('can:news_categories.add')->name('admin.news_categories.store');

        Route::get('/edit/{new_category}', [NewCategoryController::class, 'edit'])
            ->middleware('can:news_categories.edit')->name('admin.news_categories.edit');

        Route::put('/update/{new_category}', [NewCategoryController::class, 'update'])
            ->middleware('can:news_categories.edit')->name('admin.news_categories.update');

        Route::delete('/delete/{new_category}', [NewCategoryController::class, 'delete'])
            ->middleware('can:news_categories.delete')->name('admin.news_categories.delete');

    });
});

    Route::group(['prefix' => 'thanh-toan'], function () {

    Route::get('/test', [OrderController::class, 'checkThanhToan']);

    Route::post('/', [OrderController::class, 'thanhToan'])->name('thanhToan');

    Route::post('/momo_payment', [OrderController::class, 'thanhToanMomo'])->name('thanhToanMomo');

});

