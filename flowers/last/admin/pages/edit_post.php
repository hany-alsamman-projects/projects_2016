		<? 
		
		if($ok){
			echo '<div style="text-align:center"> «·—œ —ﬁ„ ('.$_GET['id'].') ﬁœ  „  ⁄œÌ·Â ! </div>';
			exit();
		}
		
		?>
		
<form name="add" method="post">
<table align="center" width="95%" cellspacing="0" cellpadding="0" >
	<tr>
		<td align="center" colspan="2"><div style="padding-bottom:10px"> ⁄œÌ· «·—œ</div>
</td>
	</tr>
	
	<tr>
		<td style="width: 9%">⁄‰Ê«‰ «·„‘«—ﬂ…:</td>
		<td width="50%">
		<input type="text" value="<?=stripslashes($PostData['title'])?>" name="title" style="width: 400px"></td>
	</tr>
	
	<tr>
		<td style="width: 9%">«”„ «·„‘«—ﬂ:</td>
		<td width="50%">
		<input type="text" value="<?=stripslashes($PostData['author_name'])?>" name="author_name" style="width: 400px"></td>
	</tr>
	
	<tr>
		<td style="width: 9%">»—Ìœ «·„‘«—ﬂ:</td>
		<td width="50%">
		<input id="picture" type="text" value="<?=stripslashes($PostData['author_email'])?>" name="author_email" style="width: 400px"></td>
	</tr>
		
	<tr>
		<td style="width: 9%">Õ«·… «·„Ê«›ﬁ…:</td>
		<td width="50%">
		<?
		if($PostData['approve'] == 1){
		print '<input type="radio" name="approve" value="1" checked="true"> Yes ';
		}else{
		print '<input type="radio" name="approve" value="1"> Yes';	
		}
		
		if($PostData['approve'] == 0){
		print '<input type="radio" name="approve" value="0" checked="true"> no';
		}else{
		print '<input type="radio" name="approve" value="0"> no';	
		}
		?>
		</td>
	</tr>
	
	<tr>
		<td style="width: 9%">«·—œ Ì »⁄:</td>
		<td width="50%">
		<select size="1" name="in_topic">
		<?
			$result = mysql_query("SELECT tid,t_title FROM `topics`");
			
				while($row = mysql_fetch_object($result)){
					if($row->tid == $PostData['in_topic']){
					echo "<option value=\"$row->tid\" selected>".parent::truncate(strip_tags($row->t_title),50)."</option>";
					}else{
					echo "<option value=\"$row->tid\">".parent::truncate(strip_tags($row->t_title),50)."</option>";
					}
					
				}
		?>	
		</select>
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2">
		<div style=" padding-top:20px; padding-bottom:20px">„Õ ÊÏ «·—œ:</div>
			<?php
			
			include('./fckeditor.php');
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
			
			$oFCKeditor = new FCKeditor('post') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Height	    = 500 ;
			$oFCKeditor->Value		= htmlspecialchars_decode( stripslashes($PostData['post']) );
			$oFCKeditor->Create() ;
			?>
		
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="submit" value="  ⁄œÌ· " name="submit"></td>
	</tr>
	<input type="hidden" value="<?=time()?>" name="edit_time">
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>