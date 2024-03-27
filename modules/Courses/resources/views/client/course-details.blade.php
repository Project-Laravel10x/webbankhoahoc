@extends('layouts.client')

@section('content')


        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="breadcrumb-list">
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Khóa học</li>
                                    {{--                                    <li class="breadcrumb-item" aria-current="page">All Courses</li>--}}
                                    <li class="breadcrumb-item" aria-current="page">{{ $course->name }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="inner-banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="instructor-wrap border-bottom-0 m-0">
                            <div class="about-instructor align-items-center">
                                <div class="abt-instructor-img">
                                    <a href="instructor-profile.html"><img src="{{ $teacher->image }}" alt="img"
                                                                           class="img-fluid"></a>
                                </div>
                                <div class="instructor-detail me-3">
                                    <h5><a href="instructor-profile.html">{{ $teacher->name }}</a></h5>
                                    <p>{{ $teacher->exp }} năm kinh nghiệm</p>
                                </div>

                            </div>
                            <span class="web-badge mb-3">{{ $category->name }}</span>
                        </div>
                        <h2>{{ $course->name }}</h2>
                        <p>{{ $course->shoft_description }}</p>
                        <div class="course-info d-flex align-items-center border-bottom-0 m-0 p-0">
                            <div class="cou-info">
                                <img src="{{ asset('client/assets/img/icon/icon-01.svg') }}" alt>
                                <p>{{ countLessons($course['lessons']) }} Bài Giảng</p>

                            </div>
                            <div class="cou-info">
                                <img src="{{ asset('client/assets/img/icon/timer-icon.svg') }}" alt>
                                <p>{{ sumDurations($course)  }}</p>
                            </div>
                            <div class="cou-info">
                                <img src="{{ asset('client/assets/img/icon/people.svg') }}" alt>
                                <p>32 students enrolled</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="page-content course-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">

                        <div class="card overview-sec">
                            <div class="card-body">
                                <p>{!! $course->detail !!} </p>
                            </div>
                        </div>


                        <div class="card content-sec">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="subs-title">Nội dung khóa học</h5>
                                    </div>
                                    <div class="col-sm-6 text-sm-end">
                                        <h6><strong>{{ countLessons($course['lessons']) }} Bài
                                                giảng</strong> {{ sumDurations($course)  }}</h6>
                                    </div>
                                </div>
                                @foreach($lessonsData as $key => $lesson)

                                    <div class="course-card">
                                        <h6 class="cou-title">
                                            <a class="collapsed" data-bs-toggle="collapse" href="#collapse{{ $key }}"
                                               aria-expanded="false">{{ $lesson['name'] }}</a>
                                        </h6>
                                        @if(!empty($lesson['sub_lessons']))
                                            @foreach($lesson['sub_lessons'] as $item)
                                                <div id="collapse{{ $key }}" class="card-collapse collapse" style>
                                                    <ul>
                                                        <li>
                                                            <p><img src="{{ asset('client/assets/img/icon/play.svg') }}"
                                                                    alt class="me-2"><a
                                                                    href="{{ getUrlVideo($item) }}">{{ $item['name'] }}</a>
                                                            </p>
                                                            <div>
                                                                @if($item['is_trial'] == 1)
                                                                    <a href=""
                                                                       class="btn btn-info text-light text-decoration-none">Học
                                                                        thử</a>
                                                                @endif
                                                                <span>{{ formatTime($item['durations'])  }}</span>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endforeach
                            </div>
                        </div>


                        <div class="card instructor-sec">
                            <div class="card-body">
                                <h5 class="subs-title">Thông tin về giảng viên</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="instructor-profile.html"><img src="{{ $teacher->image }}"
                                                                                   alt="img" class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="instructor-profile.html">{{ $teacher->name }}</a></h5>
                                            <p>{{ $teacher->major }}</p>
                                        </div>
                                    </div>

                                </div>
                                <div class="course-info d-flex align-items-center">
                                    <div class="cou-info">
                                        <img src="assets/img/icon/play.svg" alt>
                                        <p>{{ count($courses) }} khóa đang dạy</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="assets/img/icon/icon-01.svg" alt>

                                        <p>{{ countLessonsTeacher($courses) }} Bài giảng</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="assets/img/icon/icon-02.svg" alt>
                                        <p>{{ countDurationTeacher($courses) }}</p>
                                    </div>
                                    <div class="cou-info">
                                        <img src="assets/img/icon/people.svg" alt>
                                        <p>270,866 students enrolled</p>
                                    </div>
                                </div>
                                <p>{!!  $teacher->description  !!}</p>

                            </div>
                        </div>


                        <div class="card review-sec">
                            <div class="card-body">
                                <h5 class="subs-title">Reviews</h5>
                                <div class="instructor-wrap">
                                    <div class="about-instructor">
                                        <div class="abt-instructor-img">
                                            <a href="instructor-profile.html"><img src="assets/img/user/user1.jpg"
                                                                                   alt="img" class="img-fluid"></a>
                                        </div>
                                        <div class="instructor-detail">
                                            <h5><a href="instructor-profile.html">Nicole Brown</a></h5>
                                            <p>UX/UI Designer</p>
                                        </div>
                                    </div>

                                </div>
                                <p class="rev-info">“ This is the second Photoshop course I have completed with
                                    Cristian. Worth every penny and recommend it highly. To get the most out of this
                                    course, its best to to take the Beginner to Advanced course first. The sound and
                                    video quality is of a good standard. Thank you Cristian. “</p>
                                <a href="javascript:void(0);" class="btn btn-reply"><i
                                        class="feather-corner-up-left"></i> Reply</a>
                            </div>
                        </div>


                        <div class="card comment-sec">
                            <div class="card-body">
                                <h5 class="subs-title">Gửi bình luận</h5>
                                <form>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <input type="text" class="form-control" placeholder="Full Name">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-block">
                                                <input type="email" class="form-control" placeholder="Email">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-block">
                                        <input type="email" class="form-control" placeholder="Subject">
                                    </div>
                                    <div class="input-block">
                                        <textarea rows="4" class="form-control" placeholder="Your Comments"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn submit-btn" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>


                    <div class="col-lg-4">
                        <div class="sidebar-sec">

                            <div class="video-sec vid-bg">
                                <div class="card">
                                    <div class="card-body">
                                        <a href="" class="video-thumbnail"
                                           data-fancybox>

                                            <img class src="{{ $course->thumbnail }}" alt>
                                        </a>
                                        <div class="video-details">
                                            <div class="course-fee">

                                                <h2></h2>

                                                <p><span>{{ formatCurrency($course->price) }}</span> <strong
                                                        style="color: red">{{ formatCurrency($course->sale_price) }}</strong>
                                                </p>

                                            </div>

                                            <a href="checkout.html" class="btn btn-enroll w-100">Đăng kí ngay</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="card include-sec">
                                <div class="card-body">
                                    <div class="cat-title">
                                        <h4>Bao gồm</h4>
                                    </div>
                                    <ul>

                                        <li><img src="{{ asset('client/assets/img/icon/import.svg') }}" class="me-2"
                                                 alt>Bài Giảng
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/play.svg') }}" class="me-2" alt>
                                            Tài liệu
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/key.svg') }}" class="me-2" alt>
                                            Truy cập trọn đời
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/mobile.svg') }}" class="me-2"
                                                 alt> Truy cập web
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/teacher.svg') }}" class="me-2"
                                                 alt> Chứng chỉ
                                        </li>
                                    </ul>
                                </div>
                            </div>


                            <div class="card feature-sec">
                                <div class="card-body">
                                    <div class="cat-title">
                                        <h4>Bao gồm</h4>
                                    </div>
                                    <ul>
                                        <li><img src="{{ asset('client/assets/img/icon/users.svg') }}" class="me-2" alt>
                                            Học viên: <span>32 students</span>
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/timer.svg') }}" class="me-2" alt>
                                            Thời lượng: <span>{{ sumDurations($course)}}</span>
                                        </li>
                                        <li><img src="{{ asset('client/assets/img/icon/video.svg') }}" class="me-2" alt>
                                            Video:<span> {{ countLessons($course['lessons']) }} video </span></li>

                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

