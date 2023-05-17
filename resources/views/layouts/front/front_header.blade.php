@if(request()->route()->getName() == "home")
    <div id="preloader">
        <div id="ctn-preloader" class="ctn-preloader">
            <div class="round_spinner">
                <div class="spinner"></div>
                <div class="text">
                    <img src="{{asset('front/img/favicon.png')}}" width="30px" alt="">
                    <h4 class="mt-2"><span>ایز</span>باگ</h4>
                </div>
            </div>
            <h2 class="head">در حال آماده هسازی</h2>
            <p></p>
        </div>
    </div>
    <div class="click_capture"></div>

    <div class="body_wrapper">
        <nav class="navbar navbar-expand-lg menu_one" id="sticky">
            <div class="container">
                <a class="navbar-brand sticky_logo" href="{{route('home')}}">
                    <img
                        src="{{isset($setting) && $setting->first_logo!=null ? $setting->first_logo : asset('admin/assets/images/logo-light-text.png')}}"
                        alt="{{!isset($setting) ? '' : $setting->brand}}" width="100"/>
                </a>
                <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="menu_toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                </button>

                @include('layouts.components.menu')
            </div>
        </nav>

        <section class="doc_banner_area_one">
            <img class="dark" src="{{asset('front/img/home_one/wave_one.svg')}}" alt="">
            <img class="dark_two" src="{{asset('front/img/home_one/wave_two.svg')}}" alt="">
            <img class="p_absolute star_one" src="{{asset('front/img/home_one/star.png')}}" alt="">
            <img class="p_absolute star_two" src="{{asset('front/img/home_one/star.png')}}" alt="">
            <img class="p_absolute star_three" src="{{asset('front/img/home_one/star.png')}}" alt="">
            <img class="p_absolute one wow fadeInLeft" data-wow-delay="0.1s"
                 src="{{asset('front/img/home_one/b_man.png')}}"
                 alt="">
            <img class="p_absolute two wow fadeInRight" data-wow-delay="0.2s"
                 src="{{asset('front/img/home_one/b_man_two.png')}}" alt="">
            <img class="p_absolute three wow fadeInUp" data-wow-delay="0.3s"
                 src="{{asset('front/img/home_one/flower.png')}}"
                 alt="">
            <img class="p_absolute four wow fadeInRight" data-wow-delay="0.4s"
                 src="{{asset('front/img/home_one/girl_img.png')}}" alt="">
            <img class="p_absolute five wow fadeIn" data-wow-delay="0.5s" src="{{asset('front/img/home_one/file.png')}}"
                 alt="">
            <img class="p_absolute bl_left" src="{{asset('front/img/v.svg')}}" alt="">
            <img class="p_absolute bl_right" src="{{asset('front/img/home_one/b_leaf.svg')}}" alt="">
            <div class="container">
                <div class="doc_banner_text">
                    <h2 class="wow fadeInUp" data-wow-delay="0.3s">{{$frontHeros->title}}</h2>
                    <p class="wow fadeInUp" data-wow-delay="0.5s">
                        {{$frontHeros->sub}}
                    </p>
                    <form action="#" class="banner_search_form">
                        <input type="search" class="form-control" placeholder='{{$frontHeros->search_placeholder}}'>
                        <button type="submit"><i class="icon_search"></i></button>
                    </form>
                </div>
            </div>
        </section>
        @else
            <nav class="navbar navbar-expand-lg menu_one" id="sticky">
                <div class="container">
                    <a class="navbar-brand sticky_logo" href="{{route('home')}}">
                        <img
                            src="{{isset($setting) && $setting->first_logo!=null ? $setting->first_logo : asset('admin/assets/images/logo-light-text.png')}}"
                            alt="{{!isset($setting) ? '' : $setting->brand}}"/>
                    </a>
                    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                    <span class="menu_toggle">
                        <span class="hamburger">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
                        <span class="hamburger-cross">
                            <span></span>
                            <span></span>
                        </span>
                    </span>
                    </button>

                    @include('layouts.components.menu')
                </div>
            </nav>

    @include('layouts.front.bread',['title'=>$title,'sub'=>$sub,'sl'=>$sl,'subLink' => $subLink,'page'=>$page])

@endif
