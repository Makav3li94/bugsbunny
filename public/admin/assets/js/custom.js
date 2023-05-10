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

        }
        else {
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

        }
        else if ($(this).hasClass("active")) {
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
        }
        else {
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
        }
        else {
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
            "zeroRecords": "",
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
        , loaderBg: '#03a9f3'
        , icon: 'success'
        , hideAfter: 3500
        , stack: 6
    })
}

// ==============================================================
// Esmaeel Custom JS
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
        $.ajax({
            'url': 'toRegister',
            'type': 'post',
            'dataType': 'json',
            data: {mobile: mobile},
            beforeSend: function () {
                $('#toRegister').css('opacity', '0.4').prop('disabled', true);
                $('#registerInputWrapper .fa-spin').show();
            },
            complete: function () {
                $('#toRegister').css('opacity', '1').prop('disabled', false);
                $('#registerInputWrapper .fa-spin').hide();
            },
            success: function (response) {
                $('#toRegisterError').text('');
                $('#verificationForm input[name=mobile]').val('');
                if (!$.isEmptyObject(response.registerError)) {
                    if (response.registerError == 'userAlreadyExists') {
                        $('#toRegisterError').text('کاربری با این شماره از قبل ثبت نام شده است');
                    }
                    else {
                        $('#toRegisterError').text(response.registerError[0]);
                    }
                }
                else if (response.code == 'sent') {
                    $('#verificationForm input[name=mobile]').val('شماره همراه : ' + response.mobile);
                    $("#registerForm").slideUp();
                    $("#verificationForm").fadeIn();
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
                    }
                    else if (response.verificationError == 'userAlreadyExists') {
                        $('#toCheckCodeError').text('کاربری با این شماره از قبل ثبت نام شده است');
                    }
                    else {
                        $('#toCheckCodeError').text(response.verificationError[0]);
                    }
                }
                else if (response.code == 'correct') {
                    $('#verificationForm').attr('action', '/pageLogin/' + response.id).submit();
                }
            }
        });
    });
    $('#submitConfirmationFields').on('click', function () {

        var id = $('input[name=id]').val();
        var gender = $('select[name=gender]').val();
        var name = $('input[name=name]').val();
        var maritalStatus = $('select[name=maritalStatus]').val();
        var birthDate = $('input[name=birthDate]').val();
        var birthProvince = $('select[name=birthProvince]').val();
        var livingProvince = $('select[name=livingProvince]').val();
        var militaryServiceStatus = $('select[name=militaryServiceStatus]').val();
        var email = $('input[name=email]').val();
        var familiarity = $('select[name=familiarity]').val();
        var country = $('select[name=country]').val();
        var visa = $('select[name=visa]').val();
        var cashToEmigrate = $('select[name=cashToEmigrate]').val();
        var everTraveledToEurope = $('select[name=everTraveledToEurope]').val();
        var everRejectedFromSchengen = $('select[name=everRejectedFromSchengen]').val();
        var badConduct = $('select[name=badConduct]').val();
        var badConductDescription = $('textarea[name=badConductDescription]').val();
        var emigrationReason = $('textarea[name=emigrationReason]').val();
        var description = $('textarea[name=description]').val();
        var password = $('input[name=password]').val();
        var password_confirmation = $('input[name=password_confirmation]').val();
        $.ajax({
            'url': '/toCheckEssentialInfo',
            'type': 'post',
            'dataType': 'json',
            data: {
                id: id,
                gender: gender,
                name: name,
                maritalStatus: maritalStatus,
                birthDate: birthDate,
                birthProvince: birthProvince,
                livingProvince: livingProvince,
                militaryServiceStatus: militaryServiceStatus,
                email: email,
                familiarity: familiarity,
                country: country,
                visa: visa,
                cashToEmigrate: cashToEmigrate,
                everTraveledToEurope: everTraveledToEurope,
                everRejectedFromSchengen: everRejectedFromSchengen,
                badConduct: badConduct,
                badConductDescription: badConductDescription,
                emigrationReason: emigrationReason,
                description: description,
                password: password,
                password_confirmation: password_confirmation
            },
            beforeSend: function () {
                $(".preloader").fadeIn();
            },
            complete: function () {
                $(".preloader").fadeOut();
            },
            success: function (response) {
                $('#toConfirmGender,#toConfirmName,#toConfirmMaritalStatus,#toConfirmBirthDate,#toConfirmBirthProvince,#toConfirmLivingProvince,#toConfirmMilitaryServiceStatus,#toConfirmMilitaryServiceStatus,#toConfirmEmail,#toConfirmFamiliarity,#toConfirmFamiliarity,#toConfirmCountry,#toConfirmVisa,#toConfirmCashToEmigrate,#toConfirmEverTraveledToEurope,#toConfirmEverRejectedFromSchengen,#toConfirmBadConduct,#toConfirmPass,#toConfirmPassConf').text('');
                if (!$.isEmptyObject(response.essentialError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.essentialError.gender)) {
                        $('#toConfirmGender').text(response.essentialError.gender[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.name)) {
                        $('#toConfirmName').text(response.essentialError.name[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.maritalStatusError)) {
                        $('#toConfirmMaritalStatus').text(response.essentialError.maritalStatus[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.birthDate)) {
                        $('#toConfirmBirthDate').text(response.essentialError.birthDate[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.birthProvince)) {
                        $('#toConfirmBirthProvince').text(response.essentialError.birthProvince[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.livingProvince)) {
                        $('#toConfirmLivingProvince').text(response.essentialError.livingProvince[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.militaryServiceStatus)) {
                        $('#toConfirmMilitaryServiceStatus').text(response.essentialError.militaryServiceStatus[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.email)) {
                        $('#toConfirmEmail').text(response.essentialError.email[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.familiarity)) {
                        $('#toConfirmFamiliarity').text(response.essentialError.familiarity[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.country)) {
                        $('#toConfirmCountry').text(response.essentialError.country[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.visa)) {
                        $('#toConfirmVisa').text(response.essentialError.visa[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.cashToEmigrate)) {
                        $('#toConfirmCashToEmigrate').text(response.essentialError.cashToEmigrate[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.everTraveledToEurope)) {
                        $('#toConfirmEverTraveledToEurope').text(response.essentialError.everTraveledToEurope[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.everRejectedFromSchengen)) {
                        $('#toConfirmEverRejectedFromSchengen').text(response.essentialError.everRejectedFromSchengen[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.badConduct)) {
                        $('#toConfirmBadConduct').text(response.essentialError.badConduct[0]);
                    }
                    if (!$.isEmptyObject(response.essentialError.password)) {
                        $('#toConfirmPass, #toConfirmPassConf').text(response.essentialError.password[0]);
                    }
                }
                else {
                    $('#essentialsForm').attr('action', '/essentials/' + response.id).submit();
                }
            }
        });
    });
    $('#primaryEssentialForm #submitPrimaryEssential').on('click', function () {
        var familiarity = $('#primaryEssentialForm select[name=familiarity]').val();
        var name = $('#primaryEssentialForm input[name=name]').val();
        var saham = $('#primaryEssentialForm input[name=saham]').val();
        var role = $('#primaryEssentialForm select[name=role]').val();
        var email = $('#primaryEssentialForm input[name=email]').val();
        $.ajax({
            'url': '/toEditPrimaryEssentialInfo',
            'type': 'post',
            'dataType': 'json',
            data: {
                familiarity: familiarity,
                saham: saham,
                name: name,
                role: role,
                email: email
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toEditSaham,#toEditName,#toEditRole,#toEditEmail,#toEditFamiliarity').text('');
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
                    if (!$.isEmptyObject(response.primaryEssentialError.saham)) {
                        $('#toEditSaham').text(response.primaryEssentialError.saham[0]);
                    }
                    if (!$.isEmptyObject(response.primaryEssentialError.name)) {
                        $('#toEditName').text(response.primaryEssentialError.name[0]);
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
                    if (!$.isEmptyObject(response.primaryEssentialError.company_role_id)) {
                        $('#toEditRole').text(response.primaryEssentialError.company_role_id[0]);
                    }
                }
                else {
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
    $('#secondaryEssentialForm #submitSecondaryEssential').on('click', function () {
        var country = $('#secondaryEssentialForm select[name=country]').val();
        var visa = $('#secondaryEssentialForm select[name=visa]').val();
        var cashToEmigrate = $('#secondaryEssentialForm select[name=cashToEmigrate]').val();
        var everTraveledToEurope = $('#secondaryEssentialForm select[name=everTraveledToEurope]').val();
        var everRejectedFromSchengen = $('#secondaryEssentialForm select[name=everRejectedFromSchengen]').val();
        var badConduct = $('#secondaryEssentialForm select[name=badConduct]').val();
        var badConductDescription = $('#secondaryEssentialForm textarea[name=badConductDescription]').val();
        var emigrationReason = $('#secondaryEssentialForm textarea[name=emigrationReason]').val();
        var description = $('#secondaryEssentialForm textarea[name=description]').val();
        $.ajax({
            'url': '/toEditSecondaryEssentialInfo',
            'type': 'post',
            'dataType': 'json',
            data: {
                country: country,
                visa: visa,
                cashToEmigrate: cashToEmigrate,
                everTraveledToEurope: everTraveledToEurope,
                everRejectedFromSchengen: everRejectedFromSchengen,
                badConduct: badConduct,
                badConductDescription: badConductDescription,
                emigrationReason: emigrationReason,
                description: description
            },
            beforeSend: function () {
                $('.preloader').fadeIn();
            },
            complete: function () {
                $('.preloader').fadeOut();
            },
            success: function (response) {
                $('#toEditCountry,#toEditVisa,#toEditCashToEmigrate,#toEditEverTraveledToEurope,#toEditEverRejectedFromSchengen,#toEditBadConduct').text('');
                if (!$.isEmptyObject(response.secondaryEssentialError)) {
                    $.toast({
                        heading: 'خطا!',
                        text: 'ورودی های خود را بررسی کنید',
                        position: 'bottom-left',
                        textAlign: 'right',
                        loaderBg: '#ff6849',
                        icon: 'error',
                        hideAfter: 3500
                    });
                    if (!$.isEmptyObject(response.secondaryEssentialError.country)) {
                        $('#toEditCountry').text(response.secondaryEssentialError.country[0]);
                    }
                    if (!$.isEmptyObject(response.secondaryEssentialError.visa)) {
                        $('#toEditVisa').text(response.secondaryEssentialError.visa[0]);
                    }
                    if (!$.isEmptyObject(response.secondaryEssentialError.cashToEmigrate)) {
                        $('#toEditCashToEmigrate').text(response.secondaryEssentialError.cashToEmigrate[0]);
                    }
                    if (!$.isEmptyObject(response.secondaryEssentialError.everTraveledToEurope)) {
                        $('#toEditEverTraveledToEurope').text(response.secondaryEssentialError.everTraveledToEurope[0]);
                    }
                    if (!$.isEmptyObject(response.secondaryEssentialError.everRejectedFromSchengen)) {
                        $('#toEditEverRejectedFromSchengen').text(response.secondaryEssentialError.everRejectedFromSchengen[0]);
                    }
                    if (!$.isEmptyObject(response.secondaryEssentialError.badConduct)) {
                        $('#toEditBadConduct').text(response.secondaryEssentialError.badConduct[0]);
                    }
                }
                else if (response.secondaryEssentials == 'submitted') {
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
            },
        });
    });

});
