@extends('layouts.backend')

@section('content')

    @if(session('msg'))
        <div class="alert alert-success">
            {{ session('msg') }}
        </div>
    @endif
    <div class="row-cols-auto">
        <form action="{{ route('admin.students.store_student_by_course',$courses['id']) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3 mt-3">
                        <label for="name" class="form-label">Tên học viên:</label>
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
                        <label for="email" class="form-label">Email:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('email')) is-invalid @endif"
                               id="email"
                               placeholder="Enter email" name="email" value="{{ old('email') }}">
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
                               placeholder="Enter password" name="password" value="{{ old('password') }}">
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
                               placeholder="Enter phone" name="phone" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="mb-3 mt-3">
                        <label for="address" class="form-label">Địa chỉ:</label>
                        <input type="text"
                               class="form-control  @if($errors->has('address')) is-invalid @endif"
                               id="address"
                               placeholder="Enter address" name="address" value="{{ old('address') }}">
                        @error('address')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>


                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('admin.students.list_student_by_course',$courses['id']) }}" class="btn btn-dark">Quay lại</a>
            </div>

        </form>
    </div>
@endsection

