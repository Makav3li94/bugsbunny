@extends('layouts.main-dashboard')
@section('title')پیام  ها@stop
@section('current-page-title')پیام  ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیام  ها</li>
    <li class="breadcrumb-item active">پیام  ها</li>
@stop
@section('content')

    <!-- Label Visa -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست پیام  ها</h4>
                    <p class="card-subtitle">در اینجا میتوانید انواع پیام را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام </th>
                                <th class="text-center">پیام </th>
                                <th class="text-center">ایمیل</th>
                                <th class="text-center">تلفن</th>
                            </tr>
                            </thead>
                            <tbody >
                            @forelse($contacts as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->message}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->tel}}</td>

                                </tr>
                            @empty
                                <tr class="alert alert-info text-center">فعلا پیامی موجود نیست.</tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Label Visa -->

    <!-- End Label Customer Management -->
    <!-- Visa Modal -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseReplyEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseReplyForm" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">متن پیام : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                               <textarea name="body" class="form-control" rows="3"
                                         cols="3">{{old('body')}}</textarea>
                                <small class="invalid-text" id="toEditCollapseBody"></small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                    <button type="button" class="btn btn-success waves-effect waves-light" id="submitCollapseReply"
                            data-id="">ثبت ویرایش
                    </button>
                </div>
            </div>
        </div>
    </div>

@endsection
