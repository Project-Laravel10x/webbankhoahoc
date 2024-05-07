<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('client/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/fontawesome/css/fontawesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/plugins/fontawesome/css/all.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/css/owl.theme.default.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('client/assets/plugins/slick/slick-theme.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/select2/css/select2.min.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/plugins/aos/aos.css')}}">

    <link rel="stylesheet" href="{{asset('client/assets/css/style.css')}}">

    <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    @vite(['resources/sass/app.scss'])
    @yield('style')
    <script src="{{asset('client/assets/js/pusher.js')}}"></script>
</head>
<body>

<div class="main-wrapper">

    @include('parts.client.header')

    @yield('content')

    @include('parts.client.footer')

</div>


<script data-cfasync="false"
        src="{{asset('client/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js')}}"></script>
{{--<script src="{{asset('client/assets/js/jquery-3.7.1.min.js')}}"--}}
{{--        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>--}}

<script src="{{asset('client/assets/js/bootstrap.bundle.min.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/js/jquery.waypoints.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>
<script src="{{asset('client/assets/js/jquery.counterup.min.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/plugins/select2/js/select2.min.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/js/owl.carousel.min.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/plugins/slick/slick.js')}}"
        type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/plugins/aos/aos.js')}}" type="531c2ff4b3231a6cc8922d41-text/javascript"></script>

<script src="{{asset('client/assets/js/script.js')}}" type="531c2ff4b3231a6cc8922d41-text/javascript"></script>
<script src="{{asset('client/cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}"
        data-cf-settings="531c2ff4b3231a6cc8922d41-|49" defer></script>

<script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

@vite(['resources/js/app.js'])
@yield('js_custom')
</body>

</html>
