<?php

use Illuminate\Support\Facades\Route;
use Modules\Teacher\src\Http\Controllers\TeacherController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'teachers', 'middleware' => 'can:teachers'], function () {

        Route::get('/', [TeacherController::class, 'index'])->name('admin.teachers.index');

        Route::get('/create', [TeacherController::class, 'create'])
            ->middleware('can:teachers.add')->name('admin.teachers.create');

        Route::post('/store', [TeacherController::class, 'store'])
            ->middleware('can:teachers.add')->name('admin.teachers.store');

        Route::get('/edit/{teacher}', [TeacherController::class, 'edit'])
            ->middleware('can:teachers.edit')->name('admin.teachers.edit');

        Route::put('/update/{teacher}', [TeacherController::class, 'update'])
            ->middleware('can:teachers.edit')->name('admin.teachers.update');

        Route::delete('/delete/{teacher}', [TeacherController::class, 'delete'])
            ->middleware('can:teachers.delete')->name('admin.teachers.delete');

    });
});
