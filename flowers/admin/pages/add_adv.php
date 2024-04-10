
<head>
<style type="text/css">
.style1 {
	border-style: solid;
	border-width: 1px;
}
</style>
</head>

<script type="text/javascript" src="uploader.js" ></script>

<script type='text/javascript'>

function formValidator(){
	// Make quick references to our fields
	var banner_name = document.getElementById('banner_name');
	var banner_url = document.getElementById('banner_url');
	var banner_link = document.getElementById('banner_link');
	var pictures = document.getElementById('pictures');

	// Check each input in the order that it appears in the form!
	if(lengthRestriction(banner_name, 1, 255)){
		if(lengthRestriction(banner_url, 1, 255)){
			if(lengthRestriction(banner_link, 1, 255)){
				if(lengthRestriction(pictures, 1, 255)){
					return true;
				}
			}
		}
	}
	
	
	return false;
	
}

function isEmpty(elem, helperMsg){
	if(elem.value.length == 0){
		alert(helperMsg);
		elem.focus(); // set the focus to this input
		return true;
	}
	return false;
}

function isNumeric(elem, helperMsg){
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression)){
		return true;
	}else{
		alert(helperMsg);
		elem.focus();
		return false;
	}
}

function lengthRestriction(elem, min, max){
	var uInput = elem.value;
	if(uInput.length >= min && uInput.length <= max){
		return true;
	}else{
		alert("Please enter between " +min+ " and " +max+ " characters");
		elem.focus();
		return false;
	}
}

</script>

<div align="center"><? if ($add_status == 1) echo '�� ����� ������� �����'; ?></div>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
		<td valign="top" width="70%" style="height: 75">

		<table cellpadding="5" cellspacing="0" style="width: 100%">
			<tr>
				<td>��� �������</td>
			</tr>
			<tr>
				<td>
<?
	$uploadDirectory = "images/admin/banner";
	require_once("AjaxFileUploader.inc.php");
	$ajaxFileUploader = new AjaxFileuploader($uploadDirectory);	
	echo $ajaxFileUploader->showFileUploader('picture');
?>
				
				</td>
			</tr>
		</table>

		</td>
	</tr>
	
	<tr>
		<td valign="top" width="70%">

<form method="POST" onsubmit='return formValidator()'>
<table width="98%" cellpadding="5" cellspacing="0" class="style1">
	<tr>
		<td height="33" align="center" colspan="2">����� �����</td>
	</tr>
	<tr>
		<td width="50%">��� �������</td>
		<td width="50%">
		<input name="banner_name" id="banner_name" type="text" maxlength="200" style="width: 250px"></td>
	</tr>
	<tr>
		<td width="50%">���� �������</td>
		<td width="50%">
		<input name="banner_url" id="banner_url" type="text" maxlength="200" style="width: 250px"></td>
	</tr>
	<tr>
		<td width="49%">���� �������</td>
		<td width="49%">
		<input id="image" name="banner_link" type="text" maxlength="200" size="20" style="width: 250px"></td>
	</tr>
	<tr>
		<td width="49%">����� �����</td>
		<td width="49%">
		<input name="banner_start" type="text" maxlength="200" size="20" value="<?=date("n-j-Y-G-i")?>" style="width: 250px; direction: ltr">
		<br>
		<span style="text-align:right"><strong>MM-DD-YY HH-MI</strong></span>
		</td>
	</tr>
	<tr>
		<td width="49%">����� ��������</td>
		<td width="49%">
		<input name="banner_end" type="text" maxlength="200" size="20"  value="<?=date("n-j-Y-G-i")?>" style="width: 250px; direction: ltr">
		<br>
		<span style="text-align:right"><strong>MM-DD-YY HH-MI</strong></span>
		</td>
	</tr>
	<tr>
		<td width="49%">���� �������</td>
		<td width="49%"><select name="banner_position" style="height: 22px">
		<option value="bottom">����</option>
		<option value="left">������</option>
		<option value="right">������</option>
		<option selected="" value="top">������</option>
		</select>
		</td>
	</tr>
	<tr>
		<td width="50%">��� �������</td>
		<td width="50%">
		<input type="radio" name="banner_type" value="image" checked> ���� 
		<br> 
		<input type="radio" name="banner_type" value="flash"> ����
		</td>
	</tr>
	<tr>
		<td colspan="2" style="width: 100%; text-align:center"><input type="submit" value=" ����� "></td>
	</tr>
	</table>
	<input type="hidden" name="sub_ok" value="1">
</form>

		</td>
	</tr>
	
	</table>
	
	<div>������: ��� ����� ����� ���� ��� ���� ����� ��� ����� </div>