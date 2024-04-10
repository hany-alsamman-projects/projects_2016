<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	$id=$_POST['id'];
	if(isset($_POST['i'])){
		$sql2="delete  from inv_opr where id='$id' ";
		$res=mysql_query($sql2);	
	}else{		
		$sql="delete  from invices where id='$id' ";
		$res=mysql_query($sql);	
		$sql2="delete  from inv_opr where inv_id='$id'  ";
		$res=mysql_query($sql2);
		$sql2="delete  from payments where inv='$id'  ";
		$res=mysql_query($sql2);
        echo 1;
	}
}
?>