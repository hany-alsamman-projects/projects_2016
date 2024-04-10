<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
<meta content="ar-sy" http-equiv="Content-Language" />
<meta name="keywords" content="أزهار,ورود,شراء,توصيل,إهداء,سوريا,دمشق,حلب,حمص,اللاذقية,حماه,إرسال ,إهداء أزهار,توصيل أزهار,شراء أزهار,إهداء ورود,توصيل ورود,شراء ورود,البنك العقاري,البنك العقاري السوري,تسديد الكتروني,سدد عبر البنك العقاري,السوري,عيد الأم,الفالنتاين,عيد الحب,رأس السنة,عيد الميلاد,عيد الفطر,تزيين,تزيين صالات,تزيين مناسبات,إضاءة,حفلات,ولادة,مباركة,عرس,أعراس,خطبة,أفراح,مسكة,عروس,جوري,قرنفل,توليب,عصفور الجنة,منتور,ليليوم,نرجس,شقائق النعمان,الزنبق,خضراء,أحمر,باقة أزهار,تنسيق,بوكيه,ستاند,مزهرية,زهر,محافظة,مدينة,دير الزور,القامشلي,الحسكة,الرقة,إدلب,مصياف,درعا,القنيطرة,تدمر,الحب,الصداقة,الارتباط,Flowers,florals, delivery,pay, offering, giving, sending, real estate bank,syrian,payment,NewYear,christmas,xmas,mothersday,feast,holiday,easter,valantine,birthday,decoration,halls,rooms,wedding,decoration,blessing,bride,roses,sunflower,tulips,peony,ranunculus,freesia,daisy,carnations,aster,birds of paradise,anemone,anthurium,amarylli,love,friends,soul" />
<meta name="author" content="programmed and designed by codexc.com corporation" />

<title><?=SITE_NAME?></title>


   <style type="text/css">
		@import url(css/<?=$this->prefix_lang?>_layout.css);
        @import url(css/signup.css);
        @import url(css/facebox.css);
	</style>
    
    
<script type="text/javascript" src="js/jquery-1.4.3.min.js"></script>
<script type="text/javascript" src="js/jquery.aviaSlider.min.js"></script>
<script type="text/javascript" src="js/signup.js"></script>
<script type="text/javascript" src="js/facebox.js"></script>
<script>

(function($) {
	$.fn.customFadeIn = function(speed, callback) {
		$(this).fadeIn(speed, function() {
			if(jQuery.browser.msie)
				$(this).get(0).style.removeAttribute('filter');
			if(callback != undefined)
				callback();
		});
	};
	$.fn.customFadeOut = function(speed, callback) {
		$(this).fadeOut(speed, function() {
			if(jQuery.browser.msie)
				$(this).get(0).style.removeAttribute('filter');
			if(callback != undefined)
				callback();
		});
	};
})(jQuery);

$(document).ready(function(){
            
    		// here you can see the slide options I used in the demo page. depending on the id of the slider a different setup gets activated            
            $('#frontpage-slider').aviaSlider({	
            blockSize: {height: 'full', width:40},
            slides:".featured",
             showText: false,
            display: 'topleft',
            transition: 'fade',
            betweenBlockDelay:150,
            animationSpeed: 600,
            switchMovement: true
            });
            
            // writing by hany alsamman
			if ($.browser.msie && $.browser.version > 7 || !$.browser.msie) {
            
            ////////////////////////////
            // nav effects
            ///////////////////////////
          
            $("#nav div,#logo").hide();
            
            $("#logo").fadeTo("slow", 1.0);

          
            //turn off all div in the list
            $("#nav").find("div").delay(200).fadeTo("slow", 0.5);
                          
            
            //turn on first button        
            $("#nav div.selected").fadeTo("slow", 1.0);
            
            
            $("#nav").find("div").hover(function(){
            
            //check if first button are on    
            if( $("#nav div").attr("class") == 'selected' ){            
                //turn nav the button
                $("#nav div").fadeTo("fast", 0.5);
                //remove class tag        
                $("#nav div").removeClass("selected"); 
            }
             
            $(this).fadeTo("1000", 1.0); // This should set the opacity to 100% on hover
            
            
            },function(){
                
            $(this).fadeTo("1000", 0.5); // This should set the opacity back to 30% on mouseout
            
            });
            
            }
            
            ///////////////////////////    
            
            
			// fix png's for IE 6
            // writing by hany alsamman
			if ($.browser.msie && $.browser.version > 6 ) {

        		//fix input with png-source
//        		jQuery(this).find("img[src$=.png]").each(function() {
//        			var bgIMG = jQuery(this).attr('src');
//        			jQuery(this).get(0).runtimeStyle.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader' + '(src=\'' + bgIMG + '\', sizingMethod=\'scale\');';
//        		});            
    
                
                // hack png css properties present inside css                        
    			jQuery(this).find("*").each(function(){
    				if ($(this).css('backgroundImage').match(/^url[("']+(.*\.png)[)"']+$/i)) {
    					var src = RegExp.$1;
    					$(this).css({
    						backgroundImage: 'none',
    						filter: 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src="' +  src + '", sizingMethod="crop")'
    					});
    				}
    			});
            
            
			}                            
            
});

</script>

</head>

<body>

<div id="wrapper">

  <div id="header">
  
    <div id="basket">
<?php

if (LOGIN::CHECK_MEMBER_LOGIN()){ 
    
    print '
        <div id="cart"></div>
        <div id="cart_title"><b>Your Flower Basket</b></div>
        <div id="cart_items">
        Items: <span style="color: #c34696;">'.$this->items.'</span> &nbsp; Total: <span style="color: #c34696;">'.'&#36; '.$this->total.'</span>
        <br /><a href="index.php?action=ViewCart"><u>View Cart</u></a> &nbsp; <a href="index.php?action=EmptyCart"><u>Empty Cart</u></a></div>
    ';
    
}
?>    
    </div>
    
    <div id="logo"></div>
    
    <div id="nav">
    
                <div class="selected"><a href="index.php"><b>Home</b></a></div>
            
                <?php
                
                if (LOGIN::CHECK_MEMBER_LOGIN()){                    
                    echo '<div><a href="index.php?action=usercp"><b>Control Panel</b></a></div>'; 
                }else{                    
                    echo '<div><a href="index.php?action=Register"><b>Register</b></a></div>';
                    echo '<div><a href="index.php?action=Login"><b>Login</b></a></div>';                
                }
                
                ?>  
                
                <?php                
                if (LOGIN::CHECK_MEMBER_LOGIN()){      
                    echo '<div><a href="index.php?action=logout">Logout</a></div>';
                }                
                ?>
                
                                
                <div><b>Contact us</b></div>
    </div>
    
  
  </div>
  

    <div id="root_board">
        
        
        <div id="intro">
  
                <div class='aviaslider' id="frontpage-slider">
                <div class="featured"><a href="#" ><img src="images/slides/slide5.jpg" alt="" /></a></div>
                <div class="featured"><a href="#" ><img src="images/slides/slide6.jpg" alt="" /></a></div>
                <div class="featured"><a href="#" ><img src="images/slides/slide1.jpg" alt="" /></a></div>
                </div>

        </div>
        
        <div id="main_board">
        
            <div id="content">
            
            <?php

            $title = (isset($this->ACTION)) ? ":: <a href='#'><b>$this->ACTION</b></a>" : '';
            
            ?>
            
            <div id="where" >
                <div style="float: left;" id="where_logo"><img  src="images/jasmin_colors.jpg"/></div>
                <div id="where_left"></div><div id="where_bg"><a href="index.php?action=register">Main</a> <?=$title?></div><div id="where_right"></div>
            </div>

<?php

print $this->Get_Pages();

?>
        
            <div id="end"></div>
            </div>
                
            
            <div id="menu">
                <div id="mcontent">
                    <?php
                    
                    foreach($this->menu AS $mymenu){
                        
                        echo '<div><a href="index.php?action=ViewDept&id='.$mymenu['id'].'"><b>'.$mymenu[''.$this->prefix_lang.'_d_name'].'</b></a></div>';
                        
                    }
                    
                    ?>
                </div>
            </div>
        
            <!--
<div id="ads"><img src="images/ads.jpg" /></div>
-->
        
        </div><!-- end mainboard -->
    </div><!-- end root board -->


    <div id="footer">
    
        <div id="copyright">
        Copyright 2009 - 2010 © <b class="highlight">3njoom.com</b> All Right Reserved <br /> Designed and Programmed by <a title="Designed, Programmed and Hosted by codex corporation" href="http://www.codexc.com/">Codex</a>
        </div>
    
    </div>

</div><!-- end wrapper -->

</body>

</html>
