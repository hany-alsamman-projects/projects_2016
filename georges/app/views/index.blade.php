<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Georges Andraos</title>

    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

    <link href="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
</head>

<body>
<script type="text/javascript">

    $.fn.editable.defaults.mode = 'inline';

    $(document).ready(function() {

        @if(Sentry::check())
        localStorage.setItem('admin', 'yes');
        @else
        localStorage.setItem('admin', 'no');
        @endif

        $('#wrapper').hide();
        $('#video-intro').hide();

        var $vid = $("#intro-play");

        $vid.bind("canplaythrough", function(){

            $('#load-intro').slideUp('slow', function(){

                $('#video-intro').fadeIn('slow').show();
                $('.should_skip').fadeIn('slow').show();

            });
        });

        $vid.get(0).load();

        $vid.on('ended',function(){
            $('#video-intro').slideDown();
            $('#wrapper').fadeIn('slow');
        });

        $(".should_skip").click(function () {

            $vid.trigger("ended");

        });

        if(localStorage.getItem('admin') == 'yes'){

            $('#intro-text-1').editable({
                type: 'textarea',
                pk: 1,
                url: '/post',
                tpl: "<textarea style='width: 400px; height: 100px'></textarea>"
            });

            $('#intro-text-2').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 400px'>"
            });

            $('#page-address').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 300px'>"
            });


            $('#page-info').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 300px'>"
            });

            $('#page-email').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 300px'>"
            });

            $('#page-fb').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 300px'>"
            });

            $('#page-twitter').editable({
                type: 'text',
                pk: 1,
                url: '/post',
                tpl: "<input type='text' style='width: 300px'>"
            });

        }

    });
</script>

<div id="load-intro">
    <div class="loading">Loading ... </div>
</div>

<!-- Video intro -->
<div id="video-intro">
    <video id="intro-play" autoplay preload="metadata">
        <source src="{{asset("assets/img/homepage-video.mp4")}}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <div class="should_skip">Skip intro</div>
</div>

<div id="wrapper">

    <!-- background image -->
    <div id="bg">
        <img src="{{asset("assets/img/homepage.jpg")}}" alt="Homepage image">
    </div>

    <!-- Navigation -->
    <div id="nav">

        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{asset("assets/img/logo.png")}}" alt="Georges Andraos Website"></a>
        </div>

        <!-- Links -->
        <nav class="nav-links">
            <li><a href="{{ route('home') }}">Georges Andraos</a></li>
            <li style="border-bottom: 1px solid black;"><a href="{{ route('portfolio') }}">Portfolio</a></li>
        </nav>

    </div>

    <!-- Intro text -->
    <div class="intro-text">
        <p id="intro-text-1">Welcome to GEORGES ANDRAOS Furniture Design, the preeminent designer and producer of fine, hand-crafted, contemporary and modern furniture made from the finest textures and materials.</p>

        <p id="intro-text-2" style="font-weight: bold;">“It is sometimes easier to have furniture made than to find things.”</p>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <p>
            <span id="page-address">Dora seaside, Imasdounian Building, 2nd floor</span><br>
            <span id="page-info">T: 00.961.1.243 222 F: 00.961.1.243 111 M: 00.961.3.568 795</span>
            <br>
            <span id="page-email">E: georges@georges-andraos.com</span>
        </p>

        <!-- Social links -->
        <div class="footer-social-link">
            <a id="page-fb" href="http://www.facebook.com">
                <img src="{{asset("assets/img/facebook.png")}}" alt="Facebook link"/>
            </a>

            <a id="page-twitter" href="http://www.twitter.com">
                <img src="{{asset("assets/img/twitter.png")}}" alt="Facebook link"/>
            </a>
        </div>
    </footer>
</div>
</body>
</html>