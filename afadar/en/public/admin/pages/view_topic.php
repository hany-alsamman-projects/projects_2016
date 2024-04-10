	<!-- TOPIC -->
	<table cellpadding="3" cellspacing="0" style="width: 100%; margin-bottom:10px">
		<tr>
			<td rowspan="3" style="width: 100px; height: 100px;">

			<img width="80" height="80" title="<?=stripslashes($row->t_title)?>" src="../images/tumble/<?=$row->t_pic?>" >

			</td>
			<td colspan="7" style="height: 10px; text-align: right"><b><?=stripslashes($row->t_title)?></b></td>
		</tr>
		<tr>
			<td colspan="7" style="height: 50px; width: 475px; text-align: right"><?=stripslashes(strip_tags($row->t_short))?></td>
		</tr>
		<tr>
			<td style="height: 20px; width: 20px"><input type="checkbox" value="<?=$row->tid?>" name="tid[]"></td>
			<td style="height: 20px; width: 20px"><a href="index.php?section=EditTopic&id=<?=$row->tid?>">
			<img src="../images/admin/edit.png" alt="ÊÚÏíá ÇáãæÖæÚ"></a></td>
			<td style="height: 20px; width: 20px"><a  href="index.php?section=TopicOperation&id=<?=$row->tid?>"><img alt="ÍĞİ ÇáãæÖæÚ" src="../images/admin/delete.gif"></a></td>
			<td style="height: 20px; width: 20px"><a href="index.php?section=TopicChangeApprove&id=<?=$row->tid?>"><img alt="ÊÛííÑ ÍÇáÉ ÇáãæÖæÚ" src="../images/admin/<?=$approve?>"></a></td>
			<td style="height: 20px; width: 70px"><a alt="ÚÑÖ ßá ÇáÑÏæÏ ÇáÊÇÈÚÉ áåĞÇ ÇáãæÖæÚ" href="index.php?section=ShowPosts&in_topic=<?=$row->tid?>">ÇáÑÏæÏ <?=$sum_posts?></a></td>
			<td style="height: 20px; width: 93px"><a href="index.php?section=ShowTopics&SORT=top_views">ÇáãÔÇåÏÇÊ <?=$row->views?></a></td>
			<td style="height: 20px; width: 335px"><a alt="ÚÑÖ ÌãíÚ ÇáãæÇÖíÚ ÇáÊÇÈÚÉ áåĞÇ ÇáŞÓã" href="index.php?section=ShowTopics&in_dept=<?=$row->in_dept?>">ÇáŞÓã (<?=$dept_name?>)</a></td>
		</tr>
	</table>
	<!-- TOPIC -->
	<hr />