<h3><?php echo lang('testimonials.edit_testimonial_label'); ?></h3>



<?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>

	<ul>

		<li class="<?php echo alternator('', 'even'); ?>">

			<label for="name"><?php echo lang('testimonials.name_label'); ?></label>

			<input type="text" id="name" name="name" maxlength="50" value="<?php echo $testimonials['name']; ?>" />

		</li>

		<li class="<?php echo alternator('', 'even'); ?>">

			<label for="location"><?php echo lang('testimonials.location_label'); ?></label>

			<input type="text" id="location" name="location" maxlength="100" value="<?php echo $testimonials['location']; ?>" />

		</li>

		<li class="<?php echo alternator('', 'even'); ?>">

			<label for="comment"><?php echo lang('testimonials.comment_label'); ?></label>

			<?php echo form_textarea(array('id'=>'comment', 'name'=>'comment', 'value' => $testimonials['comment'], 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>

		</li>

		<li class="<?php echo alternator('', 'even'); ?>">

			<label for="delete"><?php echo lang('testimonials.delete_label'); ?></label>

			<?php echo form_checkbox('delete', '1', FALSE); ?>

		</li>

	</ul>



	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>

<?php echo form_close(); ?>