@extends('layouts.main-dashboard')
@section('title')ویرایش کار@stop
@section('current-page-title')ویرایش کار@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیریت کارها</li>
    <li class="breadcrumb-item">لیست کارها</li>
    <li class="breadcrumb-item active">ویرایش کار</li>
@stop
@section('content')
    <!-- Add Work -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش کار</h4>
                    <p class="card-subtitle">در اینجا کار را ویرایش کنید.</p>
                    <form class="clearfix" action="{{route('admin.task.update',$task->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="from">از<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="from_id" required id="from">
                                        <option></option>
                                        @foreach($admins as $admin)
                                            <option value="{{$admin->id}}" {{$task->from_id==$admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
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
                                            <option value="{{$admin->id}}" {{$task->to_id==$admin->id ? 'selected' : ''}}>{{$admin->name}}</option>
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
                                    <input type="text" class="form-control datepicker-day" placeholder="" name="date" value="{{Verta::instance($task->date)->format('Y/m/d')}}" id="date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="description">توضیحات<span class="text-danger mr-1">*</span></label>
                                    <textarea type="text" class="form-control" name="description" id="description" required>{{$task->description}}</textarea>
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
