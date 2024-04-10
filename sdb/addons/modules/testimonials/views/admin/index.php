<?php echo form_open('admin/testimonials/delete');?>

<?php if ( ! empty($testimonials)): ?>
	<table border="0" class="table-list">
		<thead>
			<tr>
				<th><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all'));?></th>
				<th><?php echo lang('testimonials.name_label'); ?></th>
				<th><?php echo lang('testimonials.location_label'); ?></th>
				<th><?php echo lang('testimonials.snippet_label'); ?></th>
				<th><?php echo lang('testimonials.actions_label'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="5">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach( $testimonials as $testimonial ): ?>
			<tr>
				<td><?php echo form_checkbox('action_to[]', $testimonial['id']); ?></td>
				<td><?php echo $testimonial['name']; ?></td>
				<td><?php echo $testimonial['location']; ?></td>
				<td><?php echo character_limiter($testimonial['comment'], 50); ?></td>
				<td>
					<?php echo
					anchor('admin/testimonials/edit/' 	. $testimonial['id'], lang('testimonials.edit_label')) 					. ' | ' .
					anchor('admin/testimonials/delete/'	. $testimonial['id'], lang('testimonials.delete_label'), array('class'=>'confirm')); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete') )); ?>

<?php else: ?>
	<div class="blank-slate">
		<img src="<?php echo base_url().'addons/modules/testimonials/img/testimonials.png' ?>" />
		
		<h2><?php echo lang('testimonials.no_testimonials_error'); ?></h2>
	</div>
<?php endif;?>

<?php echo form_close(); ?>