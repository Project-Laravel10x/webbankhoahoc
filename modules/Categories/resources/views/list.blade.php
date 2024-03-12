@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Slug</th>
                        <th>Thời gian</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($categories as $key => $category)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $category['name'] }}</td>
                            <td><a href="{{ $category['slug'] }}" class="btn btn-primary">Link</a></td>
                            <td>{{ $category['created_at'] }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.categories.edit', $category['id']) }}" class="btn btn-warning">Sửa</a>
                                    <form method="POST" action="{{ route('admin.categories.delete', $category['id']) }}">
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

