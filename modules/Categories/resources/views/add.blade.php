@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input onchange="getSlug(this)" type="text"
                       class="form-control title @if($errors->has('name')) is-invalid @endif"
                       id="name"
                       placeholder="Enter name" name="name" value="{{ old('name') }}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="email" class="form-label">Slug:</label>
                <input type="text"
                       class="form-control slug @if($errors->has('slug')) is-invalid @endif"
                       id="slug"
                       placeholder="Enter slug" value="{{ old('slug') }}" name="slug">
                @error('slug')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="parent" class="form-label">Parent:</label>
                <select
                    class="form-control @if($errors->has('parent_id')) is-invalid @endif"
                    id="parent" name="parent_id">
                    <option value="0">Không</option>
                    {!!   getCategories($categories,old('parent_id'))  !!}
                </select>
                @error('parent_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>


            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('index') }}" class="btn btn-dark">Quay lại</a>
        </form>
    </div>
@endsection
