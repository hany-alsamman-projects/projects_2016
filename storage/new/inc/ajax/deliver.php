<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	$user_id=$_SESSION['user_id'];
	$id=$_POST['id'];
	$t=$_POST['t'];
	$v=$_POST['v'];
	if($t=='v'){$table='invices';}
	if($t=='o'){$table='orders';}
	
	$sql="update $table set fin='$v' where id='$id' ";
	$res=mysql_query($sql);

}
?>