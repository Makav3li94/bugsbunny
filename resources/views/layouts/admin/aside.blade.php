<!-- Left Sidebar -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <li><a class="waves-effect waves-dark" href="{{route('admin.dashboard')}}" aria-expanded="false"><i
                            class="ti-dashboard"></i><span class="hide-menu">پیشخوان</span></a></li>


                @if(auth()->user()->can('main-account'))
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="ti-user"></i><span class="hide-menu">کاربران</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.user.primary.index')}}">لیست کاربران</a></li>
                            <li><a href="{{route('admin.user.primary.create')}}">افزودن کاربر</a></li>
                        </ul>
                    </li>
                @endif


                @if(auth()->user()->can('blog'))
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="ti-notepad"></i><span class="hide-menu">مدیریت صفحات</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.blog.create')}}">افزودن صفحه</a></li>
                            <li><a href="{{route('admin.blog.index')}}">لیست صفحات</a></li>
                        </ul>
                    </li>
                @endif


                @if(auth()->user()->can('support'))

                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class=" ti-support"></i><span class="hide-menu">پشتیبانی</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.ticket.index')}}">لیست تیکت ها</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('category'))

                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class=" ti-support"></i><span class="hide-menu">دسته بندی ها</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.category.index')}}">مدیریت دسته بندی ها</a></li>
                        </ul>
                    </li>
                @endif
{{--                @if(auth()->user()->can('admin'))--}}
{{--                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i--}}
{{--                                class=" fa fa-users"></i><span class="hide-menu">مدیران</span></a>--}}
{{--                        <ul aria-expanded="false" class="collapse">--}}
{{--                            <li><a href="{{route('admin.admins.index')}}">لیست مدیران</a></li>--}}
{{--                            <li><a href="{{route('admin.admins.create')}}">افزودن مدیر</a></li>--}}
{{--                            <li><a href="{{route('admin.roles.index')}}">نقش ها</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                @endif--}}
                @if(auth()->user()->can('setting'))
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="ti-settings"></i><span class="hide-menu">تنظیمات</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.profile.edit',auth()->id())}}">پروفایل</a></li>
                            <li><a href="{{route('admin.settings.edit')}}">مشخصات سایت</a></li>
                            <li><a href="{{route('admin.label.index')}}">لیبل ها</a></li>
                            <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                   aria-expanded="false"><span class="hide-menu">اسلایدرها</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{route('admin.slider.index')}}">لیست اسلایدرها</a></li>
                                    <li><a href="{{route('admin.slider.create')}}">افزودن اسلایدر</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->can('sms'))
                    <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                                class="icon-compass"></i><span class="hide-menu">پیامک</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="{{route('admin.sms.index')}}">لیست پیامک های ارسال شده</a></li>
                            <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)"
                                   aria-expanded="false"><span class="hide-menu">مدیریت خطوط</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{route('admin.com.index')}}">لیست خطوط</a></li>
                                    <li><a href="{{route('admin.com.create')}}">افزودن خط</a></li>
                                </ul>
                            </li>
                            <li><a href="{{route('admin.sms.setting.show')}}">تنظیمات پیامک</a></li>
                        </ul>
                    </li>
                @endif


            </ul>
        </nav>
    </div>
</aside>
