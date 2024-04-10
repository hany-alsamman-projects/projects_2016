<? if($ok) print 'edit done' ?>
<form name="add" method="post">
<table align="center" border="1" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">ÊÚÏíá ãÌãæÚÉ</td>
	</tr>
	<tr>
		<td width="50%" height="38">ÇÓã ÇáãÌãæÚÉ</td>
		<td width="50%" height="38"><input type="text" value="<? print $d_name ?>" name="d_name"></td>
	</tr>
	<tr>
		<td width="50%" height="41">äæÚ ÇáãÌãæÚÉ:</td>
		<td width="49%" height="41">
		<input type="text" value="<? print $d_type ?>" disabled="true" name="d_type">
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">ÍÇáÉ ÇáãÌãæÚÉ:</td>
		<td width="50%" height="52">
		<?
		if($stauts == 1){
		print '<input type="radio" name="d_active" value="1" checked>ÊİÚíá';
		}else{
		print '<input type="radio" name="d_active" value="1" >ÊİÚíá';		
		}
		
		if($stauts == 0){
		print '<input type="radio" name="d_active" value="0" checked>ÇíŞÇİ';
		}else{
		print '<input type="radio" name="d_active" value="0">ÇíŞÇİ';		
		}
		?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ÊÚÏíá  " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>