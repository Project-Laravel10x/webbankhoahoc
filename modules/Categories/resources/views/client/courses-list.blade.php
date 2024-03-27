@extends('layouts.client')

@section('content')

    <div class="main-wrapper">

        <div class="breadcrumb-bar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <div class="breadcrumb-list">
                            <nav aria-label="breadcrumb" class="page-breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/">Trang chủ</a></li>
                                    <li class="breadcrumb-item" aria-current="page">Danh mục</li>
                                    <li class="breadcrumb-item active categories-show" aria-current="page">
                                        @if(!empty($category))
                                            <a href="{{ route('courses.list',$category->slug) }}">{{ $category->name }}</a>
                                        @else
                                            <a href="">Các khóa học</a>
                                        @endif
                                    </li>
                                    <li style="display: none" class="breadcrumb-item active categories-hidden"
                                        aria-current="page"><a
                                            href="">Các khóa học</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="course-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">

                        <div class="showing-list">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="d-flex align-items-center">
                                        <div class="view-icons">
                                            <a href=""
                                               class="list-view active"><i class="fa-solid fa-list"
                                                                           style="color: #000;"></i></a>
                                        </div>
                                        <div class="show-result">
                                            <h4>Xem {{ $courses->firstItem() }}-{{ $courses->lastItem() }}
                                                của {{ $courses->total() }} kết quả</h4>
                                        </div>
                                        <div class="hidden-result">

                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 ">
                                    <div class="show-filter add-course-info ">
                                        <form action="{{ route('search.courses') }}" method="GET">
                                            <div class="row gx-2 align-items-center">
                                                <div class="col-md-9 col-item">
                                                    <div class="search-group">
                                                        <i class="feather-search"></i>
                                                        <input type="text" class="form-control" name="search"
                                                               placeholder="Tìm kiếm tên khóa học...  ">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row load-data-courses">
                            @foreach($courses as $course)
                                <div class="col-lg-12 col-md-12 d-flex">
                                    <div class="course-box course-design list-course d-flex">
                                        <div class="product">
                                            <div class="product-img">
                                                <a href="{{ route('courses.detail',$course['slug']) }}">
                                                    <img class="img-fluid" alt src="{{ $course['thumbnail'] }}">
                                                </a>
                                                <div class="price">
                                                    <h3>{{ formatCurrency($course['price']) }}
                                                        <span>{{ formatCurrency($course['sale_price']) }}</span></h3>
                                                </div>
                                            </div>
                                            <div class="product-content">
                                                <div class="head-course-title">
                                                    <h3 class="title"><a
                                                            href="{{ route('courses.detail',$course['slug']) }}">{{ $course['name'] }}</a>
                                                    </h3>
                                                    <div class="all-btn all-category d-flex align-items-center">
                                                        <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                                                    </div>
                                                </div>
                                                <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
                                                    <div class="rating-img d-flex align-items-center">
                                                        <img src="{{ asset('client/assets/img/icon/icon-01.svg') }}"
                                                             alt>
                                                        <p>{{ count($course['lessons']) }} Bài giảng</p>
                                                    </div>

                                                    <div class="course-view d-flex align-items-center">
                                                        <img src="{{ asset('client/assets/img/icon/icon-02.svg') }}"
                                                             alt>
                                                        <p>{{ sumDurations($course) }}</p>
                                                    </div>
                                                </div>
                                                <p style="font-size: 15px">{{ $course['shoft_description']}}</p>
                                                <div class="course-group d-flex mb-0">
                                                    <div class="course-group-img d-flex">
                                                        <a href="instructor-profile.html"><img
                                                                src="{{ $course->teachers->image }}" alt
                                                                class="img-fluid"></a>
                                                        <div class="course-name">
                                                            <h4>
                                                                <a href="instructor-profile.html">{{ $course->teachers->name }}</a>
                                                            </h4>
                                                            <p>Giảng viên</p>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="row pagination">
                            {!! $courses->links() !!}
                        </div>

                    </div>
                    <div class="col-lg-3 theiaStickySidebar">
                        <div class="filter-clear">
                            <div class="clear-filter d-flex align-items-center">
                                <h4><i class="feather-filter"></i>Lọc</h4>
                            </div>

                            <div class="card search-filter categories-filter-blk">
                                <div class="card-body">
                                    <div class="filter-widget mb-0">
                                        <div class="categories-head d-flex align-items-center">
                                            <h4>Danh mục khóa học</h4>
                                        </div>
                                        @foreach($categories as $category)
                                            <div>
                                                <label class="custom_check">
                                                    <input type="checkbox" name="categories[]"
                                                           value="{{ $category['id'] }}">
                                                    <span class="checkmark"></span> {{ $category['name'] }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>


                            <div class="card post-widget ">
                                <div class="card-body">
                                    <div class="latest-head">
                                        <h4 class="card-title">Khóa học mới nhất</h4>
                                    </div>
                                    <ul class="latest-posts">

                                        @foreach($coursesNews as $key => $courseNew)
                                            <li>
                                                <div class="post-thumb">
                                                    <a href="{{ route('courses.detail',$courseNew['slug']) }}">
                                                        <img class="img-fluid" src="{{ $courseNew['thumbnail'] }}" alt>
                                                    </a>
                                                </div>
                                                <div class="post-info free-color">
                                                    <h4>
                                                        <a href="course-details.html">{{ $courseNew['name'] }}</a>
                                                    </h4>
                                                    <p>{{ formatCurrency($courseNew['price']) }}</p>
                                                </div>
                                            </li>
                                            @if($key > 2)
                                                @break
                                            @endif
                                        @endforeach
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
                $(document).ready(function () {
                    $('.custom_check input[type="checkbox"]').change(function () {
                        var selectedCategories = [];
                        $('.custom_check input[type="checkbox"]:checked').each(function () {
                            selectedCategories.push($(this).val());
                        });

                        $.ajax({
                            url: '{{ route('filter.courses') }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                categories: selectedCategories
                            },
                            success: function (response) {
                                console.log(response.length)
                                $('.load-data-courses').empty();
                                $('.show-result').hide();
                                $('.hidden-result').html('<strong>' + response.length + ' kết quả</strong>');
                                $('.categories-show').hide();
                                $('.categories-hidden').show();
                                $('.pagination').hide();

                                $.each(response, function (index, course) {

                                    if (course !== null && typeof course !== 'undefined') {
                                        var courseHtml = `<div class="col-lg-12 col-md-12 d-flex">
                                                                    <div class="course-box course-design list-course d-flex">
                                                                        <div class="product">
                                                                            <div class="product-img">
                                                                                <a href="/khoa-hoc/${course.slug}">
                                                                                    <img class="img-fluid" src="${course.thumbnail}" alt="${course.name}">
                                                                                </a>
                                                                                <div class="price">
                                                                                    <h3>${formatCurrency(course.price)} <span>${formatCurrency(course.sale_price)}</span></h3>
                                                                                </div>
                                                                            </div>
                                                                            <div class="product-content">
                                                                                <div class="head-course-title">
                                                                                    <h3 class="title"><a href="/khoa-hoc/${course.slug}">${course.name}</a></h3>
                                                                                    <div class="all-btn all-category d-flex align-items-center">
                                                                                        <a href="checkout.html" class="btn btn-primary">BUY NOW</a>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="course-info border-bottom-0 pb-0 d-flex align-items-center">
                                                                                    <div class="rating-img d-flex align-items-center">
                                                                                        <img src="/client/assets/img/icon/icon-01.svg" alt="">
                                                                                        <p>${countLessons(course)}</p>
                                                                                    </div>
                                                                                    <div class="course-view d-flex align-items-center">
                                                                                        <img src="/client/assets/img/icon/icon-02.svg" alt="">
                                                                                        <p>${sumDurations(course)}</p>
                                                                                    </div>
                                                                                </div>
                                                                                <p style="font-size: 15px">${course.shoft_description}</p>
                                                                                <div class="course-group d-flex mb-0">
                                                                                    <div class="course-group-img d-flex">
                                                                                        <a href="instructor-profile.html"><img src="${course.teachers.image}" alt="" class="img-fluid"></a>
                                                                                        <div class="course-name">
                                                                                            <h4><a href="instructor-profile.html">${course.teachers.name}</a></h4>
                                                                                            <p>Giảng viên</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>`;
                                        $('.load-data-courses').append(courseHtml);
                                    }
                                })

                            },
                            error: function (xhr, status, error) {
                                console.error(error);
                            }
                        });
                    });


                });

                function formatDuration(seconds) {
                    var minutes = Math.floor(seconds / 60);
                    var remainingSeconds = Math.round(seconds % 60);
                    return minutes + ' phút ' + remainingSeconds + ' giây';
                }

                function countLessons(course) {
                    if (course && course.lessons) {
                        return course.lessons.length + ' Bài giảng';
                    }
                    return '0 Bài giảng';
                }

                function sumDurations(course) {
                    var totalDuration = 0;
                    if (course && course.lessons) {
                        course.lessons.forEach(function (lesson) {
                            if (lesson.video !== null && lesson.video.duration !== null) {
                                totalDuration += lesson.video.duration;
                            }
                        });
                    }
                    return formatDuration(totalDuration);
                }

                function formatCurrency(amount) {
                    if (typeof amount !== 'undefined' && amount !== null) {
                        return amount.toLocaleString('vi-VN', {
                            style: 'currency',
                            currency: 'VND'
                        }).replace(/\s/g, '');
                    }
                    return '';
                }


            </script>

@endsection



