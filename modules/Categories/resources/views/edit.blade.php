@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{ route('admin.categories.update',$category->id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="mb-3 mt-3">
                <label for="name" class="form-label">Name:</label>
                <input type="text"
                       class="form-control title @if($errors->has('name')) is-invalid @endif"
                       id="name"
                       placeholder="Enter name" name="name" value="{{ old('name') ?? $category->name }}">
                @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>

            <div class="mb-3 mt-3">
                <label for="slug" class="form-label">Slug:</label>
                <input type="text"
                       class="form-control slug @if($errors->has('slug')) is-invalid @endif"
                       id="slug"
                       placeholder="Enter slug" value="{{ old('slug') ?? $category->slug }}" name="slug">
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
                    {!!  getCategories($categories , old('parent_id') ?? $category->parent_id)  !!}
                </select>
                @error('parent_id')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
                @enderror
            </div>
            <div class="col-12">
                <div class="mb-3 mt-3">
                    <div
                        class="row @if($errors->has('thumbnail')) align-items-center @else align-items-end @endif   ">
                        <div class="col-7">
                            <label for="thumbnail" class="form-label mb-0">Ảnh đại diện:</label>
                            <input type="text" class="form-control @if($errors->has('thumbnail')) is-invalid @endif"
                                   id="thumbnail"
                                   placeholder="Enter sale thumbnail" name="thumbnail"
                                   value="{{ old('thumbnail') ?? $category->thumbnail }}">
                            @error('thumbnail')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="col-2">
                            <button id="lfm" data-input="thumbnail" data-preview="holder" type="button"
                                    class="btn btn-primary">Chọn ảnh
                            </button>
                        </div>
                        <div class="col-3">
                            <div id="holder">
                                @if($category->thumbnail)
                                    <img width="150px" src="{{ $category->thumbnail   }}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-dark">Quay lại</a>


        </form>
    </div>
@endsection
