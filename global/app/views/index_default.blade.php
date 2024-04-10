<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>{{ Config::get('settings.site.title') }}</title>
    <meta name="description" content="">
    <meta name="author" content="{{ Config::get('settings.site.metaauthor') }}">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    {{ HTML::style('assets/css/base.css')}}
    {{ HTML::style('assets/css/skeleton.css')}}
    {{ HTML::style('assets/css/layout.css')}}

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/rs-plugin/css/settings.css')}}" media="screen" />

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}">
    <link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon.png')}}')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/apple-touch-icon-72x72.png')}}')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/apple-touch-icon-114x114.png')}}')}}">

    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,400italic,600italic' rel='stylesheet' type='text/css'>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

</head>
<body>

<header>
    <div class="top_rb"></div>
    <div class="container">
        <div class="logo">
            <a href="{{ URL::to("/en") }}"><img src="{{asset('assets/images/header_logo.png')}}"/></a>
        </div>
        <nav class="seven columns">
            <div class="menu_wrapper">
            <ul data-breakpoint="800" class="menu_list">

                <li><a href="{{ URL::to("/en") }}">Home</a></li>


                <li style="width: 120px; text-align: center"><a href="#">Products</a>
                    <ul>
                        @foreach(HomeController::SubProducts() as $product)
                        <li><a href="{{ URL::to("".Request::segment(1)."/products/$product->slug") }}">{{$product->title}}</a></li>
                        @endforeach
                    </ul>
                </li>

                @foreach(HomeController::MainPages() as $page)
                @if($page->slug != 'home' and $page->slug != 'side-bar')
                <li><a href="{{ URL::to("".Request::segment(1)."/page/$page->slug") }}">{{$page->title}}</a></li>
                @endif
                @endforeach

            </ul>
            </div>
        </nav>
    </div>
    <div class="container">
    @include('frontend/slider')
    <!-- Content End -->
    </div>

</header>

@if( Request::segment(2) == false)
<section id="contents">
    <div class="container">
        <div class="main_page">
            <div style="width:100%; clear: both">
                {{ Page::where('static', 1)->where('slug', 'side-bar')->first()->content }}
            </div>
            <p style="clear: both"></p>
            {{ Page::where('static', 1)->where('slug', 'home')->first()->content }}
        </div>
        <!-- main page -->
    </div>
</section>

@elseif( HomeController::checkStaticPage(Request::segment(3)) )

@include('static.'.Request::segment(3))

@else
<section id="contents">
    <div class="container">
        <div class="main_page">
            @if($search_mode == true)
                @include('static.search')
            @elseif(!empty($getPage->content))
                {{$getPage->content}}
            @else
                <!-- Content -->
                @if( !isset($content) || is_null($content) || empty($content) )
                {{'wrong method'}}
                @else
                {{$content}}
                @endif
            @endif
        </div>
        <!-- main page -->
    </div>
</section>
@endif

<footer>
    <div class='container'>
        <div class="footer_left">
            <div class="footer_logo">
                <img style="float: left" src="{{asset('assets/images/footer_logo.png')}}"/>
            </div>
            <div class="footer_menu">
                <ul>
                    <li><a href="{{ URL::to("/en") }}">Home</a></li>
                    @foreach(HomeController::MainPages() as $page)
                    @if($page->slug != 'home')
                    <li><a href="{{ URL::to("".Request::segment(1)."/page/$page->slug") }}">{{$page->title}}</a></li>
                    @endif
                    @endforeach
                </ul>
            </div>
            <div class="copy_right">
                <p> 2009 - 2014 &copy; All rights reserved to Global company <br> Designed by <a href="http://vip4it.com" target="_blank">Virtual Integrated Projects</a></p>
            </div>
        </div>

        <div class="footer_right">
            <div class="footer_contact">
                <h2>Contact Information</h2>
                <ul>
                    <li><a href="#">Tel: (966) 11 4980366 </a></li>
                    <li><a href="#">Fax: (966) 11 4983253 </a></li>
                    <li><a href="#">Email: info@globopp.com</a></li>
                    <li><a href="#">P.O Box 606. Riyadh - 11383, </a></li>
                    <li><a href="#">Kingdom of Saudi Arabia</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<script src="{{asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/jquery.flexnav.js')}}" type="text/javascript"></script>

<script type="text/javascript" src="{{asset('assets/rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
<script type="text/javascript" src="{{asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>


<script>

    var revapi;

    $(document).ready(function(){


        $(".menu_list").flexNav();

        revapi = jQuery('.fullwidthbanner').revolution(
            {
                delay:9000,
                startwidth:1170,
                startheight:400,
                hideThumbs:10,

                thumbWidth:100,
                thumbHeight:50,
                thumbAmount:5,

                navigationType:"both",
                navigationArrows:"solo",
                navigationStyle:"round",

                touchenabled:"on",
                onHoverStop:"on",

                navigationHAlign:"center",
                navigationVAlign:"bottom",
                navigationHOffset:0,
                navigationVOffset:0,

                soloArrowLeftHalign:"left",
                soloArrowLeftValign:"center",
                soloArrowLeftHOffset:20,
                soloArrowLeftVOffset:0,

                soloArrowRightHalign:"right",
                soloArrowRightValign:"center",
                soloArrowRightHOffset:20,
                soloArrowRightVOffset:0,

                shadow:0,
                fullWidth:"on",
                fullScreen:"off",

                stopLoop:"off",
                stopAfterLoops:-1,
                stopAtSlide:-1,


                shuffle:"off",

                autoHeight:"off",
                forceFullWidth:"on",

                hideThumbsOnMobile:"off",
                hideBulletsOnMobile:"on",
                hideArrowsOnMobile:"on",
                hideThumbsUnderResolution:0,

                hideSliderAtLimit:0,
                hideCaptionAtLimit:768,
                hideAllCaptionAtLilmit:0,
                startWithSlide:0,
                videoJsPath:"plugins/revslider/rs-plugin/videojs/",
                fullScreenOffsetContainer: ""
            });


    });
</script>
</body>
</html>