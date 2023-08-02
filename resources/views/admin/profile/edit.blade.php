@extends('layouts.main-dashboard')
@section('title')پروفایل@stop
@section('current-page-title')پروفایل@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">تنظیمات</li>
    <li class="breadcrumb-item active">پروفایل</li>
@stop
@section('content')
    <!-- Change Password -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">پروفایل</h4>
                    <p class="card-subtitle">اطلاعات خود را ویرایش کنید.</p>
                    <form class="clearfix" id="main" action="{{route('admin.profile.update',$admin->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder=""
                                           value="{{auth()->user()->name}}" required>
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ایمیل<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="email" class="form-control" placeholder=""
                                           value="{{auth()->user()->email}}" name="email" required>
                                    @if($errors->has('email'))
                                        <small class="invalid-text">{{$errors->first('email')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>شماره همراه<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                           value="{{auth()->user()->mobile}}" name="mobile" required>
                                    @if($errors->has('mobile'))
                                        <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">

                                    <label>رمز عبور جدید</label>
                                    <input type="text" class="form-control" placeholder="" value="" name="password">
                                    <small class="invalid-text" style="font-size: 12px">(حداقل 8 کارکتر دارای حرف کوچک، حرف
                                        بزرگ، یک عدد، یک کارکتر خاص باشد)</small>
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تکرار رمز عبور جدید</label>
                                    <input type="text" class="form-control" placeholder="" name="password_confirmation">
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="btn-group float-left" role="group">
                                        <button type="button"
                                                class="btn btn-success btn-rounded waves-effect waves-light delete-main">ثبت و ذخیره
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Change Password -->
@stop
