<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">
    <!-- Stylesheets -->
    <link href="{{asset('assets/frontend/css/common-css/bootstrap.css')}}" rel="stylesheet">

    <link href="{{asset('assets/frontend/css/common-css/swiper.css')}}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/11d3050a53.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/frontend/css/common-css/ionicons.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    @yield('css')

</head>
<body >

@include('layouts.frontend.header')

    @yield('content')

@include('layouts.frontend.footer')





<script src="{{asset('assets/frontend/js/common-js/jquery-3.1.1.min.js')}}"></script>

<script src="{{asset('assets/frontend/js/common-js/tether.min.js')}}"></script>

<script src="{{asset('assets/frontend/js/common-js/bootstrap.js')}}"></script>

<script src="{{asset('assets/frontend/js/common-js/swiper.js')}}"></script>

<script src="{{asset('assets/frontend/js/common-js/scripts.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.15.1/dist/sweetalert2.all.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
{!! Toastr::message() !!}
@yield('js')

</body>
</html>
