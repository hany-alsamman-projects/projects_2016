
<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="476" style="border-collapse: collapse" bordercolor="#C0C0C0">
	<tr>
		<td align="center" colspan="2" height="23">≈÷«›… „Õ ÊÏ</td>
	</tr>
	<tr>
		<td width="50%" height="39">«·⁄‰Ê«‰ :</td>
		<td width="50%" height="39"><input type="text" name="p_name" /></td>
	</tr>

	<tr>
		<td width="50%" height="35">«·ﬁ”„ :</td>
		<td width="50%" height="35">
<?php

    $result = mysql_query("SELECT * FROM `departments` WHERE `d_active` = '1' and `d_type` = 'cat' and `d_parent` != '0' ORDER BY en_d_name") or die(mysql_error());
    
        print "<select size='1' name='in_parent'>";
    	
    	while($row = mysql_fetch_object($result)){
    		print "<option value='$row->id'>$row->en_d_name</option>";   
    	}

    	
    	print "</select>";
        
?>

		</td>
	</tr>
	
	<tr>
		<td width="50%" height="35">«··€… :</td>
		<td width="50%" height="35">
<?

    print "<select size='1' name='used_lang'>";

    foreach($this->my_language as $lang_name => $lang_table){    
	print "<option value='$lang_table'>$lang_name</option>";   
	}
	
	print "</select>";
?>

		</td>
	</tr>

	<tr>
		<td width="100%" colspan="2" height="35">«·„⁄·Ê„«  :</td>
	</tr>
	
	<tr>
		<td width="100%" colspan="2" height="269">
<?php

include('./fckeditor.php');

$sBasePath = $_SERVER['PHP_SELF'] ;
$sBasePath = substr( $sBasePath, 0, strpos( $sBasePath, "pages" ) ) ;

$oFCKeditor = new FCKeditor('p_content') ;
$oFCKeditor->BasePath	= $sBasePath ;
$oFCKeditor->Height	    = 500 ;
$oFCKeditor->Value		= '<p>This is some <strong>sample text</strong>' ;
$oFCKeditor->Create() ;
?>


		</td>
	</tr>
	
	<tr>
		<td align="center" width="100%" colspan="2" height="27">
<input type="submit" name="submit" value="≈÷«›…" />
		</td>
	</tr>
	
	<input type="hidden" name="sub_ok" value="1" />
</table>
</form>
