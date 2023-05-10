@if(request()->route()->getName() == "home")
    <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a class="logo" href="{{route('home')}}">
                    <img src="{{asset('front/images/logo-dark.png')}}" class="l-dark" height="24" alt="">
                    <img src="{{asset('front/images/logo-light.png')}}" class="l-light" height="24" alt="">
                    {{--                    <img src="{{asset('front/images/logo-light.png')}}" class="l-light" height="24" alt="">--}}
                </a>
            </div>
            <div class="buy-button">
                @if(auth()->check())
                    <a href="{{route('register')}}" target="_blank">
                        <div class="btn btn-primary login-btn-primary">پنل کاربری</div>
                        <div class="btn btn-light login-btn-light">پنل کاربری</div>
                    </a>
                @else
                    <a href="{{route('login')}}" target="_blank">
                        <div class="btn btn-primary login-btn-primary">ورود</div>
                        <div class="btn btn-light login-btn-light">ورود</div>
                    </a>
                    <a href="{{route('register')}}" target="_blank">
                        <div class="btn btn-primary login-btn-primary">ثبت نام</div>
                        <div class="btn btn-light login-btn-light">ثبت نام</div>
                    </a>
                @endif

            </div><!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu nav-light">
                    <li><a href="{{route('home')}}" class="sub-menu-item">صفحه اصلی </a></li>
                    <li><a href="{{route('shop')}}" class="sub-menu-item">بازار</a></li>
                    <li><a href="{{route('businesses')}}" class="sub-menu-item">کسب و کار ها</a></li>
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">ىرباره </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('blog','about-us')}}" class="sub-menu-item">درباره ما</a></li>
                            <li><a href="{{route('blog','Challenges-and-solutions')}}" class="sub-menu-item">چالش‌ها و راهکارها</a></li>
                            <li><a href="{{route('blog','platform-daryek')}}" class="sub-menu-item">پلتفرم دریک</a></li>
                        </ul>
                    </li>

                    <li><a href="{{route('blog','faq')}}" class="sub-menu-item">سوالات متداول</a></li>
                    <li><a href="{{route('blog','contact-us')}}" class="sub-menu-item">تماس با ما</a></li>
                </ul><!--end navigation menu-->
            </div><!--end navigation-->
        </div><!--end container-->
    </header><!--end header-->
    <!-- Navbar End -->
    <!-- Hero Start -->
    <section class="bg-half-260 bg-primary d-table w-100"
             style="background: url('{{asset('front/images/software/bg.png')}}') center center;">
        <div class="bg-overlay"></div>
        <div class="container">
            <div class="row align-items-center position-relative mt-5" style="z-index: 1;">
                <div class="col-lg-6 col-md-12">
                    <div class="title-heading mt-4 text-center text-lg-start">
                        <h1 class="heading mb-3 title-dark text-white">دریک - خلق آینده با نوآوری در شبکه‌های
                            کسب‌و‌کاری</h1>
                        <p class="para-desc text-white-50">راهکارهای هوشمند در یکپارچه‌سازی گردش اقلام، وجوه، اعتبارات،
                            اطلاعات</p>
                        <div class="mt-4">
                            <a href="{{route('register')}}" class="btn btn-light"><i class="uil uil-registered"></i>
                                عضویت در سامانه</a>
                        </div>
                    </div>
                </div><!--end col-->

                <div class="col-lg-6 col-md-12 mt-4 pt-2">
                    <div class="position-relative">
                        <div class="software_hero">
                            <img src="{{asset('front/images/software/software.png')}}" class="img-fluid d-block" alt="">
                        </div>
                    </div>
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
    </section><!--end section-->
    <div class="position-relative">
        <div class="shape overflow-hidden text-white">
            <svg viewBox="0 0 2880 250" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M720 125L2160 0H2880V250H0V125H720Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!-- Hero End -->

@else
    <!-- Navbar STart -->
    <header id="topnav" class="defaultscroll sticky">
        <div class="container">
            <!-- Logo container-->
            <div>
                <a class="logo" href="{{route('home')}}">
                    <img src="{{asset('front/images/logo-dark.png')}}" class="l-light" height="24" alt="">
                </a>
            </div>
            <ul class="buy-button list-inline mb-0">
                <li class="list-inline-item mb-0">
                    <div class="dropdown">
                        <button type="button" class="btn btn-link text-decoration-none dropdown-toggle p-0 pe-2"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="uil uil-search h5 text-muted"></i>
                        </button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-0"
                             style="width: 300px;">
                            <form class="company-search" autocomplete="off">
                                <input type="text" id="text" name="name" class="form-control border bg-white"
                                       placeholder="جستجو شرکت">
                                <div class="list-group">
                                </div>
                            </form>
                        </div>
                    </div>
                </li>
                <li class="list-inline-item mb-0 pe-1">

                        <a href="{{route('cart')}}" class="btn btn-icon btn-soft-primary ">
                            <i class="uil uil-shopping-cart align-middle icons"></i></a>


                </li>

                <li class="list-inline-item mb-0">
                    <div class="dropdown dropdown-primary">
                        <button type="button" class="btn btn-icon btn-soft-primary dropdown-toggle"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="uil uil-user align-middle icons"></i></button>
                        <div class="dropdown-menu dd-menu dropdown-menu-end bg-white shadow rounded border-0 mt-3 py-3"
                             style="width: 200px;">
                            @if(auth()->check())
                                <a class="dropdown-item text-dark" href="{{route('register')}}"><i
                                        class="uil uil-user align-middle me-1"></i>
                                    حساب کاربری</a>
                                <a class="dropdown-item text-dark" href="#"><i
                                        class="uil uil-sign-out-alt align-middle me-1"></i> خروج </a>
                            @else
                                <a class="dropdown-item text-dark" href="{{route('login')}}"><i
                                        class="uil uil-user align-middle me-1"></i>
                                    ورود</a>
                                <a class="dropdown-item text-dark" href="{{route('register')}}"><i
                                        class="uil uil-user align-middle me-1"></i>
                                    ثبت نام</a>
                            @endif


                        </div>
                    </div>
                </li>
            </ul><!--end login button-->
            <!-- End Logo container-->
            <div class="menu-extras">
                <div class="menu-item">
                    <!-- Mobile menu toggle-->
                    <a class="navbar-toggle" id="isToggle" onclick="toggleMenu()">
                        <div class="lines">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </div>
            </div>

            <div id="navigation">
                <!-- Navigation Menu-->
                <ul class="navigation-menu">
                    <li><a href="{{route('home')}}" class="sub-menu-item">صفحه اصلی </a></li>
                                        <li><a href="{{route('shop')}}" class="sub-menu-item">بازار</a></li>
                    <li><a href="{{route('businesses')}}" class="sub-menu-item">کسب و کار ها</a></li>
                    <li class="has-submenu parent-menu-item">
                        <a href="javascript:void(0)">ىرباره </a><span class="menu-arrow"></span>
                        <ul class="submenu">
                            <li><a href="{{route('blog','about-us')}}" class="sub-menu-item">درباره ما</a></li>
                            <li><a href="{{route('blog','Challenges-and-solutions')}}" class="sub-menu-item">چالش‌ها و راهکارها</a></li>
                            <li><a href="{{route('blog','platform-daryek')}}" class="sub-menu-item">پلتفرم دریک</a></li>
                        </ul>
                    </li>
                    <li><a href="{{route('blog','faq')}}" class="sub-menu-item">سوالات متداول</a></li>
                    <li><a href="{{route('blog','contact-us')}}" class="sub-menu-item">تماس با ما</a></li>
                </ul><!--end navigation menu-->

            </div><!--end navigation-->
        </div><!--end container-->
    </header><!--end header-->
    <!-- Navbar End -->
    <!-- Hero Start -->
    @include('layouts.front.bread',['title'=>$title,'sub'=>$sub,'sl'=>$sl,'subLink' => $subLink,'page'=>$page])
    <!-- Hero End -->
    <!-- Shape Start -->
    <div class="position-relative">
        <div class="shape overflow-hidden text-white">
            <svg viewBox="0 0 2880 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 48H1437.5H2880V0H2160C1442.5 52 720 0 720 0H0V48Z" fill="currentColor"></path>
            </svg>
        </div>
    </div>
    <!--Shape End-->
@endif
