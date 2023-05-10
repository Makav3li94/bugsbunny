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
                                    <td style="width: 120px;">
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

    <!-- End Customer -->

@stop
@section('script')

@endsection
