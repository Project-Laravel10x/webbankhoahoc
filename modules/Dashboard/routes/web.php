<?php

use Illuminate\Support\Facades\Route;
use Modules\Dashboard\src\Http\Controllers\DashboardController;

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::post('/filterData', [DashboardController::class, 'filterData'])->name('admin.filterData');
    Route::post('/dashboardFilter', [DashboardController::class, 'dashboardFilter'])->name('admin.dashboardFilter');
    Route::post('/filterDataNow', [DashboardController::class, 'filterDataNow'])->name('admin.filterDataNow');
});
