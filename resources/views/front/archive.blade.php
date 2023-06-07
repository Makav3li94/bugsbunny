@extends('layouts.main-front',[
        'title'=>' آرشیو'.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>'آرشیو '.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'subLink'=>'',
        'page'=>' آرشیو'.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('content')
    <section class="doc_blog_grid_area sec_pad chaleshkade-page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="alert alert-info text-center">جستجو برای {{request()->s_val??""}} ...</div>
                    @forelse($sections as $section)
                    <div class="blog_top_post blog_classic_item">
                        <div class="b_top_post_content">
                            <div class="post_tag">
                                <a href="javascript:void(0)">{{verta($section->created_at)->formatDifference()}}</a>
                                <a class="orange" href="{{route('category',$section->category->title)}}">{{$section->category->title}}</a>
                            </div>
                            <a href="{{route('section',$section->slug)}}">
                                <h3>{{$section->title}}</h3>
                            </a>
                            <p>{!! $section->excerpt !!}</p>
                            <div class="d-flex justify-content-between p_bottom">
                                <a href="{{route('section',$section->slug)}}" class="learn_btn">مشاهده<i class="arrow_left"></i></a>
                                <div class="media post_author">
                                    <div class="round_img">
                                        @if($section->type ==1)
                                            <img src="{{asset('admin/assets/images/2.png')}}" width="50" alt="cmm">
                                        @else
                                            <img
                                                src="@if($section->user->avatar!="" || $section->user->avatar !=null ) {{asset('images/user/'.$section->user->avatar) }}@else {{asset('front/img/home_one/1.png')}} @endif"
                                                width="50"
                                                alt="cmm">
                                        @endif
                                    </div>
                                    <div class="media-body author_text">
                                        <a href="{{$section->type == 1 ? 'javascript:void(0)' : route('user',$section->user->username)}}">
                                            <h4>{{$section->type == 1 ? 'Admin' : $section->user->name}}</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="alert alert-success text-center">نتیجه ای یافت نشد.</div>

                    @endforelse
                    @if($sections->count() > 0)
                        {{ $sections->withQueryString()->links() }}
                        @endif
                </div>

                <div class="col-lg-4">
                    @include('layouts.front.widgets')
                </div>
                <!-- /.col-lg-4 -->
            </div>
        </div>
    </section>

@endsection
