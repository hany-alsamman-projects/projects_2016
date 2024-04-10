<?php echo form_open('comments/create/' . $module . '/' . $id); ?>
	<?php echo form_hidden('redirect_to', $this->uri->uri_string()); ?>
	<noscript><?php echo form_input('d0ntf1llth1s1n', '', 'style="display:none"'); ?></noscript>

<?php if ( ! $this->user): ?>



<div id="comment_form_lable">
	<p>
		<label for="name"><?php echo lang('comments.name_label'); ?>:</label>
	</p>
	<p>
		<label for="email"><?php echo lang('comments.email_label'); ?>:</label>
	</p>
	<p>
		<label for="website"><?php echo lang('comments.website_label'); ?>:</label>
	</p>
  
    </div><!--end of coment form lable-->
    <div id="comment_form_input">
    	<p>
		<input type="text" name="name" id="name" maxlength="40" value="<?php echo $comment['name'] ?>" />
	</p>
	<p>
		<input type="text" name="email" maxlength="40" value="<?php echo $comment['email'] ?>" />
	</p>
	<p>
		<input type="text" name="website" maxlength="40" value="<?php echo $comment['website'] ?>" />
	</p>
   
    </div><!--end of coment form input -->
<?php endif; ?>
<div id="comment_form_lable">
	
	  <p>
		<label for="message"><?php echo lang('comments.message_label'); ?>:</label>
    </p>
    </div>
      <div id="comment_form_input">
 <p>
			<textarea name="comment" id="message" rows="5" cols="30" class="width-full"><?php echo $comment['comment'] ?></textarea>
    </p>
    </div>
	<p id="comment_form_submet"><?php echo form_submit('btnSend', lang('comments.send_label'), "class=status_submit"); ?></p>
<?php echo form_close(); ?>