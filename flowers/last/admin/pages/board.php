<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Last Login Actions</b></div>
</div>

<table width="100%" >
		<tr>

			<td align="center" style="width: 100%" valign="top">

			<table align="center" cellspacing="0" cellpadding="0" style="width: 98%; border-style: solid; border-width: 1px;">
				<tr>
					<td height="31" align="center" colspan="2">Last Login Actions <a href="index.php?section=LoginLOGS">View all</a></td>
				</tr>
<?php
			$c = mysql_query("SELECT * FROM `mod_logs` ORDER BY id DESC LIMIT 5");
			
			$results_p = array(); 
			$i=0; 	
			while($row = mysql_fetch_object($c)){
				
			$l_status = ($row->attempt == 1) ? 'lightbulb_on.png' : 'lightbulb_off.png';
?>
				<tr>
					<td align="center" height="34" width="12%"><img src="images/admin/<?php echo $l_status?>" /></td>
					<td align="left" height="34" width="86%" style="font-size:9pt">
                    Account <img src="images/admin/<?php echo $row->group_id?>.png" /> <b><span style="color: red"><?php echo $row->name?></span></b> logged at <b><?php echo $row->action_time?></b> from <b><?php echo $row->ip?></b>                    </td>
				</tr>
<?php
			}
?>
				
			</table>	
			
            
            </td>
		</tr>
		
        </table>