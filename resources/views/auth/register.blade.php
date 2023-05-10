@extends('layouts.main')
@section('title')ثبت نام | {{$setting!=null && $setting->brand!=null ? $setting->brand : ''}}@stop
@section('content')
    <!-- Main wrapper -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('admin/assets/images/login-register.jpg')}});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material text-center" id="registerForm" action="#">
                        <a href="javascript:void(0)" class=" db">
{{--                            <img src="{{asset('admin/assets/images/logo-icon.png')}}">--}}
                            <img width="120" src="{{isset($setting) && $setting->first_logo!=null ? $setting->first_logo : asset('admin/assets/images/logo-text.png')}}" alt="Home"/></a>

                        <h3 class="box-title m-t-40 m-b-0">ثبت نام کنید</h3>
                        <small>یک حساب کاربری رایگان ایجاد کنید.</small>
                        <div class="form-group m-t-20">
                            <div class="col-xs-12 text-center">
                                <div id="registerInputWrapper">
                                    <input dir="ltr" class="form-control text-dark text-center font-16"
                                           type="text"
                                           required="" placeholder="تلفن همراه" value="{{old('mobile')}}" name="mobile">
                                    <i class="fa fa-circle-o-notch fa-spin"></i>
                                </div>
                                <small class="invalid-text" id="toRegisterError"></small>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <div id="registerResultWrapper">
                                    <input class="form-control text-dark text-center font-16"
                                           type="text"
                                           required="" placeholder="{{$array[2].' '.$array[1].' '.$array[0]}} برابر با چه عددی است؟ "  name="result">
                                    <input type="hidden" name="a" value="{{$array[0]}}">
                                    <input type="hidden" name="operator" value="{{$array[1]}}">
                                    <input type="hidden" name="b" value="{{$array[2]}}">
                                </div>
                                <small class="invalid-text" id="resultError"></small>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button id="toRegister"
                                        class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                        type="button">دریافت
                                    کد تایید
                                </button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>من حساب کاربری دارم؟ <a href="{{route('login')}}" class="text-info m-l-5"><b>ورود</b></a>
                                </p>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal form-material" method="get" id="verificationForm" action="">
                        <div class="form-group m-t-20">
                            <div class="col-xs-12">
                                <input dir="ltr" class="form-control text-center" type="text" disabled value="" name="mobile">
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <div class="col-xs-12 text-center">
                                <div id="verificationInputWrapper">
                                    <input class="form-control text-center" type="text" required="" name="code"
                                           placeholder="کد دریافتی">
                                    <i class="fa fa-circle-o-notch fa-spin"></i>
                                </div>
                                <small class="invalid-text" id="toCheckCodeError"></small>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button id="toCheckCode" class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                        type="button">تایید
                                </button>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <div class="col-sm-12 text-center">
                                <p>کد را دریافت نکرده ام؟ <a href="#" style="cursor: no-drop !important;opacity: 0.5;" id="registerResend" class="off text-info m-l-5">
                                        <b>ارسال مجدد</b>
                                    </a>
                                    <i class="fa fa-circle-o-notch fa-spin d-none" id="resend-spinner"></i>
                                    <span id="countDown" style="color:red;float:left;"></span>
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- End Wrapper -->
@stop
