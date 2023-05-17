@extends('layouts.main-dashboard')
@section('title')مشخصات سایت@stop
@section('current-page-title')مشخصات سایت@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">تنظیمات</li>
    <li class="breadcrumb-item active">مشخصات سایت</li>
@stop
@section('content')
    <!-- Date Setting -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">تنظیمات</h4>
                    <p class="card-subtitle">تنظیمات سایت را تکمیل نمایید.</p>
                    <form class="clearfix" action="{{route('admin.settings.updateOrCreate')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام برند</label>
                                    <input type="text" class="form-control" placeholder="" name="brand"
                                           value="{{$settings!=null ? $settings->brand : old('brand')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نام کامل سایت</label>
                                    <input type="text" class="form-control" placeholder="" name="name"
                                           value="{{$settings!=null ? $settings->name : old('name') }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>توضیحات سایت</label>
                                    <input type="text" class="form-control" placeholder="" name="description"
                                           value="{{$settings!=null ? $settings->description : old('description')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>کلمات کلیدی</label>
                                    <input type="text" class="form-control" placeholder="" name="keywords"
                                           value="{{$settings!=null ? $settings->keywords : old('keywords')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>آدرس سایت اصلی</label>
                                    <input dir="ltr" type="text" class="form-control" placeholder="https://domain.com"
                                           name="domain"
                                           value="{{$settings!=null ? $settings->domain : old('domain')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>لوگوی اول: </label>
                                    @if(isset($settings) && $settings->first_logo != null)
                                        <img src="{{$settings->first_logo}}" width="120" alt="{{$settings->brand}}"/>
                                    @endif
                                    <input type="file" class="form-control" name="first_logo">
                                    @if($errors->has('first_logo'))
                                        <small class="invalid-text">{{$errors->first('first_logo')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>لوگوی دوم</label>
                                    @if(isset($settings) && $settings->second_logo != null)
                                        <img src="{{$settings->second_logo}}" style="background-color: #077c95;" width="120" alt="{{$settings->brand}}"/>
                                    @endif
                                    <input type="file" class="form-control" name="second_logo">
                                    @if($errors->has('first_logo'))
                                        <small class="invalid-text">{{$errors->first('first_logo')}}</small>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز شرکت در چالش اصلی</label>
                                    <input type="number" class="form-control" placeholder="" name="admin_section_score"
                                           value="{{$settings!=null ? $settings->admin_section_score : old('admin_section_score')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز شرکت در چالش کاربر</label>
                                    <input type="number" class="form-control" placeholder="" name="user_section_score"
                                           value="{{$settings!=null ? $settings->user_section_score : old('user_section_score')}}">
                                </div>
                            </div>


                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز کامنت</label>
                                    <input type="number" class="form-control" placeholder="" name="comment_score"
                                           value="{{$settings!=null ? $settings->comment_score : old('comment_score')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز پاسخ به کامنت</label>
                                    <input type="number" class="form-control" placeholder="" name="reply_score"
                                           value="{{$settings!=null ? $settings->reply_score : old('reply_score')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز ثبت چالش کاربر</label>
                                    <input type="number" class="form-control" placeholder="" name="section_score"
                                           value="{{$settings!=null ? $settings->section_score : old('section_score')}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>امتیاز منفی عدم شرکت در چالش</label>
                                    <input type="number" class="form-control" placeholder="" name="skip_section_score"
                                           value="{{$settings!=null ? $settings->skip_section_score : old('skip_section_score')}}">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>نوع ثبت نام</label>
                                    <select name="reg_type" id="" class="form-control">
                                        <option value="0">sms</option>
                                        <option value="1">email</option>
                                        <option value="2">هردو</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>متن خوش آمد گویی</label>
                                    <textarea dir="rtl" class="form-control" name="wysiwyg"
                                              id="wysiwyg">@if($settings!=null) {!! $settings->wysiwyg !!} @else {!! old('wysiwyg') !!} @endif</textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="btn-group float-left" role="group">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light">ثبت و ذخیره
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
    <!-- End Date Setting -->
@endsection
