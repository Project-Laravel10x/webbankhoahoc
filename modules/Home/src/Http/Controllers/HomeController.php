<?php

namespace Modules\Home\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Categories\src\Repositories\CategoriesRepository;
use Modules\Categories\src\Repositories\CategoriesRepositoryInterface;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Lessons\src\Repositories\LessonsRepository;
use Modules\Students\src\Repositories\StudentRepository;
use Modules\Teacher\src\Repositories\TeacherRepository;


class HomeController extends Controller
{

    protected CategoriesRepository $categoriesRepository;
    protected CoursesRepository $coursesRepository;
    protected TeacherRepository $teacherRepository;
    protected StudentRepository $studentRepository;
    protected LessonsRepository $lessonsRepository;

    public function __construct(
        CategoriesRepositoryInterface $categoriesRepository,
        CoursesRepository             $coursesRepository,
        TeacherRepository             $teacherRepository,
        StudentRepository             $studentRepository,
        LessonsRepository             $lessonsRepository,
    )
    {
        $this->categoriesRepository = $categoriesRepository;
        $this->coursesRepository = $coursesRepository;
        $this->teacherRepository = $teacherRepository;
        $this->studentRepository = $studentRepository;
        $this->lessonsRepository = $lessonsRepository;
    }

    public function index()
    {
        $pageTitle = "Trang chủ";

        $categories = $this->categoriesRepository->getAllCategories();

        $courses = $this->coursesRepository->getAllCourses()->toArray();

        $teachers = $this->teacherRepository->getAllTeacher();

        $students = $this->studentRepository->getAllStudents();

        $data = compact(
            'pageTitle',
            'categories',
            'courses',
            'teachers',
            'students',
        );

        return view('home::home', $data);
    }


}
