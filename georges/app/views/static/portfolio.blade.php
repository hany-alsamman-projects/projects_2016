<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Portfolio | Georges Andraos</title>
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/main.css')}}"/>
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
</head>

<body>

<!-- background image slider -->
<div id="slides">

    <div class="slides-container">
        @foreach(HomeController::GetSlides() as $slide)
            <img src="{{asset("upload/slides/$slide->img_id")}}" class="photo" title="{{$slide->description}}" alt="Background image 1">
        @endforeachs
    </div>

    <nav class="slides-navigation">
        <a href="#" class="next"></a>
        <div class="info-box-button"></div>
        <a href="#" class="prev"></a>
    </nav>

    <script>
        $(document).ready(function(){
            $('.info-box-button').hover(function(){
                $("img.photo").each(function() {
                    if($(this).is(':visible')) {
                        $(".info-box").html($(this).attr('title'));
                        $('.info-box').show();
                    }
                });
            });

            $( ".info-box-button" ).hover(
                    function() {
                        $("img.photo").each(function() {
                            if($(this).is(':visible')) {
                                $(".info-box").html($(this).attr('title'));
                                $('.info-box').show();
                            }
                        });
                    }, function() {
                        $('.info-box').hide();
                    }
            );
        });
    </script>

    <div class="info-box">
        Info box
    </div>

    <!-- Navigation -->
    <div id="nav">

        <!-- Logo -->
        <div class="logo">
            <a href="{{ route('home') }}"><img src="{{asset("assets/img/logo.png")}}" alt="Website logo"></a>
        </div>

        <!-- Links -->
        <nav class="nav-links">
            <li><a href="{{ route('home') }}">Georges Andraos</a></li>
            <li style="border-bottom: 1px solid black;"><a href="{{ route('portfolio') }}">Portfolio</a></li>
        </nav>

    </div>

    <!-- Hide and show button -->
    <script>
        $(document).ready(function(){

            // Hide button
            $('.hide-navigation').click(function(){
                $('#nav').fadeOut();
                $('.hide-navigation').hide();
                $('.show-navigation').show();
            });

            // Show button
            $('.show-navigation').click(function(){
                $('#nav').fadeIn();
                $('.show-navigation').hide();
                $('.hide-navigation').show();
            });
        });
    </script>

    <div class="hide-and-show-button">
        <div class="hide-navigation">- Hide</div>

        <div class="show-navigation">+ Show</div>
    </div>

</div>

<script src="{{asset('assets/js/slider/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('assets/js/slider/jquery.animate-enhanced.min.js')}}"></script>
<script src="{{asset('assets/js/slider/jquery.superslides.js')}}" type="text/javascript" charset="utf-8"></script>
<script>
    $(function() {
        $('#slides').superslides({
            animation: 'fade'
        });
    });
</script>

</body>
</html>

