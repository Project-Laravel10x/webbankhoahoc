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
                                    <li class="breadcrumb-item" aria-current="page">Giỏ hàng</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="course-content cart-widget">
            <div class="container">
                <div class="student-widget">
                    <div class="student-widget-group">
                        <div class="row">

                            <div class="col-lg-12">
                                @if(session('msg'))
                                    <p class="alert alert-success">{{ session('msg') }}</p>
                                @endif
                                <div class="cart-head">
                                    <h4>Giỏ hàng (<strong>{{ count(Cart::getContent()) }} </strong> khóa học)</h4>
                                </div>
                                <div class="cart-group">
                                    <div class="row">

                                        @foreach($listCart as $course)
                                            <div class="col-lg-12 col-md-12 d-flex">
                                                <div class="course-box course-design list-course d-flex">
                                                    <div class="product">
                                                        <div class="product-img">
                                                            <a href="">
                                                                <img class="img-fluid" alt
                                                                     src="{{ $course['attributes']['thumbnail'] }}">
                                                            </a>
                                                            <div class="price">
                                                                @if($course['attributes']['sale_price'] == 0)
                                                                    <h3> {{ formatCurrency($course['price']) }}
                                                                    </h3>
                                                                @else
                                                                    <h3> {{ formatCurrency($course['attributes']['sale_price']) }}
                                                                        <span>{{ formatCurrency($course['price']) }}</span>
                                                                    </h3>
                                                                @endif

                                                            </div>
                                                        </div>
                                                        <div class="product-content">
                                                            <div class="head-course-title">
                                                                <h3 class="title"><a href="">{{ $course['name'] }}</a>
                                                                </h3>
                                                            </div>
                                                            <div
                                                                class="course-info d-flex align-items-center border-bottom-0 pb-0">
                                                                <div class="rating-img d-flex align-items-center">
                                                                    <img
                                                                        src="{{ asset('client/assets/img/icon/icon-01.svg') }}"
                                                                        alt>
                                                                    <p>{{ $course['attributes']['lesson'] }} Bài
                                                                        giảng</p>
                                                                </div>
                                                                <div class="course-view d-flex align-items-center">
                                                                    <img
                                                                        src="{{ asset('client/assets/img/icon/icon-02.svg') }}"
                                                                        alt>
                                                                    <p>{{ $course['attributes']['duration'] }}</p>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="cart-remove">
                                                            <form method="POST" action="{{ route('removeCart') }}">
                                                                @csrf
                                                                <input type="hidden" name="course_id"
                                                                       value="{{ $course['id'] }}">
                                                                <button style="width: 150px" type="submit"
                                                                        class="btn btn-wish"> Xóa khóa học
                                                                </button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="cart-total">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="cart-subtotal">
                                                <p>Tổng tiền: <span>{{ formatCurrency(sumCart($listCart)) }}</span></p>
                                            </div>
                                        </div>
                                        @if(count(Cart::getContent()) > 0)
                                            <div class="col-lg-6 col-md-6">
                                                <div class="check-outs">
                                                    <form method="POST" action="{{ route('thanhToan') }}">
                                                        @csrf
                                                        <input type="hidden" name="qty"
                                                               value="{{ count(Cart::getContent()) }}">
                                                        <input type="hidden" name="total"
                                                               value="{{ sumCart($listCart) }}">

                                                        <button type="submit" class="btn btn-primary">Thanh
                                                            toán
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6">
                                                <div class="condinue-shop">
                                                    <a href="/" class="btn btn-primary">Quay lại trang chủ</a>
                                                </div>
                                            </div>
                                        @else
                                            <div class="col-lg-12 col-md-12">
                                                <div class="condinue-shop">
                                                    <a href="/" class="btn btn-primary">Quay lại trang chủ</a>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

@endsection
