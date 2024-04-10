<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title>
<?php
print SITE_NAME.' - ';
	if(!$_GET['section']){
		print $lang['main'];
	}
	
	$active = ( isset($_GET['active']) == true ) ? $_GET['active'] : 'dashboard';
	
?>
</title>

	<style type="text/css">
	@import url(css/admin.css);
	</style>

    <!--<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />-->

<script type="text/javascript" src="js/uploader.js"></script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>
</head>

<body>



<div id="wrapper">

        <div id="header">
              <div id="logo"></div>
              <div id="version"></div>
              <div id="logout">
                <span style="float: left"><img align="absmiddle" src="images/admin/<?php echo $_SESSION["group_id"] ?>.png" />&nbsp;أهلا بك: <b><? print $_SESSION["user_name"] ?></b></span>
                <span style="float: right">&rsaquo;&nbsp;<a href="./index.php?section=logout">تسجيل خروج</a></span>
              </div>
        </div>
            
		<div id="root">
                
            <div id="hr">         	
                <div id="menu">
                	<div class="button">سطح المكتب</div>     
                    <div class="button">النظام</div>
                    <div class="button">الدعم الفني</div>
                    <div class="button">معلومات</div>        
                </div>
            </div>
            
            <div id="parent">
            
              <div id="right_side">
                 <div>                     
                     <div id="pages_content">
                     	<?php $this->CHECK_PAGES(); ?>
                     </div>
                 </div>
                 
                </div><!-- end right side -->
            
                <div id="left_side">
                
                	<div id="nav_menu">
                   		
                        <div id="dashboard">
                            <div id="shadow_top_false"></div>                            	
                                <div id="shadow_links_false">
                                    <ul>
                                        <li id="link_one_false">
                                        <img align="absbottom" src="images/admin/mange.png"  /><a href="./">لوحة التحكم</a>
                                        </li>
<!--                                        <li>
                                        <img href="#" align="absbottom" src="images/admin/add.png"  /><a href="./">My Dashboard</a>
                                        </li>-->
                                        <li><img align="absbottom" src="images/admin/key.png" /><a href="index.php?section=ChangePassword&active=dashboard" target="_self">تغيير كلمة السر</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/layers.png" /><a href="index.php?section=GenerateCache&active=dashboard" target="_self">تحديث الصفحات</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/find.png" /><a href="index.php?section=Search&active=dashboard" target="_self">البحث</a><br /> 
                                        </li>
                                    </ul>                                
                            </div>
                                
                            <div id="shadow_bottom_false"></div>   
                                                                              
                        </div><!-- end dashboard -->
                        
                        <div id="departments">
                            <div id="shadow_top_false"></div>                            	
                                <div id="shadow_links_false">
                                    <ul>
                                        <li id="link_one_false">
                                        <a href="./" target="_self"><img align="absbottom" src="images/admin/mange.png">إدارة الأقسام</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/views.png"><a href="index.php?section=ShowBlogs&active=departments" target="_self">عرض المجموعات</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/add.png"><a href="index.php?section=AddBlog&active=departments" target="_self">إضافة مجموعة</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/add.png"><a href="index.php?section=AddDepartments&active=departments" target="_self">إضافة قسم</a>
                                        </li>
                                    </ul>                                
                                </div>                                
                            <div id="shadow_bottom_false"></div>                                                        
                      </div><!-- end departments -->
                      
                      
                        <div id="items">
                            <div id="shadow_top_false"></div>                            	
                                <div id="shadow_links_false">
                                    <ul>
                                        <li id="link_one_false">
                                        <img align="absbottom" src="images/admin/mange.png"><a href="./" target="_self">إدارة المحتوى</a>
                                        </li>
                                        <li>
                                       <img align="absbottom" src="images/admin/views.png"><a href="index.php?section=ShowItems&active=items" target="_self">عرض المحتويات</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/add.png"><a href="index.php?section=AddItem&active=items" target="_self">إضافة محتوى</a>
                                        </li>
                                    </ul>                                
                                </div>
                            <div id="shadow_bottom_false"></div>                                                        
                        </div><!-- end items -->
                        
                        <div id="members">
                            <div id="shadow_top_false"></div>                            	
                                <div id="shadow_links_false">
                                    <ul>
                                        <li id="link_one_false">
                                        <img align="absbottom" src="images/admin/mange.png" /><a href="./" target="_self">إدارة الحسابات</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/user_add.png" /><a href="index.php?section=AddAccount&active=members" target="_self">إضافة حساب</a>
                                        </li>
                                        <li>
                                        <img align="absbottom" src="images/admin/views.png"/><a href="index.php?section=ShowAccount&active=members" target="_self">عرض الحسابات</a>
                                        </li>
                                    </ul>                                
                                </div>
                            <div id="shadow_bottom_false"></div>                                                        
                        </div><!-- end members -->
                    
                    </div>
                                               
                </div><!-- end left side -->
            
            </div><!-- end parent -->
              
		</div><!-- end root -->
	
        <div id="footer">
            <div id="copyright">Copyright © 2008 - <?=(date("Y")+1)?> | <span class="highlight">CodeX</span> | All Rights Reserved</div>
        </div>

</div>

<script type="text/javascript">
change_active("<?=$active?>");
//startBlink();
</script>

</body>
</html>