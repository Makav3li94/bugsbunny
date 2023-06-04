@extends('layouts.main-dashboard')
@section('title')افزودن {{$type == 'challenge' ? "چالش" :"سوال"}}@stop
@section('current-page-title')افزودن {{$type == 'challenge' ? "چالش" :"سوال"}} جدید@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">افزودن {{$type == 'challenge' ? "چالش" :"سوال"}}</li>
    <li class="breadcrumb-item active">افزودن {{$type == 'challenge' ? "چالش" :"سوال"}} جدید</li>
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
                    <h4 class="card-title">افزودن {{$type == 'challenge' ? "چالش" :"سوال"}} </h4>
                    <p class="card-subtitle">در اینجا میتوانید {{$type == 'challenge' ? "چالش" :"سوال"}} جدید ثبت
                        کنید.</p>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="{{route('admin.challenge.store')}}" class="form-horizontal clearfix"
                                  method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                @if($type == 'thread' )
                                    <input type="hidden" name="kind" value="1">
                                @endif
                                <div class="row form-group">
                                    <label
                                        class="col-sm-3 text-right control-label col-form-label">نام {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{{old('title')}}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('title'))
                                            <small class="invalid-text">{{$errors->first('title')}}</small>
                                        @endif
                                    </div>
                                </div>


                                <div class="row form-group">
                                    <label
                                        class="col-sm-3 text-right control-label col-form-label">دسته {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        : </label>
                                    <div class="col-{{$type == 'challenge' ? '3' : '9'}}">
                                        <select class="select2 form-control custom-select" style="width: 100%;"
                                                name="category_id">
                                            <option></option>
                                            @forelse($categories as $cat)
                                                @if($type == 'challenge' )
                                                    @if($cat->type == 0)
                                                        <option value="{{$cat->id}}"
                                                                @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                                    @endif
                                                @else
                                                    @if($cat->type == 1)
                                                        <option value="{{$cat->id}}"
                                                                @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
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
                                                   value="{{old('expire_date')}}" placeholder="">
                                            @if($errors->has('expire_date'))
                                                <small class="invalid-text">{{$errors->first('expire_date')}}</small>
                                            @endif

                                        </div>
                                    @endif
                                </div>
                                <div class="row form-group">
                                    <label
                                        class="col-sm-3 text-right control-label col-form-label">توضیحات {{$type == 'challenge' ? "چالش" :"سوال"}}
                                        : </label>
                                    <div class="col-12">
                                <textarea name="description" id="editor1" rows="10" placeholder=""
                                          cols="80">{!! old('description') !!}</textarea>
                                        @if($errors->has('description'))
                                            <small class="invalid-text">{{$errors->first('description')}}</small>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                    <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{!! old('excerpt')!!}</textarea>
                                        @if($errors->has('excerpt'))
                                            <small class="invalid-text">{{$errors->first('excerpt')}}</small>
                                        @endif
                                    </div>
                                </div>
                                @if($type == 'challenge' )
                                    <div class="row form-group">
                                        <label class="col-sm-3 text-right control-label col-form-label">متن
                                            جایزه: </label>
                                        <div class="col-12">
                                <textarea name="prize_text" class="form-control" rows="1"
                                          cols="1">{{old('prize_text')}}</textarea>
                                            @if($errors->has('prize_text'))
                                                <small class="invalid-text">{{$errors->first('prize_text')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                        ثبت
                                        {{$type == 'challenge' ? "چالش" :"سوال"}} جدید
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
        $(document).ready(function () {
            CKEDITOR.replace('editor1', {

                contentsLangDirection: 'rtl',
                // language: 'fa',
                filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

            });
        });

    </script>
@endsection
