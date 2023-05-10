@extends('layouts.main-dashboard')
@section('title')ارسال پیامک@stop
@section('current-page-title')ارسال پیامک@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item active">ارسال پیامک</li>
@stop
@section('content')
    <!-- Add SMS User -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ارسال پیامک</h4>
                    <p class="card-subtitle">در اینجا به مخاطب خود پیامک ارسال کنید.</p>
                    <form class="clearfix" action="{{route('admin.sms.store.batch')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>از شماره<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;" required
                                            name="smsSender">
                                        <option></option>
                                        @foreach($sms_numbers->chunk(10) as $chunk )
                                            @foreach($chunk as $number)
                                                <option value="{{$number->id}}" {{collect(old('smsSender'))->contains($number->id) ? 'selected' : ''}}>{{$number->number}}
                                                    - {{$number->title}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @if($errors->has('smsSender'))
                                        <small class="invalid-text">{{$errors->first('smsSender')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>به<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control select2-multiple" style="width: 100%"
                                            multiple="multiple" data-placeholder="انتخاب کنید" name="relation[]"
                                            required>
                                        <option></option>
                                        @foreach($users->chunk(10) as $chunk)
                                            @foreach($chunk as $user)
                                                <option value="{{$user->id}}" {{collect(old('relation'))->contains($user->id) ? 'selected' : ''}}>
                                                    VN-{{$user->uid}} - {{$user->name}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @if($errors->has('relation'))
                                        <small class="invalid-text">{{$errors->first('relation')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>متن پیام<span class="text-danger mr-1">*</span></label>
                                    <textarea class="form-control" name="description"
                                              required>{{old('description')}}</textarea>
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
                                                class="btn btn-success btn-rounded waves-effect waves-light">ارسال پیامک
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
    <!-- End Add SMS User-->

    <!-- Add SMS Number -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ارسال پیامک به شماره</h4>
                    <p class="card-subtitle">در اینجا به شماره مورد نظر خود پیامک ارسال کنید.</p>
                    <form class="clearfix" action="{{route('admin.sms.store.single')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>از شماره<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;" required
                                            name="smsSender">
                                        <option></option>
                                        @foreach($sms_numbers->chunk(10) as $chunk )
                                            @foreach($chunk as $number)
                                                <option value="{{$number->id}}" {{collect(old('smsSender'))->contains($number->id) ? 'selected' : ''}}>{{$number->number}}
                                                    - {{$number->title}}</option>
                                            @endforeach
                                        @endforeach
                                    </select>
                                    @if($errors->has('smsSender'))
                                        <small class="invalid-text">{{$errors->first('smsSender')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>به<span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder="09121234567" required
                                           value="{{old('mobile')}}" name="mobile">
                                    @if($errors->has('mobile'))
                                        <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام و نام خانوادگی<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder="" value="{{old('name')}}"
                                           name="name" required>
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>متن پیام<span class="text-danger mr-1">*</span></label>
                                    <textarea class="form-control" name="message"
                                              required>{{old('message')}}</textarea>
                                    @if($errors->has('message'))
                                        <small class="invalid-text">{{$errors->first('message')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light">ارسال پیامک
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
    <!-- End Add SMS Number-->

    <!-- Massage Default -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست پیام های آماده</h4>
                    <p class="card-subtitle">در اینجا لیست پیام های آماده خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">متن پیام</th>
                                <th class="text-center" style="width: 60px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($drafts as $key=>$draft)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td><textarea id="text{{$draft->id}}" type="text" rows="5"
                                                  class="form-control">{{$draft->description}}</textarea>
                                    </td>
                                    <td style="width: 60px;">
                                        <div class="input-group-prepend cursor-pointer"
                                             onclick="Copy('text{{$draft->id}}');"
                                             data-toggle="tooltip" data-placement="top" title="کپی لینک در حافظه موقت">
                                        <span class="input-group-text"><i
                                                    class="fa fa-copy fa-lg text-success"></i></span>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Massage Default -->
@endsection
