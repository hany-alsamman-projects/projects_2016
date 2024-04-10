<div id="nav_links">	
	<div> &rsaquo;&rsaquo; Home &rsaquo;&rsaquo;&nbsp; <b>Show Result</b></div>
</div>


	<!-- TOPIC -->
	<table cellpadding="3" cellspacing="0" style="width: 100%; margin-bottom:10px">
		<tr>
			<td rowspan="3" style="width: 100px; height: 100px;">
			
			<div style="margin-bottom:10px">
			<strong>Start Date:</strong> <br>
			<?=date("M j, g:i a",$row->start_date)?>
			</div>
			
			<div>
			<img src="../images/admin/tumble/<?=$row->t_pic?>" height="100" width="100" />
			</div>
			
			</td>
			<td colspan="10" style="height: 10px; text-align: right">
			<a style="color: blue" href="../index.php?action=ViewWaitingTOPIC&id=<?=$row->tid?>&check=<?=md5(uniqid(rand(),true))?>" target="_blank"><b><?=stripslashes($row->t_title)?></b></a>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="height: 50px; width: 475px; text-align: right"><?=stripslashes(strip_tags($row->t_short))?></td>
		</tr>
		<tr>
			<td style="height: 20px; width: 20px"><input type="checkbox" value="<?=$row->tid?>" name="tid[]"></td>
			<td style="height: 20px; width: 20px"><a title="Edit Topic" href="index.php?section=EditTopic&id=<?=$row->tid?>&active=dashboard"><img src="../images/admin/edit.png"></a></td>
			<td style="height: 20px; width: 20px"><a title="Delete Topic" href="index.php?section=TopicOperation&id=<?=$row->tid?>&active=dashboard"><img src="../images/admin/delete.gif"></a></td>
			<td style="height: 20px; width: 20px"><a title="Empty Topic" href="index.php?section=EmptyTopic&id=<?=$row->tid?>&active=dashboard"><img src="../images/admin/folder_delete.png"></a></td>
			<td style="height: 20px; width: 20px"><a title="Change Topic Approve" href="index.php?section=TopicChangeApprove&id=<?=$row->tid?>&active=dashboard"><img src="../images/admin/<?=$approve?>"></a></td>
			<td style="height: 20px; width: 75px"><a title="View All Posts Following This Topic" href="index.php?section=ShowPosts&in_topic=<?=$row->tid?>&active=dashboard">POSTS (<?=$sum_posts?>)</a></td>
			<td style="height: 20px; width: 75px"><a href="index.php?section=ShowObjects&SORT=top_view&active=dashboards">VIEWS (<?=$row->views?>)</a></td>
			<td style="height: 20px; width: 125px"><a title="View All Topic Following This Dept" href="index.php?section=ShowObjects&in_dept=<?=$row->in_dept?>&active=dashboard">DEPT (<?=$dept_name?>)</a></td>
			<td style="height: 20px; width: 135px"><blink><?=$topic_modified?></blink></td>
			<td style="height: 20px; width: 135px">Add by <a href="index.php?section=ShowObjects&TopicsAddBy=true&t_add_by=<?=$row->t_add_by?>&active=dashboard"><?=$t_add_by?></a></td>
		</tr>
	</table>
	<!-- TOPIC -->
	<hr />