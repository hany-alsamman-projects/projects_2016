<?
session_start();
include("../../../min/dbc.php");
include("../../inc/funs.php");
if(checkAjax() && isset($_POST['id']) && isset($_REQUEST['opr'])){
	$id=$_POST['id'];
	$opr=$_POST['opr'];
	if($opr==1){
		$opr=0;
	}else{
		$opr=1;
	}
	$sql="UPDATE msgs set readed='$opr' where id ='$id'";
	$res=mysql_query($sql);
	if($res){
		echo $opr;
	}else{
		echo 'x';
	}
};
?>sdfgsdfgdggf