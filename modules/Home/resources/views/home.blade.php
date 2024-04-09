@extends('layouts.client')

@section('content')
    <section class="home-slide d-flex align-items-center">
        <div class="container">
            <div class="row ">
                <div class="col-md-7">
                    <div class="home-slide-face aos" data-aos="fade-up">
                        <div class="home-slide-text ">
                            <h5>Người Dẫn Đầu trong Học Trực Tuyến</h5>
                            <h1>Các Khóa Học Trực Tuyến Hấp Dẫn và Dễ Tiếp Cận Cho Tất Cả</h1>
                            <p>Chiếm lĩnh tương lai của bạn bằng cách học những kỹ năng mới trực tuyến</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 d-flex align-items-center">
                    <div class="girl-slide-img aos" data-aos="fade-up">
                        <img src="{{asset('client/assets/img/object.png')}}" alt>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section student-course">
        <div class="container">
            <div class="course-widget">
                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="course-full-width">
                            <div class="blur-border course-radius align-items-center aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img">
                                        <img src="{{asset('client/assets/img/pencil-icon.svg')}}">
                                    </div>
                                    <div class="course-inner-content">
                                        <h4><span>{{ count($courses) }}</span></h4>
                                        <p>Tất cả các khóa học</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="course-full-width">
                            <div class="blur-border course-radius aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img">
                                        <img src="{{asset('client/assets/img/cources-icon.svg')}}">
                                    </div>

                                    <div class="course-inner-content">
                                        <h4><span>{{ count($teachers) }}</span></h4>
                                        <p>Giảng viên</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6 d-flex">
                        <div class="course-full-width">
                            <div class="blur-border course-radius aos" data-aos="fade-up">
                                <div class="online-course d-flex align-items-center">
                                    <div class="course-img">
                                        <img src="{{asset('client/assets/img/gratuate-icon.svg')}}">
                                    </div>
                                    <div class="course-inner-content">
                                        <h4><span>{{ count($students) }}</span></h4>
                                        <p>Tất cả các học viên</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section how-it-works">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head">
                    <span>Khóa Học Yêu Thích</span>
                    <h2>Top Danh Mục</h2>
                </div>
                <div class="all-btn all-category d-flex align-items-center">
                    <a href="job-category.html" class="btn btn-primary">Tất Cả Các Danh Mục</a>
                </div>
            </div>
            <div class="section-text aos" data-aos="fade-up">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum gravida
                    maecenas augue elementum et neque. Suspendisse imperdiet.</p>
            </div>
            <div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
                @foreach($categoriesTop as $category)
                    <div class="feature-box text-center ">
                        <div class="feature-bg">
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <a href="danh-muc/{{ $category['slug'] }}"><img src="{{ $category['thumbnail'] }}"></a>
                                </div>
                                <div class="feature-cont">
                                    <div class="feature-text">{{ $category['name'] }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <section class="section master-skill">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12">
                    <div class="section-header aos" data-aos="fade-up">
                        <div class="section-sub-head">
                            <span>Mới nhất</span>
                            <h2>Thống trị các kỹ năng để thúc đẩy sự nghiệp của bạn</h2>
                        </div>
                    </div>
                    <div class="section-text aos" data-aos="fade-up">
                        <p>Đạt chứng chỉ, nắm vững các kỹ năng công nghệ hiện đại và nâng cao sự nghiệp của bạn - cho dù
                            bạn đang bắt đầu hoặc là một chuyên gia có kinh nghiệm. 95% học viên eLearning báo cáo rằng
                            nội dung thực hành của chúng tôi đã giúp trực tiếp cho sự nghiệp của họ.</p>
                    </div>
                    <div class="career-group aos" data-aos="fade-up">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{asset('client/assets/img/icon/icon-1.svg')}}" alt
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Giữ động lực với các giảng viên hấp dẫn</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{asset('client/assets/img/icon/icon-2.svg')}}" alt
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Theo kịp với những điều mới nhất về đám mây</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{asset('client/assets/img/icon/icon-3.svg')}}" alt
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Đạt chứng chỉ với 100+ khóa học chứng chỉ</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 d-flex">
                                <div class="certified-group blur-border d-flex">
                                    <div class="get-certified d-flex align-items-center">
                                        <div class="blur-box">
                                            <div class="certified-img ">
                                                <img src="{{asset('client/assets/img/icon/icon-4.svg')}}" alt
                                                     class="img-fluid">
                                            </div>
                                        </div>
                                        <p>Xây dựng kỹ năng của bạn theo cách của riêng bạn, từ các phòng thí nghiệm đến
                                            các khóa học</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-5 col-md-12 d-flex align-items-end">
                    <div class="career-img aos" data-aos="fade-up">
                        <img src="{{asset('client/assets/img/join.png')}}" alt class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section trend-course">
        <div class="container">

            <section class="section new-course">
                <div class="container">
                    <div class="section-header aos" data-aos="fade-up">
                        <div class="section-sub-head">
                            <span>Có Gì Mới</span>
                            <h2>Các Khóa Học Nổi Bật</h2>
                        </div>
                    </div>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan
                            bibendum
                            gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
                    </div>
                    <div class="course-feature">
                        <div class="row">
                            @foreach($courses as $key => $course)
                                <div class="col-lg-4 col-md-6 d-flex">
                                    <div class="course-box d-flex aos" data-aos="fade-up">
                                        <div class="product">
                                            <div class="product-img">

                                                <a href="{{ route('courses.detail',$course['slug']) }}">
                                                    <img class="img-fluid" alt
                                                         src="{{ $course['thumbnail'] }}">
                                                </a>
                                                <div class="price">
                                                    @if($course['sale_price'] == 0)
                                                        <h3><strong
                                                                style="color: red">{{ formatCurrency($course['price']) }}</strong>
                                                            <span>{{ formatCurrency($course['sale_price']) }}</span>
                                                        </h3>
                                                    @else
                                                        <h3><span>{{ formatCurrency($course['price']) }}</span> <strong
                                                                style="color: red">{{ formatCurrency($course['sale_price']) }}</strong>
                                                        </h3>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="course-group d-flex">
                                                    <div class="course-group-img d-flex">
                                                        <a href="instructor-profile.html"><img
                                                                src="{{$course['teachers']['image']}}"
                                                                class="img-fluid"></a>
                                                        <div class="course-name">
                                                            <h4>
                                                                <a href="instructor-profile.html">{{$course['teachers']['name']}}</a>
                                                            </h4>
                                                            <p>Giảng viên</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="title instructor-text"><a
                                                        href="course-details.html">{{$course['name']}}</a></h3>
                                                <div class="course-info d-flex align-items-center">
                                                    <div class="rating-img d-flex align-items-center">
                                                        <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt>
                                                        <p>{{ countLessons($course['lessons']) }} Bài Giảng</p>
                                                    </div>
                                                    <div class="course-view d-flex align-items-center">
                                                        <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt>
                                                        <p>{{ sumDurations($course) }}</p>
                                                    </div>
                                                </div>


                                                <div class="all-btn all-category d-flex align-items-center">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form method="POST" action="{{ route('addToCart') }}">
                                                                @csrf
                                                                <input type="hidden" name="course_id"
                                                                       value="{{ $course['id'] }}">
                                                                <input type="hidden" name="name"
                                                                       value="{{ $course['name'] }}">
                                                                <input type="hidden" name="slug"
                                                                       value="{{ $course['slug'] }}">
                                                                <input type="hidden" name="price"
                                                                       value="{{ $course['price'] }}">
                                                                <input type="hidden" name="sale_price"
                                                                       value="{{ $course['sale_price'] }}">
                                                                <input type="hidden" name="thumbnail"
                                                                       value="{{$course['thumbnail']  }}">
                                                                <input type="hidden" name="lesson"
                                                                       value="{{ countLessons($course['lessons']) }}">
                                                                <input type="hidden" name="duration"
                                                                       value="{{ sumDurations($course) }}">
                                                                <button style="height: 40px; width: 180px" type="submit"
                                                                        class="btn btn-wish"><i
                                                                        class="fa-solid fa-cart-shopping"
                                                                        style="color: red;"></i> Thêm vào
                                                                    giỏ hàng
                                                                </button>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-6">

                                                            <form method="POST" action="{{ route('thanhToan') }}">
                                                                @csrf
                                                                <input type="hidden" name="course_id"
                                                                       value="{{ $course['id'] }}">
                                                                <input type="hidden" name="qty"
                                                                       value="1">
                                                                <input type="hidden" name="total"
                                                                       value="{{ checkSalePrice($course['price'],$course['sale_price']) }}">
                                                                <button type="submit" class="btn btn-primary">Thanh
                                                                    toán
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($key > 6)
                                    @break
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>

            <div class="feature-instructors">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head feature-head text-center">
                        <h2>Các giảng viên</h2>
                        <div class="section-text aos" data-aos="fade-up">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean
                                accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                    @foreach($teachers as $teacher)
                        <div class="instructors-widget">
                            <div class="instructors-img ">
                                <a href="">
                                    <img class="img-fluid" alt src="{{$teacher->image}}">
                                </a>
                            </div>
                            <div class="instructors-content text-center">
                                <h5><a href="instructor-profile.html">{{$teacher->name}}</a></h5>
                                <p>{{$teacher->exp}} năm kinh nghiệm phát triển web</p>
                                <div class="student-count d-flex justify-content-center">
                                    <i class="fa-solid fa-user-group"></i>
                                    <span>50 Students</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <section class=" section share-knowledge">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="knowledge-img aos" data-aos="fade-up">
                        <img src="{{asset('client/assets/img/share.png')}}" alt
                             class="img-fluid">
                    </div>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <div class="join-mentor aos" data-aos="fade-up">
                        <h2>Want to share your knowledge? Join us a Mentor</h2>
                        <p>High-definition video is video of higher resolution
                            and quality than standard-definition. While there is
                            no standardized meaning for high-definition,
                            generally any video.</p>
                        <ul class="course-list">
                            <li><i class="fa-solid fa-circle-check"></i>Best
                                Courses
                            </li>
                            <li><i class="fa-solid fa-circle-check"></i>Top
                                rated Instructors
                            </li>
                        </ul>
                        <div
                            class="all-btn all-category d-flex align-items-center">
                            <a href="instructor-list.html"
                               class="btn btn-primary">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section user-love">
        <div class="container">
            <div class="section-header white-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <span>ĐỘI NGŨ QUẢN LÍ HỆ THỐNG</span>
                    <h2>Hãy đến với chúng tôi !</h2>
                </div>
            </div>
        </div>
    </section>


    <section class="testimonial-four">
        <div class="review">
            <div class="container">
                <div class="testi-quotes">
                    <img src="{{asset('client/assets/img/qute.png')}}" alt>
                </div>
                <div class="mentor-testimonial lazy slider aos" data-aos="fade-up" data-sizes="50vw ">
                    @foreach($users as $user)
                        <div class="d-flex justify-content-center">
                            <div class="testimonial-all d-flex justify-content-center">
                                <div class="testimonial-two-head text-center align-items-center d-flex">
                                    <div class="testimonial-four-saying ">
                                        <div class="testi-right">
                                            <img src="{{asset('client/assets/img/qute-01.png')}}">
                                        </div>
                                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                            Lorem
                                            Ipsum has been the industry's standard dummy text ever since the 1500s, when
                                            an
                                            unknown printer took a galley of type and scrambled it to make a type
                                            specimen
                                            book.</p>
                                        <div class=" four-testimonial-founder">
                                            <div class="fount-about-img">
                                                <a href="instructor-profile.html"><img
                                                        src="{{asset('client/assets/img/user/user1.jpg')}}" class="
                                                    img-fluid"></a>
                                            </div>
                                            <h3><a href="instructor-profile.html">{{ $user->name }}</a></h3>
                                            <span>Founder of Awesomeux Technology</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="section become-instructors aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor cube-instuctor">
                        <h4>Trở Thành Một Giảng Viên</h4>
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="top-instructors">
                                    <p>Các giảng viên hàng đầu từ khắp nơi trên thế giới đang giảng dạy hàng triệu học
                                        viên trên Mentoring.</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt="Hình ảnh"
                                         src="{{asset('client/assets/img/become-02.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor yellow-mentor">
                        <h4>Biến Đổi Việc Tiếp Cận Giáo Dục</h4>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="top-instructors">
                                    <p>Tạo một tài khoản để nhận bản tin của chúng tôi, đề xuất khóa học và các khuyến
                                        mãi.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt="Hình ảnh"
                                         src="{{asset('client/assets/img/become-01.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class=" section latest-blog">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center mb-0">
                    <h2>Các tin tức mới nhất</h2>
                    <div class="section-text aos" data-aos="fade-up">
                        <p class="mb-0">Lorem ipsum dolor sit amet,
                            consectetur adipiscing elit. Eget aenean
                            accumsan bibendum gravida maecenas augue
                            elementum et neque. Suspendisse imperdiet.</p>
                    </div>
                </div>
            </div>
            <div class="owl-carousel blogs-slide owl-theme aos"
                 data-aos="fade-up">
                @foreach($news as $new)
                    <div class="instructors-widget blog-widget">
                        <div class="instructors-img">
                            <a href="{{ route('detailNew',$new->slug) }}">
                                <img class="img-fluid" alt
                                     src="{{$new->thumbnail}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="{{ route('detailNew',$new->slug) }}">{{$new->name}}</a></h5>
                            <p>{{ $new->newsCategoies->name }}</p>
                            <div
                                class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-calendar-days"></i>
                                <span>{{$new->created_at}}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="enroll-group aos" data-aos="fade-up">
                <div class="row ">
                    <div class="col-lg-4 col-md-6">
                        <div class="total-course d-flex align-items-center">
                            <div class="blur-border">
                                <div class="enroll-img ">
                                    <img
                                        src="{{asset('client/assets/img/icon/icon-07.svg')}}"
                                        alt class="img-fluid">
                                </div>
                            </div>
                            <div class="course-count">
                                <h3><span class="counterUp">{{ count($students) }}</span>
                                </h3>
                                <p>Tất cả học viên</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="total-course d-flex align-items-center">
                            <div class="blur-border">
                                <div class="enroll-img ">
                                    <img
                                        src="{{asset('client/assets/img/icon/icon-08.svg')}}"
                                        alt class="img-fluid">
                                </div>
                            </div>
                            <div class="course-count">
                                <h3><span class="counterUp">{{ count($courses) }}</span>
                                </h3>
                                <p>Tất cả khóa học</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="total-course d-flex align-items-center">
                            <div class="blur-border">
                                <div class="enroll-img ">
                                    <img
                                        src="{{asset('client/assets/img/icon/icon-09.svg')}}"
                                        alt class="img-fluid">
                                </div>
                            </div>
                            <div class="course-count">
                                <h3><span class="counterUp">{{ count($teachers) }}</span></h3>
                                <p>Tổng số giảng viên</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endsection

