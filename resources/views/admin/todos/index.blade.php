@extends('layouts.main-dashboard')
@section('title')بررسی کارها@stop
@section('current-page-title')بررسی کارها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item active">بررسی کارها</li>
@stop
@section('content')
    <!-- Case Today -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">کارهای انجام نشده</h4>
                    <p class="card-subtitle">در اینجا کارهای باقیمانده را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">موبایل</th>
                                <th class="text-center">موضوع</th>
                                <th class="text-center">زمان</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>

                            @forelse($notifications as $key=> $notification)

                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$notification->data['name']}}</td>
                                    <td>{{$notification->data['mobile']}}</td>
                                    <td>
                                        @php $link = '' @endphp
                                        @switch($notification->data['type'])
                                            @case('register')
                                            ثبت نام جدید
                                            @php $link = route('admin.user.primary.edit',$notification->data['user_id']) @endphp
                                            @break
                                            @case('profileChange')
                                            ویرایش پروفایل
                                            @php $link = route('admin.user.primary.edit',$notification->data['user_id']) @endphp
                                            @break
                                            @case('reply')
                                            کامنت جدید
                                            @php $link = route('admin.reply.index',$notification->data['type_id']) @endphp
                                            @break
                                            @case('credit')
                                            درخواست بررسی چالش یا سوال
                                            @php $link = route('admin.credit.edit',$notification->data['type_id']) @endphp
                                            @break

                                            @case('challenge')
                                             درخواست بررسی کیفیت
                                            @php $link = route('admin.challenge.edit',$notification->data['type_id']) @endphp
                                            @break

                                            @case('ticket')
                                            تیکت جدید
                                            @php $link = route('admin.ticket.show',$notification->data['type_id']) @endphp
                                            @break

                                            @default
                                        @endswitch
                                    </td>
                                    <td dir="ltr">{{verta($notification->created_at)->formatDifference()}}</td>
                                    <td><input type="checkbox"  data-on="تایید شده"
                                               data-off="تایید نشده"
                                               data-toggle="toggle" data-size="sm" data-onstyle="success"
                                               data-style="ios" disabled

                                               @if($notification->data['status'])
                                               checked
                                               @endif id="{{$notification->data['type']}}"/>
                                    </td>

                                    <td style="width: 120px;">
                                        <a href="{{$link}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-eye ml-1"></i>مشاهده کارها
                                        </a>
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
    <!-- End Case Today -->

    <!-- Case Filter -->
{{--    <div class="row">--}}
{{--        <div class="col-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-body">--}}
{{--                    <h4 class="card-title">کارهای باقی مانده</h4>--}}
{{--                    <p class="card-subtitle">در اینجا گزارش کارهای باقی مانده را مشاهده کنید.</p>--}}
{{--                    <div class="alert alert-success">--}}
{{--                        <div class="row">--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group my-1">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                    class="ti-calendar ml-2"></i>از تاریخ</span></div>--}}
{{--                                        <input type="text" class="form-control text-center datepicker-day"--}}
{{--                                               placeholder="" name="from_date">--}}
{{--                                    </div>--}}
{{--                                    <p><small class="invalid-text" id="toFilterTodosFrom"></small></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-4">--}}
{{--                                <div class="form-group my-1">--}}
{{--                                    <div class="input-group">--}}
{{--                                        <div class="input-group-prepend"><span class="input-group-text"><i--}}
{{--                                                    class="ti-calendar ml-2"></i>تا تاریخ</span></div>--}}
{{--                                        <input type="text" class="form-control text-center datepicker-day"--}}
{{--                                               placeholder="" name="to_date">--}}
{{--                                    </div>--}}
{{--                                    <p><small class="invalid-text" id="toFilterTodosTo"></small></p>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2">--}}
{{--                                <div class="form-group my-1">--}}
{{--                                    <select class="select2 form-control custom-select" style="width: 100%" name="type">--}}
{{--                                        <option value="1">همه رکوردها</option>--}}
{{--                                        <option value="2">رکوردهای فعال</option>--}}
{{--                                        <option value="3">رکوردهای غیر فعال</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="col-md-2 text-center">--}}
{{--                                <div class="form-group text-center my-1">--}}
{{--                                    <button type="button" class="btn btn-success waves-effect waves-light btn-rounded"--}}
{{--                                            id="filterTodos">--}}
{{--                                        <i class="ti-filter ml-1"></i>فیلتر کن--}}
{{--                                    </button>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="table-responsive px-1">--}}
{{--                        <table id="sort-table-1"--}}
{{--                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"--}}
{{--                               width="100%">--}}
{{--                            <thead class="bg-success text-white">--}}
{{--                            <tr>--}}
{{--                                <th class="text-center" style="width: 55px;">ردیف</th>--}}
{{--                                <th class="text-center">کدکاربر</th>--}}
{{--                                <th class="text-center">نام و نام خانوادگی</th>--}}
{{--                                <th class="text-center">موضوع</th>--}}
{{--                                <th class="text-center">زمان</th>--}}
{{--                                <th class="text-center">وضعیت</th>--}}
{{--                                <th class="text-center" style="width: 120px;">عملیات</th>--}}
{{--                            </tr>--}}
{{--                            </thead>--}}
{{--                            <tbody id="filterTbody">--}}
{{--                            </tbody>--}}
{{--                        </table>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <!-- End Case Today -->
@stop
