@extends('layouts.reglog-front')
@section('content')
    <section class="signup_area signup_area_height" style="height: 100vh">
        <div class="row ml-0 mr-0">
            <div class="sign_left signup_left">
                <img class="position-absolute top" src="{{asset('front/img/signup/top_ornamate.png')}}" alt="top">
                <img class="position-absolute bottom" src="{{asset('front/img/signup/bottom_ornamate.png')}}"
                     alt="bottom">
                <img class="position-absolute middle wow fadeInRight" src="{{asset('front/img/signup/man_image.png')}}"
                     alt="bottom">
                <div class="round wow zoomIn" data-wow-delay="0.2s"></div>
            </div>
            <div class="sign_right signup_right">
                <div class="sign_inner signup_inner">
                    <div class="text-center">
                        <h3>ثبت نام در ایزباگ</h3>
                        <p>قبلا ثبت نام کردید ؟ <a href="{{route('login')}}">ورود</a></p>
                    </div>
                    <form class="row login_form" id="registerForm" action="#">
                        <div class="col-sm-12 form-group">
                            <div id="registerInputWrapper">
                                <input dir="ltr" class="form-control" type="text" required=""
                                       placeholder="تلفن همراه"
                                       value="{{old('mobile')}}" name="mobile">
                            </div>
                            <small class="invalid-text" id="toRegisterError"></small>
                        </div>

                        <div class="col-sm-12 form-group">
                            <div id="registerResultWrapper">
                                <input class="form-control"
                                       style="direction: rtl;text-align: center"
                                       type="text"
                                       required=""
                                       placeholder="{{$array[2].' '.$array[1].' '.$array[0]}} برابر با چه عددی است؟ "
                                       name="result">
                                <input type="hidden" name="a" value="{{$array[0]}}">
                                <input type="hidden" name="operator" value="{{$array[1]}}">
                                <input type="hidden" name="b" value="{{$array[2]}}">
                            </div>
                            <small class="invalid-text" id="resultError"></small>
                        </div>

                        <div class="col-sm-12 text-center">
                            <button id="toRegister" class="btn action_btn thm_btn" type="button">دریافت کد تایید
                            </button>
                        </div>
                    </form>

                    <form class="row login_form" method="get" id="verificationForm" action="">
                        <div class="col-sm-12 form-group">
                            <input dir="ltr" class="form-control" type="text" disabled value=""
                                   name="mobile">
                        </div>
                        <div class="col-sm-12 form-group">
                            <div id="verificationInputWrapper">
                                <input class="form-control text-center" type="text" required="" name="code"
                                       placeholder="کد دریافتی">
                                <i class="fa fa-circle-o-notch fa-spin"></i>
                            </div>
                            <small class="invalid-text" id="toCheckCodeError"></small>
                        </div>
                        <div class="col-sm-12 form-group text-center m-t-20">
                            <button id="toCheckCode"
                                    class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="button">تایید
                            </button>
                        </div>
                        <div class="col-sm-12 form-group text-center m-b-0">

                            <p>کد را دریافت نکرده ام؟ <a href="#" style="cursor: no-drop !important;opacity: 0.5;"
                                                         id="registerResend" class="off text-info m-l-5">
                                    <b>ارسال مجدد</b>
                                </a>
                                <i class="fa fa-circle-o-notch fa-spin d-none" id="resend-spinner"></i>
                                <span id="countDown" style="color:red;float:left;"></span>
                            </p>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

