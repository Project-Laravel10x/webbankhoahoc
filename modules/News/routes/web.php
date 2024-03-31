<?php

use Illuminate\Support\Facades\Route;
use Modules\News\src\Http\Controllers\NewController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'news', 'middleware' => 'can:news'], function () {

        Route::get('/', [NewController::class, 'index'])
            ->name('admin.news.index');

        Route::get('/create', [NewController::class, 'create'])
            ->middleware('can:news.add')->name('admin.news.create');

        Route::post('/store', [NewController::class, 'store'])
            ->middleware('can:news.add')->name('admin.news.store');

        Route::get('/edit/{new}', [NewController::class, 'edit'])
            ->middleware('can:news.edit')->name('admin.news.edit');

        Route::put('/update/{new}', [NewController::class, 'update'])
            ->middleware('can:news.edit')->name('admin.news.update');

        Route::delete('/delete/{new}', [NewController::class, 'delete'])
            ->middleware('can:news.delete')->name('admin.news.delete');

    });
});

Route::group(['prefix' => 'tin-tuc'], function () {

    Route::get('/', [NewController::class, 'listAllNews'])
        ->name('listAllNews');

});


