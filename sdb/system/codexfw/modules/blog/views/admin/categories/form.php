<section class="grid_6">
	<div class="block-border">
	    <div class="block-content">
        <?php echo form_open($this->uri->uri_string(), 'class="crud" id="categories"'); ?>        
        
        <?php if ($this->controller == 'admin_categories' && $this->method === 'edit'): ?>
        <h1><?php echo sprintf(lang('cat_edit_title'), $category->title);?></h1>
        
        <?php else: ?>
        <h1><?php echo lang('cat_create_title');?></h1>
        <?php endif; ?>
        
    	<ol>
    		<li class="even">
    		<label for="title"><?php echo lang('cat_title_label');?></label>
    		<?php echo  form_input('title', $category->title); ?>
    		<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    	</ol>
    
    	<div class="buttons">
    		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    	</div>

        <?php echo form_close(); ?>
        </div>
    </div>
</section>