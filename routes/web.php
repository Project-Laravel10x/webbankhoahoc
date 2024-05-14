<?php

use Dompdf\Dompdf;

use Illuminate\Support\Facades\Route;
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

Route::get('/test', function () {

    // instantiate and use the dompdf class
    $dompdf = new Dompdf();
    dd($dompdf);
    $dompdf->loadHtml('hello world');
    $dompdf->setPaper('A4', 'landscape');
    $dompdf->render();
    $dompdf->stream();
});
