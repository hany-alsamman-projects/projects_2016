
<!doctype html>
<html lang="en" class="a">
<head>
    <meta charset="utf-8">
    <title>ماجستي ميديا حجز فندق</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="javascript/head.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/screen.css" media="screen">
    <link rel="stylesheet" type="text/css" href="styles/print.css" media="print">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
<div id="root">
<header id="top">
    <h1><a href="./" accesskey="h"></a></h1>
    <nav id="skip">
        <ul>
            <li><a href="#nav" accesskey="n">Skip to navigation (n)</a></li>
            <li><a href="#content" accesskey="c">Skip to content (c)</a></li>
            <li><a href="#footer" accesskey="f">Skip to footer (f)</a></li>
        </ul>
    </nav>
				<nav id="nav">
					<ul class="primary">
						<li class="active"><a accesskey="1" href="index.php">الرئيسية</a> <em>(1)</em></li>
						<li><a accesskey="3" href="#">عرض الفنادق</a> <em>(3)</em></li>
						
						<li><a accesskey="4" href="search.php">بحث عن فندق</a> <em>(4)</em></li>

						<li><a accesskey="5" href="booking.php">حجز فندق</a> <em>(5)</em></li>

						<li><a accesskey="6" href="aboutus.php">عن ماجستي</a> <em>(6)</em></li>

						<li><a accesskey="7" href="contactus.php">اتصل بنا</a> <em>(7)</em></li>
					</ul>
					<ul class="secondary">
						<li><span>AR</span></li>
						<li><span>USD</span>						</li>
					</ul>
					<p class="link-a"><a href="booking.php">دخول العملاء</a> <a href="booking.php">تسجيل</a></p>
				</nav>
    <form action="./" method="post" id="search">
        <fieldset>
            <legend>البحث</legend>
            <p>
                <label for="sa">البحث</label>
                <input type="text" id="sa" name="sa" required>
                <button type="submit">Submit</button>
            </p>
        </fieldset>
    </form>
    <p class="tel">اتصل بنا<span>(00) - 0000 000 000</span></p>
</header>

<nav id="breadcrumbs" style="margin-top: 100px">
				<ul>

					<li>حجز فندق</li>
                    <li><a href="./">الرئيسية</a></li>
				</ul>
			</nav>                
			<section id="content" class="cols-e">
				<article class="news-e">
					<header>
						<figure><img src="temp/693x276(1).gif" alt="Placeholder" width="669" height="272"></figure>
					</header>
					<p style="font-size: 15px; float: right">
                    قريبا حجز مباشر تقدمه شبكة ماجستي
					</p>
				</article>
				<aside>
                    <h3 style="font-family: tahoma; float: right">تابعو اخبارنا على تويتر</h3>
                    <div class="tweets-a"></div>
				</aside>
			</section>
            <footer id="footer">
                <p>Copyright &copy; <span class="date">2013</span>. All rights reseved | Powered by: <a href="http://majeste.me" target="_blank">Majeste</a></p>
                <ul id="social">
                    <li class="rs"><a rel="external" href="./">RSS</a></li>
                    <li class="tw"><a rel="external" href="./">Twitter</a></li>
                    <li class="fl"><a rel="external" href="./">Flickr</a></li>
                    <li class="fb"><a rel="external" href="./">Facebook</a></li>
                </ul>
            </footer>
            </div>
        <script src="http://maps.google.com/maps/api/js?sensor=false&amp;libraries=geometry&amp;language=en"></script>

        <script src="javascript/jquery.min.js"></script>
        <script src="javascript/jquery-ui.min.js"></script>
        <script src="javascript/scripts.js"></script>
        <script src="javascript/mobile.js"></script>
        <script>
            $(function(){

                var newBg = ['featured-d.jpg', 'featured-c.jpg'];
                var path="temp/";
                var i = 0;

                var changeBg = setTimeout(function() {

                    //$('#home').css({backgroundImage : 'url(' + path + newBg[i] + ')'});
                    $('#home')
                            .animate({opacity: 0}, 'slow', function() {
                                $(this)
                                        .css({'background-image': 'url(' + path + newBg[i] + ')'})
                                        .animate({opacity: 1});
                            });

                }, 12000);
            });
        </script>

	</body>
</html>
