<script type="text/javascript">
<!--
function confirmDelete(delUrl) {
  if (confirm("Are You Sure Delete!")) {
    document.location = delUrl;
  }
}
//-->
</script>

<div style="text-align:right; font-size:8pt; padding: 5px">ÚÑÖ ÇáÇŞÓÇã</div>
<div style="padding:5px; width:98%; position: relative;" class="gray_bg">

<?
  
  $result = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '0' ORDER BY d_name");
    
	while($row = mysql_fetch_object($result)){
		
	if($row->d_active == 1){
		$show = 'visible';
	}else{
		$show = 'unvisible';
	}

	print '<table class="white_bg" dir="rtl" cellpadding="3" align="center" width="98%" border="1">';

	static $i = 0;
			
		print '<tr><td colspan="7">'.$row->d_name.' <a href="index.php?section=EditBlog&id='.$row->id.'">ÊÚÏíá</a> <a href="javascript:confirmDelete(\'index.php?section=DeleteBlog&id='.$row->id.'\')">ÍĞİ ?</a> æÇáÂä ÍÇáÊå <img alt="'.$show.'" align="absbottom" src="../images/admin/'.$show.'.jpg"></td></tr>
		<tr>
		<td>ÇáÑŞã</td>
		<td>ÇÓã ÇáŞÓã</td>
		<td>ãÌãæÚ ÇáãæÇÖíÚ</td>
		<td>ÍÇáÉ ÇáŞÓã</td>
		<td>ÂÎÑ ÊÚÏíá</td>
		<td>ÍĞİ</td>
		<td>ÊÚÏíá</td>
		</tr>';
			
		
	$subcat = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '{$row->d_name}' ORDER BY d_parent");
	
		while($sub = mysql_fetch_object($subcat)){
		
		$sum_topics = mysql_result( mysql_query("SELECT COUNT(`tid`) FROM `topics` WHERE `in_dept` = '{$sub->id}'"), 0);
		
		if($sub->d_active == 1){
			$show = 'visible';
		}else{
			$show = 'unvisible';
		}
			
		print "<tr>
		    <td>$sub->id</td>
			<td><a href=\"index.php?section=ShowTopics&in_dept=$sub->id\">$sub->d_name</a></td>
			<td>$sum_topics</td>
			<td><img alt='$show' src='../images/admin/$show.jpg'></td>
			<td>$sub->last_update</td>
			<td><a href=\"javascript:confirmDelete('index.php?section=DeleteDepartment&id=$sub->id')\"><img src='../images/admin/delete.png'></a></td>
			<td><a href='index.php?section=EditDepartment&id=$sub->id'><img src='../images/admin/edit.png'></a></td>
			</tr>";		
		}

   $i++;
   
   print '</table><br><br>';
   }
?>
</div>