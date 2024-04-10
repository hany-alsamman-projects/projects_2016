		<!-- POST -->
		<table cellpadding="3" cellspacing="0" style="width: 100%; margin-bottom:10px">
			<tr>
				<td colspan="5" style="height: 10px; text-align:right"><?=stripslashes($row->title)?></td>
			</tr>
			<tr>
				<td colspan="5" style="height: 50px; width: 575px; text-align:right"><?=stripslashes($row->post)?></td>
			</tr>
			<tr>
			<td style="height: 20px; width: 20px"><input type="checkbox" value="<?=$row->pid?>" name="pid[]"></td>
			<td style="height: 20px; width: 20px"><a title="ÊÚÏíá ÑÏ" href="index.php?section=EditPost&id=<?=$row->pid?>"><img src="../images/admin/edit.png"></a></td>
			<td style="height: 20px; width: 20px"><a title="ÍÐÝ ÑÏ" href="index.php?section=DeletePost&id=<?=$row->pid?>"><img src="../images/admin/delete.gif"></a></td>
			<td style="height: 20px; width: 20px"><a title="ÊÛííÑ ÍÇáÉ ÇáÑÏ" href="index.php?section=ChangeApprove&id=<?=$row->pid?>"><img src="../images/admin/<?=$approve?>"></a></td>
				<td style="height: 20px; width: 475px">ÇÖÇÝÉ ãä <?=parent::truncate(stripslashes($row->author_name),10, ' ...')?> æÊÊÈÚ ÇáãæÖæÚ ( <a title="ÇÙåÇÑ ÌãíÚ ÇáÑÏæÏ ÇáÊí ÊÊÈÚ åÐÇ ÇáãæÖæÚ" href="index.php?section=ShowPosts&in_topic=<?=$row->in_topic?>"><?=parent::truncate(stripslashes($topic_title),50, ' ...')?></a> )</td>
			</tr>
		</table>
		<!-- POST -->