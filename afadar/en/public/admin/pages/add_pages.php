<? print $ok ?>

<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="471">
	<tr>
		<td align="center" colspan="2">«÷«›… ’›Õ…</td>
	</tr>
	<tr>
		<td width="50%">«”„ «·’›Õ…</td>
		<td width="50%"><input type="text" name="a_name"></td>
	</tr>
	<tr>
		<td width="50%">⁄‰Ê«‰ «·’›Õ…</td>
		<td width="49%"><input type="text" name="a_title"></td>
	</tr>
	<tr>
		<td width="50%">«·ﬁ”„</td>
		<td width="49%">
		<select size="1" name="in_class">
		<option value="1">«·ﬁ«∆„… «·—∆Ì”Ì…</option>
		<option value="0">«·’›Õ« </option>
		</select>
		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2">„Õ ÊÏ «·’›Õ…<p>
			<?php
			
			include('./fckeditor.php');
			
			$sBasePath = $_SERVER['PHP_SELF'] ;
			$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;
			
			$oFCKeditor = new FCKeditor('a_content') ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Height	    = 500 ;
			$oFCKeditor->Value		= '' ;
			$oFCKeditor->Create() ;
			?>

		</td>
	</tr>
	<tr>
		<td colspan="2"><input type="submit" value="≈÷«›…" name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>