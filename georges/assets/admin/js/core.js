(function ($, window, document, undefined) {

    // REMOVE CSS FROM ELEMENT
    // ------------------------------------------------------------------------------------------------ * --> 
    $.fn.extend({
        removeCss: function (cssName) {
            return this.each(function () {
                var curDom = $(this);
                jQuery.grep(cssName.split(","),

                function (cssToBeRemoved) {
                    curDom.css(cssToBeRemoved, '');
                });
                return curDom;
            });
        }
    });

    // SIDEBAR RESIZE - CONVERT NAV
    // ------------------------------------------------------------------------------------------------ * --> 
    $(window).resize(function () {
        if ($(window).width() < 767) {
            $('.sidebar').addClass('collapse')
            $('.sidebar, .footer-sidebar').removeCss('display');
        }
        if ($(window).width() > 767) {
            $('.sidebar').removeClass('collapse');
            $('.sidebar').removeCss('height');

            if (!$('body').hasClass('sidebar-hidden')) {
                $('.sidebar, .footer-sidebar').css({
                    'display': 'block'
                });
            } else {
                $('.sidebar, .footer-sidebar').css({
                    'display': 'none'
                });
            }
        }
    });
    $(function () {
        if ($(window).width() < 767) {
            $('.sidebar').addClass('collapse');
        }
        if ($(window).width() > 767) {
            $('.sidebar').removeClass('collapse');
            $('.sidebar').removeCss('height');
        }
    });

    // SIDEBAR - SHOW OR HIDDEN
    // ------------------------------------------------------------------------------------------------ * -->        
    function showSidebar() {
        $('body').removeClass('sidebar-hidden');
        $.cookie('sidebar-pref', null, { expires: 30 });
    };

    function hideSidebar() {
        $('body').addClass('sidebar-hidden');
        $.cookie('sidebar-pref', 'sidebar-hidden', { expires: 30 });
    };

    $("#btnToggleSidebar").click(function () {

        if ($('body').hasClass('sidebar-hidden')) {
            showSidebar();
        } else {
            hideSidebar();
        };
        $(this).toggleClass('fontello-icon-resize-full-2 fontello-icon-resize-small-2');
        $(this).toggleClass('active');
        $('#main-sidebar, #footer-sidebar').animate({
            width: 'toggle'
        }, 0);
    });

    // auto-load preference
    $('body').addClass($.cookie('sidebar-pref'));

    // SIDEBAR - CHANGE SIDEBAR
    // ------------------------------------------------------------------------------------------------ * -->
    $("#btnChangeSidebar").click(function () {
        $(this).toggleClass('fontello-icon-login fontello-icon-logout');
        $('body').toggleClass('sidebar-left sidebar-right');
        //$('#mainSideMenu .chevron').toggleClass('fontello-icon-right-open-3 fontello-icon-left-open-3');
        $(this).toggleClass('active');
    });

    // SIDEBAR - CHANGE SIDEBAR COLOR
    // ------------------------------------------------------------------------------------------------ * -->
    $("#btnChangeSidebarColor").click(function () {
        $('#main-sidebar').toggleClass('sidebar-inverse');
    });

    // SCROLL - NICESCROLL
    // ------------------------------------------------------------------------------------------------ * -->
    // The document page (body)
    //$("html").niceScroll({
    //    zindex:"9999",
    //    cursoropacitymin:0.9,
    //    cursoropacitymax:0.9,
    //    cursorcolor:"#adafb5",
    //    cursorwidth:"8px",
    //    cursorborder:"",
    //    cursorminheight:100,
    //    cursorborderradius:"8px",
    //    usetransition:600,
    //    background:"",
    //    railoffset:{top:10,left:-3},
    //    bouncescroll: true	
    //}); 

    $("#main-sidebar").niceScroll({
        cursoropacitymin: 0.1,
        cursoropacitymax: 0.4,
        cursorcolor: "#adafb5",
        cursorwidth: "6px",
        cursorborder: "",
        cursorborderradius: "6px",
        usetransition: 600,
        background: "",
        railoffset: { top: 10, left: -1 },
        bouncescroll: true,
        horizrailenabled: false
    });

    $(".scrollBox").niceScroll({
        cursoropacitymin: 0.1,
        cursoropacitymax: 0.4,
        cursorcolor: "#adafb5",
        cursorwidth: "6px",
        cursorborder: "",
        cursorborderradius: "6px",
        usetransition: 600,
        background: "",
        railoffset: { top: 10, left: -1 },
        bouncescroll: true
    });

    $(".scrollBox4").niceScroll({
        cursoropacitymin: 0.01,
        cursoropacitymax: 0.4,
        cursorcolor: "#adafb5",
        cursorwidth: "4px",
        cursorborder: "",
        cursorborderradius: "4px",
        usetransition: 1000,
        background: "",
        railoffset: { top: 0, left: -4, },
        bouncescroll: true
    });

    // SCROLL TOP PAGE
    // ------------------------------------------------------------------------------------------------ * -->
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('#btnScrollup').fadeIn('slow');
        } else {
            $('#btnScrollup').fadeOut(600);
        }
    });

    $('#btnScrollup').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, 500);
        return false;
    });

    // BOOTSTRAP TOOLTIP
    // ------------------------------------------------------------------------------------------------ * -->
    $("a[rel=tooltip], input[rel=tooltip] ").tooltip()

    $('.Ttip').tooltip({
        placement: 'top'
    });
    $('.Rtip').tooltip({
        placement: 'right'
    });
    $('.Btip').tooltip({
        placement: 'bottom'
    });
    $('.Ltip').tooltip({
        placement: 'left'
    });

    // GTIP - TOOLTIP
    // ------------------------------------------------------------------------------------------------ * -->
    // assets/plugins/pl-system-info/qtip2/boo/js/jquery.qtip.min.js
    var shared = {
        position: {
            viewport: $(window)
        },
        style: {
            tip: true,
            classes: 'qtip-shadow qtip-tipsy'
        }
    };

    $('.tip-tl').qtip($.extend({}, shared, {
        position: {
            my: 'bottom right',
            at: 'top left'
        }
    }));
    $('.tip-tc, .tip').qtip($.extend({}, shared, {
        position: {
            my: 'bottom center',
            at: 'top center'
        }
    }));
    $('.tip-tr').qtip($.extend({}, shared, {
        position: {
            my: 'bottom left',
            at: 'top right'
        }
    }));
    $('.tip-bl').qtip($.extend({}, shared, {
        position: {
            my: 'top right',
            at: 'bottom left'
        }
    }));
    $('.tip-bc').qtip($.extend({}, shared, {
        position: {
            my: 'top center',
            at: 'bottom center'
        }
    }));
    $('.tip-br').qtip($.extend({}, shared, {
        position: {
            my: 'top left',
            at: 'bottom right'
        }
    }));
    $('.tip-rt').qtip($.extend({}, shared, {
        position: {
            my: 'left bottom',
            at: 'right top'
        }
    }));
    $('.tip-rc').qtip($.extend({}, shared, {
        position: {
            my: 'left center',
            at: 'right center'
        }
    }));
    $('.tip-rb').qtip($.extend({}, shared, {
        position: {
            my: 'left top',
            at: 'right bottom'
        }
    }));
    $('.tip-lt').qtip($.extend({}, shared, {
        position: {
            my: 'right bottom',
            at: 'left top'
        }
    }));
    $('.tip-lc').qtip($.extend({}, shared, {
        position: {
            my: 'right center',
            at: 'left center'
        }
    }));
    $('.tip-lb').qtip($.extend({}, shared, {
        position: {
            my: 'right top',
            at: 'left bottom'
        }
    }));


})(jQuery, this, document);