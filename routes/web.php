<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Modules\User\src\Models\OnlineUser;
use Modules\User\src\Models\User;
use Shetabit\Visitor\Visitor;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function (Request $request) {
    //retrieve visitors and page view data for the current day and the last seven days
    $analyticsData = Analytics::fetchVisitorsAndPageViews(Period::days(7));
dd($analyticsData);

});
