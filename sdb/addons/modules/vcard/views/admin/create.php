
<script type="text/javascript">
jQuery(function($) {
	 $("#vcard_datepicker").datepicker({
	   dateFormat: 'yy',changeYear: true, changeMonth: true, yearRange: '1980:2011',showOn: "button"
     });
});
</script>
<section class="grid_8">
<div class="block-border">
    <div class="block-content">
    
    <?php if ($this->method == 'edit'): ?>
        <h1><?php echo sprintf(lang('vcard.edit_title'), $vcard->name); ?></h1>
    <?php else: ?>
        <h1>add vcard</h1>
    <?php endif; ?>

    <?php echo form_open($this->uri->uri_string(), 'class="crud"'); ?>
        <ul>
    		<li>
    			<label for="description">name of work : </label>
    			<?php echo form_input('name', $vcard->name);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name">picture</label>
                <?php echo form_input('picture', $vcard->description);?><?php echo anchor('/admin/files#!path=vcards' , 'Upload', 'class="button" target="_blank"'); ?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
           
            <li>
    			<label for="description"> description:</label>
 
 
                <?php echo form_textarea(array('id'=>'description', 'name'=>'description', 'value' => $vcard->description, 'rows' => 10, 'class' => 'half-width')); ?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name">date </label>
                <?php echo form_input('date', date('Y'), 'maxlength="10" id="vcard_datepicker" class="text width-20"'); ?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
            
        </ul>
          
    	<div class="buttons">
    		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    	</div>
        
    </div>
    
    
     <?php echo form_close();?>
 </div>	
</section>

<section class="grid_4">
<div class="block-border">
    <div class="block-content">
        <h1>vcard cast</h1>
        <p>                                
            <dl class="accordion">
                <dt><span class="number">1</span> First step</dt>
                <dd>create a vcard ... simply</dd>
                 
                <dt><span class="number">2</span> Second step</dt>
                <dd>go to vcard list and edit the created one</dd>
                 
                <dt><span class="number">3</span> Third step</dt>
                <dd>No think else</dd>
            </dl>
        </p>
        
    </div>
</div>
</section>
    