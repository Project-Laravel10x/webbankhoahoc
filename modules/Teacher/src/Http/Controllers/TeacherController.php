<?php

namespace Modules\Teacher\src\Http\Controllers;

use App\Events\CourseTeacherCreated;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Modules\Teacher\src\Http\Requests\TeacherRequest;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;

class TeacherController extends Controller
{

    protected TeacherRepository $teacherRepository;

    public function __construct(TeacherRepositoryInterface $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí giảng viên";

        $teachers = $this->teacherRepository->getAllTeacher();


        return view('teacher::list', compact('pageTitle', 'teachers'));
    }

    public function create()
    {
        $pageTitle = "Thêm giảng viên";
        return view('teacher::add', compact('pageTitle'));
    }

    public function store(TeacherRequest $request)
    {
        $data = $request->except('_token', '_method');

        $this->teacherRepository->create($data);

        return redirect()->route('admin.teachers.index')->with('msg', __('teacher::messages.success'));
    }


    public function edit(int $id)
    {
        $pageTitle = "Sửa giảng viên";

        $teacher = $this->teacherRepository->getOne($id);

        if (!$teacher) {
            abort('404');
        }

        return view('teacher::edit', compact('pageTitle', 'teacher'));
    }

    public function update(TeacherRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');

        $this->teacherRepository->update($id, $data);

        return redirect()->route('admin.teachers.edit', $id)->with('msg', __('teacher::messages.success'));
    }

    public function delete(int $id)
    {
        $teacher = $this->teacherRepository->getOne($id);

        $status = $this->teacherRepository->delete($id);

        if ($status) {
            $image = $teacher->image;
            deleteFileStoge($image);
        }

        return redirect()->route('admin.teachers.index')->with('msg', __('teacher::messages.success'));
    }


}
