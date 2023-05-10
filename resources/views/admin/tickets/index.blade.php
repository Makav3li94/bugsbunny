@extends('layouts.main-dashboard')
@section('title')لیست تیکت ها@stop
@section('current-page-title')لیست تیکت ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پشتیبانی</li>
    <li class="breadcrumb-item active">لیست تیکت ها</li>
@stop
@section('content')
    <!-- Page List Ticket -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست تیکت ها</h4>
                    <p class="card-subtitle">در اینجا لیست تیکت ها را مشاهده کنید.</p>
                    <div class="table-responsive mt-4">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center">شماره تیکت</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">تاریخ ایجاد</th>
                                <th class="text-center">آخرین تغییر</th>
                                <th class="text-center">بخش مربوطه</th>
                                <th class="text-center">اهمیت</th>
                                <th class="text-center">وضعیت پاسخ دهی</th>
                                <th class="text-center">وضعیت تیکت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tickets as $key=>$ticket)
                                <tr>
                                    <td>{{$key+1}}</td>
                                    <td>{{$ticket->title}}</td>
                                    <td>{{Verta::instance($ticket->created_at)->format('Y/n/j')}}</td>
                                    <td>{{Verta::instance($ticket->updated_at)->format('Y/n/j')}}</td>
                                    <td>{{$ticket->section}}</td>
                                    <td>{{$ticket->priority}}</td>
                                    <td>
                                        @if($ticket->answer=='0')
                                            <span class="label label-info">پیام کاربر</span>
                                        @elseif($ticket->answer=='1')
                                            <span class="label label-info">در حال رسیدگی</span>
                                        @elseif($ticket->answer=='2')
                                            <span class="label label-info">پیام مدیر</span>
                                        @endif
                                        @if($ticket->faqs()->where('seen','0')->get()->count()>0)
                                            <span class="label label-danger">{{ $ticket->faqs()->where('seen','0')->get()->count()}}</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="label label-table label-{{$ticket->status=='0' ? 'danger' : 'success'}}">
                                           {{$ticket->status=='0' ? 'بسته' : 'باز'}}
                                        </span>
                                    </td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.ticket.show',$ticket->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-eye ml-1"></i>مشاهده
                                        </a>
                                        <a href="#"
                                           class="btn btn-{{$ticket->status=='0' ? 'success' : 'danger'}} btn-sm"
                                           onclick="event.preventDefault();document.getElementById('form-{{$ticket->id}}').submit()"
                                           data-toggle="tooltip" title="{{$ticket->status=='0' ? 'بازکردن تیکت' : 'بستن تیکت'}}">
                                            <i class="d-inline-flex align-middle ti-{{$ticket->status=='0' ? 'unlock' : 'lock'}}"></i>
                                        </a>
                                        <form method="post"
                                              action="{{route('admin.ticket.toggle',$ticket->id)}}"
                                              id="form-{{$ticket->id}}" class="d-none">
                                            @csrf
                                            @method('PATCH')
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
    <!-- End List Ticket -->
@stop
