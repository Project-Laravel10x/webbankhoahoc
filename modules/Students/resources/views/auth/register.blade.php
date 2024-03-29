<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from dreamslms.dreamstechnologies.com/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Mar 2024 08:30:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dreams LMS</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client/assets/img/favicon.svg')}}">

    <link rel="stylesheet" href="{{asset('client/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/feather/feather.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/css/style.css')}}">
</head>
<body>

<div class="main-wrapper log-wrap">
    <div class="row">

        <div class="col-md-6 login-bg">
            <div class="owl-carousel login-slide owl-theme">
                <div class="welcome-login">
                    <div class="login-banner">
                        <img src="{{asset('client/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                    </div>
                    <div class="mentor-course text-center">
                        <h2>Welcome to <br>DreamsLMS Courses.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                </div>
                <div class="welcome-login">
                    <div class="login-banner">
                        <img src="{{asset('client/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                    </div>
                    <div class="mentor-course text-center">
                        <h2>Welcome to <br>DreamsLMS Courses.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                </div>
                <div class="welcome-login">
                    <div class="login-banner">
                        <img src="{{asset('client/assets/img/login-img.png')}}" class="img-fluid" alt="Logo">
                    </div>
                    <div class="mentor-course text-center">
                        <h2>Welcome to <br>DreamsLMS Courses.</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 login-wrap-bg">

            <div class="login-wrapper">
                <div class="loginbox">
                    <div class="img-logo">
                        <img src="{{asset('client/assets/img/logo.svg')}}" class="img-fluid" alt="Logo">
                        <div class="back-home">
                            <a href="">Quay lại trang chủ</a>
                        </div>
                    </div>
                    <h1>{{ $pageTitle }}</h1>
                    <form action="{{ route('students.register') }}" method="POST">
                        @if(session('msg'))
                            <div class="alert alert-success">
                                {{ session('msg') }}
                            </div>
                        @endif
                        @csrf
                        <div class="input-block">
                            <label class="form-control-label">Họ và tên: </label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                                   placeholder="Enter your Full Name.." value="{{ old('name') }}">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <label class="form-control-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" name="email"
                                   placeholder="Enter your email address" value="{{ old('email') }}">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-block">
                            <label class="form-control-label">Mật khẩu</label>
                            <div class="pass-group" id="passwordInput">
                                <input type="password"
                                       class="form-control pass-input @error('password') is-invalid @enderror"
                                       placeholder="Enter your password" name="password">
                                <span class="toggle-password feather-eye"></span>
                                <span class="pass-checked"><i class="feather-check"></i></span>
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="input-block">
                            <label class="form-control-label">Xác nhận mật khẩu</label>
                            <div class="pass-group " id="passwordInput">
                                <input type="password"
                                       class="form-control pass-input @error('confirm_password') is-invalid @enderror"
                                       placeholder="Enter your password" name="confirm_password">
                                <span class="toggle-password feather-eye"></span>
                                <span class="pass-checked"><i class="feather-check"></i></span>
                            </div>
                            @error('confirm_password')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <label class="form-control-label">Số điện thoại:</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone"
                                   placeholder="Enter your phone address" value="{{ old('phone') }}">
                            @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="input-block">
                            <label class="form-control-label">Địa chỉ: </label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                                   placeholder="Enter your address address" value="{{ old('address') }}">
                            @error('address')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>


                        <div class="d-grid">
                            <button class="btn btn-primary btn-start" type="submit">Tạo tài khoản !</button>
                        </div>
                    </form>
                </div>
                <div class="google-bg text-center">
                    <p class="mb-0">Bạn đã có tài khoản ? <a href="{{ route('students.login') }}">Đăng nhập</a></p>
                </div>
            </div>

        </div>
    </div>
</div>


<script src="{{asset('client/assets/js/jquery-3.7.1.min.js')}}"
        type="2e34629ef19a4d1c6ab4d4b0-text/javascript"></script>

<script src="{{asset('client/assets/js/bootstrap.bundle.min.js')}}"
        type="2e34629ef19a4d1c6ab4d4b0-text/javascript"></script>

<script src="{{asset('client/assets/js/owl.carousel.min.js')}}"
        type="2e34629ef19a4d1c6ab4d4b0-text/javascript"></script>

<script src="{{asset('client/assets/js/script.js')}}" type="2e34629ef19a4d1c6ab4d4b0-text/javascript"></script>
<script src="{{asset('client/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="2e34629ef19a4d1c6ab4d4b0-|49" defer></script>
</body>

<!-- Mirrored from dreamslms.dreamstechnologies.com/html/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Mar 2024 08:30:37 GMT -->
</html>
