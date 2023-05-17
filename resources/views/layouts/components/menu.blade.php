<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav menu ml-auto">
        @forelse($frontMenuHeader as $menu)
            <li class="nav-item "><a href="{{route('page',$menu->link)}}" class="nav-link " role="button" aria-expanded="false">{{$menu->title}}</a></li>
        @empty
        @endforelse
    </ul>
    @if(auth()->check())
        <a class="nav_btn" href="{{route('user.dashboard')}}">پنل کاربری</a>
    @else
        <a class="nav_btn" href="{{route('register')}}">ثبت نام</a>
        <a class="nav_btn mr-1" href="{{route('login')}}">ورود</a>
    @endif

</div>
