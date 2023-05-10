@extends('layouts.main-dashboard')
@section('title')افزودن نقش@stop
@section('current-page-title')افزودن نقش @stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیران</li>
    <li class="breadcrumb-item active">افزودن نقش</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">افزودن نقش</h4>
                    <p class="card-subtitle">در اینجا نقش ایجاد کنید.</p>
                    <form class="clearfix" action="{{route('admin.roles.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">عنوان</label>
                                    <input type="text" class="form-control" placeholder="" name="name"
                                           value="{{old('name')}}" id="date">
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">نقش<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="permission[]" required id="from" multiple>
                                        <option></option>
                                        @include('admin.roles.permisions_switch')
                                    </select>
                                    @if($errors->has('permission[]'))
                                        <small class="invalid-text">{{$errors->first('permission[]')}}</small>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
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
@stop
