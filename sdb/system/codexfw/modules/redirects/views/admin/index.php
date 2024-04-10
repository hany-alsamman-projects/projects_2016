<?php if ($redirects): ?>
<section class="grid_9">
			<div class="block-border"><div class="block-content">
			
			 <?php echo form_open('admin/redirects/delete'); ?>

				<h1>Redirects</h1>
				
				
				<div class="block-controls">
					<ul class="controls-buttons">
				    </ul>
	
				</div>
			
				<div class="no-margin"><table class="table" cellspacing="0" width="100%">
				
					<thead>
					
						<tr>
							<th class="black-cell"><?php echo form_checkbox('action_to_all');?></th>
							<th scope="col"><?php echo lang('redirects.from');?></th>
							<th scope="col"><?php echo lang('redirects.to');?></th>
							
							<th scope="col" class="table-actions"><?php echo lang('action_label'); ?></th>
						</tr>
						
					</thead>
					
					<tbody>
						<?php foreach ($redirects as $redirect): ?>
						<tr>
							<th scope="row" class="table-check-cell"><?php echo form_checkbox('action_to[]', $redirect->id); ?></th>
							<td><?php echo $redirect->from;?></td>
							<td><?php echo $redirect->to;?></td>							
							<td class="table-actions">
							 <?php echo anchor('admin/redirects/edit/' . $redirect->id, lang('redirects.edit'), 'class="button edit"');?>
							<?php echo anchor('admin/redirects/delete/' . $redirect->id, lang('redirects.delete'), array('class'=>'confirm button delete'));?>
							</td>
						</tr>
						<?php endforeach; ?>
						
					</tbody>
				
				</table></div>
								
				<div class="block-footer">
										
					<div class="buttons align-right padding-top">
		                  <?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>
					</div>
				</div>
					
			<?php echo form_close(); ?>
			
			</div>
			
			</div>
</section>
		

<?php else: ?>
	<div class="blank-slate">
		<h2><?php echo lang('redirects.no_redirects');?></h2>
			</div>
<?php endif; ?>