<!DOCTYPE html>
<html lang="fa" dir="rtl" >
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>401</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin/assets/images/favicon.png')}}">
    <!-- Custom CSS -->
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet">
    <!-- This page CSS -->
</head>

<body class="skin-blue-dark fixed-layout">
<!-- Main wrapper -->
<section id="wrapper" class="error-page">
    <div class="error-box pt-5" style="background: url('{{asset('/assets/images/error.jpg')}}') no-repeat;background-size: cover;">
        <div class="error-body text-center">
            <h1 class="pt-5">401</h1>
            <h3 class="text-uppercase">برای دسترسی به این صفحه نیازمند لاگین هستید.</h3>
            <p class="text-muted m-t-30 m-b-30">شما سعی کنید تا خانه خود را پیدا کنید</p>
            <a href="@if(Auth::guard('admin')->check()) {{route('admin.dashboard')}} @else {{route('user.dashboard')}} @endif" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">بازگشت به خانه</a>
        </div>
    </div>
</section>
<!-- End Wrapper -->
</body>
</html>