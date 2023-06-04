@extends('layouts.main-front',[
        'title'=>'پروفایل '.$user->username.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>'پروفایل کاربری '.$user->name,
        'subLink'=>'',
         'page'=>'پروفایل '.$user->username.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('style')
    <link rel="stylesheet" href="{{ asset('front/user/bootstrap4-toggle-master/css/bootstrap4-toggle.min.css')}}">
    <style>
        .modal {
            overflow: auto !important;
        }
    </style>
@endsection
@section('content')
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
                                    <div class="counter">{{$totalScore}}</div>
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
                                <li class="nav-item p-1 active">
                                    <a class="nav-link active"
                                       id="chalenges-tab" data-toggle="tab" href="#chalenges"
                                       role="tab"
                                       aria-controls="chalenges" aria-selected="false">چالش ها</a>
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


                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content profile-tab" id="myTabContent">

                                {{--Section List--}}
                                <div class="tab-pane fade active show"  id="chalenges" role="tabpanel"
                                     aria-labelledby="chalenges-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">چالش های {{$user->username}}</h4>
                                            <p class="card-subtitle">در اینجا چالش هایی که ادمین سامانه، یا سایر کاربران
                                                ایجاد کرده اند را، بر اساس دسته های مورد علاقه خود مشاهده کنید.</p>
                                            <div class="table-responsive">
                                                <table class="sort-table table table_shortcode">
                                                    @if(count($userSections) > 0)
                                                        <thead>
                                                        <tr>
                                                            <th>ردیف</th>
                                                            <th>چالش</th>
                                                            <th>دسته</th>
                                                            <th>مهلت</th>
                                                            <th>وضعیت</th>
                                                            <th>متعلق</th>
                                                            <th>سوال</th>
                                                            <th style="width: 210px">عملیات</th>
                                                        </tr>
                                                        </thead>
                                                    @endif
                                                    <tbody>

                                                    @forelse($userSections as $key=>$section)
                                                        <tr>
                                                            <th>{{$key+1}}</th>
                                                            <td>{{\Illuminate\Support\Str::limit($section->title,30)}}</td>
                                                            <td>{{$section->category->title}}</td>
                                                            <td>     {{Verta::instance($section->expire_date)->format('Y/m/d')}}</td>
                                                            <td>         @include('layouts.components.status')</td>
                                                            <td>{{$user->username}}</td>
                                                            <td>{{$section->questions_count." عدد"}}</td>
                                                            <td style="width: 200px">

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
                                <div class="tab-pane fade " id="threads" role="tabpanel" aria-labelledby="threads-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">سوال های {{$user->username}}</h4>
                                            <p class="card-subtitle">در اینجا سوال هایی که پرسیده اید را مشاهده می کنید.
                                            <div class="table-responsive">
                                                <table class="sort-table table table_shortcode">
                                                    @if( count($threads) > 0)
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

                                                                <a class="btn btn-sm btn-warning"
                                                                   href="{{route('section',$item->slug)}}">مشاهده</a>
                                                            </td>
                                                        </tr>
                                                    @empty
                                                        <div class="alert alert-warning">در حال حاضر، سوالی موجود
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
                                                هر غلتی تا الان کردید اینجا میبینید.
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
                                                                   target="_blank">مشاهده
                                                                    <i class="fa fa-eye"></i></a>
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

                                <div class="tab-pane fade " id="default" role="tabpanel" aria-labelledby="defualt-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title">پنل کاربری {{$user->username}}</h4>
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
    </section>

@stop


