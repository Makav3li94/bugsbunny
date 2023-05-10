@extends('layouts.main-dashboard')
@section('title')لیست کارها@stop
@section('current-page-title')لیست کارها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیریت کارها</li>
    <li class="breadcrumb-item active">لیست کارها</li>
@stop
@section('content')
    <!-- Case Today -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست کارها</h4>
                    <p class="card-subtitle">در اینجا می توانید لیست کارها را مشاهده کنید.</p>
                    @if(!empty($tasks))
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">از</th>
                                <th class="text-center">به</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">تاریخ انجام</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center" style="width: 120px;">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tasks as $key=>$task)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$task->fromAdmin->name?? ''}}</td>
                                    <td>{{$task->toAdmin->name?? ''}}</td>
                                    <td dir="ltr">{{Verta::instance($task->created_at)->format('Y/m/d - H:i')}}</td>
                                    <td>
                                        @if($task->date==null)
                                            -
                                        @else
                                            {{Verta::instance($task->date)->format('Y/m/d')}}
                                        @endif
                                    </td>
                                    <td>{{$task->description}}</td>
                                    <td><input type="checkbox" class="toggle-task"  data-on="بله"
                                               data-off="خیر"
                                               data-toggle="toggle" data-size="sm" data-onstyle="success"
                                               data-style="ios" disabled
                                               @if($task->status=='1') checked @endif id="{{$task->id}}"/></td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.task.edit',$task->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-task"
                                                id="{{$task->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post" action="{{route('admin.task.destroy',$task->id)}}"
                                              id="{{$task->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- End Case Today -->

    <!-- Case Filter -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">گزارش گیری لیست کارها</h4>
                    <p class="card-subtitle">در اینجا گزارش گیری کارها را مشاهده کنید.</p>
                    <div class="alert alert-success">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="ti-calendar ml-2"></i>از تاریخ</span></div>
                                        <input type="text" class="form-control text-center datepicker-day"
                                               placeholder="" name="from_date">
                                    </div>
                                    <p>
                                        <small class="invalid-text" id="toFilterTaskFrom"></small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group my-1">
                                    <div class="input-group">
                                        <div class="input-group-prepend"><span class="input-group-text"><i
                                                        class="ti-calendar ml-2"></i>تا تاریخ</span></div>
                                        <input type="text" class="form-control text-center datepicker-day"
                                               placeholder="" name="to_date">
                                    </div>
                                    <p>
                                        <small class="invalid-text" id="toFilterTaskTo"></small>
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group my-1">
                                    <select class="select2 form-control custom-select" style="width: 100%" name="type">
                                        <option value="1">همه رکوردها</option>
                                        <option value="2">کارهای انجام شده</option>
                                        <option value="3">کارهای انجام نشده</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 text-center">
                                <div class="form-group text-center my-1">
                                    <button type="button" class="btn btn-success waves-effect waves-light btn-rounded"
                                            id="filterTask">
                                        <i class="ti-filter ml-1"></i>فیلتر کن
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">از</th>
                                <th class="text-center">به</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">تاریخ انجام</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center" style="width: 120px;">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="filterTbody">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Case Today -->
@stop
