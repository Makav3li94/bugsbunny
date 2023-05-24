<li class="dropdown  nav-item">
    <a class="nav-link nav-link-label" href="#" data-toggle="dropdown" aria-expanded="false">
        <i class="fa fa-bell"></i>
        <span class="badge badge-pill badge-info badge-up badge-glow notification-badge">
                                {{auth()->user()->unreadNotifications->count()}}
                            </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
        <li class="dropdown-menu-header">
            <h3 class="dropdown-header m-0"><span class="grey darken-2">اعلانات</span></h3>
            <span
                class="notification-tag badge badge-danger float-right m-0">{{auth()->user()->unreadNotifications->count()." جدید"}}</span>

        <li class="scrollable-container media-list w-100 ps">
            @forelse(auth()->user()->unreadNotifications()->take(6)->get() as $notification)
                <a href="javascript:void(0)">
                    <div class="media">
                        <div class="media-body text-right">
                            <h4 class="media-heading" style="font-size: 13px">
                                @if(strpos(url()->current(),'/admin/dashboard')==true)
                                    @switch($notification->data['type'])
                                        @case('ticket')
                                        <a href="{{route('admin.ticket.show',$notification->data['type_id'])}}"> تیکت جدید</a>
                                        @break
                                        @case('profileChange')
                                        <a href="{{route('admin.user.primary.edit',$notification->data['type_id'])}}">ویرایش پروفایل</a>
                                        @break
                                        @case('reply')
                                        <a href="{{route('admin.reply.index',$notification->data['type_id'])}}"> کامنت جدید</a>

                                        @break
                                        @case('challenge')
                                        <a href="{{route('admin.challenge.edit',$notification->data['type_id'])}}"> درخواست بررسی چالش یا سوال</a>

                                        @break
                                        @case('register')
                                        <a href="{{route('admin.user.primary.edit',$notification->data['user_id'])}}">ثبت نام جدید</a>
                                        @break
                                        @default
                                        نامشخص
                                    @endswitch
                                @else
                                    {{$notification->data['type']}}
                                @endif
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
