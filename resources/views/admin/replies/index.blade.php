@extends('layouts.main-dashboard')
@section('title')ریپلای ها@stop
@section('current-page-title')ریپلای ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">ریپلای ها</li>
    <li class="breadcrumb-item active">ریپلای ها</li>
@stop
@section('content')

    <!-- Label Visa -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست ریپلای ها</h4>
                    <p class="card-subtitle">در اینجا میتوانید انواع ریپلای را ثبت کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">ریپلای</th>
                                <th class="text-center">کاربر</th>
                                <th class="text-center">بخش</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="catBody">
                            @foreach($replies as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->body}}</td>
                                    <td>{{$item->user->name ." | ".$item->user->username}}</td>
                                    <td>{{$item->section->title}}</td>
                                    <td style="width: 160px;">
                                        <button type="button" class="btn btn-{{$item->status == 1 ? "danger" : "success"}} btn-sm "
                                                onclick="$('#stat-{{$item->id}}').submit()"
                                                id="{{$item->id}}">{{$item->status == 1 ? "تایید شود" : "معلق"}}
                                        </button>
                                        <form method="post" hidden
                                              action="{{route('admin.reply.update',$item->id)}}"
                                              id="stat-{{$item->id}}">
                                            <input type="hidden" name="update_type" value="1">
                                            @csrf
                                            @method('PATCH')
                                        </form>
                                        <button class="btn btn-success btn-sm edit-reply" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post" hidden
                                              action="{{route('admin.reply.destroy',$item->id)}}"
                                              id="{{$item->id}}">
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
                            <label class="col-sm-3 text-right control-label col-form-label">متن ریپلای: <span
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
