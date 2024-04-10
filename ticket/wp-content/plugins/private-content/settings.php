<?php include_once(PG_DIR . '/functions.php'); ?>

<div class="wrap pg_form lcwp_form">  
	<div class="icon32" id="icon-pg_user_manage"><br></div>
    <?php    echo '<h2 class="pg_page_title">' . __( 'PrivateContent Settings', 'pg_ml') . "</h2>"; ?>  

    <?php
	// HANDLE DATA
	if(isset($_POST['pg_admin_submit'])) { 
		include(PG_DIR . '/classes/simple_form_validator.php');		
		
		$validator = new simple_fv;
		$indexes = array();
		
		$indexes[] = array('index'=>'pg_target_page', 'label'=>__( 'User\'s Private Page', 'pg_ml' ), 'type'=>'int');
		$indexes[] = array('index'=>'pg_target_page_content', 'label'=>__( 'Target page content', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_pvtpage_default_content', 'label'=>__( 'Private page default content', 'pg_ml' ));
		
		$indexes[] = array('index'=>'pg_redirect_page', 'label'=>__( 'Redirect Page', 'pg_ml' ), 'type'=>'int');
		$indexes[] = array('index'=>'pg_logged_user_redirect', 'label'=>__( 'Logged Users Redirect', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_logout_user_redirect', 'label'=>__( 'Users Redirect after logout', 'pg_ml' ));
		
		$indexes[] = array('index'=>'pg_js_inline_login', 'label'=>__( 'Inline login', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_disable_front_css', 'label'=>__( 'Disable Front CSS', 'pg_ml' ));
		
		$indexes[] = array('index'=>'pg_registration_cat', 'label'=>__( 'Registered Users Category', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_disable_recaptcha', 'label'=>__( 'Disable reCAPTCHA', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_registered_pending', 'label'=>__( 'Pending Status registered', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_registered_pvtpage', 'label'=>__( 'Private page for registered', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_registered_user_redirect', 'label'=>__( 'Registered Users Redirect', 'pg_ml' ));
		
		$indexes[] = array('index'=>'pg_field_order', 'label'=>__( 'Fields Order', 'pg_ml' ));		
		$indexes[] = array('index'=>'pg_use_field', 'label'=>__( 'Included Fields', 'pg_ml' ));
		$indexes[] = array('index'=>'pg_field_required', 'label'=>__( 'Required Fields', 'pg_ml' ));
		
		$indexes[] = array('index'=>'pg_default_nl_mex', 'label'=>__( 'Message for not logged users', 'pg_ml' ), 'maxlen'=>255);
		$indexes[] = array('index'=>'pg_default_uca_mex', 'label'=>__( 'Message for not right permissions', 'pg_ml' ), 'maxlen'=>255);
		$indexes[] = array('index'=>'pg_default_nhpa_mex', 'label'=>__( 'Message if haven\'t reserved area', 'pg_ml' ), 'maxlen'=>255);
		$indexes[] = array('index'=>'pg_default_sr_mex', 'label'=>__( 'Message if registered', 'pg_ml' ), 'maxlen'=>170);
		
		
		$validator->formHandle($indexes);
		$error = $validator->getErrors();
		$fdata = $validator->form_val;

		if($error) {echo '<div class="error"><p>'.$error.'</p></div>';}
		else {
			// clean data and save options
			foreach($fdata as $key=>$val) {
				if(!is_array($val)) {
					$fdata[$key] = stripslashes($val);
				}
				else {
					$fdata[$key] = array();
					foreach($val as $arr_val) {$fdata[$key][] = stripslashes($arr_val);}
				}
			
				if(!$fdata[$key]) {delete_option($key);}
				else {
					if(!get_option($key)) { add_option($key, '255', '', 'yes'); }
					update_option($key, $fdata[$key]);	
				}
			}
			
			// build registration form option
			$fdata['pg_registration_form'] = array('include'=>$fdata['pg_use_field'], 'require'=>$fdata['pg_field_required']);
			if(!get_option('pg_registration_form')) { add_option('pg_registration_form', '255', '', 'yes'); }
			update_option('pg_registration_form', $fdata['pg_registration_form']);	

			
			echo '<div class="updated"><p><strong>'. __('Options saved' ) .'</strong></p></div>';
		}
	}
	
	else {  
		// Normal page display
		$fdata['pg_target_page'] = get_option('pg_target_page');  
		$fdata['pg_target_page_content'] = get_option('pg_target_page_content');
		$fdata['pg_pvtpage_default_content'] = get_option('pg_pvtpage_default_content');
		
		$fdata['pg_redirect_page'] = get_option('pg_redirect_page'); 
		$fdata['pg_logged_user_redirect'] = get_option('pg_logged_user_redirect');
		$fdata['pg_logout_user_redirect'] = get_option('pg_logout_user_redirect');
				
		$fdata['pg_js_inline_login'] = get_option('pg_js_inline_login'); 
		$fdata['pg_disable_front_css'] = get_option('pg_disable_front_css'); 
		
		$fdata['pg_registration_cat'] = get_option('pg_registration_cat');
		$fdata['pg_disable_recaptcha'] = get_option('pg_disable_recaptcha');
		$fdata['pg_registered_pending'] = get_option('pg_registered_pending');
		$fdata['pg_registered_pvtpage'] = get_option('pg_registered_pvtpage');
		$fdata['pg_registered_user_redirect'] = get_option('pg_registered_user_redirect');
		
		$fdata['pg_field_order'] = get_option('pg_field_order');
		
		$fdata['pg_default_nl_mex'] = get_option('pg_default_nl_mex'); 
		$fdata['pg_default_uca_mex'] = get_option('pg_default_uca_mex'); 
		$fdata['pg_default_nhpa_mex'] = get_option('pg_default_nhpa_mex');
		$fdata['pg_default_sr_mex'] = get_option('pg_default_sr_mex');
	}  
	?>
    
    <br/>
    <div id="tabs">
    <form name="pg_admin" method="post" class="form-wrap" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
    
    
    <ul class="tabNavigation">
    	<li><a href="#main_opt"><?php _e('Main', 'pg_ml') ?></a></li>
        <li><a href="#form_opt"><?php _e('Registration Form', 'pg_ml') ?></a></li>
        <li><a href="#mex_opt"><?php _e('Messages', 'pg_ml') ?></a></li>
    </ul>
    
    
    <div id="main_opt">
    	<?php $pages = get_pages();  // pages list ?>
    	
    	<h3><?php _e("Users Private Page", 'pg_ml'); ?></h3>
        <table class="widefat pg_table">
          <tr>
          	<td class="pg_label_td"><?php _e("Page to use as users private page container" ); ?></td>
            <td class="pg_field_td">
            	<select name="pg_target_page" class="chzn-select" data-placeholder="Select a page .." tabindex="2">
                  <option value=""></option>
                  <?php
                  foreach ( $pages as $pag ) {
                      ($fdata['pg_target_page'] == $pag->ID) ? $selected = 'selected="selected"' : $selected = '';
                      echo '<option value="'.$pag->ID.'" '.$selected.'>'.$pag->post_title.'</option>';
                  }
                  ?>
              </select>  
            </td>
            <td><span class="info">Choose a page from the list</span></td>
          </tr>
          <tr>
          	<td class="pg_label_td"><?php _e("Users private page content" ); ?></td>
            <td class="pg_field_td">
            	<select name="pg_target_page_content" class="chzn-select" data-placeholder="Select an option .." tabindex="2">
                  <option value="original_content"  <?php if(!$fdata['pg_target_page_content'] || $fdata['pg_target_page_content'] == 'original_content') {echo 'selected="selected"';} ?>>Original content</option>
                  
                  <option value="original_plus_form" <?php if($fdata['pg_target_page_content'] == 'original_plus_form') {echo 'selected="selected"';} ?>>Original content plus login form</option>
                  
                  <option value="form_plus_original" <?php if($fdata['pg_target_page_content'] == 'form_plus_original') {echo 'selected="selected"';} ?>>Login form plus original content</option>
                  
                  <option value="only_form" <?php if($fdata['pg_target_page_content'] == 'only_form') {echo 'selected="selected"';} ?>>Only login form</option>
                </select>  
            </td>
            <td><span class="info">Content that will see non logged users</span></td>
          </tr>
          <tr>
           <td class="pg_label_td"><?php _e("Default private page content for new users", 'pg_ml'); ?></td>
           <td class="pg_field_td" colspan="2">
           	 <?php 
			 if( substr(get_bloginfo('version'), 0, 3) != '3.3') {
				echo the_editor ( $fdata['pg_pvtpage_default_content'], 'pg_pvtpage_default_content'); 
			 }
			 else {
				 $args = array('textarea_rows'=> 4);
				 echo wp_editor( $fdata['pg_pvtpage_default_content'], 'pg_pvtpage_default_content', $args); 
			 }
			 ?>
           </td>
         </tr>
       </table> 
         
       <h3><?php _e("Redirects"); ?></h3>
       <table class="widefat pg_table">
        <tr>
          <td class="pg_label_td"><?php _e("Page to use as redirect target" ); ?></td>
          <td class="pg_field_td">
              <select name="pg_redirect_page" class="chzn-select" data-placeholder="Select a page .." tabindex="2">
                  <option value=""></option>
                  <?php
                  // list all wp pages
                  foreach ( $pages as $pag ) {
                      ($fdata['pg_redirect_page'] == $pag->ID) ? $selected = 'selected="selected"' : $selected = '';
                      echo '<option value="'.$pag->ID.'" '.$selected.'>'.$pag->post_title.'</option>';
                  }
                  ?>
              </select>   
          </td>
          <td><span class="info">Choose the page where users without permissions will be redirected</span></td>
        </tr>
        <tr>
          	<td class="pg_label_td"><?php _e("Redirect page after user login", 'pg_ml'); ?></td>
            <td class="pg_field_td">
              <select name="pg_logged_user_redirect" class="chzn-select" data-placeholder="Select a page .." tabindex="2">
                <option value="">Do not redirect users</option>
                <?php
                // list all wp pages
                foreach ( $pages as $pag ) {
                    ($fdata['pg_logged_user_redirect'] == $pag->ID) ? $selected = 'selected="selected"' : $selected = '';
                    echo '<option value="'.$pag->ID.'" '.$selected.'>'.$pag->post_title.'</option>';
                }
                ?>
              </select>   
            </td>
            <td><span class="info">Select the page where users will be redirected after login</span></td>
          </tr>
          <tr>
          	<td class="pg_label_td"><?php _e("Redirect page after user logout", 'pg_ml'); ?></td>
            <td class="pg_field_td">
              <select name="pg_logout_user_redirect" class="chzn-select" data-placeholder="Select a page .." tabindex="2">
                <option value="">Do not redirect users</option>
                <?php
                // list all wp pages
                foreach ( $pages as $pag ) {
                    ($fdata['pg_logout_user_redirect'] == $pag->ID) ? $selected = 'selected="selected"' : $selected = '';
                    echo '<option value="'.$pag->ID.'" '.$selected.'>'.$pag->post_title.'</option>';
                }
                ?>
              </select>   
            </td>
            <td><span class="info">Select the page where users will be redirected after logout</span></td>
          </tr>
       </table>   
         
       <h3><?php _e("Various"); ?></h3>
       <table class="widefat pg_table">
       	 <tr>
           <td class="pg_label_td"><?php _e("Use the inline login with PvtContent shortcode?", 'pg_ml'); ?></td>
           <td class="pg_field_td">
            <?php ($fdata['pg_js_inline_login']) ? $checked= 'checked="checked"' : $checked = ''; ?>
            <input type="checkbox" name="pg_js_inline_login" value="1" <?php echo $checked; ?> class="ip_checks" />
           </td>
           <td><span class="info">If disabled the shortcode will only display the warning box</span></td>
         </tr>
         <tr>
           <td class="pg_label_td"><?php _e("Disable the default frontend CSS?", 'pg_ml'); ?></td>
           <td class="pg_field_td">
           	 <?php ($fdata['pg_disable_front_css']) ? $checked= 'checked="checked"' : $checked = ''; ?>
             <input type="checkbox" name="pg_disable_front_css" value="1" <?php echo $checked; ?> class="ip_checks" />
           </td>
           <td></td>
         </tr>
       </table>
    </div>
    
    
    
    <div id="form_opt">
    	<h3><?php _e("General registration settings", 'pg_ml'); ?></h3>
    	<table class="widefat pg_table">
         <tr>
           <td class="pg_label_td"><?php _e("Default category for registered users" ); ?></td>
           <td class="pg_field_td">
           	  <select name="pg_registration_cat" class="chzn-select" data-placeholder="Select a category .." tabindex="2">
                <option value=""></option>
				  <?php
				  // all user categories
				  $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
				  
				  foreach ($user_categories as $ucat) {
					($ucat->term_id == $fdata['pg_registration_cat']) ? $selected = 'selected="selected"' : $selected = '';
					  
					 echo '<option value="'.$ucat->term_id.'" '.$selected.'>'.$ucat->name.'</option>';
				  }
                  ?>
              </select> 
           </td>
           <td><span class="info">The user will be assigned automatically after the registration</span></td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Disable reCAPTCHA validation?" ); ?></td>
            <td class="pg_field_td">
            	<?php ($fdata['pg_disable_recaptcha']) ? $checked= 'checked="checked"' : $checked = ''; ?>
            	<input type="checkbox" name="pg_disable_recaptcha" value="1" <?php echo $checked; ?> class="ip_checks" />
            </td>
            <td></td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Set users status as pending after registration?" ); ?></td>
            <td class="pg_field_td">
            	<?php ($fdata['pg_registered_pending']) ? $checked= 'checked="checked"' : $checked = ''; ?>
            	<input type="checkbox" name="pg_registered_pending" value="1" <?php echo $checked; ?> class="ip_checks" />
            </td>
            <td></td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Enable the private page for new registered users?" ); ?></td>
            <td class="pg_field_td">
            	<?php ($fdata['pg_registered_pvtpage']) ? $checked= 'checked="checked"' : $checked = ''; ?>
            	<input type="checkbox" name="pg_registered_pvtpage" value="1" <?php echo $checked; ?> class="ip_checks" />
            </td>
            <td></td>
         </tr>
         <tr>
          	<td class="pg_label_td"><?php _e("Redirect page after registration", 'pg_ml'); ?></td>
            <td class="pg_field_td">
              <select name="pg_registered_user_redirect" class="chzn-select" data-placeholder="Select a page .." tabindex="2">
                <option value="">Do not redirect users</option>
                <?php
                // list all wp pages
                foreach ( $pages as $pag ) {
                    ($fdata['pg_registered_user_redirect'] == $pag->ID) ? $selected = 'selected="selected"' : $selected = '';
                    echo '<option value="'.$pag->ID.'" '.$selected.'>'.$pag->post_title.'</option>';
                }
                ?>
              </select>   
            </td>
            <td><span class="info">Select the page where registered users will be redirected after registration</span></td>
          </tr>
       </table>
        
        
       <?php 
	   $form_fields = pg_reg_form_fields();
	   ?> 
    	<h3><?php _e("Registration form fields", 'pg_ml'); ?></h3>
    	<table id="pg_form_creator" class="widefat pg_table">
          <thead>
          <tr>
            <th style="width: 15px;"></th>
          	<th><?php _e('Field'); ?></th>
            <th style="text-align: center;"><?php _e('Use in the form'); ?></th>
            <th style="text-align: center;"><?php _e('Field Required'); ?></th>
          </tr>
          </thead>
          
          <tbody>
          <?php 
		  foreach($form_fields as $index => $field) {
			if(isset($field['sys_req']) && $field['sys_req']) {
				$use_td = '<span>&radic;</span><input type="hidden" name="pg_use_field[]" value="'.$index.'" />';
				$req_td = '<span>&radic;</span><input type="hidden" name="pg_field_required[]" value="'.$index.'" />';	
			}
			else {
				$use_td = '<input type="checkbox" name="pg_use_field[]" value="'.$index.'" '.pg_reg_form_check($index).' />';
				$req_td = '<input type="checkbox" name="pg_field_required[]" value="'.$index.'" '.pg_reg_form_check($index, 'require').' />';	
			}
			  
			echo '
			<tr>
		      <td><span class="pg_move_field"></span></td>
			  <td>
			  	'.utf8_decode($field['label']).'
				<input type="hidden" name="pg_field_order[]" value="'.$index.'" />
			  </td>
			  <td>'.$use_td.'</td>
			  <td>'.$req_td.'</td>
			</tr>
			';  
		  }
		  ?>
         
          </tbody>
        </table>
    </div>
    
    
    
    <div id="mex_opt">
		<h3><?php _e("Login" ); ?></h3>
        <table class="widefat pg_table">
          <tr>
            <td class="pg_label_td"><?php _e("Default message for not logged users" ); ?></td>
            <td class="pg_field_td">
               <input type="text" name="pg_default_nl_mex" value="<?php echo htmlentities($fdata['pg_default_nl_mex'], ENT_QUOTES); ?>" maxlength="255" /> 
               <p class="info">By default is "You must be logged in to view this content"</p>
            </td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Default message if a user not have the right permissions" ); ?></td>
            <td class="pg_field_td">
            	<input type="text" name="pg_default_uca_mex" value="<?php echo htmlentities($fdata['pg_default_uca_mex'], ENT_QUOTES); ?>" maxlength="255" />
              	<p class="info">By default is "Sorry, you don't have the right permissions to view this content"</p>
            </td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Default message if a user not have the reserved area" ); ?></td>
            <td class="pg_field_td">
            	<input type="text" name="pg_default_nhpa_mex" value="<?php echo htmlentities($fdata['pg_default_nhpa_mex'], ENT_QUOTES); ?>" maxlength="255" />
              	<p class="info">By default is "You don't have a reserved area"</p>
            </td>
         </tr>
         <tr>
            <td class="pg_label_td"><?php _e("Default message if a user not have the reserved area" ); ?></td>
            <td class="pg_field_td">
            	<input type="text" name="pg_default_nhpa_mex" value="<?php echo htmlentities($fdata['pg_default_nhpa_mex'], ENT_QUOTES); ?>" maxlength="255" />
              	<p class="info">By default is "You don't have a reserved area"</p>
            </td>
         </tr>
        </table> 

        <h3><?php _e("Registration" ); ?></h3>
        <table class="widefat pg_table">
          <tr>
            <td class="pg_label_td"><?php _e("Default message for succesfully registered users" ); ?></td>
            <td class="pg_field_td">
               <input type="text" name="pg_default_sr_mex" value="<?php echo htmlentities($fdata['pg_default_sr_mex'], ENT_QUOTES); ?>" maxlength="170" /> 
               <p class="info">By default is "Registration was succesful. Welcome!"</p>
            </td>
         </tr>
       </table> 
        
    </div>
      
    <input type="submit" name="pg_admin_submit" value="<?php _e('Update Options', 'pg_ml' ) ?>" class="button-primary" />  
    
    </form>
</div>  

<?php // SCRIPTS ?>
<script src="<?php echo PG_URL; ?>/js/iphone_checkbox/iphone-style-checkboxes.js" type="text/javascript"></script>
<script src="<?php echo PG_URL; ?>/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" charset="utf8" >
jQuery(document).ready(function($) {
	// iphone checks
	jQuery('.ip_checks').iphoneStyle({
	  checkedLabel: 'YES',
	  uncheckedLabel: 'NO'
	});
	
	// chosen
	jQuery('.chzn-select').each(function() {
		jQuery(".chzn-select").chosen(); 
		jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});
	});
	
	// tabs
	jQuery("#tabs").tabs();
	
	
	/*** sort formbuilder rows ***/
	jQuery( "#pg_form_creator tbody" ).sortable({ handle: '.pg_move_field' });
	jQuery( "#pg_form_creator tbody td .pg_move_field" ).disableSelection();
	
});
</script>





