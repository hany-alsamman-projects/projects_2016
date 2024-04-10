<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>{{ Config::get('settings.site.title') }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="{{ Config::get('settings.site.metaauthor') }}">

    <!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
    <!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
    <!--script src="js/less-1.3.3.min.js"></script-->
    <!--append ‘#!watch’ to the browser URL, then refresh the page. -->

    <link href="{{ asset('assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css')}}" rel="stylesheet">

    <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="{{ asset('assets/js/html5shiv.js')}}"></script>
    <![endif]-->

    <script src="{{ asset('assets/js/jquery.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ asset('assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/scripts.js')}}"></script>
    <link href="{{ asset('assets/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{ asset('assets/css/sale.css')}}" rel="stylesheet">

    <!-- REVOLUTION BANNER CSS SETTINGS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/rs-plugin/css/settings.css')}}" media="screen" />

    <script type="text/javascript" src="{{ asset('assets/rs-plugin/js/jquery.themepunch.plugins.min.js')}}"></script>
    <script type="text/javascript" src="{{ asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>

    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
</head>

<body>
<div class="container">
    <div class="row clearfix">
        <div class="col-md-12 column" style="margin-top: 20px;">
            <div class="row clearfix">

                <nav class="navbar navbar-danger" role="navigation" style="margin-top: 40px; margin-bottom: 0">

                    <div class="col-md-4 column">
                        <img alt="logo" src="{{asset('assets/img/logo.png')}}">
                    </div>

                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="navbar-collapse collapse" style="margin-top: 20px">
                            <ul class="nav navbar-nav navbar-left">
                                <li {{ Request::is('/') ? ' class="active"' : '' }}>
                                <a href="{{ URL::to('/en/') }}"><i class="fa fa-home"></i> Home</a></li>

                                <li><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                        <i class="fa fa-th"></i> News</a>
                                    <ul class="dropdown-menu">
                                        @foreach(HomeController::SubProducts() as $product)
                                        <li><a href="{{ URL::to("".Request::segment(1)."/news/$product->slug") }}">
                                            {{$product->title}}</a></li>
                                        @endforeach
                                    </ul>
                                </li>

                                @foreach(HomeController::MainPages() as $page)
                                @if($page->slug != 'home')

                                @if(HomeController::SubPages($page->id))
                                <li {{ Request::is("en/page/$page->slug") ? ' class="active"' : '' }} class="dropdown">

                                <a class="dropdown-toggle" data-toggle="dropdown" href="{{ URL::to("/en/page/$page->slug") }}">
                                <i class="fa fa-th"></i> {{$page->title}}</a>
                                @else

                                <li {{ Request::is("en/page/$page->slug") ? ' class="active"' : '' }}>
                                <a href="{{ URL::to("/en/page/$page->slug") }}">
                                <i class="fa fa-th"></i> {{$page->title}}</a>
                                @endif

                                @endif
                                @if(HomeController::SubPages($page->id))
                                <ul class="dropdown-menu">
                                    @foreach(HomeController::SubPages($page->id) as $subpage)
                                    <li><a href="{{ URL::to("/en/page/$subpage->slug") }}">{{$subpage->title}}</a></li>
                                    @endforeach
                                </ul>
                                </li>
                                @else
                                </li>
                                @endif
                                @endforeach

                            </ul>
                            <div class="pull-right" id="social" style=" margin-top: 10px;">
                                <a target="_blank" href="#"><i class="fa fa-facebook-square fa-2x"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-twitter-square fa-2x"></i></a>
                                <a target="_blank" href="#"><i class="fa fa-linkedin-square fa-2x"></i></a>
                            </div>

                        </div><!--/.nav-collapse -->
                    </div>

                </nav>

            </div>
        </div>
    </div>

    @include('frontend/slider')

    @if( Request::segment(2) == false)
    <section id="contents">
        <div class="container">
            <div class="col-md-12 column" style="margin-top: 50px;">
                <div class="clearfix" style="width:85%; margin: 0 auto 0 auto">

                    @foreach(iProductController::ProductsIntro() as $product)
                    <div class="col-md-4 column news_box">
                        <div class="news_picture" style="background-image: url({{asset("upload/covers/$product->photo")}})"></div>
                        <div class="news_content">
                            <p>
                                {{ Str::limit($product->content, 400) }}
                            </p>
                            <p>
                                <a href="{{ URL::to("en/news/view/$product->id")}}">View details »</a>
                            </p>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>
           <!--
           <div class="main_page">
               <p style="clear: both"></p>

               {{ Page::where('static', 1)->where('slug', 'home')->first()->content }}
            </div>
            main page -->
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

</div>

<div class="col-md-12 column footer">

    <div class="content">
        <div class="col-md-4 column">
            <ul>
                <li>
                    <h3>Media Center</h3>
                </li>
                <li>
                    Test One
                </li>
                <li>
                    Test two
                </li>
            </ul>
        </div>

        <div class="col-md-4 column">
            <ul>
                <li>
                    <h3>Media Center</h3>
                </li>
                <li>
                    Test One
                </li>
                <li>
                    Test two
                </li>
            </ul>
        </div>


        <div class="col-md-4 column">
            <ul>
                <li>
                    <h3>Media Center</h3>
                </li>
                <li>
                    Test One
                </li>
                <li>
                    Test two
                </li>
            </ul>
        </div>

    </div>
</div>

<script>

    var revapi;

    $(document).ready(function(){

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


        $(".news_circle").animate({
                width:'+=50px',
                height:'+=50px',
                top: '-=10px',
                left: '-=10px',
                easing: 'easeOutQuad'
            }, 1000);
        //$(".news_circle").css('background-position', '0px 10px');
    });
</script>
</body>
</html>