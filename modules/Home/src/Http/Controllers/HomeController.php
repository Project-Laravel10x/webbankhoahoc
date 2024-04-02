<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\News\src\Repositories\NewsRepository;
use Modules\News\src\Repositories\NewsRepositoryInterface;
use Modules\Students\src\Repositories\StudentRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;
use Modules\User\src\Repositories\UserRepository;


class HomeController extends Controller
{

    protected CategoriesRepository $categoriesRepository;
    protected CoursesRepository $coursesRepository;
    protected TeacherRepository $teacherRepository;
    protected StudentRepository $studentRepository;
    protected LessonsRepository $lessonsRepository;
    protected UserRepository $userRepository;
    protected NewsRepository $newRepository;

    public function __construct(
        CategoriesRepositoryInterface $categoriesRepository,
        CoursesRepository             $coursesRepository,
        TeacherRepository             $teacherRepository,
        StudentRepository             $studentRepository,
        LessonsRepository             $lessonsRepository,
        UserRepository                $userRepository,
        NewsRepository                $newRepository,
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->coursesRepository = $coursesRepository;
        $this->teacherRepository = $teacherRepository;
        $this->studentRepository = $studentRepository;
        $this->lessonsRepository = $lessonsRepository;
        $this->userRepository = $userRepository;
        $this->newRepository = $newRepository;
    }

    public function index()
    {
        $pageTitle = "Trang chủ";
        $categoriesData = $this->categoriesRepository->getCategories()->toArray();
        $categoriesTop = $this->categoriesRepository->getAllCategories();
        $categories = getCategoriesTable($categoriesData);
        $courses = $this->coursesRepository->getAllCourses(
            Auth::guard('students')->user()->id, false
        )->toArray();
        $teachers = $this->teacherRepository->getAllTeacher();
        $students = $this->studentRepository->getAllStudents();
        $users = $this->userRepository->getUsers();
        $news = $this->newRepository->getAllNews();
        $data = compact(
            'pageTitle',
            'categories',
            'courses',
            'teachers',
            'students',
            'users',
            'news',
            'categoriesTop',
        );

        return view('home::home', $data);
    }

}
