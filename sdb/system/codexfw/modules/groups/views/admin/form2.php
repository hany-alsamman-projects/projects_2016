<section class="grid_9">
<div class="block-border">
    <div class="block-content">
    
    <?php if ($this->method == 'edit'): ?>
        <h1><?php echo sprintf(lang('groups.edit_title'), $group->name); ?></h1>
    <?php else: ?>
        <h1>add work</h1>
    <?php endif; ?>

    <?php echo form_open(uri_string(), 'class="crud"'); ?>
        <ul>
    		<li>
    			<label for="description">name of work : </label>
    			<?php echo form_input('description', $group->description);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name">picture</label>
                
    
    			<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
    			<?php echo form_input('name', $group->name);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
 
    			<?php else: ?>
    			<p><?php echo $group->name; ?></p>
    			<?php endif; ?>
                   <input type='file'  />
    		</li>
                		<li>
    			<label for="description"> description:</label>
    			<?php echo form_input('description', $group->description);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name">date </label>
    
    			<?php if ( ! in_array($group->name, array('user', 'admin'))): ?>
    			<?php echo form_input('name', $group->name);?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    
    			<?php else: ?>
    			<p><?php echo $group->name; ?></p>
    			<?php endif; ?>
    		</li>
            
        </ul>
  
        
        <br class="clear-both" />
    	
    <?php echo form_close();?>

        <div class="block-content">
    <h1>cast</h1>
    <p>    <div class="col200pxL-left">
     
   
     
    <!-- Use the class js-tabs to enable JS tabs script -->
    <ul class="side-tabs js-tabs same-height">
        <li><a href="#tab-global" title="Global properties">artist</a></li>
        <li><a href="#tab-settings" title="Language settings">directors</a></li>
        <li><a href="#tab-relations" title="Relations">manigers</a></li>
        <li><a href="#tab-history" title="History">makeup</a></li>
        <li><span>other</span></li>

    </ul>
     
</div>

<div class="col200pxL-right">
    <div id="tab-global" class="tabs-content" style="height:300px;">
        <table class="table" cellspacing="0" width="100%">
    <thead>
        <tr>
          <th width="40%" scope="col">
  
                name
            </th>
            <th width="15%" scope="col">age</th>
            <th width="39%" scope="col">works he have</th>
            <th width="6%" scope="col">
           
                picture
            </th>
    </thead>
    <tfoot>
    </tfoot>   
    <tbody>
            <td>Lorem ipsum sit amet</td>
            <td><ul class="keywords">
            </ul></td>
            <td><a href="#"><small><img src="images/icons/fugue/image.png" width="16" height="16" class="picto"> jpg | 12 Ko</small></a></td>
            <td><div style="width:30px; height:20px; border:groove 1px #fff; margin:0 auto 0 auto"></div></td>
        </tr>  
    </tbody>
</table>
    </div></p>
</div>

     
    <div id="tab-settings" class="tabs-content">
        artist
    </div>
     
    <div id="tab-relations" class="tabs-content">
      sssssssssssss
    </div>
     
    <div id="tab-history" class="tabs-content">
       dddddddddddddddddddddddd
    </div>
         	<div class="float-right">
    		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
    	</div>
</div>	

      
<script type="text/javascript">
	jQuery(function($) {
		$('form input[name="description"]').keyup($.debounce(300, function(){

			var slug = $('input[name="name"]');
            
            slug.val( slug.replace(" ", "-") );

//			$.post(SITE_URL + 'ajax/url_title', { title : $(this).val() }, function(new_slug){
//				slug.val( new_slug );
//			});
		}));
	});
</script>