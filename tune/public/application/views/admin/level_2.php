<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<title>
<? 
print SITE_NAME.' - ';
	if(!$_GET['section']){
		print $lang['main'];
	}
?>
</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<meta http-equiv="Content-Language" content="ar-sy" />
<link rel="stylesheet" href="style.css" type="text/css" />
<meta name="robots" content="noindex, nofollow" />

<script type="text/javascript" src="uploader.js"></script>
<script type="text/javascript" src="../js/animatedcollapse.js"></script>
<script src="../js/preview_templates.js" language="JavaScript" type="text/javascript"></script>
<script src="../js/loader.js" language="JavaScript" type="text/javascript"></script>

<!--[if lt IE 7]>
<style type="text/css">
img, div {behavior: url(../images/admin/iepngfix.htc) }
</style>
<![endif]-->

<script type="text/javascript">

function doBlink() {
var blink = document.all.tags("blink")
for (var i=0; i<blink.length; i++)
blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : ""
}
function startBlink() {
if (document.all)
setInterval("doBlink()",1000)
}

startBlink();


function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
function SetAllCheckBoxes(FormName, FieldName, CheckValue)
{
	if(!document.forms[FormName])
		return;
	var objCheckBoxes = document.forms[FormName].elements[FieldName];
	if(!objCheckBoxes)
		return;
	var countCheckBoxes = objCheckBoxes.length;
	if(!countCheckBoxes)
		objCheckBoxes.checked = CheckValue;
	else
		// set the check value for all check boxes
		for(var i = 0; i < countCheckBoxes; i++)
			objCheckBoxes[i].checked = CheckValue;
}

function confirmDelete(delUrl) {
  if (confirm("Are You Sure Delete This Email !")) {
    document.location = delUrl;
  }
}
</script>

</head>

<body>
<div style="display: none; position:absolute; background-color: transparent" id="preview_div"></div>

<!-- start dashboard -->
<table class="board_style" align="center" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="15%" height="71" style="text-align:left; padding-left:10px">
	<img src="<? print SITE_DIR ?>/images/logo.jpg" /></td>
    <td width="7%" style="text-align:left; padding-left:10px"></td>
    <td width="41%" height="71" style="text-align:left; padding-left: 5px; vertical-align:bottom"></td>
    <td width="41%" style="text-align:right; padding-right:15px">
	<div style="width: 200px; text-align:left; float: right;">
	<img src="../images/admin/<?php echo $_SESSION["group_id"] ?>.png" />  Welcome: <br />
    	Hello: <? print $_SESSION["user_name"] ?> (IP: <? print $_SESSION["ip"] ?>
		)
	<br />
	<a href="./index.php?section=logout">Logout</a>
	</div>
	</td>
  </tr>
  <tr>
<td width="100%" colspan="2" style="vertical-align:top; text-align:left; padding-top:10px">

	<ul id="menu">  
	
    <li><a href="index.php?" target="_self"><img align="absbottom" src="../images/admin/mange.png"/>&nbsp;Main 
	Board</a></li><br />
	 
    <div style="margin-left: 10px">
	<a href="index.php?section=ChangePassword" target="_self"><img align="absbottom" src="../images/admin/key.png" /> 
		Change Password</a><br />    
	 </div>
	 
    <img src="../images/admin/hr.jpg" />
	 
    <li><a target="_self" href="javascript:collapse3.slideit()"><img align="absbottom" src="../images/admin/mange.png"> 
	Management Topics</a></li><br />
    <div id="topics" style="margin-left: 10px">
    <a href="index.php?section=ShowObjects" target="_self"><img align="absbottom" src="../images/admin/views.png"> 
		Show Topics</a><br />
    <a href="index.php?section=ShowObjects&WaitingTopics=true" target="_self"><img align="absbottom" src="../images/admin/views.png"> 
		Waiting Topics</a><br />
    <a href="index.php?section=ShowObjects&Archives=true" target="_self"><img align="absbottom" src="../images/admin/views.png"> 
		Show Archives</a><br />
    <a href="index.php?section=AddTopic" target="_self"><img align="absbottom" src="../images/admin/add.png"> 
		Add Topic</a><br />
    </div>
    
    <img src="../images/admin/hr.jpg" />
    
    <script type="text/javascript">
	var collapse3=new animatedcollapse("topics", 500, false, "block")
	</script>
	
    <li><a target="_self" href="javascript:collapsepost.slideit()"><img align="absbottom" src="../images/admin/mange.png"> 
	Management Posts</a></li><br />
    <div id="posts" style="margin-left: 10px">
    <a href="index.php?section=ShowPosts" target="_self"><img align="absbottom" src="../images/admin/views.png"> 
		Show Posts</a><br />
    <a href="index.php?section=ShowPosts&WaitingPosts=true" target="_self"><img align="absbottom" src="../images/admin/views.png"> 
		Waiting Posts</a><br />
    </div>
    
    <img src="../images/admin/hr.jpg" />
    
    <script type="text/javascript">
	var collapsepost=new animatedcollapse("posts", 500, false, "block")
	</script>
    
    </ul>
    </td>
    <td style="padding-top: 10px" valign="top" colspan="2">
	<?
    $this->CHECK_PAGES();
	?>
    </td>
  </tr>
</table>
<!-- end dashboard -->

</body>
</html>