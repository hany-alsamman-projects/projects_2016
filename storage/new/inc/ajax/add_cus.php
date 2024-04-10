<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
include('../../min/dbc.php');
$name=$_POST['name'];
$phone=$_POST['phone'];
$mobile=$_POST['mobile'];
$com=$_POST['com'];

$sql="select * from `customers` where name='$name'";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows==0){
	$sql2="INSERT INTO `customers` (`name`,`phone`,`mobile`,`company`)values('$name','$phone','$mobile','$com')";
	$res2=mysql_query($sql2);
}
}
?>
