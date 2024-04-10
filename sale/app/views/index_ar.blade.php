<!DOCTYPE html>
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>
        @section('title')
        {{$site_name}}
        @show
    </title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- CSS
  ================================================== -->
    {{ HTML::style('assets/css/base.css')}}
    {{ HTML::style('assets/css/skeleton.css')}}
    {{ HTML::style('assets/css/layout-ar.css')}}
    {{ HTML::style('assets/css/jquery.bxslider.css')}}

    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <style>
        @import "http://fonts.googleapis.com/earlyaccess/droidarabickufi.css";
    </style>

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.icopng')}}">
    <link rel="apple-touch-icon" href="{{asset('assets/images/apple-touch-icon.png')}}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset('assets/images/apple-touch-icon-72x72.png')}}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset('assets/images/apple-touch-icon-114x114.png')}}">
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900,400italic,600italic' rel='stylesheet' type='text/css'>

    <script type="text/javascript">var switchTo5x=true;</script>
    <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
    <script type="text/javascript" src="http://s.sharethis.com/loader.js"></script>
</head>
<body>

<div id="res-header-top"></div>

<header>
    <div class="container">
        <div class="logo">
            <img src="{{asset('assets/images/logo.png')}}" alt="Logo"/>
        </div>
    </div>
</header>

<section id="intro">
    <div class="container">
        <nav class="menu">
            <a>About Sale</a>
            <a>KSA Business</a>
            <a>International Business</a>
            <a>Business Partners</a>
            <div class="search_bar">
                <span class='st__large' displayText=''></span>
                <span class='st_linkedin_large' displayText='LinkedIn'></span>
            </div>
        </nav>
        <div class="intro_image">
            <div class="bxSlider">
                <li>
                    <img src="{{asset('assets/images/banner.jpg')}}" alt="Intro Image"/>
                </li>
                <li>
                    <img src="{{asset('assets/images/banner2.jpg')}}" alt="Intro Image"/>
                </li>
            </div>
        </div>
        <section id="services">
            <div class="service">
                <img src="{{asset('assets/images/service/s1.jpg')}}" />
                <h3>KSA Retail </h3>
            </div>
            <div class="service">
                <img src="{{asset('assets/images/service/s2.jpg')}}" />
                <h3>KSA Distribution</h3>
            </div>
            <div class="service">
                <img src="{{asset('assets/images/service/s3.jpg')}}" />
                <h3>KSA Enterprise</h3>
            </div>
            <div class="service">
                <img src="{{asset('assets/images/service/s4.jpg')}}" />
                <h3>Bahrain</h3>
            </div>
            <div class="service">
                <img src="{{asset('assets/images/service/s5.jpg')}}" />
                <h3>Oman</h3>
            </div>
        </section>
    </div>
</section>

<section id="about_us">
    <div class="container">
        <div class="block_head sixteen columns">
            <h1>About Sale Company</h1>
        </div>
        <div class="portfolio_image columns">
            <img width="200" alt="" src="{{asset('assets/images/intro_dfd.png')}}">
        </div>
        <div class="portfolio seven columns" style="direction: rtl; text-align: right">
            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
            <p>This is Photoshop's version  of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate.</p>
        </div>
        <div class="portfolio_image five columns">
            <img alt="" src="{{asset('assets/images/intro_bg.jpg')}}">
        </div>
    </div>
</section>

<section id="contact">
    <div class="container">
        <div class="footer_box two columns">
            <p>
                <img style="width: 100px; margin-top: 20px" src="{{asset('assets/images/qr_img.png')}}">
            </p>
        </div>
        <div class="footer_box contact_info white five columns">
            <span class="white">Sale Advanced Company LTD</span>
            <p>
                <small>Riyadh, 11622, KSA</small><br>
                <small>P.O.BOX 8624</small><br>
                <small>Tel: +966114949900</small><br>
                <small>Fax: +966114949910</small><br>
                <small>Email: info@sale-co.com</small><br>
            </p>
        </div>
        <div class="footer_box three columns">
            <p><a>About Sale</a></p>
            <p><a>Our Values</a></p>
            <p><a>Board Of Directors</a></p>
            <p><a>Social Responsibly</a></p>
        </div>
        <div class="footer_box three columns">
            <p><a>News Letter</a></p>
            <p><a>Corporate Profile</a></p>
            <p><a>Store Locator</a></p>
            <p><a>Location Map</a></p>
        </div>
    </div>
</section>
<footer>
    <div class='container'>
        <div class="sixteen columns">
            <p>All rights reserved to Sale Advanced Company LTD 2009 - 2014 &copy; Done by <a href="http://vip4it.com" target="_blank"><strong>Virtual Integrated Projects</strong></a></p>
        </div>
    </div>
</footer>

<script type="text/javascript">stLight.options({publisher: "22b28415-0497-47d4-bd55-45fec90f3b3e", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
<script>
    var options={ "publisher": "22b28415-0497-47d4-bd55-45fec90f3b3e", "position": "left", "ad": { "visible": false, "openDelay": 5, "closeDelay": 0}, "chicklets": { "items": ["facebook", "twitter", "linkedin"]}};
    var st_hover_widget = new sharethis.widgets.hoverbuttons(options);
</script>

<!-- End Document
================================================== -->
<script src="{{ URL::asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/scripts.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/jquery.bxslider.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/retina-1.1.0.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('assets/js/tweetable.jquery.js') }}" type="text/javascript"></script>
</body>
</html>