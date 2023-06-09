@extends('layouts.main-front',[
        'title'=>$setting->chalesh_name.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>\Illuminate\Support\Str::limit($setting->chalesh_description,150),
        'subLink'=>'',
        'page'=>$setting->chalesh_name.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('content')
    <section class=" doc_blog_grid_area sec_pad chaleshkade-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="communities-boxes">
                        @forelse($categories as $cat)
                            @if($cat->type == 0)
                            <div class="docly-com-box">
                                <div class="icon-container">
                                    <img src="{{asset('front/img/home_support/rc1.png')}}" alt="communinity-box">
                                </div>

                                <div class="docly-com-box-content">
                                    <h3 class="title"><a href="{{route('category',$cat->title)}}">{{$cat->title}}</a>
                                    </h3>
                                    <p class="total-post">{{$cat->activeSections->count()}}</p>
                                </div>


                            </div>
                            @endif
                        @empty
                        @endforelse
                    </div>
                    <div class="answer-action">
                        <div class="action-content">
                            <div class="image-wrap">
                                <img src="{{asset('front/img/home_support/answer.png')}}" alt="answer action">
                            </div>

                            <div class="content">
                                <h2 class="ans-title">چالشتو پیدا نکردی؟</h2>
                                <p>
                                    از بقیه اعضا محفل آزمون گرها کمک بگیر !
                                </p>
                            </div>
                        </div>
                        <!-- /.action-content -->

                        <div class="action-button-container">
                            <a href="{{auth()->check() ? route('user.dashboard') : route('register')}}" class="action_btn btn-ans">چالش خودتو بساز</a>
                        </div>
                        <!-- /.action-button-container -->
                    </div>
                    <!-- /.answer-action -->

                    {{--                    Best users in last week--}}
                    <div class="post-header chaleshkade-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>بهترین های هفته گذشته </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="chaleshkade-titles">
                                <li class="chaleshkade-reply-count">امتیاز</li>
                                <li class="chaleshkade-freshness">تاریخ ثبت نام</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->

                    <div class="community-posts-wrapper bb-radius">
                        @forelse($HighLastWeekUsersUsers as $item)


                            <div class="community-post style-two chaleshkade-item bug">
                                <div class="col-md-6 post-content">
                                    <div class="author-avatar chaleshkade-icon">
                                        <img src="@if( ($item['avatar']!="" || $item['avatar'] !=null) && $item['authStatus'] == 1 ) {{asset('images/user/'.$item['avatar']) }}@else {{asset('front/img/home_one/1.png')}} @endif" alt="{{$item['username']}}" width="30">
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('user',$item['username'])}}">{{$item['authStatus'] == 0 ? "کاربر ایزباگ" : $item['username']}}</a>
                                        </h3>
                                        <p>{{$item['authStatus'] == 0 ? "-" : $item['name']}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 post-meta-wrapper">
                                    <ul class="chaleshkade-titles">
                                        <li class="chaleshkade-topic-count">
                                            @foreach($HighLastWeekUsersScores as $score)
                                                @if($score->user_id == $item['id'])
                                                    {{$score->total." امتیاز"}}
                                                @endif

                                            @endforeach
                                        </li>
                                        <li class="chaleshkade-freshness">
                                            <div class="freshness-box">
                                                <div class="freshness-top">
                                                    <div class="freshness-link">
                                                        <a href="#" title="Reply To: Main chaleshkade Rules &amp; Policies">
                                                            {{Verta::instance($item['created_at'])->format('Y-m-d')}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        @empty

                        @endforelse
                        <!-- chaleshkade Item -->

                        <!-- /.chaleshkade-item  -->


                    </div>
                    {{--                  END  Best users in last week--}}

                    {{--                    important chalanges in last week--}}
                    <div class="post-header mt-5 chaleshkade-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>چالش های اصلی </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="chaleshkade-titles">
                                <li class="chaleshkade-reply-count">دسته</li>
                                <li class="chaleshkade-freshness">تاریخ اتمام</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    <div class="community-posts-wrapper bb-radius">

                    @forelse($mainSection as $item)

                        <!-- chaleshkade Item -->
                            <div class="community-post style-two chaleshkade-item bug">
                                <div class="col-md-6 post-content">
                                    <div class="author-avatar chaleshkade-icon">
                                        <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{!! $item->excerpt !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 post-meta-wrapper">
                                    <ul class="chaleshkade-titles">
                                        <li class="chaleshkade-topic-count">{{$item->category->title ?? ""}}</li>
                                        <li class="chaleshkade-freshness">
                                            <div class="freshness-box">
                                                <div class="freshness-top">
                                                    <div class="freshness-link">
                                                        <a href="#" title="Reply To: Main chaleshkade Rules &amp; Policies">
                                                            {{Verta::instance($item->expire_date)->format('Y-m-d')}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.chaleshkade-item  -->


                        @empty
                        @endforelse
                    </div>

                    <div class="post-header mt-5 chaleshkade-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>آخرین چالش ها </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="chaleshkade-titles">
                                <li class="chaleshkade-reply-count">دسته</li>
                                <li class="chaleshkade-freshness">تاریخ اتمام</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    <div class="community-posts-wrapper bb-radius">

                    @forelse($userSection as $item)

                        <!-- chaleshkade Item -->
                            <div class="community-post style-two chaleshkade-item bug">
                                <div class="col-md-6 post-content">
                                    <div class="author-avatar chaleshkade-icon">
                                        <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{!! $item->excerpt !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 post-meta-wrapper">
                                    <ul class="chaleshkade-titles">
                                        <li class="chaleshkade-topic-count">{{$item->category->title}}</li>
                                        <li class="chaleshkade-freshness">
                                            <div class="freshness-box">
                                                <div class="freshness-top">
                                                    <div class="freshness-link">
                                                        <a href="#" title="Reply To: Main chaleshkade Rules &amp; Policies">
                                                            {{Verta::instance($item->expire_date)->format('Y-m-d')}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.chaleshkade-item  -->


                    @empty
                    @endforelse
                    <!-- /.community-posts-wrapper -->
                    </div>


                    <div class="post-header mt-5 chaleshkade-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>آخرین سوال ها </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="chaleshkade-titles">
                                <li class="chaleshkade-reply-count">دسته</li>
                                <li class="chaleshkade-freshness">تاریخ اتمام</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    <div class="community-posts-wrapper bb-radius">

                    @forelse($threads as $item)

                        <!-- chaleshkade Item -->
                            <div class="community-post style-two chaleshkade-item bug">
                                <div class="col-md-6 post-content">
                                    <div class="author-avatar chaleshkade-icon">
                                        <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{!! $item->excerpt !!}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 post-meta-wrapper">
                                    <ul class="chaleshkade-titles">
                                        <li class="chaleshkade-topic-count">{{$item->category->title}}</li>
                                        <li class="chaleshkade-freshness">
                                            <div class="freshness-box">
                                                <div class="freshness-top">
                                                    <div class="freshness-link">
                                                        <a href="#" title="Reply To: Main chaleshkade Rules &amp; Policies">
                                                            {{Verta::instance($item->expire_date)->format('Y-m-d')}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.chaleshkade-item  -->


                    @empty
                    @endforelse
                    <!-- /.community-posts-wrapper -->
                    </div>


                    <div class="answer-action mt-5">
                        <div class="action-content">
                            <div class="image-wrap">
                                <img src="{{asset('front/img/home_support/answer.png')}}" alt="answer action">
                            </div>

                            <div class="content">
                                <h2 class="ans-title">سوالتو  پیدا نکردی؟</h2>
                                <p>
                                    از بقیه اعضا ایزباگ کمک بگیر !
                                </p>
                            </div>
                        </div>
                        <!-- /.action-content -->

                        <div class="action-button-container">
                            <a href="{{auth()->check() ? route('user.dashboard') : route('register')}}"
                               class="action_btn btn-ans">سوال خودتو بساز</a>
                        </div>
                        <!-- /.action-button-container -->
                    </div>
                    <!-- /.answer-action -->
                </div>
                <!-- /.col-lg-8 -->

                <div class="col-lg-4">
                    @include('layouts.front.widgets')
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>
    </section>

    <div class="call-to-action">
        <div class="overlay-bg"></div>
        <div class="container">
            <div class="action-content-wrapper">
                <div class="action-title-wrap title-img">
                    <img src="{{asset('front/img/home_support/chat-smile.png')}}" alt="">
                    <h2 class="action-title">هنوز عضو نشدید ؟</h2>
                </div>
                <a href="{{route('register')}}" class="action_btn">عضویت <i class="arrow_left"></i></a>
            </div>
            <!-- /.action-content-wrapper -->
        </div>
        <!-- /.container -->
    </div>
@endsection
