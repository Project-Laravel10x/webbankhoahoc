<?php

namespace Modules\Lessons\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Lessons\src\Http\Requests\LessonRequest;
use Modules\Lessons\src\Models\Lesson;
use Modules\Lessons\src\Repositories\LessonsRepository;


class LessonController extends Controller
{

    protected LessonsRepository $lessonsRepository;
    protected CoursesRepository $coursesRepository;

    public function __construct(
        LessonsRepository $lessonsRepository,
        CoursesRepository $coursesRepository
    )
    {
        $this->lessonsRepository = $lessonsRepository;
        $this->coursesRepository = $coursesRepository;
    }

    public function index(int $courseId)
    {

        $course = $this->coursesRepository->getOne($courseId);

        $pageTitle = "Quản lí bài giảng: $course->name";

        return view('lessons::list', compact('pageTitle'));
    }

    public function create()
    {
        $pageTitle = "Thêm bài giảng";

        $categories = $this->categoryRepository->getCategoriesCreate();

        $teachers = $this->teacherRepository->getAllTeacher();

        return view('courses::add', compact('pageTitle', 'categories', 'teachers'));
    }

    public function store(LessonRequest $request)
    {
        $data = $request->except('_token', '_method');

        $data['price'] = $this->convestPrice($data['price']);
        $data['sale_price'] = $this->convestPrice($data['sale_price']);

        $course = $this->lessonsRepository->create($data);

        $categories = $this->getCategories($data);

        $this->lessonsRepository->createCoursesCategories($course, $categories);

        return redirect()->route('admin.courses.index')->with('msg', __('courses::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa bài giảng";

        $course = $this->lessonsRepository->getOne($id);

        $categoryIds = $this->lessonsRepository->getRelatedCategories($course);

        $categories = $this->categoryRepository->getCategoriesCreate();

        $teachers = $this->teacherRepository->getAllTeacher();

        if (!$course) {
            abort('404');
        }

        return view('courses::edit', compact('pageTitle', 'course', 'categories', 'categoryIds', 'teachers'));
    }

    public function update(LessonRequest $request, int $id)
    {
        $data = $request->except('_token', '_method', 'categories');

        $data['price'] = $this->convestPrice($data['price']);
        $data['sale_price'] = $this->convestPrice($data['sale_price']);

        $this->lessonsRepository->update($id, $data);

        $categories = $this->getCategories($request->all());

        $course = $this->lessonsRepository->getOne($id);

        $this->lessonsRepository->updateCoursesCategories($course, $categories);

        return redirect()->route('admin.courses.edit', $id)->with('msg', __('courses::messages.success'));
    }

    public function delete(int $id)
    {
        $course = $this->lessonsRepository->getOne($id);

        $status = $this->lessonsRepository->delete($id);

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
