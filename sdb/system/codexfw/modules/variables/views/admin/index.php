<?php if ($variables): ?>
<section class="grid_12">
			<div class="block-border"><div class="block-content">
			
			<?php echo form_open('admin/variables/delete'); ?>

				<h1><?php echo lang('variables.list_title');?></h1>
				
				
				<div class="block-controls">
					<ul class="controls-buttons">
				    </ul>
	
				</div>
			
				<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				
					<thead>
					
						<tr>
							<th class="black-cell"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
							<th scope="col"><?php echo lang('variables.name_label');?></th>
							<th scope="col"><?php echo lang('variables.data_label');?></th>
							<th scope="col"><?php echo lang('variables.syntax_label');?></th>
							<th scope="col" class="table-actions"><?php echo lang('variables.actions_label');?></th>
						</tr>
						
					</thead>
					
					<tbody>
						<?php foreach ($variables as $variable): ?>
						<tr>
							<th scope="row" class="table-check-cell"><?php echo form_checkbox('action_to[]', $variable->id); ?></th>
							<td><?php echo $variable->name;?></td>

							<td><?php echo $variable->data;?></td>
							<td><?php form_input('', printf('{%s:variables:%s}', config_item('tags_trigger'), $variable->name));?></td>
							<td class="table-actions">
								<?php echo anchor('admin/variables/edit/' . $variable->id, lang('buttons.edit'), 'rel="ajax-eip" class="button edit"'); ?>
						<?php echo anchor('admin/variables/delete/' . $variable->id, lang('buttons.delete'), array('class'=>'confirm button delete')); ?>
							</td>
						</tr>
						<?php endforeach; ?>
						
					</tbody>
				
				</table></div>
								
				<div class="block-footer">
										
					<div class="buttons float-right padding-top">
			        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
		            </div>
				</div>
					
			<?php echo form_close(); ?> 
			
			</div>
			
			</div>
</section>
		

<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('variables.no_variables');?></h2>
	</div>
<?php endif; ?>