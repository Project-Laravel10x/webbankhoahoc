<?php

use Illuminate\Support\Facades\Route;
use Modules\Lessons\src\Http\Controllers\LessonController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'lessons'], function () {
        Route::get('/{courseId}', [LessonController::class, 'index'])->name('admin.lessons.index');
        Route::get('/{courseId}/create', [LessonController::class, 'create'])->name('admin.lessons.create');
        Route::post('/{courseId}/store', [LessonController::class, 'store'])->name('admin.lessons.store');
        Route::get('{courseId}/edit/{lessonId}', [LessonController::class, 'edit'])->name('admin.lessons.edit');
        Route::put('{courseId}/update/{lessonId}', [LessonController::class, 'update'])->name('admin.lessons.update');
        Route::delete('{courseId}/delete/{lessonId}', [LessonController::class, 'delete'])->name('admin.lessons.delete');
        Route::get('{courseId}/sort', [LessonController::class, 'sort'])->name('admin.lessons.sort');
        Route::post('{courseId}/sort', [LessonController::class, 'handleSort'])->name('admin.lessons.sort');
    });
});

