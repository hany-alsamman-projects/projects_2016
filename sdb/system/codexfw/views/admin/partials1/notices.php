<?php if ($this->session->flashdata('error')): ?>
<div class="closable notification error">
	<?php echo $this->session->flashdata('error'); ?>
</div>
<?php endif; ?>

<?php if (validation_errors()): ?>
<div class='message notice'><span class='close-bt'></span>
	<?php echo validation_errors(); ?>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['error'])): ?>
<div class='message error'><span class='close-bt'></span>
	<?php echo $messages['error']; ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('notice')): ?>
<div class="closable notification attention">
	<?php echo $this->session->flashdata('notice');?>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['notice'])): ?>
<div class='message notice'><span class='close-bt'></span>
	<?php echo $messages['notice']; ?>
</div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
<div class='message success'><span class='close-bt'></span>
	<?php echo $this->session->flashdata('success'); ?>
</div>
<?php endif; ?>

<?php if ( ! empty($messages['success'])): ?>
<div class="closable notification success">
	<?php echo $messages['success']; ?>
</div>
<?php endif; ?>