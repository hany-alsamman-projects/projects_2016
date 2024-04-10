<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8"/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/> 
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/> 
		<title>Portfolio | Georges Andraos</title>
		<link rel="stylesheet" type="text/css" href="css/main.css"/>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>	
	</head>
	
	<body>
			
		<!-- background image slider -->
		<div id="slides">
			<div class="slides-container">
				<img src="img/01.jpg" alt="Background image 1">
				<img src="img/02.jpg" width="1024" height="682" alt="background image 2">
			</div>

			<nav class="slides-navigation">
				<a href="#" class="next"></a>
				<div class="info-box-button"></div>
				<a href="#" class="prev"></a>
			</nav>
			
			<script>
			$(document).ready(function(){
				$('.info-box-button').click(function(){
					$('.info-box').toggle();
				});
			});
			</script>
			
			<div class="info-box">
				Info box
			</div>
			
			<!-- Navigation -->
			<div id="nav">
					
				<!-- Logo -->
				<div class="logo">
					<a href="index.php"><img src="img/logo.png" alt="Website logo"></a>
				</div>
					
				<!-- Links -->
				<nav class="nav-links">
						
					<li><a href="index.php">Georges Andraos</a></li>
						
					<li style="border-bottom: 1px solid black;"><a href="portfolio.php">Portfolio</a></li>
					
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
			
		<script src="js/slider/jquery.easing.1.3.js"></script>
		<script src="js/slider/jquery.animate-enhanced.min.js"></script>
		<script src="js/slider/jquery.superslides.js" type="text/javascript" charset="utf-8"></script>
		<script>
		$(function() {
			$('#slides').superslides({
				animation: 'fade'
			});
		});
		</script>			

	</body>
</html>	
	
	