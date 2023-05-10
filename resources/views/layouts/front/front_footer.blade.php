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

                        <h4 class="c_head">خبرنامه</h4>
                        <form action="#" class="footer_subscribe_form">
                            <input type="email" placeholder="Email" class="form-control">
                            <button type="submit" class="s_btn">ارسال</button>
                        </form>
                        <ul class="list-unstyled f_social_icon">
                            <li><a href="#"><i class="social_facebook"></i></a></li>
                            <li><a href="#"><i class="social_twitter"></i></a></li>
                            <li><a href="#"><i class="social_vimeo"></i></a></li>
                            <li><a href="#"><i class="social_linkedin"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget link_widget pl_30">
                        <h3 class="f_title">لینک</h3>
                        <ul class="list-unstyled link_list">
                            <li><a href="#">انجمن</a></li>
                            <li><a href="#">درباره ما</a></li>
                            <li><a href="#">تماس با ما</a></li>
                            <li><a href="#">چرا ایزباگ</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-sm-6">
                    <div class="f_widget link_widget">
                        <h3 class="f_title">لینک</h3>
                        <ul class="list-unstyled link_list">
                            <li><a href="#">پنل کاربری</a></li>
                            <li><a href="#">ثبت نام</a></li>
                            <li><a href="#">ورود</a></li>
                            <li><a href="#">پروفایل</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6">
                    <div class="f_widget link_widget pl_70">
                        <h3 class="f_title">لینک</h3>
                        <ul class="list-unstyled link_list">
                            <li><a href="#">قوانین انجمن</a></li>
                            <li><a href="#">سوالات متداول</a></li>
                            <li><a href="#">مقررات</a></li>
                            <li><a href="#">مرام نامه</a></li>
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
