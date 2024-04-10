<? session_start();?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="inc/en_style.css" rel="stylesheet" type="text/css" />
<link href="inc/style.css" rel="stylesheet" type="text/css" />
<title>تسجيل دخول</title>
</head>
<body>
<?
include("../min/dbc.php");
$log=false;
$msg="";
$link="login.php";
$log=0;

if(isset($_REQUEST['out'])){
	session_destroy();
	$msg="تم تسجيل الخروج";
}else{
	if(isset($_SESSION['login']) && $_SESSION['login']=='OK'){
		$log=true;
		$link="index.php";
	}
}
$user="";
if(isset($_POST['sub'])){
	$user= addslashes( $_POST['user']);
	$pass= $_POST['pass'];
	$pass= md5($pass);
	$sql="select * from `users` where un='$user'  and pw='$pass' and user_type in (2,3) limit 1";
	$res=mysql_query($sql);
	$rows=mysql_num_rows($res);
	if($rows>0){
		$user_id=mysql_result($res,0,'id');
		$user_type=mysql_result($res,0,'user_type');
		$_SESSION['login']='OK';
		$_SESSION['user_id']=$user_id;
		$_SESSION['user_type']=$user_type;
		$log=1;
	}else{
		$msg="Please try agin";	
	}	
}
if($log==1){
	echo "<script>document.location='index.php'</script>";
}else{ ?>
<form id="login" name="login" method="post" action="login.php">
<table width="296" border="0" align="center" cellpadding="3" cellspacing="0">
<tr>
<td colspan="2" align="center"><strong>Ahmad Abou RAs control panel</strong></td>
</tr>
<tr>
<td width="107" align="left">User name :</td>
<td width="201"><input name="user" type="text" class="log_text" id="user" value="<?php echo $user ?>" /></td>
</tr>
<tr>
<td align="left">Password :</td>
<td><input type="password" name="pass" id="pass" class="log_text" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input type="submit" name="sub" id="sub" value="دخول" /></td>
</tr>
<tr>
  <td colspan="2" style="color:#F00"><?=$msg?></td>
  </tr>
</table>
</form>
<? }?>

</body>
</html>