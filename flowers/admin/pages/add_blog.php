<? print $ok ?>

<form name="add" method="post">
<table style="border-collapse: collapse; border:1px #C0C0C0" border="1" align="center" width="95%" cellspacing="0" cellpadding="0" height="208">
	<tr>
		<td align="center" colspan="2" height="34">����� ������</td>
	</tr>
	<tr>
		<td width="50%" height="38">��� �������� ������ ���������� :</td>
		<td width="50%" height="38"><input type="text" name="en_d_name" /></td>
	</tr>
	
	<tr>
		<td width="50%" height="38">��� �������� ������ ������� :</td>
		<td width="50%" height="38"><input type="text" name="ar_d_name" /></td>
	</tr>
	<tr>
		<td width="50%" height="41">��� ��������:</td>
		<td width="49%" height="41">
<select size="1" name="d_type">
	<option value="cat">�����</option>  <!-- ��� ����� -->
	<!--  <option value="menu">Menu</option> ����� ����� -->
</select>
		</td>
	</tr>
	<tr>
		<td width="50%" height="52">���� ��������:</td>
		<td width="50%" height="52">
		<input type="radio" name="d_active" value="1" checked>���� 
		<br>
		<input type="radio" name="d_active" value="0" >����	
		</td>
	</tr>
	<tr>
		<td align="center" colspan="2" height="41"><input type="submit" value=" ����� " name="submit"></td>
	</tr>
	<input type="hidden" name="sub_ok" value="1">
</table>

</form>