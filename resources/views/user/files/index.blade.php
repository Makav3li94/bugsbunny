@extends('layouts.main-dashboard')
@section('title')فایل های ضمیمه@stop
@section('current-page-title')ثبت فایل های ضمیمه@stop
@section('breadcrumbs')
    <li class="breadcrumb-item "><a href="javascript:void(0)">فایل های ضمیمه</a></li>
    <li class="breadcrumb-item active"><a href="javascript:void(0)">ثبت فایل های ضمیمه</a></li>
@stop
@section('content')

    <!-- File -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">فایل های ضمیمه</h4>
                    @if($user_category_id == 0)
                        <p class="card-subtitle">درصورتی که کارگاه دارید،جهت تایید شدن کارگاه، لطفا فایل های جواز تاسیس،
                            گواهی ارزش افزوده، شناسنامه و کارت ملی را ضمیمه کنید.</p>
                        <p class="card-text">اگر صاحب کارگاه هستید، ضمیمه کردن جواز تاسیس و گواهی ارزش افزوده همچنین
                            کارت ملی و شناسنامه الزامیست.</p>
                        <p class="card-text">اگر صاحب کارگاه نیستید، صرفا شناسنامه و کارت ملی کافیست.</p>
                    @elseif($user_category_id == 1)
                        <p class="card-subtitle">جهت تایید شدن شرکت، لطفا فایل های آگهی تاسیس، اساس نامه، روزنامه رسمی
                            اخرین تغییرات، روزنامه رسمی تغییر نشانی، شرکت نامه و گواهی ارزش افزوده را ضمیمه کنید.</p>
                        <p class="card-text">ضمیمه کردن آگهی تاسیس و روزنامه رسمی اخرین تغییر مدیران الزامی است.</p>
                    @endif

                    {{--                    <ul class="list-group w-25">--}}
                    {{--                        <li class="list-group-item d-flex justify-content-between align-items-center">--}}
                    {{--                            جواز تاسیس--}}
                    {{--                            <span class="badge badge-primary badge-pill"> <i class="ti ti-check" aria-hidden="true"></i></span>--}}
                    {{--                            <span class="badge badge-primary badge-pill"> <i class="ti ti-file" aria-hidden="true"></i></span>--}}
                    {{--                        </li>--}}

                    {{--                    </ul>--}}
                    <div class="table-responsive px-1">
                        <table
                            class="table table-sm table-striped table-bordered color-table success-table table-hover text-center white-space-nowrap v-middle">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام فایل</th>
                                <th class="text-center">موضوع</th>
                                <th class="text-center">تاریخ ثبت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="fileTbody">
                            @foreach($files as $key=>$file)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$file->title}}</td>
                                    <td>{{$file->fileTitle->title}}</td>
                                    <td>{{verta($file->created_at)->format('Y-n-j')}}</td>
                                    <td style="width: 120px;">
                                        <a href="/dashboard/download/{{$file->id}}/{{auth()->id()}}?mac={{Hash::make(auth()->id().$file->id.'!@#__)(FR3')}}"
                                           class="btn btn-success btn-sm download-file" id="{{$file->id}}"><i
                                                class="d-inline-flex align-middle ti-download"></i> دانلود
                                        </a>
                                        @if(auth()->user()->authStatus != 4)
                                            <button class="btn btn-danger btn-sm remove-file" id="{{$file->id}}">
                                                <i class="d-inline-flex align-middle ti-close"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapsefile">افزودن فایل ضمیمه جدید
                        </button>
                    </div>
                    <input type="hidden" name="id" value="{{auth()->id()}}">

                    <form class="form-horizontal clearfix collapse" id="collapsefile" enctype="multipart/form-data">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام فایل: <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title" required>
                                <small class="invalid-text" id="toCreateFileTitle"></small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">موضوع: </label>
                            <div class="col-sm-9">
                                <select class="select2 form-control custom-select" style="width: 100%;"
                                        name="fileTitle" required>
                                    <option></option>
                                    @foreach($fileTitles as $fileTitle)
                                        <option value="{{$fileTitle->id}}">{{$fileTitle->title}}</option>
                                    @endforeach
                                </select>
                                <small class="invalid-text" id="toCreateFileFileTitle"></small>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">فایل: <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="file" class="form-control" placeholder="" name="file" required>
                                <small class="text-info">فقط فایل با فرمت zip و rar و pdf و jpg و doc و docx و png مجاز
                                    است.
                                </small>
                                <p>
                                    <small class="invalid-text" id="toCreateFile"></small>
                                </p>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                    id="submitFile">ثبت
                                فایل ضمیمه جدید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End File -->

@endsection
@section('user_script')
@endsection
