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
?>
<tr><td  class="list_n">&nbsp;</td>
<td ><input type="submit" value="<?=_save?>" />
<input type="button" value="<?=_back?>" onclick="document.location='<?=$min_page?>'" /></td></tr>
</table>
</form>
<? }?>


