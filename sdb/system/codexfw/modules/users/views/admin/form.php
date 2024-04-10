<script type="text/javascript" src="system/codexfw/assets/js/uploader/swfobject.js"></script>
<script type="text/javascript" src="system/codexfw/assets/js/uploader/jquery.uploadify.v2.1.4.min.js"></script>
<link href="system/codexfw/assets/css/uploadify.css" rel="stylesheet" type="text/css">  

<script type="text/javascript">
jQuery(function($) {
	$("#main").uploadify({
	    'fileDataName'   : 'Filedata',
		'uploader'       : 'system/codexfw/assets/js/uploader/uploadify.swf',
		'script'         :  SITE_URL + 'ajax/ajax_upload',
		'cancelImg'      : 'system/codexfw/assets/img/admin/icons/16/cross-circle.png',
        'fileExt'        : '*.flv;*.jpg;*.gif;*.png',
		'folder'         : '/uploads/files',
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : false,
        'onCancel'       : function(event, ID, fileObj) { $("input[name=gravatar]").val(""); },
        'onComplete'     : function(event, ID, fileObj) { 
            $("input[name=gravatar]").val(""+fileObj.name+""); 
            $("#delete_pic").fadeIn(1500).show()
            }
        
	});
    
    
    $("#delete_pic img").live('click', function(){
        
        $(this).fadeOut('slow', function() {

            //Remove the link                  
            $(this).remove();

            //Erase the input value   
            $("input[name=gravatar]").val("");
            
            //Pass the folder ID and file name
            var Foldername = ''; 

            //Remove the picture passed from the database and folder 
            RemoveData(this,Foldername);
            
            

        });
        return false;
    });
    
    function RemoveData(id,Folder)
    {        
        $.post( SITE_URL + "ajax/ajax_upload?get=removefile&id="+id+"&folder="+Folder+"", function(data) {
            //if(data != '1') alert('The Selected file not found');
            alert(data);
        });
    }
    
});
</script>

		<section class="grid_9">
			<div class="block-border">
                       
            <?php echo form_open($this->uri->uri_string(), 'class="block-content form"'); ?>
            
                      
            
				<h1>
                    <?php if ($this->method == 'create'): ?>
                    	<?php echo lang('user_add_title');?>
                    
                    <?php else: ?>
                    	<?php echo sprintf(lang('user_edit_title'), $member->full_name);?>
                    <?php endif; ?>
                </h1>
				
                
                <div class="block-controls">
                    <!-- Use the class js-tabs to enable JS tabs script -->
                    <ul class="controls-tabs js-tabs with-children-tip">
                        <li class="current"><a href="#tab-general" title="General"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Modify.png" width="24" height="24"></a></li>
                        <li><a href="#tab-profile" title="Profile"><img src="system/codexfw/assets/img/admin/icons/web-app/24/Profile.png" width="24" height="24"></a></li>
                    </ul>
                </div>
                 
                <div id="tab-general">
				
				<fieldset>
					
                    <?php
                    
//                    if(isset($_POST['sub_ok']) && $ok == true){                                    
//                        print '<ul class="message success no-margin"><li>The new page ('.$_POST['title'].') was <strong>created</strong> successfully !</li></ul>';
//                    
//                    }elseif(isset($_POST['sub_ok']) && $ok == false){
//                        print '<ul class="message error no-margin"><li>This is an <strong>error message</strong>, Please fill all fields below</li></ul>';
//                    }
                    
                    ?>					
					                                    
                    <p>
                        <label for="field1"><?php echo lang('user_first_name_label');?></label>
                        <?php echo form_input( array('name' => 'first_name','class' => 'half-width','value' => $member->first_name) ) ?>
                    </p>
                    
                    
                    <p>
                        <label for="field1"><?php echo lang('user_last_name_label');?></label>
                        <?php echo form_input( array('name' => 'last_name','class' => 'half-width','value' => $member->last_name) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Picture</label>                        
                        <?php echo form_input( array('name' => 'gravatar','class' => 'half-width','value' => !empty($member->gravatar) ? $member->gravatar : ''  ) ) ?> 
                        <a id="delete_pic" style="display: none;" href="#"><img src="system/codexfw/assets/img/admin/icons/16/cross-circle.png" /></a>
                        <?php //echo anchor('/admin/files#!path=users' , 'Upload', 'class="button" target="_blank"'); ?>
                        
                    <div style="margin-top: 15px;">
                    <p><input name="main" type="file1" id="main" class="textBox" /> <a href="javascript:jQuery('#main').uploadifyUpload();">Upload</a></p></div>
                    
                    <div id="fileQueue" style="margin-bottom: 15px;"></div>                       
                    </p>                    
                                        
                    <p>
                        <label for="field1"><?php echo lang('user_email_label');?></label>
                        <?php echo form_input( array('name' => 'email','class' => 'half-width','value' => $member->email) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1" class="required"><?php echo lang('user_username');?></label>
                        <?php echo form_input( array('name' => 'username','class' => 'half-width','value' => $member->username) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1"><?php echo lang('user_display_name');?></label>
                        <?php echo form_input( array('name' => 'display_name','class' => 'half-width','value' => $member->display_name) ) ?>
                    </p>
                                      
                    
    				<fieldset class="grey-bg no-margin">
    					<legend><?php echo lang('user_group_label');?></legend>
    					<p class="input-with-button">  
                            <?php echo form_dropdown('group_id', array(0 => lang('select.pick')) + $groups_select, $member->group_id); ?>
    					</p>
    				</fieldset>                    
                    

                    
    			<div class="columns">
    				<div class="colx2-left">                    
						<label for="simple-action">Active</label>
						<input type="checkbox" name="active" id="complex-switch-on" value="<? if(isset($member->active) && $this->method == 'edit' && $member->active == 1) echo '1'?>"  <? if($this->method == 'edit' && $member->active == 1) echo 'checked="checked"' ?> class="switch with-tip" title="Main/Sub switch">                     
    				</div>
    				<p class="colx2-right">                    
    						<label for="simple-action">User Power</label>
    						<select name="user_power" id="simple-action">
        						<?php if ($member->user_power != 2): ?>
        						<option value="1" selected="true">Limited User</option>
                                <option value="2">Plus User</option>
        						<?php endif; ?>  
                                 
        						<?php if ($member->user_power == 2): ?>
        						<option value="1">Limited User</option>
                                <option value="2" selected="true">Plus User</option>
        						<?php endif; ?>  
                                
        						<?php if ($this->method == 'create'): ?>
        						<option value="1">Limited User</option>
                                <option value="2">Plus User</option>
        						<?php endif; ?> 
    						</select>
    				</p>
    			</div>	   
            
    			<div class="columns">
    				<div class="colx2-left">                    
						<label for="password"><?php echo lang('user_password_label');?></label>
						<?php echo form_password('password'); ?>
						<?php if ($this->method == 'create'): ?>
						<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
						<?php endif; ?>                        
    				</div>
    				<p class="colx2-right">                    
  						<label for="confirm_password"><?php echo lang('user_password_confirm_label');?></label>
						<?php echo form_password('confirm_password'); ?>
						<?php if ($this->method == 'create'): ?>
						<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
						<?php endif; ?>
    				</p>
    			</div>	
            
            					
					
				</fieldset>
                
                </div><!-- end tab general -->
                
                <div id="tab-profile">
                

                    <p>
                        <label for="field1">About general</label>
                        <?php echo form_textarea( array('name' => 'bio','value' => $member->bio, 'class' => 'half-width') ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Awards</label>
                        <?php echo form_textarea( array('name' => 'address_line2','value' => $member->address_line2, 'class' => 'half-width') ) ?>
                    </p>
                    
                    
                    <p>
                        <label for="field1">Works</label>
                        <?php echo form_textarea( array('name' => 'address_line3','value' => $member->address_line3, 'class' => 'half-width') ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Phone</label>
                        <?php echo form_input( array('name' => 'phone','class' => 'half-width','value' => $member->phone) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Mobile</label>
                        <?php echo form_input( array('name' => 'mobile','class' => 'half-width','value' => $member->mobile) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Address</label>
                        <?php echo form_input( array('name' => 'address_line1','class' => 'half-width','value' => $member->address_line1) ) ?>
                    </p>
                    
                    
                    <p>
                        <label for="field1">MSN address</label>
                        <?php echo form_input( array('name' => 'msn_handle','class' => 'half-width','value' => $member->msn_handle) ) ?>
                    </p>
                    
                    <p>
                        <label for="field1">Twitter access</label>
                        <?php echo form_input( array('name' => 'twitter_access_token','class' => 'half-width','value' => $member->twitter_access_token) ) ?>
                    </p>
                    
                    
                    <p></p>
                </div>
				
				<fieldset class="grey-bg no-margin">
					<legend>Action on create</legend>
					<p class="input-with-button">
						<label for="simple-action">Select action</label>
						<select name="sub_ok" id="simple-action">
							<option value="1">Save and publish</option>
						</select>
                        <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'cancel') )); ?>
					</p>
				</fieldset>
                

                <input type="hidden" name="added_by" value="<?=$_SESSION['user_id']?>" />
					
			<?php echo form_close(); ?></div>
		</section>