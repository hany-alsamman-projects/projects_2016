<div align="center"><? if($delete_status == true) echo 'the banner deleted ';  ?> </div>

<div style="padding: 5px;">
<b>ACTIVE BANNERS </b>
<br />
<img src="../images/admin/hr.jpg" width="185" height="8" />
</div>

<table align="middle" width="100%" border="1" style="border-collapse: collapse">
<tr>
	<td>id</td>
	<td>Banner name</td>
	<td>Banner type</td>
	<td>Banner position</td>
	<td>Views</td>
	<td>Clicks</td>
	<td>Edit</td>
	<td>Delete</td>
</tr>

<?php

				$ShowQAdv = mysql_query("SELECT * FROM `ads_banner` WHERE `active` = '1' ORDER BY active") or die('error');
				
				while($ShowAdv = mysql_fetch_object($ShowQAdv)){

					echo "<tr>
							<td>$ShowAdv->id</td>
							<td>$ShowAdv->banner_name</td>
							<td>$ShowAdv->banner_type</td>
							<td>$ShowAdv->banner_position</td>
							<td>$ShowAdv->views</td>
							<td>$ShowAdv->clicks</td>
							<td><a href=\"./?section=DeleteAdv&id=$ShowAdv->id\">Delete</a></td>
							<td><a href=\"./?section=EditAdv&id=$ShowAdv->id\">Edit</a></td>	
						</tr>";
										
				}
?>

</table>

<div style="padding: 5px;">
<b>DISABLE BANNERS </b>
<br />
<img src="../images/admin/hr.jpg" width="185" height="8" />
</div>

<table align="middle" width="100%" border="1" style="border-collapse: collapse">
<tr>
	<td>id</td>
	<td>Banner name</td>
	<td>Banner type</td>
	<td>Banner position</td>
	<td>Views</td>
	<td>Clicks</td>
	<td>Edit</td>
	<td>Delete</td>
</tr>

<?php

				$ShowQAdv = mysql_query("SELECT * FROM `ads_banner` WHERE `active` != '1' ORDER BY active") or die('error');
				
				while($ShowAdv = mysql_fetch_object($ShowQAdv)){
														
					echo "<tr>
							<td>$ShowAdv->id</td>
							<td>$ShowAdv->banner_name</td>
							<td>$ShowAdv->banner_type</td>
							<td>$ShowAdv->banner_position</td>
							<td>$ShowAdv->views</td>
							<td>$ShowAdv->clicks</td>
							<td><a href=\"./?section=DeleteAdv&id=$ShowAdv->id\">Delete</a></td>
							<td><a href=\"./?section=EditAdv&id=$ShowAdv->id\">Edit</a></td>	
						</tr>";
				
				}
?>

</table>