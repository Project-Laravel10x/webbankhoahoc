@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.students.create') }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Số điện thọai</th>
                        <th>Địa chỉ</th>
                        <th>Trạng thái</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($students as $key => $student)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $student['name'] }}</td>
                            <td>{{ $student['email'] }}</td>
                            <td>{{ $student['phone'] }}</td>
                            <td>{{ $student['address'] }}</td>
                            <td>
                                @if($student['is_active'] == 0)
                                    <button class="btn btn-warning">Chưa kích hoạt</button>
                                @elseif($student['is_active'] == 1)
                                    <button class="btn btn-success">Đã kích hoạt</button>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.students.edit', $student['id']) }}" class="btn btn-warning">Sửa</a>
                                    <form method="POST" action="{{ route('admin.students.delete', $student['id']) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" onclick="return confirm('Are you sure ?')"
                                                class="btn btn-danger">Xóa
                                        </button>
                                    </form>
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

