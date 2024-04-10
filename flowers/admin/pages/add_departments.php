<? print $ok ?>

<form name="add" method="post">
<table align="center" style="border-collapse: collapse; border:1px #C0C0C0" border="1" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">≈÷«›… ﬁ”„</td>
	</tr>
	<tr>
		<td width="50%" height="38">«”„ «·ﬁ”„ »«··€… «·≈‰Ã·Ì“Ì… :</td>
		<td width="50%" height="38"><input type="text" name="en_d_name" /></td>
	</tr>
	
	<tr>
		<td width="50%" height="38">«”„ «·ﬁ”„ »«··€… «·⁄—»Ì… :</td>
		<td width="50%" height="38"><input type="text" name="ar_d_name" /></td>
	</tr>

	<tr>
		<td width="50%" height="41">œ«Œ· «·„Ã„Ê⁄… :</td>
		<td width="49%" height="41">

<?
    $result = mysql_query("SELECT id,en_d_name FROM `departments` WHERE `d_type` = 'cat' and `d_parent` = '0' and `d_active` = '1' ORDER BY en_d_name") or die(mysql_error());

    print "<select size='1' name='d_parent''>";
	
	while($row = mysql_fetch_object($result)){
		print "<option value='$row->id'>$row->en_d_name</option>";   
	}
	
	print "</select>";
?>

		</td>
	</tr>
	<tr>
		<td width="50%" height="52">Õ«·… «·ﬁ”„ :</td>
		<td width="50%" height="52">
		<input type="radio" name="d_active" value="1" checked> ›⁄Ì· 
		<br>
		<input type="radio" name="d_active" value="0" >≈Ìﬁ«›	
		</td>
	</tr>

	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ≈÷«›… " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>