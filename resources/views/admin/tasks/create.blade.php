@extends('layouts.main-dashboard')
@section('title')افزودن کار@stop
@section('current-page-title')افزودن کار@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیریت کارها</li>
    <li class="breadcrumb-item active">افزودن کار</li>
@stop
@section('content')
    <!-- Add Work -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">افزودن کار</h4>
                    <p class="card-subtitle">در اینجا کار ایجاد کنید.</p>
                    <form class="clearfix" action="{{route('admin.task.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from">از<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="from_id" required id="from">
                                        <option></option>
                                        @foreach($admins as $admin)
                                            <option value="{{$admin->id}}" {{collect(old('from_id'))->contains($admin->id) ? 'selected' : ''}}>{{$admin->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('from_id'))
                                        <small class="invalid-text">{{$errors->first('from_id')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label fot="to">به<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="to_id" required id="to">
                                        <option></option>
                                        @foreach($admins as $admin)
                                            <option value="{{$admin->id}}" {{collect(old('to_id'))->contains($admin->id) ? 'selected' : ''}}>{{$admin->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('to_id'))
                                        <small class="invalid-text">{{$errors->first('to_id')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="date">تاریخ انجام</label>
                                    <input type="text" class="form-control datepicker-day" placeholder="" name="date" value="{{old('date')}}" id="date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">توضیحات<span class="text-danger mr-1">*</span></label>
                                    <textarea type="text" class="form-control" name="description" id="description" required>{{old('description')}}</textarea>
                                    @if($errors->has('description'))
                                        <small class="invalid-text">{{$errors->first('description')}}</small>
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
    <!-- End Add Work -->
@stop
