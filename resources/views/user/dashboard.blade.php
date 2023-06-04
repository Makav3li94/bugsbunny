@extends('layouts.main-front',[
        'title'=>'پنل کاربری '.$user->username.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'پنل کاربری'.$user->username.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('style')
    <link rel="stylesheet" href="{{asset('front/user/persian-datepicker/persian-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/user/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')}}">
    <link rel="stylesheet" href="{{asset('admin/assets/node_modules/dropify/css/dropify.min.css')}}" type="text/css"/>
    <style>
        .modal {
            overflow: auto !important;
        }
    </style>
@endsection
@section('content')
    {{--    @dd(session()->all());--}}
    <section class="doc_blog_grid_area sec_pad chaleshkade-page-content">
        <div class="container">
            <div class="card bb-radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-img">
                                <img
                                    src="@if($user->avatar!="" || $user->avatar !=null ) {{asset('images/user/'.$user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                    width="100" alt=""/>

                            </div>
                            <div class="profile-head text-center mt-2">
                                نام کاربری: {{$user->username}}
                            </div>
                            <form method="post" class="text-center mt-2" action=" {{route('logout')}}">
                                @csrf
                                <button type="submit" style="font-size: 10px" class="btn btn-sm btn-danger p-1">
                                    <i class="fa fa-power-off"></i>
                                    خروج
                                </button>
                            </form>
                        </div>
                        <div class="col-md-9">
                            <div class="funfact-boxes">
                                <div class="funfact-box text-center color-one wow fadeInRight" data-wow-delay="0.3s">
                                    <div class="fanfact-icon">
                                        <img src="{{asset('front/img/home_support/fun-fact-1.png')}}" alt="funfact">
                                    </div>
                                    <div class="counter">{{$section_count}}</div>
                                    <h3 class="title">چالش ساخته</h3>
                                </div>
                                <!-- /.funfact-box -->


                                <div class="funfact-box text-center color-two wow fadeInRight" data-wow-delay="0.5s">
                                    <div class="fanfact-icon">
                                        <img src="{{asset('front/img/home_support/fun-fact-2.png')}}" alt="funfact">
                                    </div>
                                    <div class="counter">{{$thread_count}}</div>
                                    <h3 class="title">سوال ساخته</h3>
                                </div>
                                <!-- /.funfact-box text-center -->

                                <div class="funfact-box text-center color-three wow fadeInRight" data-wow-delay="0.7s">
                                    <div class="fanfact-icon">
                                        <img src="{{asset('front/img/home_support/fun-fact-3.png')}}" alt="funfact">
                                    </div>
                                    <div class="counter">{{$reply_count}}</div>
                                    <h3 class="title">کامنت</h3>
                                </div>
                                <div class="funfact-box text-center color-four wow fadeInRight" data-wow-delay="0.9s">
                                    <div class="fanfact-icon">
                                        <img src="{{asset('front/img/home_support/fun-fact-4.png')}}" alt="funfact">
                                    </div>
                                    <div class="counter">{{$likes}}</div>
                                    <h3 class="title">لایک</h3>
                                </div>
                                <!-- /.funfact-box text-center -->

                                <div class="funfact-box text-center color-five wow fadeInRight" data-wow-delay="1.1s">
                                    <div class="fanfact-icon">
                                        <img src="{{asset('front/img/home_support/fun-fact-5.png')}}" alt="funfact">
                                    </div>
                                    <div class="counter">{{$totalScore + $likes}}</div>
                                    <h3 class="title">امتیاز کلی</h3>
                                </div>
                            </div>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="profile-work text-center">
                                دسته ها:
                                @forelse($cats as $cat)
                                    @if(in_array($cat->id,json_decode($user->cats)))
                                        <span class="badge badge-info">  {{$cat->title}}  </span>
                                    @endif
                                @empty

                                @endforelse
                                <p>وضعیت حساب کاربری</p>
                                <span
                                    class="badge badge-{{$user->authStatus == 0 ? 'secondary' : 'success'}}">{{$user->authStatus == 0 ? 'تایید نشده' : 'فعال'}}</span>
                            </div>
                            <hr>
                            <ul class="nav nav-tabs d-flex flex-column" style="border: none" id="myTab" role="tablist">
                                <li class="nav-item p-1 ">
                                    <a class="nav-link "
                                       id="default-tab" data-toggle="tab" href="#default"
                                       role="tab"
                                       aria-controls="default" aria-selected="false">داشبورد</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link "
                                       id="chalenges-tab" data-toggle="tab" href="#chalenges"
                                       role="tab"
                                       aria-controls="chalenges" aria-selected="false">چالش ها</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link "
                                       id="add_chalenges-tab" data-toggle="tab" href="#add_chalenges"
                                       role="tab"
                                       aria-controls="add_chalenges" aria-selected="false">افزودن چالش</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link  "
                                       id="add_thread-tab" data-toggle="tab" href="#add_threads"
                                       role="tab"
                                       aria-controls="add_threads" aria-selected="false">افزودن سوال</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link  "
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
                                    <a class="nav-link "
                                       id="ticket-tab" data-toggle="tab" href="#ticket" role="tab"
                                       aria-controls="ticket" aria-selected="false">تیکت ها</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link"
                                       id="add-ticket-tab" data-toggle="tab" href="#add_ticket"
                                       role="tab"
                                       aria-controls="add_ticket" aria-selected="false">تیکت جدید</a>
                                </li>
                                <li class="nav-item p-1 ">
                                    <a class="nav-link "
                                       id="profile-tab" data-toggle="tab" href="#profile"
                                       role="tab"
                                       aria-controls="home" aria-selected="true">ویرایش اطلاعات</a>
                                </li>

                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content profile-tab" id="myTabContent">

                                {{--Edit Profile--}}
                                <div class="tab-pane fade " id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">اطلاعات کاربری شما</h4>
                                            <p class="card-subtitle"> در اینجا میتونید اطلاعات خودتونو اپدیت کنید.</p>
                                            <form class="clearfix" action="{{route('user.update',$user->id)}}"
                                                  method="POST"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                @method('PATCH')
                                                <div class="row form-group">
                                                    <label class="col-sm-3">نام
                                                        <span class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder=""
                                                               value="{{$user->name}}" name="name">
                                                        @if($errors->has('name'))
                                                            <small class="invalid-text"
                                                                   style="float:right">{{$errors->first('name')}}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">نام کاربری<span
                                                            class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" placeholder=""
                                                               value="{{$user->username}}" name="username" required>
                                                        @if($errors->has('username'))
                                                            <small
                                                                class="invalid-text">{{$errors->first('username')}}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">ایمیل <span
                                                            class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input dir="ltr" type="text" class="form-control"
                                                               placeholder=""
                                                               value="{{$user->email}}" name="email">
                                                        <div class="col-sm-9">
                                                            @if($errors->has('email'))
                                                                <small class="invalid-text"
                                                                       style="float:right">{{$errors->first('email')}}</small>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">موبایل <span
                                                            class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input dir="ltr" type="text" class="form-control"
                                                               placeholder=""
                                                               value="{{$user->mobile}}" name="mobile">
                                                        @if($errors->has('mobile'))
                                                            <small class="invalid-text"
                                                                   style="float:right">{{$errors->first('mobile')}}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">تاریخ تولد</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control datepicker-year"
                                                               placeholder=""
                                                               value="{{$user->birthDate}}" name="birthDate">
                                                        @if($errors->has('birthDate'))
                                                            <small
                                                                class="invalid-text">{{$errors->first('birthDate')}}</small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">دسته مورد علاقه</label>
                                                    <div class="col-sm-9">
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
                                                <div class="row form-group">
                                                    <label class="col-sm-3">تصویر پروفایل:</label>
                                                    <div class="col-sm-9">
                                                        <input type="file" name="avatar"
                                                               class="form-control dropify"
                                                               data-default-file=""
                                                               data-height="100">
                                                        @if($errors->has('avatar'))
                                                            <small class="invalid-text">
                                                                {{$errors->first('avatar')}}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>
                                                <hr>
                                                <div class="row form-group">
                                                    <label class="col-sm-3">رمز عبور جدید </label>
                                                    <div class="col-sm-9">
                                                        <input type="password" class="form-control" placeholder=""
                                                               value="" name="password">
                                                        <span class="invalid-text">اگر نمیخواهید رمز خود را تغییر دهید، این قسمت را خالی بگذارید.</span>

                                                        @if($errors->has('password'))
                                                            <small
                                                                class="invalid-text">{{$errors->first('password')}}</small>
                                                        @endif
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
                                {{--Section List--}}
                                <div class="tab-pane fade" id="chalenges" role="tabpanel"
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
                                                            <th style="width: 120px">چالش</th>
                                                            <th>دسته</th>
                                                            <th>مهلت</th>
                                                            <th>وضعیت</th>
                                                            <th>متعلق</th>
                                                            <th style="width: 100px">عملیات</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tbody>
                                                    @php $counter = 1; @endphp
                                                    @forelse($sections as $key=>$section)
                                                        <tr>
                                                            <th>{{$counter}}</th>
                                                            <td style="width: 80px;font-size: 12px">{{\Illuminate\Support\Str::limit($section->title,30,' ...')}}</td>
                                                            <td>{{$section->category->title}}</td>
                                                            <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                            <td>
                                                                @include('layouts.components.status')
                                                            </td>
                                                            <td>سایر</td>
                                                            <td style="width: 100px"><a class="btn btn-sm btn-warning"
                                                                                        target="_blank"
                                                                                        href="{{route('section',$section->slug)}}"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                        @php $counter ++; @endphp
                                                    @empty
                                                        <div class="alert alert-info">در حال حاضر، چالش اصلی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse
                                                    @forelse($userSections as $key=>$section)
                                                        <tr>
                                                            <th>{{$counter}}</th>
                                                            <td style="width: 80px;font-size: 12px">{{\Illuminate\Support\Str::limit($section->title,30,' ...')}}</td>
                                                            <td>{{$section->category->title}}</td>
                                                            <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                            <td>         @include('layouts.components.status')</td>
                                                            <td>{{$section->user->username == auth()->user()->username ? "شما"  : $section->user->username}}</td>
                                                            <td style="width: 100px">
                                                                @if($section->user->username == auth()->user()->username)
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-primary edit-section"
                                                                       id="section-{{$section->id}}"
                                                                       onclick="editSection({{$section->id}})"><i
                                                                            class="fa fa-pencil"></i></a>
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-success"
                                                                       onclick="getQuestions({{$section->id}})"><i
                                                                            class="fa fa-question-circle"></i></a>
                                                                @endif
                                                                <a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$section->slug)}}"><i
                                                                        class="fa fa-eye"></i></a>
                                                            </td>
                                                        </tr>
                                                        @php $counter ++; @endphp
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
                                <div class="tab-pane fade " id="add_chalenges" role="tabpanel"
                                     aria-labelledby="add_chalenges-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">افزودن چالش</h4>
                                            <p class="card-subtitle"> در اینجا میتونید چالش جدیدی اضافه کنید، فقط به
                                                خاطر داشته باشید چالش ها برای اینکه تایید بشین، باید براشون سوال طراحی
                                                بشه !</p>
                                            <form action="{{route('user.challenge.store')}}"
                                                  class="form-horizontal clearfix"
                                                  method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row form-group">
                                                    <label class="col-sm-3 text-right control-label col-form-label">نام
                                                        چالش :
                                                        <span
                                                            class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="title" value="{{{old('title')}}}"
                                                               class="form-control" required placeholder="">
                                                        @if($errors->has('title') && session()->get('for')=='section')
                                                            <small class="invalid-text">
                                                                {{$errors->first('title')}}
                                                            </small>
                                                        @endif
                                                    </div>
                                                </div>


                                                <div class="row form-group">
                                                    <label class="col-sm-3 text-right control-label col-form-label">دسته
                                                        چالش: <span
                                                            class="text-danger mr-1">*</span> </label>
                                                    <div class="col-3">
                                                        <select class="select2 form-control custom-select"
                                                                style="width: 100%;" required
                                                                name="category_id">
                                                            <option></option>
                                                            @forelse($categories as $cat)

                                                                @if($cat->type == 0 && in_array($cat->id,json_decode($user->cats)))
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
                                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات
                                                        چالش: <span class="text-danger mr-1">*</span></label>
                                                    <div class="col-9">
                                                    <textarea class="tinymce-editor" name="description"
                                                    >{!! old("description") !!}</textarea>
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
                                                    <div class="col-9">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{old('excerpt')}}</textarea>
                                                        @if($errors->has('excerpt') && session()->get('for')=='section')
                                                            <small class="invalid-text">
                                                                {!! $errors->first('excerpt') !!}
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
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="add_threads" role="tabpanel"
                                     aria-labelledby="add_threads-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">افزودن سوال</h4>
                                            <p class="card-subtitle">
                                                سوال یه چیز سادس، مثل تاپیک های بقیه محفل آزمون گرها
                                            </p>
                                            <form action="{{route('user.challenge.store')}}"
                                                  class="form-horizontal clearfix"
                                                  method="post"
                                                  enctype="multipart/form-data">
                                                @csrf
                                                <div class="row form-group">
                                                    <label class="col-sm-3 text-right control-label col-form-label">عنوان
                                                        سوال :
                                                        <span
                                                            class="text-danger mr-1">*</span></label>
                                                    <div class="col-sm-9">
                                                        <input type="text" name="title" value="{{{old('title')}}}"
                                                               class="form-control" required
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
                                                        <select class="select2 form-control custom-select"
                                                                style="width: 100%;" required
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
                                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات
                                                        سوال
                                                        : </label>
                                                    <div class="col-9">
                                                    <textarea class="tinymce-editor"
                                                              name="description">{!! old("description") !!}</textarea>
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
                                                    <div class="col-9">
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
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="threads" role="tabpanel" aria-labelledby="threads-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">سوال های شما</h4>
                                            <p class="card-subtitle">در اینجا سوال هایی که پرسیده اید را مشاهده می کنید.
                                            <div class="table-responsive">
                                                <table class="sort-table table table_shortcode">
                                                    @if(count($threads) > 0 )
                                                        <thead>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>سوال</th>
                                                            <th>دسته</th>
                                                            <th>وضعیت</th>
                                                            <th>متعلق</th>
                                                            <th style="width: 210px">عملیات</th>
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
                                                            <td style="width: 210px">
                                                                @if($item->user->username == auth()->user()->username)
                                                                    <a href="javascript:void(0)"
                                                                       class="btn btn-sm btn-primary edit-thread"
                                                                       id="thread-{{$item->id}}"
                                                                       onclick="editSection({{$item->id}})"><i
                                                                            class="fa fa-pencil"></i></a>
                                                                @endif
                                                                <a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$item->slug)}}"><i
                                                                        class="fa fa-eye"></i></a>
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
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">تاریخچه امتیازات</h4>
                                            <p class="card-subtitle">
                                                اینجا، امتیازهایی که گرفتید رو میبینید.توجه کنید امتیاز چالش و سوال پس
                                                از تایید ثبت می شوند.
                                            </p>
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
                                                                    class="badge badge-{{$score->type == 1 ? 'success' : 'danger'}}">{{$score->type == 1 ? 'مثبت' : 'منفی'}}</span>
                                                            </td>
                                                            <td>
                                                                @switch($score->is_for)
                                                                    @case('thread')
                                                                    ساخت سوال(تاپیک)
                                                                    @break
                                                                    @case('challenge')
                                                                    ایجاد چالش
                                                                    @break
                                                                    @case('like')
                                                                    لایک گرفتید
                                                                    @break
                                                                    @case('like')
                                                                    لایک گرفتید
                                                                    @break
                                                                    @case('unlike')
                                                                    لایک پس گرفته شد !
                                                                    @break
                                                                    @case('dislike')
                                                                    دیسلایک گرفتید
                                                                    @break
                                                                    @case('partiSection')
                                                                    شرکت در چالش
                                                                    @break
                                                                    @case('skipSection')
                                                                    عدم شرکت در چالش
                                                                    @break

                                                                    @default
                                                                    همینطوری !
                                                                @endswitch
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، امتیازی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">تاریخچه فعالیت ها</h4>
                                            <p class="card-subtitle">
                                                تمامی فعالیت های خود را اینجا می بینید.
                                            </p>
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
                                                            <td>
                                                                @switch($activity->model_type)
                                                                    @case("like")
                                                                    <span
                                                                        class="badge badge-success"> لایک/دیسلاک</span>
                                                                    @break
                                                                    @case("reply")
                                                                    <span class="badge badge-success">کامنت</span>
                                                                    @break
                                                                    @case("section")
                                                                    <span class="badge badge-success">ساخت چالش</span>
                                                                    @break
                                                                    @case("thread")
                                                                    <span class="badge badge-success">ساخت سوال</span>
                                                                    @break
                                                                    @default

                                                                @endswitch
                                                            </td>
                                                            <td>

                                                                <a href="{{$activity->sectionLink($activity->model_id)}}"
                                                                   class="btn btn-sm btn-warning"
                                                                   target="_blank"><i class="fa fa-eye"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، فعالیتی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">تاریخچه تیکت ها</h4>
                                            <p class="card-subtitle">
                                                تاریخچه تیکت هاتون با پشتیبانی ایزباگ
                                            </p>
                                            <div class="table-responsive ">
                                                @if($tickets->count() > 0)
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
                                                        <div class="alert alert-warning">در حال حاضر، تیکتی موجود
                                                            نیست.
                                                        </div>
                                                    @endforelse
                                                </table>
                                                @else
                                                    <div class="alert alert-warning">در حال حاضر، تیکتی موجود
                                                        نیست.
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade " id="add_ticket" role="tabpanel"
                                     aria-labelledby="add-ticket-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">تیکت جدید</h4>
                                            <p class="card-subtitle">
                                                مسئله ای هست ؟ سوالی دارید؟ با پشتیبانی مطرح کنید.
                                            </p>
                                            <div class="table-responsive">
                                                <form class="form-horizontal clearfix" method="post"
                                                      action="{{route('user.ticket.store')}}"
                                                      enctype="multipart/form-data"
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
                                                            <input type="text" class="form-control" placeholder=""
                                                                   name="title"
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

                                <div class="tab-pane fade" id="default" role="tabpanel" aria-labelledby="defualt-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">پنل کاربری شما</h4>
                                            <p class="card-subtitle">

                                                @if($setting!=null && $setting->wysiwyg!=null)
                                                    {!! $setting->wysiwyg !!}
                                                @endif
                                            </p>
                                            <div id="carouselExampleIndicators" class="carousel slide"
                                                 data-ride="carousel">
                                                <div class="carousel-inner" role="listbox">
                                                    @foreach($sliders as $key=>$slider)
                                                        <div class="carousel-item {{$key==0 ? 'active' : ''}}">
                                                            @if($slider->href!=null)
                                                                <a href="{{$slider->href}}" target="_blank">
                                                                    @endif
                                                                    <img class="img-responsive"
                                                                         src="{{$slider->image_link}}"
                                                                         alt=""/>
                                                                    @if($slider->href!=null)
                                                                </a>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>

                                            </div>
                                        </div>
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

