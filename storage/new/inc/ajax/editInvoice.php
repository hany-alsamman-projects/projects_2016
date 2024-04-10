<?
include('../../min/dbc.php');
$id=$_POST['id'];
$sql="select * from invices v , customers c  where  v.c_id=c.id and v.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,$i,'v.id');
	$name=mysql_result($res,$i,'c.company');
	$c_id=mysql_result($res,$i,'c_id');
	echo $c_id."^".$name."|"; 
	   
    $sql2="select * from inv_opr  where inv_id='$id' order by id ASC";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){
		while($i<$rows2){
			$it_id=mysql_result($res2,$i,'it_id');
			$qunt=mysql_result($res2,$i,'qunt');
			$ord_id=mysql_result($res2,$i,'ord_id');
			$price=mysql_result($res2,$i,'price');
			echo $it_id.':'.$qunt.':'.$price.':'.$ord_id;
			if($i<$rows2-1){
				echo '^';
			}			
			$i++;
		}
	}
}?>