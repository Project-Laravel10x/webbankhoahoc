<?php

namespace Modules\Cart\src\Http\Controllers;

use App\Http\Controllers\Controller;
use Darryldecode\Cart\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Courses\src\Models\Course;

class CartController extends Controller
{


    public function showCart()
    {
        $pageTitle = "Quản lí giỏ hàng";

        $listCart = \Cart::getContent()->toArray();

        return view('cart::client.cart', compact('pageTitle', 'listCart'));
    }

    public function addToCart(Request $request)
    {
        $checkCourseRegistration = $this->checkCourseRegistration(
            Auth::guard('students')->user()->id ?? null,
            $request->course_id);

        if ($checkCourseRegistration) {
            return redirect()->route('students.myCourses')->with('msg', __('cart::messages.course_already_exists'));
        } else {
            \Cart::add(array(
                'id' => $request->course_id,
                'name' => $request->name,
                'price' => $request->price,
                'quantity' => 1,
                'attributes' => array(
                    'sale_price' => $request->sale_price,
                    'thumbnail' => $request->thumbnail,
                    'lesson' => $request->lesson,
                    'duration' => $request->duration,
                    'slug' => $request->slug,
                )
            ));
            return redirect()->route('cart.show')->with('msg', __('cart::messages.success'));
        }
    }

    public function removeCart(Request $request)
    {
        $courseId = $request->input('course_id');

        $userID = Auth::guard('students')->user()->id ?? 1;

        \Cart::remove($courseId);

        \Cart::session($userID)->remove($courseId);

        return redirect()->route('cart.show')->with('msg', __('cart::messages.success'));
    }

    public function clearCart(Request $request)
    {
        $userID = Auth::guard('students')->user()->id;

        \Cart::clear();
        \Cart::session($userID)->clear();

        return response()->json(['success' => true]);
    }

    public function checkCourseRegistration($student_id, $course_id)
    {
        $isRegistered = Course::whereHas('students', function ($query) use ($student_id) {
            $query->where('student_id', $student_id);
        })->where('id', $course_id)->exists();

        return $isRegistered;
    }


}
