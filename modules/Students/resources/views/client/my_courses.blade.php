@extends('layouts.client')

@section('content')

    <div class="course-student-header">
        <div class="container">
            <div class="student-group">
                <div class="course-group ">
                    <div class="course-group-img d-flex">
                        <a href=""><img
                                    src="data:image/png;base64,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"
                                    alt class="img-fluid"></a>
                        <div class="d-flex align-items-center">
                            <div class="course-name">
                                <h4>
                                    <a href="student-profile.html">{{ \Illuminate\Support\Facades\Auth::guard('students')->user()->name }}
                                </h4>
                                <p>Học viên</p>
                            </div>
                        </div>
                    </div>
                    <div class="course-share ">
                        <a href="javascript:void(0);" class="btn btn-primary">Cài đặt tài khoản</a>
                    </div>
                </div>
            </div>
            <div class="my-student-list">
                <ul>
                    <li><a class="" href="{{ route('students.dashBoard') }}">Bảng điều khiển</a></li>
                    <li><a href="{{ route('students.myCourses') }}">Khóa học của tôi</a></li>
                    <li><a href="course-message.html">Tin nhắn</a></li>
                </ul>
            </div>
        </div>
    </div>


    <section class="course-content">
        <div class="container">
            <div class="student-widget">
                <div class="student-widget-group">
                    <div class="row">
                        <div class="col-lg-12">

                            <div class="showing-list">

                            </div>

                            <div class="row">
                                @if(session('msg'))
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif
                                @foreach($courses as $course)
                                    <div class="col-xl-4 col-lg-4 col-md-6 d-flex">
                                        <div class="course-box course-design d-flex ">
                                            <div class="product">
                                                <div
                                                        class="product-img">
                                                    @if ($course && isset($course->lessons) && count($course->lessons) > 0)
                                                        <a href="{{ route('students.courseLesson',$course->lessons()->where('position', 1)->first()?->slug ?? '') }}">
                                                            <img class="img-fluid" alt
                                                                 src="{{ $course->thumbnail }}">
                                                        </a>
                                                    @endif
                                                </div>
                                                <div class="product-content">
                                                    <h3 class="title">
                                                        @if ($course && isset($course->lessons) && count($course->lessons) > 0)
                                                            <a href="{{ route('students.courseLesson', $course->lessons()->where('position', 1)->first()?->slug ?? '') }}">{{ $course->name }}</a>
                                                        @endif
                                                    </h3>
                                                    <div
                                                            class="course-info border-bottom-0 pb-0 d-flex align-items-center">
                                                        <div class="rating-img d-flex align-items-center">
                                                            <img src="/client/assets/img/icon/icon-01.svg" alt="">
                                                            <p>{{  count($course['lessons']) }} Bài giảng</p>
                                                        </div>
                                                        <div class="course-view d-flex align-items-center">
                                                            <img src="/client/assets/img/icon/icon-02.svg" alt="">
                                                            <p>{{ sumDurations($course)}}</p>
                                                        </div>
                                                    </div>
                                                    <div class="course-group-img d-flex mb-3">
                                                        <a href="#"><img
                                                                    src="/storage/photos/7/avatar-02.jpg" alt=""
                                                                    class="img-fluid"></a>
                                                        <div class="course-name">
                                                            <h4><a href="#">{{ $course->teachers->name }}</a>
                                                            </h4>
                                                            <p>Giảng viên</p>
                                                        </div>
                                                    </div>
                                                    <div class="start-leason d-flex align-items-center">
                                                        @if ($course && isset($course->lessons) && count($course->lessons) > 0)
                                                            <a href="{{ route('students.courseLesson',$course->lessons()->where('position', 1)->first()?->slug ?? '') }}"
                                                               class="btn btn-primary">VÀO HỌC NGAY</a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

