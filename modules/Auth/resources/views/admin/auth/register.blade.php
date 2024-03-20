@extends('layouts.app')

@section('content')
    <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                    <div class="col-lg-6">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">{{ $pageTitle  }} !</h1>
                            </div>
                            @if($errors->any())
                                <div class="alert alert-danger text-center">
                                    Đã có lỗi xảy ra vui lòng kiểm tra lại !
                                </div>
                            @endif
                            @if(session('msg'))
                                <div class="alert alert-success text-center">
                                    {{ session('msg') }}
                                </div>
                            @endif

                            @error('err')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                            <form class="user" action="{{ route('register') }}" method="POST">

                                @csrf
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control form-control-user @error('name') is-invalid @enderror"
                                           id="exampleInputEmail" aria-describedby="emailHelp"
                                           placeholder="Name..." name="name" value="{{ old('name') }}">
                                    @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="text"
                                           class="form-control form-control-user @error('email') is-invalid @enderror"
                                           id="exampleInputEmail" aria-describedby="emailHelp"
                                           placeholder="Email..." name="email" value="{{ old('email') }}">
                                    @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password"
                                           class="form-control form-control-user @error('password') is-invalid @enderror"
                                           id="exampleInputPassword" placeholder="Password"
                                           value="{{ old('password') }}">
                                    @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password"
                                           class="form-control form-control-user @error('confirm_password') is-invalid @enderror"
                                           id="exampleInputPassword" placeholder="Confirm Password">
                                    @error('confirm_password')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary btn-user btn-block">Đăng kí</button>
                                <hr>

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="forgot-password.html">Bạn đã có tài khoản ?</a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
