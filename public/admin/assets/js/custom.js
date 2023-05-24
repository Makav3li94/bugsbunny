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
        $("#recoverform").fadeIn().css("display","flex")
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
        "responsive": true
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
                    var placeholder = b + ' ' + operator + ' ' + a + ' ' + 'برابر با چه عددی است؟';
                    $('input[name=result]').attr('placeholder', placeholder);
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
                    $("#verificationForm").fadeIn().css("display","flex");
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

    //======================== Deletes Product  ====================================================================
    $(document).on('click', '.delete-product', function () {
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
    //======================== Financial Claims Manipulation  ====================================================================

    $(document).on('click', '#submitFiCa', function () {
        var formData = new FormData($("#collapseFiCa")[0]);
        $.ajax({
            'url': '/dashboard/financial-claims',
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: formData,

            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateGuarantee').text('');
                if (!$.isEmptyObject(response.fiCaError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.fiCaError.financial_claims_category_id)) {
                        $('#toCreateCat').text(response.fiCaError.financial_claims_category_id[0]);
                    }
                    if (!$.isEmptyObject(response.fiCaError.file)) {
                        $('#toCreateFile').text(response.fiCaError.file[0]);
                    }
                    if (!$.isEmptyObject(response.fiCaError.due_date)) {
                        $('#toCreateDueDate').text(response.fiCaError.due_date[0]);
                    }
                    if (!$.isEmptyObject(response.fiCaError.amount)) {
                        $('#toCreateAmount').text(response.fiCaError.amount[0]);
                    }
                    if (!$.isEmptyObject(response.fiCaError.cash)) {
                        $('#toCreateCash').text(response.fiCaError.cash[0]);
                    }
                    if (!$.isEmptyObject(response.fiCaError.cover_per)) {
                        $('#toCreateCoverPer').text(response.fiCaError.cover_per[0]);
                    }
                } else if (response.fiCaCreate == 'submitted') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var stat
                    if (response.fc[6] == 0) {
                        stat = '<span class="badge badge-warning">در حال بررسی</span>';
                    } else {
                        stat = '<span class="badge badge-primary">تایید شد</span>';
                    }
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.fc[0] + '</td>\n' +
                        '  <td>' + response.fc[1] + '</td>\n' +
                        '  <td>' + response.fc[2] + '</td>\n' +
                        '  <td>' + response.fc[3] + '</td>\n' +
                        '  <td>' + response.fc[4] + '</td>\n' +
                        '  <td>' + response.fc[5] + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td>' + response.fc[7] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-fiCa" id="' + response.fc[8] + '">\n' +
                        '  <i class="d-inline-flex align-middle ti-pencil ml-1"></i>مشاهده\n' +
                        '  </button>' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#fcBody').append(html);
                }
            }
        });
    });
    $(document).on('click', '.edit-fiCa', function () {
        var id = $(this).attr('id');
        $('#collapseFcEdit').modal('show');
        $.ajax({
            'url': '/dashboard/financial-claims/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.fc)) {
                    $('#collapseFCForm select[name=financial_claims_category_id] option[value="' + response.fc.financial_claims_category_id + '"] ').prop('selected', true);
                    $('#collapseFCForm input[name=due_date]').val(response.fc.due_date);
                    $('#collapseFCForm input[name=amount]').val(response.fc.amount);
                    $('#collapseFCForm input[name=cash]').val(number_format(response.fc.cash));
                    $('#collapseFCForm input[name=cover_per]').val(response.fc.cover_per);
                    if (response.fc.status == 1) {
                        $(".defaultChecked2").prop('checked', true);
                    } else {
                        $(".defaultChecked2").prop('checked', false);
                    }
                    $('#files').html(response.downloads)
                }

            }
        });
    });
    //======================== Guarantee Manipulation  ====================================================================

    $(document).on('click', '#submitGuarantee', function () {
        var formData = new FormData($("#collapseGuarantee")[0]);
        $.ajax({
            'url': '/dashboard/guarantee',
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: formData,

            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateGuarantee').text('');
                if (!$.isEmptyObject(response.guaranteeError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.guaranteeError.guarantee_category_id)) {
                        $('#toCreateCat').text(response.guaranteeError.guarantee_category_id[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.file)) {
                        $('#toCreateFile').text(response.guaranteeError.file[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.start_date)) {
                        $('#toCreateStartDate').text(response.guaranteeError.start_date[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.end_date)) {
                        $('#toCreateEndDate').text(response.guaranteeError.end_date[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.amount)) {
                        $('#toCreateAmount').text(response.guaranteeError.amount[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.cash)) {
                        $('#toCreateCash').text(response.guaranteeError.cash[0]);
                    }
                    if (!$.isEmptyObject(response.guaranteeError.cover_per)) {
                        $('#toCreateCoverPer').text(response.guaranteeError.cover_per[0]);
                    }
                } else if (response.guaranteeCreate == 'submitted') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var stat
                    if (response.guarantee[6] == 0) {
                        stat = '<span class="badge badge-warning">در حال بررسی</span>';
                    } else {
                        stat = '<span class="badge badge-primary">تایید شد</span>';
                    }
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.guarantee[0] + '</td>\n' +
                        '  <td>' + response.guarantee[1] + '</td>\n' +
                        '  <td>' + response.guarantee[2] + '</td>\n' +
                        '  <td>' + response.guarantee[3] + '</td>\n' +
                        '  <td>' + response.guarantee[4] + '</td>\n' +
                        '  <td>' + response.guarantee[5] + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td>' + response.guarantee[7] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-guarantee" id="' + response.guarantee[8] + '">\n' +
                        '  <i class="d-inline-flex align-middle ti-pencil ml-1"></i>مشاهده\n' +
                        '  </button>' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#guaranteeBody').append(html);
                }
            }
        });
    });
    $(document).on('click', '.edit-guarantee', function () {
        var id = $(this).attr('id');
        $('#collapseGuaranteeEdit').modal('show');
        $.ajax({
            'url': '/dashboard/guarantee/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.guarantee)) {
                    $('#collapseGuaranteeForm select[name=guarantee_category_id] option[value="' + response.guarantee.guarantee_category_id + '"] ').prop('selected', true);
                    $('#collapseGuaranteeForm input[name=start_date]').val(response.guarantee.start_date);
                    $('#collapseGuaranteeForm input[name=end_date]').val(response.guarantee.end_date);
                    $('#collapseGuaranteeForm input[name=amount]').val(response.guarantee.amount);
                    $('#collapseGuaranteeForm input[name=cover_per]').val(response.guarantee.cover_per);
                    if (response.guarantee.status == 1) {
                        $(".defaultChecked2").prop('checked', true);
                    } else {
                        $(".defaultChecked2").prop('checked', false);
                    }
                    $('#files').html(response.downloads)
                }

            }
        });
    });
    //======================== Cash Request Manipulation  ====================================================================

    $(document).on('click', '#submitCash', function () {
        var formData = new FormData($("#collapseCash")[0]);
        $.ajax({
            'url': '/dashboard/cash-request',
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: formData,

            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateGuarantee').text('');
                if (!$.isEmptyObject(response.cashError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.cashError.guarantee_category_id)) {
                        $('#toCreateCat').text(response.cashError.guarantee_category_id[0]);
                    }
                    if (!$.isEmptyObject(response.cashError.financial_claims_id)) {
                        $('#toCreateFc').text(response.cashError.financial_claims_id[0]);
                    }
                    if (!$.isEmptyObject(response.cashError.file)) {
                        $('#toCreateFile').text(response.cashError.file[0]);
                    }
                    if (!$.isEmptyObject(response.cashError.due_date)) {
                        $('#toCreateDueDate').text(response.cashError.due_date[0]);
                    }
                    if (!$.isEmptyObject(response.cashError.amount)) {
                        $('#toCreateAmount').text(response.cashError.amount[0]);
                    }
                    if (!$.isEmptyObject(response.cashError.cash)) {
                        $('#toCreateCash').text(response.cashError.cash[0]);
                    }
                } else if (response.cashCreate == 'submitted') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var stat
                    if (response.cash[5] == 0) {
                        stat = '<span class="badge badge-warning">در حال بررسی</span>';
                    } else {
                        stat = '<span class="badge badge-primary">بازبینی شد.</span>';
                    }
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.cash[0] + '</td>\n' +
                        '  <td>' + response.cash[1] + '</td>\n' +
                        '  <td>' + response.cash[2] + '</td>\n' +
                        '  <td>' + response.cash[3] + '</td>\n' +
                        '  <td>' + response.cash[4] + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td>' + response.cash[6] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-cash" id="' + response.cash[7] + '">\n' +
                        '  <i class="d-inline-flex align-middle ti-pencil ml-1"></i>مشاهده\n' +
                        '  </button>' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#cashBody').append(html);
                }
            }
        });
    });
    $(document).on('click', '.edit-cash', function () {
        var id = $(this).attr('id');
        $('#collapseCashEdit').modal('show');
        $.ajax({
            'url': '/dashboard/cash-request/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.cash)) {
                    $('#collapseCashForm select[name=cash_request_categories_id] option[value="' + response.cash.cash_request_categories_id + '"] ').prop('selected', true);
                    $('#collapseCashForm select[name=financial_claims_id] option[value="' + response.cash.financial_claims_id + '"] ').prop('selected', true);
                    $('#collapseCashForm input[name=due_date]').val(response.cash.due_date);
                    $('#collapseCashForm input[name=cash]').val(number_format(response.cash.cash));
                    $('#collapseCashForm input[name=amount]').val(response.cash.amount);
                    $('#collapseCashForm input[name=money]').val(number_format(response.cash.money));
                    if (response.cash.status == 1) {
                        $(".defaultChecked2").prop('checked', true);
                    } else {
                        $(".defaultChecked2").prop('checked', false);
                    }
                    $('#files').html(response.downloads)
                }

            }
        });
    });
    //======================== Banks Manipulation  ====================================================================

    $(document).on('click', '#submitBank', function () {
        var formData = new FormData($("#collapseBank")[0]);
        $.ajax({
            'url': '/dashboard/bank/store',
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: formData,

            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateBank').text('');
                if (!$.isEmptyObject(response.bankError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.bankError.title)) {
                        $('#toCreateBankTitle').text(response.bankError.title[0]);
                    }
                    if (!$.isEmptyObject(response.bankError.card_image)) {
                        $('#toCreateBankImage').text(response.bankError.card_image[0]);
                    }
                    if (!$.isEmptyObject(response.bankError.card_number)) {
                        $('#toCreateBankNumber').text(response.bankError.card_number[0]);
                    }
                    if (!$.isEmptyObject(response.bankError.sheba)) {
                        $('#toCreateBankSheba').text(response.bankError.sheba[0]);
                    }

                } else if (response.bankCreate == 'submitted') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var stat
                    if (response.bank[3] == 0) {
                        stat = '<span class="badge badge-warning">در حال بررسی</span>';
                    } else {
                        stat = '<span class="badge badge-primary">بازبینی شد.</span>';
                    }
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.bank[0] + '</td>\n' +
                        '  <td>' + response.bank[1] + '</td>\n' +
                        '  <td>' + response.bank[2] + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td>' + response.bank[4] + '</td>\n' +
                        '   </tr>';
                    $('#bankTbody').append(html);
                }
            }
        });
    });

    //======================== Credits Manipulation  ====================================================================

    $(document).on('click', '#submitCredit', function () {
        var formData = new FormData($("#collapseCredit")[0]);
        $.ajax({
            'url': '/dashboard/credit',
            'type': 'post',
            'dataType': 'json',
            processData: false,
            contentType: false,
            data: formData,

            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateCredit').text('');
                if (!$.isEmptyObject(response.creditError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.creditError.credit_category_id)) {
                        $('#toCreateCat').text(response.creditError.credit_category_id[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.check)) {
                        $('#toCreateCheck').text(response.creditError.check[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.body)) {
                        $('#toCreateBody').text(response.creditError.body[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.fund)) {
                        $('#toCreateFund').text(response.creditError.fund[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.sale)) {
                        $('#toCreateSale').text(response.creditError.sale[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.year_fin)) {
                        $('#toCreateYear').text(response.creditError.year_fin[0]);
                    }
                    if (!$.isEmptyObject(response.creditError.face_fin)) {
                        $('#toCreateFace').text(response.creditError.face_fin[0]);
                    }
                } else if (response.creditCreate == 'submitted') {
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات ثبت شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var stat
                    if (response.credit[3] == 0) {
                        stat = '<span class="badge badge-warning">در حال بررسی</span>';
                    } else {
                        stat = '<span class="badge badge-primary">بازبینی شد.</span>';
                    }
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.credit[0] + '</td>\n' +
                        '  <td>' + response.credit[1] + '</td>\n' +
                        '  <td>' + response.credit[2] + '</td>\n' +
                        '  <td>' + stat + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-credit" id="' + response.credit[4] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#creditBody').append(html);
                }
            }
        });
    });
    $(document).on('click', '.edit-credit', function () {
        var id = $(this).attr('id');
        $('#collapseCreditEdit').modal('show');
        $.ajax({
            'url': '/dashboard/credit/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.credit)) {
                    $('#collapseCreditForm select[name=credit_category_id] option[value="' + response.credit.credit_category_id + '"] ').prop('selected', true);
                    $('#collapseCreditForm select[name=check] option[value="' + response.credit.check + '"] ').prop('selected', true);
                    $('#collapseCreditForm input[name=fund]').val(number_format(response.credit.fund));
                    $('#collapseCreditForm input[name=sale]').val(number_format(response.credit.sale));
                    $('#collapseCreditForm input[name=credit]').val(number_format(response.credit.credit));
                    $('#collapseCreditForm textarea[name=body]').val(response.credit.body);
                    if (response.credit.status == 1) {
                        $(".defaultChecked2").prop('checked', true);
                    } else {
                        $(".defaultChecked2").prop('checked', false);
                    }
                    $('#files').html(response.downloads)
                }

            }
        });
    });

    //======================== Attr Manipulation  ====================================================================

    $(document).on('click', '#submitAttr', function () {
        var title = $('#collapseAttr input[name=title]').val();
        $.ajax({
            'url': '/dashboard/product-attr',
            'type': 'post',
            'dataType': 'json',
            data: {
                title: title,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateAttr').text('');
                if (!$.isEmptyObject(response.attrError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.attrError.title)) {
                        $('#toCreateAttr').text(response.attrError.title);
                    }
                } else if (response.attrCreate == 'submitted') {
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
                        '  <td style="width: 55px;">' + response.attr[0] + '</td>\n' +
                        '  <td>' + response.attr[1] + '</td>\n' +
                        '   </tr>';
                    $('#attrBody').append(html);
                }
            }
        });
    });

    //======================== Inquiry Manipulation  ====================================================================
    $(document).on('click', '.edit-inquiry', function () {
        var id = $(this).attr('id');
        $('#collapseInquiryEdit').modal('show');
        $.ajax({
            'url': '/dashboard/product-inquiry/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.productInquiry)) {

                    $('#collapseInquiryForm input[name=user]').val(response.productInquiry.user.name);
                    $('#collapseInquiryForm input[name=product]').val(response.productInquiry.product.title);
                    $('#collapseInquiryForm select[name=payment_category_id] option[value="' + response.productInquiry.payment_category_id + '"]').prop('selected', true).trigger('change.select2');
                    $('#collapseInquiryForm input[name=amount]').val(response.productInquiry.amount);
                    $('#collapseInquiryForm input[name=unit]').val(response.productInquiry.unit);
                    $('#collapseInquiryForm textarea[name=body]').val(response.productInquiry.body);

                    $('#collapseInquiryForm input[name=created_at]').val(response.productInquiry.date);
                    if (response.is_self == 1){
                        if (response.status == 1) {
                            $('.defaultChecked2').prop('checked', true).attr("disabled", true);
                        }else{
                            $('.defaultChecked2').prop('checked', false).attr("disabled", true);
                        }
                        $('#submitCollapseInquiry').hide()
                        $('#collapseInquiryForm textarea[name=reply]').val(response.productInquiry.reply).attr("disabled", true);
                        $('#collapseInquiryForm input[name=price]').val(response.productInquiry.price).attr("disabled", true);
                    }else{
                        if (response.productInquiry.status == 1) {
                            $('.defaultChecked2').prop('checked', true);

                        }else{
                            $('.defaultChecked2').prop('checked', false);
                        }
                        $('#collapseInquiryForm textarea[name=reply]').val(response.productInquiry.reply);
                    }

                    $('#submitCollapseInquiry').attr('data-id', response.productInquiry.id);
                    $('#collapseInquiryForm').attr('action','/dashboard/product-inquiry/' + response.productInquiry.id)
                }
            }
        });
    });
    $('#submitCollapseInquiry').on('click', function () {
        $('#collapseInquiryForm').submit()
        // var reply = $('#collapseInquiryFrom textarea[name=reply]').val();
        // console.log(reply)
        // var status = $('#collapseInquiryFrom input[name=status]').val();
        // $.ajax({
        //     'url': '/dashboard/product-inquiry/' + id,
        //     'type': 'patch',
        //     'dataType': 'json',
        //     data: {
        //         id: id,
        //         reply: reply,
        //         status: status,
        //     },
        //     success: function (response) {
        //         if (response.inquiryCreate == 'success') {
        //             $('#collapseInquiryEdit').modal('hide');
        //             $.toast({
        //                 heading: 'موفقیت!',
        //                 text: 'اطلاعات به روزرسانی شد',
        //                 position: 'bottom-left',
        //                 textAlign: 'right',
        //                 loaderBg: '#ff6849',
        //                 icon: 'success',
        //                 hideAfter: 3500
        //             });
        //         }
        //     }
        // });
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
});
