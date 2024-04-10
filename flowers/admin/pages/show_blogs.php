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
  
  $result = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '0' ORDER BY en_d_name");
    
	while($row = mysql_fetch_object($result)){
		
	if($row->d_active == 1){
		$show = 'visible';
	}else{
		$show = 'unvisible';
	}
		
	print '<table align="middle" width="100%" border="1" style="border-collapse: collapse" bordercolor="#C0C0C0">';
		
	static $i = 0;
			
		print '<tr><td colspan="7" height="20" style="COLOR: #000000;background-position:center;background-image:url(\'images/admin/td_bg.gif\'); background-repeat:repeat-x; text-align:right">
        '.$row->en_d_name.' <a href="index.php?section=EditBlog&id='.$row->id.'">ÊÚÏíá</a> 
        <a href="javascript:confirmDelete(\'index.php?section=DeleteRootDepartment&id='.$row->id.'\')">ÍĞİ ¿</a> 
         ÇáÂä ÍÇáÊå <img alt="'.$show.'" align="absbottom" src="images/admin/'.$show.'.gif">
        </td></tr>
		<tr>
		<td>id</td>
		<td>ÇÓã ÇáŞÓã</td>
		<td>äæÚ ÇáŞÓã</td>
		<td>ÍÇáÉ ÇáŞÓã</td>
		<td>ÂÍÑ ÊÚÏíá</td>
		<td>ÍĞİ</td>
		<td>ÊÚÏíá</td>
		</tr>';
			
		
	$subcat = mysql_query("SELECT * FROM `departments` WHERE `d_parent` = '{$row->id}' ORDER BY d_parent");
	
		while($sub = mysql_fetch_object($subcat)){
		
		if($sub->d_active == 1){
			$show = 'visible';
		}else{
			$show = 'unvisible';
		}
			
		print "<tr>
		    <td>$i</td>
			<td>$sub->en_d_name</td>
			<td>$sub->d_type</td>
			<td><img alt='$show' src='images/admin/$show.gif'></td>
			<td>$sub->last_update</td>
			<td><a href=\"javascript:confirmDelete('index.php?section=DeleteDepartment&id=$sub->id')\"><img src='images/admin/delete.png'></a></td>
			<td><a href='index.php?section=EditDepartment&id=$sub->id'><img src='images/admin/edit.png'></a></td>
			</tr>";		
		}

   $i++;
   
   print '</table><br><br>';
   }
?>
</div>