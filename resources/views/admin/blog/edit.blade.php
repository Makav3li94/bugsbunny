@extends('layouts.main-dashboard')
@section('title')ویرایش صفحه@stop
@section('current-page-title')ویرایش صفحات@stop
@section('breadcrumbs')
    <li class="breadcrumb-item "><a href="javascript:void(0)">مدیریت صفحات</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">ویرایش صفحه</a></li>
@stop
@section('styles')
    <link href="{{asset('admin/node_modules/timepicker/css/timepicker.min.css')}}" rel="stylesheet"/>
    <style>
        ._jw-tpk-container {
            bottom: 120px !important;
        }

        .form-line .bootstrap-tagsinput {
            display: block;
            width: 100%;
            height: calc(2.25rem + 2px);
            padding: .375rem .75rem;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid #ced4da !important;
            border-radius: .25rem;
            transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;

        }

        .form-line .bootstrap-tagsinput:focus {
            color: #495057;
            background-color: #fff;
            border-color: #80bdff !important;
            outline: 0;
            box-shadow: 0 0 0 .2rem rgba(0, 123, 255, .25);
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">افزودن صفحه</h4>
                    <p class="card-subtitle">در اینجا میتوانید صفحه جدید ثبت کنید.</p>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="{{route('admin.blog.update',$blog->id)}}" class="form-horizontal clearfix"
                                  method="post" enctype="multipart/form-data">
                                @csrf
                                {{ method_field('PUT') }}
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نام صفحه: <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{$blog->title}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('title'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('title')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نامک صفحه: <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="slug" value="{{$blog->slug}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('slug'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('slug')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">تصویر اصلي صفحه:</label>
                                    <div class="col-sm-9">
                                        <img src="{{
                                $blog->img_cover ?
                                url('/images/upload/blog/'.$blog->img_cover)
                                :
                                ' https://via.placeholder.com/100x100'
                                }}" width="100px" height="100px" alt="">
                                        <input type="file" name="img_cover" class="form-control" placeholder="">
                                        @if($errors->has('img_cover'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('img_cover')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">متن صفحه: </label>
                                    <div class="col-12">
                                        <textarea name="description" id="editor1" rows="10"
                                                  cols="80">{{$blog->description}}</textarea>
                                        @if($errors->has('description'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('description')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group " hidden>
                                    <label class="col-sm-2 text-right control-label col-form-label">زمان
                                        انتشار: </label>
                                    <div class="col-5">
                                        <input type="text" name="published_at"
                                               class="form-control text-center datepicker-day" value="{{$date}}"
                                               placeholder="">

                                    </div>
                                    <div class="col-5">
                                        <input type="text" id="publish_time" name="publish_time" class="form-control"
                                               value="{{$time}}" placeholder="ساعت انتشار">
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                    <div class="col-12">
                                        <textarea name="excerpt" class="form-control" rows="5"
                                                  cols="5">{!! $blog->excerpt !!}</textarea>
                                        @if($errors->has('excerpt'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('excerpt')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>


                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                        ویرایش صفحه
                                    </button>
                                    <a target="_blank" href="{{$blog->slug}}"
                                       class="btn btn-primary btn-rounded m-t-10 m-r-5 float-left">مشاهده صفحه</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

@endsection

