<?php

namespace Modules\Dashboard\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Orders\src\Models\Order;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Students\src\Repositories\StudentRepository;

class DashboardController extends Controller
{
    protected CoursesRepository $courseRepository;
    protected StudentRepository $studentRepository;
    protected OrderRepository $orderRepository;

    public function __construct(
        CoursesRepository $courseRepository,
        StudentRepository $studentRepository,
        OrderRepository   $orderRepository
    )
    {
        $this->courseRepository = $courseRepository;
        $this->studentRepository = $studentRepository;
        $this->orderRepository = $orderRepository;
    }

    public function index()
    {
        $pageTitle = "Dashboard";
        $courses = $this->courseRepository->getAllCourses();
        $students = $this->studentRepository->getAllStudents();
        $orders = $this->orderRepository->getAllOrders();

        return view('dashboard::dashboard', compact(
            'pageTitle', 'courses', 'students', 'orders',
        ));
    }

    public function filterData(Request $request)
    {
        $fromDate = $request->formDate;
        $toDate = $request->toDate;

        $orders = Order::select('orders.*', 'students.name as student_name')
            ->join('students', 'orders.student_id', '=', 'students.id')
            ->whereBetween('orders.created_at', [$fromDate, $toDate])
            ->get();

        foreach ($orders as $value) {
            $chart_data[] = [
                'total' => $value->total,
                'student_id' => $value->student_name,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
            ];
        }
        return response()->json($chart_data);
    }

    public function filterDataNow()
    {
        $sevenDaysAgo = Carbon::now()->subDays(7)->toDateString();

        $orders = Order::whereBetween('created_at', [$sevenDaysAgo, now()])->get();

        foreach ($orders as $value) {
            $chart_data[] = [
                'total' => $value->total,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
            ];
        }
        return response()->json($chart_data);
    }

    public function dashboardFilter(Request $request)
    {
        $firstDayCurrentMonth = Carbon::now()->startOfMonth()->toDateString();
        $firstDayPreviousMonth = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $lastDayPreviousMonth = Carbon::now()->startOfMonth()->subDay()->toDateString();
        $sevenDaysAgo = Carbon::now()->subDays(7)->toDateString();
        $threeSixtyFiveDaysAgo = Carbon::now()->subDays(365)->toDateString();
        $now = Carbon::now()->toDateString();

        if ($request->dashboardValue == '7ngay') {
            $orders = Order::whereBetween('created_at', [$sevenDaysAgo, $now])->get();
        } else if ($request->dashboardValue == 'thangtruoc') {
            $orders = Order::whereBetween('created_at', [$firstDayPreviousMonth, $lastDayPreviousMonth])->get();
        } else if ($request->dashboardValue == 'thangnay') {
            $orders = Order::whereBetween('created_at', [$firstDayCurrentMonth, $now])->get();
        } else {
            $orders = Order::whereBetween('created_at', [$threeSixtyFiveDaysAgo, $now])->get();
        }

        foreach ($orders as $value) {
            $chartData[] = [
                'total' => $value->total,
                'created_at' => Carbon::parse($value->created_at)->format('Y-m-d'),
            ];
        }
        return response()->json($chartData);
    }

}
