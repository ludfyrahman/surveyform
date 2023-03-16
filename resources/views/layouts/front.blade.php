<!doctype html>
<html class="no-js" lang="en">


<!-- Mirrored from eduvibe.html.devsvibe.com/index-two.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 04 Oct 2022 13:17:20 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Landing Page - Survey App</title>
    <meta name="robots" content="noindex, follow" />
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- CSS
	============================================ -->
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/remixicon.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/eduvibe-font.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/magnifypopup.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/lightbox.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/animation.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/vendor/jqueru-ui-min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">
</head>
<body>
    <div class="main-wrapper">
        @include('includes.frontend.navbar')
        @include('includes.frontend.header')
        @yield('content-app')
        @include('includes.frontend.footer')
    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- JS
============================================ -->
    <!-- Modernizer JS -->
    <script src="{{asset('frontend/js/vendor/modernizr.min.js')}}"></script>
    <!-- jQuery JS -->
    <script src="{{asset('frontend/js/vendor/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/sal.min.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/backtotop.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/magnifypopup.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/slick.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/countdown.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/jquery-appear.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/odometer.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/isotop.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/imageloaded.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/lightbox.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/wow.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/paralax.min.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/paralax-scroll.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/jquery-ui.js')}}"></script>
    <script src="{{asset('frontend/js/vendor/tilt.jquery.min.js')}}"></script>
    <!-- Main JS -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>
</html>
