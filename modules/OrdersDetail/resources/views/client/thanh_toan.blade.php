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
                                    <li class="breadcrumb-item" aria-current="page">Thanh toán</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <section class="course-content checkout-widget">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <div class="student-widget pay-method">
                            <div class="student-widget-group add-course-info">
                                <div class="cart-head">
                                    <h4>Phương thức thanh toán</h4>
                                </div>
                                <div class="checkout-form">
                                    <form action="{{ route('thanhToanMomo') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="total" value="{{$dataCart['total']}}">
                                        <button type="submit" name="payUrl" class="btn btn-primary">Thanh toán MOMO</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 theiaStickySidebar">
                        <div class="student-widget select-plan-group">
                            <div class="student-widget-group">
                                <div class="plan-header">
                                    <h4>Bạn sẽ nhận được gì ?</h4>
                                </div>
                                <div class="basic-plan">
                                    <h3>Tổng tiền thanh toán ({{$dataCart['qty']}}) khóa</h3>
                                    <h2>{{formatCurrency($dataCart['total'])}}</h2>
                                </div>
                                <div class="benifits-feature">
                                    <h3>Lợi ích</h3>
                                    <ul>
                                        <li><i class="fas fa-circle"></i> Truy cập cộng đồng Slack</li>
                                        <li><i class="fas fa-circle"></i> Truy cập đội ngũ hỗ trợ</li>
                                        <li><i class="fas fa-circle"></i> Đấu giá theo thuật toán</li>
                                        <li><i class="fas fa-circle"></i> Thu hoạch từ khóa và ASIN</li>
                                    </ul>
                                </div>
                                <div class="benifits-feature">
                                    <h3>Tính năng</h3>
                                    <ul>
                                        <li><i class="fas fa-circle"></i> Cô lập các thuật ngữ tìm kiếm</li>
                                        <li><i class="fas fa-circle"></i> Phân tích tổng doanh số</li>
                                        <li><i class="fas fa-circle"></i> Xếp hạng bán chạy nhất</li>
                                        <li><i class="fas fa-circle"></i> Tối ưu hóa vị trí</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

@endsection
