<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=$_POST['id'];
$note=$_POST['note'];
$sql2="UPDATE  `customers` set`note`='$note' where id='$id' ";
$res2=mysql_query($sql2);
}
?>
