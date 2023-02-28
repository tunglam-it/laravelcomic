<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Anime Template">
    <meta name="keywords" content="Anime, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@yield('title')
    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mulish:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/ico" href="{{asset('client/assets/img/image.ico')}}"/>

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('client/assets/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/plyr.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('client/assets/css/style.css')}}" type="text/css">
</head>

<body>
<!-- Page Preloder -->
<div id="preloder">
    <div class="loader"></div>
</div>
<!-- Header Section Begin -->
@include('client.layouts.header')
<!-- Header End -->

<!-- Hero Section Begin -->
@if(!request()->routeIs('client.home'))
    @yield('breadcrumb')
@else
    @include('client.layouts.slide')
@endif
<!-- Hero Section End -->

<!-- Product Section Begin -->
@yield('content_client')
<!-- Product Section End -->

<!-- Footer Section Begin -->
@include('client.layouts.footer')
<!-- Footer Section End -->

<!-- Js Plugins -->
<script src="{{asset('client/assets/js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('client/assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('client/assets/js/player.js')}}"></script>
<script src="{{asset('client/assets/js/mixitup.min.js')}}"></script>
<script src="{{asset('client/assets/js/jquery.slicknav.js')}}"></script>
<script src="{{asset('client/assets/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('client/assets/js/main.js')}}"></script>
<script src="{{asset('client/assets/js/ajax/ajax.search.js')}}"></script>
<script src="{{asset('client/assets/js/ajax/ajax.favor.js')}}"></script>
@yield('js')
</body>

</html>
