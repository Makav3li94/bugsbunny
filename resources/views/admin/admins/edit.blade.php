@extends('layouts.main-dashboard')
@section('title')ویرایش اطلاعات مدیر@stop
@section('current-page-title')ویرایش اطلاعات مدیر@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیران</li>
    <li class="breadcrumb-item">لیست مدیران</li>
    <li class="breadcrumb-item active">ویرایش اطلاعات مدیر</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش اطلاعات مدیر : {{$admin->name}}</h4>
                    <p class="card-subtitle">در اینجا می توانید اطلاعات مدیر را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.admins.update',$admin->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="name" class="form-control" placeholder=""
                                           value="{{$admin->name}}" required>
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ایمیل<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="email" class="form-control" placeholder=""
                                           value="{{$admin->email}}" name="email" required>
                                    @if($errors->has('email'))
                                        <small class="invalid-text">{{$errors->first('email')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>شماره همراه<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                           value="{{$admin->mobile}}" name="mobile" required>
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
                                    <select name="roles[]" class="select2 form-control custom-select" style="width: 100%;" value="{{old('roles')}}">
                                        <option></option>
                                        @foreach ($roles as $role)
                                            <option value="{{$role->name}}" {{isset($adminRole[0]->name) && $adminRole[0]->name == $role->name ? 'selected="selected"' : ''}}>{{$role->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('roles'))
                                        <small class="invalid-text">{{$errors->first('roles')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رمز عبور</label>
                                    <input type="text" class="form-control" placeholder="" value="" name="password">
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تکرار رمز عبور</label>
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
