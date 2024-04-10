<? include("inc/header.php");
checkUser(2);
$id=$_REQUEST['id'];
$sql="select * from invices v ,users u ,customers c  where  v.id='$id' and c.id=v.c_id and u.id=v.user_id limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,$i,'v.id');
	//$name=mysql_result($res,$i,'u.fname');
	$customer=mysql_result($res,$i,'c.name');	
	$date=mysql_result($res,$i,'v.date');?>
<div style="font-size:18px; margin-bottom:10px;">Customer : <?=$customer?></div>
<div style="font-size:12px;">User : <strong><?=$customer?></strong></div>
<div style="font-size:12px;">Invice date: <strong><?=$date?></strong></div><?
    $sql2="select * from inv_opr v , items i , orders o , invices inv  where 
	v.it_id=i.id  and 
	v.ord_id=o.id and 
	v.inv_id=inv.id and
	inv.id='$id'
	";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
    <div style="width:700px; margin-top:20px; font-size:18px;">Elements of the Invice </div>
    <table width="700" border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
    <tr class="list">
    <td>Container</td><td>Iteme</td><td>Quantity</td><td>Price</td><td>Total</td><td>Costs</td><td>Balance</td></tr><?
	$i=0;	
	$total=0;
	$allSelesBalanceCost=0;
	$totalInvice=0;
	$totalInviceCost=0;
	$totalInviceSell=0;
	while($i<$rows2){
		$item=mysql_result($res2,$i,'i.name');
		$item_id=mysql_result($res2,$i,'i.id');
		$price=mysql_result($res2,$i,'v.price');
		$qunt=mysql_result($res2,$i,'v.qunt');
		$order=mysql_result($res2,$i,'o.name');
		$order_id=mysql_result($res2,$i,'o.id');
		$tot=$price*$qunt;
		$total=$total+$tot;
		
		$totalSell=$price*$qunt;
		$totalCost=totalCost($id,$item_id,$qunt,$order_id);
		$col='fff';
		$col2='090';
		$Balance=$totalSell-$totalCost;
		if($Balance<0){
			$col='fee';
			$col2='900';
		}
		$totalInvice=$totalInvice+$Balance;
		$totalInviceCost=$totalInviceCost+$totalCost;
		$totalInviceSell=$totalInviceSell+$totalSell;
	 	
		?><tr bgcolor="<?=$col?>" class="list_n">
        <td style="background-color:<?=$col?>"><a href="ContainerInfo.php?id=<?=$order_id?>" style="color:#06C">#<?=$order?></a></td>
        <td style="background-color:<?=$col?>"><?=$item?></td>
        <td style="background-color:<?=$col?>"><?=$qunt?></td>
        <td style="background-color:<?=$col?>">$<?=$price?></td>
        <td style="background-color:<?=$col?>; color:#090"><strong><?=Price($totalSell)?></strong></td>
        <td style="background-color:<?=$col?>; color:#900"><strong><?=Price($totalCost)?></strong></td>
    <td style="background-color:<?=$col?>; color:#<?=$col2?>;"><strong><?=Price($Balance)?></strong></td>
        </tr><?	
		$i++;
	}
	?>
   </table>

   <? $col3='900';if($totalInvice>0){$col3='090';}?>
<table border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
<tr class="list"><td colspan="2">Invise Balance</td></tr>
<tr class="list_n"><td width="120" align="right">Costs : </td><td style="color:#900; font-size:16px"><?=Price($totalInviceCost)?></td></tr>
<tr class="list_n"><td align="right">Sells :</td><td style="color:#090; font-size:16px"><?=Price($totalInviceSell)?></td></tr>
<tr class="list_n"><td align="right">Balance :</td><td style="color:#<?=$col3?>; font-size:34px"><?=Price($totalInvice)?></td></tr>
</table>
<? 

}
}
include("inc/footer.php")?>
