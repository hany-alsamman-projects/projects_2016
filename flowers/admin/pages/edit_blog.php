<? if($ok) print 'edit done' ?>
<form name="add" method="post">
<table align="center" border="1" width="95%" width="100%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">ÊÚÏםב דÌדזÚÉ</td>
	</tr>
	<tr>
		<td width="50%" height="38">ÇÓד ÇבדÌדזÚÉ ÈÇבבÛÉ  ÇבÅהÌבםÒםÉ :</td>
		<td width="50%" height="38"><input type="text" value="<?= $en_d_name ?>" name="en_d_name"></td>
	</tr>
	<tr>
		<td width="50%" height="38">ÇÓד ÇבדÌדזÚÉ ÈÇבבÛÉ ÇבÚÑÈםÉ :</td>
		<td width="50%" height="38"><input type="text" value="<?= $ar_d_name ?>" name="ar_d_name"></td>
	</tr>
	<tr>
		<td width="50%" height="41">הזÚ ÇבדÌדזÚÉ:</td>
		<td width="49%" height="41">
		<input type="text" value="<? print $d_type ?>" disabled="true" name="d_type">
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">ÍÇבÉ ÇבדÌדזÚÉ:</td>
		<td width="50%" height="52">
		<?
		if($stauts == 1){
		print '<input type="radio" name="d_active" value="1" checked>ÊÝÚםב';
		}else{
		print '<input type="radio" name="d_active" value="1" >ÊÝÚםב';		
		}
		
		if($stauts == 0){
		print '<input type="radio" name="d_active" value="0" checked>ÇםÞÇÝ';
		}else{
		print '<input type="radio" name="d_active" value="0">ÇםÞÇÝ';		
		}
		?>
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ÊÚÏםב  " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>