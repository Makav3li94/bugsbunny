@extends('layouts.main-front',[
        'title'=>($category->type == 0 ? 'چالش های' : 'سوال های') .$category->title.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>'لیست سوال های کیفیت نرم افزار و امنیت '.$category->title.' ایزباگ در این صفحه قابل مشاهده هستند. مجموعه ای از سوال ها  '.$category->title.' برای آزمونگرها آماده شده است.',
        'subLink'=>'',
        'page'=>($category->type == 0 ? 'چالش های' : 'سوال های') .' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('content')
    <section class="doc_blog_grid_area sec_pad chaleshkade-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if($section->count() == 0)
                        <div class="alert alert-info text-center">در این دسته فعلا {{$category->type == 0 ? " چالش ":" سوال "}} نداریم.</div>

                @endif
                <!-- /.communities-boxes -->

                    <div class="answer-action">
                        <div class="action-content">
                            <div class="image-wrap">
                                <img src="{{asset('front/img/home_support/answer.png')}}" alt="answer action">
                            </div>

                            <div class="content">
                                <h2 class="ans-title">{{$category->type == 0 ? " چالشتو ":" سوالتو "}} پیدا نکردی؟</h2>
                                <p>
                                    از بقیه اعضا ایزباگ کمک بگیر !
                                </p>
                            </div>
                        </div>
                        <!-- /.action-content -->

                        <div class="action-button-container">
                            <a href="{{auth()->check() ? route('user.dashboard') : route('register')}}"
                               class="action_btn btn-ans">{{$category->type == 0 ? " چالش ":" سوال "}} خودتو بساز</a>
                        </div>
                        <!-- /.action-button-container -->
                    </div>
                    <!-- /.answer-action -->

                    <div class="post-header">
                        <div class="support-info">
                            <ul class="support-total-info">
                                {{--                                <li class="open-ticket"><i class="icon_info_alt"></i>عدد چالش باز</li>--}}
                                {{--                                <li class="close-ticket"><i class="icon_check"></i><a href="#">عدد چالش بسته شده</a>--}}
                                </li>
                            </ul>
                        </div>
                        <!-- /.support-info -->

                    {{--                        <div class="support-category-menus">--}}
                    {{--                            <ul class="category-menu">--}}
                    {{--                                <li>--}}
                    {{--                                    <div class="dropdown">--}}
                    {{--                                        <button class="btn btn-secondary dropdown-toggle" type="button"--}}
                    {{--                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"--}}
                    {{--                                                aria-expanded="false">--}}
                    {{--                                            مرتب سازی بر اساس--}}
                    {{--                                        </button>--}}
                    {{--                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">--}}
                    {{--                                            <h3 class="title">Sort by</h3>--}}
                    {{--                                            <div class="short-by">--}}
                    {{--                                                <a class="dropdown-item active-short" href="#0">جدیدترین</a>--}}
                    {{--                                                <a class="dropdown-item" href="#0">قدیمی ترین</a>--}}
                    {{--                                                <a class="dropdown-item" href="#0">پر کامنت ترین</a>--}}
                    {{--                                                <a class="dropdown-item" href="#0">پر بازدید ترین</a>--}}
                    {{--                                                <a class="dropdown-item" href="#0">آخرین کامنت جدید</a>--}}
                    {{--                                            </div>--}}
                    {{--                                        </div>--}}
                    {{--                                    </div>--}}
                    {{--                                </li>--}}
                    {{--                            </ul>--}}
                    {{--                        </div>--}}
                    <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    <div class="community-posts-wrapper bb-radius">

                        @forelse($section as $item)
                            <div class="community-post style-two docly richard bug">
                                <div class="post-content">
                                    <div class="author-avatar">
                                        @if($item->type ==1)
                                            <img src="{{asset('admin/assets/images/2.png')}}" alt="cmm">
                                        @else
                                            <img
                                                src="@if($item->user->avatar!="" || $item->user->avatar !=null ) {{asset('images/user/'.$item->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                                alt="cmm">
                                        @endif
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <ul class="meta">
                                            <li>
                                                @if($item->type ==1)
                                                    <img src="{{asset('admin/assets/images/2.png')}}" width="15"
                                                         alt="cmm">
                                                @else
                                                    <img
                                                        src="@if($item->user->avatar!="" || $item->user->avatar !=null ) {{asset('images/user/'.$item->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                                        width="15" alt="cmm">
                                                @endif
                                                <a href="{{$item->type == 1 ? 'javascript:void(0)' : route('user',$item->user->username)}}">آخرین
                                                    ارسال: {{$item->type == 1 ? "Admin" :$item->user->name}}</a>
                                            </li>
                                            <li>
                                                <i class="icon_calendar"></i> {{Verta::instance($item->updated_at)->format('Y-m-d')}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="post-meta-wrapper">
                                    <ul class="post-meta-info">
                                        <li>
                                            <span>
                                                <i class="icon_chat_alt mr-2"></i>{{$item->replies->count()}}
                                            </span>
                                        </li>
                                        <li><span >
                                                <i class="icon_pencil mr-2"></i>{{$item->quizHeaders->count()}}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- /.community-post -->

                        @empty

                        @endforelse
                    </div>

                    <!-- /.community-posts-wrapper -->

                    <!-- /.pagination-wrapper -->

                </div>
                <!-- /.col-lg-8 -->

                <div class="col-lg-4">
                    @include('layouts.front.widgets')
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>
    </section>

@endsection
