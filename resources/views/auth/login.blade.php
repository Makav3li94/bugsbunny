@extends('layouts.reglog-front')
@section('content')
    <section class="signup_area" style="height: 100vh">
        <div class="row ml-0 mr-0">
            <div class="sign_left signin_left">
                <h2>ورود به ایزباگ</h2>
                <img class="position-absolute top" src="{{asset('front/img/signup/top_ornamate.png')}}" alt="top">
                <img class="position-absolute bottom" src="{{asset('front/img/signup/bottom_ornamate.png')}}" alt="bottom">
                <img class="position-absolute middle" src="{{asset('front/img/signup/door.png')}}" alt="bottom">
                <div class="round"></div>
            </div>
            <div class="sign_right signup_right">
                <div class="sign_inner signup_inner">
                    <div class="text-center">
                        <h3>ورود به ایزباگ</h3>
                        <p>حساب کاربری ندارید ؟ <a href="{{route('register')}}">ثبت نام</a></p>
                    </div>
                    <form class="row login_form" id="loginform" action="{{route('login')}}" method="post"
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('password.reset') ? 'display:none' : 'display:flex'}}">
                        @csrf
                        <div class="col-lg-12 form-group">

                            <input type="text" class="form-control" id="email" placeholder="شماره موبایل" name="mobile"
                                   value="{{old('mobile')}}">
                            @if($errors->has('mobile') && session()->get('reset')!='error')
                                <small class="invalid-text">{{$errors->first('mobile')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="confirm_password">
                                <input id="confirm-password" type="password"
                                       class="form-control" placeholder="رمز عبور" name="password">
                                @if($errors->has('password'))
                                    <small class="invalid-text">{{$errors->first('password')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input class="form-control" type="text" required       style="direction: rtl"
                                   placeholder="{{$array[2].' '.$array[1].' '.$array[0]}} برابر با چه عددی است؟ "
                                   name="result">
                            @if(session()->get('result')=='incorrect')
                                <small class="invalid-text">حاصل عبارت فوق نادرست می باشد</small>
                            @endif
                            <input type="hidden" name="a" value="{{$array[0]}}">
                            <input type="hidden" name="operator" value="{{$array[1]}}">
                            <input type="hidden" name="b" value="{{$array[2]}}">
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="customCheck1"
                                       name="remember" {{collect(old('remember'))->contains('on') ? 'checked' : ''}}>
                                <label class="custom-control-label" for="customCheck1">مرا به خاطر بسپار</label>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">
                                    ورود
                                </button>
                            </div>
                        </div>
                    </form>

                    <form class="form-horizontal" method="post" action="{{route('password.reset')}}" id="recoverform"
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('password.reset') ? 'display:flex' : 'display:none'}}">
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>بازیابی رمز عبور</h3>
                                <p class="text-muted">شماره موبایل خود را وارد کنید تا رمز عبور جدید برای
                                    شما پیامک شود.</p>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            <input dir="ltr" class="form-control text-center" type="text" required="" name="mobile"
                                   placeholder="شماره موبایل" value="{{old('mobile')}}">
                            @if($errors->has('mobile'))
                                <small class="invalid-text">{{$errors->first('mobile')}}</small>
                            @elseif(session()->get('user')=='unavailable')
                                <small class="invalid-text">کاربری یا این شماره یافت نشد</small>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            <input class="form-control text-center" type="text" required
                                   placeholder="{{$array[2].' '.$array[1].' '.$array[0]}} برابر با چه عددی است؟ "
                                   name="result">
                            @if(session()->get('result')=='incorrect')
                                <small class="invalid-text">حاصل عبارت فوق نادرست می باشد</small>
                            @endif
                            <input type="hidden" name="a" value="{{$array[0]}}">
                            <input type="hidden" name="operator" value="{{$array[1]}}">
                            <input type="hidden" name="b" value="{{$array[2]}}">
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                    type="submit">رمز عبور جدید را برایم پیامک کن
                            </button>
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <a href="javascript:void(0)" id="to-login" class="text-dark pull-right"><i
                                        class="fa fa-sign-in m-r-5"></i> ورود به سیستم</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section('scripts')
    <script>
        $(document).ready(function () {

            var counter = 60;
            var interval = setInterval(function () {
                counter--;
                // Display 'counter' wherever you want to display it.
                if (counter <= 0) {
                    clearInterval(interval);
                    $('#timer').html("<button type='button' class='btn btn-sm btn-warning btn-rounded' onclick='resendPass()'>ارسال مجدد رمز</button>");

                } else {
                    $('#time').text(counter);
                    console.log("Timer --> " + counter);
                }
            }, 1000);
        });

        function resendPass() {
            $("#loginform").slideUp();
            $("#recoverform").fadeIn();
        }
    </script>
@stop
