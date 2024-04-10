<!--
<script type="text/javascript" src="addons/modules/vcard/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="addons/modules/vcard/js/jquery.autocomplete_do.js"></script>
-->

<script type="text/javascript" src="addons/modules/vcard/js/jquery.coolautosuggest.js"></script>

<link href="addons/modules/vcard/js/jquery.coolautosuggest.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

jQuery(function($) {

	$("#user_search").coolautosuggest({
		url:SITE_URL + "ajax/ajax_user_search?user_match=",
    	showThumbnail:true,
    	showDescription:true,
    	idField:$("#uid"),
    	width:280,
    	minChars:2
    	//submitOnSelect:true
	});
    
    $('#submit_user').live('click',function() {
        
        $.post(SITE_URL + "ajax/ajax_user_add", { uid: $("#uid").val(), gid: $("#gid option:selected").val() , vid: $("#vid").val() } )
        .success(function() { notify('The user was added!'); })
        .error(function() { notify('wrong, please check the filed'); });
        //.complete(function() { alert("complete"); });
        
    }); 
    
    $('.delete_user').click(function(){
    var element = $(this);
    var I = element.attr("id");
    var answer = confirm("Do you really want to delete this user ?") 
    
         if(answer){
             $('li#list'+I).fadeOut('slow', function() {
                //Remove the link selected from link list (as visible)                    
                $.post(SITE_URL + "ajax/ajax_user_delete", { uid: I, vid: $("#vid").val() } )
                .success(function() { notify('The user was deleted!'); });
             });
                  
         return false;
         }
        return false;
    });
    
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
        <h1>Add vcard</h1>
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
                <?php echo form_input('picture', $vcard->picture);?>
                <?php echo anchor('/admin/files#!path=vcards' , 'Upload', 'class="button" target="_blank"'); ?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
           
            <li>
    			<label for="description"> description:</label>
                <?php echo form_textarea(array('id'=>'description', 'name'=>'description', 'value' => $vcard->description, 'rows' => 10, 'class' => 'half-width')); ?>
    			<span class="required-icon tooltip"><?php echo lang('required_label');?></span>
    		</li>
    
    		<li class="even">
    			<label for="name">date </label>
                <?php echo form_input('date', $vcard->date, 'maxlength="10" id="vcard_datepicker" class="text width-20"'); ?>
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
        <h1>Block title</h1>
        <p>                    
            <ul class="arbo with-title">
                <li>                     
                    <!-- Add the class toggle to a title to make it open/close its branch -->
                    <!-- There are various classes for titles, check on the right -->
                    <a href="#" class="title-user toggle">Full Cast</a>
                     
                    <ul>
                    
                    <?php
                    //print_r($groups);
                    
                    foreach ($groups AS $group) {
                        if(!in_array("1", $group) && !in_array("2", $group)){                     
                            print '<li class="close">
                                    <span class="toggle"></span>';
                            print '<a href="#" class="folder"><span>'.$group['description'].'</span></a>';
                            print '<ul>';

                            $getmembers = $this->vcard_m->bulid_members($group['id'],$vcard->id);
    
                            // print the members of this group                        
                            if(!is_array($getmembers)) print '<li style="position: relative;"><span class="empty">Empty</span></li>'; 
                            else 
                            foreach ( $getmembers as $memeber ) if($memeber['group_id'] == $memeber['group_id']) print '<li id="list'.$memeber['user_id'].'"><span class="user"><strong>'.$memeber['display_name'].'</strong> <a href="#" id="'.$memeber['user_id'].'" title="Delete '.$memeber['first_name'].'" class="delete_user"><img src="system/codexfw/assets/img/admin/icons/fugue/cross-small.png" width="16" height="16"></a></span></li>';
                            
                            print '</ul>';
                            print '</li><!-- end -->';
                        }
                    }
                    ?>                        
                        
<!--
                        <li>
                            <span class="toggle"></span>
                            <a href="#" class="folder"><span>Loading folder</span></a>
                            <ul>                             
                                <li style="position: relative;">
                                <span class="loading">loading</span>
                                </li>                                 
                            </ul>
                        </li>
                        
                        <li>
                            <span class="toggle"></span>
                            <a href="#" class="folder"><span>Empty folder</span></a>
                            <ul>                           
                                <li><span class="empty">Empty</span></li>                                 
                            </ul>
                        </li>
-->
                        
                    </ul>
                </li>
            </ul>
            
            <div class="task with-legend">
                 
                <!-- The legend -->
                <div class="legend"><img src="system/codexfw/assets/img/admin/icons/fugue/flag.png" width="16" height="16"> Add User</div>
                 
                <div class="task-description">
                     
                    <!-- Task-list has special integration of the floating-tags class -->
                    <ul class="floating-tags">
                        <!--
<li class="tag-time">5 days ago</li>
-->
                        <li class="tag-user">You</li>
                    </ul>
                     
                    <h3>Quick add</h3>
                    here you can add an user to cast list
                </div>
                 
                <!-- Optional task dialog -->
                <ul class="task-dialog">
<!--
                    <li id="select_error">
                        <strong>Added:</strong> you can add more user <em>- Now</em>
                    </li>
-->
                    
                    <!-- The class auto-hide will only reveal this element when task is hovered -->
                    <li class="my-hide">
                        <form name="task-1-comment" method="post" action="" class="form input-with-button">
                        
                            <input type="text" name="user_search" id="user_search" value="" title="Enter comment..." autocomplete="off">
                            <input type="hidden" name="uid" id="uid" value="0">
                            <input type="hidden" name="vid" id="vid" value="<?=$vcard->id?>">
                            
                            <select size="1" name="gid" id="gid">
                            <?php
                            
                            foreach($groups as $filed)  if(!in_array("1", $filed) && !in_array("2", $filed))  print '<option value="'.$filed['id'].'">'.$filed['description'].'</option>';                                                       
                            
                            ?>
                            </select>
                            
                            <button id="submit_user" type="button">Add</button>
                        </form>
                    </li>
                </ul>
            </div>

        </p>
        
    </div>
</div>
</section>
    