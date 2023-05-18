<!doctype html>
<html lang="en" dir="rtl">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{asset('front/img/favicon.png')}}" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('front/assets/bootstrap/css/bootstrap.min.css')}}">
    <!-- icon css-->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{asset('front/assets/elagent-icon/style.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/animation/animate.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/rtl.css')}}">
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">


    <title>ایزباگ - ورود / ثبت نام</title>
</head>
<body data-scroll-animation="true">
<div id="preloader">
    <div id="ctn-preloader" class="ctn-preloader">
        <div class="round_spinner">
            <div class="spinner"></div>
            <div class="text">
                <img src="{{asset('front/img/favicon.png')}}" width="30px" alt="">
                <h4 class="mt-2"><span>ایز</span>باگ</h4>
            </div>
        </div>
        <h2 class="head">در حال آماده هسازی</h2>
        <p></p>
    </div>
</div>
<div class="body_wrapper">
    @yield('content')
</div>
<!-- Back to top button -->
<a id="back-to-top" title="Back to Top"></a>

<!-- Slimscrollbar scrollbar JavaScript -->

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('front/js/pre-loader.js')}}"></script>
<script src="{{asset('front/assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('front/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/parallaxie.js')}}"></script>
<script src="{{asset('front/js/TweenMax.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/waves/waves.js')}}"></script>
<!-- Toast Massage -->
<script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
<!-- Chart Js -->
<script src="{{asset('admin/assets//node_modules/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/datatables/export.min.js')}}"></script>
<!-- tags Input -->
<script src="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<!-- tags Switchery -->
<script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
<!-- Sweet Alert -->
<script src="{{asset('admin/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
<!-- Date Picker -->
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-datepicker.min.js')}}"></script>
<script src="{{ asset('admin/assets/node_modules/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js')}}"></script>
<script src="{{asset('front/assets/wow/wow.min.js')}}"></script>
<!-- Count Down js -->
<script src="{{asset('admin/assets/node_modules/countdown/jquery.countdown.min.js')}}"></script
<script src="{{asset('front/js/main-rtl.js')}}"></script>
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
</body>

</html>





