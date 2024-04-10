<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$name=$_POST['name'];
$price=$_POST['price'];
$sql="select * from `items` where name='$name'";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows==0){
	$sql2="INSERT INTO `items` (`name`,`price`)values('$name','$price')";
	$res2=mysql_query($sql2);
}
}
?>
