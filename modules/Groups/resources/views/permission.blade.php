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
                <form action="" method="post">
                    @csrf
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th class="col-4">Module</th>
                            <th>Quyền</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($modules as $key => $module)
                            <tr>
                                <td>{{ $module->title }}</td>
                                <td>
                                    <div class="row">
                                        @foreach($roleListArr as $roleName => $roleLabel)
                                            <div class="col-2">
                                                <label for="role_{{ $module->name }}_{{$roleName}}"></label>
                                                <input type="checkbox" name="role[{{ $module->name }}][]"
                                                       id="role_{{ $module->name }}_{{$roleName}}"
                                                       value="{{$roleName}}"
                                                    {{ isRole($roleArr,$module->name ,$roleName) ? 'checked': false }}>{{ $roleLabel }}
                                            </div>

                                        @endforeach

                                        @if(\Illuminate\Support\Facades\Auth::user()->group_id == 1 && $key == (int)(count($modules) / 2))
                                            <div class="col-2">
                                                <label for="role_groups_permission"></label>
                                                <input type="checkbox" name="role[groups][]"
                                                       id="role_groups_permission"
                                                       value="permission"
                                                    {{ isRole($roleArr,'groups' ,'permission') ? 'checked': false }}
                                                >Phân quyền
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-primary">Phân quyền</button>
                </form>
            </div>
        </div>
    </div>
@endsection

