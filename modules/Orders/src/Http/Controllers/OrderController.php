<?php

namespace Modules\Orders\src\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Mail\PayTheBillMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Modules\Cart\src\Http\Controllers\CartController;
use Modules\Courses\src\Repositories\CoursesRepository;
use Modules\Courses\src\Repositories\CoursesRepositoryInterface;
use Modules\NewsCategories\src\Http\Requests\NewsCategoryRequest;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepository;
use Modules\NewsCategories\src\Repositories\NewsCategoriesRepositoryInterface;
use Modules\Orders\src\Repositories\OrderRepository;
use Modules\Orders\src\Repositories\OrderRepositoryInterface;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepository;
use Modules\OrdersDetail\src\Repositories\OrderDetailRepositoryInterface;
use Modules\Students\src\Models\StudentCourse;

class OrderController extends Controller
{

    protected OrderRepository $orderRepository;
    protected OrderDetailRepository $orderDetailRepository;
    protected CoursesRepository $courseRepository;

    public function __construct(
        OrderRepositoryInterface       $orderRepository,
        OrderDetailRepositoryInterface $orderDetailRepository,
        CoursesRepositoryInterface     $courseRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->orderDetailRepository = $orderDetailRepository;
        $this->courseRepository = $courseRepository;
    }

    public function index()
    {
        $pageTitle = "Quản lí đơn đặt";

        $orders = $this->orderRepository->getAllOrders();

        return view('orders::admin.list', compact('pageTitle', 'orders'));
    }

    public function detail($id)
    {
        $pageTitle = "Chi tiết đơn đặt";

        $detailOrders = $this->orderDetailRepository->getOrdersDetailById($id);

        return view('orders::admin.detail', compact('pageTitle', 'detailOrders'));
    }


    public function thanhToan(Request $request)
    {
        $pageTitle = "Thanh toán";

        $checkCourseRegistration = (new CartController())->checkCourseRegistration(
            Auth::guard('students')->user()->id,
            $request->course_id);

        if ($checkCourseRegistration) {
            return redirect()->route('students.myCourses')->with('msg', __('cart::messages.course_already_exists'));
        }

        if (!$request->isMethod('post')) {
            abort(404);
        }

        $dataCart = $request->all();

        return view('orders::client.thanh_toan', compact('pageTitle', 'dataCart'));
    }


    public function thanhToanMomo(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = 'MOMOBKUN20180529';
        $accessKey = 'klm05TvNBzhg7h7j';
        $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
        $orderInfo = "Thanh toán qua ATM MoMo";
        $amount = $request->total;
        $orderId = time() . "";
        $redirectUrl = "http://127.0.0.1:8000/thanh-toan/test/" . $request->course_id ?? null;
        $ipnUrl = "http://127.0.0.1:8000/thanh-toan/test/" . $request->course_id ?? null;
        $extraData = "";


        $requestId = time() . "";
        $requestType = "payWithATM";

        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
        $signature = hash_hmac("sha256", $rawHash, $secretKey);
        $data = array('partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature);

        $result = $this->execPostRequest($endpoint, json_encode($data));

        $jsonResult = json_decode($result, true);  // decode json

        return redirect()->to($jsonResult['payUrl']);
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    public function checkThanhToan(Request $request, $course_id = null)
    {
        $resultCode = $request->input('resultCode');

        if ($resultCode == 0) {
            $userID = Auth::guard('students')->user()->id;

            if ($course_id != null) {
                $dataInsert = $this->courseRepository->getCourseById($course_id)->toArray();
            } else {
                $dataInsert = \Cart::getContent()->toArray();
            }

            $this->createOrderAndOrderDetailAndStudentCourse($dataInsert, $userID);

            $contentAndData = [
                'subject' => 'Dreams LMS',
                'body' => 'Bạn đã thanh toán hóa đơn thành công !',
                'listCart' => $dataInsert,
                'user' => Auth::guard('students')->user(),
            ];

            Mail::to(Auth::guard('students')->user()->email)->send(new PayTheBillMail($contentAndData));

            \Cart::clear();
            \Cart::session($userID)->clear();

            return redirect()->route('students.dashBoard')->with('msg', __('orders::messages.success'));

        } else {
            return redirect()->route('students.dashBoard')->with('msg_fail', __('orders::messages.failed'));
        }
    }

    public function createOrderAndOrderDetailAndStudentCourse($dataInsert, $userID)
    {

        if (isset($dataInsert[0]['teacher_id'])) {
            $total = checkSalePrice($dataInsert[0]['price'], $dataInsert[0]['sale_price']);
            $createOrder = $this->orderRepository->create([
                'student_id' => Auth::guard('students')->user()->id,
                'total' => $total,
                'status' => 1,
            ]);
        } else {
            $total = sumCart($dataInsert);
            $createOrder = $this->orderRepository->create([
                'student_id' => Auth::guard('students')->user()->id,
                'total' => $total,
                'status' => 1,
            ]);
        }

        foreach ($dataInsert as $orderDetail) {

            if (isset($orderDetail['teacher_id'])) {
                $price = checkSalePrice($orderDetail['price'], $orderDetail['sale_price']);
            } else {
                $price = checkSalePrice($orderDetail['price'], $orderDetail['attributes']['sale_price']);
            }

            $this->orderDetailRepository->create([
                'order_id' => $createOrder->id,
                'course_id' => $orderDetail['id'],
                'price' => $price,
            ]);

            StudentCourse::create([
                'student_id' => $userID,
                'course_id' => $orderDetail['id'],
            ]);
        }
    }

    public function thanhToanVnPay(Request $request)
    {
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan/test/" . $request->course_id ?? null;
        $vnp_TmnCode = "74YGUA4Z";//Mã website tại VNPAY
        $vnp_HashSecret = "OUXZGKLBCBEYBWAOAPSISCJZSGUBJOLC"; //Chuỗi bí mật

        $vnp_TxnRef =  time() . "";
        $vnp_OrderInfo = "Thanh toán VnPay";
        $vnp_OrderType = "billpayment";
        $vnp_Amount = $request->total * 100;
        $vnp_Locale = 'vn';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array('code' => '00'
        , 'message' => 'success'
        , 'data' => $vnp_Url);
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }
}
