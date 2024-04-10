<div id="entry_form_box">



	<h3><?php echo lang('testimonials.new_testimonial_label'); ?></h3>



	<?php echo form_open_multipart($this->uri->uri_string(), 'class="crud"'); ?>

		<ol>

			<li class="<?php echo alternator('', 'even'); ?>">

				<label for="name"><?php echo lang('testimonials.name_label'); ?></label>

				<input type="text" id="name" name="name" maxlength="50" value="<?php echo $testimonials['name']; ?>" />

				<span class="required-icon tooltip">Required</span>

			</li>



			<li class="<?php echo alternator('', 'even'); ?>">

				<label for="location"><?php echo lang('testimonials.location_label'); ?></label>

				<?php echo form_input('location', $testimonials['location'], 'class="width-15"'); ?>

			</li>



			<li  class="<?php echo alternator('', 'even'); ?> comment">

				<label for="comment"><?php echo lang('testimonials.comment_label'); ?></label>

				<?php echo form_textarea(array('id'=>'comment', 'name'=>'comment', 'value' => $testimonials['comment'], 'rows' => 10, 'class' => 'wysiwyg-simple')); ?>

				<span class="required-icon tooltip">Required</span>

			</li>

		</ol>



		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>

	

	<?php echo form_close(); ?>



</div>