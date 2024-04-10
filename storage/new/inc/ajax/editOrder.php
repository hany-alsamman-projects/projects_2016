<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=$_POST['id'];
$sql="select * from orders ord  where ord.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,$i,'ord.id');
	$name=mysql_result($res,$i,'ord.name');
	$num=mysql_result($res,$i,'ord.num');
	$date=mysql_result($res,$i,'ord.date');
	$expenses=mysql_result($res,$i,'ord.expenses');	
	echo $id.'|'.$name.'|'.$num.'|'.$expenses;
    
    $sql2="select * from ord_opr ord , items i , orders o  where ord.ord_id='$id' and ord.it_id=i.id and ord.ord_id=o.id";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){
		$i=0;	
		$total=0;
		while($i<$rows2){
			echo '^';
			$v_id=mysql_result($res2,$i,'ord.id');
			$item=mysql_result($res2,$i,'i.name');
			$item_id=mysql_result($res2,$i,'i.id');
			$price=mysql_result($res2,$i,'ord.price');
			$qunt=mysql_result($res2,$i,'ord.qunt');
			$order=mysql_result($res2,$i,'o.name');
			echo $item_id.'|'.$qunt.'|'.$price;
			$i++;
		}
	}
}
}?>