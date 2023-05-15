@extends('layouts.main-dashboard')
@section('title')لیست حساب اصلی@stop
@section('current-page-title')لیست حساب اصلی@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">شرکت ها</li>
    <li class="breadcrumb-item active">لیست شرکت ها</li>
@stop
@section('content')
    <!-- List Customer -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست حساب اصلی</h4>
                    <p class="card-subtitle">در اینجا لیست حساب های اصلی خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">تاریخ ثبت</th>
                                <th class="text-center">نام و نام خانوادگی</th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">تلفن</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">امتیاز</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $key=>$user)

                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>


                                    <td>
                                        {{Verta::instance($user->created_at)->format('Y/m/d')}}
                                    </td>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->username}}</td>
                                    <td>
                                        {{$user->mobile}}
                                    </td>
                                    <td>
                                        @if($user->authStatus=='1')
                                            <span class="badge badge-pill badge-success">تایید شده</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">تایید نشده</span>
                                        @endif
                                    </td>
                                    <td>{{$user->score()['total']}}</td>
                                    <td style="width: 120px;">
                                        <button type="button" class="btn btn-success btn-sm edit-score"
                                                id="{{$user->id}}">
                                            اختصاص امتیاز
                                        </button>
                                        <a href="{{route('admin.user.primary.edit',$user->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$user->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.user.primary.destroy',$user->id)}}"
                                              id="{{$user->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
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
    <!-- End Customer -->
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
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseScoreEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">

            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseScoreForm">

                        <div class="row form-group">
                            <label class="col-sm-3">امتیاز: <span class="text-danger mr-1">*</span></label>
                            <div class="col-sm-3">
                                <input type="number" min="1" class="form-control" placeholder="" name="score">
                                <small class="invalid-text" id="toEditCollapseScore"></small>
                            </div>
                            <label class="col-sm-3 ">نوع: <span class="text-danger mr-1">*</span></label>
                            <div class="col-sm-3">
                                <input type="checkbox" name="type" class="form-control" data-on="مثبت"
                                       data-off="منفی"
                                       data-toggle="toggle" data-size="bg" data-onstyle="success"
                                       data-style="ios"/>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseScore"
                            data-id="">ثبت
                    </button>
                </div>

            </div>
        </div>
    </div>
    <!-- End Customer -->

@stop
@section('script')

@endsection
