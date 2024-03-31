<?php

namespace Modules\Categories\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Categories\src\Http\Requests\CategoryRequest;
use Modules\Categories\src\Models\Category;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Models\Course;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\Teacher\src\Repositories\TeacherRepositoryInterface;


class CategoryController extends Controller
{

    protected CategoriesRepository $categoriesRepository;
    protected TeacherRepository $teacherRepository;
    protected LessonsRepository $lessonRepository;
    protected CoursesRepository $coursesRepository;

    public function __construct(
        CategoriesRepositoryInterface $categoriesRepository,
        TeacherRepositoryInterface    $teacherRepository,
        LessonsRepositoryInterface    $lessonRepository,
        CoursesRepositoryInterface    $coursesRepository,
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->teacherRepository = $teacherRepository;
        $this->lessonRepository = $lessonRepository;
        $this->coursesRepository = $coursesRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí danh mục";
        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = getCategoriesTable($categoriesData);

        return view('categories::admin.list', compact('pageTitle', 'categories'));
    }


    public function create()
    {
        $pageTitle = "Thêm danh mục";
        $categories = $this->categoriesRepository->getCategoriesCreate();
        return view('categories::admin.add', compact('pageTitle', 'categories'));
    }

    public function store(CategoryRequest $request)
    {
        $data = $request->except('_token', '_method');

        $this->categoriesRepository->create($data);

        return redirect()->route('admin.categories.index')->with('msg', __('categories::messages.success'));
    }


    public function edit(int $id)
    {
        $pageTitle = "Sửa danh mục";
        $category = $this->categoriesRepository->getOne($id);
        $categories = $this->categoriesRepository->getAllCategories();
        if (!$category) {
            abort('404');
        }


        return view('categories::admin.edit', compact('pageTitle', 'category', 'categories'));
    }

    public function update(CategoryRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');

        $this->categoriesRepository->update($id, $data);

        return redirect()->route('admin.categories.edit', $id)->with('msg', __('categories::messages.success'));
    }

    public function delete(int $id)
    {
        $category = $this->categoriesRepository->getOne($id);

        $this->categoriesRepository->deleteCourses($category);

        $this->categoriesRepository->delete($id);

        return redirect()->route('admin.categories.index')->with('msg', __('categories::messages.success'));
    }


    public function coursesList($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = getCategoriesTable($categoriesData);

        if (!$category) {
            abort(404);
        }

        $courses = $category->courses()->paginate(4);

        $coursesNews = $this->coursesRepository->getAllCourses(Auth::guard('students')->user()->id, false)->toArray();

        return view('categories::client.courses-list',
            compact('category', 'courses', 'categories', 'coursesNews'));
    }

    public function coursesGroup($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        if (!$category) {
            abort(404);
        }

        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = getCategoriesTable($categoriesData);

        $courses = $category->courses()->paginate(4);

        return view('categories::client.courses-group',
            compact('category', 'courses', 'categories'));
    }


    public function searchCourses(Request $request)
    {
        $search = $request->input('search');

        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categories = getCategoriesTable($categoriesData);

        $teachers = $this->teacherRepository->getAllTeacher();

        $coursesNews = $this->coursesRepository->getAllCourses()->toArray();

        $query = Course::query();

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");

        }

        $courses = $query->paginate(4);

        $category = '';

        return view('categories::client.courses-list',
            compact('courses', 'teachers', 'category', 'categories', 'coursesNews'));
    }

    public function filterCourses(Request $request)
    {
        $selectedCategories = $request->input('categories', []);

        $courses = $this->coursesRepository->filterDataCourses($selectedCategories);

        return response()->json($courses);
    }
}
