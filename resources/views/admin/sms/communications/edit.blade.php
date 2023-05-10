@extends('layouts.main-dashboard')
@section('title')ویرایش خط@stop
@section('current-page-title')ویرایش خط@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item">مدیریت خطوط</li>
    <li class="breadcrumb-item">لیست خطوط</li>
    <li class="breadcrumb-item active">ویرایش خط</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش خط</h4>
                    <p class="card-subtitle">در اینجا می توانید اطلاعات خط را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.com.update',$com->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>عنوان<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="title" class="form-control" placeholder=""
                                           value="{{$com->title}}" required>
                                    @if($errors->has('title'))
                                        <small class="invalid-text">{{$errors->first('title')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>شماره<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="number" class="form-control" placeholder=""
                                           value="{{$com->number}}" required>
                                    @if($errors->has('number'))
                                        <small class="invalid-text">{{$errors->first('number')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>سرویس دهنده: <span
                                                class="text-danger mr-1">*</span></label>
                                        <select class="select2 form-control custom-select" style="width: 100%;"
                                                name="service" required>
                                            <option></option>
                                            @foreach($sms_constant_titles as $sms_constant_title)
                                                <option value="{{$sms_constant_title}}" {{$com->type==$sms_constant_title ? 'selected' : ''}}>{{$sms_constant_title}}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('service'))
                                            <small class="invalid-text">{{$errors->first('service')}}</small>
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
