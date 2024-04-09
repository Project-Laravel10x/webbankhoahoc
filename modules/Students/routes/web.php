<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use Modules\Students\src\Http\Controllers\Admin\StudentController;
use Modules\Students\src\Http\Controllers\Auth\RegisterController;
use Modules\Students\src\Http\Controllers\Auth\ResetPasswordController;
use Modules\Students\src\Http\Controllers\Auth\ForgotPasswordController;
use Modules\Students\src\Http\Controllers\Auth\LoginController;
use Modules\Students\src\Http\Controllers\Client\StudentClientController;
use Modules\Students\src\Http\Controllers\ClientController;


Route::group(['as' => 'students.'], function () {

    Route::get('/chinh-sach-quyen-rieng-tu', function () {
        return "<h1>Chính sách quyền riêng tư</h1>";
    });

    Route::get('/thanh-toan1', [ClientController::class, 'index'])->middleware('auth.client')->name('index');

    Route::get('/login', [LoginController::class, 'loginForm'])->middleware('guest:students')->name('login');

    Route::post('/login', [LoginController::class, 'login'])->middleware('guest:students')->name('login');

    Route::get('/login/facebook/callback', function () {
        return 12222;
    });

    Route::get('/login/facebook', function () {
        return Socialite::driver('facebook')->redirect();
    });

    Route::get('/login/google/callback', function () {
        $user = Socialite::driver('google')->user();
        dd($user);
    });

    Route::get('/login/google', function () {
        return Socialite::driver('google')->redirect();
    });

    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest:students')->name('register');

    Route::post('/register', [RegisterController::class, 'register'])->middleware('guest:students')->name('register');

    Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth.client')->name('logout');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('forgot_password');

    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('forgot_password');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('reset_password');

    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('update_password');


    Route::group(['prefix' => 'trang-ca-nhan', 'middleware' => 'auth.client'], function () {

        Route::get('/chinh-sua-trang-ca-nhan', [StudentClientController::class, 'editProfile'])->name('editProfile');

        Route::post('/chinh-sua-trang-ca-nhan', [StudentClientController::class, 'updateProFile'])
            ->name('updateProFile');

        Route::get('/xoa-trang-ca-nhan', [StudentClientController::class, 'viewDeteleProFile'])
            ->name('viewDeteleProFile');

        Route::delete('/xoa-trang-ca-nhan', [StudentClientController::class, 'deleteProFile'])->name('deleteProFile');

        Route::get('/bang-dieu-khien', [StudentClientController::class, 'dashBoard'])->name('dashBoard');

        Route::get('/tin-nhan', [StudentClientController::class, 'viewMessage'])->name('viewMessage');

        Route::get('/danh-sach-don-hang', [StudentClientController::class, 'listOrders'])->name('listOrders');

        Route::get('/khoa-hoc-cua-ban', [StudentClientController::class, 'myCourses'])->name('myCourses');

        Route::get('/bai-giang/{slug}', [StudentClientController::class, 'courseLesson'])->name('courseLesson');

        Route::post('/download-file', [StudentClientController::class, 'downloadFile'])->name('downloadFile');

        Route::get('/chi-tiet-don-hang/{order}', [StudentClientController::class, 'detailOrder'])->name('detailOrder');

    });

    Route::get('/danh-sach-hoc-vien', [StudentClientController::class, 'listStudents'])
        ->middleware('auth.client')->name('listStudent');

});


Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'students', 'middleware' => 'can:students'], function () {

        Route::get('/', [StudentController::class, 'index'])->name('admin.students.index');

        Route::get('/create', [StudentController::class, 'create'])
            ->middleware('can:students.add')->name('admin.students.create');

        Route::post('/store', [StudentController::class, 'store'])
            ->middleware('can:students.add')->name('admin.students.store');

        Route::get('/edit/{student}', [StudentController::class, 'edit'])
            ->middleware('can:students.edit')->name('admin.students.edit');

        Route::put('/update/{student}', [StudentController::class, 'update'])
            ->middleware('can:students.edit')->name('admin.students.update');

        Route::delete('/delete/{student}', [StudentController::class, 'delete'])
            ->middleware('can:students.delete')->name('admin.students.delete');

    });

    Route::get('/{course}/students', [StudentController::class, 'listStudentsByCourseId'])
        ->middleware('can:students')->name('admin.students.list_student_by_course');

    Route::get('/{course}/students/create', [StudentController::class, 'createStudentsByCourseId'])
        ->middleware('can:students.add')->name('admin.students.create_student_by_course');

    Route::post('/{course}/students/store', [StudentController::class, 'store'])
        ->middleware('can:students.add')->name('admin.students.store_student_by_course');

    Route::delete('/students/delete/{student}/course/{course}', [StudentController::class, 'delete'])
        ->middleware('can:students.delete')->name('admin.students.delete_student_by_course');

});

