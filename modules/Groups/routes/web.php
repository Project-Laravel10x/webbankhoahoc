<?php

use Illuminate\Support\Facades\Route;
use Modules\Groups\src\Http\Controllers\GroupController;


Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'groups'], function () {
        Route::get('/', [GroupController::class, 'index'])->name('admin.groups.index');

        Route::get('/create', [GroupController::class, 'create'])->name('admin.groups.create');

        Route::post('/store', [GroupController::class, 'store'])->name('admin.groups.store');
        Route::get('/edit/{group}', [GroupController::class, 'edit'])->name('admin.groups.edit');
        Route::put('/update/{group}', [GroupController::class, 'update'])->name('admin.groups.update');
        Route::delete('/delete/{group}', [GroupController::class, 'delete'])->name('admin.groups.delete');

        Route::get('/permission/{group}', [GroupController::class, 'permissionView'])
            ->middleware('can:groups.permission')->name('admin.groups.permission_view');

        Route::post('/permission/{group}', [GroupController::class, 'permission'])
            ->middleware('can:groups.permission')->name('admin.groups.permission');
    });
});
