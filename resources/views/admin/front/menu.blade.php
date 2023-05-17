@extends('layouts.main-dashboard')
@section('title')لیست منو@stop
@section('current-page-title')لیست منو@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">منو ها</li>
    <li class="breadcrumb-item active">لیست منو ها</li>
@stop
@section('content')
    <!-- List Customer -->

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست منو هدر</h4>
                    <p class="card-subtitle">در اینجا لیست منو هدر خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table
                            class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                            width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frontMenuHeader as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->link}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-menu" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$item->id}}"><i class="d-inline-flex align-middle ti-close"></i>
                                        </button>
                                        <form method="post" action="{{route('admin.front_menu.delete',$item->id)}}"
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست منو فوتر اول</h4>
                    <p class="card-subtitle">در اینجا لیست منو فوتر اول خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table
                            class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                            width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frontMenusFooter1 as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->link}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-menu" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.front_menu.delete',$item->id)}}"
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست منو فوتر دوم</h4>
                    <p class="card-subtitle">در اینجا لیست منو فوتر دوم خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table
                            class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                            width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frontMenusFooter2 as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->link}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-menu" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.front_menu.delete',$item->id)}}"
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
        <div class="col-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">لیست منو فوتر سوم</h4>
                    <p class="card-subtitle">در اینجا لیست منو فوتر سوم خود را مشاهده کنید.</p>
                    <div class="table-responsive px-1">
                        <table
                            class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                            width="100%">
                            <thead class="bg-success text-white">
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">عنوان</th>
                                <th class="text-center">لینک</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($frontMenusFooter3 as $key=>$item)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{{$item->title}}</td>
                                    <td>{{$item->link}}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-menu" id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm delete-user"
                                                id="{{$item->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                        <form method="post"
                                              action="{{route('admin.front_menu.delete',$item->id)}}"
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
                                data-toggle="collapse" href="#collapseCat">افزودن منو جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix" id="collapseCat" action="{{route('admin.front_menu.store')}}"
                          method="post">
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
                                <select name="type" class="form-control">
                                    <option value="0">هدر</option>
                                    <option value="1">فوتر اول</option>
                                    <option value="2">فوتر دوم</option>
                                    <option value="3">فوتر سوم</option>
                                </select>
                                @if($errors->has('type'))
                                    {{$errors->first('type')}}
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
         aria-hidden="true" style="display: none;" id="collapseMenuEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <form class="form-horizontal clearfix" id="collapseMenuForm" action="" method="post">
                        @csrf
                        @method('PATCH')
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
                                    <select name="type" class="form-control">
                                        <option value="0">هدر</option>
                                        <option value="1">فوتر اول</option>
                                        <option value="2">فوتر دوم</option>
                                        <option value="3">فوتر سوم</option>
                                    </select>
                                    @if($errors->has('type'))
                                        {{$errors->first('type')}}
                                    @endif
                                </div>
                                <div class="col-sm-3">
                                    <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light">
                                        ثبت
                                    </button>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن
                            </button>
                            <button type="submit" class="btn btn-success waves-effect waves-light"
                                    id="submitCollapseMenu"
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
