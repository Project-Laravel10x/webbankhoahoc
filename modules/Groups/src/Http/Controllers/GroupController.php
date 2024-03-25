<?php

namespace Modules\Groups\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Groups\src\Models\Group;
use Modules\Groups\src\Models\Module;
use Modules\Groups\src\Repositories\GroupRepository;
use Modules\User\src\Models\User;


class GroupController extends Controller
{

    protected GroupRepository $groupRepository;

    public function __construct(GroupRepository $groupRepository)
    {
        $this->groupRepository = $groupRepository;
    }

    public function index()
    {

        $pageTitle = "Quản lí phân quyền";

        if (Auth::user()->group_id == 1) {
            $groups = $this->groupRepository->getAllGroups();
        } else {
            $groups[] = $this->groupRepository->getOne(Auth::user()->group_id);
        }

        return view('groups::list', compact('pageTitle', 'groups'));
    }

    public function create()
    {
        $pageTitle = "Thêm phân quyền";

        return view('groups::add', compact('pageTitle'));
    }

    public function store(Request $request)
    {
        $this->groupRepository->create([
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'permission' => null,
        ]);

        return redirect()->route('admin.groups.index')->with('msg', __('groups::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa phân quyền";
        $group = $this->groupRepository->getOne($id);

        if (!$group) {
            abort('404');
        }

        return view('groups::edit', compact('pageTitle', 'group'));
    }

    public function update(Request $request, $id)
    {
        $this->groupRepository->update($id, [
            'name' => $request->name,
            'user_id' => Auth::user()->id,
            'permission' => null,
        ]);

        return redirect()->route('admin.groups.edit', $id)->with('msg', __('groups::messages.success'));
    }

    public function delete($id)
    {
        $this->groupRepository->delete($id);
        return redirect()->route('admin.groups.index')->with('msg', __('groups::messages.success'));
    }

    public function permissionView(Group $group)
    {
        $pageTitle = "Phân quyền nhóm: $group->name";

        $modules = Module::all();

        $roleListArr = [
            'view' => 'Xem',
            'add' => 'Thêm',
            'edit' => 'Sửa',
            'delete' => 'Xóa',
        ];

        $roleJson = $group->permissions;

        if (!empty($roleJson)) {
            $roleArr = json_decode($roleJson, true);
        } else {
            $roleArr = [];
        }


        return view('groups::permission', compact('pageTitle', 'modules', 'roleListArr', 'roleArr'));

    }

    public function permission(Group $group, Request $request)
    {

        if (!empty($request->role)) {
            $roleArr = $request->role;
        } else {
            $roleArr = [];
        }

        $roleJson = json_encode($roleArr);

        $group->permissions = $roleJson;
        $group->save();

        return back()->with('msg', __('groups::messages.success'));

    }
}
