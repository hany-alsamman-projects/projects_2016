<? if($ok){ print ''; } ?>


<form name="add" method="post">
<table align="center" border="1" width="95%" cellspacing="0" cellpadding="0" height="476">
	<tr>
		<td align="center" colspan="2" height="23">ÊÚÏíá ÇáãÍÊæì</td>
	</tr>
	<tr>
		<td width="50%" height="39">ÇáÚäæÇä :</td>
		<td width="50%" height="39"><input type="text" name="p_name" value="<? print $p_name ?>"></td>
	</tr>

	<tr>
		<td width="50%" height="35">ÇáŞÓã :</td>
		<td width="50%" height="35">
<?

$result = mysql_query("SELECT * FROM `departments` WHERE `d_active` = '1' and `d_type` = 'cat' and `d_parent` != '0'") or die(mysql_error());

    print "<select size='1' name='in_parent''>";
	
	while($row = mysql_fetch_object($result)){
		if($row->id == $in_parent){
		print "<option value='$row->id' selected>$row->en_d_name</option>";    
		}else{
		print "<option value='$row->id'>$row->en_d_name</option>";    
		}
        		
	}
	
	print "</select>";
?>

		</td>
	</tr>
	<tr>
		<td width="50%" height="35">ÇááÛÉ :</td>
		<td width="50%" height="35">
<?= array_search($_GET['lang'], $this->my_language)?>

		</td>
	</tr>
	<tr>
		<td width="100%" colspan="2" height="35">ÇáãÚáæãÇÊ :</td>
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
$oFCKeditor->Value		= $p_content;
$oFCKeditor->Create() ;
?>
		</td>
	</tr>
	
	<tr>
		<td align="center" width="100%" colspan="2" height="27">
<input type="submit" name="submit" value=" ÊÚÏíá ">
		</td>
	</tr>
	
	<input type="hidden" name="sub_ok" value="1">
</table>
</form>
