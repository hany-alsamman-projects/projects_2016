<? print $ok ?>

<form name="add" method="post">
<table align="center" width="95%" cellspacing="0" cellpadding="0" height="471">
	<tr>
		<td align="center" colspan="2">����� ����</td>
	</tr>
	<tr>
		<td width="50%">��� ������</td>
		<td width="50%"><input type="text" value="<? print $a_name ?>" name="a_name"></td>
	</tr>
	<tr>
		<td width="50%">����� ������</td>
		<td width="49%"><input type="text" value="<? print $a_title ?>" name="a_title"></td>
	</tr>
	<tr>
		<td width="50%">�����</td>
		<td width="49%">
		<select size="1" name="in_class">
		<?
		print $in_class;
		if($in_class == '1'){
		print '<option value="1" selected=true>������� ��������</option><option value="0">�������</option>';
		}else{
		print '<option value="1">������� ��������</option><option value="0" selected=true>�������</option>';
		}
		?>
		</select>
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2">����� ������<p>
				
			<?php
			
			include('./fckeditor.php');
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
			
			$oFCKeditor = new FCKeditor('a_content') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Height	    = 500;
			$oFCKeditor->Value		= stripslashes($a_content);
			$oFCKeditor->Create() ;
			?>
		
		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="�����" name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>