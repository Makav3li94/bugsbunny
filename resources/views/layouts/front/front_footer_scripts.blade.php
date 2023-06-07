<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="{{asset('front/js/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('front/assets/bootstrap/js/popper.min.js')}}"></script>
<script src="{{asset('front/assets/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{asset('front/js/pre-loader.js')}}"> </script>
<script src="{{asset('front/assets/slick/slick.min.js')}}"></script>
<script src="{{asset('front/js/parallaxie.js')}}"></script>
<script src="{{asset('admin/assets/node_modules/toast-master/js/jquery.toast.js')}}"></script>
<script src="{{asset('front/assets/counterup/jquery.counterup.min.js')}}"></script>
<script src="{{asset('front/assets/counterup/jquery.waypoints.min.js')}}"></script>
<script src="{{asset('front/js/TweenMax.min.js')}}"></script>
<script src="{{asset('front/js/jquery.wavify.js')}}"></script>
<script src="{{asset('front/assets/wow/wow.min.js')}}"></script>
<script src="{{asset('front/assets/mcustomscrollbar/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<script>
    $(document).ready(function () {
        @if(session()->get('contact')=='sent')
        $.toast({
            heading: 'موفقیت!'
            , text: 'پیام شما ارسال شد.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });

        @elseif(session()->get('verified')==true)
        $.toast({
            heading: 'موفقیت!'
            , text: 'ایمیل شما با موفقیت تایید شد.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('quiz')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'از شرکت شما در چالش ممنونیم'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('store')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات با موفقیت افزوده شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('delete')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات از پایگاه داده حذف شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('destroy')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات از پایگاه داده حذف شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('update')=='success')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات به روزرسانی شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('message')=='sent')
        $.toast({
            heading: 'موفقیت!'
            , text: 'پیغام ارسال شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('profile')=='updated')
        $.toast({
            heading: 'موفقیت!'
            , text: 'اطلاعات به روز رسانی شد'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('login')=='success')
        $.toast({
            heading: 'ورود موفق'
            , text: 'کاربر گرامی خوش آمدید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'success'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('sms')=='error')
        swal({
            title: "خطا!",
            text: "در فرآیند ارسال پیامک مشکلی رخ داده است ، لطفا چند دقیقه دیگر مجددا تلاش کنید.",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#7cd1f9",
            confirmButtonText: "تایید",
            closeOnConfirm: true
        });
        @elseif(session()->get('authStatus')=='error')
        $.toast({
            heading: 'اطلاعیه!'
            , text: 'برای استفاده از خدمات مالی دریک باید اطلاعات شرکت را تکمیل کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('authStatus')=='file')
        $.toast({
            heading: 'اطلاعیه!'
            , text: ' شما باید احراز هویت بشوید، لطفا اسناد لازم را ضمیمه کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @elseif(session()->get('authStatus')=='user')
        $.toast({
            heading: 'اطلاعیه!'
            , text: ' به دلیل ثبت قرارداد رسمی، ورود اطلاعات اعضا دارای حق امضا الزامی است.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @endif

        @if($errors->all())
        $.toast({
            heading: 'خطا!'
            , text: 'لطفا اطلاعات وارد شده را بررسی کنید.'
            , position: 'bottom-left'
            , textAlign: 'right'
            , loaderBg: '#03a9f3'
            , icon: 'warning'
            , hideAfter: 3500
            , stack: 6
        });
        @endif
        $("#goAway").fadeOut(20000);
    });

</script>
<script src="{{asset('front/js/main-rtl.js')}}"></script>
@yield('scripts')


