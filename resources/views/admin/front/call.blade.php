@extends('layouts.main-dashboard')
@section('title')کال تو@stop
@section('current-page-title')کال تو@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">هیرو</li>
    <li class="breadcrumb-item active">کال تو</li>
@stop
@section('content')
    <!-- List Customer -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal clearfix" id=""
                          action="{{route('admin.front_call.update',$call->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">عنوان : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$call->title}}" placeholder="عنوان"
                                       name="title">
                                @if($errors->has('title'))
                                    {{$errors->first('title')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">زیرنویس : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$call->sub}}" placeholder="زیرنویس"
                                       name="sub">
                                @if($errors->has('sub'))
                                    {{$errors->first('sub')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">متن لینک : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$call->link_title}}" placeholder="لینک"
                                       name="link_title">
                                @if($errors->has('link_title'))
                                    {{$errors->first('link_title')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">آدرس لینک : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$call->link}}" placeholder="لینک"
                                       name="link">
                                @if($errors->has('link'))
                                    {{$errors->first('link')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">تصویر : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <img src="{{asset('images/front/call/'.$call->bg)}}" width="100">
                                <input type="file" name="bg" value="{{old('bg')}}" class="form-control"
                                       placeholder="">
                                @if($errors->has('bg'))
                                    {{$errors->first('bg')}}
                                @endif
                            </div>
                        </div>

                        <div class="form-group m-b-0">
                            <button type="submit"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">ثبت
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->

@stop
@section('script')

@endsection
