<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "<h1>Incorrect access</h1>You cannot access this file directly.";
        exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title><? print SITE_NAME ?></title>

</head>

<body>
<table style="width: 98%; background-color:white; margin-top:15px; margin-bottom:15px" cellpadding="5" cellspacing="0" align="center">

<form method="post">
	<tr>
		<td colspan="3" style="text-align:center; height: 42px; background-color: #C0C0C0;">
		
		����� ������
		<br />
		<?php
		if(isset($_POST['sub_ok'])){
			
			if($ok){
				echo '��� �� ����� ��������� , ���� ������� �� ���� ���';
			}else{
				echo '���� ����� �� ���� ��������';
			}	
			
		}

		?>
		</td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_add_name" style="width: 280px" type="text" /></td>
		<td style="text-align:right; height: 35px; width: 25%;"><span lang="ar-sa">
		: ��� ������</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_title" style="width: 280px" type="text" /></td>
		<td style="text-align:right; height: 35px; width: 25%;"><span lang="ar-sa">
		: ����� ��������</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_short" style="width: 280px" type="text" /></td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: ���� ��������
		</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<select dir="rtl" size="1" name="in_dept">
		<?
			$result = mysql_query("SELECT id,d_name FROM `departments` WHERE `id` = '7' and `d_active` = '1' ORDER BY id");
			
				while($row = mysql_fetch_object($result)){
					//if($row->id != 2)
					echo "<option value=\"$row->id\">$row->d_name</option>";
				}
		?>	
		</select>
		</td>
		<td style="text-align:right; width: 25%;">
		: ��� �����
		</td>
	</tr>
	
	<tr>
		<td style="width: 75%; text-align:right; height: 210px;" colspan="2">
		<textarea name="t_content" style="width: 450px; height: 200px" cols="20" rows="1"></textarea></td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: �� 
		��������</span></td>
	</tr>
	
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
                <select dir="rtl" name="country">
                  <option value="�����" selected="selected"> �����</option>
                  <option value="��������"> ��������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="���������"> ���������</option>
                  <option value="�����"> �����</option>
                  <option value="������"> ������</option>
                  <option value="�����������"> �����������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="��������"> ��������</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                  <option value="������"> ������</option>
                  <option value="��������"> ��������</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="�����"> �����</option>
                  <option value="�������� �������"> �������� �������</option>
                  <option value="������� ������"> ������� ������</option>
                  <option value="����������"> ����������</option>
                  <option value="�������"> �������</option>
                  <option value="����������"> ����������</option>
                  <option value="������"> ������</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                  <option value="���������"> ���������</option>
                  <option value="���������"> ���������</option>
                  <option value="������"> ������</option>
                  <option value="��������"> ��������</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                  <option value="��������"> ��������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="������� ����"> ������� ����</option>
                  <option value="����"> ����</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="��������"> ��������</option>
                  <option value="����"> ����</option>
                  <option value="�����"> �����</option>
                  <option value="����������"> ����������</option>
                  <option value="����"> ����</option>
                  <option value="�����"> �����</option>
                  <option value="�������"> �������</option>
                  <option value="����"> ����</option>
                  <option value="��������"> ��������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="����"> ����</option>
                  <option value="����"> ����</option>
                  <option value="������"> ������</option>
                  <option value="���"> ���</option>
                  <option value="����"> ����</option>
                  <option value="������"> ������</option>
                  <option value="�����"> �����</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="����"> ����</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="���������"> ���������</option>
                  <option value="�����"> �����</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="���� ����"> ���� ����</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="���������"> ���������</option>
                  <option value="�����"> �����</option>
                  <option value="����� ��������"> ����� ��������</option>
                  <option value="����� ��������"> ����� ��������</option>
                  <option value="������"> ������</option>
                  <option value="�����"> �����</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="��������"> ��������</option>
                  <option value="���������"> ���������</option>
                  <option value="�����"> �����</option>
                  <option value="������"> ������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="����"> ����</option>
                  <option value="�����"> �����</option>
                  <option value="���������"> ���������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="����"> ����</option>
                  <option value="���"> ���</option>
                  <option value="�������"> �������</option>
                  <option value="����� ���������"> ����� ���������</option>
                  <option value="������"> ������</option>
                  <option value="��� ������"> ��� ������</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="�����"> �����</option>
                  <option value="��������"> ��������</option>
                  <option value="��������"> ��������</option>
                  <option value="��������"> ��������</option>
                  <option value="�������"> �������</option>
                  <option value="���� �������"> ���� �������</option>
                  <option value="�������"> �������</option>
                  <option value="���������"> ���������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="������"> ������</option>
                  <option value="�������"> �������</option>
                  <option value="������"> ������</option>
                  <option value="���������"> ���������</option>
                </select>
		</td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: ������</span></td>
	</tr>
	<tr>
		<td style="width: 40%; text-align:right; height: 35px;">
<a href="#" onclick="document.getElementById('image').src = '<?php echo SITE_DIR?>/library/securimage/view.php?sid=' + Math.random(); return false">����� ������</a>

<img src="<?php echo SITE_DIR?>/library/securimage/view.php?sid=<?php echo md5(uniqid(time())); ?>" id="image" align="absmiddle" />

		</td>
		<td style="width: 35px; text-align:right">
		<input name="image_captcha" style="width: 280px" type="text" /></td>
		<td style="text-align:right; width: 25%;">: ���� ������ ������ �� ����� </td>
	</tr>
	<tr>
		<td style="text-align:center; height: 35px;" colspan="3">
		<input name="Reset1" type="reset" value="���" />
		<input name="submit" type="submit" value="�����" />
		<input type="hidden" value="<?php echo time() ?>" name="start_date" />
		<input type="hidden" value="1" name="sub_ok" />
		</td>
	</tr>
	</form>
</table>
</body>
</html>