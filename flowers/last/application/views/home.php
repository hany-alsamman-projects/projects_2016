<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=windows-1256" http-equiv="Content-Type" />
<meta content="ar-sy" http-equiv="Content-Language" />
<meta name="author" content="programmed and designed by codexc.com corporation" />

<title><?=SITE_NAME?></title>


   <style type="text/css">
		@import url(css/<?=$this->prefix_lang?>_layout.css);
	</style>
    
<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/swfobject.js"></script>

<link rel="stylesheet" type="text/css" href="css/shadowbox.css" />
<script type="text/javascript" src="js/shadowbox.js"></script>
<script type="text/javascript">
Shadowbox.init();

</script>


<script type="text/javascript">
 var headline_count;
 var headline_interval;
 var old_headline = 0;
 var current_headline = 0;
 
 $(document).ready(function(){
   headline_count = $("div.headline").size();
   $("div.headline:eq("+current_headline+")").css('top','5px');
 
   headline_interval = setInterval(headline_rotate,5000); //time in milliseconds
   $('#scrollup').hover(function() {
     clearInterval(headline_interval);
   }, function() {
     headline_interval = setInterval(headline_rotate,5000); //time in milliseconds
     headline_rotate();
   });
 });
 
 function headline_rotate() {
   current_headline = (old_headline + 1) % headline_count; 
   $("div.headline:eq(" + old_headline + ")").animate({top: -205},"slow", function() {
     $(this).css('top','210px');
   });
   $("div.headline:eq(" + current_headline + ")").show().animate({top: 5},"slow");  
   old_headline = current_headline;
 }

</script>

</head>

<body>

<div id="wrapper">

  <div id="header" style="text-align:center"></div>
  

    <script type="text/javascript">
       swfobject.embedSWF("images/header_<?=$this->prefix_lang?>.swf", "header", "980", "216", "9.0.0");
    </script>

  <div id="root_board">

    <div id="last_news">         
         <div id="scrollup">
         
         <?php
         
				$result = mysql_query("SELECT * FROM `".$this->prefix_lang."_items` WHERE `in_parent` = '21' ORDER BY id DESC");
										
				while($row = mysql_fetch_object($result)){
				    
                    if($row->p_content != '') echo '<div class="headline">'.$row->p_content.'</div> ';
                  			    
                }## end dept
         
         ?>
         
         </div>
         
    </div><!-- end last news -->
    
    <div id="board_list">
    
    	<div id="video_list">        
        	<div id="video_pic">
            	<div id="video_title">
                <a href="images/video/3.flv" style="color: white;" title="Clima Tech" rel="shadowbox;height=340;width=420">Movie 3</a>
                </div>
            </div>
            <div id="video_pic">
            	<div id="video_title">
                <a href="images/video/4.flv" style="color: white;" title="Clima Tech" rel="shadowbox;height=340;width=420">Movie 2</a>
                </div>
            </div> 
            
            <div id="video_pic">
            	<div id="video_title">
                <a href="images/video/5.flv" style="color: white;" title="Clima Tech" rel="shadowbox;height=340;width=420">Movie 1</a>
                </div>
            </div> 
                 
        </div><!-- end video list -->
        
        <div id="nav_menu"><?php //include_once("weather.php"); ?></div>

        </div><!-- end nav menu -->
        
    </div>
  
    <div id="main_board">

        <!-- PAGE CONTENT -->
		<?php $this->Get_Pages(); ?>
		<!-- PAGE CONTENT -->	     

    </div><!-- end mainboard -->
    
    <div id="last_project">    
  		<div id="project_pic"><img src="images/pro1.jpg" /></div>        
        <div id="project_title"><b><?=$this->lang['latest_project']?></b></div> 
        <div id="project_info">info</div>    
    </div><!-- end last project -->
    
    <div id="board_cat">    
    	<div id="cat_bg"></div>
    	<div id="cat_bg"></div>
    </div><!-- end board cat -->
    
  </div><!-- end root board -->

<div id="footer">
  <div id="by_codeXc" style="margin:100px 250px 0px 0px">
  Designed, Programmed and Hosted by <a title="Designed, Programmed and Hosted by codex corporation" href="http://www.codexc.com/">Codex</a> <br />
  Copyright © 2008-2010 | All Rights Reserved  
  </div>

<div id="copyright" style="margin:100px 0px 0px 350px">
Damascus - Syria <b>P.O.Box</b> :6655 <b>Email</b> : info@clima-sy.com<br />
<b>Tel</b>. :+963 11 3719082 <b>Fax</b> : +963 11 3737948 
</div>

</div>

</div><!-- end wrapper -->

</body>

</html>
