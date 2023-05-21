@extends('layouts.main-front',[
        'title'=>'پروفایل',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'پروفایل'
        ]
    )
@section('style')
    <link rel="stylesheet" href="{{asset('front/user/persian-datepicker/persian-datepicker.min.css')}}">
    <link rel="stylesheet" href="{{asset('front/user/select2/dist/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{ asset('front/user/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')}}">
    <style>
        .modal {
            overflow: auto !important;
        }
    </style>
@endsection
@section('content')
    <section class="doc_blog_grid_area sec_pad forum-page-content">
        <div class="container">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="{{asset('images/user/'.$user->avatar)}}" width="100" alt=""/>
                                <div class="file btn btn-lg btn-primary">
                                    @forelse($cats as $cat)
                                        @if(in_array($cat->id,json_decode($user->cats))){{$cat->title}}  @endif
                                    @empty

                                    @endforelse
                                    <input type="file" name="file"/>
                                </div>
                            </div>

                        </div>
                        <div class="col-md-6">
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
                        <div class="col-md-3">
                            <div class="profile-work text-center">
                                <p>وضعیت حساب کاربری</p>
                                <span
                                    class="badge badge-{{$user->authStatus == 0 ? 'danger' : 'success'}}">{{$user->authStatus == 0 ? 'تایید نشده' : 'فعال'}}</span>
                            </div>
                            <ul class="nav nav-tabs d-flex flex-column" id="myTab" role="tablist">
                                <li class="nav-item ">
                                    <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile"
                                       role="tab"
                                       aria-controls="home" aria-selected="true">ویرایش اطلاعات</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="chalenges-tab" data-toggle="tab" href="#chalenges"
                                       role="tab"
                                       aria-controls="chalenges" aria-selected="false">چالش ها</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="add_chalenges-tab" data-toggle="tab" href="#add_chalenges"
                                       role="tab"
                                       aria-controls="add_chalenges" aria-selected="false">افزودن چالش</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="scores-tab" data-toggle="tab" href="#scores" role="tab"
                                       aria-controls="scores" aria-selected="false">امتیازات</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                       aria-controls="activity" aria-selected="false">فعالیت ها</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="ticket-tab" data-toggle="tab" href="#ticket" role="tab"
                                       aria-controls="ticket" aria-selected="false">تیکت ها</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="add-ticket-tab" data-toggle="tab" href="#add_ticket"
                                       role="tab"
                                       aria-controls="add_ticket" aria-selected="false">تیکت جدید</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="profile" role="tabpanel"
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
                                                        <small class="invalid-text">{{$errors->first('name')}}</small>
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
                                                        <small class="invalid-text">{{$errors->first('email')}}</small>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>موبایل <span class="text-danger mr-1">*</span></label>
                                                    <input dir="ltr" type="text" class="form-control" placeholder=""
                                                           value="{{$user->mobile}}" name="mobile">
                                                    @if($errors->has('mobile'))
                                                        <small class="invalid-text">{{$errors->first('mobile')}}</small>
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
                                                        <small class="invalid-text">{{$errors->first('role')}}</small>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>تصویر:</label>
                                                    <div>
                                                        <input type="file" name="avatar" class="form-control"
                                                               placeholder="">
                                                        @if($errors->has('avatar'))
                                                            <div class="alert alert-danger">
                                                                {{$errors->first('avatar')}}
                                                            </div>
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
                                <div class="tab-pane fade" id="chalenges" role="tabpanel"
                                     aria-labelledby="chalenges-tab">
                                    <div class="table-responsive">
                                        <table class="table basic_table_info table-hover">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نام چالش</th>
                                                <th>دسته</th>
                                                <th>مهلت</th>
                                                <th>وضعیت</th>
                                                <th>متعلق</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($sections as $key=>$section)
                                                <tr>
                                                    <th>{{$key++}}</th>
                                                    <td>{{$section->title}}</td>
                                                    <td>{{$section->category->title}}</td>
                                                    <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                    <td>{{$section->status == 1  ? 'غیرفعال' :'فعال'}}</td>
                                                    <td>سایر</td>
                                                    <td><a href="{{route('section',$section->slug)}}">مشاهده</a></td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، چالشی موجود نیست.</div>
                                            @endforelse
                                            @forelse($userSections as $key=>$section)
                                                <tr>
                                                    <th>{{$key++}}</th>
                                                    <td>{{$section->title}}</td>
                                                    <td>{{$section->category->title}}</td>
                                                    <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                    <td>{{$section->status == 1  ? 'غیرفعال' :'فعال'}}</td>
                                                    <td>شما</td>
                                                    <td>
                                                        <a href="javascript:void(0)"
                                                           onclick="getQuestions({{$section->id}})">سوالات</a>
                                                        <a href="{{route('section',$section->slug)}}">مشاهده</a></td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، چالشی موجود نیست.</div>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="add_chalenges" role="tabpanel"
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
                                                @if($errors->has('title'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('title')}}
                                                    </div>
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
                                                        <option value="{{$cat->id}}"
                                                                @if(collect(old('category_id'))->contains($cat->id)) selected @endif>{{$cat->title}}</option>
                                                    @empty

                                                    @endforelse

                                                </select>
                                                @if($errors->has('category_id'))
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
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('expire_date')}}
                                                    </div>
                                                @endif

                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <label class="col-sm-3 text-right control-label col-form-label">توضیحات چالش
                                                : </label>
                                            <div class="col-12">
                                <textarea name="description" id="editor1" rows="10"
                                          cols="80">{{old('description')}}</textarea>
                                                @if($errors->has('description'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('description')}}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="row form-group">
                                            <label
                                                class="col-sm-3 text-right control-label col-form-label">چکیده: </label>
                                            <div class="col-12">
                                <textarea name="excerpt" class="form-control" rows="1"
                                          cols="1">{{old('excerpt')}}</textarea>
                                                @if($errors->has('excerpt'))
                                                    <div class="alert alert-danger">
                                                        {{$errors->first('excerpt')}}
                                                    </div>
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
                                <div class="tab-pane fade" id="scores" role="tabpanel" aria-labelledby="scores-tab">
                                    <div class="table-responsive">
                                        <table class="table basic_table_info table-hover">
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
                                                    <th>{{$key++}}</th>
                                                    <td>{{$score->score}}</td>
                                                    <td>{{$score->type}}</td>
                                                    <td>for</td>
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
                                        <table class="table basic_table_info table-hover">
                                            <thead>
                                            <tr>
                                                <th>ردیف</th>
                                                <th>نوع</th>
                                                <th>لینک</th>
                                                <th>وضعیت</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($user->totalScore as $key=>$score)
                                                <tr>
                                                    <th>{{$key++}}</th>
                                                    <td>{{$score->score}}</td>
                                                    <td>{{$score->type}}</td>
                                                    <td>for</td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، فعالیتی موجود نیست.</div>
                                            @endforelse

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="ticket" role="tabpanel" aria-labelledby="ticket-tab">
                                    <div class="table-responsive">
                                        <table class="table basic_table_info table-hover">
                                            <thead>

                                            <tr>
                                                <th>شماره</th>
                                                <th>عنوان</th>
                                                <th>تاریخ ایجاد</th>
                                                <th>بخش مربوطه</th>
                                                <th>اهمیت</th>
                                                <th>وضعیت</th>
                                                <th>وضعیت تیکت</th>
                                                <th>عملیات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @forelse($tickets as $key=>$ticket)
                                                <tr>
                                                    <td>{{$key+1}}</td>
                                                    <td>{{$ticket->title}}</td>
                                                    <td>{{Verta::instance($ticket->created_at)->format('Y/n/j')}}</td>
                                                    <td>{{Verta::instance($ticket->updated_at)->format('Y/n/j')}}</td>
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
                                                    <td style="width: 120px;">
                                                        <a href="javascript:void(0)"
                                                           onclick="getTicket({{$ticket->id}})"
                                                           class="btn btn-success btn-sm"><i
                                                                class="d-inline-flex align-middle ti-eye ml-1"></i>مشاهده
                                                        </a>
                                                        @if($ticket->status=='1')
                                                            <a href="#"
                                                               class="btn btn-danger btn-sm close-ticket"
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
                                            <a href="" class="btn btn-success">تیکت جدید</a>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="add_ticket" role="tabpanel"
                                     aria-labelledby="add-ticket-tab">
                                    <div class="table-responsive">
                                        <form class="form-horizontal clearfix" method="post"
                                              action="{{route('user.ticket.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">بخش
                                                    مربوطه:<span
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
                                                <label class="col-sm-3 text-right control-label col-form-label">درجه
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
                                                    درخواست:<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" placeholder="" name="title"
                                                           value="{{old('title')}}">
                                                    @if($errors->has('title'))
                                                        <small class="invalid-text">{{$errors->first('title')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">شرح
                                                    درخواست:<span
                                                        class="text-danger mr-1">*</span></label>
                                                <div class="col-sm-9">
                                <textarea type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کتید." name="description"
                                          required>{{old('description')}}</textarea>
                                                    @if($errors->has('description'))
                                                        <small
                                                            class="invalid-text">{{$errors->first('description')}}</small>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 text-right control-label col-form-label">پیوست
                                                    فایل:</label>
                                                <div class="col-sm-9">
                                                    <input type="file" class="form-control" name="file">
                                                    <small class="text-info"> فقط فایل با فرمت zip و rar و pdf و doc و
                                                        docx و jpg و png و حداکثر حجم
                                                        5000
                                                        کیلوبایت مجاز است.</small>
                                                    @if($errors->has('file'))
                                                        <p>
                                                            <small
                                                                class="invalid-text">{{$errors->first('file')}}</small>
                                                        </p>
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
    {{--    Tickets--}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseTicketEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sort-table-1"
                                   class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                                   width="100%">
                                <thead class="bg-success text-white">
                                <tr>
                                    <th class="text-center">تیکت</th>
                                    <th class="text-center">تاریخ ثبت</th>
                                    <th class="text-center">بخش</th>
                                    <th class="text-center">اهمیت</th>
                                    <th class="text-center">وضعیت پاسخ</th>
                                    <th class="text-center">وضعیت تیکت</th>
                                </tr>
                                </thead>
                                <tbody id="TicketBody">

                                </tbody>
                            </table>
                            <div id="chats" style="display:none;">

                            </div>
                            <div id="showForm" style="display: none">
                                <div class="form-group text-center">
                                    <button type="button"
                                            class="btn btn-outline-success btn-rounded waves-effect waves-light"
                                            data-toggle="collapse" href="#collapseticket"><i
                                            class="ti-target align-middle ml-1"></i>ارسال سوال
                                    </button>
                                </div>
                                <form
                                    class="form-horizontal clearfix collapse {{$errors->has('question') || $errors->has('file') ? 'in' : ''}}"
                                    id="collapseticket" method="post"
                                    action="" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">سوال جدید:<span
                                                class="text-danger mr-1">*</span></label>
                                        <div class="col-sm-9">
                                <textarea name="question" type="text" class="form-control" rows="5"
                                          placeholder="فارسی تایپ کنید."
                                          required>{{old('question')}}</textarea>
                                            @if($errors->has('question'))
                                                <small class="invalid-text">{{$errors->first('question')}}</small>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-3 text-right control-label col-form-label">پیوست فایل
                                            جدید:</label>
                                        <div class="col-sm-9">
                                            <input name="file" type="file" class="form-control">
                                            <small class="text-info"> فقط فایل با فرمت zip و rar و pdf و doc و docx و
                                                jpg و png و حداکثر حجم
                                                5000
                                                کیلوبایت مجاز است.
                                            </small>
                                            @if($errors->has('file'))
                                                <p>
                                                    <small class="invalid-text">{{$errors->first('file')}}</small>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group m-b-0">
                                        <button type="submit"
                                                class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left">
                                            ارسال
                                            سوال
                                        </button>
                                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">
                                            بستن
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

    {{--    editQuestions--}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseQuestionEdit">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <form class="form-horizontal clearfix" action="" id="collapseQuestionForm" method="post">
                    @csrf
                    @method('PATCH')
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">سوال : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" value="{{old('question')}}"
                                               placeholder="" name="question">
                                        @if($errors->has('question'))
                                            <small class="invalid-text">{{$errors->first('question')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات سوال
                                        : </label>
                                    <div class="col-12">
                                <textarea name="explanation" id="editor3" rows="2"
                                          cols="2">{{old('explanation')}}</textarea>
                                        @if($errors->has('explanation'))
                                            <small class="invalid-text">{{$errors->first('explanation')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">واحد : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="{{old('unit')}}" placeholder=""
                                               name="unit">
                                        @if($errors->has('unit'))
                                            <small class="invalid-text">{{$errors->first('unit')}}</small>
                                        @endif
                                    </div>
                                    <label class="col-sm-3 text-right control-label col-form-label">وضعیت : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" id="questin_is_active" name="is_active"
                                               class="form-control" data-on="فعال"
                                               data-off="معلق" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success">
                                        @if($errors->has('is_active'))
                                            <small class="invalid-text">{{$errors->first('is_active')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <hr>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ اول : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="answer0" placeholder="" required
                                               value="{{old('answer.0')}}" name="answer[]">


                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{0}}]" class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" id="is_active_answer0"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.1'))) checked @endif />

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ دوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="answer1" placeholder="" required
                                               value="{{old('answer.1')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{1}}]" id="is_active_answer1"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.2'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ سوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required id="answer2"
                                               value="{{old('answer.2')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{2}}]" id="is_active_answer2"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.3'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ چهارم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required id="answer3"
                                               value="{{old('answer.3')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{3}}]" class="form-control"
                                               id="is_active_answer3"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg" data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.4'))) checked @endif />
                                    </div>
                                    @if($errors->has('answer'))
                                        <small class="invalid-text">{{$errors->first('answer')}}</small>
                                    @endif
                                    @if($errors->has('is_active_answer'))
                                        <small class="invalid-text">{{$errors->first('is_active_answer')}}</small>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">بستن</button>
                        <button type="submit" class="btn btn-success waves-effect waves-light" id="submitCollapseCat"
                                data-id="">ثبت ویرایش
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    {{--Questions--}}
    <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
         aria-hidden="true" style="display: none;" id="collapseQuestionIndex">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="table-responsive px-1">
                    <table id="sort-table-1"
                           class="mt-4 display nowrap table table-sm table-striped table-bordered table-hover text-center v-middle"
                           width="100%">
                        <thead class="bg-success text-white">
                        <tr>
                            <th class="text-center">سوال</th>
                            <th class="text-center">نمره</th>
                            <th class="text-center">وضعیت</th>
                            <th class="text-center" style="width: 120px;">عملیات</th>
                        </tr>
                        </thead>
                        <tbody id="questionIndexBody">

                        </tbody>
                    </table>
                    <div class="form-group text-center mt-3">
                        <button type="button"
                                class="btn btn-success btn-rounded waves-effect waves-light"
                                data-toggle="collapse" href="#collapseQuestion">افزودن
                            سوال جدید
                        </button>
                    </div>

                    <form class="form-horizontal clearfix collapse"
                          id="collapseQuestion" action="{{route('user.question.store')}}"
                          method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-8">
                                <div class="row form-group">
                                    <input type="hidden" name="section_id" value="" id="section_id_input">
                                    <label class="col-sm-3 text-right control-label col-form-label">سوال
                                        : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control"
                                               value="{{old('question')}}"
                                               placeholder="" name="question">
                                        @if($errors->has('question'))
                                            <small
                                                class="invalid-text">{{$errors->first('question')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">توضیحات
                                        سوال
                                        : </label>
                                    <div class="col-12">
                                <textarea name="explanation" id="editor2" rows="2"
                                          cols="2">{{old('explanation')}}</textarea>
                                        @if($errors->has('explanation'))
                                            <small
                                                class="invalid-text">{{$errors->first('explanation')}}</small>
                                        @endif
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">نمره
                                        : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" value="{{old('unit')}}"
                                               placeholder=""
                                               name="unit">
                                        @if($errors->has('unit'))
                                            <small
                                                class="invalid-text">{{$errors->first('unit')}}</small>
                                        @endif
                                    </div>
                                    <label class="col-sm-3 text-right control-label col-form-label">وضعیت
                                        : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-3">
                                        <input type="checkbox" name="is_active" class="form-control"
                                               data-on="فعال"
                                               data-off="معلق" style="width: 100%" checked
                                               data-toggle="toggle" data-size="bg"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active'))) checked @endif />
                                        @if($errors->has('is_active'))
                                            <small
                                                class="invalid-text">{{$errors->first('is_active')}}</small>
                                        @endif
                                    </div>

                                </div>
                                <hr>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                        اول : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.0')}}" name="answer[]">


                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{0}}]"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.1'))) checked @endif />

                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                        دوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.1')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{1}}]"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.2'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                        سوم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.2')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{2}}]"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.3'))) checked @endif />
                                    </div>
                                </div>
                                <div class="row form-group">
                                    <label class="col-sm-3 text-right control-label col-form-label">پاسخ
                                        چهارم : <span
                                            class="text-danger mr-1">*</span></label>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" placeholder="" required
                                               value="{{old('answer.3')}}" name="answer[]">

                                    </div>
                                    <div class="col-sm-2">
                                        <input type="checkbox" name="is_active_answer[{{3}}]"
                                               class="form-control"
                                               data-on="درست"
                                               data-off="غلط" style="width: 100%"
                                               data-toggle="toggle" data-size="bg"
                                               data-onstyle="success"
                                               data-style="ios"
                                               @if((old('is_active_answer.4'))) checked @endif />
                                    </div>
                                    @if($errors->has('answer'))
                                        <small class="invalid-text">{{$errors->first('answer')}}</small>
                                    @endif
                                    @if($errors->has('is_active_answer'))
                                        <small
                                            class="invalid-text">{{$errors->first('is_active_answer')}}</small>
                                    @endif
                                </div>
                                <div class="form-group m-b-0">
                                    <button type="submit"
                                            class="btn btn-success btn-rounded waves-effect waves-light m-t-10 float-left"
                                            id="submitQuestion">ثبت
                                        سوال جدید
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@stop
@section('scripts')
    <script src="{{asset('front/user/persian-datepicker/persian-date.min.js')}}"></script>
    <script src="{{asset('front/user/persian-datepicker/persian-datepicker.min.js')}}"></script>
    <script src="{{asset('front/user/select2/dist/js/select2.full.min.js')}}"></script>
    <script src="{{ asset('front/user/ckeditor/ckeditor.js')}}"></script>
    <script src="{{ asset('front/user/bootstrap4-toggle-master/js/bootstrap4-toggle.min.js')}}"></script>

    <script>
        // ==============================================================
        // Date Picker
        // ==============================================================
        $(".datepicker-year").pDatepicker({
            "format": "YYYY/MM/DD",
            "viewMode": "year",
            "initialValue": false,
            "autoClose": true,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "observer": true,
            "responsive": true
        });
        $(".datepicker-day").pDatepicker({
            "format": "YYYY/MM/DD",
            "viewMode": "day",
            "initialValue": false,
            "autoClose": true,
            "position": "auto",
            "onlyTimePicker": false,
            "onlySelectOnDate": true,
            "calendarType": "persian",
            "observer": true,
            "responsive": true,
            "minDate": new Date(),
        });
        $(".custom-select").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: -1,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".custom-select-2").select2({
            placeholder: "انتخاب کنید",
            minimumResultsForSearch: 3,
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });
        $(".select2-multiple").select2({
            placeholder: "انتخاب کنید",
            language: {
                "noResults": function () {
                    return "نتیجه ای وجود نداشت.";
                }
            }
        });

        CKEDITOR.replace('editor1', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });
        CKEDITOR.replace('editor2', {

            contentsLangDirection: 'rtl',
            // language: 'fa',
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

        });

        function getQuestions(section_id) {
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                var id = section_id
                $.ajax({
                    'url': "{{route('user.question.index')}}",
                    'type': 'get',
                    'dataType': 'json',
                    data: {
                        id: id,
                    },
                    beforeSend: function () {
                        $('.preloader').fadeIn();
                    },
                    complete: function () {
                        $('.preloader').fadeOut();
                    },
                    success: function (response) {
                        var html

                        $('#collapseQuestionIndex').modal('show');
                        $.each(response.questions, function (key, question) {
                            html += '<tr>\n' +
                                '  <td>' + question['question'] + '</td>\n' +
                                '  <td>' + question.unit + '</td>\n' +
                                '  <td>' + question.is_active + '</td>\n' +
                                '  <td style="width: 120px;">\n' +
                                '  <button class="btn btn-success btn-sm edit-question" onclick="getQuestion(' + question.section_id + ')" id="' + question.id + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                                '  <button class="btn btn-danger btn-sm remove-note" id="' + question.id + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                                '  </td>\n' +
                                '   </tr>';

                        });
                        $('#section_id_input').val(id)
                        $('#questionIndexBody').html(html);

                    }

                });
            })
        }

        function getQuestion(id) {
            $('#collapseQuestionIndex').modal('hide');
            $('#collapseQuestionEdit').modal('show');
            $.ajax({
                'url': '/dashboard/question/' + id + '/edit',
                'type': 'get',
                'dataType': 'json',
                data: {id: id},
                success: function (response) {
                    if (!$.isEmptyObject(response.question)) {
                        $('#collapseQuestionForm input[name=question]').val(response.question[0].question);
                        $('#collapseQuestionForm textarea[name=explanation]').val(response.question[0].explanation);
                        $('#collapseQuestionForm input[name=unit]').val(response.question[0].unit);
                        if (response.question[0].is_active == '1') {
                            $('#questin_is_active').prop('checked', true).trigger('click');
                        }
                        CKEDITOR.replace('editor3', {
                            contentsLangDirection: 'rtl',
                            // language: 'fa',
                            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

                        });
                        var data = response.question[0].answers;
                        $.each(data, function (key) {
                            $('#collapseQuestionForm #answer' + key + '').val(data[key].answer);
                            if (data[key].is_checked == '1') {
                                $('#collapseQuestionForm #is_active_answer' + key + '').prop('checked', true).trigger('click');
                            }
                        });
                        $('#collapseQuestionForm').attr('action', '/dashboard/question/' + id,);
                    }
                }
            });
        }

        function getTicket(id) {

            $.ajax({
                'url': '/dashboard/ticket/' + id + '/edit',
                'type': 'get',
                'dataType': 'json',
                data: {
                    id: id,
                },
                beforeSend: function () {
                    $('.preloader').fadeIn();
                },
                complete: function () {
                    $('.preloader').fadeOut();
                },
                success: function (response) {
                    var html
                    var chats
                    var ticket = response.ticket;
                    var answer
                    var status
                    $('#collapseTicketEdit').modal('show');
                    if (ticket.answer == '0') {
                        answer = '<span class="label label-info">پیام کاربر</span>'
                    } else if (ticket.answer == '1') {
                        answer = '<span class="label label-info">در حال رسیدگی</span>'
                    } else if (ticket.answer == '2') {
                        answer = '<span class="label label-info">پیام مدیر</span>'
                    }
                    if (ticket.status == '0') {
                        status = '<span class="label label-info">بسته</span>'
                    } else {
                        status = '<span class="label label-warning">باز</span>'
                    }

                    html += '<tr>\n' +
                        '  <td>' + ticket.title + '</td>\n' +
                        '  <td>' + ticket.date + '</td>\n' +
                        '  <td>' + ticket.section + '</td>\n' +
                        '  <td>' + ticket.priority + '</td>\n' +
                        '  <td>' + status + '</td>\n' +
                        '  <td>' + answer + '</td>\n' +
                        '   </tr>';
                    $('#chats').html('');
                    $.each(ticket.faqs, function (key, faq) {
                        var text,name,user,link,pic
                        if (faq.question != null) {
                             text = faq.question
                             name = ticket.user_id
                             user = 'کاربر'
                            pic = '{{asset('images/user/'.$user->avatar)}}'
                            if(faq.user_file != null){
                                 link = '<div class="alert alert-success alert-rounded font-12 mt-2 mb-0 p-1">'+
                                 '<i class="fa fa-check-circle fa-lg align-middle text-success"></i>'+
                                     '<a href="">دانلود فایل ضمیمه '+user+'</a></div>'
                            }else {
                                link = ''
                            }
                            chats = '<ul class="list-unstyled p-0"><li class="media mb-3 mt-2 p-3" style="border:1px dotted #000">\n' +
                                '<img class="d-none d-sm-block ml-3" src="'+pic+'" width="60">\n'+
                                '<div class="media-body">\n'+
                                ' <h5 class="mt-0 mb-2 text-right"><strong>'+name+'</strong>\n'+
                                ' <span dir="ltr" class="float-left text-success">'+faq.created_at+'</span>\n'+
                                ' </h5>\n'+
                                ' <p class="mb-0 font-12 text-justify">'+text+'</p>\n'+
                                +link+
                                '</div></li>\n';
                        }
                        if (faq.reply != null) {
                             text = faq.reply
                             name = 'مدیریت'
                             user = 'مدیر'
                            pic = 'http://127.0.0.1:8000/admin/assets/images/2.png'
                            if(faq.admin_file != null){
                                link = '<div class="alert alert-success alert-rounded font-12 mt-2 mb-0 p-1">'+
                                    '<i class="fa fa-check-circle fa-lg align-middle text-success"></i>'+
                                    '<a href="">دانلود فایل ضمیمه '+user+'</a></div>'
                            }else {
                                link = ''
                            }
                            chats += '<ul class="list-unstyled p-0"><li class="media mb-3 mt-2 p-3" style="border:1px dotted #000">\n' +
                                '<img class="d-none d-sm-block ml-3" src="'+pic+'" width="60">\n'+
                                '<div class="media-body">\n'+
                                ' <h5 class="mt-0 mb-2 text-right"><strong>'+name+'</strong>\n'+
                                ' <span dir="ltr" class="float-left text-success">'+faq.created_at+'</span>\n'+
                                ' </h5>\n'+
                                ' <p class="mb-0 font-12 text-justify">'+text+'</p>\n'+
                                +link+
                                '</div></li>\n';
                        }

                        $('#chats').append(chats);
                        $('#collapseticket').attr('action', '/dashboard/faq/' + faq.id);

                    });
                    // $('#section_id_input').val(id)
                    $('#TicketBody').html(html);
                    $('#chats').css('display', 'block');
                    if (ticket.status == '1') {
                        $('#showForm').css('display', 'block');
                    }
                }

            });
        }
    </script>
@endsection

