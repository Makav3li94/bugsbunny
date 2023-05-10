@extends('layouts.main-dashboard')
@section('title')ویرایش پیش نویس@stop
@section('current-page-title')ویرایش پیش نویس@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item">مدیریت پیش نویس ها</li>
    <li class="breadcrumb-item">لیست پیش نویس ها</li>
    <li class="breadcrumb-item active">ویرایش پیش نویس</li>
@stop
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش پیش نویس</h4>
                    <p class="card-subtitle">در اینجا می توانید پیش نویس را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.draft.update',$draft->id)}}"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>متن پیشنویس<span class="text-danger mr-1">*</span></label>
                                    <textarea name="draft" class="form-control" placeholder=""
                                              required>{{$draft->description}}</textarea>
                                    @if($errors->has('draft'))
                                        <small class="invalid-text">{{$errors->first('draft')}}</small>
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
