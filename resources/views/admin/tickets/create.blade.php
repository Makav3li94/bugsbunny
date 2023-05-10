@extends('layouts.main-dashboard')
@section('title')ارسال تیکت جدید@stop
@section('current-page-title')ارسال تیکت جدید@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پشتیبانی</li>
    <li class="breadcrumb-item active">ارسال تیکت جدید</li>
@stop
@section('content')
    <!-- Page Send Ticket -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ارسال تیکت جدید</h4>
                    <p class="card-subtitle">در صورت نیاز به کاربر پیغام ارسال کنید.</p>
                    <form class="form-horizontal clearfix" method="post" action="{{route('admin.ticket.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">انتخاب کاربر:<span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select-2" style="width: 100%;" required
                                        name="user_id">
                                    <option></option>
                                    @forelse($users as $user)
                                        <option value="{{$user->id}}" {{collect(old('user_id'))->contains($user->id) ? 'selected' : ''}}>
                                            {{$user->name." - "}}{{isset($user->company) ? $user->company->company_name   :''}}
                                        </option>
                                    @empty

                                    @endforelse

                                </select>
                                @if($errors->has('priority'))
                                    <small class="invalid-text">{{$errors->first('priority')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">بخش مربوطه:<span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select" style="width: 100%;" required
                                        name="section">
                                    <option></option>
                                    <option value="پشتیبانی" {{collect(old('section'))->contains('پشتیبانی') ? 'selected' : ''}}>
                                        پشتیبانی
                                    </option>
                                    <option value="مدیریت" {{collect(old('section'))->contains('مدیریت') ? 'selected' : ''}}>
                                        مدیریت
                                    </option>
                                    <option value="مالی" {{collect(old('section'))->contains('مالی') ? 'selected' : ''}}>
                                        مالی
                                    </option>
                                </select>
                                @if($errors->has('section'))
                                    <small class="invalid-text">{{$errors->first('section')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">درجه اهمیت:<span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select" style="width: 100%;" required
                                        name="priority">
                                    <option></option>
                                    <option value="عادی" {{collect(old('priority'))->contains('عادی') ? 'selected' : ''}}>
                                        عادی
                                    </option>
                                    <option value="مهم" {{collect(old('priority'))->contains('مهم') ? 'selected' : ''}}>
                                        مهم
                                    </option>
                                    <option value="خیلی مهم" {{collect(old('priority'))->contains('خیلی مهم') ? 'selected' : ''}}>
                                        خیلی مهم
                                    </option>
                                </select>
                                @if($errors->has('priority'))
                                    <small class="invalid-text">{{$errors->first('priority')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">عنوان درخواست:<span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title"
                                       value="{{old('title')}}">
                                @if($errors->has('title'))
                                    <small class="invalid-text">{{$errors->first('title')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">شرح درخواست:<span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کتید." name="description"
                                          required>{{old('description')}}</textarea>
                                @if($errors->has('description'))
                                    <small class="invalid-text">{{$errors->first('description')}}</small>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-3 text-right control-label col-form-label">پیوست فایل:</label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" name="file">
                                <small class="text-info"> فقط فایل با فرمت zip و rar و pdf و doc و docx و jpg و png و حداکثر حجم
                                    5000
                                    کیلوبایت مجاز است.</small>
                                @if($errors->has('file'))
                                    <p>
                                        <small class="invalid-text">{{$errors->first('file')}}</small>
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="submit"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">ارسال
                                تیکت
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Send Ticket -->
@stop
