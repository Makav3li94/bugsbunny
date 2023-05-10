@extends('layouts.main-dashboard')
@section('title')گزارشات ارسال@stop
@section('current-page-title')گزارشات ارسال@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">پیامک</li>
    <li class="breadcrumb-item active">گزارشات تحویل</li>
@stop
@section('content')
    <!-- List Admin -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست مدیران</h4>
                    <p class="card-subtitle">در اینجا لیست مدیران سایت را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام و نام خانوادگی</th>
                                <th class="text-center">ایمیل</th>
                                <th class="text-center">شماره همراه</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($admins as $key=>$admin)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$admin->name}}</td>

                                    <td>
                                        {{$admin->email}}
                                    </td>
                                    <td>
                                        @if($admin->mobile==null)
                                            -
                                        @else
                                            {{$admin->mobile}}
                                        @endif
                                    </td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.admins.edit',$admin->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-admin"
                                                id="{{$admin->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.admins.destroy',$admin->id)}}"
                                              id="{{$admin->id}}">
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
    <!-- End Admin -->
@stop
