@extends('layouts.main-dashboard')
@section('title')تنظیمات پیامک@stop
@section('current-page-title')تنظیمات پیامک@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item active">تنظیمات پیامک</li>
@stop
@section('content')
    <!-- Add SMS Username And Password -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">تنظیمات پیامک</h4>
                    <p class="card-subtitle">در اینجا میتوانید نام کاربری و رمز عبور سرویس های پیامکی را اختصاص دهید.</p>
                    <form class="clearfix" id="main" action="{{route('admin.sms.setting.updateOrCreate')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>انتخاب سرویس<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select service-select" style="width: 100%;" required
                                            name="service">
                                        <option></option>
                                        @foreach($services as $service)
                                            <option value="{{$service}}">{{$service}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('service'))
                                        <small class="invalid-text">{{$errors->first('service')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('username')}}" name="username">
                                    @if($errors->has('username'))
                                        <small class="invalid-text">{{$errors->first('username')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رمز عبور<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('password')}}" name="password">
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>کد پترن کد تایید<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('p_confirm_code')}}" name="p_confirm_code">
                                    @if($errors->has('p_confirm_code'))
                                        <small class="invalid-text">{{$errors->first('p_confirm_code')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>کد پترن ارسال تیکت<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('p_ticket')}}" name="p_ticket">
                                    @if($errors->has('p_ticket'))
                                        <small class="invalid-text">{{$errors->first('p_ticket')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>کد پترن باز ارسال رمز عبور<span class="text-danger mr-1">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('p_password')}}" name="p_password">
                                    @if($errors->has('p_password'))
                                        <small class="invalid-text">{{$errors->first('p_password')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>کد پترن نوتیفیکیشن<span class="text-danger mr-1">*</span>
                                    </label>
                                    <input type="text" class="form-control" placeholder="" required
                                           value="{{old('p_notif')}}" name="p_notif">
                                    @if($errors->has('p_notif'))
                                        <small class="invalid-text">{{$errors->first('p_notif')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>از شماره<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;" required
                                            name="sms_sender">
                                        <option></option>
                                        @foreach($sms_numbers->chunk(10) as $chunk )
                                            @foreach($chunk as $number)
                                                <option value="{{$number->id}}" {{collect(old('sms_sender'))->contains($number->id) ? 'selected' : ''}}>{{$number->number}}
                                                    - {{$number->title}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @if($errors->has('sms_sender'))
                                        <small class="invalid-text">{{$errors->first('sms_sender')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
                                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light delete-main">
                                            ذخیره
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
    <!-- Add SMS Username And Password -->
@endsection
