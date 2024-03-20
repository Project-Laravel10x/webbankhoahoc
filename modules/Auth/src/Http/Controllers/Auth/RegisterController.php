<?php

namespace Modules\Auth\src\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Modules\User\src\Models\User;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ], [
            'required' => ':attribute bắt buộc phải nhập !',
            'string' => ':attribute phải là ký tự !',
            'max' => ':attribute không được lớn hơn :max ký tự !',
            'min' => ':attribute không được nhỏ hơn :min ký tự !',
            'email' => ':attribute không đúng định dạng !',
            'unique' => ':attribute đã tồn tại trên hệ thống !',
            'same' => ':attribute không khớp với mật khẩu !',
        ], [
            'name' => 'Họ và tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'confirm_password' => 'Xác nhận mật khẩu'
        ]);
    }


    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'group_id' => 0,
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        $pageTitle = "Đăng ký";
        return view('auth::admin.auth.register', compact('pageTitle'));
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

//        $this->guard()->login($user);

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect("/register")->with('msg',__('auth::messages.register'));
    }

}
