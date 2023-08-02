/* ===========================================================
    Public Function For Backend
   =========================================================== */
!function ($) {
    "use strict";

    var SweetAlert = function () {
    };

    //examples
    SweetAlert.prototype.init = function () {

        //Basic
        $('#sa-basic').click(function () {
            swal("Here's a message!");
        });

        //A title with a text under
        $('#sa-title').click(function () {
            swal("Here's a message!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.")
        });

        //Success Message
        $('#sa-success').click(function () {
            swal("Good job!", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lorem erat eleifend ex semper, lobortis purus sed.", "success")
        });

        //Warning Message
        $('#sa-warning').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false
            }, function () {
                swal("Deleted!", "Your imaginary file has been deleted.", "success");
            });
        });

        //Parameter
        $('#sa-params').click(function () {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this imaginary file!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel plx!",
                closeOnConfirm: false,
                closeOnCancel: false
            }, function (isConfirm) {
                if (isConfirm) {
                    swal("Deleted!", "Your imaginary file has been deleted.", "success");
                } else {
                    swal("Cancelled", "Your imaginary file is safe :)", "error");
                }
            });
        });

        //Custom Image
        $('#sa-image').click(function () {
            swal({
                title: "Govinda!",
                text: "Recently joined twitter",
                imageUrl: "../assets/images/users/1.png"
            });
        });

        //Auto Close Timer
        $('#sa-close').click(function () {
            swal({
                title: "Auto close alert!",
                text: "I will close in 2 seconds.",
                timer: 2000,
                showConfirmButton: false
            });
        });


    },
        //init
        $.SweetAlert = new SweetAlert, $.SweetAlert.Constructor = SweetAlert
}(window.jQuery),
    function ($) {
        "use strict";
        $.SweetAlert.init()
    }(window.jQuery);
$(document).ready(function () {
    /*Massage login panel dashboard*/
    try {
        /*Chart Traffic Monthly Dashboard*/
        var ctx1 = document.getElementById("ChartTrafficMonthly").getContext("2d");
        var data1 = {
            labels: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12", "13", "14", "15", "16", "17", "18", "19", "20", "21", "22", "23", "24", "25", "26", "27", "28", "29", "30"],
            datasets: [
                {
                    label: "تراکنش های دریافتی",
                    fillColor: "rgba(0,200,00,0.65)",
                    strokeColor: "rgba(152,235,239,0.8)",
                    pointColor: "rgba(0,245,00,0.8)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(152,235,239,1)",
                    data: [3, 4, 1, 4, 5, 2, 2, 0, 1, 2, 3, 4, 4, 3, 2, 1, 2, 3, 2, 5, 1, 2, 5, 1, 0, 0, 2, 1, 1, 2]
                }
            ]
        };
        var chart1 = new Chart(ctx1).Bar(data1, {
            scaleBeginAtZero: true,
            scaleShowGridLines: true,
            scaleGridLineColor: "rgba(0,0,0,.005)",
            scaleGridLineWidth: 0,
            scaleShowHorizontalLines: true,
            scaleShowVerticalLines: true,
            barShowStroke: true,
            barStrokeWidth: 0,
            tooltipCornerRadius: 2,
            barDatasetSpacing: 3,
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
            responsive: true
        });
    } catch (e) {

    }
});
$(function () {
    "use strict";


    $(".toast-info").click(function () {
        $.toast({
            heading: 'اطلاعات',
            text: 'متن پیام اطلاعات اینجا نوشته می شود.',
            position: 'bottom-left',
            textAlign: 'right',
            loaderBg: '#ff6849',
            icon: 'info',
            hideAfter: 3000,
            stack: 6
        });

    });
    $(".toast-warning").click(function () {
        $.toast({
            heading: 'هشدار',
            text: 'متن پیام هشدار اینجا نوشته می شود.',
            position: 'bottom-left',
            textAlign: 'right',
            loaderBg: '#ff6849',
            icon: 'warning',
            hideAfter: 3500,
            stack: 6
        });

    });
    $(".toast-success").click(function () {
        $.toast({
            heading: 'موفق',
            text: 'متن پیام موفق اینجا نوشته می شود.',
            position: 'bottom-left',
            textAlign: 'right',
            loaderBg: '#ff6849',
            icon: 'success',
            hideAfter: 3500, /**/
            stack: 6
        });

    });
    $(".toast-error").click(function () {
        $.toast({
            heading: 'خطا',
            text: 'متن پیام خطا اینجا نوشته می شود.',
            position: 'bottom-left',
            textAlign: 'right',
            loaderBg: '#ff6849',
            icon: 'error',
            hideAfter: 3500
        });

    });
});

/* ===========================================================
    Setting Menu Sidebar (Please Dont Change)
   =========================================================== */
$(function () {
    var url = window.location;
    var element = $('ul#sidebarnav a').filter(function () {
        return this.href == url;
    }).addClass('active').parent().addClass('active');
    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent().addClass('active').children('a').addClass('active');

        } else {
            break;
        }
    }
    $('#sidebarnav a').on('click', function (e) {

        if (!$(this).hasClass("active")) {
            // hide any open menus and remove all other classes
            $("ul", $(this).parents("ul:first")).removeClass("in");
            $("a", $(this).parents("ul:first")).removeClass("active");

            // open our new menu and add the open class
            $(this).next("ul").addClass("in");
            $(this).addClass("active");

        } else if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).parents("ul:first").removeClass("active");
            $(this).next("ul").removeClass("in");
        }
    });
    $('#sidebarnav >li >a.has-arrow').on('click', function (e) {
        e.preventDefault();
    });
});

/* ===========================================================
    Private Setting Themes (Please Dont Change)
   =========================================================== */
$(function () {
    "use strict";
    $(function () {
        $(".preloader").fadeOut();
    });
    // ==============================================================
    // This is for the top header part and sidebar part
    // ==============================================================
    var set = function () {
        var width = (window.innerWidth > 0) ? window.innerWidth : this.screen.width;
        var topOffset = 55;
        if (width < 1170) {
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
            $(".sidebartoggler i").addClass("ti-menu");
        } else {
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
        }
        var height = ((window.innerHeight > 0) ? window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $(".page-wrapper").css("min-height", (height) + "px");
        }
    };
    $(window).ready(set);
    $(window).on("resize", set);
    // ==============================================================
    // Theme options
    // ==============================================================
    $(".sidebartoggler").on('click', function () {
        if ($("body").hasClass("mini-sidebar")) {
            $("body").trigger("resize");
            $("body").removeClass("mini-sidebar");
            $('.navbar-brand span').show();
        } else {
            $("body").trigger("resize");
            $("body").addClass("mini-sidebar");
            $('.navbar-brand span').hide();
        }
    });
    // this is for close icon when navigation open in mobile view
    $(".nav-toggler").click(function () {
        $("body").toggleClass("show-sidebar");
        $(".nav-toggler i").toggleClass("ti-menu");
        $(".nav-toggler i").addClass("ti-close");
    });
    // ==============================================================
    //tooltip
    // ==============================================================
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    });
    // ==============================================================
    //Popover
    // ==============================================================
    $(function () {
        $('[data-toggle="popover"]').popover()
    });
    // ==============================================================
    // Perfact scrollbar
    // ==============================================================
    $('.scroll-sidebar, .right-side-panel, .message-center, .right-sidebar').perfectScrollbar();
    // ==============================================================
    // Resize all elements
    // ==============================================================
    $("body").trigger("resize");
    // ==============================================================
    // toggle forget password in page login
    // ==============================================================
    $('#to-recover').on("click", function () {
        $("#loginform").slideUp();
        $("#recoverform").fadeIn().css("display", "flex")
    });


    $('#to-login').on("click", function () {
        $("#loginform").slideDown();
        $("#recoverform").fadeOut();
    });
    // ==============================================================
    // Select2
    // ==============================================================
    $(".custom-select").select2({
        placeholder: "انتخاب کنید",
        minimumResultsForSearch: -1,
        language: {
            "noResults": function () {
                return "نتیجه ای وجود نداشت.";
            }
        }
    });
    $(".select2-multiple").select2({
        placeholder: "انتخاب کنید",
        language: {
            "noResults": function () {
                return "نتیجه ای وجود نداشت.";
            }
        }
    });
    // ==============================================================
    // Sort Table
    // ==============================================================
    $('#sort-table, #sort-table-1').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ],
        language: {
            "search": "جستجو",
            "lengthMenu": "نمایش _MENU_ رکورد در صفحه",
            "zeroRecords": "موردی یافت نشد.",
            "info": "نمایش صفحات _PAGE_ از _PAGES_",
            "infoEmpty": "هیچ رکوردی موجود نیست",
            "infoFiltered": "(فیتر شده از _MAX_ پرونده)",
            "paginate": {
                "first": "اولین",
                "last": "آخرین",
                "next": "بعدی",
                "previous": "قبلی",
            }
        }
    });
    // ==============================================================
    // Switchery
    // ==============================================================
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    $('.js-switch').each(function () {
        new Switchery($(this)[0], $(this).data());
    });
    // ==============================================================
    // Date Picker
    // ==============================================================
    var maxBirthdayDate = new Date();
    $(".datepicker-year").pDatepicker({
        "format": "YYYY/MM/DD",
        "viewMode": "year",
        "initialValue": false,
        "autoClose": true,
        "position": "auto",
        "onlyTimePicker": false,
        "onlySelectOnDate": true,
        "calendarType": "persian",
        "observer": true,
        "responsive": true,
        "maxDate": maxBirthdayDate,
    });
    $(".datepicker-day").pDatepicker({
        "format": "YYYY/MM/DD",
        "viewMode": "day",
        "initialValue": false,
        "autoClose": true,
        "position": "auto",
        "onlyTimePicker": false,
        "onlySelectOnDate": true,
        "calendarType": "persian",
        "observer": true,
        "responsive": true
    });
    $(".timepicker").pDatepicker({
        "format": "HH:mm",
        "initialValue": false,
        "autoClose": true,
        "position": "auto",
        "onlyTimePicker": true,
        "onlySelectOnDate": false,
        "calendarType": "persian",
        "observer": true,
        "timePicker": {
            "second": {
                "enabled": false,
                "step": null
            },
            "meridian": {
                "enabled": false
            }
        },
        "responsive": true,
    });
});

// ==============================================================
// Copy Text and Paste
// ==============================================================
function Copy(text) {
    var copyText = document.getElementById(text);
    copyText.select();
    document.execCommand("copy");
    $.toast({
        heading: 'کپی شد'
        , text: 'لینک شما در حافظه موقت ذخیره شد.'
        , position: 'bottom-left'
        , textAlign: 'right'
        , loaderBg: '#03a9f3'
        , icon: 'success'
        , hideAfter: 3500
        , stack: 6
    })
}

// ==============================================================
// Framework Custom JS
// ==============================================================
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //===================================================
    //||
    //||
    //===================================================
    $('#toRegisterWithEmail').on("click", function () {

        var email = $('#registerForm input[name=email]').val();
        var result = $('#registerForm input[name=result]').val();
        var a = $('#registerForm input[name=a]').val();
        var b = $('#registerForm input[name=b]').val();
        var operator = $('#registerForm input[name=operator]').val();
        $.ajax({
            'url': 'toRegister',
            'type': 'post',
            'dataType': 'json',
            data: {email: email, result: result, a: a, b: b, operator: operator},
            beforeSend: function () {
                $('#preloader').addClass('loading');
            },
            complete: function () {
                $('#preloader').removeClass('loading');
            },
            success: function (response) {
                $('#toRegisterError , #resultError').text('');
                $('#verificationForm input[name=email]').val('');
                $('#registerForm input[name=result]').val('').text('');
                if (!$.isEmptyObject(response.registerError)) {
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = b + ' ' + operator + ' ' + a + ' ' + 'برابر با چه عددی است؟';
                    $('input[name=result]').attr('placeholder', placeholder);
                    if (response.registerError == 'userAlreadyExists') {
                        $('#toRegisterError').text('کاربری با این شماره از قبل ثبت نام شده است');
                    } else if (!$.isEmptyObject(response.registerError.email)) {
                        $('#toRegisterError').text(response.registerError.email[0]);
                    } else if (!$.isEmptyObject(response.registerError.result)) {
                        $('#resultError').text(response.registerError.result[0]);
                    }
                } else if (response.result == 'incorrect') {
                    $('#resultError').text('حاصل عبارت فوق نادرست می باشد');
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = b + ' ' + operator + ' ' + a + ' ' + 'برابر با چه عددی است؟';
                    $('input[name=result]').attr('placeholder', placeholder);
                } else if (response.sms == 'error') {
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = b + ' ' + operator + ' ' + a + ' ' + 'برابر با چه عددی است؟';
                    $('input[name=result]').attr('placeholder', placeholder);
                    swal({
                        title: "خطا!",
                        text: "در فرآیند ارسال ایمیل مشکلی رخ داده است ، لطفا چند دقیقه دیگر مجددا تلاش کنید.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7cd1f9",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });
                } else if (response.email == 'sent') {

                    $('#registerForm').attr('action', '/essentials/create/' + response.id).submit();
                }
            }
        });
    });
    function drawHelloWorld(canvas,op) {

        const ctx = canvas.getContext("2d");
        // Draw the background
        ctx.rect(0, 0, 100, 30);
        ctx.fillStyle = "#17a2b8";
        ctx.fill();

        // Draw the text
        ctx.font = "20px Helvetica";
        ctx.fillStyle = "ghostwhite";
        ctx.fillText(op, 30, 20);

        const imgElement = document.createElement('img');
        imgElement.src = canvas.toDataURL('image/jpeg');
        document.getElementById('CanvasContainer').innerHTML = ''
        $("#dont_show").hide()
        document.getElementById('CanvasContainer').appendChild(imgElement);
    }
    $('#toRegister').on("click", function () {
        var mobile = $('#registerForm input[name=mobile]').val();
        var result = $('#registerForm input[name=result]').val();
        var a = $('#registerForm input[name=a]').val();
        var b = $('#registerForm input[name=b]').val();
        var operator = $('#registerForm input[name=operator]').val();
        $.ajax({
            'url': 'toRegister',
            'type': 'post',
            'dataType': 'json',
            data: {mobile: mobile, result: result, a: a, b: b, operator: operator},
            beforeSend: function () {
                $('#toRegister').css('opacity', '0.4').prop('disabled', true);
                $('#registerInputWrapper .fa-spin').show();
            },
            complete: function () {
                $('#toRegister').css('opacity', '1').prop('disabled', false);
                $('#registerInputWrapper .fa-spin').hide();
            },
            success: function (response) {
                $('#toRegisterError , #resultError').text('');
                $('#verificationForm input[name=mobile]').val('');
                $('#registerForm input[name=result]').val('').text('');
                if (!$.isEmptyObject(response.registerError)) {
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = a + ' ' + operator + ' ' + b ;

                    const canvas = document.getElementById('myCanvas');
                    drawHelloWorld(canvas,placeholder);



                    // Make canvas to data URI

                    // $('input[name=result]').attr('placeholder', placeholder);
                    if (response.registerError == 'userAlreadyExists') {
                        $('#toRegisterError').text('کاربری با این شماره از قبل ثبت نام شده است');
                    } else if (!$.isEmptyObject(response.registerError.mobile)) {
                        $('#toRegisterError').text(response.registerError.mobile[0]);
                    } else if (!$.isEmptyObject(response.registerError.result)) {
                        $('#resultError').text(response.registerError.result[0]);
                    }
                } else if (response.result == 'incorrect') {
                    $('#resultError').text('حاصل عبارت فوق نادرست می باشد');
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = a + ' ' + operator + ' ' + b ;
                    // $('input[name=result]').attr('placeholder', placeholder);

                    const canvas = document.getElementById('myCanvas');
                    drawHelloWorld(canvas,placeholder);

                } else if (response.sms == 'error') {
                    $('input[name=a]').val(response.array[0]);
                    $('input[name=b]').val(response.array[2]);
                    $('input[name=operator]').val(response.array[1]);
                    var a = response.array[0].toString();
                    var b = response.array[2].toString();
                    var operator = response.array[1].toString();
                    var placeholder = a + ' ' + operator + ' ' + b ;
                    // $('input[name=result]').attr('placeholder', placeholder);
                    const canvas = document.getElementById('myCanvas');
                    drawHelloWorld(canvas,placeholder);

                    swal({
                        title: "خطا!",
                        text: "در فرآیند ارسال پیامک مشکلی رخ داده است ، لطفا چند دقیقه دیگر مجددا تلاش کنید.",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#7cd1f9",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });
                } else if (response.code == 'sent') {
                    $('#verificationForm input[name=mobile]').val('شماره همراه : ' + response.mobile);
                    $("#registerForm").slideUp();
                    $("#verificationForm").fadeIn().css("display", "flex");
                    var oneMinute = new Date().getTime() + 59000;
                    $('#countDown').countdown(oneMinute)
                        .on('update.countdown', function (event) {
                            $(this).html(event.strftime('در %S ثانیه دیگر'));
                        })
                        .on('finish.countdown', function (event) {
                            $(this).fadeOut();
                            $('#registerResend').css({
                                'cursor': 'pointer',
                                'opacity': '1'
                            }).removeClass('off').addClass('on');
                        });
                }
            }
        });
    });

    $('#toCheckCode').on("click", function () {
        var mobile = $('#verificationForm input[name=mobile]').val().replace('شماره همراه : ', '');
        var code = $('#verificationForm input[name=code]').val();
        $.ajax({
            'url': 'toCheckCode',
            'type': 'post',
            'dataType': 'json',
            data: {mobile: mobile, code: code},
            beforeSend: function () {
                $('#toCheckCode').css('opacity', '0.4').prop('disabled', true);
                $('#verificationInputWrapper .fa-spin').show();
            },
            complete: function () {
                $('#toCheckCode').css('opacity', '1').prop('disabled', false);
                $('#verificationInputWrapper .fa-spin').hide();
            },
            success: function (response) {
                $('#toCheckCodeError').text('');
                if (!$.isEmptyObject(response.verificationError)) {
                    if (response.verificationError == 'incorrectCode') {
                        $('#toCheckCodeError').text('کد نادرست است');
                    } else if (response.verificationError == 'userAlreadyExists') {
                        $('#toCheckCodeError').text('کاربری با این شماره از قبل ثبت نام شده است');
                    } else {
                        $('#toCheckCodeError').text(response.verificationError[0]);
                    }
                } else if (response.code == 'correct') {
                    // window.location.href
                    $('#verificationForm').attr('action', '/essentials/create/' + response.id).submit();
                }
            }
        });
    });


    //Editing User Primary Information
    $(document).on('click', '#primaryEssentialForm #submitPrimaryEssential', function () {
        var id = $('input[name=id]').val();
        var familiarity = $('#primaryEssentialForm select[name=familiarity]').val();
        var name = $('#primaryEssentialForm input[name=name]').val();
        var n_code = $('#primaryEssentialForm input[name=n_code]').val();
        var birthDate = $('#primaryEssentialForm input[name=birthDate]').val();
        var email = $('#primaryEssentialForm input[name=email]').val();
        var company_role_id = $('#primaryEssentialForm input[name=role]').val();
        var saham = $('#primaryEssentialForm input[name=saham]').val();
        var password = $('#primaryEssentialForm input[name=password]').val();
        var password_confirmation = $('#primaryEssentialForm input[name=password_confirmation]').val();
        $.ajax({
            'url': '/dashboard/user/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                familiarity: familiarity,
                n_code: n_code,
                name: name,
                email: email,
                company_role_id: company_role_id,
                birthDate: birthDate,
                saham: saham,
                password: password,
                password_confirmation: password_confirmation,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toEditName,#toEditNCode,#toEditBirthDate,#toEditEmail,#toEditRole,#toEditSaham,#toEditFamiliarity,#toEditPass,#toEditPassConf').text('');
                if (!$.isEmptyObject(response.primaryEssentialError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });

                    toEditPass
                    toEditpassConf
                    if (!$.isEmptyObject(response.primaryEssentialError.name)) {
                        $('#toEditName').text(response.primaryEssentialError.name[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.n_code)) {
                        $('#toEditNCode').text(response.primaryEssentialError.n_code[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.birthDate)) {
                        $('#toEditBirthDate').text(response.primaryEssentialError.birthDate[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.email)) {
                        $('#toEditEmail').text(response.primaryEssentialError.email[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.company_role_id)) {
                        $('#toEditRole').text(response.primaryEssentialError.company_role_id[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.saham)) {
                        $('#toEditSaham').text(response.primaryEssentialError.saham[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.email)) {
                        $('#toEditEmail').text(response.primaryEssentialError.email[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.familiarity)) {
                        $('#toEditFamiliarity').text(response.primaryEssentialError.familiarity[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.password)) {
                        $('#toEditPass').text(response.primaryEssentialError.password[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.password_confirmation)) {

                        $('#toEditPassConf').text(response.primaryEssentialError.password_confirmation[0]);
                    }
                } else {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                }
            }
        });
    });

    //=================== File Manipulation ========================
    //Creates File Record
    $(document).on('click', '#submitFile', function () {
        var id = $('input[name=id]').val();
        var file = new FormData($("#collapsefile")[0]);
        $.ajax({
            'url': '/dashboard/file/' + id,
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: file,
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateFileTitle,#toCreateFileFileTitle,#toCreateFile').text('');
                if (!$.isEmptyObject(response.fileError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.fileError.title)) {
                        $('#toCreateFileTitle').text(response.fileError.title[0]);
                    }
                    if (!$.isEmptyObject(response.fileError.fileTitle)) {
                        $('#toCreateFileFileTitle').text(response.fileError.fileTitle[0]);
                    }
                    if (!$.isEmptyObject(response.fileError.file)) {
                        $('#toCreateFile').text(response.fileError.file[0]);
                    }
                } else if (response.fileCreate == 'submitted') {
                    $('#collapsefile select').each(function () {
                        $(this).val('').change();
                    });
                    $('#collapsefile input').each(function () {
                        $(this).val('').text('');
                    });
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.file[0] + '</td>\n' +
                        '  <td>' + response.file[1] + '</td>\n' +
                        '  <td>' + response.file[2] + '</td>\n' +
                        '  <td>' + response.file[5] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <a href="/dashboard/download/' + response.file[4] + '/' + id + '?mac=' + response.file[3] + '" class="btn btn-success btn-sm download-file" id="' + response.file[4] + '"><i class="d-inline-flex align-middle ti-download ml-1"></i>دانلود </a>\n' +
                        '  <button class="btn btn-danger btn-sm remove-file" id="' + response.file[4] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#fileTbody').append(html);
                }
            }
        });
    });
    //Removes Research Record
    $(document).on('click', '.remove-file', function () {
        var id = $(this).attr('id');
        swal({
            title: "آیا مطمئن به حذف می باشید؟",
            text: "در صورت حذف , اطلاعات از پایگاه داده حذف خواهد شد!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                'url': '/dashboard/file/' + id,
                'type': 'delete',
                'dataType': 'json',
                data: {id: id},
                context: this,
                success: function (response) {
                    if (response.deleteFile == 'success') {
                        $('.remove-file[id="' + id + '"]').parents('tr').fadeOut();
                        swal({
                            title: "اطلاعات با موفقیت حذف شد!",
                            text: "",
                            type: "success",
                            confirmButtonText: "تایید"
                        });
                    }
                }
            });
        });
    });

    //=============================== Relatives Manipulation =======
    //Removes Secondary User
    $(document).on('click', '.remove-user', function () {
        var id = $(this).attr('id');
        swal({
            title: "آیا مطمئن به حذف می باشید؟",
            text: "در صورت حذف , اطلاعات از پایگاه داده حذف خواهد شد!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            closeOnConfirm: false
        }, function () {
            $('form[id=' + id + ']').submit();
        });
    });
    $('#relativePrimaryForm select[name=gender]').on('change', function () {
        var val = $(this).val();
        switch (val) {
            case '0':
                $('#relativePrimaryForm select[name=militaryServiceStatus] option[value=""]').prop('selected', true).trigger('change.select2');
                $('#relativePrimaryForm select[name=militaryServiceStatus]').prop('disabled', true).trigger('change.select2');
                break;
            case '1':
                $('#relativePrimaryForm select[name=militaryServiceStatus] option[value=1]').prop('selected', true).trigger('change.select2');
                $('#relativePrimaryForm select[name=militaryServiceStatus]').prop('disabled', false).trigger('change.select2');
                break;
        }
    });
    //Toggles Name On Changing UID In Secondary User Create/Edit
    $('#relativePrimaryForm #submitRelativePrimary').on('click', function () {
        var id = $('input[name=id]').val();
        var connection = $('#relativePrimaryForm select[name=connection]').val();
        var gender = $('#relativePrimaryForm select[name=gender]').val();
        var name = $('#relativePrimaryForm input[name=name]').val();
        var maritalStatus = $('#relativePrimaryForm select[name=maritalStatus]').val();
        var birthDate = $('#relativePrimaryForm input[name=birthDate]').val();
        var militaryServiceStatus = $('#relativePrimaryForm select[name=militaryServiceStatus]').val();
        $.ajax({
            'url': '/dashboard/relative/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                connection: connection,
                gender: gender,
                name: name,
                maritalStatus: maritalStatus,
                birthDate: birthDate,
                militaryServiceStatus: militaryServiceStatus
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#relativePrimaryForm #toEditConnection,#toEditRelation,#toEditGender,#toEditName,#toEditMaritalStatus,#toEditBirthDate,#toEditMilitaryServiceStatus').text('');
                if (!$.isEmptyObject(response.relativeError)) {
                    if (!$.isEmptyObject(response.relativeError.connection)) {
                        $('#relativePrimaryForm #toEditConnection').text(response.relativeError.connection[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.relation)) {
                        $('#relativePrimaryForm #toEditRelation').text(response.relativeError.relation[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.gender)) {
                        $('#relativePrimaryForm #toEditGender').text(response.relativeError.gender[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.name)) {
                        $('#relativePrimaryForm #toEditName').text(response.relativeError.name[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.maritalStatus)) {
                        $('#relativePrimaryForm #toEditMaritalStatus').text(response.relativeError.maritalStatus[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.birthDate)) {
                        $('#relativePrimaryForm #toEditBirthDate').text(response.relativeError.birthDate[0]);
                    }
                    if (!$.isEmptyObject(response.relativeError.militaryServiceStatus)) {
                        $('#relativePrimaryForm #toEditMilitaryServiceStatus').text(response.relativeError.militaryServiceStatus[0]);
                    }
                } else if (response.relativeUpdate == 'success') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                }
            }
        });
    });
    $('.close-ticket').on('click', function () {
        var id = $(this).attr('id');
        event.preventDefault();
        swal({
            title: "هشدار!",
            text: "در صورت بستن تیکت , سوالات پاسخ داده نشده به صورت موارد رسیدگی شده تغییر وضعیت داده و دیگر قادر به باز کردن تیکت نخواهید بود!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            closeOnConfirm: false
        }, function () {
            $('#form-' + id).submit()
        });
    });
    //================= Resend Register SMS ============================================================================
    $(document).on('click', '#registerResend', function () {
        if ($(this).hasClass('on')) {
            var mobile = $('#verificationForm input[name=mobile]').val().replace('شماره همراه : ', '');
            $(this).removeClass('on').addClass('off').css({
                'cursor': 'no-drop',
                'opacity': '0.5'
            });
            // var fiveMinutes = new Date().getTime() + 300000;
            // $('#countDown').countdown(fiveMinutes)
            //     .on('update.countdown', function (event) {
            //         $(this).html(event.strftime('در %S:%M ثانیه دیگر'));
            //     })
            //     .on('finish.countdown', function (event) {
            //         $(this).fadeOut();
            //         $('#registerResend').css({'cursor': 'pointer', 'opacity': '1'}).removeClass('off').addClass('on');
            //     });
            $.ajax({
                'url': '/resend',
                'type': 'post',
                'dataType': 'post',
                data: {mobile: mobile, type: 'register'},
                beforeSend: function () {
                    $('#resend-spinner').removeClass('d-none');
                },
                complete: function () {
                    $('#resend-spinner').addClass('d-none');
                },
                success: function (response) {
                    console.log(response);
                    if (response.resend == 'success') {
                        $.toast({
                            heading: 'موفقیت!',
                            text: 'کد تایید مجددا ارسال شد',
                            position: 'bottom-left',
                            textAlign: 'right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500
                        });
                    } else if (response.resend == 'failed') {
                    }
                }
            });
        }
    });
    $(document).on('click', '.delete-question', function () {
        var id = $(this).attr('id');
        swal({
            title: "آیا مطمئن به حذف می باشید؟",
            text: "در صورت حذف , اطلاعات از پایگاه داده حذف خواهد شد!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "بله",
            cancelButtonText: "خیر",
            closeOnConfirm: false
        }, function () {
            $.ajax({
                'url': '/dashboard/question/' + id + '/destroy',
                'type': 'delete',
                'dataType': 'json',
                processData: false,
                contentType: false,

                beforeSend: function () {
                    $('.preloader').fadeIn();
                },
                complete: function () {
                    $('.preloader').fadeOut();
                },
                success: function (response) {
                    $('#toCreateGuarantee').text('');
                    if (!$.isEmptyObject(response.questionError)) {
                        $.toast({
                            heading: 'خطا!',
                            text: 'ورودی های خود را بررسی کنید',
                            position: 'bottom-left',
                            textAlign: 'right',
                            loaderBg: '#ff6849',
                            icon: 'error',
                            hideAfter: 3500
                        });

                    } else if (response.question == 'deleted') {
                        $.toast({
                            heading: 'موفقیت!',
                            text: 'اطلاعات حذف شد',
                            position: 'bottom-left',
                            textAlign: 'right',
                            loaderBg: '#ff6849',
                            icon: 'success',
                            hideAfter: 3500
                        });

                    }
                }
            });
        });
    });

    //======================== number_format  ====================================================================
    function number_format(number, decimals, dec_point, thousands_sep) {
        // Strip all characters but numerical ones.
        number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
        var n = !isFinite(+number) ? 0 : +number,
            prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
            sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
            dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
            s = '',
            toFixedFix = function (n, prec) {
                var k = Math.pow(10, prec);
                return '' + Math.round(n * k) / k;
            };
        // Fix for IE parseFloat(0.55).toFixed(0) = 0;
        s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
        if (s[0].length > 3) {
            s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
        }
        if ((s[1] || '').length < prec) {
            s[1] = s[1] || '';
            s[1] += new Array(prec - s[1].length + 1).join('0');
        }
        return s.join(dec);
    }
    $('.dropify').dropify({
        messages: {}
    });
});
