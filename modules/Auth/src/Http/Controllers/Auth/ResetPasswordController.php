<?php

namespace Modules\Auth\src\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    public function showResetForm(Request $request)
    {
        $pageTitle = 'Reset Password';

        $token = $request->route()->parameter('token');
        return view('auth::admin.auth.passwords.reset',compact('pageTitle'))->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        // Validate the request data
        $request->validate([
            'password_old' => ['required', 'string', 'min:6'],
            'password_new' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        // Retrieve the authenticated user
        $clients = $request->all();
        dd($clients);

        // Check if the old password matches the user's current password
        if (!Hash::check($request->password_old, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không chính xác.');
        }

        // Update the user's password with the new one
        $user->update([
            'password' => Hash::make($request->password_new),
        ]);

        // Redirect the user back with a success message
        return redirect()->route('home')->with('success', 'Mật khẩu đã được đặt lại thành công.');
    }


}
