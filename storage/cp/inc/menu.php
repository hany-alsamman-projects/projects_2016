<?
if($_SESSION['user_type']==2){
	$menu_names=array('Itemes','Customers','Containers','Invoices','Reports','Users','Invice Information',_logout);
	$menu_links=array('Itemes.php','customers.php','Containers.php','Invoices.php','Reports.php','users.php','invInformation.php','login.php?out');
}else{
	$menu_names=array('Customers','Payments',_logout);
	$menu_links=array('customers2.php','payments.php','login.php?out');
}
?>


<table width="220" border="0" cellspacing="0" cellpadding="0" class="menu" style="margin-top:30px">
<? for($m=0;$m<count($menu_names);$m++){
	?><tr><td width="32">&nbsp;</td><td width="188"><a href="<?=$menu_links[$m]?>"><?=$menu_names[$m]?></a></td></tr><?
}?>
</table>
