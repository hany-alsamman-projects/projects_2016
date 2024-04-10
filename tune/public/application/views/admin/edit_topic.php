<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Edit Topic</b></div>
</div>

		<? 
		
		if($ok){
			echo '<div style="text-align:center"> The Topic ID ('.$_GET['id'].') Has Been Updated ! </div>';
			exit();
		}
		
		?>
		
	<a href="javascript:collapseinfo.slideit()" target="_self"><img align="absbottom" src="../images/admin/asterisk_orange.png"> Upload Topic Picture</a>
	<br />
		
    <div id="info">
    <br />
    <?
	$uploadDirectory = SITE_PATH."/files/images/tumble";
	require_once("AjaxFileUploader.inc.php");
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
	echo $ajaxFileUploader->showFileUploader('picture');
	?>    
    </div>
	<script type="text/javascript">
	var collapseinfo=new animatedcollapse("info", 500, true, "block")
	</script>
	<br />

<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="471">
	<tr>
		<td align="center" colspan="2">Edit Topic</td>
	</tr>
	
	<tr>
		<td width="50%">Topic title:</td>
		<td width="50%">
		
		<textarea name="t_title" cols="50" rows="1" style="height: 40px" ><?=stripslashes($TopicData['t_title'])?></textarea></td>
	</tr>
	
	<tr>
		<td width="50%">Topic Sub Title:</td>
		<td width="50%"><textarea name="t_sub" cols="50" style="height: 40px" ><?=stripslashes($TopicData['t_sub'])?></textarea></td>
	</tr>	
	
	<tr>
		<td width="50%">Topic picture:</td>
		<td width="50%"><input id="t_pic" type="text" value="<?=$TopicData['t_pic']?>" name="t_pic"></td>
	</tr>
		
	<tr>
		<td width="50%">Guest replay ?</td>
		<td width="50%">
		<?
		if($TopicData['replay'] == 1){
		print '<input type="radio" name="replay" value="1" checked="true"> Yes ';
		}else{
		print '<input type="radio" name="replay" value="1"> Yes';	
		}
		
		if($TopicData['replay'] == 0){
		print '<input type="radio" name="replay" value="0" checked="true"> no';
		}else{
		print '<input type="radio" name="replay" value="0"> no';	
		}
		?>
		</td>
	</tr>
	
	<tr>
		<td width="50%">Topic short:</td>
		<td width="50%"> <textarea name="t_short" cols="50" rows="4" ><?=stripslashes($TopicData['t_short'])?></textarea></td>
	</tr>
		
	<tr>
		<td width="50%">Topic department:</td>
		<td width="50%">
		<select size="1" name="in_dept">
		<?
			$result = mysql_query("SELECT id,d_name FROM `departments` WHERE `d_parent` != '0' and `d_active` = '1' ORDER BY id");
			
				while($row = mysql_fetch_object($result)){
					if($row->id == $TopicData['in_dept']){
					echo "<option value=\"$row->id\" selected>$row->d_name</option>";
					}else{
					echo "<option value=\"$row->id\">$row->d_name</option>";
					}
					
				}
		?>	
		</select>
		</td>
	</tr>
	<tr>
		<td width="50%">Topic Publish:</td>
		<td width="50%">
	    <select size="1" name="publish_date">
		<?php
				 
		 for ($i = 1; $i <= count($this->PublishDates); $i++) {
		 	echo '<option value="'.$this->PublishDates[$i].'">'.parent::get_date_ex($this->PublishDates[$i]).'</option>';
		 }
		 
		 ?>
		</select>
		::
		<b>
		<?php
		echo date("j, m, Y, g:i a", $TopicData['publish_date']);
		?>
		</b>
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2">Topic Content<p>

			<?php
			
			include('./fckeditor.php');
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
			
			$oFCKeditor = new FCKeditor('t_content') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Height	    = 350 ;
			$oFCKeditor->Value		= htmlspecialchars_decode ( stripslashes($TopicData['t_content']) );
			$oFCKeditor->Create() ;
			?>
		
		</td>
	</tr>
	
	<tr>
		<td colspan="2" align="center"><input type="submit" value=" EDIT " name="submit"></td>
	</tr>
	<input type="hidden" value="<?=time()?>" name="last_update">
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>