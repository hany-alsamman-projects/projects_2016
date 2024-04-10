<div align="center"><? if($delete_status == true) echo ' Êã ÍĞİ ÇáÇÚáÇä';  ?> </div>

<div style="padding: 5px;">
<b>ÇáÇÚáÇäÇÊ</b>
</div>

<table dir="rtl" align="middle" width="100%" border="1" style="border-collapse: collapse">
<tr>
	<td>ÇáÑŞã</td>
	<td>ÇÓã ÇáÇÚáÇä</td>
	<td>äæÚ ÇáÇÚáÇä</td>
	<td>ãßÇä ÇáÇÚáÇä</td>
	<td>ÇáãÔÇåÏÇÊ</td>
	<td>ÇáÒíÇÑÇÊ</td>
	<td>ÍĞİ</td>
	<td>ÊÚÏíá</td>
</tr>

<?php

				$ShowQAdv = mysql_query("SELECT * FROM `ads_banner` ORDER BY banner_start,active ") or die('error');
				
				while($ShowAdv = mysql_fetch_object($ShowQAdv)){

					echo "<tr>
							<td>$ShowAdv->id</td>
							<td>$ShowAdv->banner_name</td>
							<td>$ShowAdv->banner_type</td>
							<td>$ShowAdv->banner_position</td>
							<td>$ShowAdv->views</td>
							<td>$ShowAdv->clicks</td>
							<td><a href=\"./?section=DeleteAdv&id=$ShowAdv->id\"><img src=\"../images/admin/delete.png\"></a></td>
							<td><a href=\"./?section=EditAdv&id=$ShowAdv->id\"><img src=\"../images/admin/edit.png\"></a></td>	
						</tr>";
										
				}
?>

</table>