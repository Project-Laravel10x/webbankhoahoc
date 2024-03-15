<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Http\Requests\CourseRequest;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;


class CourseController extends Controller
{

    protected CoursesRepository $courseRepository;
    protected CategoriesRepository $categoryRepository;
    protected TeacherRepository $teacherRepository;

    public function __construct(
        CoursesRepositoryInterface    $courseRepository,
        CategoriesRepositoryInterface $categoryRepository,
        TeacherRepositoryInterface    $teacherRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
        $this->teacherRepository = $teacherRepository;
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

        $categories = $this->categoryRepository->getCategoriesCreate();

        $teachers = $this->teacherRepository->getAllTeacher();

        return view('courses::add', compact('pageTitle', 'categories', 'teachers'));
    }

    public function store(CourseRequest $request)
    {
        $data = $request->except('_token', '_method');

        $data['price'] = $this->convestPrice($data['price']);
        $data['sale_price'] = $this->convestPrice($data['sale_price']);

        $course = $this->courseRepository->create($data);

        $categories = $this->getCategories($data);

        $this->courseRepository->createCoursesCategories($course, $categories);

        return redirect()->route('admin.courses.index')->with('msg', __('courses::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa khóa học";

        $course = $this->courseRepository->getOne($id);

        $categoryIds = $this->courseRepository->getRelatedCategories($course);

        $categories = $this->categoryRepository->getCategoriesCreate();

        $teachers = $this->teacherRepository->getAllTeacher();

        if (!$course) {
            abort('404');
        }

        return view('courses::edit', compact('pageTitle', 'course', 'categories', 'categoryIds', 'teachers'));
    }

    public function update(CourseRequest $request, int $id)
    {
        $data = $request->except('_token', '_method', 'categories');

        $data['price'] = $this->convestPrice($data['price']);
        $data['sale_price'] = $this->convestPrice($data['sale_price']);

        $this->courseRepository->update($id, $data);

        $categories = $this->getCategories($request->all());

        $course = $this->courseRepository->getOne($id);

        $this->courseRepository->updateCoursesCategories($course, $categories);

        return redirect()->route('admin.courses.edit', $id)->with('msg', __('courses::messages.success'));
    }

    public function delete(int $id)
    {
        $course = $this->courseRepository->getOne($id);

        $status = $this->courseRepository->delete($id);

        if ($status) {
            $image = $course->thumbnail;
            deleteFileStoge($image);
        }

        return redirect()->route('admin.courses.index')->with('msg', __('courses::messages.success'));
    }

    public function getCategories($data)
    {
        $categories = [];
        foreach ($data['categories'] as $category) {
            $categories[$category] = [
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s')
            ];
        }
        return $categories;
    }

    public function convestPrice($price)
    {
        if (!$price) {
            $newPrice = 0;
        } else {
            $newPrice = (float)$price;
        }
        return $newPrice;
    }
}
