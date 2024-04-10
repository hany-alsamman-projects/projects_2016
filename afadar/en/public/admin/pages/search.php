<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Search</b></div>
</div>


<form method="post" action="index.php?section=Search">
<table cellpadding="5" cellspacing="0" style="width: 100%; text-align:right">
	<tr>
		<td style="text-align:center" colspan="2">Search</td>
	</tr>
	<tr>
		<td style="width: 80%">
		<input  name="word" style="height: 15px; direction: rtl; width: 400px;" type="text" />	</td>
		<td style="width: 20%"><span lang="en-us">Word</span></td>
	</tr>
	<tr>
		<td>
					<?

					    $result = mysql_query("SELECT id,d_name FROM `departments` WHERE `d_parent` != '0' and `id` != '11' and `id` != '2' and `d_active` = '1' and `d_type` = 'cat'");

					    print "<select size='1' name='in_dept'>";

						while($row = mysql_fetch_object($result)){

							print "<option value='$row->id'>$row->d_name</option>";   

						}
						
							print "<option value='0' selected=true>«·ﬂ·</option>"; 		

						print "</select>";

					?>
		</td>
		<td><span lang="en-us">Departments</span></td>
	</tr>
	<tr>
		<td dir="rtl">
	<input name="SEARCH_TYPE" type="radio" value="images" /> Images
	<br />
	<input  checked="checked" name="SEARCH_TYPE" type="radio" value="lines" /> News Line

		</td>
		
		<td><span lang="en-us">Search Type</span></td>
	</tr>
	<tr>
		<td style="text-align: center" colspan="2"><input name="reset" type="reset" value=" CLEAR " /> <input name="submit" type="submit" value=" GO " />
		<input type="hidden" name="sub_ok" value="1" />
		</td>
	</tr>
</table>
</form>
