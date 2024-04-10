<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Edit Post</b></div>
</div>
		<? 
		
		if($ok){
			echo '<div style="text-align:center"> The POST ID ('.$_GET['id'].') Has Been Updated ! </div>';
			exit();
		}
		
		?>
		
<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="471">
	<tr>
		<td align="center" colspan="2">Edit Post</td>
	</tr>
	
	<tr>
		<td width="50%">Post title:</td>
		<td width="50%"><input type="text" value="<?=stripslashes($PostData['title'])?>" name="title"></td>
	</tr>
	
	<tr>
		<td width="50%">Author Name:</td>
		<td width="50%"><input type="text" value="<?=stripslashes($PostData['author_name'])?>" name="author_name"></td>
	</tr>
	
	<tr>
		<td width="50%">Author Email:</td>
		<td width="50%"><input id="picture" type="text" value="<?=stripslashes($PostData['author_email'])?>" name="author_email"></td>
	</tr>
		
	<tr>
		<td width="50%">Approve Status:</td>
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
		<td width="50%">Post Following:</td>
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
		<td width="100%" colspan="2">Post Content<p>

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
		<td colspan="2" align="center"><input type="submit" value=" EDIT " name="submit"></td>
	</tr>
	<input type="hidden" value="<?=time()?>" name="edit_time">
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>