
<div id="login">

<h2 class="page-title" id="page_title"><?php echo lang('user_login_header') ?></h2>

<?php if (validation_errors()): ?>
<div class="error_box">
	<?php echo validation_errors();?>
</div>
<?php endif; ?>

<?php echo form_open('users/login', array('id'=>'login')); ?>
<?php if (isset($redirect_hash) && $redirect_hash): ?>
<?php echo form_hidden('redirect_hash', $redirect_hash); ?>
<?php endif; ?>
<ul>
<div style="width: 100%;">
	<li style="width: 100px ;float:right;">
		<label for="email"><?php echo lang('user_email'); ?></label>
        <br/>
          <br/>
		<label for="password"><?php echo lang('user_password'); ?></label>
	</li>
	<li style="width: 300px ;float:right">
		<input type="text" id="email" name="email" maxlength="120" />
        <br/>
         <br/>
		<input type="password" id="password" name="password" maxlength="20" />

	</li>
    </div>
	<li id="remember_me">
		<?php echo form_checkbox('remember', '1', FALSE); ?><?php echo lang('user_remember')?>
	</li>
	<li class="form_buttons">
		<input type="submit" value="<?php echo lang('user_login_btn') ?>" name="btnLogin" /> | <?php echo anchor('register', lang('user_register_btn'));?>

	</li>
           
	<li id="forget">
		 <?php echo anchor('users/reset_pass', lang('user_reset_password_link'));?>
	</li>
</ul>
<?php echo form_close(); ?>
</div>