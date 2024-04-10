<? include("inc/header.php");
$id=$_REQUEST['id'];
$sql="select * from  customers where id='$id' ";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$customer=mysql_result($res,$i,'name');
	$company=mysql_result($res,$i,'company');?>
	<div style="font-size:18px; margin-bottom:10px;"><?=$company.' ( '.$customer.' ) '?></div><?
	
	$sql2="select * from invices v ,users u where v.c_id='$id' and v.user_id=u.id ";		
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
<div style="width:700px; margin-top:20px; font-size:18px;">Invices </div>
	<table width="700" border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
    <tr class="list">
    <td>Invice</td><td>Date</td><td>User</td><td>Total</td></tr><?
	$i=0;	
	$total1=0;
	while($i<$rows2){
		$sql4="select sum(o.qunt*o.price) as tot from inv_opr o , invices v where v.c_id='$id' and v.id=o.inv_id group by 'tot'";
		$res4=mysql_query($sql4);
		$rows4=mysql_num_rows($res4);
		if($rows4){$tot= mysql_result($res4,0,'tot');}
		
		$total1=$total1+$tot;
		$v_id=mysql_result($res2,$i,'v.id');
		$user=mysql_result($res2,$i,'u.fname');
		$date=mysql_result($res2,$i,'date');
	
		?><tr bgcolor="<?=$col?>" class="list_n">
        <td><?=$v_id?></td>
        <td><?=$date?></td>
        <td><?=$user?></td>
      <td align="right"><?=Price($tot)?></td>

       </tr><?	
		$i++;
	}
	?>
    <tr class="list_n"><td colspan="3">&nbsp;</td><td style="color:#900; font-weight:bold" align="right"><?=Price($total1)?></td></tr>	
    </table>
   
   
<?	
	$sql2="select * from payments where cus='$id' ";		
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	$total2=0;
	if($rows2>0){?>
<div style="width:700px; margin-top:20px; font-size:18px;">Payments </div>
	<table width="700" border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
    <tr class="list">
    <td>Date</td><td>Note</td><td>Payment</td></tr><?
	$i=0;	
	while($i<$rows2){
			
		$pay=mysql_result($res2,$i,'pay');
		$date=mysql_result($res2,$i,'date');
		$note=mysql_result($res2,$i,'note');
		
		$total2=$total2+$pay;
	
		?><tr bgcolor="<?=$col?>" class="list_n">
        <td><?=$date?></td>
        <td><?=$note?>&nbsp;</td>
        <td align="right"><?=Price($pay)?></td>

       </tr><?	
		$i++;
	}
	?>
    <tr class="list_n"><td colspan="2">&nbsp;</td><td style="color:#090; font-weight:bold" align="right"><?=Price($total2)?></td></tr>
   </table>
   <? }?>





   <? 
   $totalInvice=$total2-$total1;
   $col3='900';if($totalInvice>0){$col3='090';}?>
<table border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
<tr class="list"><td colspan="2">Customer Balance</td></tr>
<tr class="list_n"><td width="120" align="right">Purchases : </td><td style="color:#900; font-size:16px"><?=Price($total1)?></td></tr>
<tr class="list_n"><td align="right">Payments :</td><td style="color:#090; font-size:16px"><?=Price($total2)?></td></tr>
<tr class="list_n"><td align="right">Balance :</td><td style="color:#<?=$col3?>; font-size:34px"><?=Price($totalInvice)?></td></tr>
</table>
<? 

}
}
include("inc/footer.php")?>
