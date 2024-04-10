<!doctype html>
<!-- Conditional comment for mobile ie7 blogs.msdn.com/b/iemobile/ -->
<!--[if IEMobile 7 ]>    <html class="no-js iem7" lang="en"> <![endif]-->
<!--[if (gt IEMobile 7)|!(IEMobile)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->

<head>
  <meta charset="utf-8" />

  <title></title>
  <meta name="description" content="" />

  <!-- Mobile viewport optimization h5bp.com/ad -->
  <meta name="HandheldFriendly" content="True" />
  <meta name="MobileOptimized" content="320" />
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0" />

  <!-- Home screen icon  Mathias Bynens mathiasbynens.be/notes/touch-icons -->
  <!-- For iPhone 4 with high-resolution Retina display: -->
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/icon.png" />
  <!-- For first-generation iPad: -->
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/icon.png" />
  <!-- For non-Retina iPhone, iPod Touch, and Android 2.1+ devices: -->
  <link rel="apple-touch-icon-precomposed" href="images/icon.png" />
  <!-- For nokia devices: -->
  <link rel="shortcut icon" href="images/icon.png" />
  
  


  <!-- iOS web app, delete if not needed. https://github.com/h5bp/mobile-boilerplate/issues/94 -->
  <meta name="apple-mobile-web-app-capable" content="yes" />
  <meta name="apple-mobile-web-app-status-bar-style" content="black" /> 
  <!-- <script>(function(){var a;if(navigator.platform==="iPad"){a=window.orientation!==90||window.orientation===-90?"img/startup-tablet-landscape.png":"img/startup-tablet-portrait.png"}else{a=window.devicePixelRatio===2?"img/startup-retina.png":"img/startup.png"}document.write('<link rel="apple-touch-startup-image" href="'+a+'"/>')})()</script> -->
  
  <!-- The script prevents links from opening in mobile safari. https://gist.github.com/1042026 -->
  <!-- <script>(function(a,b,c){if(c in b&&b[c]){var d,e=a.location,f=/^(a|html)$/i;a.addEventListener("click",function(a){d=a.target;while(!f.test(d.nodeName))d=d.parentNode;"href"in d&&(d.href.indexOf("http")||~d.href.indexOf(e.host))&&(a.preventDefault(),e.href=d.href)},!1)}})(document,window.navigator,"standalone")</script> -->
  
  <!-- Mobile IE allows us to activate ClearType technology for smoothing fonts for easy reading -->
  <!--<meta http-equiv="cleartype" content="on">--> <!-- not w3 compatible, use if wanted anyway -->

  <!-- more tags for your 'head' to consider h5bp.com/d/head-Tips -->
  
  
  <!-- fonts -->
  <link href='http://fonts.googleapis.com/css?family=Roboto:200,400,600' rel='stylesheet' type='text/css' />

  <!--<link href='http://fonts.googleapis.com/css?family=Quattrocento:400,700' rel='stylesheet' type='text/css'>-->
  
  <!--<link rel="stylesheet" href="css/style.less">-->
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/jquery.qtip.min.css" />
  <link rel="stylesheet" href="css/flexslider.css" />
  <link rel="stylesheet" href="css/photoswipe.css" />
  <link rel="stylesheet" href="css/add2home.css" />
    
  
  <link rel="stylesheet/less" href="css/style.php?color=199dd4" />
  <script src="js/less-1.3.0.min.js"></script>
  
  <!-- Main Stylesheet -->
  <!--<link rel="stylesheet" href="css/style.css">-->
  
  <!-- All JavaScript at the bottom, except for Modernizr which enables HTML5 elements & feature detects -->
  <script src="js/libs/modernizr-2.0.6.min.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>
<body>
  <!-- Splash screen -->
  
  <div id="splash"> 
    <img id="splash-bg" src="images/splash/splash.png" alt="splash image" />
    <p id="splash-title"><img src="images/splash/main.png" alt="splash title" /><br />Loading...</p>
  </div>
  
  <!-- end splash screen -->
  <div id="container">
    <!--<header>
      <div id="header">
        <div class="navigation"> 
          
        </div>
      </div>
    </header>-->
    
    <div class="page-loader">
      <img alt="Image-alt" src="images/general-loader.gif" />
      <p>Please wait</p>
    </div>
    <div class="main-area">
      <img alt="wallpaper" class="wallpaper" src="images/androidy.jpg" />
      <img alt="logo" class="logo" src="images/splash/main.png?" width="131" />
      
      
      <!-- flexslider -->
      <div class="slider-container main-nav-container">
        <div class="flexslider">
          <ul class="slides" id="main-nav">
            <li>
              <a href="pages/default.php" id="about"><img alt="Image-alt" src="images/icons/nav/about-icon.png" /></a>
              <p class="flex-caption">About</p>
            </li>
            <li>
              <a href="pages/about.php" id="typography"><img alt="Image-alt" src="images/icons/nav/typo.png" /></a>
              <p class="flex-caption">News</p>
            </li>
            <li>
              <a href="pages/portfolio.php" id="portfolio"><img alt="Image-alt" src="images/icons/nav/portfolio.png" /></a>
              <p class="flex-caption">Filker</p>
            </li>
            <li>
              <a href="pages/blog.php" id="blog"><img alt="Image-alt" src="images/icons/nav/blog-icon.png" /></a>
              <p class="flex-caption">Blog</p>
            </li>
            <li>
              <a href="pages/contact.php" id="contact"><img alt="Image-alt" src="images/icons/nav/contact-icon.png" /></a>
              <p class="flex-caption">Contact</p>
            </li>
          </ul>
          <div class="clear"></div>
        </div>
        <br />
        <div class="loading-progress-container">
          <p class="loading-progress">Please wait...</p>
        </div>
      </div>
      
      <!-- end flexslider -->
      
    </div>
    <div class="page wider">
      <div class="page-content" id="page-content">
        <div class="scrollable-area">
          <!-- This is content area, pages will load here via ajax -->
        </div>
      </div>
    </div>
    <div class="footer-menu">
        <div class="footer-menu-bg"></div>
        <div class="footer-menu-content">
          <div class="footer-menu-section">
            <ul class="footer-menu-links">
              <li><p>social media</p></li>
              <li><a target="_blank" href="http://twitter.com/">twitter</a></li>
              <li><a target="_blank" href="http://facebook.com">facebook</a></li>
              <li><a target="_blank" href="http://linkedin.com">linked in</a></li>
              <li><p>legal</p></li>
              <li><a id="copyright" class="ajaxify" href="pages/copyright.php">copyright</a></li>
              <li><a id="disclaimer" class="ajaxify" href="pages/disclaimer.php">disclaimer</a></li>
            </ul>
          </div>
        </div>
    </div>
    <footer>
      <div id="footer-bg"></div>
      <div id="footer-links">
        <a id="back-button" href="#" class="left-icon icon back-trigger"><img alt="icon" src="images/icons/back-icon.png" /></a>
        <a id="home-button" href="#" class="middle-icon icon home-trigger"><img alt="icon" src="images/icons/home-icon.png" /></a>
        <a href="#" class="footer-menu-trigger right-icon icon"><img alt="icon" src="images/icons/list-icon.png" /></a>
      </div>
      
    </footer>
  </div> <!--! end of #container -->


  <!-- JavaScript at the bottom for fast page loading -->

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if necessary -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <script src="js/jquery.qtip.min.js"></script>
  <script src="js/helper.js"></script>
  <script src="js/jquery.flexslider-min.js"></script>
  <script src="js/iphone-style-checkboxes.js"></script>
  <script src="js/klass.min.js"></script>
  <script src="js/code.photoswipe.jquery-3.0.5.min.js"></script>
  <script src="js/add2home.js"></script>
  <script src="js/iscroll-lite.js"></script>
  <script src="js/jquery.mousewheel.js"></script>
  
  <script src="http://maps.google.com/maps/api/js?sensor=false"></script>
  <script src="js/script.js"></script>
  
  <!-- end scripts-->

</body>
</html>
