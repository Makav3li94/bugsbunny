<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <title>{{"buggy - ".$title ?? "buggy"}}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="buggy "/>
    <meta name="keywords" content="buggy"/>
    <meta name="author" content=""/>
    <meta name="email" content=""/>
    <meta name="website" content=""/>
    <meta name="Version" content="v-0.1"/>
    <!-- favicon -->
    <link rel="shortcut icon" href="{{asset('front/images/fav.png')}}">
    <!-- Bootstrap -->
    <link href="{{asset('front/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css"/>

</head>

<body>
<!-- Header Start -->

{{--@include('layouts.front.front_header',['title'=>$title,'sub'=>$sub,'sl'=>$sl,'subLink'=>$subLink,'page'=>$page])--}}
<div class="main-wrapper ">

    <!-- Header Close -->
    @yield('content')

{{--    @include('layouts.front.front_footer')--}}


</div>



@include('layouts.front.front_footer_scripts')
