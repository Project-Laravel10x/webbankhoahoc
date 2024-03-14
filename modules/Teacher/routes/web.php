<?php

use Illuminate\Support\Facades\Route;
use Modules\Teacher\src\Http\Controllers\TeacherController;

Route::group(['prefix' => 'admin', 'middleware' => 'web'], function () {
    Route::group(['prefix' => 'teachers'], function () {
        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');

        Route::get('/create', [TeacherController::class, 'create'])->name('admin.teachers.create');

        Route::post('/store', [TeacherController::class, 'store'])->name('admin.teachers.store');
        Route::get('/edit/{teacher}', [TeacherController::class, 'edit'])->name('admin.teachers.edit');
        Route::put('/update/{teacher}', [TeacherController::class, 'update'])->name('admin.teachers.update');
        Route::delete('/delete/{teacher}', [TeacherController::class, 'delete'])->name('admin.teachers.delete');

    });
});
