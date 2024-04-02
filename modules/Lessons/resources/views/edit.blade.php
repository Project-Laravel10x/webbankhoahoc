@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        @if(session('msg'))
            <div class="alert alert-success">
                {{ session('msg') }}
            </div>
        @endif
        <form action="{{ route('admin.lessons.update',[$courseId,$lesson->id]) }}" method="POST"
              enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên:</label>
                        <input onchange="getSlug(this)" type="text"
                               class="form-control title @if($errors->has('name')) is-invalid @endif"
                               id="name"
                               placeholder="Enter name" name="name" value="{{ old('name') ?? $lesson->name }}">
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
                               placeholder="Enter slug" value="{{ old('slug')  ?? $lesson->slug }}" name="slug">
                        @error('slug')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="parent_id" class="form-label">Nhóm bài giảng:</label>
                        <select class="form-control select2 @if($errors->has('parent_id')) is-invalid @endif"
                                id="parent_id"
                                name="parent_id">
                            <option value="0" {{ old('parent_id') == 0 ? ' selected' : false }}>Trống</option>
                            {!!   getLesson($lessons,old('parent_id') ?? $lesson->parent_id,request()->get('module'))  !!}
                        </select>
                        @error('parent_id')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="is_trial" class="form-label">Học thử:</label>
                        <select class="form-control @if($errors->has('is_trial')) is-invalid @endif" id="is_trial"
                                name="is_trial">
                            <option value="0" {{ old('is_trial')  ?? $lesson->is_trial == 0 ? ' selected' : false }}>
                                Không cho phép
                            </option>
                            <option value="1" {{ old('is_trial') ?? $lesson->is_trial ? ' selected' : false }}>Có cho
                                phép
                            </option>
                        </select>
                        @error('is_trial')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="position" class="form-label">Sắp xếp:</label>
                        <input type="number"
                               class="form-control  @if($errors->has('position')) is-invalid @endif"
                               id="position"
                               placeholder="Enter position" name="position"
                               value="{{ old('position') ?? $lesson->position }}">
                        @error('position')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="video_id" class="form-label">Link Video Embed Youtube Hoặc Mã Nhúng Iframe :</label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control  @if($errors->has('video_id')) is-invalid @endif"
                                   id="video_id"
                                   placeholder="Video bài giảng" name="video_id"
                                   value="{{ old('video_id')  ?? $lesson->video?->url  }}">
                            <input type="hidden" name="video_id_update" value="{{ $lesson->video?->id }}">
                        </div>
                        @error('video_id')
                        <div class="invalid-feedback d-block">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="document_id" class="form-label">Tài liệu bài giảng:</label>
                        <div class="input-group">
                            <input type="text"
                                   class="form-control  @if($errors->has('document_id')) is-invalid @endif"
                                   id="document_id"
                                   placeholder="Tài liệu bài giảng" name="document_id"
                                   value="{{ old('document_id')  ?? $lesson->document?->url }}">
                            <button id="lfm-document" data-input="document_id" data-preview="holder" type="button"
                                    class="btn btn-success">Chọn tài liệu
                            </button>
                        </div>
                        @error('document_id')
                        <div class="invalid-feedback d-block">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="description" class="form-label">Chi tiết:</label>
                        <textarea name="description" placeholder="Detail ..."
                                  class="form-control @if($errors->has('description')) is-invalid @endif"
                                  id="description" cols="10"
                                  rows="10">{{ old('description')  ?? $lesson->description }}</textarea>

                        @error('description')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.lessons.index',$courseId) }}" class="btn btn-dark">Quay lại</a>
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
