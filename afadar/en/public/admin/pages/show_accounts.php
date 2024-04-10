<table align="middle" width="100%">
<tr>
	<td><span lang="ar-sy">«·—ﬁ„</span></td>
	<td><span lang="ar-sy">«”„ «·Õ”«»</span></td>
	<td><span lang="ar-sy">«·Õ«·…</span></td>
	<td><span lang="ar-sy">» «—ÌŒ</span></td>
	<td><span lang="ar-sy">«·»—Ìœ «·«·ﬂ —Ê‰Ì</span></td>
	<td><span lang="ar-sy">Õ–›</span></td>
</tr>

<?
	$result = mysql_query("SELECT * FROM `members` ORDER BY group_id");
	
	while($row = mysql_fetch_object($result)){
		static $i = 1;
		
		if($row->group_id == 1){
			$mod_name = 'Agent';
		}elseif($row->group_id == 2){
			$mod_name = 'Moderator';
		}elseif($row->group_id == 3){
			$mod_name = 'Super Moderator';
		}elseif($row->group_id == 4){
			$mod_name = 'Admin';
		}
				
print "<tr>
    <td>$i</td>
	<td>$row->name</td>
	<td>$mod_name</td>
	<td>$row->action_time</td>
	<td>$row->email</td>
	<td><a href='index.php?section=DeleteAccount&id=$row->id'><img src='../images/admin/delete.png'></a></td>
	</tr>";
$i++;

	}
?>

</table>