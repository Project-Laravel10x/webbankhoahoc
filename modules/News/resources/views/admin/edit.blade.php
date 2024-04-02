@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('admin.news.update',$new['id']) }}" method="POST"
              enctype="multipart/form-data"> @if(session('msg'))
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
            @endif
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input onchange="getSlug(this)" type="text"
                               class="form-control title @if($errors->has('name')) is-invalid @endif"
                               id="name"
                               placeholder="Enter name" name="name" value="{{ old('name') ?? $new['name']  }}">
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
                               placeholder="Enter slug" value="{{ old('slug') ?? $new['slug']  }}" name="slug">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="new_category_id" class="form-label">Danh mục tin tức:</label>
                        <div class="list-category">
                            <select class="form-control" name="new_category_id" id="">
                                <option value="0">Chọn danh mục</option>
                                @foreach($news as $item)
                                    <option
                                        value="{{ $item['id'] }}" {{ old('new_category_id') == $item['id'] || $new['new_category_id'] ==$item['id']  ? "selected" : false }}>{{ $item['name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('new_category_id')
                        <div class="invalid-feedback d-block">
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
                                        value="{{ $teacher->id }}" {{ old('teacher_id') ==  $teacher->id || $new->teacher_id ==  $teacher->id ? "selected" : null }}>{{ $teacher->name }}</option>
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

                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="content" class="form-label">Content:</label>
                        <textarea name="content" placeholder="Detail ..."
                                  class="form-control ckeditor @if($errors->has('content')) is-invalid @endif"
                                  id="content" cols="10"
                                  rows="10">{{ old('content') ?? $new[ 'content'] }}</textarea>

                        @error('content')
                        <div class="invalid-feedback">
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
                                       value="{{ old('thumbnail') ??  $new['thumbnail'] }}">
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
                                    @if($new['thumbnail'])
                                        <img width="150px" src="{{ old('thumbnail') ??  $new['thumbnail'] }}" alt="">
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.news.index') }}" class="btn btn-dark">Quay lại</a>
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
