		<? 
		
		if($ok){
			echo '<div style="text-align:center"> The Topic Has Been Inserted ! </div>';
			exit();
		}
		
		?>
	
	<a href="javascript:collapseinfo.slideit()" target="_self"><img align="absbottom" src="../images/admin/review.png"> ÑİÚ ÕæÑÉ ÇáãæÖæÚ</a>
	<br />
		
    <div id="info">
    <br />
    <?
	$uploadDirectory = SITE_PATH."/files/images/tumble";
	require_once("AjaxFileUploader.inc.php");
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
	echo $ajaxFileUploader->showFileUploader('pictures');
	?>    
    </div>
	<script type="text/javascript">
	var collapseinfo=new animatedcollapse("info", 500, true, "block")
	</script>
	<br />

<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="471">
	<tr>
		<td align="center" colspan="2" style="height: 45px">ÇÖÇİÉ ãæÖæÚ</td>
	</tr>
	<tr>
		<td style="width: 12%">ÚäæÇä ÇáãæÖæÚ:</td>
		<td width="50%"><input style="width: 250px;" type="text" name="t_title"></td>
	</tr>
	<tr>
		<td style="width: 12%">ÕæÑÉ ÇáãæÖæÚ:</td>
		<td width="50%"><input style="width: 250px;" type="text" id="t_pic" name="t_pic"></td>
	</tr>
	
	<tr>
		<td style="width: 12%">ÇÊÇÍÉ ÇáÑÏ:</td>
		<td width="50%">
		<input type="radio" name="replay" value="1" checked="true"> äÚã
		<input type="radio" name="replay" value="0"> áÇ
		</td>
	</tr>
	
	<tr>
		<td style="width: 12%">ÇáŞÓã:</td>
		<td width="50%">
		<select size="1" name="in_dept">
		<?
			$result = mysql_query("SELECT id,d_name FROM `departments` WHERE `d_parent` != '0' and `d_active` = '1' ORDER BY id");
			
				while($row = mysql_fetch_object($result)){
					echo "<option value=\"$row->id\">$row->d_name</option>";
				}
		?>	
		</select>
		</td>
	</tr>
	
	<tr>
		<td style="width: 12%">ãÎáÕ ÇáãæÖæÚ:</td>
		<td width="50%"><input style="width: 250px;" type="text" name="t_short" /></td>
	</tr>
	
	<tr>
		<td style="width: 12%">ÊæŞíÊ ÇáäÔÑ:</td>
		<td width="50%">
	    <select size="1" name="publish_date">
		<?php
				 
		 for ($i = 1; $i <= count($this->PublishDates); $i++) {
		 	echo '<option value="'.$this->PublishDates[$i].'">'.parent::get_date_ex($this->PublishDates[$i]).'</option>';
		 }
		 
		 ?>			
		</select>
		</td>
	</tr>
	
	<tr>
		<td width="100%" colspan="2">ãÍÊæì ÇáãæÖæÚ:<p>

			<?php
			
			include('./fckeditor.php');
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
			
			$oFCKeditor = new FCKeditor('t_content') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Height	    = 500 ;
			$oFCKeditor->Value		= '<p style="margin: 0px">text here</p>';
			$oFCKeditor->Create() ;
			?>
		
		</td>
	</tr>

	<tr>
		<td colspan="2" align="center">
		
		<?php
		if( session_is_registered('admin') ){
		echo '<input type="hidden" value="1" name="approve">';
		}
		?>
		
		<input type="hidden" value="<?=time()?>" name="start_date" />
		<input type="hidden" value="<?=time()?>" name="last_update" />
		<input type="hidden" value="<?=$_SESSION['user_id']?>" name="t_add_by" />
		<input type="submit" value=" ÇÖÇİÉ " name="submit" /></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1" />
</table>
</form>