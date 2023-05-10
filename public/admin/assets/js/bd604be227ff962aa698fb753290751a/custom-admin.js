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
    var input = $('.timepickeralt').clockpicker({
        placement: 'top',
        donetext: 'انتخاب',
        autoclose: true,
        afterDone: function () {
            var val = $('.timepickeralt:focus').val();
            var converted = toPersianNum(val);
            $('.timepickeralt:focus').val(converted);
        }
    });

    function toPersianNum(num, dontTrim) {

        var i = 0,

            dontTrim = dontTrim || false,

            num = dontTrim ? num.toString() : num.toString().trim(),
            len = num.length,

            res = '',
            pos,

            persianNumbers = typeof persianNumber == 'undefined' ?
                ['۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹'] :
                persianNumbers;

        for (; i < len; i++)
            if ((pos = persianNumbers[num.charAt(i)]))
                res += pos;
            else
                res += num.charAt(i);

        return res;
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
        $("#recoverform").fadeIn();
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
    $(".custom-select-2").select2({
        placeholder: "انتخاب کنید",
        minimumResultsForSearch: 3,
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

    if ($('#sort-table').length !== 0) {
        var table = $('#sort-table').DataTable();
        var data = table.rows().data();
        data.each(function (value, index) {
            var input = table.cell(index, 5).nodes().to$().find('input');
            var elems = Array.prototype.slice.call(input);
            elems.forEach(function (html) {
                var switchery = new Switchery(html);
            });
            var input = table.cell(index, 6).nodes().to$().find('input');
            var elems = Array.prototype.slice.call(input);
            elems.forEach(function (html) {
                var switchery = new Switchery(html);
            });
        });
    } else {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function () {
            new Switchery($(this)[0], $(this).data());
        });
    }


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
// Copy Text and Past
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
        , loaderBg: '#ef3338'
        , icon: 'success'
        , hideAfter: 3500
        , stack: 6
    })
}


// ==============================================================
// Framework Custom Admin JS
// =====================================================================================================================
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Toggles Military Service Select Box Disabled And Enabled
    //=================== Primary & Secondary Information ==============================================================

    //Editing User Primary Information
    $(document).on('click', '#primaryEssentialForm #submitPrimaryEssential', function () {
        var id = $('input[name=id]').val();
        var familiarity = $('#primaryEssentialForm select[name=familiarity]').val();
        var name = $('#primaryEssentialForm input[name=name]').val();
        var cp_phone = $('#primaryEssentialForm input[name=cp_phone]').val();
        var icp_phone = $('#primaryEssentialForm input[name=icp_phone]').val();
        var website = $('#primaryEssentialForm input[name=website]').val();
        var birthDate = $('#primaryEssentialForm input[name=birthDate]').val();
        var mobile = $('#primaryEssentialForm input[name=mobile]').val();
        var email = $('#primaryEssentialForm input[name=email]').val();
        var password = $('#primaryEssentialForm input[name=password]').val();
        $.ajax({
            'url': '/admin/dashboard/user/' + id + '/1',
            'type': 'patch',
            'dataType': 'json',
            data: {
                familiarity: familiarity,
                name: name,
                cp_phone: cp_phone,
                icp_phone: icp_phone,
                website: website,
                birthDate: birthDate,
                mobile: mobile,
                email: email,
                password: password,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toEditGender,#toEditName,#toEditMaritalStatus,#toEditBirthDate,#toEditBirthProvince,#toEditLivingProvince,#toEditMilitaryServiceStatus,#toEditEmail,#toEditFamiliarity,#toEditMobile,#toEditAltMobile,#toEditPassword').text('');
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

                    if (!$.isEmptyObject(response.primaryEssentialError.name)) {
                        $('#toEditName').text(response.primaryEssentialError.name[0]);
                    }

                    if (!$.isEmptyObject(response.primaryEssentialError.birthDate)) {
                        $('#toEditBirthDate').text(response.primaryEssentialError.birthDate[0]);
                    }


                    if (!$.isEmptyObject(response.primaryEssentialError.email)) {
                        $('#toEditEmail').text(response.primaryEssentialError.email[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.familiarity)) {
                        $('#toEditFamiliarity').text(response.primaryEssentialError.familiarity[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.mobile)) {
                        $('#toEditMobile').text(response.primaryEssentialError.mobile[0]);
                    }

                    if (!$.isEmptyObject(response.primaryEssentialError.password)) {
                        $('#toEditPassword').text(response.primaryEssentialError.password[0]);
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


    //=================== Customer Management Manipulation =============================================================
    //Creates Customer Management Record
    $(document).on('click', '#submitManagement', function () {
        var id = $('input[name=id]').val();
        var cmt = $('#collapsemanagement select[name=cmt]').val();
        var description = $('#collapsemanagement input[name=description]').val();
        var date = $('#collapsemanagement input[name=date]').val();
        var time = $('#collapsemanagement input[name=time]').val();
        $.ajax({
            'url': '/admin/dashboard/customerManagement/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {
                cmt: cmt,
                description: description,
                date: date,
                time: time
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateCmt,#toCreateCmDate,#toCreateCmTime').text('');
                if (!$.isEmptyObject(response.cmError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.cmError.cmt)) {
                        $('#toCreateCmt').text(response.cmError.cmt[0]);
                    }
                    if (!$.isEmptyObject(response.cmError.date)) {
                        $('#toCreateCmDate').text(response.cmError.date[0]);
                    }
                    if (!$.isEmptyObject(response.cmError.time)) {
                        $('#toCreateCmTime').text(response.cmError.time[0]);
                    }
                } else if (response.time == 'overlapped') {
                    $.toast({
                        heading: 'خطا!',
                        text: 'این تاریخ و ساعت با قرارهای قبلی تداخل دارد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                } else if (response.cmCreate == 'submitted') {
                    $('#collapsemanagement input').each(function () {
                        $(this).text('').val('');
                    });
                    $('#collapsemanagement select').val('').change();
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
                        '  <td style="width: 55px;">' + response.cm[0] + '</td>\n' +
                        '  <td>' + response.cm[1] + '</td>\n' +
                        '  <td>' + response.cm[2] + '</td>\n' +
                        '  <td>' + response.cm[3] + '</td>\n' +
                        '  <td><input type="checkbox" class="js-switch toggle-cmt" data-color="#009efb" id="' + response.cm[4] + '" /></td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-cm" id="' + response.cm[4] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-cm" id="' + response.cm[4] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#cmTbody').append(html);
                    var elem = Array.prototype.slice.call($('input.js-switch[id="' + response.cm[4] + '"]'));
                    new Switchery(elem[0]);
                }
            }
        });
    });
    //Gets Customer Management Record And Puts Into Modal For Modification
    $(document).on('click', '.edit-cm', function () {
        var id = $(this).attr('id');
        $('#collapseCm').modal('show');
        $.ajax({
            'url': '/admin/dashboard/customerManagement/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            data: {id: id},
            success: function (response) {
                if (!$.isEmptyObject(response.cm)) {
                    $('#collapseCmForm select[name=cmt] option[value="' + response.cm.customer_management_title_id + '"]').prop('selected', true).trigger('change.select2');
                    $('#collapseCmForm input[name=description]').val(response.cm.description);
                    $('#collapseCmForm input[name=date]').val(response.date);
                    $('#collapseCmForm input[name=time]').val(response.cm.reminder_time);
                    $('#submitCollapseCm').attr('data-id', response.cm.id);

                }
            }
        });
    });
    //Updates Customer Management Record
    $('#submitCollapseCm').on('click', function () {
        var id = $('#submitCollapseCm').attr('data-id');
        var cmt = $('#collapseCmForm select[name=cmt]').val();
        var description = $('#collapseCmForm input[name=description]').val();
        var date = $('#collapseCmForm input[name=date]').val();
        var time = $('#collapseCmForm input[name=time]').val();
        $.ajax({
            'url': '/admin/dashboard/customerManagement/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                cmt: cmt,
                description: description,
                date: date,
                time: time
            },
            success: function (response) {
                $('#toEditCollapseCmt,#toEditCollapseCmDate,#toEditCollapseCmTime').text('');
                if (!$.isEmptyObject(response.collapseCmError)) {
                    if (!$.isEmptyObject(response.collapseCmError.cmt)) {
                        $('#toEditCollapseCmt').text(response.collapseCmError.cmt[0]);
                    }
                    if (!$.isEmptyObject(response.collapseCmError.date)) {
                        $('#toEditCollapseCmDate').text(response.collapseCmError.date[0]);
                    }
                    if (!$.isEmptyObject(response.collapseCmError.time)) {
                        $('#toEditCollapseCmTime').text(response.collapseCmError.time[0]);
                    }
                } else {
                    $('#collapseCm').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-cm[id="' + response.cm[3] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.cm[0]);
                    tr.find('td:eq(2)').text(response.cm[1]);
                    tr.find('td:eq(3)').text(response.cm[2]);
                }
            }
        });
    });
    //Removes Customer Management Record
    $(document).on('click', '.remove-cm', function () {
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
                'url': '/admin/dashboard/customerManagement/' + id,
                'type': 'delete',
                'dataType': 'json',
                data: {id: id},
                context: this,
                success: function (response) {
                    if (response.deleteCm == 'success') {
                        $('.remove-cm[id="' + id + '"]').parents('tr').fadeOut();
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
    //Switches Customer Management Status
    $(document).on('change', '.toggle-cmt', function () {
        var id = $(this).attr('id');
        $.ajax({
            'url': '/admin/dashboard/customer/status/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {id: id}
        });
    });

//Switch Status
    $(document).on('change', '.toggle-status', function () {
        var id = $(this).attr('id');
        $.ajax({
            'url': '/admin/dashboard/user/status/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {id: id}
        });
    });
    //=================== Note Manipulation ============================================================================
    //Creates Note Record
    $(document).on('click', '#submitNote', function () {
        var id = $('input[name=id]').val();
        var description = $('#collapsenote textarea[name=description]').val();
        $.ajax({
            'url': '/admin/dashboard/note/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {
                description: description,
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toCreateNoteDescription').text('');
                if (!$.isEmptyObject(response.noteError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.noteError.description)) {
                        $('#toCreateNoteDescription').text(response.noteError.description[0]);
                    }
                } else if (response.noteCreate == 'submitted') {
                    $('#collapsenote textarea[name=description]').val('').text('');
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
                        '  <td style="width: 55px;">' + response.note[0] + '</td>\n' +
                        '  <td>' + response.note[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-note" id="' + response.note[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-note" id="' + response.note[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#noteTbody').append(html);
                }
            }
        });
    });
    //Gets Note Record And Puts Into Modal For Modification
    $(document).on('click', '.edit-note', function () {
        var id = $(this).attr('id');
        $('#collapseNote').modal('show');
        $.ajax({
            'url': '/admin/dashboard/note/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            data: {id: id},
            success: function (response) {
                if (!$.isEmptyObject(response.note)) {
                    $('#collapseNoteForm textarea[name=description]').val(response.note.description);
                    $('#submitCollapseNote').attr('data-id', response.note.id);
                }
            }
        });
    });
    //Updates Note Record
    $('#submitCollapseNote').on('click', function () {
        var id = $('#submitCollapseNote').attr('data-id');
        var description = $('#collapseNoteForm textarea[name=description]').val();
        $.ajax({
            'url': '/admin/dashboard/note/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                name: name,
                description: description,
            },
            success: function (response) {
                $('#toEditCollapseNoteDescription').text('');
                if (!$.isEmptyObject(response.collapseNoteError)) {
                    if (!$.isEmptyObject(response.collapseNoteError.description)) {
                        $('#toEditCollapseNoteDescription').text(response.collapseNoteError.description[0]);
                    }
                } else {
                    $('#collapseNote').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-note[id="' + response.note[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.note[0]);
                }
            }
        });
    });
    //Removes Note Record
    $(document).on('click', '.remove-note', function () {
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
                'url': '/admin/dashboard/note/' + id,
                'type': 'delete',
                'dataType': 'json',
                data: {id: id},
                context: this,
                success: function (response) {
                    if (response.deleteNote == 'success') {
                        $('.remove-note[id="' + id + '"]').parents('tr').fadeOut();
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


    //=================== File Manipulation ============================================================================
    //Creates File Record
    $(document).on('click', '#submitFile', function () {
        var id = $('input[name=id]').val();
        var file = new FormData($("#collapsefile")[0]);
        $.ajax({
            'url': '/admin/dashboard/file/' + id,
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
                        '  <td style="width: 120px;">\n' +
                        '  <a href="/admin/dashboard/download/' + response.file[4] + '/' + id + '?mac=' + response.file[3] + '" class="btn btn-success btn-sm download-file" id="' + response.file[4] + '"><i class="d-inline-flex align-middle ti-download ml-1"></i>دانلود </a>\n' +
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
                'url': '/admin/dashboard/file/' + id,
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


    //Switches Task Status
    $(document).on('change', '.toggle-task', function () {
        var id = $(this).attr('id');
        $.ajax({
            'url': '/admin/dashboard/task/status/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {id: id}
        });
    });

    //======================== Deletes Primary User ====================================================================
    $(document).on('click', '.delete-user', function () {
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

    //======================== Deletes Admin ===========================================================================
    $(document).on('click', '.delete-admin', function () {
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

    //======================== Deletes Task ============================================================================
    $(document).on('click', '.delete-task', function () {
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

    //======================== Filters Primary Users ===================================================================
    $(document).on('click', '#filterPUser', function () {
        var from_date = $('input[name=from_date]').val();
        var to_date = $('input[name=to_date]').val();
        $.ajax({
            'url': '/admin/dashboard/filter/PUser',
            'type': 'get',
            'dataType': 'json',
            data: {from_date: from_date, to_date: to_date},
            beforeSend: function () {
            },
            complete: function () {

            },
            success: function (response) {
                $('#toFilterPUserFrom,#toFilterPUserTo').text('');
                if (!$.isEmptyObject(response.dateError)) {
                    if (!$.isEmptyObject(response.dateError.from_date)) {
                        $('#toFilterPUserFrom').text(response.dateError.from_date[0]);
                    }
                    if (!$.isEmptyObject(response.dateError.to_date)) {
                        $('#toFilterPUserTo').text(response.dateError.to_date[0]);
                    }
                } else if (response.check == 'inputs') {
                    swal({
                        title: "ورودی های خود را بررسی کنید!",
                        text: "",
                        type: "warning",
                        confirmButtonColor: "#8CD4F5",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });

                } else {
                    var table = $('#sort-table-1').DataTable();
                    table.clear().draw();
                    if ($.type(response.html) !== 'string') {
                        for (var i = 0; i < response.html.length; i++) {
                            var visas = '';
                            if (response.html[i].visas.length == 0) {
                                visas = '-';
                            } else {
                                for (var j = 0; j < response.html[i].visas.length; j++) {
                                    visas += '<span class="label label-table label-purple">' + response.html[i].visas[j] + '</span> ';
                                }
                            }
                            table.row.add([
                                i + 1,
                                response.html[i].user_uid,
                                response.html[i].name,
                                visas,
                                response.html[i].cmt_title,
                                '  <a href="' + response.html[i].edit_url + '" class="btn btn-success btn-sm"><i  class="d-inline-flex align-middle ti-pencil ml-1"></i> ویرایش</a>\n' +
                                ' <button type="button" class="btn btn-danger btn-sm delete-user"\n' +
                                '                                                id="' + response.html[i].id + '"><i\n' +
                                '                                                    class="d-inline-flex align-middle ti-close"></i></button>\n' +
                                '                                        <form method="post" action="' + response.html[i].destroy_url + '"\n' +
                                '                                              id="' + response.html[i].id + '">\n' +
                                '                                            <input type="hidden" name="_token" value="' + response.html[i].token + '">\n' +
                                '                                           <input type="hidden" name="_method" value="DELETE">\n' +
                                '                                        </form>'

                            ]).draw(true);
                        }
                    }
                }
            }
        });
    });

    //======================== Filters Secondary Users =================================================================
    $(document).on('click', '#filterSUser', function () {
        var from_date = $('input[name=from_date]').val();
        var to_date = $('input[name=to_date]').val();
        $.ajax({
            'url': '/admin/dashboard/filter/SUser',
            'type': 'get',
            'dataType': 'json',
            data: {from_date: from_date, to_date: to_date},
            beforeSend: function () {
            },
            complete: function () {

            },
            success: function (response) {
                $('#toFilterSUserFrom,#toFilterSUserTo').text('');
                if (!$.isEmptyObject(response.dateError)) {
                    if (!$.isEmptyObject(response.dateError.from_date)) {
                        $('#toFilterSUserFrom').text(response.dateError.from_date[0]);
                    }
                    if (!$.isEmptyObject(response.dateError.to_date)) {
                        $('#toFilterSUserTo').text(response.dateError.to_date[0]);
                    }
                } else if (response.check == 'inputs') {
                    swal({
                        title: "ورودی های خود را بررسی کنید!",
                        text: "",
                        type: "warning",
                        confirmButtonColor: "#8CD4F5",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });

                } else {
                    var table = $('#sort-table-1').DataTable();
                    table.clear().draw();
                    if ($.type(response.html) !== 'string') {
                        for (var i = 0; i < response.html.length; i++) {
                            table.row.add([
                                i + 1,
                                response.html[i].primary_uid,
                                response.html[i].primary_name,
                                response.html[i].user_name,
                                response.html[i].connection_title,
                                '  <a href="' + response.html[i].edit_url + '" class="btn btn-success btn-sm"><i  class="d-inline-flex align-middle ti-pencil ml-1"></i> ویرایش</a>\n' +
                                ' <button type="button" class="btn btn-danger btn-sm delete-user"\n' +
                                '                                                id="' + response.html[i].id + '"><i\n' +
                                '                                                    class="d-inline-flex align-middle ti-close"></i></button>\n' +
                                '                                        <form method="post" action="' + response.html[i].destroy_url + '"\n' +
                                '                                              id="' + response.html[i].id + '">\n' +
                                '                                            <input type="hidden" name="_token" value="' + response.html[i].token + '">\n' +
                                '                                           <input type="hidden" name="_method" value="DELETE">\n' +
                                '                                        </form>'

                            ]).draw(true);
                        }
                    }
                }
            }
        });
    });

    //======================== Filters Tasks ===========================================================================
    $(document).on('click', '#filterTask', function () {
        var from_date = $('input[name=from_date]').val();
        var to_date = $('input[name=to_date]').val();
        var type = $('select[name=type]').val();
        $.ajax({
            'url': '/admin/dashboard/filter/task',
            'type': 'get',
            'dataType': 'json',
            data: {from_date: from_date, to_date: to_date, type: type},
            beforeSend: function () {
            },
            complete: function () {

            },
            success: function (response) {
                $('#toFilterTaskFrom,#toFilterTaskTo').text('');
                if (!$.isEmptyObject(response.dateError)) {
                    if (!$.isEmptyObject(response.dateError.from_date)) {
                        $('#toFilterTaskFrom').text(response.dateError.from_date[0]);
                    }
                    if (!$.isEmptyObject(response.dateError.to_date)) {
                        $('#toFilterTaskTo').text(response.dateError.to_date[0]);
                    }
                } else if (response.check == 'inputs') {
                    swal({
                        title: "ورودی های خود را بررسی کنید!",
                        text: "",
                        type: "warning",
                        confirmButtonColor: "#8CD4F5",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });

                } else {
                    var table = $('#sort-table-1').DataTable();
                    table.clear().draw();
                    if ($.type(response.html) !== 'string') {
                        for (var i = 0; i < response.html.length; i++) {
                            if (response.html[i].status == '0') {
                                var checked = '';
                            } else {
                                var checked = 'checked';
                            }
                            table.row.add([
                                i + 1,
                                response.html[i].from_name,
                                response.html[i].to_name,
                                response.html[i].created_at,
                                response.html[i].date,
                                response.html[i].description,
                                '<input type="checkbox" class="js-switch toggle-task new-switch" data-color="#009efb" ' + checked + ' id="' + response.html[i].id + '"/>',
                                '  <a href="' + response.html[i].edit_url + '" class="btn btn-success btn-sm"><i  class="d-inline-flex align-middle ti-pencil ml-1"></i> ویرایش</a>\n' +
                                ' <button type="button" class="btn btn-danger btn-sm delete-task"\n' +
                                '                                                id="' + response.html[i].id + '"><i\n' +
                                '                                                    class="d-inline-flex align-middle ti-close"></i></button>\n' +
                                '                                        <form method="post" action="' + response.html[i].destroy_url + '"\n' +
                                '                                              id="\'+ response.html[i].id +\'">\n' +
                                '                                            <input type="hidden" name="_token" value="' + response.html[i].token + '">\n' +
                                '                                           <input type="hidden" name="_method" value="DELETE">\n' +
                                '                                        </form>',

                            ]).draw(true);
                        }
                        var data = table.rows().data();
                        data.each(function (value, index) {
                            var input = table.cell(index, 6).nodes().to$().find('input');
                            var elems = Array.prototype.slice.call(input);
                            elems.forEach(function (html) {
                                var switchery = new Switchery(html);
                            });
                        });
                    }
                }
            }
        });
    });


    //=================== Customer Management Manipulation =============================================================
    //Customer Management Record
    $(document).on('click', '#submitCmt', function () {
        var title = $('#collapsemanagement input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/customerManagementTitle',
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
                $('#toCreateCmt').text('');
                if (!$.isEmptyObject(response.cmtError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.cmtError.title)) {
                        $('#toCreateCmt').text(response.cmtError.title[0]);
                    }
                } else if (response.cmtCreate == 'submitted') {
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
                        '  <td style="width: 55px;">' + response.cmt[0] + '</td>\n' +
                        '  <td>' + response.cmt[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-cmt" id="' + response.cmt[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-cmt" id="' + response.cmt[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#cmtTbody').append(html);
                }
            }
        });
    });
    //Gets Customer Management Record And Puts Into Modal For Modification
    $(document).on('click', '.edit-cmt', function () {
        var id = $(this).attr('id');
        $('#collapseCmt').modal('show');
        $.ajax({
            'url': '/admin/dashboard/customerManagementTitle/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            data: {id: id},
            success: function (response) {
                if (!$.isEmptyObject(response.cmt)) {
                    $('#collapseCmtForm input[name=title]').val(response.cmt.title);
                    $('#submitCollapseCmt').attr('data-id', response.cmt.id);
                }
            }
        });
    });
    //Updates Customer Management  Record
    $('#submitCollapseCmt').on('click', function () {
        var id = $('#submitCollapseCmt').attr('data-id');
        var title = $('#collapseCmtForm input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/customerManagementTitle/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
            },
            success: function (response) {
                $('#toEditCollapseCmt').text('');
                if (!$.isEmptyObject(response.collapseCmtError)) {
                    if (!$.isEmptyObject(response.collapseCmtError.title)) {
                        $('#toEditCollapseCmt').text(response.collapseCmtError.title[0]);
                    }
                } else {
                    $('#collapseCmt').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-cmt[id="' + response.cmt[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.cmt[0]);
                }
            }
        });
    });
    //Removes Customer Management  Record
    $(document).on('click', '.remove-cmt', function () {
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
                'url': '/admin/dashboard/customerManagementTitle/' + id,
                'type': 'delete',
                'dataType': 'json',
                data: {id: id},
                context: this,
                success: function (response) {
                    if (response.deleteCmt == 'success') {
                        $('.remove-cmt[id="' + id + '"]').parents('tr').fadeOut();
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


    //======================== Filters Todos ===========================================================================
    $(document).on('click', '#filterTodos', function () {
        var from_date = $('input[name=from_date]').val();
        var to_date = $('input[name=to_date]').val();
        var type = $('select[name=type]').val();
        $.ajax({
            'url': '/admin/dashboard/filter/todos',
            'type': 'get',
            'dataType': 'json',
            data: {from_date: from_date, to_date: to_date, type: type},
            beforeSend: function () {
            },
            complete: function () {

            },
            success: function (response) {
                $('#toFilterTodosFrom,#toFilterTodosTo').text('');
                if (!$.isEmptyObject(response.dateError)) {
                    if (!$.isEmptyObject(response.dateError.from_date)) {
                        $('#toFilterTodosFrom').text(response.dateError.from_date[0]);
                    }
                    if (!$.isEmptyObject(response.dateError.to_date)) {
                        $('#toFilterTodosTo').text(response.dateError.to_date[0]);
                    }
                } else if (response.check == 'inputs') {
                    swal({
                        title: "ورودی های خود را بررسی کنید!",
                        text: "",
                        type: "warning",
                        confirmButtonColor: "#8CD4F5",
                        confirmButtonText: "تایید",
                        closeOnConfirm: true
                    });

                } else {
                    var table = $('#sort-table-1').DataTable();
                    table.clear().draw();
                    if ($.type(response.html) !== 'string') {
                        for (var i = 0; i < response.html.length; i++) {
                            if (response.html[i].status == '0') {
                                var checked = '';
                            } else {
                                var checked = 'checked';
                            }
                            table.row.add([
                                i + 1,
                                'VN-' + response.html[i].user_uid,
                                response.html[i].user_name,
                                response.html[i].cmt_title,
                                response.html[i].reminder_date,
                                '<input type="checkbox" class="js-switch toggle-cmt new-switch" data-color="#009efb" ' + checked + ' id="' + response.html[i].id + '"/>',
                                '  <a href="' + response.html[i].href + '" class="btn btn-success btn-sm"><i class="d-inline-flex align-middle ti-eye ml-1"></i>مشاهده پرونده</a>'
                            ]).draw(true);
                        }
                        var data = table.rows().data();
                        data.each(function (value, index) {
                            var input = table.cell(index, 5).nodes().to$().find('input');
                            var elems = Array.prototype.slice.call(input);
                            elems.forEach(function (html) {
                                var switchery = new Switchery(html);
                            });
                        });
                    }
                }
            }
        });
    });


    $('form.app-search input').keyup(function (e) {
        var val = $(this).val();
        if (val == '') {
            $('form.app-search .list-group').empty();
        } else {
            $.ajax({
                'url': '/admin/dashboard/search',
                'type': 'get',
                'dataType': 'json',
                data: {val: val},
                success: function (response) {
                    $('form.app-search .list-group').empty();
                    if (response.records == 'none') {
                        var html = '<a href="#" class="list-group-item list-group-item-action">نتیجه ای یافت نشد.</a>';
                        $('form.app-search .list-group').append(html);
                    } else {
                        var html = '';
                        for (var i = 0; i < response.records.length; i++) {
                            html += '<a href="' + response.records[i]['link'] + '" class="list-group-item list-group-item-action">' + response.records[i]['name'] + '</a>';
                        }
                        $('form.app-search .list-group').append(html);
                    }
                }
            });
        }

    });
    //======================== Deletes Slider ==========================================================================
    $(document).on('click', '.delete-slider', function () {
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
    //======================== Deletes Communication Lines =============================================================
    $(document).on('click', '.delete-sms-sender', function () {
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
    //======================== Deletes SMS Drafts ======================================================================
    $(document).on('click', '.delete-sms-draft', function () {
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
    //==================== Gets Sms Services Username And Password On Change ===========================================
    $('.service-select').on('change', function () {
        var service = $(this).val();
        $.ajax({
            'url': '/admin/dashboard/sms/setting/getCredentials',
            'type': 'get',
            'dataType': 'json',
            data: {service: service},
            success: function (response) {
                if (response.credentials != 'empty') {
                    $('input[name=username]').val(response.username);
                    $('input[name=password]').val(response.password);
                    $('input[name=p_confirm_code]').val(response.p_confirm_code);
                    $('input[name=p_notif]').val(response.p_notif);
                    $('input[name=p_ticket]').val(response.p_ticket);
                    $('input[name=p_password]').val(response.p_password);

                }
            }
        });
    });


    //=================== guarantee category Manipulation ============================================================================

    $(document).on('click', '#submitGuarantee', function () {
        var title = $('#collapseGuarantee input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/guarantee-category',
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
                    if (!$.isEmptyObject(response.guaranteeError.title)) {
                        $('#toCreateGuaranteee').text(response.guaranteeError.title[0]);
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
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.guarantee[0] + '</td>\n' +
                        '  <td>' + response.guarantee[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-visa" id="' + response.guarantee[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-visa" id="' + response.guarantee[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
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
            'url': '/admin/dashboard/guarantee-category/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.guarantee)) {
                    $('#collapseGuaranteeForm input[name=title]').val(response.guarantee.title);
                    $('#submitCollapseGuarantee').attr('data-id', response.guarantee.id);
                }
            }
        });
    });
    $('#submitCollapseGuarantee').on('click', function () {
        var id = $('#submitCollapseGuarantee').attr('data-id');
        var title = $('#collapseGuaranteeForm input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/guarantee-category/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
            },
            success: function (response) {
                $('#toEditCollapseGuarantee').text('');
                if (!$.isEmptyObject(response.collapseGuaranteeError)) {
                    if (!$.isEmptyObject(response.collapseGuaranteeError.title)) {
                        $('#toEditCollapseGuarantee').text(response.collapseGuaranteeError.title[0]);
                    }
                } else {
                    $('#collapseGuaranteeEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-guarantee[id="' + response.guarantee[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.guarantee[0]);
                }
            }
        });
    });
    $(document).on('click', '.remove-guarantee', function () {
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
                'url': '/admin/dashboard/guarantee-category/' + id,
                'type': 'delete',
                'dataType': 'json',
                context: this,
                success: function (response) {
                    if (response.deleteGuarantee == 'success') {
                        $('.remove-guarantee[id="' + id + '"]').parents('tr').fadeOut();
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


    //=================== financial claim category Manipulation ============================================================================

    $(document).on('click', '#submitFc', function () {
        var title = $('#collapseFc input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/finance-claim-category',
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
                $('#toCreateGuarantee').text('');
                if (!$.isEmptyObject(response.fcError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.fcError.title)) {
                        $('#toCreateFc').text(response.fcError.title[0]);
                    }
                } else if (response.fcCreate == 'submitted') {
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
                        '  <td style="width: 55px;">' + response.fc[0] + '</td>\n' +
                        '  <td>' + response.fc[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-fc" id="' + response.fc[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-fc" id="' + response.fc[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#guaranteeBody').append(html);
                }
            }
        });
    });

    $(document).on('click', '.edit-fc', function () {
        var id = $(this).attr('id');
        $('#collapseFcEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/finance-claim-category/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.fc)) {
                    $('#collapseFcForm input[name=title]').val(response.fc.title);
                    $('#submitCollapseFc').attr('data-id', response.fc.id);
                }
            }
        });
    });
    $('#submitCollapseFc').on('click', function () {
        var id = $('#submitCollapseFc').attr('data-id');
        var title = $('#collapseFcForm input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/finance-claim-category/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
            },
            success: function (response) {
                $('#toEditCollapseFc').text('');
                if (!$.isEmptyObject(response.collapseFcError)) {
                    if (!$.isEmptyObject(response.collapseFcError.title)) {
                        $('#toEditCollapseFc').text(response.collapseFcError.title[0]);
                    }
                } else {
                    $('#collapseFcEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-fc[id="' + response.fc[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.fc[0]);
                }
            }
        });
    });
    $(document).on('click', '.remove-fc', function () {
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
                'url': '/admin/dashboard/finance-claim-category/' + id,
                'type': 'delete',
                'dataType': 'json',
                context: this,
                success: function (response) {
                    if (response.deleteFc == 'success') {
                        $('.remove-fc[id="' + id + '"]').parents('tr').fadeOut();
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

    //=================== credits category Manipulation ============================================================================

    $(document).on('click', '#submitCredit', function () {
        var title = $('#collapseFc input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/credit-category',
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
                    if (!$.isEmptyObject(response.creditError.title)) {
                        $('#toCreateCredit').text(response.creditError.title[0]);
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
                    var html = '<tr>\n' +
                        '  <td style="width: 55px;">' + response.credit[0] + '</td>\n' +
                        '  <td>' + response.credit[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-credit" id="' + response.credit[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-credit" id="' + response.credit[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#CreditBody').append(html);
                }
            }
        });
    });

    $(document).on('click', '.edit-credit', function () {
        var id = $(this).attr('id');
        $('#collapseCreditEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/credit-category/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.credit)) {
                    $('#collapseCreditForm input[name=title]').val(response.credit.title);
                    $('#submitCollapseCredit').attr('data-id', response.credit.id);
                }
            }
        });
    });
    $('#submitCollapseCredit').on('click', function () {
        var id = $('#submitCollapseCredit').attr('data-id');
        var title = $('#collapseCreditForm input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/credit-category/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
            },
            success: function (response) {
                $('#toEditCollapseCredit').text('');
                if (!$.isEmptyObject(response.collapseCreditError)) {
                    if (!$.isEmptyObject(response.collapseCreditError.title)) {
                        $('#toEditCollapseCredit').text(response.collapseCreditError.title[0]);
                    }
                } else {
                    $('#collapseCreditEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-credit[id="' + response.credit[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.credit[0]);
                }
            }
        });
    });
    $(document).on('click', '.remove-credit', function () {
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
                'url': '/admin/dashboard/category/' + id,
                'type': 'delete',
                'dataType': 'json',
                context: this,
                success: function (response) {
                    if (response.deleteCredit == 'success') {
                        $('.remove-credit[id="' + id + '"]').parents('tr').fadeOut();
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
    //=================== credits category Manipulation ============================================================================

    $(document).on('click', '#submitCat', function () {
        var title = $('#collapseCat input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/category',
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
                $('#toCreateCat').text('');
                if (!$.isEmptyObject(response.catError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.catError.title)) {
                        $('#toCreateCat').text(response.catError.title[0]);
                    }
                } else if (response.catCreate == 'submitted') {
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
                        '  <td style="width: 55px;">' + response.cat[0] + '</td>\n' +
                        '  <td>' + response.cat[1] + '</td>\n' +
                        '  <td style="width: 120px;">\n' +
                        '  <button class="btn btn-success btn-sm edit-cat" id="' + response.cat[2] + '"><i class="d-inline-flex align-middle ti-pencil ml-1"></i>ویرایش </button>\n' +
                        '  <button class="btn btn-danger btn-sm remove-cat" id="' + response.cat[2] + '"><i class="d-inline-flex align-middle ti-close"></i></button>\n' +
                        '  </td>\n' +
                        '   </tr>';
                    $('#catBody').append(html);
                }
            }
        });
    });

    $(document).on('click', '.edit-cat', function () {
        var id = $(this).attr('id');
        $('#collapseCatEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/category/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.cat)) {
                    $('#collapseCatForm input[name=title]').val(response.cat.title);
                    $('#submitCollapseCat').attr('data-id', response.cat.id);
                }
            }
        });
    });
    $('#submitCollapseCat').on('click', function () {
        var id = $('#submitCollapseCat').attr('data-id');
        var title = $('#collapseCatForm input[name=title]').val();
        $.ajax({
            'url': '/admin/dashboard/category/' + id,
            'type': 'patch',
            'dataType': 'json',
            data: {
                title: title,
            },
            success: function (response) {
                $('#toEditCollapseCat').text('');
                if (!$.isEmptyObject(response.collapseCatError)) {
                    if (!$.isEmptyObject(response.collapseCatError.title)) {
                        $('#toEditCollapseCat').text(response.collapseCatError.title[0]);
                    }
                } else {
                    $('#collapseCatEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'اطلاعات به روزرسانی شد',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'success',
                        hideAfter: 3500
                    });
                    var tr = $('button.edit-cat[id="' + response.cat[1] + '"]').parents('tr');
                    tr.find('td:eq(1)').text(response.cat[0]);
                }
            }
        });
    });
    $(document).on('click', '.remove-cat', function () {
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
                'url': '/admin/dashboard/category/' + id,
                'type': 'delete',
                'dataType': 'json',
                context: this,
                success: function (response) {
                    if (response.deleteCash == 'success') {
                        $('.remove-cat[id="' + id + '"]').parents('tr').fadeOut();
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
    //=================== wysiwyg Manipulation ============================================================================
    if ($('#wysiwyg').length) {
        CKEDITOR.replace('wysiwyg');
    }
    if ($('#ChartTrafficMonthly').length) {
        $.ajax({
            url: '/admin/dashboard/getMonthlyRecord',
            type: 'get',
            dataType: 'json',
            success: function (response) {
                var ctx1 = document.getElementById("ChartTrafficMonthly").getContext("2d");
                var data1 = {
                    labels: response.labels,
                    datasets: [
                        {
                            label: "تراکنش های دریافتی",
                            fillColor: "rgba(0,200,00,0.65)",
                            strokeColor: "rgba(152,235,239,0.8)",
                            pointColor: "rgba(0,245,00,0.8)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(152,235,239,1)",
                            data: response.data
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
                    responsive: true
                });
            }
        });
    }
});
