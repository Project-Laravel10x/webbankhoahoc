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
                        <div class="banner-content">
                            <form class="form" action="https://dreamslms.dreamstechnologies.com/html/course-list.html">
                                <div class="form-inner">
                                    <div class="input-group">
                                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                                        <input type="text" class="form-control"
                                               placeholder="Tìm kiếm danh sách khóa học ..">
                                        <span class="drop-detail">
                                        <select class="form-select select">
                                        <option>Danh mục</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                            @endforeach
                                        </select>
                                        </span>
                                        <button class="btn btn-primary sub-btn" type="submit"><i
                                                class="fas fa-arrow-right"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        {{--                        <div class="trust-user">--}}
                        {{--                            <p>Trusted by over 15K Users <br>worldwide since 2022</p>--}}
                        {{--                            <div class="trust-rating d-flex align-items-center">--}}
                        {{--                                <div class="rate-head">--}}
                        {{--                                    <h2><span>1000</span>+</h2>--}}
                        {{--                                </div>--}}
                        {{--                                <div class="rating d-flex align-items-center">--}}
                        {{--                                    <h2 class="d-inline-block average-rating">4.4</h2>--}}
                        {{--                                    <i class="fas fa-star filled"></i>--}}
                        {{--                                    <i class="fas fa-star filled"></i>--}}
                        {{--                                    <i class="fas fa-star filled"></i>--}}
                        {{--                                    <i class="fas fa-star filled"></i>--}}
                        {{--                                    <i class="fas fa-star filled"></i>--}}
                        {{--                                </div>--}}
                        {{--                            </div>--}}
                        {{--                        </div>--}}
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
                @foreach($categories as $category)
                    <div class="feature-box text-center ">
                        <div class="feature-bg">
                            <div class="feature-header">
                                <div class="feature-icon">
                                    <img src="{{ $category['thumbnail'] }}">
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


    <section class="section new-course">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head">
                    <span>Có Gì Mới</span>
                    <h2>Các Khóa Học Nổi Bật</h2>
                </div>
                <div class="all-btn all-category d-flex align-items-center">
                    <a href="course-list.html" class="btn btn-primary">Tất Cả Các Khóa Học</a>
                </div>
            </div>
            <div class="section-text aos" data-aos="fade-up">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum
                    gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
            </div>
            <div class="course-feature">
                <div class="row">
                    @foreach($courses as $key => $course)
                        <div class="col-lg-4 col-md-6 d-flex">
                            <div class="course-box d-flex aos" data-aos="fade-up">
                                <div class="product">
                                    <div class="product-img">
                                        <a href="course-details.html">
                                            <img class="img-fluid" alt
                                                 src="{{ $course['thumbnail'] }}">
                                        </a>
                                        <div class="price">
                                            <h3>{{ formatCurrency($course['price']) }}
                                                <span>{{ formatCurrency($course['sale_price']) }}</span></h3>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <div class="course-group d-flex">
                                            <div class="course-group-img d-flex">
                                                <a href="instructor-profile.html"><img
                                                        src="{{$course['teachers']['image']}}"
                                                        class="img-fluid"></a>
                                                <div class="course-name">
                                                    <h4><a href="instructor-profile.html">{{$course['teachers']['name']}}</a></h4>
                                                    <p>Giảng viên</p>
                                                </div>
                                            </div>
                                            <div class="course-share d-flex align-items-center justify-content-center">
                                                <a href="#"><i class="fa-regular fa-heart"></i></a>
                                            </div>
                                        </div>
                                        <h3 class="title instructor-text"><a href="course-details.html">{{$course['name']}}</a></h3>
                                        <div class="course-info d-flex align-items-center">
                                            <div class="rating-img d-flex align-items-center">
                                                <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt>
                                                <p>{{ count($course['lessons']) }} Bài Giảng</p>
                                            </div>
                                            <div class="course-view d-flex align-items-center">
                                                <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt>
                                                <p>{{ sumDurations($course) }}</p>
                                            </div>
                                        </div>
                                        <div class="rating">
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star filled"></i>
                                            <i class="fas fa-star"></i>
                                            <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                                        </div>
                                        <div class="all-btn all-category d-flex align-items-center">
                                            <a href="checkout.html" class="btn btn-primary">MÚC NGAY</a>
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
                        <p>Đạt chứng chỉ, nắm vững các kỹ năng công nghệ hiện đại và nâng cao sự nghiệp của bạn - cho dù bạn đang bắt đầu hoặc là một chuyên gia có kinh nghiệm. 95% học viên eLearning báo cáo rằng nội dung thực hành của chúng tôi đã giúp trực tiếp cho sự nghiệp của họ.</p>
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
                                        <p>Xây dựng kỹ năng của bạn theo cách của riêng bạn, từ các phòng thí nghiệm đến các khóa học</p>
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
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head">
                    <span>What’s New</span>
                    <h2>TRENDING COURSES</h2>
                </div>
                <div class="all-btn all-category d-flex align-items-center">
                    <a href="course-list.html" class="btn btn-primary">All Courses</a>
                </div>
            </div>
            <div class="section-text aos" data-aos="fade-up">
                <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean accumsan bibendum
                    gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
            </div>
            <div class="owl-carousel trending-course owl-theme aos" data-aos="fade-up">
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-07.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$200 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Michael</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Learn JavaScript and Express to become a
                                    professional JavaScript</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>13+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>10hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-08.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$300 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user2.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Smith</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3
                                    and Bootstrap</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>10+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>11hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-05.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$100 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user3.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">Lavern M.</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">The Complete App Design Course - UX, UI and
                                    Design Thinking</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>8+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>8hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-08.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$200 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user5.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Smith</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Build Responsive Real World Websites with
                                    HTML5 and CSS3</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>13+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>10hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-07.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$300 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user2.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Smith</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3
                                    and Bootstrap</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>10+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>11hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-09.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$100 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user4.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">Lavern M.</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">The Complete App Design Course - UX, UI and
                                    Design Thinking</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>8+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>8hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-08.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$200 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user1.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Michael</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Learn JavaScript and Express to become a
                                    professional JavaScript</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>13+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>10hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="course-box trend-box">
                    <div class="product trend-product">
                        <div class="product-img">
                            <a href="course-details.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/course/course-09.jpg')}}">
                            </a>
                            <div class="price">
                                <h3>$300 <span>$99.00</span></h3>
                            </div>
                        </div>
                        <div class="product-content">
                            <div class="course-group d-flex">
                                <div class="course-group-img d-flex">
                                    <a href="instructor-profile.html"><img
                                            src="{{asset('client/assets/img/user/user3.jpg')}}"
                                            class="img-fluid"></a>
                                    <div class="course-name">
                                        <h4><a href="instructor-profile.html">John Smith</a></h4>
                                        <p>Instructor</p>
                                    </div>
                                </div>
                                <div class="course-share d-flex align-items-center justify-content-center">
                                    <a href="#"><i class="fa-regular fa-heart"></i></a>
                                </div>
                            </div>
                            <h3 class="title"><a href="course-details.html">Responsive Web Design Essentials HTML5 CSS3
                                    and Bootstrap</a></h3>
                            <div class="course-info d-flex align-items-center">
                                <div class="rating-img d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-01.svg')}}" alt class="img-fluid">
                                    <p>10+ Lesson</p>
                                </div>
                                <div class="course-view d-flex align-items-center">
                                    <img src="{{asset('client/assets/img/icon/icon-02.svg')}}" alt class="img-fluid">
                                    <p>11hr 30min</p>
                                </div>
                            </div>
                            <div class="rating">
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star"></i>
                                <span class="d-inline-block average-rating"><span>4.0</span> (15)</span>
                            </div>
                            <div class="all-btn all-category d-flex align-items-center">
                                <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="feature-instructors">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head feature-head text-center">
                        <h2>Featured Instructor</h2>
                        <div class="section-text aos" data-aos="fade-up">
                            <p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Eget aenean
                                accumsan bibendum gravida maecenas augue elementum et neque. Suspendisse imperdiet.</p>
                        </div>
                    </div>
                </div>
                <div class="owl-carousel instructors-course owl-theme aos" data-aos="fade-up">
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user7.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">David Lee</a></h5>
                            <p>Web Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>50 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user8.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Daziy Millar</a></h5>
                            <p>PHP Expert</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group yellow"></i>
                                <span>50 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user9.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
                            <p>Web Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group violet"></i>
                                <span>50 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user10.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Skyler Whites</a></h5>
                            <p>UI Designer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group orange"></i>
                                <span>50 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user7.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
                            <p>Java Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>40 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user8.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">David Lee</a></h5>
                            <p>Web Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>50 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user9.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Daziy Millar</a></h5>
                            <p>PHP Expert</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>40 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user10.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
                            <p>Web Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>20 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img ">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user7.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Skyler Whites</a></h5>
                            <p>UI Designer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>30 Students</span>
                            </div>
                        </div>
                    </div>
                    <div class="instructors-widget">
                        <div class="instructors-img">
                            <a href="instructor-list.html">
                                <img class="img-fluid" alt src="{{asset('client/assets/img/user/user8.jpg')}}">
                            </a>
                        </div>
                        <div class="instructors-content text-center">
                            <h5><a href="instructor-profile.html">Patricia Mendoza</a></h5>
                            <p>Java Developer</p>
                            <div class="student-count d-flex justify-content-center">
                                <i class="fa-solid fa-user-group"></i>
                                <span>40 Students</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <section class="section lead-companies">
        <div class="container">
            <div class="section-header aos" data-aos="fade-up">
                <div class="section-sub-head feature-head text-center">
                    <span>Trusted By</span>
                    <h2>500+ Leading Universities And Companies</h2>
                </div>
            </div>
            <div class="lead-group aos" data-aos="fade-up">
                <div class="lead-group-slider owl-carousel owl-theme">
                    <div class="item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-01.png')}}">'
                        </div>
                    </div>
                    <div class=" item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-02.png')}}">
                        </div>
                    </div>
                    <div class=" item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-03.png')}}">
                        </div>
                    </div>
                    <div class=" item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-04.png')}}">
                        </div>
                    </div>
                    <div class=" item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-05.png')}}">
                        </div>
                    </div>
                    <div class=" item">
                        <div class="lead-img">
                            <img class="img-fluid" alt src="{{asset('client/assets/img/lead-06.png')}}">
                        </div>
                    </div>
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
                    <span>Check out these real reviews</span>
                    <h2>Users-love-us Don't take it from us.</h2>
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
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{asset('client/assets/img/qute-01.png')}}">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <div class=" four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="instructor-profile.html"><img
                                                    src="{{asset('client/assets/img/user/user1.jpg')}}" class="
                                                    img-fluid"></a>
                                        </div>
                                        <h3><a href="instructor-profile.html">Daziy Millar</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{asset('client/assets/img/qute-01.png')}}">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <div class=" four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="instructor-profile.html"><img
                                                    src="{{asset('client/assets/img/user/user3.jpg')}}" class="
                                                    img-fluid"></a>
                                        </div>
                                        <h3><a href="instructor-profile.html">john smith</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center">
                        <div class="testimonial-all d-flex justify-content-center">
                            <div class="testimonial-two-head text-center align-items-center d-flex">
                                <div class="testimonial-four-saying ">
                                    <div class="testi-right">
                                        <img src="{{asset('client/assets/img/qute-01.png')}}">
                                    </div>
                                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                                        Ipsum has been the industry's standard dummy text ever since the 1500s, when an
                                        unknown printer took a galley of type and scrambled it to make a type specimen
                                        book.</p>
                                    <div class=" four-testimonial-founder">
                                        <div class="fount-about-img">
                                            <a href="instructor-profile.html"><img
                                                    src="{{asset('client/assets/img/user/user2.jpg')}}" class="
                                                    img-fluid"></a>
                                        </div>
                                        <h3><a href="instructor-profile.html">David Lee</a></h3>
                                        <span>Founder of Awesomeux Technology</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="section become-instructors aos" data-aos="fade-up">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor cube-instuctor ">
                        <h4>Become An Instructor</h4>
                        <div class="row">
                            <div class="col-lg-7 col-md-12">
                                <div class="top-instructors">
                                    <p>Top instructors from around the world teach millions of students on
                                        Mentoring.</p>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt src="{{asset('client/assets/img/become-02.png')}}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" col-lg-6 col-md-6 d-flex">
                    <div class="student-mentor yellow-mentor">
                        <h4>Transform Access To Education</h4>
                        <div class="row">
                            <div class="col-lg-8 col-md-12">
                                <div class="top-instructors">
                                    <p>Create an account to receive our newsletter, course
                                        recommendations and promotions.</p>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="mentor-img">
                                    <img class="img-fluid" alt src="{{asset('client/assets/img/become-01.png')}}">
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
                    <h2>Latest Blogs</h2>
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
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-01.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">Attract More Attention
                                Sales And Profits</a></h5>
                        <p>Marketing</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jun 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-02.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">11 Tips to Help You Get
                                New Clients</a></h5>
                        <p>Sales Order</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 20, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-03.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">An Overworked Newspaper
                                Editor</a></h5>
                        <p>Design</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-04.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">A Solution Built for
                                Teachers</a></h5>
                        <p>Seo</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jul 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-02.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">Attract More Attention
                                Sales And Profits</a></h5>
                        <p>Marketing</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Sep 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-03.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">An Overworked Newspaper
                                Editor</a></h5>
                        <p>Marketing</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-04.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">A Solution Built for
                                Teachers</a></h5>
                        <p>Analysis</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 15, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-02.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">11 Tips to Help You Get
                                New Clients</a></h5>
                        <p>Development</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>Jun 20, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-03.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">An Overworked Newspaper
                                Editor</a></h5>
                        <p>Sales</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>May 25, 2022</span>
                        </div>
                    </div>
                </div>
                <div class="instructors-widget blog-widget">
                    <div class="instructors-img">
                        <a href="blog-list.html">
                            <img class="img-fluid" alt
                                 src="{{asset('client/assets/img/blog/blog-04.jpg')}}">
                        </a>
                    </div>
                    <div class="instructors-content text-center">
                        <h5><a href="blog-list.html">A Solution Built for
                                Teachers</a></h5>
                        <p>Marketing</p>
                        <div
                            class="student-count d-flex justify-content-center">
                            <i class="fa-solid fa-calendar-days"></i>
                            <span>April 15, 2022</span>
                        </div>
                    </div>
                </div>
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
                                <h3><span class="counterUp">253,085</span>
                                </h3>
                                <p>STUDENTS ENROLLED</p>
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
                                <h3><span class="counterUp">1,205</span>
                                </h3>
                                <p>TOTAL COURSES</p>
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
                                <h3><span class="counterUp">127</span></h3>
                                <p>COUNTRIES</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="lab-course">
                <div class="section-header aos" data-aos="fade-up">
                    <div class="section-sub-head feature-head text-center">
                        <h2>Unlimited access to 360+ courses <br>and 1,600+
                            hands-on labs</h2>
                    </div>
                </div>
                <div class="icon-group aos" data-aos="fade-up">
                    <div class="offset-lg-1 col-lg-12">
                        <div class="row">
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-09.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-10.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-16.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-12.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-13.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-14.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-15.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-16.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-17.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-1 col-3">
                                <div
                                    class="total-course d-flex align-items-center">
                                    <div class="blur-border">
                                        <div class="enroll-img ">
                                            <img
                                                src="{{asset('client/assets/img/icon/icon-18.svg')}}"
                                                alt class="img-fluid">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

