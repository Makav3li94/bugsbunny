@extends('layouts.main-front',[
        'title'=>$page->title.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        'sl'=> false,
        'sub'=>!empty($page->excerpt) ?$page->excerpt :\Illuminate\Support\Str::limit(trim(preg_replace('/\s\s+/', ' ', $page->description)),150),
        'subLink'=>'',
        'page'=>$page->title.' - '.(!isset($setting) ? 'ایزباگ' : $setting->brand),
        ]
    )
@section('content')
    <section class="breadcrumb_area_two">
        <div class="container text-center">
            <div class="">
                <h1 class="text-center">{{$page->title}}</h1>
            </div>
        </div>
    </section>

    <section class="blog_area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="blog_single_info">
                        <div class="blog_single_item">
                            <a href="#" class="blog_single_img text-center">
                                <img src="{{
                                $page->img_cover ?
                                url('/images/upload/blog/'.$page->img_cover)
                                :
                                ' https://via.placeholder.com/100x100'
                                }}" class="img-fluid rounded-md shadow" alt="">
                            </a>
                            {!! $page->description !!}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
