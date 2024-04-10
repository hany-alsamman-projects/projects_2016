<? print $ok ?>
<form name="add" method="post">
<table align="center" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">ÅÖÇÝÉ דÌדזÚÉ</td>
	</tr>
	<tr>
		<td width="50%" height="38">ÅÓד ÇבדÌדזÚÉ:</td>
		<td width="50%" height="38"><input type="text" name="d_name"></td>
	</tr>
	<tr>
		<td width="50%" height="41">הזÚ ÇבדÌדזÚÉ:</td>
		<td width="49%" height="41">
<select size="1" name="d_type">
	<option value="cat">ÃÞÓÇד</option>  <!-- ÞÓד ÑÆםÓם -->
	<!--  <option value="menu">Menu</option> ÞÇÆדÉ ÌÏםÏÉ -->
</select>
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">ÍÇבÉ ÇבדÌדזÚÉ:</td>
		<td width="50%" height="52">
		<input type="radio" name="d_active" value="1" checked>ÙÇוÑ 
		<br>
		<input type="radio" name="d_active" value="0" >דÎÝם	
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ÅÖÇÝÉ " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>