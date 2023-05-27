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
            <div class="card bb-radius">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="profile-img">
                                <img src="@if(isset($user->avatar)) {{asset('images/user/'.$user->avatar) }}@else {{asset('front/img/typography/man_01.png')}} @endif" width="100" alt=""/>
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
                                <p class="proile-rating">امتیاز کاربر : <span>{{$totalScore}}</span></p>

                            </div>

                        </div>
                        <div class="col-md-2">

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
                                    <a class="nav-link" id="chalenges-tab" data-toggle="tab" href="#chalenges"
                                       role="tab"
                                       aria-controls="chalenges" aria-selected="false">چالش ها</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="scores-tab" data-toggle="tab" href="#scores" role="tab"
                                       aria-controls="scores" aria-selected="false">امتیازات</a>
                                </li>
                                <li class="nav-item ">
                                    <a class="nav-link" id="activity-tab" data-toggle="tab" href="#activity" role="tab"
                                       aria-controls="activity" aria-selected="false">فعالیت ها</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-9">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="chalenges" role="tabpanel"
                                     aria-labelledby="chalenges-tab">
                                    <div class="table-responsive">
                                        <table class="table table_shortcode">
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
                                                    <td>         @include('layouts.components.status')</td>
                                                    <td>سایر</td>
                                                    <td><a class="btn btn-sm btn-warning" href="{{route('section',$section->slug)}}">مشاهده</a></td>
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
                                                    <td>         @include('layouts.components.status')</td>
                                                    <td>شما</td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="btn btn-sm btn-success"
                                                           onclick="getQuestions({{$section->id}})">سوالات</a>
                                                        <a class="btn btn-sm btn-warning" href="{{route('section',$section->slug)}}">مشاهده</a></td>
                                                </tr>
                                            @empty
                                                <div class="alert alert-warning">در حال حاضر، چالشی موجود نیست.</div>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="scores" role="tabpanel" aria-labelledby="scores-tab">
                                    <div class="table-responsive">
                                        <table class="table table_shortcode">
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
                                                    <td><span class="badge badge-primary">{{$score->type == 1 ? 'مثبت' : 'منفی'}}</span></td>
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
                                        <table class="table table_shortcode">
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

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop


