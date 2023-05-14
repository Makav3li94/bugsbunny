@extends('layouts.main-dashboard')
@section('title')لیست شرکت کنندگان {{$challenge['title']}}@stop
@section('current-page-title')لیست شرکت کنندگان {{$challenge['title']}}@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">شرکت کنندگان</li>
    <li class="breadcrumb-item active">لیست شرکت کنندگان</li>
@stop
@section('content')
    <!-- List Customer -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست شرکت کنندگان {{$challenge['title']}}</h4>
                    <p class="card-subtitle">در اینجا لیست شرکت کنندگانی خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام</th>
                                <th class="text-center">نام کاربری</th>
                                <th class="text-center">تعداد سوالات آزمون</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center">اتمام رسیده؟</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($challenge['quiz_headers'] as $key=> $quiz)

                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>

                                    <td>{{$quiz['user']['name']}}</td>
                                    <td>{{$quiz['user']['username']}}</td>
                                    <td>{{$quiz['quiz_size'] }}</td>
                                    <td>
                                        @if($quiz['completed'])
                                            <span class="badge badge-pill badge-success">تمام شده</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">تمام نشده</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($quiz['status'])
                                            <span class="badge badge-pill badge-success">تمام شده</span>
                                        @else
                                            <span class="badge badge-pill badge-danger">تمام نشده</span>
                                        @endif
                                    </td>

                                    <td style="width: 120px;">
                                        <a href="{{route('admin.question.index',['id'=>$quiz['id']])}}"
                                           class="btn btn-warning btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil-alt  ml-1"></i>مشاهده
                                        </a>
                                        <a href="{{route('admin.challenge.edit',$quiz['id'])}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
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
    <!-- End Customer -->

    <!-- End Customer -->

@stop
@section('script')

@endsection
