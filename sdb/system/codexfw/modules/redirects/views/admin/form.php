<?php if($this->method == 'add'): ?>
<section class="grid_6">
<div class="block-border">
    <div class="block-content">
        <h1><?php echo lang('redirects.add_title');?></h1>
        <?php else: ?>
	<h3><?php echo lang('redirects.edit_title');?></h3>
<?php endif; ?>

       <?php echo form_open(uri_string(), 'class="crud"'); ?>
	<ul>
	<li>
		<label for="from"><?php echo lang('redirects.from');?></label>
		<?php echo form_input('from', $redirect->from);?>
	</li>
	<li>
		<label for="to"><?php echo lang('redirects.to');?></label>
		<?php echo form_input('to', $redirect->to);?>
	</li>
	</ul>

	<div class="buttons float-right padding-top">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
	</div>

<?php echo form_close(); ?>
    </div>
</div>
</section>