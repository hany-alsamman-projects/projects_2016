<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Show Blogs</b></div>
</div>

<script type="text/javascript">
<!--
function confirmDelete(delUrl) {
  if (confirm("Are You Sure Delete!")) {
    document.location = delUrl;
  }
}
//-->
</script>

<?
  
  $result = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '0' ORDER BY d_name");
    
	while($row = mysql_fetch_object($result)){
		
	if($row->d_active == 1){
		$show = 'visible';
	}else{
		$show = 'unvisible';
	}

	print '<table align="center" width="98%" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0">';

	
			
		print '<tr><td colspan="7">'.$row->d_name.' <a href="index.php?section=EditBlog&id='.$row->id.'&active=departments">Edit</a> <a href="javascript:confirmDelete(\'index.php?section=DeleteBlog&id='.$row->id.'&active=departments\')">Delete ?</a> and Now is <img alt="'.$show.'" align="absbottom" src="../images/admin/'.$show.'.jpg"></td></tr>
		<tr>
		<td>id</td>
		<td>Department name</td>
		<td>Topic total</td>
		<td>Department status</td>
		<td>Last update</td>
		<td>delete</td>
		<td>edit</td>
		</tr>';
			
		
	$subcat = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '{$row->d_name}' ORDER BY d_parent");
	
		while($sub = mysql_fetch_object($subcat)){
		
		static $i = 1;
		
		$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `in_dept` = '{$sub->id}'"), 0);
		
		if($sub->d_active == 1){
			$show = 'visible';
		}else{
			$show = 'unvisible';
		}
			
		print "<tr>
		    <td>$i</td>
			<td><a href=\"index.php?section=ShowObjects&in_dept=$sub->id&active=departments\">$sub->d_name</a></td>
			<td>$sum_topics</td>
			<td><img alt='$show' src='../images/admin/$show.jpg'></td>
			<td>$sub->last_update</td>
			<td><a href=\"javascript:confirmDelete('index.php?section=DeleteDepartment&id=$sub->id&active=departments')\"><img src='../images/admin/delete.png'></a></td>
			<td><a href='index.php?section=EditDepartment&id=$sub->id&active=departments'><img src='../images/admin/edit.png'></a></td>
			</tr>";	
			
		$i++;	
		}

   
   
   print '</table><br><br>';
   }
?>