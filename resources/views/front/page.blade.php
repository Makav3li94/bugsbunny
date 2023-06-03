@extends('layouts.main-front',[
        'title'=>'ایزباگ | '.$page->title,
        'sl'=> false,
        'sub'=>\Illuminate\Support\Str::limit($page->description,100),
        'subLink'=>'',
        'page'=>'ایزباگ | '.$page->title,
        ]
    )
@section('content')
    <section class="breadcrumb_area_two">
        <div class="container">
            <div class="breadcrumb_content">
                <h2 class="text-center">{{$page->title}}</h2>
            </div>
        </div>
    </section>

    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_single_info">
                        <div class="blog_single_item">
                            <a href="#" class="blog_single_img">
                                <img src="{{
                                $page->img_cover ?
                                url('/images/upload/blog/'.$page->img_cover)
                                :
                                ' https://via.placeholder.com/100x100'
                                }}" class="img-fluid rounded-md shadow" alt="">
                            {!! $page->description !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
