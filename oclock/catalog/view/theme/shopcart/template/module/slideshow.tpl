    <!-- jQuery Paradigm Slider  -->
	<script type="text/javascript" src="catalog/view/theme/shopcart/js/kb-plugin/js/jquery.easing.1.3.js"></script>	
	<script type="text/javascript" src="catalog/view/theme/shopcart/js/kb-plugin/js/jquery.cssAnimate.mini.js"></script>	
	<script type="text/javascript" src="catalog/view/theme/shopcart/js/kb-plugin/js/jquery.waitforimages.js"></script>	
	<script type="text/javascript" src="catalog/view/theme/shopcart/js/kb-plugin/js/jquery.touchwipe.min.js"></script>	
    <script type="text/javascript" src="catalog/view/theme/shopcart/js/kb-plugin/js/jquery.themepunch.kenburn.min.js"></script>	
	
    <!-- CSS STYLE Paradigm Slider -->
    <link rel="stylesheet" type="text/css" href="catalog/view/theme/shopcart/stylesheet/slider.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="catalog/view/theme/shopcart/js/kb-plugin/css/settings.css" media="screen" />



	<script type="text/javascript">
      WebFontConfig = {
        google: { families: [ 'PT+Sans+Narrow:400,700' ] },
		active: function() { jQuery('body').data('googlefonts','loaded');},
		inactive: function() { jQuery('body').data('googlefonts','loaded');}
      };	  
    </script>



<div id="slider">
      
<div id="banner-example-1" class="dark">
				<ul>								

					<!-- THE 1. SLIDE -->
					<li data-transition="slide" data-startalign="left,top" data-zoom="off" data-zoomfact="0" data-endAlign="center,center" data-panduration="0" data-colortransition="4"><img src="image/banners/banner5.jpg" data-bw="image/banners/banner5.jpg" data-thumb="image/banners/th1.jpg" data-thumb_bw="image/banners/th1.jpg">
							<div  class="creative_layer">
								<!-- <div class="caption_red wipeleft" style="top:30px;left:50px;"><i>Be On Time&nbsp;</i></div>	
								<div class="caption_transparent wipedown" style="top:80px;left:50px;">&nbsp; With O'Clock !</div>																
								<div class="caption_white minicap wipeup" style="top:130px;left:160px"><i>Powered by</i> <a href="#"><b>Codex Corp</b></a></div> -->															
							</div>
					</li>
                    					
					<!-- THE 2. SLIDE -->
					<li data-transition="slide" data-startalign="left,top" data-zoom="off" data-zoomfact="0" data-endAlign="left,center" data-panduration="0" data-colortransition="4"><img src="image/banners/banner2.jpg" data-bw="image/banners/banner2.jpg" data-thumb="image/banners/th3.jpg" data-thumb_bw="image/banners/th3.jpg">
								<div  class="creative_layer">
							
                                											
							</div>
					</li>
                    
					<!-- THE 3. SLIDE -->
					<li data-transition="slide" data-startalign="center,top" data-zoom="off" data-zoomfact="0" data-endAlign="center,bottom" data-panduration="0" data-colortransition="4"><img src="image/banners/banner1.jpg" data-bw="image/banners/banner1.jpg" data-thumb="image/banners/th2.jpg" data-thumb_bw="image/banners/th2.jpg">
							<div  class="creative_layer">										
							</div>
					</li>
					<!-- THE 4. SLIDE -->
					<li data-transition="slide" data-startalign="center,top" data-zoom="off" data-zoomfact="0" data-endAlign="center,bottom" data-panduration="0" data-colortransition="4"><img src="image/banners/banner3.jpg" data-bw="image/banners/banner3.jpg" data-thumb="image/banners/th4.jpg" data-thumb_bw="image/banners/th4.jpg">
							<div class="video_pradigm">
								<div class="video_kenburn_wrap">	
									<iframe class="video_clip" src="http://www.youtube.com/watch?v=aDiVMi7tiBw&amp;wmode=opaque&amp;autohide=1&amp;showinfo=0" height="320" width="569" frameborder="0" webkitAllowFullScreen allowFullScreen></iframe>
									<h2>Youtube Video</h2>
									<p>
										We stock OClock Watches for children, men and women and we offer free ...
									</p>
									<a class="buttonlight" href="#">More Info</a>
									<div id="close"></div>
								</div>
							</div>	
							<div  class="creative_layer">
								<div class="caption_red wipeleft" style="top:140px;left:30px;">Youtube Video</div>					
								<div class="caption_white wiperight" style="top:140px;left:205px;">Watch it!</div>								
							</div>
					</li>
					<!-- THE 5. SLIDE -->
					<li data-transition="slide" data-startalign="right,bottom" data-zoom="off" data-zoomfact="0" data-endAlign="bottom,bottom" data-panduration="0" data-colortransition="4"><img src="image/banners/banner4.jpg" data-bw="image/banners/banner4.jpg" data-thumb="image/banners/th5.jpg" data-thumb_bw="image/banners/th5.jpg">
							<div  class="creative_layer">		
			
							</div>
					</li>	
					<!-- THE 6. SLIDE -->
					<li data-transition="slide" data-startalign="left,bottom" data-zoom="off" data-zoomfact="0" data-endAlign="center,center" data-panduration="0" data-colortransition="4"><img src="image/banners/banner6.jpg" data-bw="image/banners/banner6.jpg" data-thumb="image/banners/th6.jpg" data-thumb_bw="image/banners/th6.jpg">
							<div  class="creative_layer">	
                                <div class="caption_red nobg wipedown" style="top:130px;left:50px;"><i>Factory Milano&nbsp;</i></div>			
							</div>
					</li>					
				</ul>
			</div>
			<!--
			##############################
			 - ACTIVATE THE BANNER HERE -
			##############################
			-->
			<script type="text/javascript">
				 (function() {
					var wf = document.createElement('script');
					wf.src = ('https:' == document.location.protocol ? 'https' : 'http') +
						'://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js';
					wf.type = 'text/javascript';
					wf.async = 'true';
					var s = document.getElementsByTagName('script')[0];
					s.parentNode.insertBefore(wf, s);
				 })();
				$(document).ready(function() {
							 									
					jQuery('#banner-example-1').kenburn(
						{										
							width:960,
							height:450,
							thumbWidth:120,
							thumbHeight:70,
							thumbAmount:6,							
							thumbSpaces:2,
							thumbPadding:9,
							shadow:'true',
							parallaxX:500,
							parallaxY:10,
							captionParallaxX:-40,
							captionParallaxY:2,
							touchenabled:'on',
							pauseOnRollOverThumbs:'off',
							pauseOnRollOverMain:'off',
							timer:5
						});
			});
			</script>  
        
  	</div>