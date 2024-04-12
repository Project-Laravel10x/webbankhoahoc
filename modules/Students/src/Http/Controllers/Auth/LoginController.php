<?php

namespace Modules\Students\src\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\UpdateStudentStatus;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Students\src\Models\Student;
use Modules\User\src\Models\OnlineUser;


class LoginController extends Controller
{

    public function loginForm()
    {
        if (Auth::guard('students')->check()) {
            echo "Thành công";
            dd(Auth::guard('students')->user()->toArray());
        }
        return view('students::auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ], [
            'email.required' => 'Vui lòng nhập địa chỉ email.',
            'email.email' => 'Địa chỉ email không hợp lệ.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.min' => 'Mật khẩu phải chứa ít nhất :min ký tự.',
        ]);
        $dataLogin = $request->except('_token');
        if (isClientActive($dataLogin['email'])) {
            $checkLogin = Auth::guard('students')->attempt($dataLogin);
            if ($checkLogin) {
                OnlineUser::updateOrCreate(['student_id' => Auth::guard('students')->user()->id], ['last_activity' => now()]);
                return redirect(RouteServiceProvider::CLIENT)->with('msg', __('students::messages.success'));
            }
            return back()->with('msg', __('students::messages.login.failed'));
        }
        return back()->with('msg', __('students::messages.is_invalid'));
    }

    public function logout()
    {
        Auth::guard('students')->user()->is_online = 0;
        Auth::guard('students')->logout();
        return redirect()->route('students.login');
    }

}
