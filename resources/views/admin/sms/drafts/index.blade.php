@extends('layouts.main-dashboard')
@section('title')لیست پیش نویس ها@stop
@section('current-page-title')لیست پیش نویس ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item">مدیریت پیش نویس ها</li>
    <li class="breadcrumb-item active">لیست پیش نویس ها</li>
@stop
@section('content')
    <!-- List SMS -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست پیش نویس ها</h4>
                    <p class="card-subtitle">در اینجا لیست پیش نویس های پیامک را مشاهده می کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">متن</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sms_drafts as $key=>$sms_draft)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$sms_draft->description}}</td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.draft.edit',$sms_draft->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-sms-draft"
                                                id="{{$sms_draft->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.draft.destroy',$sms_draft->id)}}"
                                              id="{{$sms_draft->id}}">
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
    <!-- End List SMS -->
@stop
