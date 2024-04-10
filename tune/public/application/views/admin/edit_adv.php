<script type="text/javascript" src="uploader.js" ></script>

<?php

$RESULT = mysql_query("SELECT * FROM `ads_banner` WHERE `id` = '{$_GET['id']}' LIMIT 1") or die('error');				

	if($editadv = mysql_fetch_object($RESULT)){
		
?>

		<div align="center">
		<? if($update_status == 1) 
		echo 'the banner effect change';
		 
		?>
		</div>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="70%">

		<table cellpadding="5" cellspacing="0" style="width: 100%">
			<tr>
				<td style="height: 27px">Upload File</td>
			</tr>
			<tr>
				<td style="height: 27px">
		<?php
			$uploadDirectory = "../images/admin/banner";
			require_once("AjaxFileUploader.inc.php");
			$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
			echo $ajaxFileUploader->showFileUploader('pictures');
		?>
				</td>
			</tr>
		</table>

		</td>
	</tr>
	
	<tr>
		<td valign="top" width="70%">

<form method="POST" >
<table height="220" cellpadding="5" cellspacing="0" style="width: 100%">
	<tr>
		<td height="33" align="center" colspan="2">&nbsp;Edit Banner</td>
	</tr>
	<tr>
		<td width="50%">Banner Name</td>
		<td width="50%"><input name="banner_name" value="<? print $editadv->banner_name ?>" type="text" maxlength="200"></td>
	</tr>
	<tr>
		<td width="50%">Banner Url</td>
		<td width="50%"><input name="banner_url" value="<? print $editadv->banner_url ?>" type="text" maxlength="200"></td>
	</tr>
	<tr>
		<td width="49%">Banner Link</td>
		<td width="49%"><input id="picture" name="banner_link" value="<? print $editadv->banner_link ?>" type="text" maxlength="200" size="20"></td>
	</tr>
	<tr>
		<td width="49%">Banner Position</td>
		<td width="49%"><select name="banner_position" style="height: 22px">
		
		<?php
		
		    $my_ban = array(1 => 'bottom', 2 => 'left', 3 => 'right', 4 => 'top', 5 => 'p_top', 6 => 'p_bottom');
		    
			foreach($my_ban as $val){
			
			$get_ban = mysql_result( mysql_query("SELECT banner_position FROM `ads_banner` WHERE `id` = '{$_GET['id']}'") ,0);
			
				if($get_ban == $val){
				echo '<option selected="true" value="'.$val.'">'.$val.'</option>';
				}else{
				echo '<option value="'.$val.'">'.$val.'</option>';
				}
				
			}
		?>
		
		</select>
		</td>
	</tr>	
	<tr>
		<td width="50%">Banner Type</td>
		<td width="50%">
		<? 
		if ($editadv->banner_type == 'image'){
		echo '<input type="radio" name="banner_type" value="image" checked> IMAGE <br>';
		}else{
		echo '<input type="radio" name="banner_type" value="image"> IMAGE <br>';
		}
		
		if($editadv->banner_type == 'flash'){
		echo '<input type="radio" name="banner_type" value="flash" checked> FLASH <br>';
		}else{
		echo '<input type="radio" name="banner_type" value="flash"> FLASH <br>';
		}
		?>
		</td>
	</tr>
	
	<tr>
		<td width="50%">Banner Active</td>
		<td width="50%">
		
		<? 
		if ($editadv->active == '1'){
		echo '<input type="radio" name="banner_active" value="1" checked> True <br>';
		}else{
		echo '<input type="radio" name="banner_active" value="1"> True <br>';
		}
				
		if ($editadv->active == '0'){
		echo '<input type="radio" name="banner_active" value="0" checked> False <br>';
		}else{
		echo '<input type="radio" name="banner_active" value="0"> False <br>';
		}
		?>
		
		</td>
	</tr>
		
	<tr>
		<td width="50%">Edit</td>
		<td width="50%"><input type="submit" value=" CHANGE " /></td>
	</tr>
	</table>
	<input type="hidden" name="sub_ok" value="1" />
</form>

		</td>
	</tr>
	
	</table>

<?
	}
?>