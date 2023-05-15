@extends('layouts.main-dashboard')
@section('title')افزودن چالش@stop
@section('current-page-title')افزودن چالش جدید@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">افزودن چالش</li>
    <li class="breadcrumb-item active">افزودن چالش جدید</li>
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
                    <h4 class="card-title">افزودن چالش </h4>
                    <p class="card-subtitle">در اینجا میتوانید چالش جدید ثبت کنید.</p>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <form action="{{route('admin.challenge.store')}}" class="form-horizontal clearfix" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نام چالش : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" value="{{{old('title')}}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('title'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('title')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نامک چالش : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" name="slug" value="{{{old('slug')}}}" class="form-control"
                                               placeholder="">
                                        @if($errors->has('slug'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('slug')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">دسته چالش: </label>
                                    <div class="col-3">
                                        <select class="select2 form-control custom-select" style="width: 100%;"
                                                name="category_id">
                                            <option></option>
                                            @forelse($categories as $cat)
                                                <option value="{{$cat->id}}"
                                                        @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                            @empty

                                            @endforelse

                                        </select>
                                        @if($errors->has('category_id'))
                                            <small class="invalid-text">{{$errors->first('category_id')}}</small>
                                        @endif
                                    </div>

                                    <label class="col-sm-3 text-right control-label col-form-label">تاریخ
                                        اتمام: </label>
                                    <div class="col-3">
                                        <input type="text" name="expire_date"
                                               class="form-control text-center datepicker-day"
                                               value="{{old('expire_date')}}" placeholder="">
                                        @if($errors->has('expire_date'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('expire_date')}}
                                            </div>
                                        @endif

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات چالش
                                        : </label>
                                    <div class="col-12">
                                <textarea name="description" id="editor1" rows="10"
                                          cols="80">{{old('description')}}</textarea>
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
                                          cols="1">{{old('excerpt')}}</textarea>
                                        @if($errors->has('excerpt'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('excerpt')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">متن جایزه: </label>
                                    <div class="col-12">
                                <textarea name="prize_text" class="form-control" rows="1"
                                          cols="1">{{old('prize_text')}}</textarea>
                                        @if($errors->has('prize_text'))
                                            <div class="alert alert-danger">
                                                {{$errors->first('prize_text')}}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                        ثبت
                                        چالش جدید
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
