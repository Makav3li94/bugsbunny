<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{$setting!=null ? $setting->description : ''}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">

</head>
<body class="skin-blue-dark fixed-layout">
<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label text-center">سیستم مدیریت<br>مشتریان {{$setting!=null && $setting->brand!=null ? $setting->brand : ''}}</p>
    </div>
</div>
<!-- Performing Different Sections Start -->
@yield('content')
<!-- Performing Different Sections End -->
<!-- All Jquery -->
<script src="{{asset('admin/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('admin/assets/node_modules/popper/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Slimscrollbar scrollbar JavaScript -->
<script src="{{asset('admin/assets/node_modules/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('admin/assets/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Wave Effects -->
<script src="{{asset('admin/assets/node_modules/waves/waves.js')}}"></script>
<!-- Toast Massage -->
<script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
<!-- Chart Js -->
<script src="{{asset('admin/assets/node_modules/Chart.js/Chart.min.js')}}"></script>
<!-- DataTables -->
<script src="{{asset('admin/assets//node_modules/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/datatables/export.min.js')}}"></script>
<!-- tags Input -->
<script src="{{asset('admin/assets/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<!-- tags Switchery -->
<script src="{{asset('admin/assets/node_modules/switchery/dist/switchery.min.js')}}"></script>
<!-- Date Picker -->
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-datepicker.min.js')}}"></script>
<!-- Count Down js -->
<script src="{{asset('admin/assets/node_modules/countdown/jquery.countdown.min.js')}}"></script>
<!-- Custom JavaScript -->
@yield('scripts')
<script src="{{asset('admin/assets/js/custom.js')}}"></script>
@if(session()->get('resetPass')=='sent')
    <!-- Toast Javascript -->
    <script>
        $.toast({
            heading: 'موفقیت!'
            , text: 'توکن تغییر رمز ارسال شد.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
    </script>

@endif

@if($errors->all())
    <script>
        $.toast({
            heading: 'خطا!'
            , text: 'لطفا اطلاعات وارد شده را بررسی کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'danger'
            , hideAfter: 3500
            , stack: 6
        });
    </script>
@endif

</body>
</html>
