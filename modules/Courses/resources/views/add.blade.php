@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
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

                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="teacher" class="form-label">Giảng viên:</label>
                        <select class="form-control @if($errors->has('teacher_id')) is-invalid @endif" id="teacher"
                                name="teacher_id">
                            <option value="0" {{ old('teacher_id') == 0 ? ' selected' : false }} >Chọn giảng viên
                            </option>
                            <option value="1" {{ old('teacher_id') == 1 ? ' selected' : false }} >Quách Hoàng Nam
                            </option>
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
                               placeholder="Enter code" name="code" value="{{ old('code') }}">
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
                               placeholder="Enter price" name="price" value="{{ old('price') }}">
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
                               placeholder="Enter sale price" name="sale_price" value="{{ old('sale_price') }}">
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
                            <option value="0" {{ old('is_document') == 0 ? ' selected' : false }} >Không</option>
                            <option value="1" {{ old('is_document') == 1 ? ' selected' : false }} >Có</option>
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
                            <option value="0" {{ old('status') == 0 ? ' selected' : false }}>Chưa ra mắt</option>
                            <option value="1" {{ old('status') == 1 ? ' selected' : false }}>Đã ra mắt</option>
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
                                  rows="10">{{ old('detail') }}</textarea>

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
                                  rows="10">{{ old('support') }}</textarea>

                        @error('support')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <div class="row align-items-end">
                            <div class="col-7">
                                <label for="thumbnail" class="form-label">Ảnh đại diện:</label>
                                <input type="text" class="form-control @if($errors->has('thumbnail')) is-invalid @endif"
                                       id="thumbnail"
                                       placeholder="Enter sale thumbnail" name="thumbnail"
                                       value="{{ old('thumbnail') }}">
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
                                    @if(old('thumbnail'))
                                        <img width="150px" src="{{ old('thumbnail') }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('index') }}" class="btn btn-dark">Quay lại</a>
            </div>

        </form>
    </div>
@endsection

@section('js_custom')
    <script>
        CKEDITOR.replace('detail')
    </script>
@endsection
