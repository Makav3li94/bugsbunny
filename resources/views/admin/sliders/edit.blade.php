@extends('layouts.main-dashboard')
@section('title')ویرایش اسلایدر@stop
@section('current-page-title')ویرایش اسلایدر@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">تنظیمات</li>
    <li class="breadcrumb-item">اسلایدرها</li>
    <li class="breadcrumb-item">لیست اسلایدرها</li>
    <li class="breadcrumb-item active">ویرایش اسلایدر</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش اسلایدر</h4>
                    <p class="card-subtitle">در اینجا می توانید اسلایدر را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.slider.update',$slider->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>لینک عکس<span class="text-danger mr-1">*</span></label>
                                    <input type="text" name="image_link" class="form-control" placeholder=""
                                           value="{{$slider->image_link}}" required>
                                    @if($errors->has('image_link'))
                                        <small class="invalid-text">{{$errors->first('image_link')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>آدرس مقصد</label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{$slider->href}}" name="href">
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
