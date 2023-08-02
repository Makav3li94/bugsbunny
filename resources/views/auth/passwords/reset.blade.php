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
                        <h3>تغییر رمز عبور ایزباگ</h3>
                        <p>قبلا ثبت نام کردید ؟ <a href="{{route('login')}}">ورود</a></p>
                    </div>
                    <form method="POST" class="row login_form" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="col-lg-12 form-group">
                                <input id="email" type="email" placeholder="ایمیل" class="form-control text-center @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="col-lg-12 form-group">
                            <small class="invalid-text" style="font-size: 12px">(حداقل 8 کارکتر دارای حرف کوچک، حرف
                                بزرگ، یک عدد، یک کارکتر خاص باشد)</small>
                                <input id="password" type="password" placeholder="رمز عبور جدید" class="form-control text-center @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                        <div class="col-lg-12 form-group">

                                <input id="password-confirm" type="password" placeholder="تایید رمز عبور جدید" class="form-control text-center" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="form-group text-center m-t-20">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-primary">
                                   تغییر رمز عبور
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop








