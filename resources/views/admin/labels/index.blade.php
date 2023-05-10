@extends('layouts.main-dashboard')
@section('title')لیبل ها@stop
@section('current-page-title')لیبل ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">تنظیمات</li>
    <li class="breadcrumb-item active">لیبل ها</li>
@stop
@section('content')


    <!--  Label Customer Management  -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست لیبل مدیریت مشتری</h4>
                    <p class="card-subtitle">در اینجا میتوانید انواع وضعیت مدیریت مشتری را ثبت کنید.</p>
                    <div class="table-responsive px-1">
                        <table class="table table-sm table-striped table-bordered color-table success-table table-hover text-center white-space-nowrap v-middle">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام لیبل</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="cmtTbody">
                            @foreach($cmts as $key=>$cmt)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$cmt->title}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-cmt" id="{{$cmt->id}}"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button class="btn btn-danger btn-sm remove-cmt" id="{{$cmt->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapsemanagement">افزودن مدیریت مشتری جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix collapse" id="collapsemanagement">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام لیبل: <span
                                        class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title">
                                <small class="invalid-text" id="toCreateCmt"></small>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left" id="submitCmt">ثبت
                                مدیریت مشتری جدید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Label Customer Management -->
    <!-- Visa Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseVisa">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseVisaForm">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام لیبل: <span
                                        class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title">
                                <small class="invalid-text" id="toEditCollapseVisa"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseVisa"
                            data-id="">ثبت ویرایش
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Management Title Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseCmt">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseCmtForm">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام لیبل: <span
                                        class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title">
                                <small class="invalid-text" id="toEditCollapseCmt"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseCmt"
                            data-id="">ثبت ویرایش
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
