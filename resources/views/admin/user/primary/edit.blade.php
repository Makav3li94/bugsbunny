@extends('layouts.main-dashboard')
@section('title')جزئیات حساب اصلی@stop
@section('current-page-title')جزئیات حساب اصلی@stop
@section('breadcrumbs')
    <li class="breadcrumb-item">حساب اصلی</li>
    <li class="breadcrumb-item">لیست حساب اصلی</li>
    <li class="breadcrumb-item active">جزئیات حساب اصلی</li>
@stop
@section('content')
    {{--    @if($errors->all())--}}
    {{--        @php dd($errors->all()) @endphp--}}
    {{--    @endif--}}
    <input type="hidden" name="id" value="{{$user->id}}">
    <!-- Profile -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form class="clearfix" action="{{route('admin.user.primary.update',$user->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{$user->name}}" name="name">
                                    @if($errors->has('name'))
                                        <small class="invalid-text">{{$errors->first('name')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                                    <input type="text" class="form-control" placeholder=""
                                           value="{{$user->username}}" name="username" required>
                                    @if($errors->has('username'))
                                        <small class="invalid-text">{{$errors->first('username')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>ایمیل <span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                           value="{{$user->email}}" name="email">
                                    @if($errors->has('email'))
                                        <small class="invalid-text">{{$errors->first('email')}}</small>
                                    @endif
                                </div>
                            </div>

                        </div>
                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>موبایل <span class="text-danger mr-1">*</span></label>
                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                           value="{{$user->mobile}}" name="mobile">
                                    @if($errors->has('mobile'))
                                        <small class="invalid-text">{{$errors->first('mobile')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>تاریخ تولد</label>
                                    <input type="text" class="form-control datepicker-year" placeholder=""
                                           value="{{$user->birthDate}}" name="birthDate">
                                    @if($errors->has('birthDate'))
                                        <small class="invalid-text">{{$errors->first('birthDate')}}</small>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>دسته مورد علاقه</label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            multiple="multiple"
                                            name="cats[]">
                                        <option></option>
                                        @forelse($categories as $cat)
                                            <option value="{{$cat->id}}" @if(in_array($cat->id,json_decode($user->cats))) selected @endif>{{$cat->title}}</option>
                                        @empty

                                        @endforelse

                                    </select>
                                    @if($errors->has('role'))
                                        <small class="invalid-text">{{$errors->first('role')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                <label class="">تصویر:</label>
                                    <img src="{{
                                $user->avatar ?
                                url('/images/user/'.$user->avatar)
                                :
                                ' https://via.placeholder.com/100x100'
                                }}" width="50" height="50" class="rounded" style="position: absolute;left: 10px;top: 22px" alt="">
                                    <input type="file" name="avatar" class="form-control" placeholder="">
                                    @if($errors->has('avatar'))
                                        <div class="alert alert-danger">
                                            {{$errors->first('avatar')}}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>نحوه آشنایی</label>
                                    <select class="select2 form-control custom-select" style="width: 100%;"
                                            name="familiarity">
                                        <option></option>
                                        @foreach($familiarities as $familiarity)
                                            <option
                                                value="{{$familiarity->id}}" {{$familiarity->id==$user->familiarity_id ? 'selected' : ''}}>{{$familiarity->title}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('familiarity'))
                                        <small class="invalid-text">{{$errors->first('familiarity')}}</small>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>رمز عبور جدید </label>
                                    <input type="password" class="form-control" placeholder=""
                                           value="" name="password">
                                    @if($errors->has('password'))
                                        <small class="invalid-text">{{$errors->first('password')}}</small>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="display: block">وضعیت کاربر</label>
                                    <input type="checkbox" name="authStatus" class="form-control" data-on="تایید  شده."
                                           data-off="تایید نشده"
                                           data-toggle="toggle" data-size="bg" data-onstyle="success"
                                           data-style="ios"
                                           @if($user->authStatus=='1') checked @endif id="{{$user->id}}"/>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group m-b-0">
                                    <div class="float-left">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light"
                                                id="">ثبت ویرایش
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
    <!-- End Profile -->


    <!-- Note -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">یادداشت ها</h4>
                    <p class="card-subtitle">در اینجا میتوانید یادداشت را ثبت کنید.</p>
                    <div class="table-responsive px-1">
                        <!--Hint dadash: in table tanha table ast ke be table nabayad class white-space-nowrap dade shavad va alan ham pakesh kardam-->
                        <table
                            class="table table-sm table-striped table-bordered color-table success-table table-hover text-center v-middle">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 55px;">ردیف</th>
                                <th class="text-center">توضیحات</th>
                                <th class="text-center" style="width: 120px;">عملیات</th>
                            </tr>
                            </thead>
                            <tbody id="noteTbody">
                            @foreach($notes as $key=>$note)
                                <tr>
                                    <td style="width: 55px;">{{$key+1}}</td>
                                    <td>{!! $note->description !!}</td>
                                    <td style="width: 120px;">
                                        <button class="btn btn-success btn-sm edit-note" id="{{$note->id}}"><i
                                                class="d-inline-flex align-middle ti-pencil ml-1"></i>جزئیات
                                        </button>
                                        <button class="btn btn-danger btn-sm remove-note" id="{{$note->id}}"><i
                                                class="d-inline-flex align-middle ti-close"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="form-group text-center mt-3">
                        <button type="submit" class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapsenote">افزودن یادداشت جدید
                        </button>
                    </div>
                    <form class="form-horizontal clearfix collapse" id="collapsenote">
                        <div class="row form-group">
                            <label class="col-sm-3 text-right control-label col-form-label">توضیحات: <span
                                    class="text-danger mr-1">*</span></label>
                            <div class="col-sm-9">
                                <textarea class="form-control" cols="4" placeholder="" name="description"></textarea>
                                <small class="invalid-text" id="toCreateNoteDescription"></small>
                            </div>
                        </div>
                        <div class="form-group m-b-0">
                            <button type="button"
                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                    id="submitNote">ثبت
                                یادداشت جدید
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- End Note -->
@stop
