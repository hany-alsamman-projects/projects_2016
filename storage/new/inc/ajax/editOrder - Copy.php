<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
$id=$_POST['id'];
?><input type="hidden" value="<?=$id?>" id="inv_id" /><?
$sql="select * from orders ord  where ord.id='$id' limit 1";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$id=mysql_result($res,$i,'ord.id');
	$name=mysql_result($res,$i,'ord.name');
	$num=mysql_result($res,$i,'ord.num');
	$date=mysql_result($res,$i,'ord.date');?>
<div><div  class="close" onclick="editOrdereOpe=0;showOrder();showOrder()">&nbsp;</div>&nbsp;</div>
<div style="margin:15px; font-size:18px;">
<?=$name?></br>NO. : <?=$num?><br><span style="font-size:14px"><?=$date?></span></div>

    <?
    $sql2="select * from ord_opr ord , items i , orders o  where ord.ord_id='$id' and ord.it_id=i.id and ord.ord_id=o.id";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);
	if($rows2>0){?>
<table border="0" cellpadding="5" cellspacing="1" class="inv_list " width="500" >
    <tr><th>Iteme</th><th>Price</th><th>Quantity</th><th colspan="2">&nbsp;</th></tr><?
	$i=0;	
	$total=0;
	while($i<$rows2){
		$v_id=mysql_result($res2,$i,'ord.id');
		$item=mysql_result($res2,$i,'i.name');
		$price=mysql_result($res2,$i,'ord.price');
		$qunt=mysql_result($res2,$i,'ord.qunt');
		$order=mysql_result($res2,$i,'o.name');
		$tot=$price*$qunt;
		$total=$total+$tot;
		
//		if(($i%2)==0){$col='#cceecc';}else{$col='#edfaed';}		
		?><tr bgcolor="<?=$col?>">
        <td><?=$item?></td>
        <td>$<?=$price?></td>
        <td><?=$qunt?></td>
        <td width="80">$<?=$tot?></td>
        <td width="45">
        <img src="images/delet.png" title="Delete" alt="Delete" class="hand" onclick="editInviceOpe=0;delRvic(<?=$v_id?>,<?=$id?>)" /></td>
        </tr>
    <?		
		$i++;
	}
	?>
    <tr bgcolor="<?=$col?>">
        <th colspan="3" style="text-align:right">Total</th>
        <th width="80">$<?=$total?></th>
      <th width="45">&nbsp;</th>
        </tr>
    </table><?
	}
}
}?>