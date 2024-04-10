
<!doctype html>
<html lang="en" class="a">
<head>
    <meta charset="utf-8">
    <title>ماجستي ميديا</title>
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
            <li class="gb"><span>AR</span>
                <ul>
                    <li class="en"><a href="./">english</a></li>
                </ul>
            </li>
            <li><span>AED</span>
                <ul>
                    <li><a href="./">EUR</a></li>
                </ul>
            </li>
        </ul>
        <p class="link-a"><a href="./">دخول العملاء</a> <a href="./">تسجيل</a></p>
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

					<li>اتصل بنا</li>
                    <li><a href="./">الرئيسية</a></li>
				</ul>
			</nav>                
			<article id="content" class="cols-b">
				<div style="float: right; text-align:right">
				<form  onSubmit="return submitForm();" action="" method="post" class="form-b" name="homefrm1" id="homefrm1">
					<input type="hidden"  name="event" value="start" />
					<fieldset>
						<div id="alert">
								<div class="message"></div>
						</div>
						<legend></legend>
						<p>
							<label for="fba">الاسم</label>
							<input type="text" id="fba" name="name" required>
						</p>
						<p>
							<label for="fbb">البريد</label>
							<input type="email" id="fbb" name="email" required>
						</p>
						<p>
							<label for="fbc">نص الرسالة</label>
							<textarea id="fbc" name="msg" required></textarea>
						</p>
						<p><button type="submit">ارسال</button></p>
					</fieldset>
				</form>
				</div>
				<div style="float: left">

					<figure ><img src="temp/693x283.gif" width="640"  alt=""></figure>
				</div>
			</article>
            <footer id="footer">
                <p>Copyright &copy; <span class="date">2013</span>. All rights reseved | Powered by: <a href="http://majeste.net" target="_blank">Majeste International</a></p>
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


	</body>
</html>
