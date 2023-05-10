@extends('layouts.main')
@section('title')ورود | {{$setting!=null && $setting->brand!=null ? $setting->brand : ''}}@stop
@section('content')
    <!-- Main wrapper -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('admin/assets/images/login-register.jpg')}});">
            <div class="login-box card">

                <div class="card-body">

                    <form class="form-horizontal form-material" id="loginform" action="{{route('login')}}"
                          method="post"
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('password.reset') ? 'display:none' : 'display:block'}}">
                        @csrf
                        <a href="javascript:void(0)" class="text-center db">
                            <img src="{{asset('admin/assets/images/logo-icon.png')}}">
                            <img src="{{isset($setting) && $setting->second_logo!=null ? $setting->second_logo : asset('admin/assets/images/logo-text.png')}}"
                                 alt="Home"/></a>
                        <div class="form-group m-t-40">
                            <div class="col-xs-12 text-center">
                                <input dir="ltr" class="form-control text-center" type="text" required=""
                                       placeholder="شماره موبایل" name="mobile" value="{{old('mobile')}}">
                                @if($errors->has('mobile') && session()->get('reset')!='error')
                                    <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <input class="form-control text-center" type="password" required=""
                                       placeholder="رمز عبور" name="password">
                                @if($errors->has('password'))
                                    <small class="invalid-text">{{$errors->first('password')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
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
                        </div>
                        <div class="form-group row">
                            <div class="col-md-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="customCheck1"
                                           name="remember" {{collect(old('remember'))->contains('on') ? 'checked' : ''}}>
                                    <label class="custom-control-label" for="customCheck1">مرا به خاطر بسپار</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">
                                    ورود
                                </button>
                            </div>
                        </div>
                        @if(session()->get('resetPass')=='sent')
                            <div class="form-group text-center m-t-20">
                                <div class="col-xs-12">
                                  <span id="timer" onclick="">
                                    <span id="time" class="ml-2" style="color: red">60</span>ارسال مجدد
                                  </span>
                                </div>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 m-t-10 text-center">
                                <div class="social">
                                    <a href="javascript:void(0)" id="to-recover" class="text-dark pull-right"><i
                                                class="fa fa-lock m-r-5"></i> فراموش کردن رمز عبور؟</a>
                                </div>
                            </div>
                        </div>
                        <div class="form-group m-t-10 m-b-0">
                            <div class="col-sm-12 text-center">
                                آیا ثبت نام نکرده اید؟ <a href="{{route('register')}}" class="text-primary m-l-5"><b>ثبت
                                        نام</b></a>
                            </div>
                        </div>
                    </form>
                    <form class="form-horizontal" method="post" action="{{route('password.reset')}}" id="recoverform"
                          style="{{session()->get('reset')=='error' || session()->get('url')==route('password.reset') ? 'display:block' : 'display:none'}}">
                        @csrf
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <h3>بازیابی رمز عبور</h3>
                                <p class="text-muted">شماره موبایل خود را وارد کنید تا رمز عبور جدید برای
                                    شما پیامک شود.</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                <input dir="ltr" class="form-control text-center" type="text" required="" name="mobile"
                                       placeholder="شماره موبایل" value="{{old('mobile')}}">
                                @if($errors->has('mobile'))
                                    <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                @elseif(session()->get('user')=='unavailable')
                                    <small class="invalid-text">کاربری یا این شماره یافت نشد</small>
                                @endif
                            </div>
                        </div>
                        {{--<div class="form-group ">--}}
                        {{--<div class="col-xs-12 text-center">--}}
                        {{--<input class="form-control text-center datepicker-year" type="text" required=""--}}
                        {{--name="birthDate" placeholder="تاریخ تولد" value="{{old('birthDate')}}">--}}
                        {{--@if($errors->has('birthDate'))--}}
                        {{--<small class="invalid-text">{{$errors->first('birthDate')}}</small>--}}
                        {{--@elseif(session()->get('date')=='incorrect')--}}
                        {{--<small class="invalid-text">تاریخ تولد نا معتبر است</small>--}}
                        {{--@endif--}}
                        {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
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
                        </div>
                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light"
                                        type="submit">رمز عبور جدید را برایم پیامک کن
                                </button>
                            </div>
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
    <!-- End Wrapper -->
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
