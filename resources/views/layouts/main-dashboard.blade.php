<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{isset($setting) ? $setting->description : ''}}">
    <meta name="keywords" content="{{isset($setting) ? $setting->keywords : ''}}">
    <meta name="author" content="Parham Akbari">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @yield('styles')
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <link rel="stylesheet"
          href="{{ asset('admin/assets/node_modules/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')}}">
    <link href="{{asset('admin/assets/node_modules/timepicker/css/timepicker.min.css')}}" rel="stylesheet"/>

</head>

<body class="skin-blue-dark fixed-layout">
<!-- Preloader -->
<div class="preloader">
    <div class="loader">
        <div class="loader__figure"></div>
        <p class="loader__label text-center">isBug</p>
    </div>
</div>
<!-- Main wrapper -->
<div id="main-wrapper">
    <!-- Topbar header -->
    <header class="topbar">
        <nav class="navbar top-navbar navbar-expand-md navbar-dark">
            <!-- Logo -->
            <div class="navbar-header">
                <a class="navbar-brand"
                   href="@if(strpos(url()->current(),'/admin/dashboard')==true){{route('admin.dashboard')}} @else {{route('user.dashboard')}} @endif">
                    <b>
                        {{!isset($setting) ? '' : $setting->brand}}
                    </b>
                    <span>
                        <img src="{{asset('admin/assets/images/logo-text.png')}}" class="dark-logo"
                             alt="{{!isset($setting) ? '' : $setting->brand}}">
                        <img
                            src="{{isset($setting) && $setting->first_logo!=null ? $setting->first_logo : asset('admin/assets/images/logo-light-text.png')}}"
                            class="light-logo" width="120"
                            alt="{{!isset($setting) ? '' : $setting->brand}}"/>
                    </span>
                </a>
            </div>
            <!-- End Logo -->
            <div class="navbar-collapse">
                <!-- toggle and nav items -->
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item"><a class="nav-link nav-toggler d-block d-md-none waves-effect waves-dark"
                                            href="javascript:void(0)"><i class="ti-menu"></i></a></li>
                    <li class="nav-item"><a
                            class="nav-link sidebartoggler d-none d-lg-block d-md-block waves-effect waves-dark"
                            href="javascript:void(0)"><i class="icon-menu"></i></a></li>
                @if(strpos(url()->current(),'/admin/dashboard')==true)
                    <!-- Search -->
                        <li class="nav-item">
                            <form class="app-search d-none d-md-block d-lg-block" autocomplete="off">
                                <input type="text" class="form-control" placeholder="نام یا شماره موبایل">
                                <div class="list-group">
                                </div>
                            </form>
                        </li>
                    @endif
                </ul>

                <!-- User profile and search -->
                <ul class="navbar-nav my-lg-0">
                    <!-- User Profile -->
                    <li class="nav-item dropdown u-pro">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark profile-pic" href=""
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                                src="{{asset('admin/assets/images/1.png')}}" alt="user" class=""> <span
                                class="hidden-md-down">{{auth()->user()->name}}<i
                                    class="fa fa-angle-down"></i></span>
                        </a>


                        <div class="dropdown-menu dropdown-menu-right animated flipInY text-right">
                            <a href="@if(strpos(url()->current(),'/admin/dashboard')==true){{route('admin.profile.edit',auth()->user()->id)}} @else {{route('user.primary.edit',auth()->user()->id)}} @endif"
                               class="dropdown-item"><i class="ti-user"></i> پروفایل من</a>
                            <a href="#" class="dropdown-item"
                               onclick="event.preventDefault();document.getElementById('logout').submit()"><i
                                    class="fa fa-power-off"></i>
                                خروج</a>
                            <form id="logout" method="post"
                                  action="{{strpos(url()->current(), '/admin/dashboard') == true ? route('admin.logout') : route('logout')}}"
                                  style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @include('layouts.components.notification')
                    <!-- End User Profile -->
                </ul>
            </div>
        </nav>
    </header>
    <!-- End Topbar header -->
@if(strpos(url()->current(),'/admin/dashboard')==true)
    @include('layouts.admin.aside')
@else
    @include('layouts.user.aside')
@endif
<!-- Page wrapper -->
    <div class="page-wrapper">
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- Bread crumb and right sidebar toggle -->
            <div class="row page-titles mb-3">
                <div class="col-md-5 align-self-center">
                    <h4 class="text-themecolor">@yield('current-page-title')</h4>
                </div>
                <div class="col-md-7 align-self-center text-left">
                    <div class="d-flex justify-content-end align-items-center">
                        <ol class="breadcrumb float-md-left">
                            @yield('breadcrumbs')
                        </ol>
                    </div>
                </div>
                </div>


        <!-- End Bread crumb and right sidebar toggle -->
            @yield('content')
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Page wrapper -->
    <!-- footer -->
    <footer class="footer">
        <p>© 2022-2023 تمام حقوق مادی و معنوی برای <a
                href="{{!isset($setting) ? '#' : $setting->domain}}">{{!isset($setting) ? '' : $setting->brand}}</a>
            محفوظ است.</p>

    </footer>
    <!-- End footer -->
</div>
<!-- End Wrapper -->
<!-- All Jquery -->
<script src="{{asset('admin/assets/node_modules/jquery/jquery-3.2.1.min.js')}}"></script>
<!-- Bootstrap popper Core JavaScript -->
<script src="{{asset('admin/assets/node_modules/popper/popper.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Slimscrollbar scrollbar JavaScript -->
<script src="{{asset('admin/assets/node_modules/perfect-scrollbar/js/perfect-scrollbar.jquery.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('admin/assets/node_modules/select2/dist/js/select2.full.min.js')}}"></script>
<!-- Wave Effects -->bootstrap forum
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
<!-- Sweet Alert -->
<script src="{{asset('admin/assets/node_modules/sweetalert/sweetalert.min.js')}}"></script>
<!-- Date Picker -->
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-date.min.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/persian-datepicker/persian-datepicker.min.js')}}"></script>
<script src="{{ asset('admin/assets/node_modules/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js')}}"></script>

@if(strpos(url()->current(), '/admin/dashboard') == true)
    @yield('script');

    <!-- wysiwyg - Froala Editor Javascript -->
    <script src="{{ asset('admin/assets/node_modules/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('admin/assets/node_modules/timepicker/js/timepicker.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/custom-admin.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });

        var timepicker = new TimePicker('publish_time', {
            lang: 'en',
            theme: 'dark',
        });
        timepicker.on('change', function (evt) {

            var value = (evt.hour || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;

        });
    </script>
@else
    @yield('user_script');
    <script src="{{ asset('admin/assets/node_modules/ckeditor/ckeditor.js')}}"></script>

    <script src="{{asset('admin/assets/node_modules/timepicker/js/timepicker.min.js')}}"></script>
    <!-- Clock Picker  Javascript -->
    <script>
        CKEDITOR.replace('editor1', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });

        var timepicker = new TimePicker('publish_time', {
            lang: 'en',
            theme: 'dark',
        });
        timepicker.on('change', function (evt) {

            var value = (evt.hour || '00') + ':' + (evt.minute || '00');
            evt.element.value = value;

        });
    </script>
    <!-- Custom User JavaScript -->
    <script src="{{asset('admin/assets/js/custom.js')}}"></script>

@endif
<script>
    $(document).ready(function () {
        @if(session()->get('store')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات با موفقیت افزوده شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('delete')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات از پایگاه داده حذف شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('destroy')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات از پایگاه داده حذف شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('update')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات به روزرسانی شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('message')=='sent')
        $.toast({
            heading: 'موفقیت!'
            , text: 'پیغام ارسال شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('profile')=='updated')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات به روز رسانی شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('login')=='success')
        $.toast({
            heading: 'ورود موفق'
            , text: 'کاربر گرامی خوش آمدید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('sms')=='error')
        swal({
            title: "خطا!",
            text: "در فرآیند ارسال پیامک مشکلی رخ داده است ، لطفا چند دقیقه دیگر مجددا تلاش کنید.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#7cd1f9",
            confirmButtonText: "تایید",
            closeOnConfirm: true
        });
        @elseif(session()->get('authStatus')=='error')
        $.toast({
            heading: 'اطلاعیه!'
            , text: 'برای استفاده از خدمات مالی دریک باید اطلاعات شرکت را تکمیل کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('authStatus')=='file')
        $.toast({
            heading: 'اطلاعیه!'
            , text: ' شما باید احراز هویت بشوید، لطفا اسناد لازم را ضمیمه کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('authStatus')=='user')
        $.toast({
            heading: 'اطلاعیه!'
            , text: ' به دلیل ثبت قرارداد رسمی، ورود اطلاعات اعضا دارای حق امضا الزامی است.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @endif

        @if($errors->all())
        $.toast({
            heading: 'خطا!'
            , text: 'لطفا اطلاعات وارد شده را بررسی کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @endif
        $("#goAway").fadeOut(20000);
    });

</script>
</body>
</html>
