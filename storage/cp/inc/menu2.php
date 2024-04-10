<!--<div style="background-color:#CCC; height:30px; line-height:30px; margin-bottom:15px" 
onclick="document.location='<?=$LANG_URL?>'" class="hand"><?=_xlang?></div>-->

<?
$menu_names=array('Users','Home page','SEO',_logout);
$menu_links=array('admin_users.php','site_info.php','home_seo.php','login.php?out'); 
?>


<table width="220" border="0" cellspacing="0" cellpadding="0" class="menu" style="margin-top:30px">
<? for($m=0;$m<count($menu_names);$m++){
	?><tr><td width="32">&nbsp;</td><td width="188"><a href="<?=$menu_links[$m]?>"><?=$menu_names[$m]?></a></td></tr><?
}?>
</table>
