@extends('layouts.main-front',[
        'title'=>'ایزباگ',
        'sl'=> false,
        'sub'=>'',
        'subLink'=>'',
        'page'=>'ایزباگ'
        ]
    )
@section('content')
    <section class="doc_blog_grid_area sec_pad forum-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="communities-boxes">
                        @forelse($categories as $cat)
                            <div class="docly-com-box">
                                <div class="icon-container">
                                    <img src="{{asset('front/img/home_support/rc1.png')}}" alt="communinity-box">
                                </div>

                                <div class="docly-com-box-content">
                                    <h3 class="title"><a href="#">{{$cat->title}}</a></h3>
                                    <p class="total-post">453 Posts</p>
                                </div>


                            </div>
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
                                    از بقیه اعضا انجمن کمک بگیر !
                                </p>
                            </div>
                        </div>
                        <!-- /.action-content -->

                        <div class="action-button-container">
                            <a href="#" class="action_btn btn-ans">چالش خودتو بساز</a>
                        </div>
                        <!-- /.action-button-container -->
                    </div>
                    <!-- /.answer-action -->

                    {{--                    Best users in last week--}}
                    <div class="post-header forums-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>بهترین های هفته گذشته </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="forum-titles">
                                <li class="forum-topic-count">نام</li>
                                <li class="forum-reply-count">چالش</li>
                                <li class="forum-freshness">آامتیاز</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->

                    <div class="community-posts-wrapper bb-radius">

                        <!-- Forum Item -->
                        <div class="community-post style-two forum-item bug">
                            <div class="col-md-6 post-content">
                                <div class="author-avatar forum-icon">
                                    <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                </div>
                                <div class="entry-content">
                                    <h3 class="post-title">
                                        <a href="forum-topics.html">عنوان</a>
                                    </h3>
                                    <p>چکیده</p>
                                </div>
                            </div>
                            <div class="col-md-6 post-meta-wrapper">
                                <ul class="forum-titles">
                                    <li class="forum-topic-count">1</li>
                                    <li class="forum-reply-count">1</li>
                                    <li class="forum-freshness">
                                        <div class="freshness-box">
                                            <div class="freshness-top">
                                                <div class="freshness-link">
                                                    <a href="#" title="Reply To: Main Forum Rules &amp; Policies">2
                                                        تاریخ</a>
                                                </div>
                                            </div>
                                            <div class="freshness-btm">
                                                <a href="#" title="View Eh Jewel's profile" class="bbp-author-link">
                                                    <div class="freshness-name">
                                                        <a href="#" title="View Eh Jewel's profile"
                                                           class="bbp-author-link">
                                                            <span class="bbp-author-name">Eh Jewel</span>
                                                        </a>
                                                    </div>
                                                    <span class="bbp-author-avatar">
                                                            <img alt="Eh Jewel"
                                                                 src="{{asset('front/img/home_support/cp5.jpg')}}"
                                                                 class="avatar photo">
                                                        </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.forum-item  -->


                    </div>
                    {{--                  END  Best users in last week--}}

                    {{--                    important chalanges in last week--}}
                    <div class="post-header forums-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>چالش های اصلی </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="forum-titles">
                                <li class="forum-reply-count">دسته</li>
                                <li class="forum-freshness">تاریخ اتمام</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    @forelse($mainSection as $item)
                        <div class="community-posts-wrapper bb-radius">

                            <!-- Forum Item -->
                            <div class="community-post style-two forum-item bug">
                                <div class="col-md-6 post-content">
                                    <div class="author-avatar forum-icon">
                                        <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <p>{{$item->excerpt}}</p>
                                    </div>
                                </div>
                                <div class="col-md-6 post-meta-wrapper">
                                    <ul class="forum-titles">
                                        <li class="forum-topic-count">{{$item->category->title}}</li>
                                        <li class="forum-freshness">
                                            <div class="freshness-box">
                                                <div class="freshness-top">
                                                    <div class="freshness-link">
                                                        <a href="#" title="Reply To: Main Forum Rules &amp; Policies">
                                                            {{Verta::instance($item->expire_date)->format('Y-m-d')}}
                                                        </a>
                                                    </div>
                                                </div>

                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.forum-item  -->


                        </div>
                    @empty
                    @endforelse
                    <div class="post-header forums-header">
                        <div class="col-md-6 col-sm-6 support-info">
                            <span>آخرین چالش ها </span>
                        </div>
                        <!-- /.support-info -->
                        <div class="col-md-6 col-sm-6 support-category-menus">
                            <ul class="forum-titles">
                                <li class="forum-topic-count">شرکت کنندگان</li>
                                <li class="forum-reply-count">تعداد پست ها</li>
                                <li class="forum-freshness">آخرین پست</li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->

                    <div class="community-posts-wrapper bb-radius">

                        <!-- Forum Item -->
                        <div class="community-post style-two forum-item bug">
                            <div class="col-md-6 post-content">
                                <div class="author-avatar forum-icon">
                                    <img src="{{asset('front/img/home_support/rc1.png')}}" alt="community post">
                                </div>
                                <div class="entry-content">
                                    <h3 class="post-title">
                                        <a href="forum-topics.html">عنوان</a>
                                    </h3>
                                    <p>چکیده</p>
                                </div>
                            </div>
                            <div class="col-md-6 post-meta-wrapper">
                                <ul class="forum-titles">
                                    <li class="forum-topic-count">1</li>
                                    <li class="forum-reply-count">1</li>
                                    <li class="forum-freshness">
                                        <div class="freshness-box">
                                            <div class="freshness-top">
                                                <div class="freshness-link">
                                                    <a href="#" title="Reply To: Main Forum Rules &amp; Policies">2
                                                        تاریخ</a>
                                                </div>
                                            </div>
                                            <div class="freshness-btm">
                                                <a href="#" title="View Eh Jewel's profile" class="bbp-author-link">
                                                    <div class="freshness-name">
                                                        <a href="#" title="View Eh Jewel's profile"
                                                           class="bbp-author-link">
                                                            <span class="bbp-author-name">Eh Jewel</span>
                                                        </a>
                                                    </div>
                                                    <span class="bbp-author-avatar">
                                                            <img alt="Eh Jewel"
                                                                 src="{{asset('front/img/home_support/cp5.jpg')}}"
                                                                 class="avatar photo">
                                                        </span>
                                                </a>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- /.forum-item  -->


                    </div>
                    <!-- /.community-posts-wrapper -->

                </div>
                <!-- /.col-lg-8 -->

                <div class="col-lg-4">
                    <div class="forum_sidebar">

                        <div class="widget ticket_widget">
                            <h4 class="c_head">بهترین های کلی</h4>

                            <ul class="list-unstyled ticket_categories">
                                <li>
                                    <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">
                                    <a href="#">name</a>
                                    <span class="count">10</span>
                                </li>

                            </ul>
                        </div>
                        <div class="widget ticket_widget">
                            <h4 class="c_head">پربازدید ترین ها</h4>

                            <ul class="list-unstyled ticket_categories">
                                <li>
                                    <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">
                                    <a href="#">name</a>
                                    <span class="count">10</span>
                                </li>

                            </ul>
                        </div>
                        <div class="widget ticket_widget">
                            <h4 class="c_head">محبوب ترین ها</h4>

                            <ul class="list-unstyled ticket_categories">
                                <li>
                                    <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">
                                    <a href="#">name</a>
                                    <span class="count">10</span>
                                </li>

                            </ul>
                        </div>
                        <div class="widget ticket_widget">
                            <h4 class="c_head">بروزترین ها</h4>

                            <ul class="list-unstyled ticket_categories">
                                <li>
                                    <img src="{{asset('front/img/home_support/cmm5.png')}}" alt="category">
                                    <a href="#">name</a>
                                    <span class="count">10</span>
                                </li>

                            </ul>
                        </div>
                        <div class="widget tag_widget">
                            <h4 class="c_head">دسته ها</h4>
                            <ul class="list-unstyled w_tag_list style-light">
                                @forelse($categories as $cat)
                                    <li><a href="{{$cat->id}}">{{$cat->title}}</a></li>
                                @empty
                                @endforelse
                            </ul>
                        </div>

                    </div>
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
