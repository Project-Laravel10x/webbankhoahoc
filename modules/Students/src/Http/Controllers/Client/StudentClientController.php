<?php

namespace Modules\Students\src\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Lessons\src\Models\Lesson;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepositoryInterface;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepositoryInterface;
use Modules\Students\src\Repositories\StudentRepositoryInterface;


class StudentClientController extends Controller
{

    protected StudentRepositoryInterface $studentRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected OrderDetailRepositoryInterface $orderDetailRepository;
    protected CoursesRepositoryInterface $courseRepository;
    protected LessonsRepositoryInterface $lessonRepository;

    public function __construct(
        StudentRepositoryInterface     $studentRepository,
        OrderRepositoryInterface       $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        CoursesRepositoryInterface     $courseRepository,
        LessonsRepositoryInterface     $lessonRepository,
    )
    {
        $this->studentRepository = $studentRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
    }

    public function dashBoard()
    {
        $pageTitle = 'Bảng điều khiển';

        $orders = $this->orderRepository->getAllOrdersByStudent(Auth::guard('students')->user()->id);

        $courses = $this->courseRepository->getAllCourses(Auth::guard('students')->user()->id);

        return view('students::client.dashboard', compact('pageTitle', 'orders', 'courses'));
    }


    public function listOrders()
    {
        $pageTitle = 'Danh sách đơn đặt';

        $orders = $this->orderRepository->getAllOrders();

        return view('students::client.list_orders', compact('pageTitle', 'orders'));
    }

    public function myCourses()
    {
        $pageTitle = 'Khóa học của bạn';

        $courses = $this->courseRepository->getAllCourses(Auth::guard('students')->user()->id);

        return view('students::client.my_courses', compact('pageTitle', 'courses'));
    }

    public function detailOrder($id)
    {
        $pageTitle = 'Chi tiết đơn hàng';

        $detailOrders = $this->orderDetailRepository->getOrdersDetailById($id);

        return view('students::client.detail_orders', compact('pageTitle', 'detailOrders'));
    }

    public function listStudents()
    {
        $pageTitle = 'Danh sách học viên';

        $students = $this->studentRepository->getAllStudentsPaginate(2);

        return view('students::client.students_list', compact('pageTitle', 'students'));
    }

    public function courseLesson($slug)
    {
        $studentId = Auth::guard('students')->user()->id;

        $courses = $this->courseRepository->getAllCourses($studentId);

        $lessonData = Lesson::where('slug', $slug)->firstOrFail();

        $isLessonInPurchasedCourse = $courses->contains('id', $lessonData['course_id']);

        if (!$isLessonInPurchasedCourse) {
            return back();
        }

        $lessonsData = $this->lessonRepository->getLessons($lessonData->courses->id)->toArray();

        $pageTitle = $lessonData->courses->name;

        return view('students::client.course_lesson', compact('pageTitle', 'lessonsData', 'lessonData'));
    }


}
