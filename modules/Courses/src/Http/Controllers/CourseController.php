<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Courses\src\Http\Requests\CourseRequest;
use Modules\Courses\src\Repositories\CoursesRepository;


class CourseController extends Controller
{

    protected CoursesRepository $courseRepository;

    public function __construct(CoursesRepository $courseRepository)
    {
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí khóa học";
        $courses = $this->courseRepository->getAll();

        return view('courses::list', compact('pageTitle', 'courses'));
    }

    public function create()
    {
        $pageTitle = "Thêm khóa học";
        return view('courses::add', compact('pageTitle'));
    }

    public function store(CourseRequest $request)
    {
        $this->courseRepository->create([
            'name' => $request->name,
            'slug' => $request->slug,
            'teacher_id' => $request->teacher_id,
            'code' => $request->code,
            'price' => $request->price ?? 0,
            'sale_price' => $request->sale_price ?? 0,
            'is_document' => $request->is_document,
            'status' => $request->status,
            'detail' => $request->detail,
            'support' => $request->support,
            'thumbnail' => $request->thumbnail,
        ]);

        return redirect()->route('index')->with('msg', __('courses::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa khóa học";
        $course = $this->courseRepository->getOne($id);

        if (!$course) {
            abort('404');
        }

        return view('courses::edit', compact('pageTitle', 'course'));
    }

    public function update(CourseRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');


        $this->courseRepository->update($id, $data);

        return redirect()->route('edit', $id)->with('msg', __('courses::messages.success'));
    }

    public function delete(int $id)
    {
        $this->courseRepository->delete($id);
        return redirect()->route('index')->with('msg', __('courses::messages.success'));
    }
}
