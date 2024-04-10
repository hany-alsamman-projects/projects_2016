<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=0;
if (isset($_POST['id']))
$id=mysql_real_escape_string($_POST['id']);
$sql="select * from invices v , customers c  where  v.c_id=c.id and v.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,0,'v.id');
	$name=mysql_result($res,0,'c.company');
	$date=mysql_result($res,0,'v.date');?>
   	<div><div  class="close" onclick="clsWin(1)">&nbsp;</div>&nbsp;</div>
    <div style="margin:15px; font-size:18px;">
    Invoice #NO: <?=$id?><br/>Customer: <?=$name?></br><span style="font-size:14px"><?=$date?></span></div>

    <?
    $sql2="select * from inv_opr v , items i , orders o  where v.inv_id='$id' and v.it_id=i.id and v.ord_id=o.id";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
    <table border="0" style="padding: 10px" class="inv_list " width="800" >
    <tr><th>#LOT</th><th>Item</th><th>Price</th><th>Quantity</th><th>&nbsp;</th></tr><?
	$i=0;	
	$total=0;

	while($i<$rows2){
		$item=mysql_result($res2,$i,'i.name');
		$price=mysql_result($res2,$i,'v.price');
		$qunt=mysql_result($res2,$i,'v.qunt');
		$order=mysql_result($res2,$i,'o.name');
		$tot=$price*$qunt;
		$total=$total+$tot;

		if(($i%2)==0){$col='#cceecc';}else{$col='#edfaed';}
		?><tr style="height: 25px" bgcolor="<?=$col?>">
        <td><?=$order?></td>
        <td><?=$item?></td>
        <td><?=Price($price)?></td>
        <td><?=$qunt?></td>
        <td width="90"><?=Price($tot)?></td>
        </tr><?
		$i++;
	}
	?>
    <tr  bgcolor="<?=$col?>" >
        <th colspan="4" style="text-align:right; padding: 10px"><strong>Total</strong></th>
        <th width="90" style="padding: 10px">$<?=$total?></th>
        </tr>
    </table>

        <a href="print.php?v=<?=$_POST['id']?>" target="_blank"><img src="images/print.png" border="0" title="Print" alt="View" /></a>
        <img src="images/edit2.png" class="edit_invoice" id="<?=$_POST['id']?>" title="Edit" alt="Edit"  />

    <?
	}
}
}
?>