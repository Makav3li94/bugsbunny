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
    $(document).on('click', '.delete-section', function () {
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


    //Gets Questions Record And Puts Into Modal For Modification
    $(document).on('click', '.edit-question', function () {
        var id = $(this).attr('id');
        $('#collapseQuestionEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/question/' + id + '/edit',
            'type': 'get',
            'dataType': 'json',
            data: {id: id},
            success: function (response) {
                if (!$.isEmptyObject(response.question)) {
                    $('#collapseQuestionForm input[name=question]').val(response.question[0].question);
                    $('#collapseQuestionForm textarea[name=explanation]').val(response.question[0].explanation);
                    $('#collapseQuestionForm input[name=unit]').val(response.question[0].unit);
                    if (response.question[0].is_active == '1') {
                        $('#questin_is_active').prop('checked', true).trigger('click');
                    }
                    CKEDITOR.replace('editor3', {
                        contentsLangDirection: 'rtl',
                        // language: 'fa',
                        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
                        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
                        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
                        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}'

                    });
                    var data = response.question[0].answers;
                    $.each(data, function (key) {
                        $('#collapseQuestionForm #answer' + key + '').val(data[key].answer);
                        if (data[key].is_checked == '1') {
                            $('#collapseQuestionForm #is_active_answer' + key + '').prop('checked', true).trigger('click');
                        }
                    });
                    $('#collapseQuestionForm').attr('action', '/admin/dashboard/question/' + id,);
                }
            }
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


    // Score Manipulation
    $(document).on('click', '.edit-score', function () {
        var id = $(this).attr('id');

        $('#collapseScoreEdit').modal('show');

        $('#submitCollapseScore').attr('data-id', id);

    });

    $('#submitCollapseScore').on('click', function () {
        console.log(111)
        var id = $('#submitCollapseScore').attr('data-id');
        var score = $('#collapseScoreForm input[name=score]').val();
        var type = 0;
        if ($('#collapseScoreForm input[name=type]').is(":checked")) {
            type = 1
        }
        console.log(123)
        $.ajax({
            'url': '/admin/dashboard/score/' + id,
            'type': 'post',
            'dataType': 'json',
            data: {
                score: score,
                type: type,
            },
            success: function (response) {
                if (response.scoreCreate == 'submitted') {
                    $('#collapseScoreEdit').modal('hide');
                    $.toast({
                        heading: 'موفقیت!',
                        text: 'امتیاز اختصاص یافت.',
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


    // Menu Manipulation

    $(document).on('click', '.edit-menu', function () {
        var id = $(this).attr('id');
        $('#collapseMenuEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/front/menus/' + id,
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.menu)) {
                    $('#collapseMenuForm input[name=title]').val(response.menu.title);
                    $('#collapseMenuForm input[name=link]').val(response.menu.link);
                    $('#collapseMenuForm').attr('action', '/admin/dashboard/front/menus/' + id,);
                    $("#collapseMenuForm select").val(response.menu.type);
                    $('#submitCollapseMenu').attr('data-id', response.menu.id);
                }
            }
        });
    });
    // Feature Manipulation

    $(document).on('click', '.edit-feature', function () {
        var id = $(this).attr('id');
        $('#collapseFeatureEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/front/features/' + id,
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.feature)) {
                    $('#collapseFeatureForm input[name=title]').val(response.feature.title);
                    $('#collapseFeatureForm input[name=sub]').val(response.feature.sub);
                    $('#collapseFeatureForm').attr('action', '/admin/dashboard/front/features/' + id,);
                    $('#frontFeatureIcon').attr('src',response.feature.icon);
                    $('#submitCollapseFeature').attr('data-id', response.feature.id);
                }
            }
        });
    });

    // way Manipulation

    $(document).on('click', '.edit-way', function () {
        var id = $(this).attr('id');
        $('#collapseWayEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/front/way/' + id,
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.way)) {
                    $('#collapseWayForm input[name=title]').val(response.way.title);
                    $('#collapseWayForm input[name=sub]').val(response.way.sub);
                    $('#collapseWayForm').attr('action', '/admin/dashboard/front/way/' + id,);
                    $('#frontWayIcon').attr('src',response.way.icon);
                    $('#submitCollapseWay').attr('data-id', response.way.id);
                }
            }
        });
    });

    // way Manipulation

    $(document).on('click', '.edit-social', function () {
        var id = $(this).attr('id');
        $('#collapseSocialEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/front/social/' + id,
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.social)) {
                    $('#collapseSocialForm input[name=title]').val(response.social.title);
                    $('#collapseSocialForm input[name=link]').val(response.social.link);
                    $('#collapseSocialForm').attr('action', '/admin/dashboard/front/social/' + id,);
                    $('#frontSocialIcon').attr('src',response.social.icon);
                    $('#submitCollapseSocial').attr('data-id', response.social.id);
                }
            }
        });
    });

    // faq Manipulation

    $(document).on('click', '.edit-faq', function () {
        var id = $(this).attr('id');
        $('#collapseFaqEdit').modal('show');
        $.ajax({
            'url': '/admin/dashboard/front/faq/' + id,
            'type': 'get',
            'dataType': 'json',

            success: function (response) {
                if (!$.isEmptyObject(response.faq)) {
                    $('#collapseFaqForm input[name=question]').val(response.faq.question);
                    $('#collapseFaqForm input[name=answer]').val(response.faq.answer);
                    $('#collapseFaqForm').attr('action', '/admin/dashboard/front/faq/' + id,);
                    $('#submitCollapseFaq').attr('data-id', response.faq.id);
                }
            }
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
