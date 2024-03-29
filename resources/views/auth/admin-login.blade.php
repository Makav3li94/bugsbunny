@extends('layouts.main')
@section('title') ورود مدیران | {{$setting!=null && $setting->brand!=null ? $setting->brand : ''}} @stop
@section('content')
    <!-- Main wrapper -->
    <section id="wrapper">
        <div class="login-register" style="background-image:url({{asset('admin/assets/images/login-register.jpg')}});">
            <div class="login-box card">
                <div class="card-body">
                    <form class="form-horizontal form-material" id="loginform" action="{{route('admin.login.submit')}}"
                          method="post" style="{{session()->get('reset')=='error' || session()->get('url')==route('admin.password.reset') ? 'display:none' : 'display:block'}}">
                        @csrf
                        <div class="form-group m-t-20">
                            <div class="col-xs-12 text-center">
                                <input dir="ltr" class="form-control text-dark text-center font-16 {{$errors->has('email') ? 'is-invalid' : '' }}"
                                       type="text"
                                       required="" placeholder="ایمیل" name="email"
                                       value="{{old('email')}}">
                                @if($errors->has('email'))
                                    <small class="invalid-text">ایمیل یا رمز عبور اشتباه می باشد.</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-t-20">
                            <div class="col-xs-12 text-center">
                                <input class="form-control text-dark text-center font-16 {{$errors->has('password') ? 'is-invalid' : '' }}"
                                       type="password"
                                       required="" placeholder="رمز عبور" name="password">
                                @if($errors->has('password'))
                                    <small class="invalid-text">ایمیل یا رمز عبور اشتباه می باشد.</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12 text-center">
                                @include('layouts.components.captcha')
                                <input class="form-control text-center" type="text" required
                                       placeholder="پاسخ را به صورت عدد وارد کنید."
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
                                <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light"
                                        type="submit">ورود
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
    <!-- End Wrapper -->
@stop
