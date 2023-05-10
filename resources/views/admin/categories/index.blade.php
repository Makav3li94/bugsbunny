@extends('layouts.main-dashboard')
@section('title')دسته بندی ها@stop
@section('current-page-title')دسته بندی ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">دسته بندی ها</li>
    <li class="breadcrumb-item active">دسته بندی ها</li>
@stop
@section('content')

    <!-- Label Visa -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست دسته بندی ها</h4>
                    <p class="card-subtitle">در اینجا میتوانید انواع دسته بندی را ثبت کنید.</p>
                    <div class="table-responsive px-1">
                        <table class="table table-sm table-striped table-bordered color-table success-table table-hover text-center white-space-nowrap v-middle">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام لیبل</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="catBody">
                            @foreach($categories as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-cat" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button class="btn btn-danger btn-sm remove-cat" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapseCat">افزودن دسته جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix collapse" id="collapseCat">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">عنوان : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title">
                                <small class="invalid-text" id="toCreateCat"></small>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                    id="submitCat">ثبت
                                دسته جدید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Label Visa -->

    <!-- End Label Customer Management -->
    <!-- Visa Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseCatEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseCatForm">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام لیبل: <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="" name="title">
                                <small class="invalid-text" id="toEditCollapseCat"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseCat"
                            data-id="">ثبت ویرایش
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
