@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input onchange="getSlug(this)" type="text"
                               class="form-control title @if($errors->has('name')) is-invalid @endif"
                               id="name"
                               placeholder="Enter name" name="name" value="{{ old('name') ?? $course->name }}">
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
                               placeholder="Enter slug" value="{{ old('slug') ?? $course->slug }}" name="slug">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="teacher" class="form-label">Giảng viên:</label>
                        <select class="form-control @if($errors->has('teacher_id')) is-invalid @endif" id="teacher"
                                name="teacher_id">
                            <option value="0">
                                Chọn giảng viên
                            </option>
                            @if($teachers)
                                @foreach($teachers as $teacher)
                                    <option
                                        value="{{ $teacher->id }}" {{ old('teacher_id') ==  $teacher->id || $course->teacher_id ==  $teacher->id ? "selected" : null }}>{{ $teacher->name }}</option>
                                @endforeach
                            @endif
                        </select>
                        @error('teacher_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="code" class="form-label">Mã khóa học:</label>
                        <input type="text" class="form-control @if($errors->has('code')) is-invalid @endif" id="code"
                               placeholder="Enter code" name="code" value="{{ old('code') ?? $course->code }}">
                        @error('code')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="price" class="form-label">Giá:</label>
                        <input type="number" class="form-control @if($errors->has('price')) is-invalid @endif" id="name"
                               placeholder="Enter price" name="price" value="{{ old('price') ?? $course->price }}">
                        @error('price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="sale_price" class="form-label">Giá khuyến mại:</label>
                        <input type="text" class="form-control @if($errors->has('sale_price')) is-invalid @endif"
                               id="name"
                               placeholder="Enter sale price" name="sale_price"
                               value="{{ old('sale_price') ?? $course->sale_price }}">
                        @error('sale_price')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="is_document" class="form-label">Tài liệu đính kèm:</label>
                        <select class="form-control @if($errors->has('is_document')) is-invalid @endif" id="is_document"
                                name="is_document">
                            <option
                                value="0" {{ old('is_document') == 0 || $course->is_document ? ' selected' : false }} >
                                Không
                            </option>
                            <option
                                value="1" {{ old('is_document') == 1 || $course->is_document ? ' selected' : false }} >
                                Có
                            </option>
                        </select>
                        @error('is_document')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="status" class="form-label">Trạng thái:</label>
                        <select class="form-control @if($errors->has('status')) is-invalid @endif" id="status"
                                name="status">
                            <option value="0" {{ old('status') == 0 || $course->status ? ' selected' : false }}>Chưa ra
                                mắt
                            </option>
                            <option value="1" {{ old('status') == 1 || $course->status ? ' selected' : false }}>Đã ra
                                mắt
                            </option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="detail" class="form-label">Chi tiết:</label>
                        <textarea name="detail" placeholder="Detail ..."
                                  class="form-control ckeditor @if($errors->has('detail')) is-invalid @endif"
                                  id="detail" cols="10"
                                  rows="10">{{ old('detail') ?? $course->detail }}</textarea>

                        @error('detail')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="support" class="form-label">Hỗ trợ:</label>
                        <textarea name="support" placeholder="Support ..."
                                  class="form-control @if($errors->has('support')) is-invalid @endif" id="" cols="10"
                                  rows="10">{{ old('support') ?? $course->support }}</textarea>

                        @error('support')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="detail" class="form-label">Chuyên mục:</label>
                        <div class="list-category">
                            {!! getCategoriesCheckbox($categories,old('categories') ?? $categoryIds)   !!}
                        </div>
                        @error('categories')
                        <div class="invalid-feedback d-block">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
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
                                       value="{{ old('thumbnail') ?? $course->thumbnail }}">
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
                                    @if($course->thumbnail)
                                        <img width="150px" src="{{ $course->thumbnail   }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-dark">Quay lại</a>
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
        CKEDITOR.replace('detail')
    </script>
@endsection
