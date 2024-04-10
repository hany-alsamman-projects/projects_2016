
<a href="?opr=ord&Reset=1" style="color: black;">Reset all items orders? click here</a>

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
$width=650;
$showing_c=0;
for($c=0;$c<count($list_show);$c++){
	if($list_show[$c]){
		$showing_c++;
	}
}
$width_c=$width/$showing_c;

//oprations-----------------------------------

/**
 *  Order sorting added by hany
 *  up && down
 */
if($_REQUEST['opr']=="ord"){
    
        if( isset($_GET['Reset']) && $_GET['Reset'] == '1'){
            
            echo 'Reset Done !';
            
            $result = mysql_query("SELECT * FROM `items`");
            
			
            $i = 1;
            while ($row = mysql_fetch_array($result)) {
                
                mysql_query("UPDATE `items` SET `ord` = '$i' WHERE id=$row[id]");
                $i++;
            } 
			
        }
               
    
        if( isset($_GET['Move_Up']) && $_GET['Move_Up'] == '1'){
            
            echo 'Moved up !';
            
         	$id = $_GET['id'];
        
        	$select = mysql_query("SELECT * FROM `items` WHERE id='{$id}'");
        	
        	$class = mysql_fetch_array($select);
        
        	$this_level = $class['ord'];
        
        			$l = mysql_query("SELECT id,ord FROM `items` WHERE ord < $this_level ORDER BY ord DESC LIMIT 1");
        			
        			if(mysql_num_rows($l) > 0){  
            			$level = mysql_fetch_array($l);
            
            			mysql_query("UPDATE `items` SET `ord` = '$level[ord]' WHERE id=$id LIMIT 1");
            			mysql_query("UPDATE `items` SET `ord` = '$this_level' WHERE id=$level[id] LIMIT 1");
        			}  
        }// end move up
        
        if( isset($_GET['Move_Down']) && $_GET['Move_Down'] == '1'){
            
            echo 'Moved down !';
            
         	$id = $_GET['id'];
        
        	$select = mysql_query("SELECT * FROM `items` WHERE id='{$id}'");
        	
        	$class = mysql_fetch_array($select);
        
        	$this_level = $class['ord'];
        
        			$l = mysql_query("SELECT id,ord FROM `items` WHERE ord > $this_level ORDER BY ord ASC LIMIT 1");
        			
        			if(mysql_num_rows($l) > 0){  
            			$level = mysql_fetch_array($l);
            
            			mysql_query("UPDATE `items` SET `ord` = '$level[ord]' WHERE id=$id LIMIT 1");
            			mysql_query("UPDATE `items` SET `ord` = '$this_level' WHERE id=$level[id] LIMIT 1");
        			}  
        }// end move up
    
}
// emd added by hany

if(isset($_POST['opr'])){
	$xadd=0;
	//add-------------------------------------
	if($_POST['opr']=="add"){
		$cols="";
		$vals="";
		for($i=0;$i<$count_c;$i++){
			if($list_type[$i]=='m_id'){
				$cols.="`".$list_arr[$i]."`";
				$v=$list_par[$i];
				$vals.="'".$v."'";
			}else if($list_type[$i]!='sun' && $list_type[$i]!='fun'){
				$cols.="`".$list_arr[$i]."`";
				if($list_type[$i]!='static' ){			
					$v=post_val($list_type[$i],$list_arr[$i],'add');
					$vals.="'".$v."'";
				}else{
					$v=$_REQUEST['id'];
					$vals.="'".$v."'";
				}				
			}
			//echo"(".$v.")";			
			if($v=="xXx"){
				$xadd=1;
			}
							
			if($i<$count_c-1 && $list_type[$i+1]!='sun' && $list_type[$i+1]!='fun'){
				$cols.=",";
				$vals.=",";
			}
		
		}
		//echo "(".$cols.")<br>(".$vals.")";
		if($xadd!=1){
			$sql="INSERT INTO `$table`($cols)values($vals)";
			$res2=mysql_query($sql);
			if($res2){
				echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?y=&p='.$_REQUEST['p'].$parameter.'"</script>';
			}
		}else{
			echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
		}
	}
	//edit-----------------------------------
	if($_POST['opr']=="edit"){
		$edit_id=$_POST['edit_id'];
		for($i=0;$i<$count_c;$i++){
			if($list_type[$i]!='sun' && $list_type[$i]!='m_id' && $list_type[$i]!='fun'){
				if($list_type[$i]!='static'){
					$cols.="`".$list_arr[$i]."`";			
					$v=post_val($list_type[$i],$list_arr[$i],'edit');
					if($v=="xXx"){
						echo $xadd=1;
					}			
					//echo "(".$v.")|";
					$vals.="`".$list_arr[$i]."`='".$v."'";
					if($i<$count_c-1 && $list_type[$i+1]!='sun' && $list_type[$i+1]!='fun'){
						$cols.=",";
						$vals.=",";
					}
				}
			}
		}
		//echo "(".$vals.")";
		if($xadd!=1){
			$sql="UPDATE `$table` SET $vals where id='$edit_id'";
			$res2=mysql_query($sql);
			if($res2){
				echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?y=&p='.$_REQUEST['p'].$parameter.'"</script>';
			}
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
		///----files---------------
		if($del_file>0){
			$sql="select * from $table  where id='$del_id' limit 1  ";
			$res=mysql_query($sql);
			$rows=mysql_num_rows($res);
		}
		for($f=0;$f<count($del_files_name);$f++){
			$file=mysql_result($res,0,$del_files_name[$f]);
			@unlink("../uploads/".$file);
		}

		$sql="DELETE from `$table`  where id='$del_id' limit 1";
		$res2=mysql_query($sql);
		if($res2){
			echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?y=&p='.$_REQUEST['p'].$parameter.'"</script>';
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
					
				$del_file=0;
				$del_files_name=array();
				for($d=0;$d<$count_c;$d++){
					if($list_type[$d]=="photo" || $list_type[$d]=="file"){
						$del_file=1;
						array_push($del_files_name,$list_arr[$d]);
					}
				}
				///----files---------------
				if($del_file>0){
					$sql="select * from $table  where id='$del_id' limit 1  ";
					$res=mysql_query($sql);
					$rows=mysql_num_rows($res);
				}
				for($f=0;$f<count($del_files_name);$f++){
					$file=mysql_result($res,0,$del_files_name[$f]);
					@unlink("../uploads/".$file);
				}
				//--------------------
		
				$sql="DELETE from `$table`  where id='$del_id' limit 1";
				$res2=mysql_query($sql);
			}
		}
		echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?y=&p='.$_REQUEST['p'].$parameter.'"</script>';
	}
	//delete files-----------------------------------
	if($_POST['opr']=="delete_file"){
		$deleFile_id=$_POST['deleFile_id'];
		$deleFile_name=$_POST['deleFile_name'];
		$deleFile_file=$_POST['deleFile_file'];

		$sql="UPDATE `$table` set $deleFile_name='' where id='$deleFile_id' limit 1";
		$res2=mysql_query($sql);
		if($res2){
			@unlink("../uploads/".$deleFile_file);
		echo '<script>document.location="'.$_SERVER['PHP_SELF'].'?y=&p='.$_REQUEST['p'].$parameter.'"</script>';
		}else{
			echo '<script>// document.location="'.$_SERVER['PHP_SELF'].'?x"</script>';
		}
	}
}

//pagging------------------
$sql="select count(*) c from $table $condtion ";
$res=mysql_query($sql);
$all_rows=mysql_result($res,0,'c');
$p=0;
if(isset($_REQUEST['p'])){
	$p=$_REQUEST['p'];
}
if($all_rows%$rpp==0){
	$pn=$all_rows/$rpp;
}else{
	$pn=intval(($all_rows/$rpp))+1;
}
if($p >= $pn && $p!=0){
	$p=($pn-1);
}
if(!is_numeric ($p) || $p<0){
	$p=0;
}

$pagging=pagging($all_rows,$rpp,$p);
$start=$p*$rpp; 
$end=$rpp; 
$limit=" limit ".$start.",".$end;
//-----------------------------------------------
$sql="select * from $table $condtion order by $order $order_dir $limit ";
$res=mysql_query($sql);
$rows=mysql_num_rows($res);
?>
<table width="739" border="0" cellspacing="0" cellpadding="4">
  <tr>  
    <td width="604"><div class="titles"><?=$title?> ( <?=$all_rows?> )</div></td>
    <? if($add_opr==1){?>
    <td width="20"><img src="images/add.png" width="20" height="20" align="right" class="hand" onclick="$(add).dialog('open')" /></td>
    <td width="91"><span class="hand" onclick="$(add).dialog('open')"><?=_add?></span></a></td>
    <? }?>
       <? if($add_opr==2){?>
    <td width="20"><img src="images/add.png" width="20" height="20" align="right" class="hand" onclick="document.location='<?=$add_path?>'" /></td>
    <td width="91"><span class="hand" onclick="$(add).dialog('open')"><?=_add?></span></a></td>
    <? }?>
  </tr>
</table>
<?
if($rows>0){?>
<script>var data =new Array();</script>
<form name="deleSelForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post">
<table border="0" cellspacing="0" cellpadding="3" >
<tr class="list" >

<td><? if($delete_opr){?>

<input type="hidden"  name="rows" value="<?=$rows?>" />
<input type="hidden"  name="opr" value="delSel" />
<input name="check_all" type="checkbox" value="" id="check_all" onclick="chekAll(<?=$rows?>)" /><? }?></td>
    <? if($total_opr==1){
	 ?><td><?=$total_par[0]?></td><? 
	 }


/// Table header -----------------------
for ($i=0;$i<$count_c;$i++){
	if($list_show[$i]){
		echo "<td>".$list_names[$i]."</td>";
	}
}
echo "<td>&nbsp;</td>";
     if($order_opr==1){
		echo "<td>&nbsp;</td><td>&nbsp;</td>";
	}
?>

</tr>
<?
/// Table rows -----------------------
$r=0;
while($rows>$r){
	$rec_id=mysql_result($res,$r,'id');
	$total_par22= mysql_result($res,$r,$total_par[3]);
	?>
    <script>var OBJ=new Object ();</script>
    <tr class="list_n">
	<td><? if($delete_opr){?><input name="rec<?=$r?>" type="checkbox" value="<?=$rec_id?>" id="rec<?=$r?>" 
    onclick="check_empty(<?=$rows?>)" /><? }
	if($total_opr==1){?><td><?=getTotal($total_par[1],$total_par[2],$total_par22)?></td><? }?>
    <? if($showID==1){echo $rec_id;}
	for ($i=0;$i<$count_c;$i++){
		$vall=@mysql_result($res,$r,$list_arr[$i]);
		if($list_show[$i]){
			echo "<td width='".$width_c."'>".view_list_type($list_type[$i],$vall,$list_par[$i],$lis_arr[$i],$rec_id)."</td>";		
		}
		if($list_type[$i]=="date"){
			$vall=convertData($vall,0);
		}
		if($list_type[$i]=='textarea'){
			$vall=textareaC($vall);
		}	
		if($add_opr!=2){
		?><script><? echo'OBJ["'.$list_arr[$i].'"]="'.$vall.'"';?></script><?	
		}
	}
	?><script>data[<?=$rec_id?>]=OBJ;</script><td width='70'>
    <? if($edit_opr==1){?><img src='images/edit.png' title="<?=_edit?>"  class="hand" onclick="edit_rec(<?=$rec_id?>)" /><? }?>
     <? if($edit_opr==2){?><img src='images/edit.png' title="<?=_edit?>"  class="hand" 
     onclick="document.location='<?=$edit_path?>?id=<?=$rec_id?><?=$edit_path_par?>'" /><? }?>
	<? if($delete_opr){?><img src='images/delete.png' title="" class="hand" onclick="delete_rec(<?=$rec_id?>)" /><? }?>
    <? if($view_opr==1){?><img src='images/view.png' title="" class="hand" onclick="view_rec(<?=$rec_id?>,'<?=$view_link?>')" /><? }?>
    <? if($view_opr==2){?><a href="<?=$view_link?>?id=<?=$rec_id?>"><img src='images/view.png' class="hand" border="0" /></a><? }?>  &nbsp;
    </td>
    	<? if($order_opr==1){?>
        <td width='25' align="<?=_Xalign?>"><? 
       if($r>0 && $r<$rows){
            $idd=mysql_result($res,$r,'id');
            $ids=mysql_result($res,($r-1),'id');
            $o=mysql_result($res,$r,$order_fild);
            $os=mysql_result($res,($r-1),$order_fild);
            
            $all_prt='&Move_Up=1&id='.$idd?>    	
            <a href="<?=$_SERVER['PHP_SELF'].'?opr=ord'.$all_prt?>">
            <img src="images/up.png" border="0" alt="<?=_up?>" title="<?=_up?>" /></a><? 
        }else{echo "&nbsp;";}?></td>
        <td width="25"><?
        if($r<$rows-1){
          /// echo "(".$r."|".$rows.")";
            $id2=mysql_result($res,$r,'id');
            $ids2=mysql_result($res,($r+(1)),'id');
            $o2=mysql_result($res,$r,$order_fild);
            $os2=mysql_result($res,($r+(1)),$order_fild);
            
            $all_prt='&Move_Down=1&id='.$id2;?>    	
           <a href="<?=$_SERVER['PHP_SELF'].'?opr=ord'.$all_prt?>">
            <img src="images/down.png" border="0" alt="<?=_down?>" title="<?=_down?>" /></a><?
        }else{echo "&nbsp;";} ?></td> 
    <?
	
	}?>   </tr><?
	
	$r++;
}
/// Table footer -----------------------?>
<? if($total_opr==1){$colDown=$showing_c+3;}else{$colDown=$showing_c+2;}?>
<? if($order_opr==1){$colDown=$colDown+2;}?>
<tr class="list">
  <td colspan="<?=$colDown?>">
<? if($delete_opr){?>
<img src="images/sel.png" width="20" height="20" />
<img src='images/delete.png' title="<?=_delete_selected?>" class="hand" onclick="delete_sel(<?=$rows?>)" /><? }?>
</td></tr>
</table>
</form>
<?=$pagging?>
<? }?>

<!-------------------------------------------------------------------------------->
<div id="add" style="display:none" >
<form  name="addForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="add" />
<table  border="0" cellspacing="0" cellpadding="3"><tr>
<? 
for ($i=0;$i<$count_c;$i++){
	if($list_type[$i]!='sun'){
		if($list_type[$i]!='static' && $list_type[$i]!='m_id' ){?>
			<tr><td  class="list_n"><?=$list_names[$i]?> :</td>
			<td ><?=get_form_type($list_type[$i],$list_arr[$i],$list_par[$i])?></td></tr><?
		}else{
			?><input type="hidden" name="id" value="<?=$_REQUEST['id']?>" /><?
		}
	}
}
?>
</table>
</form>
</div>
<!-------------------------------------------------------------------------------->
<div id="edit" style="display:none" >
<form  name="editForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post" enctype="multipart/form-data">
<input type="hidden" name="opr" value="edit" />
<input type="hidden" name="edit_id" id="edit_id" value="" />
<table  border="0" cellspacing="0" cellpadding="3"><tr>
<? 
for ($i=0;$i<$count_c;$i++){
	if($list_type[$i]!='sun'){
		if($list_type[$i]!='static' && $list_type[$i]!='m_id' ){?>
			<tr><td nowrap="nowrap"  class="list_n" ><?=$list_names[$i]?> :</td>
		  <td ><?=get_form_edit($list_type[$i],$list_arr[$i],$list_par[$i])?></td></tr><?
		}else{
			?><input type="hidden" name="id" value="<?=$_REQUEST['id']?>" /><?
		}
	}
}
?>
</table>
</form>
</div>
<!-------------------------------------------------------------------------------->
<div id="dele" style="display:none" ><?=_del_rec?>
<form  name="delForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post">
<input type="hidden" name="opr" value="delete" />
<input type="hidden" name="del_id" id="del_id" value="" />
</form>
</div>
<!-------------------------------------------------------------------------------->
<div id="deleFile" style="display:none" ><?=_del_opr?>
<form  name="delFileForm" action="<?=$_SERVER['PHP_SELF']?>?p=<?=$p?><?=$parameter?>" method="post">
<input type="hidden" name="opr" value="delete_file" />
<input type="hidden" name="deleFile_id" id="deleFile_id" value="" />
<input type="hidden" name="deleFile_name" id="deleFile_name" value="" />
<input type="hidden" name="deleFile_file" id="deleFile_file" value="" />
</form>
</div>
<!-------------------------------------------------------------------------------->
<div id="deleSel" style="display:none" ><?=_del_sel_rec?></div>
<div id="view_win" style="display:none" ></div>