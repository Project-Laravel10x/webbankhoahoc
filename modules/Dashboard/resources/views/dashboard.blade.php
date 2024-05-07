@extends('layouts.backend')

@section('content')
    <div class="container-fluid">

        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tổng học viên
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($students) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Tổng khóa học
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($courses) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Tổng đơn hàng
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ count($orders) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Tổng danh thu
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{formatCurrency( totalOrderAmount($orders)) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h3><strong>Thống kê đơn hàng</strong></h3>
        <form class="row">
            @csrf
            <div class="col-md-3 mb-3">
                <label for="fromDate" class="form-label">Từ ngày:</label>
                <input type="text" class="form-control" name="form_date" id="datepicker" placeholder="Chọn ngày">
            </div>
            <div class="col-md-3 mb-3">
                <label for="toDate" class="form-label">Đến ngày:</label>
                <input type="text" class="form-control" name="to_date" id="datepicker1" placeholder="Chọn ngày">
            </div>
            <div class="col-md-3 mb-3">
                <label for="toDate" class="form-label">Lọc theo:</label>
                <select class="form-control dashboard-filter" name="" id="">
                    <option value="">--Chọn--</option>
                    <option value="7ngay">7 ngày qua</option>
                    <option value="thangtruoc">Tháng trước</option>
                    <option value="thangnay">Tháng này</option>
                    <option value="365ngay">365 ngày qua</option>
                </select>
            </div>
            <div class="col-md-3 mb-3 align-self-end">
                <button type="button" id="filter_order" class="btn btn-primary">Tìm kiếm</button>
            </div>
        </form>
       <div id="showData">Không có dữ liệu !</div>
        <div id="myfirstchart" style="height: 250px;"></div>

        <div class="row">

            <!-- Area Chart -->

            <!-- Pie Chart -->
            {{--            <div class="col-xl-4 col-lg-5">--}}
            {{--                <div class="card shadow mb-4">--}}
            {{--                    <!-- Card Header - Dropdown -->--}}
            {{--                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">--}}
            {{--                        <h6 class="m-0 font-weight-bold text-primary">Truy cập trang web</h6>--}}
            {{--                    </div>--}}
            {{--                    <!-- Card Body -->--}}
            {{--                    <div class="card-body">--}}
            {{--                      <p>Đang online: <strong class="online-student"></strong></p>--}}
            {{--                      <p>Tổng số học viên truy cập : <strong>{{ count($usersAccess) }}</strong></p>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>


    </div>
@endsection

@section('js_custom')
    <script>

        $(document).ready(function () {

            chart = new Morris.Bar({

                element: 'myfirstchart',

                // lineColors:
                // fillOpacity: 0.5,
                // hideHover: 'auto',
                // parseTime: false,

                xkey: 'created_at',
                ykeys: ['total'],
                behaveLikeLine: true,
                labels: ['Tổng tiền']
            });

            function chartNow() {
                var _token = $('input[name="_token"]').val()
                $.ajax({
                    url: "http://127.0.0.1:8000/admin/filterDataNow",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        _token: _token,
                    },

                    success: function (response) {
                        chart.setData(response)
                    },
                    error: function (xhr, status, error) {

                    }
                });
            }

            chartNow()

            $('.dashboard-filter').change(function () {
                var _token = $('input[name="_token"]').val()
                var dashboardValue = $(this).val()

                $.ajax({
                    url: "http://127.0.0.1:8000/admin/dashboardFilter",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        _token: _token,
                        dashboardValue: dashboardValue,
                    },

                    success: function (response) {
                        chart.setData(response)
                    },
                    error: function (xhr, status, error) {

                    }
                });
            });

            $(function () {
                $("#datepicker").datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: ["Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ Nhật"],
                    duration: "slow",
                });
                $("#datepicker1").datepicker({
                    prevText: "Tháng trước",
                    nextText: "Tháng sau",
                    dateFormat: "yy-mm-dd",
                    dayNamesMin: ["Thứ hai", "Thứ ba", "Thứ tư", "Thứ năm", "Thứ sáu", "Thứ bảy", "Chủ Nhật"],
                    duration: "slow",
                });
            });

            $('#filter_order').click(function () {
                var _token = $('input[name="_token"]').val()
                var formDate = $('#datepicker').val()
                var toDate = $('#datepicker1').val()

                $.ajax({
                    url: "http://127.0.0.1:8000/admin/filterData",
                    type: 'POST',
                    dataType: "JSON",
                    data: {
                        _token: _token,
                        formDate: formDate,
                        toDate: toDate,
                    },

                    success: function (response) {
                        console.log(response)
                        if (response.length === 1) {
                            $('#showData').show();
                            $('#myfirstchart').hide();
                        } else {
                            $('#showData').hide();
                            $('#myfirstchart').show();
                            chart.setData(response);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
