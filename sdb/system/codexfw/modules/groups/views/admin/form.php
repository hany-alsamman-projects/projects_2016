<section class="grid_6">
<div class="block-border">
    <div class="block-content">
    
    <?php if ($this->method == 'edit'): ?>
        <h1><?php echo sprintf(lang('groups.edit_title'), $group->name); ?></h1>
    <?php else: ?>
        <h1><?php echo lang('groups.add_title'); ?></h1>
    <?php endif; ?>

    <?php echo form_open(uri_string(), 'class="crud"'); ?>
        <ul>
    		<li>
    			<label for="description"><?php echo lang('groups.name');?>:</label>
    			<?php echo form_input('description', $group->description);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name"><?php echo lang('groups.short_name');?></label>
    
    			<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
    			<?php echo form_input('name', $group->name);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    
    			<?php else: ?>
    			<p><?php echo $group->name; ?></p>
    			<?php endif; ?>
    		</li>
        </ul>
    
    	<div class="float-right">
    		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    	</div>
        
        <br class="clear-both" />
    	
    <?php echo form_close();?>

    
<script type="text/javascript">
	jQuery(function($) {
		$('form input[name="description"]').keyup($.debounce(300, function(){

			var slug = $('input[name="name"]');

			$.post(SITE_URL + 'ajax/url_title', { title : $(this).val() }, function(new_slug){
				slug.val( new_slug );
			});
		}));
	});
</script>