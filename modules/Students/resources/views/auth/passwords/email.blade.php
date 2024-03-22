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

<div class="main-wrapper">
    <div class="row">

        <div class="col-md-6 login-bg">
            <div class="owl-carousel login-slide owl-theme aos" data-aos="fade-up">
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
                            <a href="index-2.html">Back to Home</a>
                        </div>
                    </div>
                    <h1>Forgot Password ?</h1>
                    <div class="reset-password">
                        <p>Enter your email to reset your password.</p>
                    </div>
                    <form action="{{ route('students.forgot_password') }}" method="POST">
                        @csrf
                        <div class="input-block">
                            <label class="form-control-label">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Enter your email address">
                            @error('email')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-grid">
                            <button class="btn btn-start" type="submit">Submit</button>
                        </div>
                    </form>
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
