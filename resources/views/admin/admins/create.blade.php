@extends('layouts.main-dashboard')
@section('title')افزودن مدیر@stop
@section('current-page-title')افزودن مدیر@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیران</li>
    <li class="breadcrumb-item active">افزودن مدیر</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">افزودن مدیر</h4>
                    <p class="card-subtitle">در اینجا می توانید مدیر جدید اضافه کنید.</p>
                    <form class="clearfix" action="{{route('admin.admins.store')}}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder=""
                                           value="{{old('name')}}" required>
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ایمیل<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="email" class="form-control" placeholder=""
                                           value="{{old('email')}}" name="email" required>
                                    @if($errors->has('email'))
                                        <small class="invalid-text">{{$errors->first('email')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>شماره همراه<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                           value="{{old('mobile')}}" name="mobile" required>
                                    @if($errors->has('mobile'))
                                        <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>سطح دسترسی<span class="text-danger mr-1">*</span></label>
                                    <select name="roles" class="select2 form-control custom-select" style="width: 100%;"  >
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}">{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('role'))
                                        <small class="invalid-text">{{$errors->first('role')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رمز عبور<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" value="" name="password" required>
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تکرار رمز عبور<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" name="password_confirmation" required>
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
    <!-- End Change Password -->
@stop
