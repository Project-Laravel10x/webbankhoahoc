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
                                <a href="#"><img src="{{ $teacher->image }}" alt="img"
                                                 class="img-fluid"></a>
                            </div>
                            <div class="instructor-detail me-3">
                                <h5><a href="#">{{ $teacher->name }}</a></h5>
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
                            <p>{{ count($course->students) }} đang học</p>
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
                                                                alt class="me-2">{{ $item['name'] }}
                                                        </p>
                                                        <div>
                                                            @if($item['is_trial'] == 1)
                                                                {{--                                                                <a href="{{ isTrial($item['slug']) }}"--}}
                                                                {{--                                                                   class="video-thumbnail"--}}
                                                                {{--                                                                   data-fancybox>--}}
                                                                {{--                                                                    <button type="button"--}}
                                                                {{--                                                                            class="btn btn-info text-light text-decoration-none"--}}
                                                                {{--                                                                            data-bs-toggle="modal"--}}
                                                                {{--                                                                            data-bs-target="#exampleModal">--}}
                                                                {{--                                                                        Học thử--}}
                                                                {{--                                                                    </button>--}}
                                                                {{--                                                                </a>  --}}
                                                                <p href=""
                                                                   class="btn btn-info text-light text-decoration-none trial-btn"
                                                                   data-id="{{ $item['id'] }}">
                                                                    Học thử
                                                                </p>

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

                    <div class="modal fade" id="modal" tabindex="-1">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title"
                                        id="exampleModalLabel"></h5>
                                    <button type="button" class="btn-close"
                                            data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card instructor-sec">
                        <div class="card-body">
                            <h5 class="subs-title">Thông tin về giảng viên</h5>
                            <div class="instructor-wrap">
                                <div class="about-instructor">
                                    <div class="abt-instructor-img">
                                        <a href="#"><img src="{{ $teacher->image }}"
                                                         alt="img" class="img-fluid"></a>
                                    </div>
                                    <div class="instructor-detail">
                                        <h5><a href="#">{{ $teacher->name }}</a></h5>
                                        <p>{{ $teacher->major }}</p>
                                    </div>
                                </div>

                            </div>
                            <div class="course-info d-flex align-items-center">
                                <div class="cou-info">

                                    <img src="{{ asset('client/assets/img/icon/play.svg') }}" alt>
                                    <p>{{ count($courses) }} khóa đang dạy</p>
                                </div>
                                <div class="cou-info">
                                    <img src="{{ asset('client/assets/img/icon/icon-01.svg') }}" alt>

                                    <p>{{ countLessonsTeacher($courses) }} Bài giảng</p>
                                </div>
                                <div class="cou-info">
                                    <img src="{{ asset('client/assets/img/icon/icon-02.svg') }}" alt>
                                    <p>{{ countDurationTeacher($courses) }}</p>
                                </div>
                            </div>
                            <p>{!!  $teacher->description  !!}</p>

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
                                            @if($course->sale_price == 0)
                                                <p><strong
                                                        style="color: red">{{ formatCurrency($course->price) }}</strong>
                                                    <span>{{ formatCurrency($course->sale_price) }}</span>
                                                </p>
                                            @else
                                                <p><span>{{ formatCurrency($course->price) }}</span> <strong
                                                        style="color: red">{{ formatCurrency($course->sale_price) }}</strong>
                                                </p>
                                            @endif

                                        </div>


                                        @if($course->status == 1 )
                                            @if(checkCourseRegistration(\Illuminate\Support\Facades\Auth::guard('students')->user()->id ?? null,$course->id))
                                                <a href="{{ route('students.myCourses') }}" class="btn btn-success">Khóa
                                                    học của tôi</a>
                                            @else
                                                <form method="POST" action="{{ route('addToCart') }}">
                                                    @csrf
                                                    <input type="hidden" name="course_id" value="{{ $course->id }}">
                                                    <input type="hidden" name="name" value="{{ $course->name }}">
                                                    <input type="hidden" name="slug" value="{{ $course->slug }}">
                                                    <input type="hidden" name="price" value="{{ $course->price }}">
                                                    <input type="hidden" name="sale_price"
                                                           value="{{ $course->sale_price }}">
                                                    <input type="hidden" name="thumbnail"
                                                           value="{{$course->thumbnail  }}">
                                                    <input type="hidden" name="lesson"
                                                           value="{{ countLessons($course['lessons']) }}">
                                                    <input type="hidden" name="duration"
                                                           value="{{ sumDurations($course) }}">
                                                    <button type="submit" class="btn btn-wish w-100"><i
                                                            class="fa-solid fa-cart-shopping"
                                                            style="color: red;"></i>
                                                        Thêm
                                                        vào
                                                        giỏ hàng
                                                    </button>
                                                </form>

                                                <form method="POST" action="{{ route('thanhToan') }}">

                                                    @csrf
                                                    <input type="hidden" name="qty"
                                                           value="1">
                                                    <input type="hidden" name="course_id"
                                                           value="{{ $course->id }}">
                                                    <input type="hidden" name="price" value="{{ $course->price }}">
                                                    <input type="hidden" name="sale_price"
                                                           value="{{ $course->sale_price }}">
                                                    <input type="hidden" name="total"
                                                           value="{{ $course->sale_price == 0 ? $course->price : $course->sale_price }}">

                                                    <button type="submit" class="btn btn-enroll w-100">Thanh toán ngay
                                                    </button>
                                                </form>
                                            @endif

                                        @endif
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
                                             alt> Cấp chứng chỉ khóa học
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
                                        Học viên: <span>{{ count($course->students) }}</span>
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

@section('js_custom')
    <script>
        window.addEventListener('DOMContentLoaded', () => {

            const btnTrialList = document.querySelectorAll('.trial-btn')
            const modalElement = document.querySelector('#modal')

            let currentId;

            if (btnTrialList.length) {
                btnTrialList.forEach((btn) => {
                    btn.addEventListener('click', (e) => {
                        const id = e.target.dataset.id
                        currentId = id;
                        const initialBtn = e.target.innerText
                        const videoKey = `trial_video_${id}`;

                        var modal = new bootstrap.Modal(modalElement)

                        const url = "{{route('data.trial')}}/" + id
                        e.target.innerText = "Đang mở ..."

                        fetch(url).then((res) => {
                            return res.json()
                        }).then(({success, data, videoUrl}) => {

                            if (!success) {
                                alert('Video này không tồn tại !')
                                return
                            }

                            if (data.is_trial !== 1) {
                                alert('Video này không được học thử !')
                                return
                            }

                            const name = data.name
                            const video = videoUrl

                            modal.show()
                            modalElement.querySelector('.modal-title').innerText = name

                            if (video.includes('/storage/videos/')) {
                                modalElement.querySelector('.modal-body').innerHTML = `
                           <video
                            id="my-video"
                            class="video-js"
                            controls
                            preload="auto"
                            width="750px"
                            height="450px"
                            data-setup="{}"
                          >
                            <source src="data/stream?video=${video}" type="video/mp4" />
                            <p class="vjs-no-js">
                              To view this video please enable JavaScript, and consider upgrading to a
                              web browser that
                            </p>
                          </video>`;
                            } else {
                                modalElement.querySelector('.modal-body').innerHTML = `
                            <iframe width="100%" height="400px" src="${video}" frameborder="0" allowfullscreen></iframe>`;
                            }
                        }).finally(() => {
                            e.target.innerText = initialBtn
                            const savedVideoState = localStorage.getItem(videoKey);
                            if (savedVideoState) {
                                const videoPlayer = videojs(modalElement.querySelector('.modal-body').querySelector('#my-video'))
                                const videoState = JSON.parse(savedVideoState);
                                videoPlayer.currentTime(videoState.currentTime);
                                videoPlayer.volume(videoState.volume);
                            }
                        })

                    })
                })
            }

            modalElement.addEventListener('hidden.bs.modal', (e) => {
                modalElement.querySelector('.modal-body').innerText = ''
                modalElement.querySelector('.modal-title').innerText = ''
            })

            window.addEventListener('beforeunload', function (e) {
                e.preventDefault();
                const videoPlayer = videojs(modalElement.querySelector('.modal-body').querySelector('#my-video'))
                const videoKey = `trial_video_${currentId}`;
                const videoState = {
                    currentTime: videoPlayer.currentTime(),
                    volume: videoPlayer.volume(),
                };
                localStorage.setItem(videoKey, JSON.stringify(videoState));
            });
        })
    </script>

@endsection

