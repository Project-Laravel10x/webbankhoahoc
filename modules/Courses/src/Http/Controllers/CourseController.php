<?php

namespace Modules\Courses\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Http\Requests\CourseRequest;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;
use Modules\Video\src\Models\Video;


class CourseController extends Controller
{

    protected CoursesRepository $courseRepository;
    protected CategoriesRepository $categoryRepository;
    protected TeacherRepository $teacherRepository;
    protected LessonsRepository $lessonRepository;

    public function __construct(
        CoursesRepositoryInterface    $courseRepository,
        CategoriesRepositoryInterface $categoryRepository,
        TeacherRepositoryInterface    $teacherRepository,
        LessonsRepository             $lessonRepository,
    )
    {
        $this->courseRepository = $courseRepository;
        $this->categoryRepository = $categoryRepository;
        $this->teacherRepository = $teacherRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí khóa học";

        $courses = $this->courseRepository->getAll();

        return view('courses::admin.list', compact('pageTitle', 'courses'));
    }

    public function create()
    {
        $pageTitle = "Thêm khóa học";

        $categories = $this->categoryRepository->getCategoriesCreate();

        $teachers = $this->teacherRepository->getAllTeacher();

        return view('courses::admin.add', compact('pageTitle', 'categories', 'teachers'));
    }

    public function store(CourseRequest $request)
    {
        $data = $request->except('_token', '_method');

        $data['price'] = convestPrice($data['price']);
        $data['sale_price'] = convestPrice($data['sale_price']);

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

        return view('courses::admin.edit', compact('pageTitle', 'course', 'categories', 'categoryIds', 'teachers'));
    }

    public function update(CourseRequest $request, int $id)
    {
        $data = $request->except('_token', '_method', 'categories');

        $data['price'] = convestPrice($data['price']);
        $data['sale_price'] = convestPrice($data['sale_price']);

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


    public function courseDetail($slug)
    {
        $course = Course::where('slug', $slug)->firstOrFail();

        if (!$course) {
            abort(404);
        }

        $teacher = $this->teacherRepository->getOne($course->teachers->id);

        $courses = $teacher->courses;

        $category = $course->categories()->first();

        $lessonsData = $this->lessonRepository->getLessons($course->id)->toArray();



        return view('courses::client.course-details',
            compact('course',
                'teacher',
                'lessonsData',
                'category',
                'courses',
            ));
    }
}
