<section class="breadcrumb_area">

    <img class="p_absolute bl_left" src="{{asset('front/img/v.svg')}}" alt="">
    <img class="p_absolute bl_right" src="{{asset('front/img/home_one/b_leaf.svg')}}" alt="">
    <img class="p_absolute star" src="{{asset('front/img/home_one/banner_bg.png')}}" alt="">

    <img class="p_absolute one wow fadeInLeft" data-wow-delay="0.1s" src="{{asset('front/img/home_one/b_man_two.png')}}"
         alt="">




    <div class="container custom_container">
        <form action="#" class="banner_search_form banner_search_form_two">
            <div class="input-group">
                <input type="search" class="form-control" placeholder='دنبال چی میگردید ؟'>
                <div class="input-group-append">
                    <select class="custom-select" id="inlineFormCustomSelect">
                        <option selected>همه دسته ها</option>
                        @forelse($categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @empty
                        @endforelse
                    </select>
                </div>
                <button type="submit"><i class="icon_search"></i></button>
            </div>
        </form>
    </div>
</section>

<section class="page_breadcrumb">
    <div class="container">
        <div class="row">
            <div class="col-sm-7">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">خانه</a></li>
                        @if($sl == true)
                            <li class="breadcrumb-item"><a href="{{$subLink}}">{{$sub ?? ""}} </a></li>
                        @endif
                        <li class="breadcrumb-item active" aria-current="page">{{$title}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-sm-5">
                <a href="#" class="date"><i class="icon_quotations"></i>{{Verta::now()->format('%d %B، %Y')}}</a>
            </div>
        </div>
    </div>
</section>



