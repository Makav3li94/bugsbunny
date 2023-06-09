<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="{!! strip_tags(html_entity_decode($sub))  ?? strip_tags(html_entity_decode($setting->description)) ??  "isbug" !!}"/>
    <link rel="shortcut icon" href="{{asset('front/img/favicon.png')}}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('front/assets/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/slick/slick.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/slick/slick-theme.css')}}">
    <!-- icon css-->
    <link rel="stylesheet" href="{{asset('front/assets/font-awesome/css/all.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/elagent-icon/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/animation/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/mcustomscrollbar/jquery.mCustomScrollbar.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/rtl.css')}}">
    @yield('style')
    <title>{{$title ?? $setting->name ?? "ایزباگ"}}</title>
</head>

<body data-scroll-animation="true" class="doc">

@include('layouts.front.front_header')

@yield('content')

@include('layouts.front.front_footer')
</div>

<!-- Back to top button -->
<a id="back-to-top" title="Back to Top"></a>
@include('layouts.front.front_footer_scripts')
</body>
</html>








