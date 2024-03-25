@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('admin.groups.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6 mb-3 mt-3">
                    <label for="name" class="form-label">Thêm nhóm quyền:</label>
                    <input type="text"
                           class="form-control @if($errors->has('name')) is-invalid @endif"
                           id="name"
                           placeholder="Enter name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div class="invalid-feedback">
                        {{$message}}
                    </div>
                    @enderror
                </div>

            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.groups.index') }}" class="btn btn-dark">Quay lại</a>
        </form>
    </div>
@endsection
