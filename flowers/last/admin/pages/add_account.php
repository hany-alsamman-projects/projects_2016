<table border="0" width="100%" cellspacing="0" cellpadding="3">
	<form method="POST">
	<tr>
		<td colspan="2" align="center">
		����� ����</td>
	</tr>
	<tr>
		<td width="129">�����</td>
		<td width="465"><input type="text" name="account_name"/></td>
	</tr>
	<tr>
		<td width="129">���� ����</td>
		<td width="465"><input type="text" name="account_password"/></td>
	</tr>
	<tr>
		<td width="129">������ ����������</td>
		<td width="465"><input type="text" name="account_mail"/></td>
	</tr>
	<tr>
		<td width="129">��������</td>
		<td width="465"><select size="1" name="account_group">
<!--
		<option value="1" selected>����</option>
		<option value="2">���� �����</option>
-->
		<option value="3">���� �����</option>
		<option value="4" selected="true">����� ����</option>
		
		</select></td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<input type="hidden" name="sub_ok" value="1">
		<input type="submit" value="�����" name="sub"> <input type="reset" value="���" name="res"></td>
	</tr>
	</form>
</table>