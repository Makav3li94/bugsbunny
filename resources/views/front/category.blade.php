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
                                    <h3 class="title"><a href="{{route('archive',$cat->title)}}">{{$cat->title}}</a>
                                    </h3>
                                    <p class="total-post">{{$cat->sections->count()}}</p>
                                </div>


                            </div>
                        @empty
                        @endforelse
                    </div>
                    <!-- /.communities-boxes -->

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

                    <div class="post-header">
                        <div class="support-info">
                            <ul class="support-total-info">
                                <li class="open-ticket"><i class="icon_info_alt"></i>عدد چالش باز</li>
                                <li class="close-ticket"><i class="icon_check"></i><a href="#">عدد چالش بسته شده</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.support-info -->

                        <div class="support-category-menus">
                            <ul class="category-menu">
                                <li>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                                id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                            مرتب سازی بر اساس
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <h3 class="title">Sort by</h3>
                                            <div class="short-by">
                                                <a class="dropdown-item active-short" href="#0">جدیدترین</a>
                                                <a class="dropdown-item" href="#0">قدیمی ترین</a>
                                                <a class="dropdown-item" href="#0">پر کامنت ترین</a>
                                                <a class="dropdown-item" href="#0">پر بازدید ترین</a>
                                                <a class="dropdown-item" href="#0">آخرین کامنت جدید</a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.support-category-menus -->
                    </div>
                    <!-- /.post-header -->
                    <div class="community-posts-wrapper bb-radius">

                    @forelse($section as $item)
                            <div class="community-post style-two docly richard bug">
                                <div class="post-content">
                                    <div class="author-avatar">
                                        @if($item->type ==1)
                                                <img src="{{asset('admin/assets/images/2.png')}}"  alt="cmm">
                                        @else
                                                <img src="{{asset('images/user/'.$item->user->avatar)}}"  alt="cmm">
                                        @endif
                                    </div>
                                    <div class="entry-content">
                                        <h3 class="post-title">
                                            <a href="{{route('section',$item->slug)}}">{{$item->title}}</a>
                                        </h3>
                                        <ul class="meta">
                                            <li>
                                                <img src="{{asset('images/user/'.$item->user->avatar)}}" width="30" alt="cmm">
                                                <a href="#">آخرین ارسال: {{$item->user->name}}</a>
                                            </li>
                                            <li>
                                                <i class="icon_calendar"></i> {{Verta::instance($item->updated_at)->format('Y-m-d')}}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="post-meta-wrapper">
                                    <ul class="post-meta-info">
                                        <li><a href="#"><i class="icon_chat_alt"></i>20</a></li>
                                        <li><a href="#"><i class="icon_star"></i>5</a></li>
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
