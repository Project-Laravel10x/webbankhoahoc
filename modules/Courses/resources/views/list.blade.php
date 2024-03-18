@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Price</th>
                        <th>Status</th>
                        <th>Time</th>
                        <th>Lesson</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($courses as $key => $course)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $course['name'] }}</td>
                            <td>{{$course['price'] == 0 ? "Miễn phí" : number_format($course['price']) .'đ' }}</td>
                            <td>
                                @if($course['status'] == 0)
                                    <button class="btn btn-warning">Chưa ra mắt</button>
                                @elseif($course['status'] == 1)
                                    <button class="btn btn-success">Đã ra mắt</button>
                                @endif
                            </td>
                            <td>{{ $course['created_at'] }}</td>
                            <td>  <a href="{{ route('admin.lessons.index', $course['id']) }}" class="btn btn-primary">Bài giảng</a></td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.courses.edit', $course['id']) }}" class="btn btn-warning">Sửa</a>
                                    <form method="POST" action="{{ route('admin.courses.delete', $course['id']) }}">
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

