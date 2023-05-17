@extends('layouts.main-dashboard')
@section('title')لیست شبکه های اجتماعی@stop
@section('current-page-title')لیست شبکه های اجتماعی@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">شبکه های اجتماعی ها</li>
    <li class="breadcrumb-item active">لیست شبکه های اجتماعی ها</li>
@stop
@section('content')
    <!-- List Customer -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست شبکه های اجتماعی </h4>
                    <p class="card-subtitle">در اینجا لیست شبکه های اجتماعی خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table
                            class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                            width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center">تصویر</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($socials as $key=>$item)
                                    <tr>
                                        <td style="width: 55px;">{{$key}}</td>
                                        <td>{{$item->title}}</td>
                                        <td>{{$item->link}}</td>
                                        <td><img src="{{asset('images/front/socail/'.$item->icon)}}" width="30" alt="">
                                        </td>
                                        <td style="width: 120px;">
                                            <button class="btn btn-success btn-sm edit-social" id="{{$item->id}}"><i
                                                    class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm delete-user"
                                                    id="{{$item->id}}"><i
                                                    class="d-inline-flex align-middle ti-close"></i>
                                            </button>
                                            <form method="post"
                                                  action="{{route('admin.front_social.delete',$item->id)}}"
                                                  id="{{$item->id}}">
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group text-center mt-3">
                        <button type="button" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapseCat">افزودن شبکه های اجتماعی جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix" id="collapseCat"
                          action="{{route('admin.front_social.store')}}"
                          enctype="multipart/form-data" method="post">
                        @csrf
                        <div class="row form-group">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="عنوان" name="title">
                                @if($errors->has('title'))
                                    {{$errors->first('title')}}
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="text" class="form-control" placeholder="لینک" name="link">
                                @if($errors->has('link'))
                                    {{$errors->first('link')}}
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <input type="file" name="icon" value="{{old('icon')}}" class="form-control"
                                       placeholder="">
                                @if($errors->has('icon'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('icon')}}
                                    </div>
                                @endif
                            </div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">ثبت
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Customer -->
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseSocialEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseSocialForm" action=""
                          enctype="multipart/form-data" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">نام : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="عنوان" name="title">
                                @if($errors->has('title'))
                                    {{$errors->first('title')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">لینک : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" placeholder="لینک" name="link">
                                @if($errors->has('link'))
                                    {{$errors->first('link')}}
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">تصویر : <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <img id="frontWayIcon" src="" width="30" alt="">
                                <input type="file" name="icon" value="{{old('icon')}}" class="form-control"
                                       placeholder="">
                                @if($errors->has('icon'))
                                    <div class="alert alert-danger">
                                        {{$errors->first('icon')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن
                            </button>
                            <button type="submit" class="btn btn-success waves-effect waves-light"
                                    id="submitCollapseWay"
                                    data-id="">ثبت ویرایش
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@stop
@section('script')

@endsection
