<!-- Left Sidebar -->
<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li><a class="waves-effect waves-dark" href="{{route('user.dashboard')}}" aria-expanded="false"><i
                            class="ti-dashboard"></i><span class="hide-menu">پیشخوان</span></a></li>
                <li><a class="waves-effect waves-dark" href="{{route('home')}}" target="_blank" aria-expanded="false"><i
                            class="ti-home"></i><span class="hide-menu">وب سایت</span></a></li>
                <li><a class="waves-effect waves-dark" href="{{route('user.primary.edit',auth()->user()->id)}}"
                       aria-expanded="false"><i class="ti-user"></i><span class="hide-menu">حساب اصلی</span></a></li>




                <li><a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i
                            class=" ti-support"></i><span class="hide-menu">پشتیبانی</span></a>
                    <ul aria-expanded="false" class="collapse">
                        <li><a href="{{route('user.ticket.create')}}">ارسال تیکت جدید</a></li>
                        <li><a href="{{route('user.ticket.index')}}">لیست تیکت ها</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
<!-- End Left Sidebar -->
