@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('admin.teachers.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên giảng viên:</label>
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
                </div>

                <div class="col-6">
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
                </div>




                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="exp" class="form-label">Số năm kinh nghiệm:</label>
                        <input type="number" class="form-control @if($errors->has('exp')) is-invalid @endif" id="name"
                               placeholder="Enter exp" name="exp" value="{{ old('exp') }}">
                        @error('exp')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Mô tả:</label>
                        <textarea name="description" placeholder="Detail ..."
                                  class="form-control ckeditor @if($errors->has('description')) is-invalid @endif"
                                  id="description" cols="10"
                                  rows="10">{{ old('description') }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <div class="row @if($errors->has('image')) align-items-center @else align-items-end @endif   ">
                            <div class="col-7">
                                <label for="image" class="form-label mb-0">Ảnh đại diện:</label>
                                <input type="text" class="form-control @if($errors->has('image')) is-invalid @endif"
                                       id="image"
                                       placeholder="Enter sale image" name="image"
                                       value="{{ old('image') }}">
                                @error('image')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-2">
                                <button id="lfm" data-input="image" data-preview="holder" type="button"
                                        class="btn btn-primary">Chọn ảnh
                                </button>
                            </div>
                            <div class="col-3">
                                <div id="holder">
                                    @if(old('image'))
                                        <img width="150px" src="{{ old('image') }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.teachers.index') }}" class="btn btn-dark">Quay lại</a>
            </div>

        </form>
    </div>
@endsection

@section('style')
    <style>
        .list-category {
            max-height: 250px;
            overflow: auto;
        }
    </style>
@endsection

@section('js_custom')
    <script>
        CKEDITOR.replace('description')
    </script>
@endsection
