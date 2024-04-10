<table align="center" width="98%" style="border: 1px #C0C0C0 solid; border-collapse: collapse">
<tr>
	<td>ID</td>
	<td>Page name</td>
	<td>Last update</td>
	<td>Visit</td>
	<td>delete</td>
	<td>edit</td>
</tr>

<?

    $t = mysql_query("SELECT * FROM `additional_pages` ORDER BY id");
    while($row_show_page = mysql_fetch_object($t)){
		
	static $i = 1;

		print "<tr>
		    <td>$i</td>
			<td>$row_show_page->a_name</td>
			<td>$row_show_page->last_update</td>
			<td>$row_show_page->a_visit</td>
			<td><a href='index.php?section=DeletePage&id=$row_show_page->id'><img src='../images/delete.png'></a></td>
			<td><a href='index.php?section=EditPage&id=$row_show_page->id'><img src='../images/edit.png'></a></td>
			</tr>";
		$i++;
	}
?>

</table>