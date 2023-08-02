@extends('layouts.reglog-front')
@section('content')
    <section class="signup_area signup_area_height" >
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
                        <h4>حساب کاربری</h4>
                        <p>اطلاعات پروفایل را تکمیل نمایید</p>
                    </div>
                    <form class="row login_form" method="post" id="primaryEssentialForm"
                          action="{{route('essentials.store',$user->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')


                        <div class="col-sm-12 form-group">
                            <label>نام<span class="text-danger mr-1">*</span></label>
                            <input type="text" class="form-control" placeholder=""
                                   value="{{old('name')}}" name="name" required>
                            @if($errors->has('name'))
                                <small class="invalid-text">{{$errors->first('name')}}</small>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                            <input type="text" class="form-control" placeholder=""  autocomplete="off"
                                   value="{{old('username')}}" name="username" required>
                            @if($errors->has('username'))
                                <small class="invalid-text">{{$errors->first('username')}}</small>
                            @endif
                        </div>
                        @if(isset(request()->email))
                            <input type="hidden" name="email_reg" value="on">
                            <div class="col-sm-12 form-group">
                                <label>موبایل </label>
                                <input dir="ltr" type="text" class="form-control" placeholder=""
                                value="{{request()->mobile ??old('mobile')}}" name="mobile" >
                                @if($errors->has('mobile'))
                                    <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                @endif
                            </div>
                        @endif
                        <div class="col-sm-12 form-group">
                            <label>ایمیل <span class="text-danger mr-1">*</span></label>
                            <input dir="ltr" type="text" class="form-control" placeholder="" {{isset(request()->email) ? 'readonly' : ''}}
                                   value="{{request()->email ??old('email')}}" name="email" required>
                            @if($errors->has('email'))
                                <small class="invalid-text">{{$errors->first('email')}}</small>
                            @endif
                        </div>


                        <div class="col-sm-12 form-group">
                            <label>تاریخ تولد <span class="text-danger mr-1">*</span></label>
                            <input type="text" class="form-control datepicker-year" placeholder="" required
                                   value="{{old('birthDate')}}" name="birthDate">
                            @if($errors->has('birthDate'))
                                <small class="invalid-text">{{$errors->first('birthDate')}}</small>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>دسته مورد علاقه<span class="text-danger mr-1">*</span></label>
                            <select class="select2 form-control custom-select" style="width: 100%;"
                                    multiple="multiple" required
                                    name="cats[]">
                                <option></option>
                                @forelse($categories as $cat)
                                    @if($cat->type == 0)
                                    <option value="{{$cat->id}}" {{collect(old('cats'))->contains($cat->id) ? 'selected' : ''}}>{{$cat->title}}</option>
                                    @endif
                                @empty

                                @endforelse

                            </select>
                            @if($errors->has('role'))
                                <small class="invalid-text">{{$errors->first('role')}}</small>
                            @endif
                        </div>

                        <div class="col-sm-12 form-group">
                            <label>تصویر پروفایل:</label>
                            <div>
                                <input type="file" name="avatar" class="form-control dropify"
                                       placeholder=""   data-height="100">
                                @if($errors->has('avatar'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('avatar')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-12 form-group">
                            <label>نحوه آشنایی</label>
                            <select class="select2 form-control custom-select" style="width: 100%;"
                                    name="familiarity">
                                <option></option>
                                @foreach($familiarities as $familiarity)
                                    <option value="{{$familiarity->id}}"
                                            @if(collect(old('familiarity'))->contains($familiarity->id)) selected @endif>{{$familiarity->title}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('familiarity'))
                                <small class="invalid-text">{{$errors->first('familiarity')}}</small>
                            @endif
                        </div>
                        <div class="col-sm-12 form-group">
                            <small class="invalid-text" style="font-size: 12px">(حداقل 8 کارکتر دارای حرف کوچک، حرف
                                بزرگ، یک عدد، یک کارکتر خاص باشد)</small>
                            <label>رمز عبور</label>
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
                        <!-- End Date Migration -->
                        <div class="col-sm-12 form-group text-center">
                                <button type="submit"
                                        class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light">ثبت و
                                    ذخیره
                                </button>
                        </div>


                    </form>

                </div>
            </div>
        </div>
    </section>
@stop
