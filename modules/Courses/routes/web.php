<?php

use Illuminate\Support\Facades\Route;
use Modules\Courses\src\Http\Controllers\CourseController;

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'courses', 'middleware' => 'can:courses'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');

        Route::get('/create', [CourseController::class, 'create'])
            ->middleware('can:courses.add')->name('admin.courses.create');

        Route::post('/store', [CourseController::class, 'store'])
            ->middleware('can:courses.add')->name('admin.courses.store');

        Route::get('/edit/{course}', [CourseController::class, 'edit'])
            ->middleware('can:courses.edit')->name('admin.courses.edit');

        Route::put('/update/{course}', [CourseController::class, 'update'])
            ->middleware('can:courses.edit')->name('admin.courses.update');

        Route::delete('/delete/{course}', [CourseController::class, 'delete'])
            ->middleware('can:courses.delete')->name('admin.courses.delete');

    });
});

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
