<?php

namespace Modules\User\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Groups\src\Models\Group;
use Modules\User\src\Http\Requests\UserRequest;
use Modules\User\src\Models\User;
use Modules\User\src\Repositories\UserRepository;
use Modules\User\src\Repositories\UserRepositoryInterface;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{

    protected UserRepository $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function index()
    {

        $pageTitle = "Quản lí người dùng";
        $users = $this->userRepository->getAll();
        return view('user::list', compact('pageTitle', 'users'));
    }

    public function create()
    {
        $pageTitle = "Thêm người dùng";

        $groups = Group::all();

        return view('user::add', compact('pageTitle', 'groups'));
    }

    public function store(UserRequest $request)
    {

        $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'user_id' => Auth::user()->id,
            'password' => bcrypt($request->password),
        ]);

        return redirect()->route('admin.users.index')->with('msg', __('user::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa người dùng";
        $user = $this->userRepository->getOne($id);

        if (!$user) {
            abort('404');
        }

        return view('user::edit', compact('pageTitle', 'user'));
    }

    public function update(UserRequest $request, int $id)
    {
        $data = $request->except('_token', 'password', '_method');

        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $this->userRepository->update($id, $data);

        return redirect()->route('admin.users.edit', $id)->with('msg', __('user::messages.success'));
    }

    public function delete(int $id)
    {
        $this->userRepository->delete($id);
        return redirect()->route('admin.users.index')->with('msg', __('user::messages.success'));
    }

    public function test()
    {

    }
}
