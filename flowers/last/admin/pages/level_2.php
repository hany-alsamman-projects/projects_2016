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

<SCRIPT LANGUAGE="JavaScript">

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

</script>

<script type="text/javascript">

function confirmDelete(delUrl) {
  if (confirm("هل انت متأكد من عملية الحذف!")) {
    document.location = delUrl;
  }
}
</script>

</head>

<body>

<!-- start dashboard -->
<table align="center" cellpadding="5" cellspacing="0" style="width: 75%" class="white_bg board_style">
	<tr>
				<td style="text-align:right; direction: rtl" colspan="2">
				أهلا بك: <b><? print $_SESSION["user_name"] ?></b> 
				IP: <? print $_SESSION["ip"] ?> |  
				<img align="middle" src="images/admin/house.png" /> <a target="_blank" href="../index.php">عرض الرئيسية</a> |  
				<img align="middle" src="images/admin/lock.png" /> <a href="index.php?section=ChangePassword">كلمة السر</a> |  
				<img align="middle" src="images/admin/door_out.png" /> <a href="index.php?section=logout">تسجيل خروج</a>
				</td>
	</tr>
	<tr>
		<td style="width: 30%; text-align:center"><img src="images/small_l.jpg" width="187" height="62" /></td>
		<td style="width: 70%">
			<table class="gray_bg" align="right" cellpadding="0" cellspacing="0" style="width: 216px">
				<tr>
					<td style="text-align:center; width: 108px"><a href="index.php?section=ShowPosts">الردود</a> <img align="middle" src="images/admin/review.png" /></td>
					<td style="text-align:center; width: 108px"><a href="index.php?section=ShowTopics">المواضيع</a> <img align="middle" src="images/admin/topic.png" /></td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td style="padding:0px" colspan="2">
		<table cellpadding="5" cellspacing="0" style="width: 100%">
			<tr>
				<!-- menu -->
				<td style="width: 30%" valign="top">				
				<div style="text-align:right; font-size: 8pt; padding: 5px">الوصول السريع</div>
				<div style="padding:5px; width: 95%;" class="gray_bg" align="center">
					<table align="center" cellpadding="5" cellspacing="0" class="white_bg" style="width: 96%; margin-right:2px">
						<tr>
							<td style="height: 27px">

						    <div style="margin-left: 10px; width: 240px; direction:rtl; text-align: right">
						    <img align="absbottom" src="images/admin/views.png"> <a href="index.php?section=ShowTopics&WaitingTopics=true" target="_self"> 
							مواضيع تنتظر التفعيل</a><br />
						    <img align="absbottom" src="images/admin/views.png"><a href="index.php?section=ShowTopics&Archives=true" target="_self">عرض الارشيف</a><br />
						    <img align="absbottom" src="images/admin/add.png"><a href="index.php?section=AddTopic" target="_self">اضافة موضوع</a><br />
						    </div>
							<?
							}
							?>

							<?
							if(eregi('post',$_GET['section'])){
							?>
						    <div style="margin-left: 10px; width: 240px; direction:rtl; text-align: right">
						    <img align="absbottom" src="images/admin/views.png"><a href="index.php?section=ShowPosts" target="_self">عرض الردود</a><br />
						    <img align="absbottom" src="images/admin/views.png"><a href="index.php?section=ShowPosts&WaitingPosts=true" target="_self">ردود تنتظر التفعيل</a><br />
						    </div>
							<?
							}
							?>

							</td>
						</tr>
					</table>
				</div>	
				</td>
				<!-- menu -->
				
				<!-- content -->
				<td style="width: 70%; direction:rtl" valign="top">				
				<?
			    $this->CHECK_PAGES();
				?>
				</td>
				<!-- content -->
						
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td style="text-align:center; color: #C5913B; font-weight: bold" colspan="2">كودكس لإدارة المحتوى الأخباري , جميع الحقوق محفوظة  <?=date("Y")?> - <?=(date("Y")+1)?> لموقع مستشفى المواساة</td>
		
	</tr>
</table>

<!-- end dashboard -->

</body>
</html>