<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=0;
if ( isset($_POST['id']))
$id=mysql_real_escape_string($_POST['id']);

$sql="select * from orders  where  id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,0,'id');
	$name=mysql_result($res,0,'name');
	$num=mysql_result($res,0,'num');
	$date=mysql_result($res,0,'date');
	$expenses=mysql_result($res,0,'expenses');?>
   	<div><div  class="close">&nbsp;</div>&nbsp;</div>
    <div style="margin:15px; font-size:18px;">
    Order #NO: <?=$num?><br />#LOT: <?=$name?></br><span style="font-size:14px"><?=$date?></span></div>

    <?
    $sql2="select * from ord_opr o , items i   where o.it_id=i.id  and o.ord_id='$id'";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
    <table border="0" cellpadding="5" cellspacing="1" class="inv_list " style="width: 600px" >
    <tr><th width="100">Item</th><th width="100">Price</th><th width="100">Quantity</th><th width="100">Balance</th></tr><?
	$i=0;	
	$total=0;
	while($i<$rows2){
		$item=mysql_result($res2,$i,'i.name');
		$item_id=mysql_result($res2,$i,'i.id');
		$price=mysql_result($res2,$i,'o.price');
		$qunt=mysql_result($res2,$i,'o.qunt');
		$tot=$price*$qunt;
		$total=$total+$tot;
		$balance=chekQunt($_POST['id'],$item_id,0,1);
		
		if($balance==0){$col='#ff9999';}else{$col='#ffffff';}	 	
		?><tr bgcolor="<?=$col?>">
        <td style="background-color:<?=$col?>"><?=$item?></td>
        <td style="background-color:<?=$col?>"><?=Price($price)?></td>
        <td style="background-color:<?=$col?>"><?=$qunt?></td>
        <td style="background-color:<?=$col?>"><?=$balance?></td>
        </tr><?		
		$i++;
	}
	?>
    </table><?
	}
}
}
?>