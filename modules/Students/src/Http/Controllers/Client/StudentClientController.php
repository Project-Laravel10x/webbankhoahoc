<?php

namespace Modules\Students\src\Http\Controllers\Client;

use App\Events\EditProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\Document\src\Repositories\DocumentRepositoryInterface;
use Modules\Lessons\src\Models\Lesson;
use Modules\Lessons\src\Repositories\LessonsRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepositoryInterface;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepositoryInterface;
use Modules\Students\src\Http\Requests\StudentEditProfileRequest;
use Modules\Students\src\Models\Student;
use Modules\Students\src\Repositories\StudentRepositoryInterface;


class StudentClientController extends Controller
{

    protected StudentRepositoryInterface $studentRepository;
    protected OrderRepositoryInterface $orderRepository;
    protected OrderDetailRepositoryInterface $orderDetailRepository;
    protected CoursesRepositoryInterface $courseRepository;
    protected LessonsRepositoryInterface $lessonRepository;
    protected DocumentRepositoryInterface $documentRepository;

    public function __construct(
        StudentRepositoryInterface     $studentRepository,
        OrderRepositoryInterface       $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        CoursesRepositoryInterface     $courseRepository,
        LessonsRepositoryInterface     $lessonRepository,
        DocumentRepositoryInterface    $documentRepository,
    )
    {
        $this->studentRepository = $studentRepository;
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->courseRepository = $courseRepository;
        $this->lessonRepository = $lessonRepository;
        $this->documentRepository = $documentRepository;
    }

    public function dashBoard()
    {
        $orders = $this->orderRepository->getAllOrdersByStudent(Auth::guard('students')->user()->id);
        $courses = $this->courseRepository->getAllCourses(Auth::guard('students')->user()->id);

        return view('students::client.dashboard', compact('orders', 'courses'));
    }


    public function editProfile()
    {
        $student = $this->studentRepository->getOne(Auth::guard('students')->user()->id);

        return view('students::client.setting_edit_profile', compact('student'));
    }

    public function updateProFile(StudentEditProfileRequest $request)
    {
        $id = Auth::guard('students')->user()->id;
        $student = $this->studentRepository->getOne($id);

        if (empty($request->old_password)) {
            $password = $student->password;
        } else {
            $password = Hash::make($request->password);
        }

        $data = [
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'password' => $password,
        ];

        $student = $this->studentRepository->update($id, $data);

        EditProfile::dispatch($student);

        return redirect()->route('students.editProfile')->with('msg', __('students::messages.success'));
    }

    public function viewDeteleProFile()
    {
        return view('students::client.setting_delete_profile');
    }

    public function deleteProFile()
    {
        $student = Student::find(Auth::guard('students')->user()->id);

        $student->update(['is_active' => 0]);

        return redirect()->route('students.logout');
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

    public function viewMessage()
    {
        return view('students::client.message');
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

        $buttonPrevAndNext = $this->lessonRepository->getPreviousAndNextLesson($lessonData);
        $lessonsData = $this->lessonRepository->getLessons($lessonData->courses->id)->toArray();
        $pageTitle = $lessonData->courses->name;

        return view('students::client.course_lesson',
            compact('pageTitle', 'lessonsData', 'lessonData', 'buttonPrevAndNext', 'courses'));
    }

    public function downloadFile(Request $request)
    {
        $document = $this->documentRepository->getOne($request->document_id);

        if (!empty($document)) {

            $fileName = $document->name;
            $filePath = public_path() . '/' . trim($document->url, '/');

            if (file_exists($filePath)) {
                return response()->download($filePath, $fileName);
            } else {
                abort(500);
            }

        } else {
            abort(404);
        }
    }


}
