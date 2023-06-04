<footer class="footer_area f_bg_color">
    <img class="p_absolute leaf" src="{{asset('front/img/v.svg')}}" alt="">
    <img class="p_absolute f_man" src="{{asset('front/img/home_two/f_man.png')}}" alt="">
    <img class="p_absolute f_cloud" src="{{asset('front/img/home_two/cloud.png')}}" alt="">
    <img class="p_absolute f_email" src="{{asset('front/img/home_two/email-icon.png')}}" alt="">
    <img class="p_absolute f_email_two" src="{{asset('front/img/home_two/email-icon_two.png')}}" alt="">
    <img class="p_absolute f_man_two" src="{{asset('front/img/home_two/man.png')}}" alt="">
    <div class="footer_top">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-6">
                    <div class="f_widget subscribe_widget">
                        <a href="{{route('home')}}" class="f_logo"> <img
                                src="{{isset($setting) && $setting->first_logo!=null ? $setting->first_logo : asset('admin/assets/images/logo-light-text.png')}}"
                                alt="{{!isset($setting) ? '' : $setting->brand}}" width="100"/></a>

                            <p>{{isset($setting) ? $setting->description : ''}}</p>
                        <ul class="list-unstyled f_social_icon">
                            @forelse($frontSocail as $socail)
                                <li><a href="{{$socail->link}}" title="{{$socail->title}}"><img src="{{asset('/images/front/socail/'.$socail->icon)}}" width="20" alt=""></a></li>

                            @empty

                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget link_widget pl_30">
                        <h3 class="f_title">صغحات</h3>
                        <ul class="list-unstyled link_list">
                            @forelse($frontMenusFooter1 as $menu)
                                <li ><a href="{{route($menu->link)}}">{{$menu->title}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="f_widget link_widget">
                        <h3 class="f_title">کاربری</h3>
                        <ul class="list-unstyled link_list">
                            @forelse($frontMenusFooter2 as $menu)
                                <li ><a href="{{route($menu->link)}}">{{$menu->title}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget link_widget pl_70">
                        <h3 class="f_title">لینک مفید</h3>
                        <ul class="list-unstyled link_list">
                            @forelse($frontMenusFooter3 as $menu)
                                <li ><a href="{{route($menu->link)}}">{{$menu->title}}</a></li>
                            @empty
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
            <div class="border_bottom"></div>
        </div>
    </div>
    <div class="footer_bottom text-center">
        <div class="container">
            <p>© کلیه حقوق محفوظ است. <a href="{{route('home')}}">ایزباگ</a></p>
        </div>
    </div>
</footer>
