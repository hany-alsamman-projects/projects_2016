
<section class="grid_6">
<BR/>
	<div class="block-content">
		<?php if ($this->method == 'create'): ?>
		<h1><?php echo lang('variables.create_title');?></h1> 
		<?php else: ?>
		<h1><?php echo sprintf(lang('variables.edit_title'), $variable->name);?></h1>
		<?php endif; ?>
		<?php echo form_open($this->uri->uri_string(), 'class="crud" id="variables"'); ?>
		<?php if ($this->method == 'edit') echo form_hidden('variable_id', $variable->id); ?>

		<ul>
			<li class="even">
				<label for="name"><?php echo lang('variables.name_label');?></label>
				<?php echo  form_input('name', $variable->name); ?>
				<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
			</li>
			<li class="">
				<label for="data"><?php echo lang('variables.data_label');?></label>
				<?php echo  form_input('data', $variable->data); ?>
			</li>
		</ul>

		<div class="buttons float-right padding-top">
			<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel') )); ?>
		</div>

	</div>
	<?php echo form_close(); ?>
</section>
