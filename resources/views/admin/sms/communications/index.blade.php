@extends('layouts.main-dashboard')
@section('title')لیست خطوط@stop
@section('current-page-title')لیست خطوط@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item">مدیریت خطوط</li>
    <li class="breadcrumb-item active">لیست خطوط</li>
@stop
@section('content')
    <!-- List SMS -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست خطوط</h4>
                    <p class="card-subtitle">در اینجا لیست خطوط ارتباطی جهت ارسال پیامک را مشاهده می کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان پنل</th>
                                <th class="text-center">شماره ارسال کننده</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sms_senders as $key=>$sms_sender)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$sms_sender->title}}</td>
                                    <td dir="ltr">{{$sms_sender->number}}</td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.com.edit',$sms_sender->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-sms-sender"
                                                id="{{$sms_sender->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.com.destroy',$sms_sender->id)}}"
                                              id="{{$sms_sender->id}}">
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
