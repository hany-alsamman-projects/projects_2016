$(document).ready(function() {
    /***************** Smooth Scrolling ******************/

    function niceScrollInit(){
        $("html").niceScroll({
            background: '#000',
            scrollspeed: 60,
            mousescrollstep: 35,
            cursorwidth: 15,
            cursorborder: 0,
            cursorcolor: '#FFF',
            cursorborderradius: 6,
            autohidemode: false
        });
        
        $('body, body header').css('padding-right','15px');
    }
    niceScrollInit();
    var $smoothActive = $('body').attr('data-smooth-scrolling'); 
    if( $smoothActive == 1 && $(window).width() > 690){ niceScrollInit(); }
    
    /*ONE PAGE NAV*/
    $('.nav.js nav').onePageNav({
        filter : ':not(.external)',
        scrollThreshold : 0.25
    });
    $('.mob_nav.js ul').onePageNav({
        filter : ':not(.external)',
        scrollThreshold : 0.25
    });
    $('.trigger').toggle(function(){
        $(this).next().slideDown('normal');
    },function(){
        $(this).next().slideUp('normal');
    });
    /* NAV */
   var aNav = $('nav a');
   
    $('nav a').each(function() {
        $(this).wrapInner('<span class="menu_name"></span>');
        $(this).append('<span class="hover"><span class="arr"></span></span>');
    });
    
    /* BORDERS */
    var w = $(window).width()-15;
    $('.top_box_left, .top_box_right').css('border-left-width', w);
    $('.bot_box_left, .bot_box_right').css('border-right-width', w);
    
    /* CUSTOM */
    $('.lines').each(function(){
       $(this).wrapInner('<span class="plug"></span>');
    }); 
    
    $('.back2top').click(function(){
       $('html, body').animate({scrollTop : 0},'slow');
        return false;
    });
    
    $('a.soc_font').tooltip();
    $('.fsoc').tooltip();
    
    $('.team_photo').hover(function(){
        $(this).find('.team_post').fadeIn('normal');
    },function(){
        $(this).find('.team_post').fadeOut('normal');
    });
    
    $('.speed_box:nth-child(2n+1)').addClass('ipad');
    
    function validateEmail(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(email);
    }
    $('form').submit(function() {
        var a = $(this).find('input[name="name"]').val();
        var b = $(this).find('input[name="email"]').val();
        var c = $(this).find('textarea[name="msg"]').val();
        if (a == "") {
            $('.error_checker').fadeIn("slow").text("Type your name please!");
            return false;
        }
        if (validateEmail(b)) {
        } else {
            $('.error_checker').fadeIn("slow").text("Type your email correctly please!");
            return false;
        }
        if (c == "") {
            $('.error_checker').fadeIn("slow").text("Type your message please!");
            return false;
        }
    });
    
    $('.slide_link').click(function(){
        var target = $(this).attr('href');
        $('html').scrollTo( target, 800 );
        
    })
   
});
/*      SLIDER  */
$(window).load(function() {
    
    $('.flexslider').flexslider({
        animation : "slide",
        controlNav: false
    });
    
    $('.latest_tweet').tweet({
            modpath: "twitter/",                     
            join_text: "auto",
            username: ["GoGetThemes"],
            count: 2,
            auto_join_text_url: "",
            loading_text: "loading tweets...",
            ul_class: "sidebar_tweet",
            template: "{text}{time}"
    });
});

$(window).resize(function() {
    var w = $(window).width()-15;
    $('.top_box_left, .top_box_right').css('border-left-width', w);
    $('.bot_box_left, .bot_box_right').css('border-right-width', w);
});

// CORUSEL
$(function() {

    $.fn.startCarousel = function() {
        var bodywidth = $('body').width(),
            itemwidth = $('.mycarousel li').outerWidth(true),       
            mycontwidth = bodywidth > itemwidth ? bodywidth - bodywidth%itemwidth : itemwidth,
            licount = $('.mycarousel li').size(),
            jscroll = 1;
            
        if(licount > mycontwidth/itemwidth){
            jscroll =  mycontwidth/itemwidth;
        } else {
            jscroll = 0;
            mycontwidth = licount * itemwidth;
        }
        
        $('.mycont').width(mycontwidth);
            
        $('.mycarousel').jcarousel({
            scroll:jscroll
        });
    };
    
    $(this).startCarousel();
    
    $(window).resize(function(){
        $(this).startCarousel();
    }); 
    var carousel = $('.mycarousel');
    $(carousel).jcarousel({
        scroll:1,
        wrap: 'circular'
    });
    
    carousel.touchwipe({
        wipeLeft: function() {
            carousel.jcarousel('next');
        },
        wipeRight: function() {
            carousel.jcarousel('prev');
        }
    });
    
});

// ISOTOPE
$(document).ready(function(){
    $(window).load(function() {
        var iso_w = $('.isotope-item').width()-30;
        var iso_h = $('.isotope-item').height()-60;
        $('.over_box_inner').height(iso_h);
        $("#container").isotope('reLayout');
    });
});
    $(function() {
        $('.gal_box').touchTouch();
        var $container = $('#container');
        var winW = $(window).width();
        if(winW < 768) var colW = $container.width()/2
        if(winW > 768) var colW = $container.width()/3
        
        $container.isotope({
            itemSelector : '.isotope-item',
            masonry : {
                columnWidth : colW
            }
        });

        var $optionSets = $('#options .option-set'), $optionLinks = $optionSets.find('a');

        $optionLinks.click(function() {
            var $this = $(this);
            // don't proceed if already selected
            if ($this.hasClass('selected')) {
                return false;
            }
            var $optionSet = $this.parents('.option-set');
            $optionSet.find('.selected').removeClass('selected');
            $this.addClass('selected');

            // make option object dynamically, i.e. { filter: '.my-filter-class' }
            var options = {}, key = $optionSet.attr('data-option-key'), value = $this.attr('data-option-value');
            // parse 'false' as false boolean
            value = value === 'false' ? false : value;
            options[key] = value;
            if (key === 'layoutMode' && typeof changeLayoutMode === 'function') {
                // changes in layout modes need extra logic
                changeLayoutMode($this, options)
            } else {
                // otherwise, apply new options
                $container.isotope(options);
            }

            return false;
        });
        $('.load_more').click(function(){
            $.ajax({
              url: "more.html",
              cache: false
            }).done(function( more ) {
                var $newEls = $(more);
                $container.append( $newEls ).isotope( 'appended', $newEls );
                var iso_h = $('.isotope-item').height()-60;
                $('.over_box_inner').height(iso_h);
            }); 
            return false;
        });
    });
    
// KNOB
$(document).ready(function($) {
    // Triggering only when it is inside viewport
    $('.knob-1').waypoint(function() {
        // Triggering now
        $('.knob-1').knob();
        // Animating the value
        if ($('.knob-1').val() == 0) {
            $({
                value : 0
            }).animate({
                value : $('.knob-1').attr("data-rel")
                }, {
                duration : 5000,
                easing : 'swing',
                step : function() {
                    $('.knob-1').val(Math.ceil(this.value)).trigger('change');
                }
            });
        }
    }, {
        triggerOnce : true,
        offset : function() {
            return $(window).height() - $(this).outerHeight();
        }
    });
    $('.knob-2').waypoint(function() {
        // Triggering now
        $('.knob-2').knob();
        // Animating the value
        if ($('.knob-2').val() == 0) {
            $({
                value : 0
            }).animate({
                value : $('.knob-2').attr("data-rel")
                }, {
                duration : 5000,
                easing : 'swing',
                step : function() {
                    $('.knob-2').val(Math.ceil(this.value)).trigger('change');
                }
            });
        }
    }, {
        triggerOnce : true,
        offset : function() {
            return $(window).height() - $(this).outerHeight();
        }
    });
    $('.knob-3').waypoint(function() {
        // Triggering now
        $('.knob-3').knob();
        // Animating the value
        if ($('.knob-3').val() == 0) {
            $({
                value : 0
            }).animate({
                value : $('.knob-3').attr("data-rel")
                }, {
                duration : 5000,
                easing : 'swing',
                step : function() {
                    $('.knob-3').val(Math.ceil(this.value)).trigger('change');
                }
            });
        }
    }, {
        triggerOnce : true,
        offset : function() {
            return $(window).height() - $(this).outerHeight();
        }
    });
    $('.knob-4').waypoint(function() {
        // Triggering now
        $('.knob-4').knob();
        // Animating the value
        if ($('.knob-4').val() == 0) {
            $({
                value : 0
            }).animate({
                value : $('.knob-4').attr("data-rel")
                }, {
                duration : 5000,
                easing : 'swing',
                step : function() {
                    $('.knob-4').val(Math.ceil(this.value)).trigger('change');
                }
            });
        }
    }, {
        triggerOnce : true,
        offset : function() {
            return $(window).height() - $(this).outerHeight();
        }
    });
    $('.knob-5').waypoint(function() {
        // Triggering now
        $('.knob-5').knob();
        // Animating the value
        if ($('.knob-5').val() == 0) {
            $({
                value : 0
            }).animate({
                value : $('.knob-5').attr("data-rel")
                }, {
                duration : 5000,
                easing : 'swing',
                step : function() {
                    $('.knob-5').val(Math.ceil(this.value)).trigger('change');
                }
            });
        }
    }, {
        triggerOnce : true,
        offset : function() {
            return $(window).height() - $(this).outerHeight();
        }
    });

});
       