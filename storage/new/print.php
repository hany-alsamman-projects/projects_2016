<? 
session_start();
include("min/dbc.php");
include("inc/funs.php");
login('l');
$id=$_GET['v'];


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- added by hany -->
<title>PRINT INVOICE NO# <?=$id?></title>
<link href="inc/Style.css" rel="stylesheet" type="text/css" />
<link href="library/jquery/css/smoothness/jquery-ui-1.8.16.custom.css" rel="stylesheet" type="text/css" />
<script src="library/jquery/jquery-1.6.3.min.js"></script>
<script src="library/jquery/js/jquery-ui-1.8.16.custom.min"></script>
<? include("inc/oprJS.php");?>
</head>
<body><?


$sql="select * from invices i , customers c where i.id='$id' and i.c_id=c.id limit 1 ";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	$company=mysql_result($res,0,'c.company');
	$date=mysql_result($res,0,'i.date');
	
	$sql2="select v.ord_id , sum(v.qunt) as q ,avg(v.price) as p,i.name 
	from inv_opr v , items i  
	where v.inv_id='$id' and v.it_id=i.id 
	group by i.name ";
	$res2=mysql_query($sql2);
	$rows2=mysql_num_rows($res2);

	if($rows2>0){?>



<table border="0" align="center" cellspacing="10">
<tr>

<td valign="top" style="border:1px #999 dashed"><div>
<div style="margin:15px; font-size:16px;"><?=nl2br(get_val('inv_text','header',1))?></div>
<div style="margin:15px; font-size:13pt;"><strong>invoice No</strong>: <?=$id?><br/><strong>Customer</strong>: <?=$company?></div>
<table border="0" cellpadding="5" cellspacing="1" class="inv_listP" >
<tr>
<th width="90">#LOT</th>
<th width="90">Item</th>
<th width="90">Price</th><th width="90">Quantity</th>
<th>Total</th></tr><?
$i=0;
$total=0;
while($i<$rows2){
    $item=mysql_result($res2,$i,'i.name');
    $price=mysql_result($res2,$i,'p');
    $qunt=mysql_result($res2,$i,'q');
    $tot=$price*$qunt;
    $total=$total+$tot;

    //added by hany
    $lotid = mysql_result(mysql_query("SELECT name FROM `orders` WHERE `id` = '".mysql_result($res2,$i, 'v.ord_id')."' "),0);


    ?><tr bgcolor="<?=$col?>">

    <td align="center"><?=$lotid?></td>
    <td align="center"><?=$item?></td>
    <td align="center"><?=Price($price)?></td>
    <td align="center"><?=$qunt?></td>
<td width="90" align="center"><?=Price($tot)?></td>
    </tr><?
    $i++;
}
?>
<tr bgcolor="<?=$col?>">
    <th colspan="4" style="text-align:right">Total</th>
  <th width="90" align="center"><?=Price($total)?></th>
    </tr>
</table>
<div style="margin:10px;">
<div style="width:500px; margin-bottom:15px;">
NAME: <strong><?=$company?></strong><br />


 SIGNATURE:<span style="color:#ccc">_____________________________</span></div>
<div style="font-size:14px; margin-bottom:10px"><?=nl2br(get_val('inv_text','footer',1))?></div>
  <div style="font-size:13px">invoice Date : <?=$date?></div>
<div style="font-size:13px">&nbsp; Print  Date  : <?=date('Y-m-d h:i:s')?></div></div>

</div></td>

<td valign="top" style="border:1px #999 dashed"><div>
<div style="margin:15px; font-size:16px;"><?=nl2br(get_val('inv_text','header',1))?></div>
<div style="margin:15px; font-size:13pt;"><strong>invoice No:</strong> <?=$id?><br/><strong>Customer</strong>: <?=$company?></div>
<table border="0" cellpadding="5" cellspacing="1" class="inv_listP" >
<tr>
<th width="90">#LOT</th>
<th width="90">Item</th>
<th width="90">Price</th><th width="90">Quantity</th>
<th>Total</th></tr><?
$i=0;
$total=0;
while($i<$rows2){
    $item=mysql_result($res2,$i,'i.name');
    $price=mysql_result($res2,$i,'p');
    $qunt=mysql_result($res2,$i,'q');
    $tot=$price*$qunt;
    $total=$total+$tot;
    //added by hany
    $lotid = mysql_result(mysql_query("SELECT name FROM `orders` WHERE `id` = '".mysql_result($res2,$i, 'v.ord_id')."' "),0);

    ?><tr bgcolor="<?=$col?>">

    <td align="center"><?=$lotid?></td>
    <td align="center"><?=$item?></td>
    <td align="center"><?=Price($price)?></td>
    <td align="center"><?=$qunt?></td>
<td width="90" align="center"><?=Price($tot)?></td>
    </tr><?
    $i++;
}
?>
<tr bgcolor="<?=$col?>">
    <th colspan="4" style="text-align:right">Total</th>
  <th width="90" align="center"><?=Price($total)?></th>
    </tr>
</table>
<div style="margin:10px;">
<div style="width:500px; margin-bottom:15px;">
NAME: <strong><?=$company?></strong><br />


 SIGNATURE:<span style="color:#ccc">_____________________________</span></div>
<div style="font-size:14px; margin-bottom:10px"><?=nl2br(get_val('inv_text','footer',1))?></div>
  <div style="font-size:13px">invoice Date : <?=$date?></div>
<div style="font-size:13px">&nbsp; Print  Date  : <?=date('Y-m-d h:i:s')?></div></div>

</div></td>

</tr>

<tr>
<td>Storage Copy</td>
<td>Custoumer Copy</td>
</tr>

<tr>
<td colspan="2">
<div style="width:500px; float:right; margin-bottom:15px; font-size:11px;"><strong>Please Note:</strong> any claim has to be reported to us with 24 hours as requested by agriculture of Canada. Invoice are due and payable within your credit terms. Interest will be applied to your invoice at %10 per Month</div>

<div style="width:500px; margin-bottom:15px; font-size:11px;"><strong>Please Note:</strong> any claim has to be reported to us with 24 hours as requested by agriculture of Canada. Invoice are due and payable within your credit terms. Interest will be applied to your invoice at %10 per Month</div>

</td>
</tr>
</table>




<? } 
}?>

</body></html>

