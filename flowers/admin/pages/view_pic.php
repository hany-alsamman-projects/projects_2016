		<!-- PIC -->
		<table cellpadding="3" cellspacing="0" style="width: 100%; margin-bottom:10px">
			<tr>
			<td style="height: 20px; width: 20px"><input type="checkbox" value="<?=$row->id?>" name="id[]"></td>
			<td style="height: 20px; width: 20px"><a title="Edit Picture" href="index.php?section=EditPic&id=<?=$row->id?>"><img src="images/admin/edit.png"></a></td>
			<td style="height: 20px; width: 20px"><a title="Delete Picture" href="index.php?section=PicOperation&id=<?=$row->id?>"><img src="images/admin/delete.gif"></a></td>
			<td style="height: 20px; width: 20px"><a title="Picture Change Approve" href="index.php?section=PicChangeApprove&id=<?=$row->id?>"><img src="images/admin/<?=$approve?>"></a></td>
				<td style="height: 20; width: 275">By <?=parent::truncate(trim($row->author_name),5, ' ...') ?> (<?=$row->author_email?>)
				From (<?=parent::get_date($row->insert_date)?>)</td>
				<td style="height: 20; width: 220; text-align: right"><?=parent::truncate($row->pic_name,10, ' ...')?></td>
			</tr>
		</table>
		<!-- PIC -->