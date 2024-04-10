(function($) {
    "use strict";


    $('#sponsers').carousel({
        itemWidth: 240,
        itemHeight: 240,
        distance: 12,
        selectedItemDistance: 75,
        selectedItemZoomFactor: 1,
        unselectedItemZoomFactor: 0.5,
        unselectedItemAlpha: 0.6,
        motionStartDistance: 210,
        topMargin: 115,
        gradientStartPoint: 0.35,
        gradientOverlayVisible: 1,
        gradientOverlayColor: "#8F521C",
        gradientOverlaySize: 190,
        selectByClick: true
    });

    $('#support_one').carousel({
        distance: 12,
        selectedItemDistance: 75,
        selectedItemZoomFactor: 1,
        unselectedItemZoomFactor: 0.5,
        unselectedItemAlpha: 0.6,
        motionStartDistance: 210,
        topMargin: 115,
        gradientStartPoint: 0.35,
        gradientOverlayVisible: 1,
        gradientOverlayColor: "#8F521C",
        gradientOverlaySize: 190,
        showContent: 1,
        selectByClick: true
    });

    $('#support_two').carousel({
        distance: 12,
        selectedItemDistance: 75,
        selectedItemZoomFactor: 1,
        unselectedItemZoomFactor: 0.5,
        unselectedItemAlpha: 0.6,
        motionStartDistance: 210,
        topMargin: 115,
        gradientStartPoint: 0.35,
        gradientOverlayVisible: 1,
        gradientOverlayColor: "#8F521C",
        gradientOverlaySize: 190,
        showContent: 1,
        selectByClick: true
    });

    var htmlTag = $('html'),
        device  = false,
        deviceAndroid = false,
        videoBg = false,
        deviceMobile = false,
        notAnimated = false,
        clickActions = Modernizr.touch ? 'touchstart' : 'click';

    if(htmlTag.hasClass('tablet') || htmlTag.hasClass('mobile')){
        device = true;
    }
    if(htmlTag.hasClass('android')){
        deviceAndroid = true;
    }
    if(htmlTag.hasClass('mobile')){
        deviceMobile = true;
    }
    if(htmlTag.find('#wrapper').is('.has-video-background')){
        videoBg = true;
    }
    if(!Modernizr.cssanimations && !Modernizr.csstransitions){
        notAnimated = true;
    }

    var selectors = {
        bigText : '.b-slider-descr:visible > p > span',
        fancyTitle: '.m-fancy-animate .e-large-title',
        switcherSelector: '.b-view-list',
        dropDownTrigger: '.e-dropdown-trigger',
        overlayClass: '.b-loader-overlay',
        portfolioBlock: '.b-portfolio',
        testimonialsBlock: '#testimonialsBlock'
    }
    /* Responsive image init */

    $('.slides-container img').breakpoint();

    /*End responsive image init*/

    /* Query loader init */

    if (device) {
        window.addEventListener("DOMContentLoaded", function () {
            $("body").queryLoader2({
                showbar: "on",
                barColor: "inherit",
                backgroundColor: "#fff",
                percentage: true,
                barHeight: 4,
                completeAnimation: "fade",
                minimumTime: 100,
                onLoadComplete: function(){
                    mainSliderFunctionality();
                    $(selectors.overlayClass).delay(200).animate({'opacity': 0}, function(){
                        $(this).hide().remove();
                    });
                    $('.b-slider-descr:visible > p > span').bigText({
                        limitingDimension: 'width',
                        fontSizeFactor: 1.1
                    });
                }
            });
        });
    } else {
        $("body").queryLoader2({
            showbar: "on",
            barColor: "inherit",
            backgroundColor: "transparent",
            percentage: true,
            barHeight: 4,
            deepSearch: true,
            completeAnimation: "grow",
            minimumTime: 500,
            onLoadComplete: function(){
                mainSliderFunctionality();
                $(selectors.bigText).bigText({
                    limitingDimension: 'width',
                    fontSizeFactor: 1.1
                });
                $(selectors.overlayClass).delay(200).animate({'opacity': 0}, function(){
                    $(this).hide().remove();
                });
            }
        });
    }

    /* End Query loader init */

    /* Background video */

    var wordCarouselInit = function(){
        var container = $('.b-in-main-slider .slides-container'),
            wrapper = $('.b-fullscreen-video'),
            wHeight = $(window).height();

        wrapper.height(wHeight);

        if(!container.size()) return false;
        container.owlCarousel({
            slideSpeed : 300,
            mouseDrag: false,
            navigation : true,
            pagination: false,
            autoPlay: 6000,
            addClassActive: true,
            transitionStyle : "fade",
            paginationSpeed: 1000,
            scrollPerPage: true,
            dragBeforeAnimFinish: false,
            singleItem: true
        });
        $(window).on('resize orientationchange', function(){
            wrapper.height($(window).height());
            setTimeout(function(){
                container.find('.b-slider-descr:visible > p > span').bigText({
                    limitingDimension: 'width',
                    fontSizeFactor: 1.1
                });
            }, 200);
        });
    }();
    /* Background video */

    /* Main slider */
    var mainSliderFunctionality = function(){
        var api;
        api =  jQuery('.fullwidthabnner').revolution(
            {
                delay:9000,
                startheight: 750,
                startwidth:960,

                hideThumbs:10,

                thumbWidth:100,							// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
                thumbHeight:50,
                thumbAmount:2,

                navigationType:"both",					//bullet, thumb, none, both		(No Thumbs In FullWidth Version !)
                navigationArrows:"verticalcentered",		//nexttobullets, verticalcentered, none
                navigationStyle:"round",				//round,square,navbar

                touchenabled:"on",						// Enable Swipe Function : on/off
                onHoverStop:"off",						// Stop Banner Timet at Hover on Slide on/off

                navOffsetHorizontal:0,
                navOffsetVertical:20,

                stopAtSlide:-1,
                stopAfterLoops:-1,

                shadow:1,								//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
                fullWidth:"off"							// Turns On or Off the Fullwidth Image Centering in FullWidth Modus
            });

    };

    /* End main slider */

    /* Nav menu functionality */

    var navMenu = function(){
        var menuTrigger = $('.e-menu-trigger'),
            menuWrapper = menuTrigger.closest('.b-main-menu-wrapper'),
            menuContainer = menuWrapper.find('.b-main-menu-inner');

        var activeToggler = function(trigger){
            var trigger = trigger || menuTrigger.filter('.m-active');
            trigger.toggleClass('m-active').closest('.b-main-menu-wrapper').toggleClass('m-active').find('.b-main-menu-inner').toggleClass('m-active');

        };
        menuTrigger.on(clickActions, function(e){
            activeToggler($(this));
            e.preventDefault();
        });

        //Close menu when click on outside
        $(document).on('click touchend', function(e){
            if(menuWrapper.hasClass('m-active')){
                if( !$('body').find(e.target).closest('.main-menu').size() && !$('body').find(e.target).hasClass('e-menu-trigger'))
                    activeToggler();
            }
        });
    }();

    var navMenuScroll = function(){
        var menuContainer = $('.menu-items');
        return menuContainer.on('click tap touchend','a[href*=#]:not([href=#])', function(e) {
            e.preventDefault();
            e.stopPropagation();
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = $(this.hash);
                target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                if (target.length) {

                    $('html,body').animate({
                        scrollTop: target.children(':first:not(script)').offset().top-50
                    }, 1000);
                }
            }
        });
    }();
    /* End nav menu functionality */

    var countedNumbers = function(wrapper){
        var container = wrapper || $('.b-counters-block'),
            counterItems = container.find('.e-counter-item');

        if (container.hasClass('m-done') || !counterItems.size()){
            return false;
        }
        counterItems.each(function(){
            var $self = $(this),
                countedNumber = parseInt($self.data('count-number'));

            if(countedNumber){
                $self.animateNumber({
                    number: countedNumber,
                    easing: 'easeInQuad'
                }, 2500);
            }
        });
    };

    /* Inview functionality */
    if(!device){
        $('.b-counters-block').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            if(isInView && visiblePartY == 'both' || isInView && visiblePartY == 'top'){
                countedNumbers();
                $(this).addClass('m-done fade-in-animate');
            }
            if(typeof visiblePartY === 'undefined' && $(window).scrollTop() < $(this).offset().top){
                $(this).removeClass('fade-in-animate m-done');
            }
        });

        $('.b-about-company .b-content').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            if(isInView && visiblePartY == 'both' || isInView && visiblePartY == 'top'){
                $(this).addClass('fadeInUp-animate');
            }
            if(typeof visiblePartY === 'undefined' && $(window).scrollTop() < $(this).offset().top){
                $(this).removeClass('fadeInUp-animate');
            }
        });

        $('.b-about-company h1').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            if(isInView && visiblePartY == 'both'){
                $(this).addClass('fadeInUp-animate');
            }
            if(isInView && visiblePartY == 'top'){
                $(this).addClass('fadeInUp-animate')
            }
            if(typeof visiblePartY === 'undefined' && $(window).scrollTop() < $(this).offset().top){
                $(this).removeClass('fadeInUp-animate');
            }
        });

        //Quote block
        if(!videoBg){
            $('.b-quote-wrapp').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
                var $self = $(this);
                if(isInView){
                    $self.addClass('background-animate');
                }else{
                    $self.removeClass('background-animate');
                }
            });
        }
        var animationProgress = function(time){
            var animationTime = time || 3000,
                step = animationTime/100,
                progressCounter = 0,
                progressBlock =  $('.m-fancy-animate > .b-animation-progress');

            progressBlock.width(0);

            var progressStep = setInterval(function(){
                if(progressCounter < animationTime ){
                    progressCounter += step;
                    progressBlock.width((progressCounter/animationTime)*100+'%');
                }else{
                    clearInterval(progressStep);
                    return false;
                }
            }, step);

        };
        $(selectors.fancyTitle).on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            var mainContainer = $(this).closest('.m-fancy-animate'),
                animateTitle = mainContainer.find('.e-large-title'),
                totalTime = 4500,
                k = notAnimated ? 3 : 1,
                progressBlock = $('<div />', {'class': 'b-animation-progress'});
            if(isInView && visiblePartY == 'top' || isInView && visiblePartY == 'both'){

                if(!mainContainer.hasClass('scroll-done')){

                    if(!mainContainer.find('.b-animation-progress').size()){
                        mainContainer.append(progressBlock);
                    }
                    animationProgress(totalTime);
                    $('html, body').animate({
                        scrollTop: mainContainer.find('.row').first().offset().top
                    }, 500, function(){

                        mainContainer.addClass('scroll-done');
                        mainContainer.find('.m-first-state').addClass('fade-in-out-animate');
                        setTimeout(function(){
                            mainContainer.find('.m-first-state').addClass('m-fade-in');
                            animateTitle.addClass('m-first-step');
                        }, 3500/k);

                        setTimeout(function(){
                            mainContainer.find('.m-first-state').removeClass('m-first-state');
                            animateTitle.addClass('m-second-step');
                        }, 5500/k);

                        setTimeout(function(){
                            mainContainer.addClass('m-done-action')
                        }, totalTime/k);
                        return false;
                    });
                }
            }

        });
    }
    /* End inview functionality */

    /* Dropdown functionality */


    function removeActive(dropdown){
        var activeDropdown = dropdown || $('body').find('.b-dropdown').filter('.m-active'),
            trigger = $('body').find('a').filter('[href*="'+activeDropdown.prop('id')+'"]');

        if(!activeDropdown.size()) return false;
        setTimeout(function(){
            $('body').find('.b-dropdown').removeClass('m-animated');
            activeDropdown.removeAttr('style');
        }, 1000);

        if(trigger.size()){
            trigger.each(function(){
                $(this).removeClass('m-active m-animated');
            });
        }
        skillsInit(activeDropdown, 'clear');
        activeDropdown.find('.b-side-content').animate({'scrollTop':'0'}, 500);
        if(notAnimated){
            activeDropdown.slideUp().removeClass('m-active');
        }else{
            activeDropdown.removeClass('m-active');
        }
    }
    //close on press esc
    $(document).on('keyup', function(e){
        var key = e.keyCode;
        if(key == 27){
            removeActive();
        }
    });

    $('.b-dropdown-items a, .e-dropdown-lnk, .b-overlay-descr a').on('click tap', function(e){

        var $self = $(this),
            dropDownContainerClass = '.b-dropdown',
            elemDD= $('body').find($self.attr('href'));
        e.preventDefault();
        if(!elemDD.size() || $('body').find(dropDownContainerClass).is('.m-animated')){
            return false;
        }

        var container = $('.master-menu');

        if (container.is( ":visible" )){
            // Hide - slide up.
            container.slideUp( 1000 );
        } else {
            // Show - slide down.
            container.slideDown( 1000 );
        }

        if(!elemDD.hasClass('m-active')){
            if($('body').find(dropDownContainerClass).is('.m-active')){

                //Open if another dropdown active
                removeActive();
                if(notAnimated){
                    elemDD.slideDown(function(){
                        if(elemDD.find('.b-map-wrapper').size()){
                            mapInit();
                        }
                    }).addClass('m-animated');
                }else{
                    elemDD.css('display', 'block').addClass('m-animated');
                    if(elemDD.find('.b-map-wrapper').size()){
                        mapInit();
                    }
                }

                setTimeout(function(){
                    elemDD.addClass('m-active');
                }, 500);
            }else{
                //if first opening
                if(notAnimated){
                    elemDD.addClass('m-animated').slideDown(function(){
                        elemDD.addClass('m-active');
                        $('body').find(dropDownContainerClass).filter('.m-animated').removeClass('m-animated');
                        if(elemDD.find('.b-map-wrapper').size()){
                            mapInit();
                        }
                    });
                }else{
                    elemDD.css('display', 'block').addClass('m-animated');
                    if(elemDD.find('.b-map-wrapper').size()){
                        mapInit();
                    }
                    setTimeout(function(){
                        elemDD.addClass('m-active');
                    }, 200);
                    setTimeout(function(){
                        $('body').find(dropDownContainerClass).filter('.m-animated').removeClass('m-animated');
                    }, 500);
                }
            }

            skillsInit(elemDD);

            $self.addClass('m-active');
            elemDD[0].addEventListener("touchmove", function(evt){
                evt.stopPropagation();
            }, false);
            elemDD.find('.b-side-content').delay(500).animate({'scrollTop': '200%'}, function(){
                $(this).delay(500).animate({'scrollTop': '0'});
            });
        }else{
            return false;
        }
        return false;
    });

    /* In open dropdown activity */
    function skillsInit(wrapper, action){
        //if(deviceMobile) return false;
        var container = wrapper || $('.b-dropdown.m-active').find('.b-skill-list'),
            skillItems = container.find('.e-skill-spinner');

        if(skillItems.size()){
            if(action == 'clear'){
                if(!device){
                    skillItems.each(function(){
                        $(this).find('.e-skill-progress').width(0);
                    });
                    return false
                }
            }else{
                skillItems.each(function(){
                    var $self = $(this),
                        duraction = 1100,
                        progressLine = $self.find('.e-skill-progress'),
                        persentDisplay = progressLine.find('.e-skill-count'),
                        skillValue = parseInt(progressLine.data('skill-value'));
                    if(device){
                        duraction = 0;
                    }
                    if(skillValue > 100){
                        skillValue = 100;
                    }else if (skillValue < 0){
                        skillValue = 0
                    }
                    progressLine.width(skillValue+'%');
                    persentDisplay.animateNumber({
                        number: skillValue,
                        easing: 'easeInQuad',

                        // optional custom step function
                        // using here to keep '%' sign after number
                        numberStep: function(now, tween) {
                            var floored_number = Math.floor(now),
                                target = $(tween.elem);

                            target.text(floored_number + '%');
                        }
                    }, duraction);
                });
            }
        }
    }

    /* End in open dropdown activity */

    $(selectors.dropDownTrigger).on('click touchstart', function(e){
        removeActive($(this).closest('.b-dropdown'));
        var container = $('.master-menu');

        if (container.is( ":visible" )){
            // Hide - slide up.
            container.slideUp( 1000 );
        } else {
            // Show - slide down.
            container.slideDown( 1000 );
        }

        e.preventDefault();
    });

    /* Dropdown functionality */

    /* End mobile main menu functionality */

    /* Contact Us */
    $('#requestForm').submit(function() {
        var form = $(this),
            requaredFields = form.find('.e-required-field'),
            isError = false;

        form.find('.b-error-msg, .b-success-msg').remove();

        requaredFields.each(function() {
            var field = $(this);
            field.removeClass('m-not-valid');
            if($.trim(field.val()) === '') {
                field.addClass('m-not-valid').siblings('label').append('<span class="b-error-msg">هذا الحقل مطلوب</span>');
                isError = true;
            } else if(field.hasClass('e-email-field')) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(!emailReg.test($.trim($(this).val()))) {
                    field.addClass('m-not-valid').siblings('label').append('<span class="b-error-msg">لقد ادخلت بريد خاطىء</span>');
                    isError = true;
                }
            }
        });
        if(!isError) {
            var formData = $(this).serialize();
            $.post('contacts.html', formData, function(data) {
                requaredFields.val('');
                form.find('.row').last().append('<div class="b-success-msg">لقد تم الارسال</div>');
            }).fail(function() {
                form.find('.row').last().append('<div class="b-error-msg">يوجد خطأ الرجال المحاولة لاحقا</div>');
            });
        }
        return false;
    });
    /* End Contact Us */

    /* Brands carousel init */

    var brandsFunctionality = function(){
        var brandCarouselContainer = $('#brandsCarousel'),
            brandCarouselData = '';
        if (!brandCarouselContainer.size()) return false;
        $('#brandsBlock').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            var $self = $(this);
            if(isInView && visiblePartY == 'both'){
                brandCarouselData.play();
            }else if(typeof visiblePartY === 'undefined' && $(window).scrollTop() < $(this).offset().top){
                brandCarouselData.stop();
            }
        });
        brandCarouselContainer.owlCarousel({
            navigation : false,
            pagination: false,
            autoPlay: 5000,
            itemsDesktop : [1280,4]
        });

        brandCarouselData = brandCarouselContainer.data('owlCarousel');
        brandCarouselData.stop();
    }();

    /* End brands carousel init */
    /* Twitter init */

    var twitterFeedInit = function(){
        var container = $('#twitterCarousel'),
            time = 15,
            carouselData,
            $progressBar,
            $bar,
            $elem,
            isPause,
            tick,
            percentTime;

        if(!container.size()) return false;


        container.tweet({
            modpath: "twitter/",
            join_text: "auto",
            count: 4,
            avatar_size: 0,
            template: "{text}{time}",
            username: "envato"
        });

        if(container.find('.tweet_list').size()){
            container.find('.tweet_list').owlCarousel({
                slideSpeed : 200,
                mouseDrag: true,
                navigation : false,
                pagination: true,
                autoPlay: false,
                transitionStyle : "fade",
                paginationSpeed: 500,
                scrollPerPage: true,
                dragBeforeAnimFinish: true,
                itemsScaleUp: true,
                singleItem: true,
                afterInit : progressBar,
                afterMove : moved,
                startDragging : pauseOnDragging
            });
        }else{
            return false;
        }


        //Init progressBar
        function progressBar(elem){
            $elem = elem;
            //build progress bar elements
            buildProgressBar();
            //start counting
            start();
        }

        //create div.progressBar
        function buildProgressBar(){
            $progressBar = $("<div>",{
                class:"progressBar"
            });
            $bar = $("<div>",{
                class:"bar"
            });
            $progressBar.append($bar).prependTo($elem);
        }

        function start() {
            //reset timer
            percentTime = 0;
            isPause = false;
            //run interval every 0.01 second
            tick = setInterval(interval, 10);
        }

        function interval() {
            if(isPause === false){
                percentTime += 1 / time;
                $elem.find('.bar').css({
                    width: percentTime+"%"
                });
                //if percentTime is equal or greater than 100
                if(percentTime >= 100){
                    //slide to next item
                    $elem.trigger('owl.next')
                }
            }
        }

        //pause while dragging
        function pauseOnDragging(){
            isPause = true;
        }

        //moved callback
        function moved(){
            //clear interval
            clearTimeout(tick);
            //start again
            start();
        }
        $('#twitterBlock').on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            var $self = $(this);
            if(isInView){
                if(!videoBg){
                    $self.find('.b-background-overlay').addClass('scaleAbsoluteBlock-animate');
                }
                carouselData.play();
                isPause = false;
            }else if(typeof visiblePartY === 'undefined'){
                if(!videoBg){
                    $self.find('.b-background-overlay').removeClass('scaleAbsoluteBlock-animate');
                }
                carouselData.stop();
                isPause = true;
            }
        });

        carouselData = container.find('.tweet_list').data('owlCarousel');
        if(!carouselData) return false;
        carouselData.stop();
        isPause = true;

    }();
    /* End twitter init */

    /* Testimonials carousel */
    var testimonialsFunctionality = function(){
        var container = $('#testimonialsCarousel'),
            testimonialBlock = $(selectors.testimonialsBlock),
            time = 7,
            carouselData,
            $progressBar,
            $bar,
            $elem,
            isPause,
            tick,
            percentTime;

            if(!container.size()) return false;

        container.owlCarousel({
            slideSpeed : 200,
            mouseDrag: false,
            navigation : false,
            pagination: true,
            autoPlay: false,
            transitionStyle : "fade",
            paginationSpeed: 500,
            scrollPerPage: true,
            dragBeforeAnimFinish: true,
            itemsScaleUp: true,
            singleItem: true,
            afterInit : progressBar,
            afterMove : moved,
            startDragging : pauseOnDragging
        });

        var InCarousel = $("#InCarousel");

        InCarousel.owlCarousel({
            slideSpeed : 1000,
            mouseDrag: true,
            navigation : false,
            pagination: false,
            autoPlay: false,
            transitionStyle : "fade",
            scrollPerPage: true,
            dragBeforeAnimFinish: true,
            itemsScaleUp: true,
            singleItem: true,
            autoHeight : true,
            lazyLoad : true,
            startDragging : pauseOnDragging
        });

        $(".e-one").click(function(){
            InCarousel.trigger('owl.goTo', 0);
        });

        $(".e-two").click(function(){
            InCarousel.trigger('owl.goTo', 1);
        });

        $(".e-three").click(function(){
            InCarousel.trigger('owl.goTo', 2);
        });

        $(".e-four").click(function(){
            InCarousel.trigger('owl.goTo', 3);
        });

        $(".e-five").click(function(){
            InCarousel.trigger('owl.goTo', 4);
        });

        //Init progressBar
        function progressBar(elem){
            $elem = elem;
            //build progress bar elements
            buildProgressBar();
            //start counting
            start();
        }

        //create div.progressBar
        function buildProgressBar(){
            $progressBar = $("<div>",{
                class:"progressBar"
            });
            $bar = $("<div>",{
                class:"bar"
            });
            $progressBar.append($bar).prependTo($elem);
        }

        function start() {
            //reset timer
            percentTime = 0;
            isPause = false;
            //run interval every 0.01 second
            tick = setInterval(interval, 10);
        }

        function interval() {
            if(isPause === false){
                percentTime += 1 / time;
                $elem.find('.bar').css({
                    width: percentTime+"%"
                });
                //if percentTime is equal or greater than 100
                if(percentTime >= 100){
                    //slide to next item
                    $elem.trigger('owl.next')
                }
            }
        }

        //pause while dragging
        function pauseOnDragging(){
            isPause = true;
        }

        //moved callback
        function moved(){
            //clear interval
            clearTimeout(tick);
            //start again
            start();
        }
        if(!device && !videoBg){
            testimonialBlock.prev().on('inview', function(event, isInView, visiblePartX, visiblePartY){
                if(isInView){
                    testimonialBlock.addClass('m-inprogress');
                }
            });

            testimonialBlock.next().on('inview', function(event, isInView, visiblePartX, visiblePartY){
                if(isInView){
                    testimonialBlock.addClass('m-inprogress');
                }else if(typeof visiblePartY === 'undefined' && $(window).scrollTop() > $(this).offset().top){
                    testimonialBlock.removeClass('m-inprogress');
                }
            });
        }

        testimonialBlock.on('inview', function(event, isInView, visiblePartX, visiblePartY) {
            var $self = $(this);
            if(isInView){
                if(!videoBg){
                    $self.find('.b-background-overlay').addClass('fixed-background-animate');
                }
                carouselData.play();
                isPause = false;
            }else if(typeof visiblePartY === 'undefined'){
                if(!videoBg){
                    $self.find('.b-background-overlay').removeClass('fixed-background-animate');
                }
                carouselData.stop();
                isPause = true;
            }
        });

        carouselData = container.data('owlCarousel');

        carouselData.stop();
        isPause = true;

    }();
    /* End testimonials carousel */

    /* Portfolio functionality */
    $('#daskyOut').Dasky();

    $('#daskyIn').Dasky();
    /* End portfolio functionality */

    /* Image popup init */
    var LightBoxInit = function(container){
        var container = container || $('.b-overlay-lightbox');

        container.on(clickActions, 'a', function(e){
            var $self = $(this),
                popupType = $self.is('.m-video-popup') ? 'iframe' : 'image';

            container.magnificPopup({
                delegate: $self,
                type: popupType,
                mainClass: 'mfp-zoom-in',
                removalDelay: 500,
                fixedContentPos: true,
                fixedBgPos: true,
                closeOnContentClick: true,
                callbacks: {
                    beforeOpen: function() {
                        // just a hack that adds mfp-anim class to markup
                        this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                        this.st.mainClass = 'mfp-zoom-in';
                    }
                },
                image:{
                    cursor: null
                }
            }).magnificPopup('open');
            return false;
        });
        if(device){
            if(!deviceAndroid){
                container.on('tap', 'a', function(e){
                    e.preventDefault();
                    $(this).trigger('click');
                    //return false;
                });
                $('body').on('touchend','.mfp-container', function(){
                    $(this).trigger('click');
                });
            }
        }
    }();
    /* End image popup init */

    if(device){
        $(selectors.portfolioBlock).on('tap', '.mix', function(e){
            var $self = $(this).closest('.owl-item').size() ? $(this).closest('.owl-item') : $(this),
                itemClass = $self.is('.owl-item') ? '.owl-item': '.mix',
                allItems = $self.closest('.b-portfolio').find(itemClass);
            e.stopPropagation();
            e.preventDefault();
            $self.closest('.b-portfolio').find(allItems).removeClass('m-active');
            $self.addClass('m-active');
        });
        $('.b-container').on('tap', function(e){
            $(selectors.portfolioBlock).find('.b-carousel-view:visible .m-active').removeClass('m-active');
            $(selectors.portfolioBlock).find('.b-portfolio-filters:visible .m-active').removeClass('m-active');

        })
    }
	/* Temporary theme switch function */
	
    $('#layoutSwither').on('change', function(){
        var currentColor = ((window.location.pathname.split('/index').join('') !='index.html') && (window.location.pathname.split('/index').join('') !='http://demo.web4pro.net/')) ? window.location.pathname.split('/index').join('') : '.html',
            value = $(this).val();
        currentColor = currentColor.split('/cosmo').join('');
        if(value == 'video' && $(this).not(':selected')){
            window.open ('index-video'+currentColor, '_blank');
        }else{
            window.location = 'index'+currentColor.split('-video').join('');
        }

    });
    if(htmlTag.hasClass('explorer')){
        $('#layoutSwither').on('hover focus active', function(){
            //$(this).closest([class=*'ion-images]').addClass('m-active');
            $(this).closest('.ion-images').addClass('m-active');
            $(this).on('blur', function(){
                $(this).closest('.ion-images').removeClass('m-active');
            })
        });
    }


    var myPlaylist = [
        {
            mp3:'mix/1.mp3',
            title:'موسيقى',
            artist:'Sample',
            duration:'0:30',
            cover:'mix/1.png'
        }
    ];
    $('#VIPlayer').ttwMusicPlayer(myPlaylist, {
        description: false,
        jPlayer:{
            swfPath:'../plugin/jquery-jplayer' //You need to override the default swf path any time the directory structure changes
        }
    });


    $('a.close_player').on('click', function(){
        $('#VIPlayer_content').fadeOut("fast");
        $('#VIPlayer_icon').fadeIn("fast");
        return false;
    });

    $('a.open_player').on('click', function(){
        $('#VIPlayer_icon').fadeOut("fast");
        $('#VIPlayer_content').fadeIn("fast");
        return false;
    });

    $('.bxslider').bxSlider({
        auto: true,
        mode: 'fade',
        pager: false,
        speed: 1500,
        nextSelector: '#slider-next',
        prevSelector: '#slider-prev',
        nextText: '<img src="img/BT-R.jpg"/>',
        prevText: '<img src="img/BT-L.jpg"/>',
        randomStart: true
    });

    $('.RequestYoutube').on('click', function(){
        var container = $('#RequestYoutube');

        if (container.is( ":visible" )){
            // Hide - slide up.
            var controller = new YTV('RequestYoutubeView', {
                user: 'UC8HybVqYKK65H7xZ85Zw8Iw',
                accent: 'yellow'
            });
            return false;
        }
    });

    var windowsize = $(window).width();

    $(window).resize(function() {
        windowsize = $(window).width();
        //menu.is(':hidden')
        if (windowsize < 700) {
            $('img.mobile_menu').show();
        }else{
            $('img.mobile_menu').hide();
            $('.menu-items').show();
        }
    });

    if (windowsize < 700) {
        $('img.mobile_menu').show();
    }

    ////if the window is greater than 440px wide then turn on jScrollPane..
    $('img.mobile_menu').on('click', function(){

        var container = $('.menu-items');

        if (container.is( ":visible" )){
            // Hide - slide up.
            container.slideUp( 1000 );
            return false;
        } else {
            // Show - slide down.
            container.slideDown( 1000 );
            return false;
        }
    });


    function countedNumbers(){
        var container = $('.b-counters-block'),
            counterItems = container.find('.e-counter-item-in');

        counterItems.each(function(){
            var $self = $(this),
                countedNumber = parseInt($self.data('count-number'));

            if(countedNumber){
                $self.animateNumber({
                    number: countedNumber,
                    easing: 'easeInQuad'
                }, 2500);
            }
        });
    }

    //fu** yeah !
    $('.dsk-titlenode').click(function() {
        var container = $(this),
            counterItems = container.parent().find('.e-counter-item-in');

        counterItems.each(function(){
            var $self = $(this),
                countedNumber = parseInt($self.data('count-number'));

            if(countedNumber){
                $self.animateNumber({
                    number: countedNumber,
                    easing: 'easeInQuad'
                }, 2500);
            }
        });
    });
    
    /* Temporary theme switch function */
})(jQuery);