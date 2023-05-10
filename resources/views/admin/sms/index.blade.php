@extends('layouts.main-dashboard')
@section('title')لیست پیامک های ارسال شده@stop
@section('current-page-title')لیست پیامک های ارسال شده@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item active">لیست پیامک های ارسال شده</li>
@stop
@section('content')
    <!-- List SMS -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست پیامک های ارسال شده</h4>
                    <p class="card-subtitle">در اینجا وضعیت پیامک های ارسال شده را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان پنل</th>
                                <th class="text-center">شماره ارسال کننده</th>
                                <th class="text-center">زمان ارسال</th>
                                <th class="text-center">مشخصات</th>

                                <th class="text-center">شماره همراه</th>
                                <th class="text-center">پیغام</th>
                                <th class="text-center">وضعیت</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($messages as $key=>$message)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$message->smsSender != null ? $message->smsSender->title : 'مخابرات'}}</td>
                                    <td dir="ltr">{{$message->smsSender != null ? $message->smsSender->number : 'خط خدماتی'}}</td>
                                    <td dir="ltr">{{Verta::instance($message->created_at)->format('Y/m/d - H:i:s')}}</td>
                                    <td>{{$message->user_id==null ? $message->name : $message->user->name}}</td>

                                    <td>{{$message->user_id==null ? $message->mobile : $message->user->mobile}}</td>
                                    <td>{{$message->description}}</td>
                                    <td>
                                        <div class="alert alert-@php if ($message->status== 1){echo 'success';}elseif ($message->status == 2){echo 'warning';}elseif($message->status == 3){echo 'danger';}else{echo 'info';}  @endphp">
                                            @php if ($message->status== 1){echo 'تحویل شده';}elseif ($message->status == 2){echo 'بلک لیست';}elseif($message->status == 3){echo 'ارسلال نشد.';}else{echo 'در حال ارسال';}  @endphp
                                        </div>
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
