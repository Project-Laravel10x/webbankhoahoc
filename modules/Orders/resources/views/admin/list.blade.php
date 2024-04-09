@extends('layouts.backend')

@section('content')

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Users</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(session('msg'))
                    <div class="alert alert-success">
                        {{ session('msg') }}
                    </div>
                @endif
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên người đặt</th>
                        <th>Tổng tiền</th>
                        <th>Số lượng khóa mua</th>
                        <th>Thời gian đặt</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($orders as  $order)
                        <tr>
                            <td>#{{ $order['id'] }}</td>
                            <td>{{ $order->students->name }}</td>
                            <td>{{ formatCurrency($order['total']) }}</td>
                            <td>{{ count($order->orderDetail) }}</td>
                            <td>{{ $order['created_at'] }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.orders.detail', $order['id']) }}" class="btn btn-warning">Chi tiết đơn hàng</a>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

