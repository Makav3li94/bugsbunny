@extends('layouts.main-dashboard')
@section('title')لیست چالش و سوال@stop
@section('current-page-title')لیست چالش و سوال@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">چالش و سوال</li>
    <li class="breadcrumb-item active">لیست چالش و سوال</li>
@stop
@section('content')
    <!-- List Customer -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست چالش ها</h4>
                    <p class="card-subtitle">در اینجا لیست چالش های خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام چالش</th>
                                <th class="text-center">دسته</th>
                                <th class="text-center">متعلق به</th>
                                <th class="text-center">تاریخ پایان</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($challenges as $key=>$challenge)
                                @if($challenge->kind == 0)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>

                                    <td>{{$challenge->title}}</td>
                                    <td>{{$challenge->category->title }}</td>
                                    <td>{{$challenge->type == 1 ? 'Admin' : $challenge->user->username }}</td>

                                    <td>
                                        {{Verta::instance($challenge->expire_date)->format('Y/m/d')}}
                                    </td>
                                    <td>
                                        @switch($challenge->status)
                                            @case(0)
                                            <span
                                                class="badge badge-pill badge-info">معلق</span>
                                            @break
                                            @case(1)

                                            <span class="badge badge-pill badge-warning">         درحال بررسی</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-pill badge-success">           تایید شده</span>

                                            @break
                                            @case(3)
                                            <span class="badge badge-pill badge-secondary">           رد شده</span>
                                            @break
                                            @case(4)
                                            <span class="badge badge-pill badge-primary">           پایان یافته</span>
                                            @break
                                            @default
                                        @endswitch
                                    </td>

                                    <td style="width: 120px;">
                                        <a href="{{route('admin.question.index',['id'=>$challenge->id])}}"
                                           class="btn btn-warning btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil-alt  ml-1"></i>سوالات
                                        </a>
                                        <a href="{{route('admin.challenge.show',$challenge->id)}}"
                                           class="btn btn-secondary btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil-alt  ml-1"></i>شرکت کنندگان
                                        </a>
                                        <a href="{{route('admin.challenge.edit',$challenge->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-section"
                                                id="{{$challenge->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.challenge.destroy',$challenge->id)}}"
                                              id="{{$challenge->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست سوال ها</h4>
                    <p class="card-subtitle">در اینجا لیست سوال های خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table-1"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">دسته</th>
                                <th class="text-center">متعلق به</th>
                                <th class="text-center">وضعیت</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($challenges as $key=>$challenge)
                                @if($challenge->kind == 1)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>

                                    <td>{{$challenge->title}}</td>
                                    <td>{{$challenge->category->title }}</td>
                                    <td>{{$challenge->type == 1 ? 'Admin' : $challenge->user->username }}</td>

                                    <td>
                                        @switch($challenge->status)
                                            @case(0)
                                            <span
                                                class="badge badge-pill badge-info">معلق</span>
                                            @break
                                            @case(1)

                                            <span class="badge badge-pill badge-warning">         درحال بررسی</span>
                                            @break
                                            @case(2)
                                            <span class="badge badge-pill badge-success">           تایید شده</span>

                                            @break
                                            @case(3)
                                            <span class="badge badge-pill badge-secondary">           رد شده</span>
                                            @break
                                            @case(4)
                                            <span class="badge badge-pill badge-primary">           پایان یافته</span>
                                            @break
                                            @default
                                        @endswitch
                                    </td>

                                    <td style="width: 120px;">


                                        <a href="{{route('admin.challenge.edit',$challenge->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-section"
                                                id="{{$challenge->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.challenge.destroy',$challenge->id)}}"
                                              id="{{$challenge->id}}">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </td>
                                </tr>
                                @endif
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->

@stop
@section('script')

@endsection
