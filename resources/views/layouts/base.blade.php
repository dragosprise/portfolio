<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Prisecaru Dragos</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="{{asset('templates/assets/fonts/unicons/css/line.css')}}">
    <!-- CSS -->
    <!-- SWIPER CSS -->
    <link rel="stylesheet" href="{{asset('templates/assets/css/swiper-bundle.min.css')}}">
    <link rel="stylesheet" href="{{asset('templates/assets/css/styles.css')}}">
    @if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css','resources/js/app.js'])
    @endif
</head>
<body>
<!--==================== HEADER ====================-->
@include('layouts.header')
<!--==================== MAIN ====================-->
<main class="main">
@yield('content')
</main>

<!--==================== FOOTER ====================-->
@include('layouts.footer')
<!--==================== SCROLL TOP ====================-->
<a href="#" class="scrollup" id="scroll-up">
    <i class="uil uil-arrow-up scrollup_icon"></i>
</a>

<!--==================== SWIPER JS ====================-->
<script src="{{asset('templates/assets/js/swiper-bundle.min.js')}}"></script>

<!--==================== MAIN JS ====================-->
<script src="{{asset('templates/assets/js/main.js')}}"></script>
</body>
</html>
