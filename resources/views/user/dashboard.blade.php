@extends('layouts.main-front',[
        'title'=>'پنل کاربری شما',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'پنل کاربری شما'
        ]
    )
@section('style')
    <link rel="stylesheet" href="{{asset('front/user/persian-datepicker/persian-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/user/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/user/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/node_modules/dropify/css/dropify.min.css')}}" type="text/css"/>
    <style>
        .modal {
            overflow: auto !important;
        }
    </style>
@endsection
@section('content')

    <section class="doc_blog_grid_area sec_pad forum-page-content">
        <div class="container">
            <div class="card bb-radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="profile-img">
                                <img
                                    src="@if($user->avatar1!="" || $user->avatar !=null ) {{asset('images/user/'.$user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                    width="100" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    @forelse($cats as $cat)
                                        @if(in_array($cat->id,json_decode($user->cats))){{$cat->title}}  @endif
                                    @empty

                                    @endforelse
                                    <input type="file" name="file"/>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-8">
                            <div class="profile-head">
                                <h5>
                                    نام: {{$user->name}}
                                </h5>
                                <h6>
                                    نام کاربری: {{$user->username}}
                                </h6>
                                <p class="proile-rating">امتیاز شما : <span>{{$totalScore}}</span></p>

                            </div>

                            @if($setting!=null && $setting->wysiwyg!=null)
                                {!! $setting->wysiwyg !!}
                            @endif
                        </div>
                        <div class="col-md-2">

                            <form method="post" action=" {{route('logout')}}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger">
                                    <i class="fa fa-power-off"></i>
                                    خروج
                                </button>
                            </form>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="profile-work text-center">
                                <p>وضعیت حساب کاربری</p>
                                <span
                                    class="badge badge-{{$user->authStatus == 0 ? 'danger' : 'success'}}">{{$user->authStatus == 0 ? 'تایید نشده' : 'فعال'}}</span>
                            </div>
                            <ul class="nav nav-tabs d-flex flex-column" style="border: none" id="myTab" role="tablist">
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('crud')=='user_update' ? "active" :"" }}" id="profile-tab" data-toggle="tab" href="#profile"
                                       role="tab"
                                       aria-controls="home" aria-selected="true">ویرایش اطلاعات</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('crud')=='section_store' ? "active" :"" }}" id="chalenges-tab" data-toggle="tab" href="#chalenges"
                                       role="tab"
                                       aria-controls="chalenges" aria-selected="false">چالش ها</a>
                                </li>


                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('for')=='section' ? "active" :"" }}"
                                       id="add_chalenges-tab" data-toggle="tab" href="#add_chalenges"
                                       role="tab"
                                       aria-controls="add_chalenges" aria-selected="false">افزودن چالش</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('for')=='thread' ? "active" :"" }} "
                                       id="add_thread-tab" data-toggle="tab" href="#add_threads"
                                       role="tab"
                                       aria-controls="add_threads" aria-selected="false">افزودن سوال</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('for')=='store_thread' ? "active" :"" }} "
                                       id="thread-tab" data-toggle="tab" href="#threads"
                                       role="tab"
                                       aria-controls="threads" aria-selected="false">لیست سوال</a>
                                </li>
                                <li class="nav-item p-1">
                                    <a class="nav-link" id="scores-tab" data-toggle="tab" href="#scores" role="tab"
                                       aria-controls="scores" aria-selected="false">امتیازات</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                       aria-controls="activity" aria-selected="false">فعالیت ها</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('crud')=='ticket_store' ? "active" :"" }}" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab"
                                       aria-controls="ticket" aria-selected="false">تیکت ها</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link {{session()->get('for')=='ticket' ? "active" :"" }}"
                                       id="add-ticket-tab" data-toggle="tab" href="#add_ticket"
                                       role="tab"
                                       aria-controls="add_ticket" aria-selected="false">تیکت جدید</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-10">
                            <div class="tab-content profile-tab" id="myTabContent">


                                <div class="tab-pane fade {{session()->get('crud')=='user_update' ? " show active" :"" }}" id="profile" role="tabpanel"
                                     aria-labelledby="profile-tab">
                                    <form class="clearfix" action="{{route('user.update',$user->id)}}" method="POST"
                                          enctype="multipart/form-data">
                                        @csrf
                                        @method('PATCH')
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>نام<span class="text-danger mr-1">*</span></label>
                                                    <input type="text" class="form-control" placeholder=""
                                                           value="{{$user->name}}" name="name">
                                                    @if($errors->has('name'))
                                                        <small class="invalid-text"
                                                               style="float:right">{{$errors->first('name')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>نام کاربری<span class="text-danger mr-1">*</span></label>
                                                    <input type="text" class="form-control" placeholder=""
                                                           value="{{$user->username}}" name="username" required>
                                                    @if($errors->has('username'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('username')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>ایمیل <span class="text-danger mr-1">*</span></label>
                                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                                           value="{{$user->email}}" name="email">
                                                    @if($errors->has('email'))
                                                        <small class="invalid-text"
                                                               style="float:right">{{$errors->first('email')}}</small>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>موبایل <span class="text-danger mr-1">*</span></label>
                                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                                           value="{{$user->mobile}}" name="mobile">
                                                    @if($errors->has('mobile'))
                                                        <small class="invalid-text"
                                                               style="float:right">{{$errors->first('mobile')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>تاریخ تولد</label>
                                                    <input type="text" class="form-control datepicker-year"
                                                           placeholder=""
                                                           value="{{$user->birthDate}}" name="birthDate">
                                                    @if($errors->has('birthDate'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('birthDate')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>دسته مورد علاقه</label>
                                                    <select class="select2 form-control custom-select"
                                                            style="width: 100%;"
                                                            multiple="multiple"
                                                            name="cats[]">
                                                        <option></option>
                                                        @forelse($cats as $cat)
                                                            <option value="{{$cat->id}}"
                                                                    @if(in_array($cat->id,json_decode($user->cats))) selected @endif>{{$cat->title}}</option>
                                                        @empty

                                                        @endforelse

                                                    </select>
                                                    @if($errors->has('role'))
                                                        <small class="invalid-text"
                                                               style="float:right">{{$errors->first('role')}}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>تصویر پروفایل:</label>
                                                    <div>
                                                        <input type="file" name="avatar" class="form-control dropify"
                                                               data-default-file="@if($user->avatar1!="" || $user->avatar !=null ) {{asset('images/user/'.$user->avatar) }} @endif"
                                                               data-height="100" placeholder="">
                                                        @if($errors->has('avatar'))
                                                            <small class="invalid-text">
                                                                {{$errors->first('avatar')}}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>رمز عبور جدید </label>
                                                    <input type="password" class="form-control" placeholder=""
                                                           value="" name="password">
                                                    @if($errors->has('password'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('password')}}</small>
                                                    @endif
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

                                <div class="tab-pane fade {{session()->get('crud')=='section_store' ? " show active" :"" }}" id="chalenges" role="tabpanel"
                                     aria-labelledby="chalenges-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">چالش های شما</h4>
                                            <p class="card-subtitle">در اینجا چالش هایی که ادمین سامانه، یا سایر کاربران
                                                ایجاد کرده اند را، بر اسا دسته های مورد علاقه خود مشاهده کنید.</p>
                                            <div class="table-responsive">
                                                <table class="sort-table table table_shortcode">
                                                    @if(count($sections) > 0 || count($userSections) > 0)
                                                        <thead>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>چالش</th>
                                                            <th>دسته</th>
                                                            <th>مهلت</th>
                                                            <th>وضعیت</th>
                                                            <th>متعلق</th>
                                                            <th>سوال</th>
                                                            <th style="width: 200px">عملیات</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tbody>
                                                    @forelse($sections as $key=>$section)
                                                        <tr>
                                                            <th>{{$key++}}</th>
                                                            <td>{{$section->title}}</td>
                                                            <td>{{$section->category->title}}</td>
                                                            <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                            <td>
                                                                @include('layouts.components.status')
                                                            </td>
                                                            <td>سایر</td>
                                                            <td>{{$section->questions_count." عدد"}}</td>
                                                            <td style="width: 200px"><a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$section->slug)}}">مشاهده</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، چالش اصلی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse
                                                    @forelse($userSections as $key=>$section)
                                                        <tr>
                                                            <th>{{$key++}}</th>
                                                            <td>{{$section->title}}</td>
                                                            <td>{{$section->category->title}}</td>
                                                            <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                            <td>         @include('layouts.components.status')</td>
                                                            <td>{{$section->user->username == auth()->user()->username ? "شما"  : $section->user->username}}</td>
                                                            <td>{{$section->questions_count." عدد"}}</td>
                                                            <td style="width: 200px">
                                                                @if($section->user->username == auth()->user()->username)
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-primary"
                                                                       onclick="editSection({{$section->id}})">ویرایش</a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-success"
                                                                       onclick="getQuestions({{$section->id}})">سوالات</a>
                                                                @endif
                                                                <a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$section->slug)}}">مشاهده</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، چالش کاربر موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade {{session()->get('for')=='section' ? "show active" :"" }}"
                                     id="add_chalenges" role="tabpanel"
                                     aria-labelledby="add_chalenges-tab">
                                    <form action="{{route('user.challenge.store')}}" class="form-horizontal clearfix"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">نام چالش :
                                                <span
                                                    class="text-danger mr-1">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title" value="{{{old('title')}}}"
                                                       class="form-control"
                                                       placeholder="">
                                                @if($errors->has('title') && session()->get('for')=='section')
                                                    <small class="invalid-text">
                                                        {{$errors->first('title')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">دسته
                                                چالش: </label>
                                            <div class="col-3">
                                                <select class="select2 form-control custom-select" style="width: 100%;"
                                                        name="category_id">
                                                    <option></option>
                                                    @forelse($categories as $cat)

                                                        @if($cat->type == 0)
                                                            <option value="{{$cat->id}}"
                                                                    @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                                        @endif
                                                    @empty
                                                    @endforelse

                                                </select>
                                                @if($errors->has('category_id' && session()->get('for')=='section'))
                                                    <small
                                                        class="invalid-text">{{$errors->first('category_id')}}</small>
                                                @endif
                                            </div>

                                            <label class="col-sm-3 text-right control-label col-form-label">تاریخ
                                                اتمام: </label>
                                            <div class="col-3">
                                                <input type="text" name="expire_date"
                                                       class="form-control text-center datepicker-day"
                                                       value="{{old('expire_date')}}" placeholder="">
                                                @if($errors->has('expire_date'))
                                                    <small class="invalid-text">
                                                        {{$errors->first('expire_date')}}
                                                    </small>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">توضیحات چالش
                                                : </label>
                                            <div class="col-12">
                                                <textarea class="tinymce-editor" name="description"></textarea>
                                                @if($errors->has('description') && session()->get('for')=='section')
                                                    <small class="invalid-text">
                                                        {{$errors->first('description')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label
                                                class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                            <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{old('excerpt')}}</textarea>
                                                @if($errors->has('excerpt') && session()->get('for')=='section')
                                                    <small class="invalid-text">
                                                        {{$errors->first('excerpt')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group m-b-0">
                                            <button type="submit"
                                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                                ثبت
                                                چالش جدید
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{session()->get('for')=='thread' ? "show active" :"" }}"
                                     id="add_threads" role="tabpanel"
                                     aria-labelledby="add_threads-tab">
                                    <form action="{{route('user.challenge.store')}}" class="form-horizontal clearfix"
                                          method="post"
                                          enctype="multipart/form-data">
                                        @csrf
                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">عنوان سوال :
                                                <span
                                                    class="text-danger mr-1">*</span></label>
                                            <div class="col-sm-9">
                                                <input type="text" name="title" value="{{{old('title')}}}"
                                                       class="form-control"
                                                       placeholder="">
                                                @if($errors->has('title') && session()->get('for')=='thread')
                                                    <small class="invalid-text">
                                                        {{$errors->first('title')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">دسته
                                                سوال: </label>
                                            <div class="col-9">
                                                <select class="select2 form-control custom-select" style="width: 100%;"
                                                        name="category_id">
                                                    <option></option>

                                                    @forelse($categories as $cat)

                                                        @if($cat->type == 1)
                                                            <option value="{{$cat->id}}"
                                                                    @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                                        @endif
                                                    @empty
                                                    @endforelse
                                                </select>
                                                @if($errors->has('category_id' && session()->get('for')=='thread'))
                                                    <small
                                                        class="invalid-text">{{$errors->first('category_id')}}</small>
                                                @endif
                                            </div>


                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">توضیحات سوال
                                                : </label>
                                            <div class="col-12">
                                                <textarea class="tinymce-editor" name="description"></textarea>
                                                @if($errors->has('description') && session()->get('for')=='thread')
                                                    <small class="invalid-text">
                                                        {{$errors->first('description')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label
                                                class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                            <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{old('excerpt')}}</textarea>
                                                @if($errors->has('excerpt') && session()->get('for')=='thread')
                                                    <small class="invalid-text">
                                                        {{$errors->first('excerpt')}}
                                                    </small>
                                                @endif
                                            </div>
                                        </div>
                                        <input type="hidden" name="thread" value="on">
                                        <div class="form-group m-b-0">
                                            <button type="submit"
                                                    class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                                ثبت
                                                سوال جدید
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade {{session()->get('crud')=='thread_store' ? " show active" :"" }}" id="threads" role="tabpanel"
                                     aria-labelledby="threads-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">سوال های شما</h4>
                                            <p class="card-subtitle">در اینجا سوال هایی که پرسیده اید را مشاهده می کنید.
                                            <div class="table-responsive">
                                                <table class="sort-table table table_shortcode">
                                                    @if(count($sections) > 0 || count($userSections) > 0)
                                                        <thead>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>سوال</th>
                                                            <th>دسته</th>
                                                            <th>وضعیت</th>
                                                            <th>متعلق</th>
                                                            <th>عملیات</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tbody>
                                                    @forelse($threads as $key=>$item)
                                                        <tr>
                                                            <th>{{$key+1}}</th>
                                                            <td>{{$item->title}}</td>
                                                            <td>{{$item->category->title}}</td>
                                                            <td>     {{Verta::instance($item->expire_date)->format('Y/m/d')}}</td>
                                                            <td>
                                                                @include('layouts.components.status')
                                                            </td>
                                                            <td>
                                                                @if($item->user->username == auth()->user()->username)
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-primary"
                                                                       onclick="editSection({{$item->id}})">ویرایش</a>
                                                                @endif
                                                                <a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$item->slug)}}">مشاهده</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، چالش اصلی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="scores" role="tabpanel" aria-labelledby="scores-tab">
                                    <div class="table-responsive">
                                        <table class="sort-table table table_shortcode">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>امتیاز</th>
                                                <th>نوع</th>
                                                <th>برای</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($user->totalScore as $key=>$score)
                                                <tr>
                                                    <th>{{$key+1}}</th>
                                                    <td>{{$score->score}}</td>
                                                    <td><span
                                                            class="badge badge-primary">{{$score->type == 1 ? 'مثبت' : 'منفی'}}</span>
                                                    </td>
                                                    <td>{{$score->is_for ?? "love !"}}</td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، امتیازی موجود نیست.</div>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                    <div class="table-responsive">
                                        <table class="sort-table table table_shortcode">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>فعالیت</th>
                                                <th>نوع</th>
                                                <th>لینک</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($activities as $key=>$activity)
                                                <tr>
                                                    <th>{{$key+1}}</th>
                                                    <td>{{$activity->subject}}</td>
                                                    <td>{{$activity->model_type}}</td>
                                                    <td><a href="{{route($activity->model_type,$activity->model_id)}}">مشاهده</a></td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، فعالیتی موجود نیست.</div>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade {{session()->get('crud')=='ticket_store' ? " show active" :"" }}" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                                    <div class="table-responsive ">
                                        <table class="sort-table table table_shortcode mt-5">
                                            <thead>
                                            <tr>
                                                <th>شماره</th>
                                                <th>عنوان</th>
                                                <th>ایجاد</th>
                                                <th>بخش</th>
                                                <th>اهمیت</th>
                                                <th>مرحله</th>
                                                <th>وضعیت</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($tickets as $key=>$ticket)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$ticket->title}}</td>
                                                    <td>{{Verta::instance($ticket->created_at)->format('Y/n/j')}}</td>
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
                                                        @if($ticket->faqs()->where('seen','2')->get()->count()>0)
                                                            <span
                                                                class="label label-danger">{{ $ticket->faqs()->where('seen','2')->get()->count()}}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                        <span
                                            class="label label-table label-{{$ticket->status=='0' ? 'danger' : 'success'}}">
                                           {{$ticket->status=='0' ? 'بسته' : 'باز'}}
                                        </span>
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                           onclick="getTicket({{$ticket->id}})"
                                                           class="btn btn-success btn-sm "><i
                                                                class="d-inline-flex align-middle ti-eye ml-1"></i>
                                                        </a>
                                                        @if($ticket->status=='1')
                                                            <a href="#"
                                                               class="btn btn-danger btn-sm close-ticket "
                                                               data-toggle="tooltip"
                                                               title="بستن تیکت" id="{{$ticket->id}}">
                                                                <i class="d-inline-flex align-middle ti-lock"></i>
                                                            </a>
                                                            <form method="post"
                                                                  action="{{route('user.ticket.toggle',$ticket->id)}}"
                                                                  id="form-{{$ticket->id}}" class="d-none">
                                                                @csrf
                                                                @method('PATCH')
                                                            </form>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، تیکتی موجود نیست.</div>
                                            @endforelse
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade {{session()->get('for')=='ticket' ? "show active" :"" }}"
                                     id="add_ticket" role="tabpanel"
                                     aria-labelledby="add-ticket-tab">
                                    <div class="table-responsive">
                                        <form class="form-horizontal clearfix" method="post"
                                              action="{{route('user.ticket.store')}}" enctype="multipart/form-data"
                                              style="overflow: hidden">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">بخش
                                                    :<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="select2 form-control custom-select"
                                                            style="width: 100%;" required
                                                            name="section">
                                                        <option></option>
                                                        <option
                                                            value="پشتیبانی" {{collect(old('section'))->contains('پشتیبانی') ? 'selected' : ''}}>
                                                            پشتیبانی
                                                        </option>
                                                        <option
                                                            value="مدیریت" {{collect(old('section'))->contains('مدیریت') ? 'selected' : ''}}>
                                                            مدیریت
                                                        </option>
                                                        <option
                                                            value="مالی" {{collect(old('section'))->contains('مالی') ? 'selected' : ''}}>
                                                            مالی
                                                        </option>
                                                    </select>
                                                    @if($errors->has('section'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('section')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">
                                                    اهمیت:<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <select class="select2 form-control custom-select"
                                                            style="width: 100%;" required
                                                            name="priority">
                                                        <option></option>
                                                        <option
                                                            value="عادی" {{collect(old('priority'))->contains('عادی') ? 'selected' : ''}}>
                                                            عادی
                                                        </option>
                                                        <option
                                                            value="مهم" {{collect(old('priority'))->contains('مهم') ? 'selected' : ''}}>
                                                            مهم
                                                        </option>
                                                        <option
                                                            value="خیلی مهم" {{collect(old('priority'))->contains('خیلی مهم') ? 'selected' : ''}}>
                                                            خیلی مهم
                                                        </option>
                                                    </select>
                                                    @if($errors->has('priority'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('priority')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">عنوان
                                                    :<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="" name="title"
                                                           value="{{old('title')}}">
                                                    @if($errors->has('title') && session()->get('for')=='ticket')
                                                        <small class="invalid-text"
                                                               style="float:right">{{$errors->first('title')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">شرح
                                                    :<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کتید." name="description"
                                          required>{{old('description')}}</textarea>
                                                    @if($errors->has('description') && session()->get('for')=='description')
                                                        <small
                                                            class="invalid-text">{{$errors->first('description')}}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group m-b-0">
                                                <button type="submit"
                                                        class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                                    ارسال
                                                    تیکت
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.user.dashboard_modal')
@stop
@section('scripts')
    <script src="{{asset('front/user/persian-datepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('front/user/persian-datepicker/persian-datepicker.min.js')}}"></script>
    <script src="{{asset('front/user/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{asset('admin/assets//node_modules/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('front/user/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('front/user/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js')}}"></script>
    <script src="{{asset('admin/assets/node_modules/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('front/assets/tinymce/tinymce.min.js')}}"></script>
    @include('layouts.user.dashboad_scripts')
@endsection

