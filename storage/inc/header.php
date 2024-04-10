<? include("main/dbc.php")?>
<? include("inc/funs.php")?>
<!DOCTYPE >
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>أرشيف الصور</title>
<link href="inc/style.css" rel="stylesheet" type="text/css" />
<link href="librarys/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<? include("inc/oprJS.php")?>
<script src="librarys/jquery-1.6.3.min.js"></script>
<script src="librarys/js/jquery-ui-1.8.16.custom.min.js"></script>
</head>
<body>
<div id="loader">
<div id="loader2"><img src="images/loader.gif" width="24" height="24" align="left"> جاري التحميل الرجاء الانتظار</div>
</div>
<? $per=array('1:خاص','2:عائلي','3:عام')?>
<div  align="center">
<div style="border:1px #a4a3a3 solid; border-top:0px #a4a3a3 solid; width:1000px;">
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" height="100%"  dir="rtl">
<tr style=" background-color:#dbdbdb; background-image:url(images/g1.png)">
<td width="29" height="50"><img src="images/tap_r.png" width="29" height="50"></td>
<td width="942">
<div style="position:absolute; margin-top:-55px" align="right">
<table border="0" cellspacing="0" cellpadding="0" width="900">
<tr><td width="80"><a href="arcive.php">
<img src="images/arcive_a.png" width="76" height="73" border="0" 
onMouseOver="sitchImg('icon1','images/arcive_b.png')" onMouseOut="sitchImg('icon1','images/arcive_a.png')" id="icon1"></a></td>
<td width="80"><a href="index.php">
<img src="images/gallary_a.png" width="76" height="73" border="0"
onMouseOver="sitchImg('icon2','images/gallary_b.png')" onMouseOut="sitchImg('icon2','images/gallary_a.png')" id="icon2"></td>
<td width="700" align="left" valign="bottom" style="line-height:40px" id="info">&nbsp;</td>
</tr>
</table>
</div>
</td>
<td width="29"><img src="images/tap_l.png" width="29" height="50"></td>
</tr>
<tr>
<td colspan="3" valign="top" style="border-top:1px #e1e1e1 solid; background-color:#fbfbfb">
