@extends('layouts.main-dashboard')
@section('title')ویرایش {{$type == 'challenge' ? "چالش" :"سوال"}}@stop
@section('current-page-title')ویرایش {{$type == 'challenge' ? "چالش" :"سوال"}} جدید@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">ویرایش {{$type == 'challenge' ? "چالش" :"سوال"}}</li>
    <li class="breadcrumb-item active">ویرایش {{$type == 'challenge' ? "چالش" :"سوال"}} </li>
@stop
@section('styles')
    <style>
        ._jw-tpk-container {
            bottom: 120px !important;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">ویرایش {{$type == 'challenge' ? "چالش" :"سوال"}} </h4>
                    <p class="card-subtitle">در اینجا میتوانید {{$type == 'challenge' ? "چالش" :"سوال"}}  را ویرایش کنید.</p>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="{{route('admin.challenge.update',$challenge->id)}}" class="form-horizontal clearfix" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نام {{$type == 'challenge' ? "چالش" :"سوال"}} : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{$challenge->title}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('title'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('title')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نامک {{$type == 'challenge' ? "چالش" :"سوال"}} : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="slug" value="{{$challenge->slug}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('slug'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('slug')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">دسته {{$type == 'challenge' ? "چالش" :"سوال"}}: </label>
                                    <div class="col-{{$type == 'challenge' ? '3' : '9'}}">
                                        <select class="select2 form-control custom-select" style="width: 100%;"
                                                name="category_id">
                                            <option></option>
                                            @forelse($categories as $cat)
                                                @if($type == 'challenge' )
                                                    @if($cat->type == 0)
                                                        <option value="{{$cat->id}}" {{$challenge->category_id == $cat->id ? 'selected':''}}  >{{$cat->title}}</option>

                                                    @endif
                                                @else
                                                    @if($cat->type == 1)
                                                        <option value="{{$cat->id}}" {{$challenge->category_id == $cat->id ? 'selected':''}}  >{{$cat->title}}</option>

                                                    @endif
                                                @endif
                                            @empty
                                            @endforelse

                                        </select>
                                        @if($errors->has('category_id'))
                                            <small class="invalid-text">{{$errors->first('category_id')}}</small>
                                        @endif
                                    </div>
                                    @if($type == 'challenge' )
                                    <label class="col-sm-3 text-right control-label col-form-label">تاریخ
                                        اتمام: </label>
                                    <div class="col-3">
                                        <input type="text" name="expire_date"
                                               class="form-control text-center datepicker-day"
                                               value="{{$challenge->expire_date}}" placeholder="">
                                        @if($errors->has('expire_date'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('expire_date')}}
                                            </div>
                                        @endif

                                    </div>
                                    @endif
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        : </label>
                                    <div class="col-12">
                                <textarea name="description" id="editor1" rows="10"
                                          cols="80">{!! $challenge->description !!}</textarea>
                                        @if($errors->has('description'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('description')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                    <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{$challenge->excerpt}}</textarea>
                                        @if($errors->has('excerpt'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('excerpt')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @if($type == 'challenge' )
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">متن جایزه: </label>
                                    <div class="col-12">
                                <textarea name="prize_text" class="form-control" rows="1"
                                          cols="1">{{$challenge->prize_text}}</textarea>
                                        @if($errors->has('prize_text'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('prize_text')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                @endif
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">
                                        @if($type == 'challenge' )
                                        وضعیت
                                        {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        (لطفا پس از اتمام طراحی تمامی سوالات، وضعیت را تایید کنید):
                                        @else
                                            وضعیت
                                            {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        @endif
                                    </label>
                                    <div class="col-12">
                                        <input type="checkbox" name="status" class="form-control" data-on="تایید  شده."
                                               data-off="تایید نشده"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if($challenge->status=='2' || $challenge->status=='4') checked @endif id="{{$challenge->id}}"/>

                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                        ویرایش
                                        {{$type == 'challenge' ? "چالش" :"سوال"}}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ asset('admin/assets/node_modules/ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('editor1', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });

    </script>
@endsection
