<?
$count_c=count($list_arr);

//add-------------------------------------

if($_POST['opr']=="add"){
	$cols="";
	$vals="";
	for($i=0;$i<$count_c;$i++){
		if($list_type[$i]=='m_id'){
			$cols.="`".$list_arr[$i]."`";
			$v=$list_par[$i];
			$vals.="'".$v."'";
		}else if($list_type[$i]!='sun'){
			$cols.="`".$list_arr[$i]."`";
			if($list_type[$i]!='static'){			
				$v=post_val($list_type[$i],$list_arr[$i],'add');
				$vals.="'".$v."'";				
			}else{
				$v=$list_par[$i];
				$vals.="'".$v."'";
				echo "(".$vals.")";
			}				
		}
		//echo"(".$v.")";			
		if($v=="xXx"){
			$xadd=1;
		}
						
		if($i<$count_c-1 && $list_type[$i+1]!='sun'){
			$cols.=",";
			$vals.=",";
		}
	
	}
	//echo "(".$cols.")<br>(".$vals.")";
	if($xadd!=1){
		$sql="INSERT INTO `$table`($cols)values($vals)";
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$min_page.'"</script>';
		}
	}else{
		echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
	}
}
?>
<div class="titles"><?=$title?></div>
<form  name="addForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="add" />
<table  border="0" cellspacing="0" cellpadding="3"><tr>
<? 
for ($i=0;$i<$count_c;$i++){
	if($list_type[$i]!='static'){?>
		<tr><td valign="top"  class="list_n"><?=$list_names[$i]?> :</td>
    	<td ><?=get_form_type($list_type[$i],$list_arr[$i],$list_par[$i])?></td></tr><?
	}
}?>
<tr><td  class="list_n">&nbsp;</td>
<td ><input type="submit" value="<?=_save?>" />
<input type="button" value="<?=_back?>" onclick="document.location='<?=$min_page?>'" /></td></tr>
</table>
</form>
