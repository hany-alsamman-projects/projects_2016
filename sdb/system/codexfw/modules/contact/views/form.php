<div id="c_us_form">
<?php if (validation_errors()): ?>
<div class="error-box">
	<?php echo validation_errors(); ?>
</div>
<?php elseif (isset($messages['error'])): ?>
<div class="error-box">
	<p><?php echo $messages['error']; ?></p>
</div>
<?php endif; ?>
<?php echo form_open(current_url());?>
<div id="comment_form_lable">
	<p>    
		<label for="contact_name"><?php echo lang('contact_name_label');?></label>	
	</p>
	<p>
		<label for="contact_email"><?php echo lang('contact_email_label');?></label>
	</p>
	<p>
		<label for="company_name"><?php echo lang('contact_company_name_label');?></label>		
	</p>
    	<p>
		<label for="subject"><?php echo lang('contact_subject_label');?></label>		
	</p>
	<p>
		<label for="message"><?php echo lang('contact_message_label'); ?></label>		
	</p>
 </div>
    <div id="comment_form_input">
    <p>
    <?php echo form_input('contact_name', $form_values->contact_name, 'id="contact_name"');?>
    </p>
    <p>
    <?php echo form_input('contact_email', $form_values->contact_email, 'id="contact_email"');?>
    </p>
  	<p>
    <?php echo form_input('company_name', $form_values->company_name, 'id="company_name"');?>
      </p>	  
        <p>
        <?php echo form_dropdown('subject', $subjects, $form_values->subject, 'id="subject"'); ?>
        </p>	
          <p>
         <?php echo form_textarea ('message', $form_values->message, 'id="message"'); ?>
          </p>  
    </div>
	<p  id="comment_form_submet">
		<input type="submit" value="<?php echo lang('contact_send_label') ?>" name="btnSubmit" />
	</p>
    
<?php echo form_close(); ?>
</div>