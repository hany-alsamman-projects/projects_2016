<div align="center"><? if($delete_status == true) echo ' �� ��� �������';  ?> </div>

<div style="padding: 5px;">
<b>���������</b>
</div>

<table dir="rtl" align="middle" width="100%" border="1" style="border-collapse: collapse">
<tr>
	<td>�����</td>
	<td>��� �������</td>
	<td>��� �������</td>
	<td>���� �������</td>
	<td>���������</td>
	<td>��������</td>
	<td>���</td>
	<td>�����</td>
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