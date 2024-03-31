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
                    <tr>
                        <th>MÃ HÓA ĐƠN</th>
                        <th>TÊN KHÓA HỌC</th>
                        <th>ẢNH</th>
                        <th>GIÁ KHÓA HỌC</th>
                        <th>NGÀY MUA</th>
                    </tr>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($detailOrders as $detailOrder)
                        <tr>
                            <td><a href="#" class="invoice-no">#{{ $detailOrder->orders->id }}</a></td>
                            <td>{{ $detailOrder->courses->name }}</td>
                            <td><img width="100px" src="{{ $detailOrder->courses->thumbnail }}" alt=""></td>
                            <td>{{ formatCurrency($detailOrder->price) }}</td>
                            <th>{{ $detailOrder->created_at     }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

