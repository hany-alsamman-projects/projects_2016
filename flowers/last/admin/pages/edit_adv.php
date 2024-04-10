<script type="text/javascript" src="uploader.js" ></script>

<?php

$RESULT = mysql_query("SELECT * FROM `ads_banner` WHERE `id` = '{$_GET['id']}' LIMIT 1") or die('error');				

	if($editadv = mysql_fetch_object($RESULT)){
		
?>

		<div align="center">
		<? if($update_status == 1) 
		echo 'Êã ÇáÊÚÏíá Úáì ÇáÇÚáÇä ÈäÌÇÍ';
		 
		?>
		</div>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="70%">

		<table cellpadding="5" cellspacing="0" style="width: 100%">
			<tr>
				<td style="height: 27px">ÑİÚ ÇÚáÇä</td>
			</tr>
			<tr>
				<td style="height: 27px">
		<?php
			$uploadDirectory = "images/admin/banner";
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
		<td height="33" align="center" colspan="2">ÊÚÏíá ÇÚáÇä</td>
	</tr>
	<tr>
		<td width="50%">ÇÓã ÇáÇÚáÇä</td>
		<td width="50%"><input name="banner_name" value="<? print $editadv->banner_name ?>" type="text" maxlength="200"></td>
	</tr>
	<tr>
		<td width="50%">ÑÇÈØ ÇáÇÚáÇä</td>
		<td width="50%"><input name="banner_url" value="<? print $editadv->banner_url ?>" type="text" maxlength="200"></td>
	</tr>
	<tr>
		<td width="49%">ÕæÑå ÇáÇÚáÇä</td>
		<td width="49%"><input id="picture" name="banner_link" value="<? print $editadv->banner_link ?>" type="text" maxlength="200" size="20"><a target="_blank" href="../admin/deletefile.php?filename=../tumble/<?=$editadv->banner_link?>">ÍĞİ ÇáÕæÑÉ ÇáÍÇáíÉ</a></td>
	</tr>
	
	<tr>
		<td width="49%">ÊÇÑíÎ ÇáÈÏÁ</td>
		<td width="49%">
		<input name="banner_start" type="text" size="20" value="<?=date("n-j-Y-G-i",$editadv->banner_start)?>" style="direction: ltr">
		<br>
		<span style="text-align:right"><strong>MM-DD-YY HH-MI</strong></span>
		</td>
	</tr>
	<tr>
		<td width="49%">ÊÇÑíÎ ÇáÇäÊåÇÁ</td>
		<td width="49%">
		<input name="banner_end" type="text" size="20"  value="<?=date("n-j-Y-G-i",$editadv->banner_end)?>" style="direction: ltr">
		<br>
		<span style="text-align:right"><strong>MM-DD-YY HH-MI</strong></span>
		</td>
	</tr>

	
	<tr>
		<td width="49%">ãßÇä ÇáÇÚáÇä</td>
		<td width="49%"><select name="banner_position" style="height: 22px">
		
		<?php
		
		    $my_ban = array(1 => 'bottom', 2 => 'left', 3 => 'right', 4 => 'top');
		    
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
		<td width="50%">äæÚ ÇáÇÚáÇä</td>
		<td width="50%">
		<? 
		if ($editadv->banner_type == 'image'){
		echo '<input type="radio" name="banner_type" value="image" checked> ÕæÑÉ<br>';
		}else{
		echo '<input type="radio" name="banner_type" value="image"> ÕæÑÉ<br>';
		}
		
		if($editadv->banner_type == 'flash'){
		echo '<input type="radio" name="banner_type" value="flash" checked> İáÇÔ<br>';
		}else{
		echo '<input type="radio" name="banner_type" value="flash"> İáÇÔ<br>';
		}
		?>
		</td>
	</tr>
	
	<tr>
		<td width="50%">ÍÇáÉ ÇáÇÚáÇä</td>
		<td width="50%">
		
		<? 
		if ($editadv->active == '1'){
		echo '<input type="radio" name="banner_active" value="1" checked> ãİÚá<br>';
		}else{
		echo '<input type="radio" name="banner_active" value="1"> ãİÚá<br>';
		}
				
		if ($editadv->active == '0'){
		echo '<input type="radio" name="banner_active" value="0" checked> ãÚØá<br>';
		}else{
		echo '<input type="radio" name="banner_active" value="0"> ãÚØá<br>';
		}
		?>
		
		</td>
	</tr>
		
	<tr>
		<td width="50%">¿</td>
		<td width="50%"><input type="submit" value=" ÊÚÏíá " /></td>
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