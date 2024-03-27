<?php

use Illuminate\Support\Facades\Route;
use Modules\Categories\src\Http\Controllers\CategoryController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'categories', 'middleware' => 'can:categories'], function () {

        Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');

        Route::get('/create', [CategoryController::class, 'create'])
            ->middleware('can:categories.add')->name('admin.categories.create');

        Route::post('/store', [CategoryController::class, 'store'])
            ->middleware('can:categories.add')->name('admin.categories.store');

        Route::get('/edit/{category}', [CategoryController::class, 'edit'])
            ->middleware('can:categories.edit')->name('admin.categories.edit');

        Route::put('/update/{category}', [CategoryController::class, 'update'])
            ->middleware('can:categories.edit')->name('admin.categories.update');

        Route::delete('/delete/{category}', [CategoryController::class, 'delete'])
            ->middleware('can:categories.delete')->name('admin.categories.delete');
    });
});

Route::group(['prefix' => 'danh-muc'], function () {

    Route::get('/{slug}', [CategoryController::class, 'coursesList'])->name('courses.list');

    Route::get('/search/courses', [CategoryController::class, 'searchCourses'])->name('search.courses');

    Route::post('/search/filter-courses', [CategoryController::class, 'filterCourses'])->name('filter.courses');
});

