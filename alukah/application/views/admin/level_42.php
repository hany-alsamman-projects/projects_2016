<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs">
	
        <meta http-equiv="content-type" content="text/html; charset=windows-1256">
        <meta http-equiv="content-style-type" content="text/css">
        <meta http-equiv="content-script-type" content="text/javascript">
        <meta name="robots" content="noindex, nofollow" />
        
        <title>Dashboard :: <?= SITE_NAME ?></title>
        
        <link rel="stylesheet" type="text/css" href="css/blue.css" media="screen, projection, tv">
        <link type="text/css" rel="stylesheet" href="css/facebox.css"/>
        
        <!--[if lte IE 7.0]><link rel="stylesheet" type="text/css" href="css/ie.css" media="screen, projection, tv" /><![endif]-->
		<!--[if IE 8.0]>
			<style type="text/css">
				form.fields fieldset {margin-top: -10px;}
			</style>
		<![endif]-->
		
		<script type="text/javascript" src="js/jquery-1.3.1.min.js"></script>
        <script type="text/javascript" src="js/facebox.js"></script>
        <script type="text/javascript" src="js/ajaxfileupload.js"></script>
        <script type="text/javascript" src="js/createlic.js"></script>
        
		<!-- Adding support for transparent PNGs in IE6: -->
		<!--[if lte IE 6]>
			<script type="text/javascript" src="js/ddpng.js"></script>
			<script type="text/javascript">
				DD_belatedPNG.fix('#nav #h-wrap .h-ico');
				DD_belatedPNG.fix('.ico img');
				DD_belatedPNG.fix('.msg p');
				DD_belatedPNG.fix('table.calendar thead th.month a img');
				DD_belatedPNG.fix('table.calendar tbody img');
			</script>
		<![endif]-->
        
    	<script type="text/javascript">
        
        /*
            Password Strength Indicator 
         */
         
        $.fn.passwordStrength = function( options ){
        	return this.each(function(){
        		var that = this;that.opts = {};
        		that.opts = $.extend({}, $.fn.passwordStrength.defaults, options);
        
        		that.div = $(that.opts.targetDiv);
        		that.defaultClass = that.div.attr('class');
        
        		that.percents = (that.opts.classes.length) ? 100 / that.opts.classes.length : 100;
        
        		v = $(this)
        		.keyup(function(){
        			if( typeof el == "undefined" )
        			this.el = $(this);
        			var s = getPasswordStrength (this.value);
        			var p = this.percents;
        			var t = Math.floor( s / p );
        
        			if( 100 <= s )
        			t = this.opts.classes.length - 1;
        
        			this.div
        			.removeAttr('class')
        			.addClass( this.defaultClass )
        			.addClass( this.opts.classes[ t ] );
        		})
        		// Removed generate password button creation
        	});
        
        	function getPasswordStrength(H){
        		var D=(H.length);
        		
        		// Added below to make all passwords less than 4 characters show as weak
        		if (D<4) { D=0 }
        		
        		
        		if(D>5){
        			D=5
        		}
        		var F=H.replace(/[0-9]/g,"");
        		var G=(H.length-F.length);
        		if(G>3){G=3}
        		var A=H.replace(/\W/g,"");
        		var C=(H.length-A.length);
        		if(C>3){C=3}
        		var B=H.replace(/[A-Z]/g,"");
        		var I=(H.length-B.length);
        		if(I>3){I=3}
        		var E=((D*10)-20)+(G*10)+(C*15)+(I*10);
        		if(E<0){E=0}
        		if(E>100){E=100}
        		return E
        	}
        	
        	//Removed generate password function
        };
        
        
        
        $(document).ready(function(){
        
        //on click upload new picture animate plz
        $('#upload_box').hide();
        
            $('span#get_upload_box').toggle(function() {
                      $('#upload_box').fadeIn('slow', function() {
                        // Animation complete
                      });
            }, function() {
                      $('#upload_box').fadeOut('slow', function() {
                        // Animation complete
                      });
            });
            
        //Run Password Strength
        $('input[name="new_pass"]').passwordStrength({targetDiv: '#iSM',classes : Array('weak','medium','strong')});
        
        });
        
    	function ajaxFileUpload()
    	{
    		$("#loading")
    		.ajaxStart(function(){
    			$(this).show();
    		})
    		.ajaxComplete(function(){
    			$(this).hide();
    		});
    
    		$.ajaxFileUpload
    		(
    			{
    				url:'../application/models/doajaxfileupload.php',
    				secureuri:false,
    				fileElementId:'fileToUpload',
    				dataType: 'json',
    				success: function (data, status)
    				{
    					if(typeof(data.error) != 'undefined')
    					{
    						if(data.error != '')
    						{
    							//alert(data.error);
                                jQuery.facebox(data.error);
    						}else
    						{
    							//alert(data.msg);
                                jQuery.facebox(data.msg);
    						}
    					}
    				},
    				error: function (data, status, e)
    				{
    					//alert(e);
                        jQuery.facebox(e);
    				}
    			}
    		)
    		
    		return false;
    
    	}
    	</script>
        
		<script type="text/javascript">
			$(document).ready(function() {
			 
             
                $('a[rel*=facebox]').facebox();                
                
			    // Search input text handling on focus
					var $searchq = $("#search-q").attr("value");
				    $('#search-q.text').css('color', '#999');
					$('#search-q').focus(function(){
						if ( $(this).attr('value') == $searchq) {
							$(this).css('color', '#555');
							$(this).attr('value', '');
						}
					});
					$('#search-q').blur(function(){
						if ( $(this).attr('value') == '' ) {
							$(this).attr('value', $searchq);
							$(this).css('color', '#999');
						}
					});
				// Switch categories
					$('#h-wrap').hover(function(){
							$(this).toggleClass('active');
							$("#h-wrap ul").css('display', 'block');
						}, function(){
							$(this).toggleClass('active');
							$("#h-wrap ul").css('display', 'none');
					});
				// Handling with tables (adding first and last classes for borders and adding alternate bgs)
					$('tbody tr:even').addClass('even');
					$('table.grid tbody tr:last-child').addClass('last');
					$('tr th:first-child, tr td:first-child').addClass('first');
					$('tr th:last-child, tr td:last-child').addClass('last');
					$('form.fields fieldset:last-child').addClass('last');
				// Handling with lists (alternate bgs)
					$('ul.simple li:even').addClass('even');
				// Handling with grid views (adding first and last classes for borders and adding alternate bgs)
					$('.grid .line:even').addClass('even');
					$('.grid .line:first-child').addClass('firstline');
					$('.grid .line:last-child').addClass('lastline');
				// Tabs switching
					$('#box1 .content#box1-grid').hide(); // hide content related to inactive tab by default
					$('#box1 .header ul a').click(function(){
						$('#box1 .header ul a').removeClass('active');
						$(this).addClass('active'); // make clicked tab active
						$('#box1 .content').hide(); // hide all content
						$('#box1').find('#' + $(this).attr('rel')).show(); // and show content related to clicked tab
						return false;
					});
			});
		</script>
		
    </head><body>

		<div id="header">
			<div class="inner-container clearfix">
				<h1 id="logo">
					<a class="home" href="#" title="Go to admin's homepage">	<!-- your title -->
						<span class="ir"></span>
					</a><br>

				</h1>
				<div id="userbox">
					<div class="inner">
						<strong><? print $_SESSION["user_name"] ?> </strong><br />
                        <strong>(IP: <? print $_SESSION["ip"] ?>)</strong>
						<ul class="clearfix">
						</ul>
					</div>
					<a id="logout" href="index.php?section=logout">log out<span class="ir"></span></a>
				</div><!-- #userbox -->
			</div><!-- .inner-container -->
		</div><!-- #header -->
      	<div id="nav">
			<div class="inner-container clearfix">
				<div class="" id="h-wrap">
					<div class="inner">
						<h2>
							<span class="h-ico ico-dashboard"><a href="index.php?"><span>Dashboard</span></a></span>
							<span class="h-arrow"></span>
						</h2>
						<ul style="display: none;" class="clearfix">
							<!-- Admin sections - feel free to add/modify your own icons are located in "images/h-ico/*" -->
							<li><a class="h-ico ico-edit" href="index.php?section=Showcities"><span>Manage Cities</span></a></li>
<!--
							<li><a class="h-ico ico-media" href="#"><span>Media</span></a></li>
							<li><a class="h-ico ico-syndication" href="#"><span>Syndication</span></a></li>
							<li><a class="h-ico ico-send" href="#"><span>Newsletter</span></a></li>
							<li><a class="h-ico ico-cash" href="#"><span>Affiliate</span></a></li>
							<li><a class="h-ico ico-color" href="#"><span>Appearance</span></a></li>
-->
							<li><a class="h-ico ico-users" href="index.php?section=ShowMembers"><span>Manage Members</span></a></li>
							<li><a class="h-ico ico-advanced" href="#"><span>API Settings</span></a></li>
						</ul>
					</div>
				</div><!-- #h-wrap -->
				<form style="margin: 0 30px;" action="" method="post"><!-- Search form -->
					<fieldset>
						<label class="a-hidden" for="search-q">Search query:</label>
						<input style="color: rgb(153, 153, 153);" id="search-q" class="text fl" name="search-q" size="20" value="search" type="text">
						<input class="hand fr" src="images/search-button.png" alt="Search" type="image">
					</fieldset>
				</form>
			</div><!-- .inner-container -->
      	</div><!-- #nav -->
		
		<div id="container">
			<div class="inner-container">
						
        	<?
            $this->CHECK_PAGES();
        	?>

			<div id="footer"><!-- footer -->
				<p>Copyright 2013, <a href="http://vip4it.COM">vip4it</a> , | All right reserved</p>
			</div>
			
			</div><!-- .inner-container -->
		</div><!-- #container -->
		
    </body></html>
