<!DOCTYPE html>

<!--[if IEMobile 7]><html class="no-js iem7 oldie"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html class="no-js ie7 oldie" lang="en"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html class="no-js ie8 oldie" lang="en"><![endif]-->
<!--[if (gt IE 8)|(gt IEMobile 7)]><!--><html class="no-js" lang="en"><!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

    <title>Dashboard :: <?= SITE_NAME ?></title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- http://davidbcalhoun.com/2010/viewport-metatag -->
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <!-- http://www.kylejlarson.com/blog/2012/iphone-5-web-design/ -->
    <meta name="viewport" content="user-scalable=0, initial-scale=1.0">

    <!-- Scripts -->
    <script src="js/libs/jquery-1.9.1.min.js"></script>

    <!-- For all browsers -->
    <link rel="stylesheet" href="css/reset.css?v=1">
    <link rel="stylesheet" href="css/style.css?v=1">
    <link rel="stylesheet" href="css/colors.css?v=1">
    <link rel="stylesheet" href="css/styles/form.css?v=1">
    <link rel="stylesheet" href="css/styles/switches.css?v=1">

    <link rel="stylesheet" href="css/styles/table.css?v=1">

    <!-- DataTables -->
    <link rel="stylesheet" href="js/libs/DataTables/jquery.dataTables.css?v=1">

    <link rel="stylesheet" href="js/libs/glDatePicker/developr.css">
    <link rel="stylesheet" href="js/libs/formValidator/developr.validationEngine.css">

    <link rel="stylesheet" media="print" href="css/print.css?v=1">
    <!-- For progressively larger displays -->
    <link rel="stylesheet" media="only all and (min-width: 480px)" href="css/480.css?v=1">
    <link rel="stylesheet" media="only all and (min-width: 768px)" href="css/768.css?v=1">
    <link rel="stylesheet" media="only all and (min-width: 992px)" href="css/992.css?v=1">
    <link rel="stylesheet" media="only all and (min-width: 1200px)" href="css/1200.css?v=1">
    <!-- For Retina displays -->
    <link rel="stylesheet" media="only all and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 3/2), only screen and (min-device-pixel-ratio: 1.5)" href="css/2x.css?v=1">

    <!-- Webfonts
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300' rel='stylesheet' type='text/css'>-->

    <!-- Additional styles -->

    <!-- JavaScript at bottom except for Modernizr -->
    <script src="js/libs/modernizr.custom.js"></script>

    <!-- For Modern Browsers -->
    <link rel="shortcut icon" href="img/favicons/favicon.png">
    <!-- For everything else -->
    <link rel="shortcut icon" href="img/favicons/favicon.ico">

    <!-- iOS web-app metas -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

    <!-- iPhone ICON -->
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon.png" sizes="57x57">
    <!-- iPad ICON -->
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-ipad.png" sizes="72x72">
    <!-- iPhone (Retina) ICON -->
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-retina.png" sizes="114x114">
    <!-- iPad (Retina) ICON -->
    <link rel="apple-touch-icon" href="img/favicons/apple-touch-icon-ipad-retina.png" sizes="144x144">

    <!-- iPhone SPLASHSCREEN (320x460) -->
    <link rel="apple-touch-startup-image" href="img/splash/iphone.png" media="(device-width: 320px)">
    <!-- iPhone (Retina) SPLASHSCREEN (640x960) -->
    <link rel="apple-touch-startup-image" href="img/splash/iphone-retina.png" media="(device-width: 320px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPhone 5 SPLASHSCREEN (640×1096) -->
    <link rel="apple-touch-startup-image" href="img/splash/iphone5.png" media="(device-height: 568px) and (-webkit-device-pixel-ratio: 2)">
    <!-- iPad (portrait) SPLASHSCREEN (748x1024) -->
    <link rel="apple-touch-startup-image" href="img/splash/ipad-portrait.png" media="(device-width: 768px) and (orientation: portrait)">
    <!-- iPad (landscape) SPLASHSCREEN (768x1004) -->
    <link rel="apple-touch-startup-image" href="img/splash/ipad-landscape.png" media="(device-width: 768px) and (orientation: landscape)">
    <!-- iPad (Retina, portrait) SPLASHSCREEN (2048x1496) -->
    <link rel="apple-touch-startup-image" href="img/ipad-portrait-retina.png" media="(device-width: 1536px) and (orientation: portrait) and (-webkit-min-device-pixel-ratio: 2)">
    <!-- iPad (Retina, landscape) SPLASHSCREEN (1536x2008) -->
    <link rel="apple-touch-startup-image" href="img/ipad-landscape-retina.png" media="(device-width: 1536px)  and (orientation: landscape) and (-webkit-min-device-pixel-ratio: 2)">

    <!-- Microsoft clear type rendering -->
    <meta http-equiv="cleartype" content="on">

    <!-- IE9 Pinned Sites: http://msdn.microsoft.com/en-us/library/gg131029.aspx -->
    <meta name="application-name" content="">

</head>

<body dir="rtl" class="clearfix with-menu with-shortcuts">

<!-- Prompt IE 6 users to install Chrome Frame -->
<!--[if lt IE 7]><p class="message red-gradient simpler">Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->

<!-- Title bar -->
<header role="banner" id="title-bar">
    <h2><?= SITE_NAME ?></h2>
</header>

<!-- Button to open/hide menu -->
<a href="#" id="open-menu"><span>القائمة</span></a>

<!-- Button to open/hide shortcuts -->
<a href="#" id="open-shortcuts"><span class="icon-thumbs"></span></a>

<!-- Main content -->
<section role="main" id="main">

    <!-- Visible only to browsers without javascript -->
    <noscript class="message black-gradient simpler">Your browser does not support JavaScript! Some features won't work as expected...</noscript>

    <!-- Main title
    <hgroup id="main-title" class="thin">
        <h1>الرئيسية</h1>
    </hgroup>-->

    <!-- The padding wrapper may be omitted -->
    <div class="with-padding">

        <?
        $this->CHECK_PAGES();
        ?>

    </div>

</section>
<!-- End main content -->

<!-- Side tabs shortcuts -->
<ul id="shortcuts" role="complementary" class="children-tooltip tooltip-right">
    <li class="current"><a href="./" class="shortcut-dashboard" title="الرئيسية">الرئيسية</a></li>
    <li><a href="index.php?section=ShowStore" class="shortcut-stats" title="مشاهدة المنتجات">المتجر</a></li>
    <li><a href="index.php?section=ShowMembers" class="shortcut-contacts" title="عرض المشتركين">المشتركين</a></li>

</ul>

<!-- Sidebar/drop-down menu -->
<section id="menu" role="complementary">

    <!-- This wrapper is used by several responsive layouts -->
    <div id="menu-content">

        <header>
            قائمة الادارة
        </header>

        <div id="profile">
            <img src="img/user.png" width="64" height="64" alt="User name" class="user-icon">
            اهلا بك
            <br><br><? print $_SESSION["user_name"] ?>
            <br><small>(IP: <? print $_SESSION["ip"] ?>)</small>
        </div>

        <!-- By default, this section is made for 4 icons, see the doc to learn how to change this, in "basic markup explained" -->
        <ul id="access" class="children-tooltip">
            <!-- Icon with count -->
            <li><a href="#" title="Messages">
                    <span class="icon-inbox"></span>
                    <span class="count">2</span>
                </a></li>
            <!-- Disabled icon -->
            <li><a href="#" title="الاعدادات">
                    <span class="icon-gear"></span></a>
            </li>
            <!-- Disabled icon -->
            <li><a href="index.php?section=logout" title="تسجيل خروج">
                    <span class="icon-logout"></span></a>
            </li>
        </ul>

        <!-- Navigation menu goes here -->

        <section class="navigable">
            <ul class="big-menu">
                <li class="with-left-arrow">
                    <span><span class="list-count">2</span>ادارة المتجر</span>
                    <ul class="big-menu">
                        <li><a href="index.php?section=AddToStore">اضافة كتاب</a></li>
                        <li><a href="index.php?section=ShowStore">مشاهدة الكتب</a></li>

                    </ul>
                </li>
                <li class="with-left-arrow">
                    <span><span class="list-count">2</span>ادارة المشتركين</span>
                    <ul class="big-menu">
                        <li><a href="#">اضافة حساب</a></li>
                        <li><a href="#">مشاهدة الحسابات</a></li>
                    </ul>
                </li>
            </ul>
        </section>

    </div>
    <!-- End content wrapper -->

    <!-- This is optional -->
    <footer id="menu-footer">
        <!-- Any content -->
    </footer>

</section>
<!-- End sidebar/drop-down menu -->

<!-- JavaScript at the bottom for fast page loading -->

<!-- Setup functions -->
<script src="js/setup.js"></script>

<!-- Template functions -->
<script src="js/developr.input.js"></script>
<script src="js/developr.navigable.js"></script>
<script src="js/developr.notify.js"></script>
<script src="js/developr.scroll.js"></script>
<script src="js/developr.tooltip.js"></script>
<script src="js/libs/glDatePicker/glDatePicker.min.js"></script>
<script src="js/libs/formValidator/jquery.validationEngine.js"></script>
<script src="js/libs/formValidator/languages/jquery.validationEngine-ar.js"></script>
<script src="js/developr.table.js"></script>
<!-- Plugins -->
<script src="js/libs/jquery.tablesorter.min.js"></script>
<script src="js/libs/DataTables/jquery.dataTables.min.js"></script>
<script src="js/libs/jquery-ui.js"></script>
<!-- Libs go here -->
</body>
</html>