<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->

<head>
	<meta charset="utf-8" />
	<title>Bir</title>
	<meta name="description" content="" />
	<meta name="author" content="" />

	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1" />
            
        <!-- [if lt IE 9]
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- Stylesheets -->
	<link rel="stylesheet" href="css/font-awesome.css" />
	<!--[if IE 7]>
		<link rel="stylesheet" href="css/font-awesome-ie7.min.css">
	<![endif]-->
	<link rel="stylesheet" href="css/fonts/stylesheet.css" />
	<link rel="stylesheet" href="css/bootstrap.css" />
	<link id="scheme" rel="stylesheet" href="css/schemes/dark-blue.css" />
	<link rel="stylesheet" href="css/responsive.css" />

	<!-- Favicon and Apple Icons -->
	<link rel="shortcut icon" href="/favicon.ico" />
	<link rel="apple-touch-icon" href="/touch-icon-iphone.png" />
	<link rel="apple-touch-icon" sizes="72x72" href="touch-icon-ipad.png" />
	<link rel="apple-touch-icon" sizes="114x114" href="touch-icon-iphone4.png" />
	<link rel="apple-touch-icon-precomposed" href="/touch-icon-android.png" />

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /></head>

<body>

	<!-- MAIN HEADER -->
	<header class="container header-top">
		<div class="row-fluid">
			<!-- Logo -->
			<div class="span2">
					<h1 id="logo"><a href="index.php" class="hide-text">BIR Creative</a></h1>
			</div>
			<div class="span10 nav-main">
				<!-- Social Icons -->
				<ul class="social-icons">
					<li><a href="#" class="icon-facebook"></a></li>
					<li><a href="#" class="icon-twitter"></a></li>
					<li><a href="#" class="icon-linkedin"></a></li>
					<li><a href="#" class="icon-google-plus"></a></li>
				</ul>
				<!-- Navigation -->
				<nav>	
					<ul id="nav" class="nav">
						<li><a href="index.php">Home <span>Front-Page</span></a></li>
						<li><a href="portfolio.php">Works <span>Our Portfolio</span></a>
							<ul class="sub-menu">
								<li><a href="portfolio.php">Portfolio Default</a></li>
								<li><a href="single-project.php">Single Project</a></li>
							</ul>
						</li>
						<li><a href="blog.php">Blog <span>News and blog</span></a>
							<ul class="sub-menu">
								<li><a href="blog.php">Default Blog</a></li>
								<li><a href="blog-full.php">Blog Full Width</a></li>
								<li><a href="blog-single.php">Single Post</a></li>
							</ul>
						</li>
						<li><a href="#">Pages <span>Theme Features</span></a>
							<ul class="sub-menu">
								<li><a href="about.php">Abous Us</a></li>
							</ul>
						</li>
						<li><a href="contact.php">Contact <span>Stay in touch</span></a></li>
					</ul>
				</nav>
			</div>
		</div>
	</header>
	<!-- end: MAIN HEADER -->





	<div class="divider"></div>	<!-- HEADER TEXT -->
	<div class="container header_text">
		<div class="page-title">
			<h1>Get <em>In Touch</em></h1>
		</div>
	</div>
	<!-- end: HEADER TEXT -->



	<div class="divider"></div>


	<!-- Contact Us -->
	<div class="contact_us container">
		<div class="row-fluid">
			<div id="map" class="span6"></div>
			<div class="contact_form span6 no_margin">
				<div class="inner">
					<form action="" method="post" id="form" class="row-fluid" />
						<div class="span6">
						    <label for="name">Name <span>(Required)</span></label><br />
						    <input type="text" name="um_name" id="name" />
						</div>
						<div class="span6">
						    <label for="email">Email <span>(Required)</span></label><br />
						    <input type="text" name="um_email" id="email" />
						</div>
						<div class="span12 no_margin margin_top">
						    <label for="message">Message:</label><br />
						    <textarea name="um_message" id="message"></textarea>
						</div>
						<div class="span12 no_margin margin_top">
						    <input type="submit" value="Send" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- end: Contact Us -->
	

        <div id="footer">
		<div class="container">
			<div class="row footer-cnt">
				<div class="span3 widget">
					<h5>Find Us</h5>
					<p>351 Junior Avenue Atlanta, GA 30305</p>
					<p><strong>Email</strong> youremila@site.com</p>
					<p><strong>Phone</strong> 049 386 376</p>
				</div>
				<div class="span3 widget">
					<h5>About Us</h5>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
					tempor incididunt ut labore et dolore.</p>
				</div>
				<div class="span3 widget">
					<h5>Tweets</h5>
					<p id="twitter" />
				</div>
				<div class="span3 widget flickr">
					<h5>Flickr</h5>
				</div>
			</div>
		</div>
	</div>

	<div class="footer_bottom">
		<div class="container">
			<div class="row">
				<div class="span7">
					<p class="copyright">&copy; Copyright 2013</p>
				</div>
				<div class="span5">
					<p class="theme_author">Powered by Expression-Themes</p>
				</div>
			</div>
		</div>
		<a href="#nogo" class="go_top"><i class="icon-angle-up"></i></a>
	</div>



	<!-- JavaScript -->
	<script src="js/jquery.min.js"></script>
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&#038;sensor=false&#038;ver=3.0'></script>
	<script src="js/jquery.isotope.min.js"></script>
	<script src="js/selectnav.min.js"></script>
	<script src="js/jquery.slides.min.js"></script>
	<script src="js/custom.js"></script>
	<script src="STYLER/styler.1.0.js"></script>
	<script>$(document).ready(loadMaps);</script>


</body>
</html>