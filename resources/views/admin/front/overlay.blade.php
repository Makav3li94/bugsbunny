@extends('layouts.main-dashboard')
@section('title')اورلی@stop
@section('current-page-title')اورلی@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">هیرو</li>
    <li class="breadcrumb-item active">اورلی</li>
@stop
@section('content')
    <!-- List Customer -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="form-horizontal clearfix" id=""
                          action="{{route('admin.front_overlay.update',$overlay->id)}}" enctype="multipart/form-data"
                          method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">متن : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" placeholder="عنوان"
                                          name="body">{{$overlay->body}} </textarea>
                                @if($errors->has('body'))
                                    {{$errors->first('body')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">تصویر : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <img src="{{asset('images/front/overlay/'.$overlay->bg)}}" width="100">
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
