<?php

use Illuminate\Support\Facades\Route;
use Modules\Courses\src\Http\Controllers\CourseController;

Route::group(['prefix' => 'admin', 'middleware' => 'web', 'name' => 'admin.'], function () {
    Route::group(['prefix' => 'courses', 'name' => 'courses.'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/data', [CourseController::class, 'data'])->name('data');

        Route::get('/create', [CourseController::class, 'create'])->name('create');

        Route::post('/store', [CourseController::class, 'store'])->name('store');
        Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
        Route::put('/update/{course}', [CourseController::class, 'update'])->name('update');
        Route::delete('/delete/{course}', [CourseController::class, 'delete'])->name('delete');

    });
});

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
