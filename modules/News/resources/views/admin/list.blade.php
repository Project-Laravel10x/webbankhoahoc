@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Tên tin tức</th>
                        <th>Danh mục tin tức</th>
                        <th>Thời gian tạo</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($news as $key => $new)
                        <tr>

                            <td>{{ $key + 1 }}</td>
                            <td>{{ $new['name'] }}</td>
                            <td>{{ $new->newsCategoies->name }}</td>
                            <td>{{ $new['created_at'] }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.news.edit', $new['id']) }}" class="btn btn-warning">Sửa</a>
                                    <form method="POST" action="{{ route('admin.news.delete', $new['id']) }}">
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

