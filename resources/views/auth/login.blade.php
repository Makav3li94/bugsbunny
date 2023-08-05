@extends('layouts.reglog-front')
@section('content')
    <section class="signup_area" style="height: 100vh">
        <div class="row ml-0 mr-0">
            <div class="sign_left signin_left">
                <h2>ورود به ایزباگ</h2>
                <img class="position-absolute top" src="{{asset('front/img/signup/top_ornamate.png')}}" alt="top">
                <img class="position-absolute bottom" src="{{asset('front/img/signup/bottom_ornamate.png')}}"
                     alt="bottom">
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
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('mpassword.reset') ? 'display:none' : 'display:flex'}}">
                        @csrf
                        <div class="col-lg-12 form-group">

                            <input type="text" class="form-control text-center" id="email"
                                   placeholder="شماره موبایل یا ایمیل" name="username"
                                   value="{{old('username')}}">
                            @if($errors->has('username') && session()->get('reset')!='error')
                                <small class="invalid-text">{{$errors->first('username')}}</small>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="confirm_password">
                                <input id="confirm-password" type="password"
                                       class="form-control text-center" placeholder="رمز عبور" name="password">
                                @if($errors->has('password'))
                                    <small class="invalid-text">{{$errors->first('password')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-12 form-group">
                            @include('layouts.components.captcha')
                            <input class="form-control text-center" type="text" required style="direction: rtl"
                                   placeholder="پاسخ به صورت عدد وارد شود."
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
                        <div class="col-lg-12 form-group">
                            <div class="social">
                                <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i
                                        class="fa fa-lock m-r-5"></i> فراموش کردن رمز عبور؟</a>
                            </div>
                        </div>
                        <div class="col-lg-12 form-group text-center m-t-20">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">
                                ورود
                            </button>
                        </div>
                    </form>



                    <form class="row login_form" method="post" action="{{route('mpassword.reset')}}" id="recoverform"
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('mpassword.reset') ? 'display:flex' : 'display:none'}}">
                        @csrf
                        <div class="col-lg-12 form-group">
                            <h3>بازیابی رمز عبور</h3>
                            <p class="text-muted">شماره موبایل یا ایمیل خود را وارد کنید.</p>
                        </div>

                        <div class="col-lg-12 form-group">
                            <input dir="ltr" class="form-control text-center" type="text" required="" autocomplete="off" name="username"
                                   placeholder="شماره یا ایمیل" value="{{old('username')}}">
                            @if($errors->has('username'))
                                <small class="invalid-text">کاربری یا این اطلاعات یافت نشد</small>
                            @elseif(session()->get('user')=='unavailable')
                                <small class="invalid-text">کاربری یا این اطلاعات یافت نشد</small>
                            @endif
                        </div>
                        <div class="col-lg-12 form-group">
                            @include('layouts.components.captcha')
                            <input class="form-control text-center" type="text" required style="direction: rtl"
                                   placeholder="پاسخ را به صورت عدد وارد کنید."
                                   name="result">
                            @if(session()->get('result')=='incorrect')
                                <small class="invalid-text">حاصل عبارت فوق نادرست می باشد</small>
                            @endif
                            <input type="hidden" name="a" value="{{$array[0]}}">
                            <input type="hidden" name="operator" value="{{$array[1]}}">
                            <input type="hidden" name="b" value="{{$array[2]}}">
                        </div>
                        <div class="col-lg-12 form-group">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded"
                                    type="submit">رمز عبور جدید را برایم ارسال کن
                            </button>
                        </div>
                        <div class="col-lg-12 form-group">
                            <div class="social">
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
