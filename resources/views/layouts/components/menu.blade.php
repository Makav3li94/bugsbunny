<div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav menu ml-auto">
        @forelse($frontMenuHeader as $menu)
            <li class="nav-item "><a href="{{route('page',$menu->link)}}" class="nav-link " role="button"
                                     aria-expanded="false">{{$menu->title}}</a></li>
        @empty
        @endforelse
    </ul>
    @if(auth()->check())
        <a class="nav_btn" href="{{route('user.dashboard')}}">پنل کاربری</a>
        <li class="dropdown  nav-item">
            <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-bell" style="color: #115db2"></i>
                <span class="badge badge-pill badge-info badge-up badge-glow notification-badge">
                                {{auth()->user()->unreadNotifications->count()}}
                            </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                <li class="dropdown-menu-header">
                    <h3 class="dropdown-header m-0 text-center"><span class="grey darken-2">اعلانات         <span
                                class="notification-tag badge badge-danger  m-0">{{auth()->user()->unreadNotifications->count()." جدید"}}</span></span>
                    </h3>


                <li class="scrollable-container media-list w-100 ps">
                    @forelse(auth()->user()->unreadNotifications()->take(6)->get() as $notification)
                        <a href="javascript:void(0)">
                            <div class="media">
                                <div class="media-body text-right p-3">
                                    <h4 class="media-heading" style="font-size: 13px">

                                        {{$notification->data['type']}}

                                    </h4>
                                    <p class="notification-text font-small-3 text-muted mb-0"
                                       style="font-size: 10px;">
                                        @if(strpos(url()->current(),'/admin/dashboard')==true)
                                            {{--                                    @if($notification->data['status'] == 1)--}}
                                            {{--                                        <span class="badge badge-success">تایید کردید.</span>--}}
                                            {{--                                    @else--}}
                                            {{--                                        <span class="badge badge-info">تایید کنید.</span>--}}
                                            {{--                                    @endif--}}
                                        @else
                                            <span class="badge badge-success">{{$notification->data['status']}}</span>
                                        @endif
                                    </p>
                                    <small style="font-size: 10px">
                                        <time class="media-meta text-muted"
                                              datetime="2015-06-11T18:29:20+08:00">
                                            {{verta($notification->created_at)->formatDifference()}}...
                                        </time>
                                    </small>
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-center"> بدون اعلان :|</p>
                    @endforelse
                </li>
                <li class="dropdown-menu-footer">

                    @if(strpos(url()->current(),'/admin/dashboard')==true)
                        <a class="dropdown-item text-muted text-center"
                           href="{{route('admin.todos.index')}}">دیدن همه</a>
                    @else
                        <a class="dropdown-item text-muted text-center" href="/markAsRead">اعلانات را خواندم
                        </a>
                    @endif
                </li>
            </ul>
        </li>
    @else
        <a class="nav_btn" href="{{route('register')}}">ثبت نام</a>
        <a class="nav_btn mr-1" href="{{route('login')}}">ورود</a>
    @endif

</div>
