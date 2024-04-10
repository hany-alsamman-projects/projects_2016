<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	$id=$_POST['id'];
	if(isset($_POST['i'])){
		$sql2="delete  from inv_opr where id='$id' ";
		$res=mysql_query($sql2);	
	}else{		
		$sql="delete  from orders where id='$id' ";
		$res=mysql_query($sql);	
		$sql2="delete  from ord_opr where ord_id='$id'  ";
		$res=mysql_query($sql2);
	}

    if(mysql_affected_rows() > 0) echo 1; else echo 0;
}
?>