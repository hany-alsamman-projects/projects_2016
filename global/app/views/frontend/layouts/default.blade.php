<!DOCTYPE html>
<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (gt IE 8)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @section('title')
            {{$site_name}}
        @show
    </title>
    <meta name="description" content="" />

    <!-- http://davidbcalhoun.com/2010/viewport-metatag -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <!-- http://www.kylejlarson.com/blog/2012/iphone-5-web-design/ -->
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0">

    <!-- Microsoft clear type rendering -->
    <meta http-equiv="cleartype" content="on">

    <!-- iOS web-app metas -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    @stylesheets('home')


    <!--[if lt IE 9]>
    <script src="{{ URL::asset('assets/js/vendor/html5-3.6-respond-1.1.0.min.js') }}" type="text/javascript"></script>
    <![endif]-->

    {{ HTML::style('assets/css/colors.css')}}
    {{ HTML::style('assets/css/form.css')}}
    {{ HTML::style('assets/css/switches.css')}}
    {{ HTML::style('assets/css/modal.css')}}
    {{ HTML::style('assets/css/buttons.css')}}
    {{ HTML::style('assets/css/notifications.css')}}
    {{ HTML::style('assets/css/property.css')}}


    {{ HTML::style('assets/css/creamsoda_ticker.css')}}
    <!-- page guide --->
    {{ HTML::style('assets/css/pageguide.css')}}
    <!-- ilightbox --->
    {{ HTML::style('assets/ilightbox/css/ilightbox.css')}}
    <!-- Slider --->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/rs-plugin/css/settings.css') }}" media="screen" />

    <script src="{{ URL::asset('assets/js/vendor/modernizr.custom.js') }}" type="text/javascript"></script>

    @javascripts('jquery')

</head>
<body>

<!-- Prompt IE 6 users to install Chrome Frame -->
<!--[if lt IE 7]><p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<div id="wrapper">

<header id="header">

    <div id="login_area">
        @include('frontend/layouts/login_area')
    </div>

    <div id="search_area">
        <a href="{{ URL::to('/home') }}"><img style="float: right; height: 80px" src="{{asset('assets/images/logo.jpg')}}"></a>

        <div id="social_bar">
            <span class='st_facebook_large' displayText='Facebook'></span>
            <span class='st_twitter_large' displayText='Tweet'></span>
            <span class='st_linkedin_large' displayText='LinkedIn'></span>
            <span class='st_googleplus_large' displayText='Google +'></span>
            <span class='st_google_bmarks_large' displayText='Bookmarks'></span>
            <span class='st_email_large' displayText='Email'></span>

            <script type="text/javascript">var switchTo5x=true;</script>
            <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
            <script type="text/javascript">stLight.options({publisher: "22b28415-0497-47d4-bd55-45fec90f3b3e", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
        </div>

    </div>

    <br class="clear">

    <nav>

        <div id="main_menu">

        </div>

        <div class="news_bar">
            @include('frontend/layouts/news')
        </div>


    </nav>
</header>

<div id="slider">

    <div id="my_monster">
        @include('frontend/layouts/slider')
    </div>

    <div id="related_link">
        <a href="{{ URL::to('tags/sale') }}"><img src="{{asset('assets/images/property_btn_3.png')}}"></a>
        <a href="{{ URL::to('tags/rent') }}"><img src="{{asset('assets/images/property_btn_2.png')}}"></a>
        <a href="{{ URL::to('tags/investment') }}"><img src="{{asset('assets/images/property_btn_1.png')}}"></a>
    </div>

</div>

<div id="main_content">

    <div id="section_two">
        @if(Request::segment(1) == 'property')

        <div id="one_side" >
            <!-- Content -->
            @yield('content')

        </div>

        @else

        <div id="left_side" class="flt-l">
            <div id="adv_273x695"><img src="{{asset('assets/images/273x695.jpg')}}" /></div>
            <div id="adv_273x333"><img src="{{asset('assets/images/273x333.jpg')}}" /></div>
        </div>

        <div id="right_side" class="flt-r">
            <!-- Content -->
            @yield('content')

        </div>

        @endif
    </div>

</div><!-- end main content -->

</div><!-- end wrapper -->

<footer>
    @include('frontend/layouts/footer')
</footer>

<!-- Scripts -->
<script src="{{ URL::asset('assets/js/setup.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/developr.input.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/developr.modal.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/developr.notify.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.easing.1.3.js') }}" type="text/javascript"></script>

<!-- Map
<script src="{{ URL::asset('assets/js/vendor/jquery-map.js') }}" type="text/javascript"></script>
-->
<!-- News bar -->
<script src="{{ URL::asset('assets/js/vendor/creamsoda_ticker.js') }}" type="text/javascript"></script>

<!-- Plugins -->
<script src="{{ URL::asset('assets/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/pageguide.js') }}" type="text/javascript"></script>

<!-- slider -->
<script src="{{ URL::asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ URL::asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>

<!-- lightbox -->
<script src="{{ URL::asset('assets/ilightbox/js/jquery.requestAnimationFrame.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/ilightbox/js/jquery.mousewheel.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/ilightbox/js/ilightbox.packed.js') }}" type="text/javascript"></script>


<script type="text/javascript">
    jQuery(document).ready(function() {

        @include('frontend/notifications')
        <!-- check for error flash var -->

        $('.news_bar').csTicker({
            tickerMode: 'mini',
            tickerTitle: 'اخبار الموقع',
            autoAnimate: true,
            delay: 4000,
            buttons: true
        });

    });
</script>

</body>
</html>