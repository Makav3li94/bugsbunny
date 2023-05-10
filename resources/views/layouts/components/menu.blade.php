<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav menu ml-auto">
        <li class="nav-item active"><a href="{{route('home')}}" class="nav-link " role="button" aria-expanded="false">خانه</a></li>
        <li class="nav-item "><a href="{{route('forum')}}" class="nav-link " role="button" aria-expanded="false">انجمن</a></li>
        <li class="nav-item "><a href="{{route('page','about-us')}}" class="nav-link " role="button" aria-expanded="false">درباره ما</a></li>
        <li class="nav-item "><a href="{{route('home')}}" class="nav-link " role="button" aria-expanded="false">چرا ایزباگ</a></li>
        <li class="nav-item "><a href="{{route('home')}}" class="nav-link " role="button" aria-expanded="false">تماس با ما</a></li>
    </ul>
    @if(auth()->check())
        <a class="nav_btn" href="{{route('user.dashboard')}}">پنل کاربری</a>
    @else
        <a class="nav_btn" href="{{route('register')}}">ثبت نام</a>
        <a class="nav_btn" href="{{route('login')}}">ورود</a>
    @endif

</div>
