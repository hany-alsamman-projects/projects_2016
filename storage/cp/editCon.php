<? include("inc/header.php");

$min_page='Containers.php';
$parameter="&id=".$_REQUEST['id'];

$title='
<div style="font-size:26px;font-weight:normal;">'.get_val('orders','name',$_REQUEST['id']).'</div>
<div style="font-size:12px;font-weight:normal;margin-top:15px"><a href="'.$min_page.'" class="ex_link">Back</a></div>';

$table="orders";
$order="id";
$order_dir="ASC";
$rpp=10;//record per page

$condtion="";
$list_arr=array('name','num','date');
$list_names=array('LOT#','Container number','Date');
$list_type=array('text','text','date'); 
$list_vld=array('','');
$list_par=array('','','');
$list_show=array('1','1','1');
?>
<script src="../library/nicEdit/nicEdit.js" type="text/javascript"></script>
<script>bkLib.onDomLoaded(function() {new nicEditor({fullPanel : true}).panelInstance('e_editor')});</script>
<?

$count_c=count($list_arr);
if($_POST['opr']=="edit"){
	$edit_id=$_POST['edit_id'];
	for($i=0;$i<$count_c;$i++){
		if($list_type[$i]!='sun' && $list_type[$i]!='m_id'){
			if($list_type[$i]!='static'){
				$cols.="`".$list_arr[$i]."`";			
				$v=post_val($list_type[$i],$list_arr[$i],'edit');
				if($v=="xXx"){
					echo $xadd=1;
				}			
				//echo "(".$v.")|";
				$vals.="`".$list_arr[$i]."`='".$v."'";
				if($i<$count_c-1 && $list_type[$i+1]!='sun'){
					$cols.=",";
					$vals.=",";
				}
			}
		}
	}
	//echo "(".$vals.")";
	if($xadd!=1){
		echo $sql="UPDATE `$table` SET $vals where id='$edit_id'";
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$min_page.'"</script>';
		}
	}else{
		echo '<script>// document.location="'.$min_page.'?x"</script>';
	}
}
//-----------------------------------------------
$id=$_REQUEST['id'];
$sql2="select * from $table where id= '$id'";
$res2=mysql_query($sql2);
$rows2=mysql_num_rows($res2);
if($rows2>0){
?>
<!-------------------------------------------------------------------------------->
<div class="titles"><?=$title?></div>
<form  name="editForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="edit" />
<input type="hidden" name="edit_id" id="edit_id" value="<?=$id?>" />
<table  border="0" cellspacing="0" cellpadding="3"><tr>
<? 
for ($i=0;$i<$count_c;$i++){
	$val=mysql_result($res2,0,$list_arr[$i]);
	if($list_type[$i]!='static'){?>
		<tr><td valign="top"  class="list_n"><?=$list_names[$i]?> :</td>
	    <td ><?=get_form_edit($list_type[$i],$list_arr[$i],$list_par[$i],$val)?></td></tr><?
	}
}
$sql22="select * from oprs o,items i where o.p_id= '$id' and o.opr='buy' and o.it_id=i.id";
$res22=mysql_query($sql22);
$rows22=mysql_num_rows($res22);
if($rows22>0){
	?>
	<tr><td  class="list_n"></td>
	<td >Itemes</td></tr>
	<?
	$it=0;
	while($it<$rows22){
		$it_id=mysql_result($res22,$it,'i.name');
		$qunt=mysql_result($res22,$it,'qunt');
		?>
		<tr><td  class="list_n"><?=$it_id?> :</td>
		<td ><input type="checkbox" checked="checked"/><input type="text" value="<?=$qunt?>" class="text_f"/></td></tr><?
		$it++;
	}
}
?>

<tr><td  class="list_n">&nbsp;</td>
<td ><input type="submit" value="<?=_save?>" />
<input type="button" value="<?=_back?>" onclick="document.location='<?=$min_page?>'" /></td></tr>
</table>


</form>
<? }?>


<?

include("inc/footer.php")?>
