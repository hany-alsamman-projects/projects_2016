<? if($ok) print 'edit done' ?>

<form name="add" method="post">
<table align="center" border="1" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">ЪкЯэс огу</td>
	</tr>
	<tr>
		<td width="50%" height="38">Хгу Чсогу ШЧсслЩ ЧсХфЬсэвэЩ :</td>
		<td width="50%" height="38"><input type="text" value="<? print $en_d_name ?>" name="en_d_name"></td>
	</tr>
	
	<tr>
		<td width="50%" height="38">Чгу Чсогу ШЧсслЩ ЧскбШэЩ :</td>
		<td width="50%" height="38"><input type="text" value="<? print $ar_d_name ?>" name="ar_d_name"></td>
	</tr>
	
	<tr>
		<td width="50%" height="41">фцк Чсогу :</td>
		<td width="49%" height="41">
		<input type="text" value="<? print $d_type ?>" disabled="true" name="d_type">
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">ЭЧсЩ Чсогу :</td>
		<td width="50%" height="52">
		<?
		if($stauts == 1){
		print '<input type="radio" name="d_active" value="1" checked>Ънкэс';
		}else{
		print '<input type="radio" name="d_active" value="1" >ХэоЧн';		
		}
		
		if($stauts == 0){
		print '<input type="radio" name="d_active" value="0" checked>ХэоЧн';
		}else{
		print '<input type="radio" name="d_active" value="0">ХэоЧн';		
		}
		?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ЪкЯэс " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>