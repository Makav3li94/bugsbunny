;(function ($) {
    "use strict";

    /*============= preloader js css =============*/
    var cites = [];
    cites[0] = "ایزباگ، دوست شما !";
    cites[1] = "ایزباگ، دوست شما !";
    cites[2] = "ایزباگ، دوست شما !";
    cites[3] = "ایزباگ، دوست شما !";
    var cite = cites[Math.floor(Math.random() * cites.length)];
    $('#preloader p').text(cite);
    $('#preloader').addClass('loading');

    $(window).on( 'load', function() {
        setTimeout(function () {
            $('#preloader').fadeOut(500, function () {
                $('#preloader').removeClass('loading');
            });
        }, 500);
    })

})(jQuery)
