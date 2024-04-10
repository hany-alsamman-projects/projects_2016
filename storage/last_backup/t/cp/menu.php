<? include("inc/header.php");

$title=_menu;
$table="menu";
$order="id";
$order_dir="ord";
$rpp=25;//record per page


$p_id=0;
if(isset($_REQUEST['p_id'])){
	$p_id=$_REQUEST['p_id'];
}
if($p_id!=0){
	$title2=" - ".get_val('menu',$lg.'_name',$p_id);
}

$condtion="";
$list_arr=array('en_name','ar_name','link');
$list_names=array(en_name,ar_name,_link);
$list_type=array('text','text','list');
$list_vld=array('','','');
$list_par=array('','','');
$list_show=array('1','1','1');
?>
<script>
var list_arr=new Array('<?=implode("','", $list_arr)?>');
var list_names=new Array('<?=implode("','", $list_names)?>');
var list_type=new Array('<?=implode("','", $list_type)?>');
var list_par=new Array('<?=implode("','", $list_par)?>');
var count_c=list_arr.length;
</script>
<?
//----------------------------
$count_c=count($list_arr);

//Order-----------------------------------
if($_REQUEST['opr']=="ord"){
	if(isset($_REQUEST['o1']) && isset($_REQUEST['o2']) && isset($_REQUEST['o3']) && isset($_REQUEST['o4'])){
		$d=$_REQUEST['o1'];
		$ds=$_REQUEST['o2'];
		$o=$_REQUEST['o3'];
		$os=$_REQUEST['o4'];
		if($o==$os){
			$o=getMaxValOrder($_REQUEST['m'],$_REQUEST['n']);
			$os=$o+1;
		}
		
		$sql1="UPDATE menu SET ord='$os' where id=$d";
		$res=mysql_query($sql1);
		$sql2="UPDATE menu SET ord='$o' where id=$ds";
		$res=mysql_query($sql2);
	}
}
//oprations-----------------------------------
if(isset($_POST['opr'])){
	$xadd=0;
	//add-------------------------------------
	if($_POST['opr']=="add"){
		$en_name=$_POST['en_name'];
		$ar_name=$_POST['ar_name'];
		$link=$_POST['link'];
		$p_id=$_REQUEST['p_id'];
		$ord=getMaxVal($p_id);
		echo $sql="INSERT INTO `menu` (`en_name`,`ar_name`,`link`,`p_id`,`ord`)values('$en_name','$ar_name','$link','$p_id','$ord')";
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?p_id='.$p_id.'"</script>'; 
		}else{
			echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
		}
	}
	//edit-----------------------------------
	if($_POST['opr']=="edit"){
		$edit_id=$_POST['edit_id'];
		$en_name=$_POST['en_name'];
		$ar_name=$_POST['ar_name'];
		$link=$_POST['link'];
		$p_id=$_REQUEST['p_id'];
		
		$sql="UPDATE `$table` SET `en_name`='$en_name' , `ar_name`='$ar_name' , `link`='$link'  where id='$edit_id'";
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?p_id='.$p_id.'"</script>'; 
		}else{
			echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
		}
	}

	//delete-----------------------------------
	if($_POST['opr']=="delete"){
		$del_id=$_POST['del_id'];
		$del_file=0;
		$del_files_name=array();
		for($d=0;$d<$count_c;$d++){
			if($list_type[$d]=="photo" || $list_type[$d]=="file"){
				$del_file=1;
				array_push($del_files_name,$list_arr[$d]);
			}
		}
		if($p_id==0){
			$sql="DELETE from `$table`  where id='$del_id' or p_id='$del_id'";
		}else{
			$sql="DELETE from `$table`  where id='$del_id' limit 1";
		}
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?p_id='.$p_id.'"</script>'; 
		}else{
			echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
		}
	}
	//delete selected-----------------------------------
	if($_POST['opr']=="delSel"){
		$rows_sel=$_POST['rows'];
		for($r=0;$r<$rows_sel;$r++){
			if(isset($_POST['rec'.$r])){
				$del_id=$_POST['rec'.$r];
				if($p_id==0){
					$sql="DELETE from `$table`  where id='$del_id' or p_id='$del_id'";
				}else{
					$sql="DELETE from `$table`  where id='$del_id' limit 1";
				}
				$res2=mysql_query($sql);
			}
		}
		echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?p_id='.$p_id.'"</script>'; 
	}
}
//-----------------------------------------------

$sql="select * from menu where p_id='$p_id' order by ord ASC ";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
?>
<table width="739" border="0" cellspacing="0" cellpadding="4">
<tr>

<td width="604"><div class="titles"><?=$title?><?=$title2?> ( <?=$rows?> )</div></td>
<td width="20"><img src="images/add.png" width="20" height="20" align="right" class="hand" onclick="$(add).dialog('open')" /></td>
<td width="91"><span class="hand" onclick="$(add).dialog('open')"><?=_add?></span></a></td>
</tr>
</table>

<?
if($rows>0){?>
<script>var data =new Array();</script>
<form name="deleSelForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>" method="post">
<table border="0" cellspacing="0" cellpadding="3" width="750" >
<tr class="list" >

<td width="94">
<input type="hidden"  name="rows" value="<?=$rows?>" />
<input type="hidden"  name="opr" value="delSel" />
<input type="hidden" name="p_id" value="<?=$p_id?>" />
<input name="check_all" type="checkbox" value="" id="check_all" onclick="chekAll(<?=$rows?>)" /></td>
<td width="121"><?=_en_name?></td>
<td width="121"><?=_ar_name?></td>
<td><?=_link?></td>
<td colspan="5">&nbsp;</td>
</tr>
<?
/// Table rows -----------------------
$r=0;
while($r<$rows){
	$id=mysql_result($res,$r,'id');
	$en_name=mysql_result($res,$r,'en_name');
	$ar_name=mysql_result($res,$r,'ar_name');
	$link=mysql_result($res,$r,'link');
	?>
    <script>var OBJ=new Object ();</script>
    <tr class="list_n">
	<td><input name="rec<?=$r?>" type="checkbox" value="<?=$id?>" id="rec<?=$r?>" 
    onclick="check_empty(<?=$rows?>)" /></td>

	<td><?=$en_name?></td>
    <td><?=$ar_name?></td>	
    <td><?=$link?></td>
    <td width="1">
      <? if($p_id==0){?>
      <img src="images/sub.png" width="25" height="25" alt="<?=_sub_menu?>" title="<?=_sub_menu?>" class="hand" 
    onclick="document.location='<?=$_SERVER['PHP_SELF']?>?p_id=<?=$id?>'"/>
      <? }else{echo'&nbsp;';}?></td>	
	<script>
		OBJ['en_name']="<?=$en_name?>";
		OBJ['ar_name']="<?=$ar_name?>";
		OBJ['link']="<?=$link?>";
	data[<?=$id?>]=OBJ;</script><?
	
	?><td width='25' align="<?=_Xalign?>"><? 
	if($r!=0){
		$idd=mysql_result($res,$r,'id');
		$ids=mysql_result($res,$r-1,'id');
		$o=mysql_result($res,$r,'ord');
		$os=mysql_result($res,$r-1,'ord');
		$all_prt='&o1='.$idd.'&o2='.$ids.'&o3='.$o.'&o4='.$os.'&p_id='.$p_id;?>    	
		<a href="<?=$_SERVER['PHP_SELF'].'?m='.$m.'&n='.$n?>&opr=ord<?=$all_prt?>">
		<img src="images/up.png" border="0" alt="<?=_up?>" title="<?=_up?>" /></a><? 
	}else{echo "&nbsp;";}?></td><td width="25"><?
	if($r<$rows-1){
		$id=mysql_result($res,$r,'id');
		$ids=mysql_result($res,$r+1,'id');
		$o=mysql_result($res,$r,'ord');
		$os=mysql_result($res,$r+1,'ord');
		$all_prt='&o1='.$id.'&o2='.$ids.'&o3='.$o.'&o4='.$os.'&p_id='.$p_id;?>    	
		<a href="<?=$_SERVER['PHP_SELF'].'?m='.$m.'&n='.$n?>&opr=ord<?=$all_prt?>">
		<img src="images/down.png" border="0" alt="<?=_down?>" title="<?=_down?>" /></a><?
	}else{echo "&nbsp;";} ?></td><td width="25">
    <img src='images/edit.png' title="<?=_edit?>"  class="hand" onclick="edit_rec(<?=$id?>)" />
    </td><td width="30">
	<img src='images/delete.png' title="<?=_delete?>" class="hand" onclick="delete_rec(<?=$id?>)" />

    </td></tr><?
	$r++;
}
/// Table footer -----------------------?>
<? if($total_opr==1){$colDown=$showing_c+3;}else{$colDown=$showing_c+2;}?>
<tr class="list">
  <td colspan="9">

<img src="images/sel.png" width="20" height="20" />
<img src='images/delete.png' title="<?=_delete_selected?>" class="hand" onclick="delete_sel(<?=$rows?>)" />
</td></tr>
</table>
</form>

<? }?>

<!-------------------------------------------------------------------------------->
<div id="add" style="display:none" >
<form  name="addForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="add" />
<input type="hidden" name="p_id" value="<?=$p_id?>" /> 
<table  border="0" cellspacing="0" cellpadding="3">
<tr><tr><td  class="list_n"><?=_en_name?> :</td><td><input type="text" name="en_name" class="text_f"/></td></tr>
<tr><tr><td  class="list_n"><?=_ar_name?> :</td><td><input type="text" name="ar_name" class="text_f"/></td></tr>
<tr><tr><td  class="list_n"><?=_link?> :</td><td><?=get_menu_links($lg,$val,0)?></td></tr>
</table>
</form>
</div>
<div id="edit" style="display:none" >
<form  name="editForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="edit" />
<input type="hidden" name="p_id" value="<?=$p_id?>" />
<input type="hidden" name="edit_id" id="edit_id" value="" />
<table  border="0" cellspacing="0" cellpadding="3"><tr>
<tr><tr><td  class="list_n" ><?=_en_name?> :</td><td><input type="text" name="en_name" id="e_en_name" class="text_f"/></td></tr>
<tr><tr><td  class="list_n" ><?=_ar_name?> :</td><td><input type="text" name="ar_name" id="e_ar_name" class="text_f"/></td></tr>
<tr><tr><td  class="list_n"><?=_link?> :</td><td><?=get_menu_links($lg,$val,1)?></td></tr>

</table>
</form>
</div>
<div id="dele" style="display:none" ><?=_del_rec?>
<form  name="delForm" action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="hidden" name="opr" value="delete" />
<input type="hidden" name="p_id" value="<?=$p_id?>" />
<input type="hidden" name="del_id" id="del_id" value="" />
</form>
</div>
<div id="deleFile" style="display:none" ><?=_del_opr?>
<form  name="delFileForm" action="<?=$_SERVER['PHP_SELF']?>" method="post">
<input type="hidden" name="opr" value="delete_file" />
<input type="hidden" name="p_id" value="<?=$p_id?>" />
<input type="hidden" name="deleFile_id" id="deleFile_id" value="" />
<input type="hidden" name="deleFile_name" id="deleFile_name" value="" />
<input type="hidden" name="deleFile_file" id="deleFile_file" value="" />
</form>
</div>
<div id="deleSel" style="display:none" ><?=_del_sel_rec?></div>
<?
include("inc/footer.php")?>
