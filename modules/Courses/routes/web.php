<?php

use Illuminate\Support\Facades\Route;
use Modules\Courses\src\Http\Controllers\CourseController;

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'courses'], function () {
        Route::get('/', [CourseController::class, 'index'])->name('admin.courses.index');

        Route::get('/create', [CourseController::class, 'create'])->name('admin.courses.create');

        Route::post('/store', [CourseController::class, 'store'])->name('admin.courses.store');
        Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('admin.courses.edit');
        Route::put('/update/{course}', [CourseController::class, 'update'])->name('admin.courses.update');
        Route::delete('/delete/{course}', [CourseController::class, 'delete'])->name('admin.courses.delete');

    });
});

Route::group(['prefix' => 'filemanager'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});
