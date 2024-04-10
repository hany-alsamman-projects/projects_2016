<?php if ($groups): ?>
<section class="grid_9">
			<div class="block-border"><form class="block-content form" id="table_form" method="post" action="">
				<h1>list Group</h1>
				
				<div class="block-controls">
					
					<ul class="controls-buttons">
					<?php $this->load->view('admin/partials/pagination'); ?>
					<li class="sep" ></li>
					</ul>
					
				</div>
			
				<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				
					<thead>
						<tr>
							<th class="black-cell"><span class="loading"></span></th>
							<th width="40%"><?php echo lang('groups.name');?></th>
								<!--
								<th scope="col">
								<span class="column-sort">
								
									<a href="#" title="Sort up" class="sort-up active"></a>
									<a href="#" title="Sort down" class="sort-down"></a>
								</span>
								</th>
								-->
															
							<th><?php echo lang('groups.short_name');?></th>
							<th width="200" class="align-center"><?php echo lang('action_label'); ?></th>
						</tr>
						
					</thead>
					
					<tbody>
						
						<tr>
						<?php foreach ($groups as $group):?>
							<th scope="row" class="table-check-cell" style="height: 59px"><input type="checkbox" name="selected[]" id="table-selected-1" value="1"></th>
							<td><?php echo $group->description; ?></td>
				
							<td style="height: 59px"><?php echo $group->name; ?></td>
							<td class="table-actions" style="height: 59px">
							<?php echo anchor('admin/groups/edit/'.$group->id, lang('groups.edit'), 'class="button edit"'); ?>
							<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
					        <?php echo anchor('admin/groups/delete/'.$group->id, lang('groups.delete'), 'class="confirm button delete"'); ?>
					        <?php endif; ?>

			
							<!--
								<a href="#" title="Edit" class="with-tip"><img src="images/icons/fugue/pencil.png" width="16" height="16"></a>
								<a href="#" title="Delete" class="with-tip"><img src="images/icons/fugue/cross-circle.png" width="16" height="16"></a>
							-->
							</td>
						</tr>
						
							<?php endforeach;?>				
					</tbody>
				
				</table></div>
				
								
								
			</form></div>
			
		</section>
<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('groups.no_groups');?></h2>
	</div>
<?php endif;?>
