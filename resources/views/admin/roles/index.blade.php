@extends('layouts.main-dashboard')
@section('title')لیست نقش ها@stop
@section('current-page-title')لیست نقش ها@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">مدیران</li>
    <li class="breadcrumb-item active">لیست مدیریت نقش ها</li>
@stop
@section('content')
    <!-- List Admin -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست نقش ها</h4>
                    <p class="card-subtitle">در اینجا لیست نقش های سایت را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table id="sort-table"
                               class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                               width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">نام</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($roles as $key => $role)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$role->name}}</td>
                                    <td style="width: 120px;">
                                        <a href="{{route('admin.roles.edit',$role->id)}}"
                                           class="btn btn-success btn-sm"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </a>
                                        <button type="button" class="btn btn-danger btn-sm delete-admin"
                                                id="{{$role->id}}">
                                            <i class="d-inline-flex align-middle ti-close"></i>
                                        </button>
                                        <form method="post" action="{{route('admin.roles.destroy',$role->id)}}"
                                              id="{{$role->id}}">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">افزودن نقش</h4>
                    <p class="card-subtitle">در اینجا نقش ایجاد کنید.</p>
                    <form class="clearfix" action="{{route('admin.roles.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">عنوان</label>
                                    <input type="text" class="form-control" placeholder="" name="name"
                                           value="{{old('name')}}" id="date">
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="from">نقش<span class="text-danger mr-1">*</span></label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="permission[]" required id="from" multiple>
                                        <option></option>
                                        @foreach($permissions as $permission)
                                            <option value="{{$permission->id}}">
                                                @include('admin.roles.permisions_switch')
                                            </option>
                                        @endforeach

                                    </select>
                                    @if($errors->has('permission[]'))
                                        <small class="invalid-text">{{$errors->first('permission[]')}}</small>
                                    @endif
                                </div>
                            </div>


                        </div>

                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light">ثبت و ذخیره
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
