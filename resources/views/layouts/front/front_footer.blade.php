<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12 mb-0 mb-md-4 pb-0 pb-md-2">
                <a href="#" class="logo-footer">
                    <img src="{{asset('front/images/logo-light.png')}}" height="24" alt="">
                </a>
                <p class="mt-4" style="font-size: 13px;text-align: justify">
                    “پلتفرم دریک"، گردش مالی خریداران و تامین کنندگان را در شبکه تعاملات، به نحو احسن بهبود میدهد و نیاز
                    به نقدینگی را به حداقل می رساند. از طرف دیگر، انحراف منابع از محل کارکرد آن به شدت کاهش پیدا میکند.
                    در این مدل، به مرور زمان توان فنی و مالی تامین کنندگان و مشتریانشان، توسعه یافته و دغدغه های مالی،
                    فنی و حقوقی کسب و کارها، به حداقل میرسد. معاملات همه نقاط شبکه، با یکدیگر از سطح امنیت بالایی
                    برخوردار خواهد بود. امنیت بالا یعنی تعهدات همه بازیگران شبکه با یکدیگر تضمین خواهد شد؛ هم تعهدات
                    مالی، هم تعهدات فنی و هم سایر تعهدات طی معامله.علی بحرینی
                </p>

            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">شرکت </h5>

                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="{{route('blog','platform-advantages')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i>مزیت پلتفرم</a></li>
                    <li><a href="{{route('blog','about-us')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i> درباره ما </a></li>
                    <li><a href="{{route('blog','contact-us')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i> تماس با ما </a></li>
                    <li><a href="{{route('blog','faq')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>
                            سوالات متداول </a></li>
                    <li><a href="{{route('blog','terms-and-conditions')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i> قوانین و مقررات </a></li>
                    <li><a href="{{route('blog','contract-and-invoice')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i> ثبت قرارداد یا فاکتور </a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">لینک های مفید </h5>
                <ul class="list-unstyled footer-list mt-4">
                    <li><a href="{{route('blog','daryek-platform')}}" class="text-foot"><i
                                class="uil uil-angle-left-b me-1"></i>پلتفرم دریک</a></li>
                    <li><a href="{{route('shop')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>بازار</a>
                    </li>

                    <li><a href="{{route('businesses')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>لیست
                            کسب و کار</a></li>

                    <li><a href="{{route('blog','Challenges-and-solutions')}}" class="text-foot" disabled=""><i
                                class="uil uil-angle-left-b me-1"></i>چالش و راهکار</a></li>
                    @if(auth()->check())
                        <li><a href="{{route('login')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>پنل
                                کاربری</a></li>
                    @else
                        <li><a href="{{route('login')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>ورود
                                / ثبت نام</a></li>
                    @endif

                    <li><a href="{{route('blog','guide')}}" class="text-foot"><i class="uil uil-angle-left-b me-1"></i>راهنمای
                            سایت</a></li>
                </ul>
            </div><!--end col-->

            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <h5 class="text-light footer-head">خبرنامه </h5>
                <p class="mt-4">آخرین اخبار و اطلاعیه ها</p>
                <form>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="foot-subscribe mb-3">
                                <label class="form-label">ایمیل خود را بنویسید <span
                                        class="text-danger">*</span></label>
                                <div class="form-icon position-relative">
                                    <i data-feather="mail" class="fea icon-sm icons"></i>
                                    <input dir="ltr" type="email" name="email" id="emailsubscribe"
                                           class="form-control ps-5 rounded" placeholder="ایمیل شما: " required>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="d-grid">
                                <input type="submit" id="submitsubscribe" name="send" class="btn btn-soft-primary"
                                       value="خبرنامه">
                            </div>
                        </div>
                    </div>
                </form>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<footer class="footer footer-bar">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <div class="text-sm-start">
                    <p class="text-muted font-10">
                        © حقوق مادی و معنوی این سامانه به دریک تعلق دارد و هرگونه کپی برداری محتوا ممنوع می باشد.
                    </p>
                    <p class="mb-0">©
                        <script>document.write(new Date().getFullYear())</script>
                        طراحی شده توسط <a href="https://parham-akbari.ir/" rel="nofollow" target="_blank"
                                          class="text-reset">پرهام اکبری</a>.
                    </p>
                </div>
            </div><!--end col-->

            <div class="col-sm-4 mt-4 mt-sm-0 pt-2 pt-sm-0">
                <ul class="list-unstyled social-icon foot-social-icon text-sm-end mb-0">
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="facebook"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i
                                data-feather="instagram" class="fea icon-sm fea-social"></i></a></li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="twitter"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                    <li class="list-inline-item"><a href="javascript:void(0)" class="rounded"><i data-feather="linkedin"
                                                                                                 class="fea icon-sm fea-social"></i></a>
                    </li>
                </ul>
            </div><!--end col-->
        </div><!--end row-->
    </div><!--end container-->
</footer><!--end footer-->
<!-- Footer End -->

