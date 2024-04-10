<? include("inc/header.php");
checkUser(2);
$week=date('W');
if(isset($_REQUEST['W'])){
	$title='INVICES INTHIS WEEK';
	$q=" week(v.date)='$week' and ";
	$link='<a href="Reports.php" style="color:#06C">SHOW ALL INVICES</a>';
}else{
	$title='ALL INVICES';
	$q="";	
	$link='<a href="Reports.php?W" style="color:#06C">SHOW INVICES IN THIS WEEK</a>';
}
//$sql="select * from invices v , users u , customers c  where week(v.date)='$week' and v.c_id=c.id and v.user_id=u.id ";

$sql="select * from invices v , users u , customers c  where $q v.c_id=c.id and v.user_id=u.id ";

$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){?>
<div style="width:700px; margin-top:20px; font-size:18px;"><?=$title?></div>
<div style="width:700px; margin-top:20px; font-size:12px;"><?=$link?></div>
    <table width="700" border="0" cellpadding="3" cellspacing="0"  style="margin-top:15px;">
    <tr class="list">
    <td>Customer</td><td>User</td><td>Date</td><td>Balance</td></tr><?
	$i=0;
	$inv_total=0;
	while($i<$rows){
		$id=mysql_result($res,$i,'v.id');
		$date=mysql_result($res,$i,'v.date');
		$customer=mysql_result($res,$i,'c.name');
		$user=mysql_result($res,$i,'u.fname');
		$Balance=getInviceBalance($id);
		$col2='090';
		$col='fff';
		if($Balance<=0){$col2='900';$col='fee';}	 	
		?><tr class="list_n">
        <td style="background-color:<?=$col?>"><a href="InviceInfo.php?id=<?=$id?>" style="color:#06C">
		<?=$id.'('.$customer.')'?></a></td>
        <td style="background-color:<?=$col?>"><?=$user?></td>
        <td style="background-color:<?=$col?>"><?=$date?></td>
        <td style="background-color:<?=$col?>; color:#<?=$col2?>"><?=Price($Balance)?></td></tr><?	
		$inv_total=$inv_total+$Balance;
		$i++;
	}
		$col2='090';
		$col='fff';
		if($inv_total<=0){$col2='900';$col='fee';}	
	?>    <tr class="list_n">

      <td colspan="4" align="right" style="background-color:<?=$col?>; color:#<?=$col2?>; font-size:34px"><?=Price($inv_total)?></td>
    </tr></table><?
}
include("inc/footer.php")?>

