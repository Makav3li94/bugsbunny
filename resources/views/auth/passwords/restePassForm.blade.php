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
                        <h3>تغییر رمز عبور</h3>
                        <p>حساب کاربری ندارید ؟ <a href="{{route('register')}}">ثبت نام</a></p>
                    </div>
                    <form class="row verify_form" id="verify-form" action="{{route('password.update')}}" method="post">
                        @csrf
                        <div class="col-lg-12 form-group">
                            <input type="hidden" name="mobile" value="{{$mobile ?? old('mobile')}}">
                            <label>توکن ارسال شده</label>
                            <input type="text" class="form-control text-center" id="token"
                                   placeholder="" name="token"
                                   value="">
                            @if($errors->has('token') && session()->get('reset')!='error')
                                <small class="invalid-text">{{$errors->first('token')}}</small>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <small class="invalid-text" style="font-size: 12px">(حداقل 8 کارکتر دارای حرف کوچک، حرف
                                بزرگ، یک عدد، یک کارکتر خاص باشد)</small>
                            <label>رمز عبور جدید</label>
                            <input dir="ltr" type="password"  autocomplete="off" class="form-control text-left" value="" name="password" required>
                            @if($errors->has('password'))
                                <small class="invalid-text">{{$errors->first('password')}}</small>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>تایید رمز عبور</label>
                            <input dir="ltr" type="password"  autocomplete="off" class="form-control text-left" value="" name="password_confirmation" required>
                            @if($errors->has('password_confirmation'))
                                <small class="invalid-text">{{$errors->first('password_confirmation')}}</small>
                            @endif
                        </div>


                        <div class="col-lg-12 form-group text-center m-t-20">
                            <button class="btn btn-info btn-lg btn-block text-uppercase btn-rounded" type="submit">
                                رمز را تغییر بده
                            </button>
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


    </script>
@stop
