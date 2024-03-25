@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{ route('admin.groups.update',$group->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text"
                       class="form-control @if($errors->has('name')) is-invalid @endif"
                       id="name"
                       placeholder="Enter name" name="name" value="{{ old('name') ?? $group->name }}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.groups.index') }}" class="btn btn-dark">Quay lại</a>


        </form>
    </div>
@endsection
