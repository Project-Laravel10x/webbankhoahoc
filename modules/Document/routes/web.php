<?php

use Illuminate\Support\Facades\Route;
use Modules\Lessons\src\Http\Controllers\LessonController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'lessons'], function () {
        Route::get('/{courseId}', [LessonController::class, 'index'])->name('admin.lessons.index');
        Route::get('/create', [LessonController::class, 'create'])->name('admin.lessons.create');

        Route::post('/store', [LessonController::class, 'store'])->name('admin.lessons.store');
        Route::get('/edit/{course}', [LessonController::class, 'edit'])->name('admin.lessons.edit');
        Route::put('/update/{course}', [LessonController::class, 'update'])->name('admin.lessons.update');
        Route::delete('/delete/{course}', [LessonController::class, 'delete'])->name('admin.lessons.delete');

    });
});

