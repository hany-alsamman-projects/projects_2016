
<table align="center" width="98%" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0">
<tr>
	<td>ÇáÑŞã</td>
	<td>ÇáÚäæÇä</td>
	<td>ÇáŞÓã</td>
	<td>ÂÎÑ ÊÍÏíË</td>
	<td>ÊÚÏíá</td>
	<td>ÍĞİ</td>
</tr>

<?
    
		    $f = mysql_query("SELECT * FROM `en_items` ORDER BY in_parent") or die(mysql_error());

		    while($row_show_pro = mysql_fetch_object($f)){
			static $i = 1;
			
            print '<!--Box Content ".$i." element -->
            <DIV id="mymenu'.$i.'" class="message" style="position:absolute; visibility: hidden; text-align:center; width: 300px; margin: 100px 170px; padding: 1px;">
			        <ul class="first-of-type">
			            <li><a href="index.php?section=EditItem&lang=en&id='.$row_show_pro->id.'">English</a></li>
			            <li><a href="index.php?section=EditItem&lang=ar&id='.$row_show_pro->id.'">Arabic</a></li>
			        </ul> 
            </DIV>';			
						
			$dep = mysql_query("SELECT * FROM `departments` WHERE `d_type` = 'cat' and `id` = '{$row_show_pro->in_parent}' LIMIT 1") or die(mysql_error());
			
			while($dep_row = mysql_fetch_object($dep) ){
						
				print "<tr>
			    <td>$i</td>
				<td><a target=\"_blank\" title=\"ãÔÇåÏÉ ÇáÕİÍÉ\" href=\"../en/index.php?action=ViewPage&id=$row_show_pro->id\">$row_show_pro->p_name</a></td>
				<td>$dep_row->en_d_name</td>
				<td>$row_show_pro->last_update</td>
				<td><div style=\"cursor:pointer;\"><a href=\"javascript:showdiv($i)\"><img src='images/admin/edit.png'></a></div></td>
				<td><a href='index.php?section=DeleteItem&id=$row_show_pro->id'><img src='images/admin/delete.png'></a></td>
				</tr>";
			
			}
				
			$i++;
			}
?>

</table>