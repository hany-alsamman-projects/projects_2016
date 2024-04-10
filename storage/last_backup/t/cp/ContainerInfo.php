<? include("inc/header.php");
checkUser(2);
$id=$_REQUEST['id'];
$sql="select * from orders  where  id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,$i,'id');
	$name=mysql_result($res,$i,'name');
	$num=mysql_result($res,$i,'num');
	$date=mysql_result($res,$i,'date');
	$expenses=mysql_result($res,$i,'expenses');?>
<div style="font-size:18px; margin-bottom:10px;">#LOT: <?=$name?></div>
<div style="font-size:12px;">Container Number: <strong><?=$num?></strong></div>
<div style="font-size:12px;">Container date: <strong><?=$date?></strong></div>
<div style="font-size:12px;">Expenses: <span style=" color:#F00; font-size:14px;"> <?=Price($expenses)?></span></div>

    <?
	$sql11="select sum(qunt*price) as tot from ord_opr where ord_id='$id' group by 'tot'";
	$res11=mysql_query($sql11);
	$rows11=mysql_num_rows($res11);
	if($rows11){$OrderCost= mysql_result($res11,0,'tot');}
	
	$sql111="select sum(qunt*price) as tot from inv_opr where ord_id='$id' group by 'tot'";
	$res111=mysql_query($sql111);
	$rows111=mysql_num_rows($res111);
	if($rows111){$OrderSells= mysql_result($res111,0,'tot');}
	
    $sql2="select * from ord_opr o , items i   where o.it_id=i.id  and o.ord_id='$id'";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
    <div style="width:700px; margin-top:20px; font-size:18px;">Elements of the Container </div>
    <table width="700" border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
    <tr class="list">
    <td>Iteme</td>
    <td width="80" align="center">Price</td>
    <td width="80" align="center">Cost</td>
    <td width="80" align="center">Total Cost</td>
    <td width="80" align="center">Quantity</td>
    <td width="80" align="center">Balance</td>
    </tr><?
	$i=0;	
	$total=0;
	$allSelesBalanceCost=0;
	while($i<$rows2){
		$item=mysql_result($res2,$i,'i.name');
		$item_id=mysql_result($res2,$i,'i.id');
		$price=mysql_result($res2,$i,'o.price');
		$qunt=mysql_result($res2,$i,'o.qunt');
		$tot=$price*$qunt;
		$total=$total+$tot;
		$balance=chekQunt($_GET['id'],$item_id,0,1);		
		
		$cost1=(($tot*$expenses)/$OrderCost)/$qunt;
		$itemCost=intval($cost1*100)/100;
		
		$selesBalance=$qunt-$balance;
		$selesBalanceCost=$selesBalance*($price+$itemCost);
		$allSelesBalanceCost=$allSelesBalanceCost+$selesBalanceCost;
		if($balance==0){$col='#eee';}else{$col='#ffffff';}	 	
		?><tr bgcolor="<?=$col?>" class="list_n">
        <td style="background-color:<?=$col?>"><?=$item?></td>
        <td align="center" style="background-color:<?=$col?>"><?=Price($price)?></td>
        <td align="center" style="background-color:<?=$col?>"><?=Price($itemCost)?></td>
        <td align="center" style="background-color:<?=$col?>"><?=Price($price+$itemCost)?></td>
        <td align="center" style="background-color:<?=$col?>"><?=$qunt?></td>
        <td align="center" style="background-color:<?=$col?>"><strong><?=$balance?></strong></td>
        </tr><?	
		$i++;
	}
	?>
    </table>

<? 
/***************************************************************************************/
$fb=$OrderSells-$allSelesBalanceCost;
$col='e00';
if($fb>0){$col='0c0';}
?>
<div style="float:left;">
<table  border="0" cellpadding="3" cellspacing="0"  style="margin-top:25px;">
<tr class="list"><td colspan="2" align="center" >Items sold</td></tr>
<tr class="list_n"><td align="right" >Container Iteme Cost : </td><td ><strong style="color:#e00"><?=Price($allSelesBalanceCost)?></strong></td></tr>
<tr class="list_n"><td align="right" >Total Sales : </td><td ><strong style="color:#0c0"><?=Price($OrderSells)?></strong></td></tr>
<tr class="list_n">
<td align="right" >Final balance : </td><td ><strong style=" font-size:34px;color:#<?=$col?>"><?=Price($fb)?></strong></td>
</tr>
<tr class="list_n">
  <td align="right" >The rate of profit : </td>
  <td ><strong style=" font-size:16px;color:#<?=$col?>">  
  %<?
  if($allSelesBalanceCost!=0){
 echo intval(( (($OrderSells*100)/$allSelesBalanceCost)-100)*100)/100;}else{echo 0;} ?></strong></td>
</tr>
</table>
</div>    
   <div></div>
<div style="float:left; margin-left:100px;">
<table  border="0" cellpadding="3" cellspacing="0"  style="margin-top:25px;">
<tr class="list"><td colspan="2" align="center" >The costs of Container</td></tr>
<tr class="list_n"><td align="right" >Cost : </td><td ><strong><?=Price($OrderCost)?></strong></td></tr>
<tr class="list_n"><td align="right" >Expenses : </td><td ><strong><?=Price($expenses)?></strong></td></tr>
<tr class="list_n"><td align="right" >Total Cost : </td><td ><strong style="color:#e00"><?=Price($OrderCost+$expenses)?></strong></td></tr></table>
</div>



	<?
	$sql22="select * from inv_opr o , items i , invices v , customers c , users u  where 
	o.ord_id='$id' and
	o.inv_id=v.id and
	o.it_id=i.id and
	v.user_id=u.id and	
	v.c_id=c.id order by o.id DESC
	";
	$res22=mysql_query($sql22);
	$rows22=mysql_num_rows($res22);
	if($rows22>0){?>
<div style="width:700px; margin-top:200px; font-size:18px; border-top:1px #999 solid; line-height:40px; height:40px">Sales related to this Container</div>
    <table border="0" cellpadding="3" cellspacing="0" style="margin-bottom:40px;">
    <tr class="list">
    <td width="160">Invoice number</td>
    <td width="90" align="center">Iteme</td>    
    <td width="70" align="center">Quantity</td>
    <td width="70" align="center">Price</td>
    <td width="79" align="center">User</td>
    <td width="145">Date</td>
    </tr>
    <?
	$i=0;	
	$total=0;
	$allSelesBalanceCost=0;
	while($i<$rows22){
		$invice=mysql_result($res22,$i,'v.id');
		$customer=mysql_result($res22,$i,'c.name');
		$iteme=mysql_result($res22,$i,'i.name');
		$date=mysql_result($res22,$i,'v.date');
		$qunt=mysql_result($res22,$i,'o.qunt');
		$price=mysql_result($res22,$i,'o.price');
		$user=mysql_result($res22,$i,'u.fname');
	 	
		?><tr class="list_n">
        <td><a href="InviceInfo.php?id=<?=$invice?>" style="color:#06C"><?=$invice.' ( '.$customer.' )'?></a></td>
        <td align="center"><?=$iteme?></td>
        <td align="center"><?=$qunt?></td>        
        <td align="center"><?=Price($price)?></td>
        <td align="center"><?=$user?></td>
      <td><?=$date?></td>
        </tr>
    <?	
		$i++;
	}
	?>
    </table>
	<? }
	
	}
}
include("inc/footer.php")?>
