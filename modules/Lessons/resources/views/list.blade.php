@extends('layouts.backend')

@section('content')
    <a href="{{ route('admin.courses.index') }}" class="btn btn-info mb-3">Quay lại khóa học</a>
    <a href="{{ route('admin.lessons.sort', $courseId) }}" class="btn btn-success mb-3">Sắp xếp khóa học</a>
    <a href="{{ route('admin.lessons.create',$courseId) }}" class="btn btn-primary mb-3">Thêm</a>

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
                        <th>Try learning</th>
                        <th>Views</th>
                        <th>Durations</th>
                        <th>Thêm</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($lessons as $key => $lesson)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $lesson['name'] }}</td>
                            <td>
                                @if($lesson['is_trial'] == 0)
                                    <a href="" class="btn btn-danger">Không</a>
                                @else
                                    <a href="" class="btn btn-primary">Học thử</a>
                                @endif
                            </td>
                            <td>{{ $lesson['view'] }}</td>
                            <td>{{ formatTime($lesson['durations']) }}</td>
                            <td>
                                @if($lesson['parent_id'] == null)
                                    <a href="{{ route('admin.lessons.create',
                                                ['module' => $lesson['position'],
                                                 $courseId]) }}"
                                       class="btn btn-primary">Thêm bài</a>
                                @endif
                            </td>
                            <td><a href="{{ route('admin.lessons.edit',[$courseId, $lesson['id']]) }}"
                                   class="btn btn-warning">Sửa</a></td>
                            <td>
                                <form method="POST"
                                      action="{{ route('admin.lessons.delete', [$courseId, $lesson['id']]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure ?')"
                                            class="btn btn-danger">Xóa
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

