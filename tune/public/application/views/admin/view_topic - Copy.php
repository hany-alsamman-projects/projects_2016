	<!-- TOPIC -->
	<table cellpadding="3" cellspacing="0" style="width: 100%; margin-left: 15px; margin-bottom:10px">
		<tr>
			<td rowspan="3" style="width: 100px; height: 100px;">
			
			<div style="margin-bottom:10px">
			<strong>Start Date:</strong> <br>
			<?=date("M j, g:i a",$row->start_date)?>
			</div>
			
			<div>
			<a href="#" onmouseover="showtrail('../images/admin/tumble/<?=$row->t_pic?>','<?=stripslashes($row->t_title)?>',250,150)" onmouseout="hidetrail();">
			PEVIEW PICTURE
			</a>
			</div>
			
			</td>
			<td colspan="10" style="height: 10px; text-align: left">
			<a style="color: blue" href="../index.php?action=ViewWaitingTOPIC&id=<?=$row->tid?>&check=<?=md5(uniqid(rand(),true))?>" target="_blank"><b><?=stripslashes($row->t_title)?></b></a>
			</td>
		</tr>
		<tr>
			<td colspan="10" style="height: 50px; width: 475px; text-align: left"><?=stripslashes(strip_tags($row->t_short))?></td>
		</tr>
		<tr>
			<td style="height: 20px; width: 20px"><input type="checkbox" value="<?=$row->tid?>" name="tid[]"></td>
			<td style="height: 20px; width: 20px"><a title="Edit Topic" href="index.php?section=EditTopic&id=<?=$row->tid?>&active=topics"><img src="images/icons/fugue/pencil.png"></a></td>
			<td style="height: 20px; width: 20px"><a title="Delete Topic" href="index.php?section=TopicOperation&id=<?=$row->tid?>&active=topics"><img src="images/icons/fugue/cross-circle.png"></a></td>
<!--            
			<td style="height: 20px; width: 20px"><a title="Empty Topic" href="index.php?section=EmptyTopic&id=<?=$row->tid?>&active=topics"><img src="images/icons/fugue/folder-open-document-text.png"></a></td>
            <td style="height: 20px; width: 75px"><a title="View All Posts Following This Topic" href="index.php?section=ShowPosts&in_topic=<?=$row->tid?>&active=topics">POSTS (<?=$sum_posts?>)</a></td>
-->
			<td style="height: 20px; width: 20px"><a title="Change Topic Approve" href="index.php?section=TopicChangeApprove&id=<?=$row->tid?>&active=topics"><img src="images/icons/fugue/<?=$approve?>"></a></td>
			
			<td style="height: 20px; width: 75px"><a href="index.php?section=ShowObjects&SORT=top_views&active=topics">VIEWS (<?=$row->views?>)</a></td>
			<td style="height: 20px; width: 125px"><a title="View All Topic Following This Dept" href="index.php?section=ShowObjects&in_dept=<?=$row->in_dept?>">DEPT (<?=$dept_name?>)</a></td>
			<td style="height: 20px; width: 135px">Added by <a href="index.php?section=ShowObjects&TopicsAddBy=true&t_add_by=<?=$row->t_add_by?>&active=topics"><?=$t_add_by?></a></td>
		</tr>
	</table>
	<!-- TOPIC -->
	<hr />