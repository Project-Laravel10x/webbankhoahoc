<?php

namespace Modules\Client\src\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{

    public function loginForm()
    {
        if (Auth::guard('clients')->check()) {
            echo "Thành công";
            dd(Auth::guard('clients')->user()->toArray());
        }
        return view('client::auth.login');
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
            $checkLogin = Auth::guard('clients')->attempt($dataLogin);
            if ($checkLogin) {
                return redirect(RouteServiceProvider::CLIENT)->with('msg', __('client::messages.success'));
            }
            return back()->with('msg', __('client::messages.failed'));
        }
        return back()->with('msg', __('client::messages.is_invalid'));
    }

    public function logout()
    {
        Auth::guard('clients')->logout();
        return redirect()->route('clients.login');
    }

}
