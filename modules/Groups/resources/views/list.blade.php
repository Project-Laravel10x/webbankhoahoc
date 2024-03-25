@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Người tạo</th>
                            @can('groups.permission')
                            <th>Phân quyền</th>
                        @endcan
                        <th>Thời gian</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($groups as $group)
                        <tr>
                            <td>{{ $group->id }}</td>
                            <td>{{ $group->name }}</td>
                            <td>{{ $group->usersId->name }}</td>
                            @can('groups.permission')
                                <td><a class="btn btn-info"
                                       href="{{ route('admin.groups.permission_view',$group->id) }}">Phân
                                        Quyền
                                    </a></td>
                            @endcan
                            <td>{{ $group->created_at }}</td>
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('admin.groups.edit', $group->id) }}"
                                       class="btn btn-warning">Sửa</a>
                                    <form method="POST" action="{{ route('admin.groups.delete', $group->id) }}">
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

