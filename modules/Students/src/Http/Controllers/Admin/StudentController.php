<?php

namespace Modules\Students\src\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Modules\Courses\src\Models\Course;
use Modules\Students\src\Http\Requests\StudentRequest;
use Modules\Students\src\Repositories\StudentRepository;


class StudentController extends Controller
{

    protected StudentRepository $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí học viên";

        $students = $this->studentRepository->getAllStudents();

        return view('students::admin.list', compact('pageTitle', 'students'));
    }

    public function create()
    {
        $pageTitle = "Thêm học viên";

        return view('students::admin.add', compact('pageTitle'));
    }

    public function store(StudentRequest $request, $course = null)
    {

        $data = $request->except('_token', '_method');

        $data['password'] = Hash::make($data['password']);

        $student = $this->studentRepository->create($data);

        if ($course) {

            $course = Course::find($course);

            if (!$course) {
                return redirect()->route('admin.students.list_student_by_course', $course)
                    ->with('error', __('Khóa học không tồn tại'));
            }

            $this->studentRepository->createStudentsCourses($student, $course);

            return redirect()->route('admin.students.list_student_by_course', $course)
                ->with('msg', __('students::messages.success'));
        }

        return redirect()->route('admin.students.index')->with('msg', __('students::messages.success'));
    }

    public function edit(int $id)
    {
        $pageTitle = "Sửa học viên";

        $student = $this->studentRepository->getOne($id);

        if (!$student) {
            abort('404');
        }

        return view('students::admin.edit', compact('pageTitle', 'student'));
    }

    public function update(StudentRequest $request, int $id)
    {
        $data = $request->except('_token', '_method');

        $data['password'] = Hash::make($data['password']);

        $this->studentRepository->update($id, $data);

        return redirect()->route('admin.students.edit', $id)->with('msg', __('students::messages.success'));
    }

    public function delete($studentId, $courseId = null)
    {
        $student = $this->studentRepository->getOne($studentId);
        if ($courseId) {

            $this->studentRepository->deleteStudentsCourses($student, $courseId);

            return redirect()->route('admin.students.list_student_by_course', $courseId)
                ->with('msg', __('students::messages.success'));
        }

        $this->studentRepository->delete($studentId);

        return redirect()->route('admin.students.index')->with('msg', __('students::messages.success'));
    }


    public function listStudentsByCourseId($course)
    {
        $courses = Course::find($course);

        $pageTitle = 'Quản lí học viên của khóa: ' . $courses['name'];

        return view('students::admin.list_students_by_course_id', compact('courses', 'pageTitle'));
    }


    public function createStudentsByCourseId($course)
    {
        $courses = Course::find($course);

        $pageTitle = 'Thêm học viên của khóa: ' . $courses['name'];

        return view('students::admin.create_students_by_course_id', compact('courses', 'pageTitle'));
    }

}
