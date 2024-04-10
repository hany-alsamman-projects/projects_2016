<? 
session_start();
include_once('../../min/dbc.php');
include_once('../../inc/funs.php');
if(ceckAjax('l')){
	$id =-999;
if (isset($_POST['id']) ) {
	$id=mysql_real_escape_string($_POST['id']);
}
else
{
	echo "-100 - Error in id";
	die();
}

$query = "UPDATE `customers` SET `last_reset` = NOW() WHERE `id` ='$id' ";
echo "sql : $query";
$res = mysql_query($query) or die(mysql_error());
$num = mysql_affected_rows($res);
if ($num> 0)
	echo $num;
else {
	echo "-1";
}
}

?>