<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Add Blog</b></div>
</div>

<? print $ok ?>
<form name="add" method="post">
<table align="center" border="1" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">Add Blog</td>
	</tr>
	<tr>
		<td width="50%" height="38">Blog name:</td>
		<td width="50%" height="38"><input type="text" name="d_name"></td>
	</tr>
	<tr>
		<td width="50%" height="41">Blog type:</td>
		<td width="49%" height="41">
<select size="1" name="d_type">
	<option value="cat">Category</option>  <!-- قسم رئيسي -->
	<!--  <option value="menu">Menu</option> قائمة جديدة -->
</select>
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">Blog status:</td>
		<td width="50%" height="52">
		<input type="radio" name="d_active" value="1" checked>enable 
		<br>
		<input type="radio" name="d_active" value="0" >disable	
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ADD " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>