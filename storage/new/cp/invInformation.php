<? include("inc/header.php");
checkUser(2);
$add_opr=0;
$edit_opr=1;
$delete_opr=0;
$view_opr=0;
$showID=0;

$title='Invoices Information';
$table="inv_text";
$order="id";
$order_dir="DESC";

if($_GET['update'] == 1){
    
    mysql_query("UPDATE `inv_text` SET `header` = '".$_POST['header']."' WHERE id = 1");
    mysql_query("UPDATE `inv_text` SET `footer` = '".$_POST['footer']."' WHERE id = 1");
    
    echo '<META HTTP-EQUIV=Refresh CONTENT="2; URL=invInformation.php?">';
    
}else{
    
    $footer = mysql_result(mysql_query("SELECT footer FROM `inv_text` WHERE id = 1"),0);
    $header =  mysql_result(mysql_query("SELECT header FROM `inv_text` WHERE id = 1"),0);
    
}

?>
<form name="deleSelForm" action="/storage/cp/invInformation.php?update=1" method="post">

<table border="0" cellspacing="0" cellpadding="3" >
<tr class="list" >

<td></td>
    <td>Invoice Header</td><td>Invoice Footer</td><td>&nbsp;</td>
</tr>
    <tr class="list_n">
	<td> <td width='325'>
<textarea name="header" class="text_area" style="width: 350px;"><?=$header?></textarea>
</td><td width='325'>
<textarea name="footer" class="text_area" style="width: 350px;"><?=$footer?></textarea>
</td><td width='70'>
    
    
    </td>
    	   </tr><tr class="list">
  <td colspan="4">
  <input type="submit" value="save" />
</td></tr>
</table>
</form>
<?

include_once "ckeditor/ckeditor.php";

// Create a class instance.
$CKEditor = new CKEditor();

// Path to the CKEditor directory.
$CKEditor->basePath = './ckeditor/';

	// Replace a textarea element with an id (or name) of "editor1".
$CKEditor->replaceAll();

include("inc/footer.php")?>
