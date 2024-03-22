@extends('layouts.backend')


@section('content')

    <div class="row-cols-auto">
        <form action="{{ route('admin.students.update', $student['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(session('msg'))
                <div class="alert alert-success">
                    {{ session('msg') }}
                </div>
            @endif
            @method('PUT')
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên học viên:</label>
                        <input onchange="getSlug(this)" type="text"
                               class="form-control title @if($errors->has('name')) is-invalid @endif"
                               id="name"
                               placeholder="Enter name" name="name" value="{{ old('name') ?? $student['name'] }}">
                        @error('name')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('email')) is-invalid @endif"
                               id="email"
                               placeholder="Enter email" name="email" value="{{ old('email') ?? $student['email'] }}">
                        @error('email')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('password')) is-invalid @endif"
                               id="password"
                               placeholder="Enter password" name="password"
                               value="{{ old('password') ?? $student['password'] }}">
                        @error('password')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="phone" class="form-label">Số điện thoại:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('phone')) is-invalid @endif"
                               id="phone"
                               placeholder="Enter phone" name="phone" value="{{ old('phone') ?? $student['phone'] }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('address')) is-invalid @endif"
                               id="address"
                               placeholder="Enter address" name="address"
                               value="{{ old('address') ?? $student['address'] }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="is_active" class="form-label">Kích hoạt học viên:</label>
                        <select name="is_active" class="form-select form-control">
                            <option
                                    value="0" {{ old('is_active') == 0 || $student['is_active'] == 0 ? 'selected' :false  }}>
                                Chưa
                                kích hoạt
                            </option>
                            <option
                                    value="1"{{ old('is_active') == 1 ||   $student['is_active'] == 1 ? 'selected' :false   }}>
                                Kích hoạt
                            </option>
                        </select>
                    </div>
                </div>


                {{--                <div class="col-12">--}}
                {{--                    <div class="mb-3 mt-3">--}}
                {{--                        <div class="row @if($errors->has('image')) align-items-center @else align-items-end @endif   ">--}}
                {{--                            <div class="col-7">--}}
                {{--                                <label for="image" class="form-label mb-0">Ảnh đại diện:</label>--}}
                {{--                                <input type="text" class="form-control @if($errors->has('image')) is-invalid @endif"--}}
                {{--                                       id="image"--}}
                {{--                                       placeholder="Enter sale image" name="image"--}}
                {{--                                       value="{{ old('image') }}">--}}
                {{--                                @error('image')--}}
                {{--                                <div class="invalid-feedback">--}}
                {{--                                    {{$message}}--}}
                {{--                                </div>--}}
                {{--                                @enderror--}}
                {{--                            </div>--}}
                {{--                            <div class="col-2">--}}
                {{--                                <button id="lfm" data-input="image" data-preview="holder" type="button"--}}
                {{--                                        class="btn btn-primary">Chọn ảnh--}}
                {{--                                </button>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-3">--}}
                {{--                                <div id="holder">--}}
                {{--                                    @if(old('image'))--}}
                {{--                                        <img width="150px" src="{{ old('image') }}" alt="">--}}
                {{--                                    @endif--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}

                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.students.index') }}" class="btn btn-dark">Quay lại</a>
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
