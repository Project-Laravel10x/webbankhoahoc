<?php

use Illuminate\Support\Facades\Route;
use Modules\Home\src\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');



