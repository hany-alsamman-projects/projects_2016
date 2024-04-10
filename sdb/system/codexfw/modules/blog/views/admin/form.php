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
		'folder'         : '/uploads/news',
		'queueID'        : 'fileQueue',
		'auto'           : false,
		'multi'          : false,
        'onCancel'       : function(event, ID, fileObj) { $("input[name=picture]").val(""); },
        'onComplete'     : function(event, ID, fileObj) { 
            $("input[name=picture]").val(""+fileObj.name+""); 
            $("#delete_pic").fadeIn(1500).show()
            }
        
	});
    
    $("#delete_pic img").live('click', function(){
        
        $(this).fadeOut('slow', function() {

            //Remove the link                  
            $(this).remove();

            //Erase the input value   
            $("input[name=picture]").val("");
            
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

<section class="grid_12">

	<div class="block-border">
	    <div class="block-content">

				<?php if ($this->method == 'create'): ?>
					<h1><?php echo lang('blog_create_title'); ?></h1>
				<?php else: ?>
						<h1><?php echo sprintf(lang('blog_edit_title'), $post->title); ?></h1>
				<?php endif; ?>
	        
	        
				<ul class="tabs js-tabs">
				    <li class="current"><a href="#tab-current"><?php echo lang('blog_content_label'); ?></a></li>
				    <li><a href="#tab-other"><?php echo lang('blog_options_label'); ?></a></li>
				</ul>
				 
				<div class="tabs-content">
				<?php echo form_open(uri_string(), 'class="crud"'); ?>

				     
				    <div id="tab-current">
						<ol>
							<li>
								<label for="title"><?php echo lang('blog_title_label'); ?></label>
								<?php echo form_input('title', htmlspecialchars_decode($post->title), 'maxlength="100"'); ?>
								<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
							</li>
							<li class="even">
								<label for="slug"><?php echo lang('blog_slug_label'); ?></label>
								<?php echo form_input('slug', $post->slug, 'maxlength="100" class="width-20"'); ?>
								<span class="required-icon tooltip"><?php echo lang('required_label'); ?></span>
							</li>
							<li>
								<label for="status"><?php echo lang('blog_status_label'); ?></label>
								<?php echo form_dropdown('status', array('draft' => lang('blog_draft_label'), 'live' => lang('blog_live_label')), $post->status) ?>
							</li>
							<li class="even">
								<label for="picture">picture of</label>
								<?php echo form_input('picture', $post->picture, 'maxlength="100" class="width-20"'); ?>
                                <a id="delete_pic" style="display: none;" href="#"><img src="system/codexfw/assets/img/admin/icons/16/cross-circle.png" /></a>
                                <div style="margin-top: 15px; margin-left: 75px;">
                                <p><input name="main" type="file1" id="main" class="textBox" /> <a href="javascript:jQuery('#main').uploadifyUpload();">Upload</a></p></div>
                                <div id="fileQueue" style="margin-bottom: 15px;"></div>
							</li>
							<li>
								<label class="intro" for="intro"><?php echo lang('blog_intro_label'); ?></label>
								<?php echo form_textarea(array('id' => 'intro', 'name' => 'intro', 'value' => $post->intro, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
							</li>
							<li>
								<?php echo form_textarea(array('id' => 'body', 'name' => 'body', 'value' => stripslashes($post->body), 'rows' => 50, 'class' => 'wysiwyg-advanced')); ?>
							</li>					
						</ol>
				    </div>
				     
				    <div id="tab-other">
						<ol>
							<li>
								<label for="category_id"><?php echo lang('blog_category_label'); ?></label>
								<?php echo form_dropdown('category_id', array(lang('blog_no_category_select_label')) + $categories, @$post->category_id) ?>
									[ <?php echo anchor('admin/blog/categories/create', lang('blog_new_category_label'), 'target="_blank"'); ?> ]
							</li>
							<li class="even date-meta">
								<label><?php echo lang('blog_date_label'); ?></label>
								<div style="float:left;">
									<?php echo form_input('created_on', date('Y-m-d', $post->created_on), 'maxlength="10" id="datepicker" class="text width-20"'); ?>
								</div>
								<label class="time-meta"><?php echo lang('blog_time_label'); ?></label>
								<?php echo form_dropdown('created_on_hour', $hours, date('H', $post->created_on)) ?>
								<?php echo form_dropdown('created_on_minute', $minutes, date('i', ltrim($post->created_on, '0'))) ?>
							</li>
							<li>
								<label for="comments_enabled"><?php echo lang('blog_comments_enabled_label');?></label>
								<?php echo form_checkbox('comments_enabled', 1, $post->comments_enabled == 1); ?>
							</li>
						</ol>
				    </div>
				 
				<div class="buttons float-right padding-top">
            	   <?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
                </div>

				<?php echo form_close(); ?>
				</div>	
	
	    </div>
	</div>

</section>


<?php echo form_close(); ?>