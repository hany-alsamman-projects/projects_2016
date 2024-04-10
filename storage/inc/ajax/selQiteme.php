<? session_start();
include('../../min/dbc.php');
include('../../inc/funs.php');
if(ceckAjax('l')){
	checkTimeOutInvice();
	$i_id=0;
	$inv = 0;
if ( isset($_POST['id']))
$i_id=mysql_real_escape_string($_POST['id']);
if (isset($_POST['inv']))
$inv=mysql_real_escape_string($_POST['inv']);

$user_id=$_SESSION['user_id'];
$i_name=get_val('items','name',$i_id);
?><div><div  class="close" onclick="clsWin(2)">&nbsp;</div>&nbsp;</div>
<div style="margin-left:20px; margin-top:10px; font-size:12px;">
The balance of the warehouse of <strong><?=$i_name?></strong></div>
<script>var selII =new Array(); var i_nameSel='<?=$i_name?>'</script>
<?
//$i_id=$_POST['id'];
$sql="select o.name ,o.id , sum(p.qunt) qu ,p.price as prc from orders o , ord_opr p   where
p.it_id='$i_id' and
o.id=p.ord_id  
GROUP BY o.name order by o.date ";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
if($rows>0){
	?><table border="0" cellpadding="4" cellspacing="1" class="q_orders" width="360" align="center" style="margin:10px" >
	<tr><th>#LOT</th><th>Balance</th><th>Quantity</th></tr><?
	$i=0;
	$s=0;		
	$total=0;
	$sel=0;
	while($i<$rows){
		$ord_id=mysql_result($res,$i,'o.id');
		$name=mysql_result($res,$i,'o.name');
		$qunt=mysql_result($res,$i,'qu');

		$price=mysql_result($res,$i,'prc');
		//***********************INVICE***************************************
		$sql2="select sum(qunt) as q from inv_opr where it_id='$id' and ord_id='$ord_id'";
		$res2=mysql_query($sql2);
		$counts2=mysql_result($res2,0,'q');
		//***********************XINVICE***************************************
		$sql3="select sum(qunt) as q from inv_porx where it_id='$id' and ord_id='$ord_id'";
		$res3=mysql_query($sql3);
		$counts3=mysql_result($res3,0,'q');
		//***********************DAMAGE***************************************
		$sql4="select sum(qunt) as q from dmg_opr where it_id='$id' and ord_id='$ord_id'";
		$res4=mysql_query($sql4);
		$counts4=mysql_result($res4,0,'q');
			
		$qunt=$qunt-($counts4+$counts3+$counts2);	
		if(!$qunt){$counts=0;}
		//*********************************************************************
		if(($i%2)==0){$col='#cceecc';}else{$col='#edfaed';}		
		if(not_select($ord_id,$i_id,$user_id)==0 && $qunt >0 ){
			$sel=1;
			?><tr bgcolor="<?=$col?>">
			<td align="center"><?=$name?></td>
			<td align="center"><?=$qunt?></td>        
			<td align="center"><input type="text" id="ord<?=$ord_id?>" class="int_text co5 ie" /></td>
			</tr>
			<script>
			var OBJ=new Object();
			OBJ['i_id']=<?=$i_id?>;
			OBJ['i_order']=<?=$ord_id?>;
			OBJ['lot_name']='<?=$name?>';
			OBJ['i_qunt']=<?=$qunt?>;
			OBJ['i_price']=<?=$price?>;
			selII[<?=$s?>]=OBJ;		
			</script><?	
		$s++;	
		}
		$i++;
	}
	?></table>
<?
	if(isset($_POST['d'])){
		?><div class="save2 co5 ie" id="" onclick="saveIteme('d')" align="right">Save</div><?
	}else{ 
		if($sel==1){?>
            <div style=" float:right;margin:20px; width:400px;text-align:right">Sell Price : $
            <input type="text" id="selPrice" class="int_text co5 ie" /></div>
            <? if(isset($_POST['inv'])){?>
                <div class="save2 co5 ie" id="" onclick="saveIteme('e')" align="right">Save</div><?
            }else{
				?><div class="save2 co5 ie" id="" onclick="saveIteme('v')" align="right">Save</div><?
			}
		}else{?>
			<div style="margin-left:20px; margin-top:10px; font-size:12px;">You Select same itemes in same containers befor</div><?
		}
	}
}
} ?>

