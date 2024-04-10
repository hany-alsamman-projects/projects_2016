<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	$user_id=$_SESSION['user_id'];
	$id=$_POST['id'];
	$t=$_POST['t'];
	
	if($t=='c'){
		$sql="delete  from inv_porx where user_id='$user_id' ";
		$res=mysql_query($sql);
	}
	
	if($t=='x'){
		$sql="delete  from inv_porx where id='$id' ";
		$res=mysql_query($sql);
	}
	
	if(t=='v'){
		$sql="delete  from invices where id='$id' ";
		$res=mysql_query($sql);	
		$sql2="delete  from inv_opr where inv_id='$id'  ";
		$res=mysql_query($sql2);
	}
}
?>