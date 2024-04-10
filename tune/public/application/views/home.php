<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<meta name="author" content="programmed and designed by codexc.com corporation" />
 
<meta name="description" content="Currency trading on the international financial Forex market. Forex Trading News, Forex Rates, Forex Education, Economic Calendar, Trader contests, Forex analysis and Forex TV." /> 
 
<meta name="keywords" content="Forex,Forex broker,trading,foreign exchange,online trading,forex market,metatrader,currency,tunefx,internet trading,broker,forex investing,currency,tuneforex,currency trading,platform,Transactions, tuneForex trading terms,management tools" />		

<title><?=$this->lang['LABEL_WELCOME'].@$_SESSION['user_name']?></title> 

<!-- Favicon -->
<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">

<!-- Combined stylesheets load -->
<link href="css/mini.php?files=reset,style,signup,superfish,superfish-navbar,facebox" rel="stylesheet" type="text/css">

<!-- Combined JS load -->
<script type="text/javascript" src="js/mini.php?files=jquery.min,jquery.aviaSlider.min,superfish,hoverIntent,usercp,facebox,signup,jquery.autocomplete,jquery.autocomplete_do,jquery.bgiframe.min,countries.en,ajaxfileupload,functions"></script>

<link href="files/css/flexigrid.css" rel="stylesheet" type="text/css">


<script type="text/javascript" src="files/js/flexigrid.js"></script>
 
<!--[if lt IE 8]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js"></script><![endif]-->


<script type="text/javascript">

// initialise plugins
$(document).ready(function() {
    
    $('a[rel*=facebox]').facebox();
    
	jQuery('ul.sf-menu').superfish(); 
    
    $('#frontpage-slider').aviaSlider({	
    blockSize: {height: 'full', width:40},
    slides:".featured",
    showText: false,
    display: 'topleft',
    transition: 'drop',
    betweenBlockDelay:80,
    animationSpeed: 800,
    switchMovement: true
    });
    
    
   // $(".dropdown img.flag").addClass("flagvisibility");

    $(".dropdown dt a").click(function() {        
        $(".dropdown dd ul").toggle('slow');        
        
    });
                
    $(".dropdown dd ul li a").click(function() {
        var text = $(this).html();
        $(".dropdown dt a span").html(text);
        $(".dropdown dd ul").hide();
        $("#result").html("Selected value is: " + getSelectedValue("sample"));
    });
                
    function getSelectedValue(id) {
        return $("#" + id).find("dt a span.value").html();
    }

    $(document).bind('click', function(e) {
        var $clicked = $(e.target);
        if (! $clicked.parents().hasClass("dropdown"))
            $(".dropdown dd ul").hide();
    });

    
     //alert($('.dropdown dd ul li').find("a").first("span").val());




//    $("#flagSwitcher").click(function() {
//        $(".dropdown img.flag").toggleClass("flagvisibility");
//    });
            
     
});

</script>

<?php
    if($_GET['lang'] == 'ar'){
?>        
 <style type="text/css">

<!--
body{
	font-family: Tahoma, Arial, sans-serif;
    font-size: 10pt;
}      

#follow{
    margin: 25px auto;
    width: 300px;
    color: #706f6f;
    font-size: 18pt;
}

.c_open_account{
    font-size: 10pt;
}

#div-regForm{	
	padding:8px;
    font-size: 11pt;
    float: right;
}

#regForm label{
	font-size:9pt;
	display:block;
	text-align:right;
    float: right;
    direction: rtl;
    font-weight: bold;
    clear:both;
}
#regForm td{	
	padding-bottom: 8px;
    direction: rtl;    
}
#regForm input{	
    width: 180px;
    float: right;
}
#regForm option{	
    font-size: 9pt;
    height: 18px;
}
#iSM ul li
{float:right;}
-->
</style>

<?php
    }
?>



<script type="text/javascript">
   
var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-22592811-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();


</script>

</head>

<body>

<div id="wrapper">

	<div id="header">
	
		<div id="logo"></div>

        <div id="user_cp">   
        
            <div style="clear: both; float: right;">
                <dl id="sample" class="dropdown">
<?php
                
                //<a href="#"><span><img class="flag" src="images/flags/sa.gif" alt=""> Arabic<span class="value">ar</span></span></a>
                
                print '<dt><a href="#">'.$this->lang['SELECT_COUNTRY'].'</a></dt>';
                print '<dd>';
                print '<ul>';
                        


        $result = mysql_query("SELECT * FROM `languages` WHERE `active` = '1' ");

        while($mylang = mysql_fetch_array($result)){
            
            if($this->_ID != false) {
                $getdata = mysql_fetch_row(mysql_query("SELECT id,title FROM `pages` WHERE `translation_for` = '{$this->_ID}' and `lang` = '{$mylang['id']}'"));
                
                if($getdata[0]>0) echo '<li><a href="/'.$mylang['flag'].'/page/'.$getdata[0].'/'.$getdata[1].'.html"><img class="flag" src="images/flags/'.$mylang['flag'].'.gif" alt="" /> '.$mylang['name'].'<span class="value">'.$mylang['flag'].'</span></a></li>';
            }
        }
        
        if(empty($this->ACTION)){
            
        echo  '<li><a href="'.SITE_DIR.'/ar/"><img class="flag" src="images/flags/sa.gif" alt="" /> العربية<span class="value">ar</span></a></li> 
               <li><a href="'.SITE_DIR.'/en/"><img class="flag" src="images/flags/us.gif" alt="" /> English<span class="value">en</span></a></li>';
                                    
            
        }

?>                        
<!--
                            <li><a href="http://127.0.0.1/tune/ar/"><img class="flag" src="images/flags/sa.gif" alt="" /> Arabic<span class="value">ar</span></a></li>
                            <li><a href="http://127.0.0.1/tune/en/"><img class="flag" src="images/flags/us.gif" alt="" /> English<span class="value">en</span></a></li>
                            
-->
                        </ul>
            
                    </dd>
                </dl>
            </div>
<?php
    ##  TODO : get jquery slideup toggle
    if( LOGIN::CHECK_MEMBER_LOGIN() ){
?>        
            <div class="clear">
            <div id="corner_left"></div>
                <div id="bar_content">
                   <div id='user_content'>
                   <div id='account_boarder'><img  src="images/control.png" /> <a href="<?='/'.LANG_EXT.'/'?>index.php?action=usercp">Client Cabinet</a> </div>
                   <div id='account_boarder'><img  src="images/coins.png" /> <a href="<?='/'.LANG_EXT.'/'?>index.php?action=usercp&pro=MoneyDeposit">Funds Deposit</a></div>
                   <div id='account_boarder'><img  src="images/emblem_money.png" /> <a href="<?='/'.LANG_EXT.'/'?>index.php?action=usercp&pro=FundsWithdrawal">Funds Withdrawal</a></div>
                   <div id='account_boarder'><img  src="images/user.png" /> <a href="<?='/'.LANG_EXT.'/'?>index.php?action=usercp&pro=profile">My Profile</a></div>
                   <div id='account_boarder'><img  src="images/logoff.png" /> <a href="<?='/'.LANG_EXT.'/'?>/index.php?action=logout"><?=$this->lang['BTN_LOGOUT']?></a></div>
                   </div>
                </div>
            <div id="corner_right"></div>
            </div>
            
<?php
   }
?>  
            
        </div>

        <div id="money_paper"></div>
        
	</div>
    
    <div id="menu">
<ul id="sample-menu-4" class="sf-menu sf-navbar sf-js-enabled sf-shadow">
					                    
                    <!-- breadcrumb once -->


                    <?php

                    print '<li class=""><a class="sf-with-ul" href="'.SITE_DIR.'/'.LANG_EXT.'/index.php"><span>Home</span></a></li>';
                         ## TODO: select current path             
                                
                         $mydata = MYGLOBALS::BULID_MENU();
                         
                         //print_r($mydata);
                         
                         for ($i = 0; $i < count($mydata); $i++)
                         {
                                
                               if($i%1 == 0) print '<li class="">';
                                                              
                               echo '<a class="sf-with-ul" href="'.SITE_DIR.'/'.LANG_EXT.'/page/'.$mydata[$i]['id'].'/'.FUNCTIONS::generateUrl($mydata[$i]['root']).'.html">'.$mydata[$i]['root'].'<span class="sf-sub-indicator"> »</span></a>'."\n\n";
                               
                               if ( sizeof($mydata[$i]['sub']) > 0){    
                                
                                     $get_sub = $mydata[$i]['sub'];
                                                                          
                                     if (is_array($get_sub) && sizeof($get_sub)>0)  print '<ul style="display: none; visibility: hidden;">';
                                     for ($x = 0; $x < count($get_sub); $x++)
                                     {
                                        extract($get_sub[$x], EXTR_PREFIX_SAME, "wddx");                                        
                                        print '<li><a href="'.SITE_DIR.'/'.LANG_EXT.'/page/'.$id.'/'.FUNCTIONS::generateUrl($title).'.html">'.$title.'</a>'."\n\n";

                                        if(is_array($childs) && sizeof($childs)>0){ //print_r($childs);  
                                            print '<ul style="display: none; visibility: hidden;">';                                      
                                            for ($z = 0; $z < count($childs); $z++)
                                            {                                          
                                               print '<li><a href="'.SITE_DIR.'/'.LANG_EXT.'/page/'.$childs[$z]['id'].'/'.FUNCTIONS::generateUrl($childs[$z]['title']).'.html">'.$childs[$z]['title'].'</a></li>';
                                            }
                                            print '</ul>';
                                            print '</li>';
                                        }
                                        unset($title,$id,$childs);
                                     }                                     
                                     print '</ul>';                                                              
                                }                       

                               if($i%1 == 0) print '</li>';
                         }                                      

                         //print '<li class=""><a class="sf-with-ul" href="'.SITE_DIR.'/'.$this->lang['BTN_MY_LANG'].'/index.php"><span>'.$this->lang['BTN_LANG'].'</span></a></li>';
                         
                        if (LOGIN::CHECK_MEMBER_LOGIN()){      
                            //echo '<li class=""><a class="sf-with-ul" href="'.SITE_DIR.'/'.LANG_EXT.'/index.php?action=logout"><span>'.$this->lang['BTN_LOGOUT'].'</span></a></li>';
                        }                
                         
                    ?>
					
                    
                    
                    <!-- end breadcrumb once -->
                    
				</ul>
    </div>
	
	<div id="root">
    
        <div id="left_side">
        
            <div id="blog" class="charts">
                
                <div id="btop"><div id="bleft"></div><div id="btitle"><h1><b><? print $this->lang['LABEL_QUOTES'] ?></b></h1></div><div id="bright"></div></div>
                <div id="blog_sub"><? print $this->lang['LABEL_changefor']?></div>
                
                <div id="bcontent">


                <script>
                var width='100%';
                var height='190px';
                var profile='CMSForexWebQuotes2-B';
                </script>
                <script id="vtCurrencyPairs" src="https://webcharts.fxserver.com/pairs/js/addActivePairs.js">/**/</script>

                </div>
                
                <div id="bbottom">
				</div>
            
            </div><!-- end blog charts-->
            


            <div id="blog">            
                <div style="float: left; margin-right: 15px;"><a href="https://www.tune-forex.com/<?=LANG_EXT?>/index.php?action=login"><img src="images/login_area.png" /></a></div>
            </div>

            
            <div id="blog">    
                <div style="text-align: center">
                <a href="javascript:void(window.open('http://www.tune-forex.com/support/chat.php','','width=590,height=610,left=0,top=0,resizable=yes,menubar=no,location=yes,status=yes,scrollbars=yes'))"><img src="images/support_box.jpg" /></a>
                <!--
                <img src="http://tune-forex.com/support/image.php?id=04&amp;type=inlay" width="120" height="30" border="0" alt="LiveZilla Live Help" />
                -->
                </div>
            </div>
        
        </div>
        
        <div id="center_side">
        
            <?=$this->Get_Pages()?>
            
        </div>        
        
        <div id="right_side">
               
<?php

        if (LOGIN::CHECK_MEMBER_LOGIN()){      
            FUNCTIONS::PAGE_VIEW('cp_nav');
        }else{
            FUNCTIONS::PAGE_VIEW('quick_singup');
        }

?>                                   
                
            <!-- 
            <div id="blog" class="charts">                
                <div id="btop"><div id="bleft"></div><div id="btitle"><h1><b>Join Our Mailling List</b></h1></div><div id="bright"></div></div>
                <div id="blog_sub">Weekly forex newsletter</div>
                
                <div id="bcontent">
                sssss
                </div>            
            </div>end blog charts-->  
            
            <div class="between"></div>
            

<!--
            <div id="blog">
                <div style="float: left; margin-top: 10px; margin-right: 10px;"><img src="images/email.png" /></div><div style="float: left; color: #3c73ac; font-size: 15pt;"><b>Quick Mail</b><br /><p style="color: #7a7a7a;"><small>info@tune-forex.com</small></p></div>
            </div>
            
            <div class="between"></div>
-->
            <!--
            <div id="blog" class="why">                
                <div id="btop"><div id="bleft"></div><div id="btitle"><h1><b>Why Tune Forex</b></h1></div><div id="bright"></div></div>
                <div id="blog_sub">Only five reasons</div>
                
                <div id="bcontent">                    
                    <div class="why_links">
                        1. Reason one text<br />
                        2. Text reason two<br />
                        3. Reason three text<br />
                        4. Text reason four<br />
                        5. Reason five text                    
                    </div>                    
                </div>            
            </div> end blog why-->  
        
        </div><!-- end right side -->
                                        
	</div><!-- end root -->
	
  <div id='my123'>
  
        <div id='open_account'>
               <div id="l_open_account"></div>
               <div id='m_open_account'>
               <div id='logo_open_account'> </div>
               <p class="c_open_account"><a href="http://www.tune-forex.com/en/page/6/open-demo-account.html"><? print $this->lang['LABEL_demoaccount']?></a></p>
               </div>
               <div id='r_open_account'> </div>
        </div>
        <div id='open_account' style="margin-left:18px;">
               <div id="l_open_account"></div>
               <div id='m_open_account'>
               <div id='logo_talke_part'> </div>
               <p class="c_open_account"><a href="http://www.tune-forex.com/en/page/43/forex-bonus.html"><? print $this->lang['LABEL_bonus']?></a></p>
               </div>
               <div id='r_open_account'> </div>
        </div>
        <div id='open_account' style="margin-left:18px;">
               <div id="l_open_account"></div>
               <div id='m_open_account'>
               <div id='logo_sign'> </div>
               <p class="c_open_account"><a href="http://www.tune-forex.com/en/page/16/partnership-account-types.html"><? print $this->lang['LABEL_partner']?></a></p>
               </div>
               <div id='r_open_account'> </div>
        </div>
        <div id='open_account' style="margin-left:18px;">
               <div id="l_open_account"></div>
               <div id='m_open_account'>
               <div id='logo_serv_4'> </div>
               <p class="c_open_account"><a href="http://www.tune-forex.com/en/page/11/account-types.html"><? print $this->lang['LABEL_acctypes']?></a></p>
               </div>
               <div id='r_open_account'> </div>
        </div>
        <div id='open_account' style="margin-left:18px;">
               <div id="l_open_account"></div>
               <div id='m_open_account'>
               <div id='logo_serv_5'> </div>
               <p class="c_open_account"><a href="http://tune-forex.com/tuneforex4setup.exe"><? print $this->lang['LABEL_terminal']?></a></p>
               </div>
               <div id='r_open_account'> </div>
        </div>   

  </div>
    
	<div id="footer">
            
        <div id="fc_left"> 
            <ul class="botoom_links"><h2 style="color:#999; font-size:16px"><b>Why Tune Forex ? </b></h2>
                <li><a href="#">Tune Forex Advantages</a></li>
                <li><a href="#">Tune Forex F&Q </a></li>
                <h2 style="color:#999; font-size:16px"><b> Trade </b></h2>
                <li><a href="#">Open Demo Account</a></li>
                <li><a href="#">Open Real Account</a></li>
            </ul>
            <ul class="botoom_links"><h2 style="color:#999; font-size:16px"><b> Trading Conditions </b></h2>
                <li><a href="#"> Account Types</a></li>
                <li><a href="#">Trading Instruments</a></li>
                <li><a href="#">Trading Platform</a></li>
                <li><a href="#">Islamic Account</a></li>
                <li><a href="#">Forex Bonus</a></li>
            </ul>
             <ul class="botoom_links"><h2 style="color:#999; font-size:16px"><b> Partners </b></h2>
                <li><a href="#"> Partnership Account Types</a></li>
                <li><a href="#">Introducing Broker</a></li>
                <li><a href="#">Golden Lable</a></li>
                <li><a href="#">Promotional Materials</a></li>
                <li><a href="#">Forex Bonus</a></li>
            </ul>
             <ul class="botoom_links"><h2 style="color:#999; font-size:16px"><b> Learn Forex </b></h2>
                <li><a href="#"> What Is Forex ? </a></li>
                <li><a href="#">Forex Course</a></li>
                <li><a href="#">Gold And Silver Trading</a></li>
                <li><a href="#">Oil Trading</a></li>
                <li><a href="#">Indices Trading</a></li>
            </ul>
            <div id="fc_bet"></div>            
        </div>
        
        <div id="fc_right">
            <div id="find_us">            
                <div id="follow"><? print $this->lang['LABEL_follow']?></div>

                <div id='find_us1' >
                <div id="facebook"><a target="_blank" href="http://www.facebook.com/home.php?sk=group_212962855390603"><img src="images/facebook.png" /></a></div>
                <div id="facebook"><a href="#"><img src="images/q.png" /></a></div>
                <div id="facebook"><a href="#"><img src="images/d.png" /></a></div>
                <div id="facebook"><a href="#"><img src="images/dd.png" /></a></div>
                <div id="facebook"><a target="_blank" href="http://twitter.com/#!/TuneForex"><img src="images/baird.png" /></a></div>                
                </div> 
                            
            </div>        
        </div>
         
        
        <div class="clear" style="width: 100%">
        <br class="clear" />
        
            <div style="float: left;"><img src="images/ways_line.jpg" /></div>
<!--
            <div style="float: right; margin-right: 25px;"><a href="https://www.tune-forex.com/en/index.php?action=signup"><img src="images/free_acc.jpg" /></a></div>
        
-->
        </div>
       
       <br class="clear" />
        
        <div style="width: 100%; font-size:8pt; color:#7a7a7a">
        <br class="clear" />
            <h1>Risk Warning:</h1>
            <p> 
            Forex and CFDs are leveraged products, incur a high level of risk and may not be suitable for all investors. You
            should not risk more than you are prepared to lose. Before deciding to trade, please ensure you understand the risks involved and take into account your level of experience. Seek independent advice if necessary.</p>
        </div>
         <br class="clear" />
        
        <div style="width: 100%; height: 5px; border-top: 1px solid #7a7a7a;" class="clear"></div>
    
        <div id="copyright">Copyright 2011 © <b class="highlight">Tune Forex</b> All Right Reserved :: <a href="http://www.tune-forex.com/en/page/38/Privacy.html"><b class="highlight">Privacy Policy</b></a></div>
        
        <div id="codeXperts">Designed and Programmed by <a title="Programmed and by Designed codexc corporation" href="http://www.codexc.com/"><span class="highlight"><b><u>CodeX</u></b></span></a></div>

    </div>
    
</div>


</body>

</html>