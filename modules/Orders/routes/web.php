<?php

use Illuminate\Support\Facades\Route;
use Modules\Orders\src\Http\Controllers\OrderController;

Route::group(['prefix' => 'admin'], function () {
    Route::group(['prefix' => 'orders', 'middleware' => 'can:orders'], function () {

        Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/create', [OrderController::class, 'index'])->name('admin.orders.create');

        Route::get('/detail/{order}', [OrderController::class, 'detail'])->name('admin.orders.detail');

    });
});


Route::group(['prefix' => 'thanh-toan', 'middleware' => 'auth.client'], function () {

    Route::get('/test/{course_id}', [OrderController::class, 'checkThanhToan']);

    Route::post('/', [OrderController::class, 'thanhToan'])->name('thanhToan');

    Route::post('/momo_payment', [OrderController::class, 'thanhToanMomo'])->name('thanhToanMomo');

});

