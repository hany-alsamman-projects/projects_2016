<?php 
include_once(PG_DIR . '/functions.php');

// check if are updating
(isset($_REQUEST['user'])) ? $upd = true : $upd = false;	

// se aggiorno, estraggo l'ID utente
if($upd) { $user_id = addslashes($_REQUEST['user']); }

// include wpdb
global $wpdb;
$table_name = $wpdb->prefix . "pg_users";

// error to false
$error = false;
?>

<div class="wrap pg_form lcwp_form">  
	<div class="icon32" id="icon-pg_user_manage"><br></div>
    <?php 
	($upd) ? $fp_title = 'Edit' : $fp_title = 'Add';
	
	echo '<h2 class="pg_page_title">' .$fp_title.' '. __( 'PrivateContent User', 'pg_ml' ) . "</h2>"; 
	?>  
    
    <?php
	// SUBMIT HANDLE DATA
	if(isset($_POST['pg_man_user_submit'])) { 
		include(PG_DIR . '/classes/simple_form_validator.php');		
		
		$form_structure = array(
			'include' => array('name', 'surname', 'username', 'email', 'tel'), 
			'require' => array('username')
		);	
		
		//////////////////////////////////////////////////////////////
		// CUSTOM ADMIN DATA VALIDATION - USER DATA ADD-ON
		$form_structure = apply_filters( 'pg_add_user_validation', $form_structure);
		//////////////////////////////////////////////////////////////

		$validator = new simple_fv;		
		$indexes = pg_validator_generator($form_structure);
		
		$indexes[] = array('index'=>'psw', 'label'=>'Password', 'required'=>true, 'max_len'=>50);
		$indexes[] = array('index'=>'disable_pvt_page', 'label'=>__("Disable private page", 'pg_ml'));
		$indexes[] = array('index'=>'categories', 'label'=>__("Categories", 'pg_ml'), 'required'=>true, 'max_len'=>20);
		
		$validator->formHandle($indexes);
		$fdata = $validator->form_val;
		
		// check username unicity
		($upd) ? $upd_q = "AND ID != '".$user_id."'" : $upd_q = ''; // hack per update
		$wpdb->query("SELECT ID FROM ".$table_name." WHERE username = '".$fdata['username']."' ".$upd_q." AND status != 0");
		if($wpdb->num_rows > 0) {$validator->custom_error[__("Username" )] =  __("Another user already has this username", 'pg_ml');}
		
		$error = $validator->getErrors();
		
		if($error) {echo '<div class="error"><p>'.$error.'</p></div>';}
		else {
			// clean data
			$fdata = pg_strip_opts($fdata);

			// encrypt the password
			$fdata['psw'] = base64_encode($fdata['psw']);
			
			// serialize categories
			$fdata['categories'] = serialize($fdata['categories']);
			
			// enable private page?
			($fdata['disable_pvt_page']) ? $pp_status = 1 : $pp_status = 0;
			
			// create array for the query
			$query_arr = array();
			$standard_fields = array('name', 'surname', 'username', 'psw', 'email', 'tel', 'categories');
			foreach($standard_fields as $sf) {
				if(isset($fdata[$sf])) {$query_arr[$sf] = $fdata[$sf];}	
			}
			
			$query_arr['disable_pvt_page'] = $pp_status;

			if($upd) {
				// update	
				$wpdb->update($table_name, $query_arr,  array( 'id' => $user_id)); 
			}
			else {
				// create the user page
				global $current_user;
				
				$new_entry = array();
				$new_entry['post_author'] = $current_user->ID;
				$new_entry['post_content'] = get_option('pg_pvtpage_default_content');
				$new_entry['post_status'] = 'publish';
				$new_entry['post_title'] = $fdata['username'];
				$new_entry['post_type'] = 'pg_user_page';
				$entry_id = wp_insert_post( $new_entry, true );
				
				if(!$entry_id) {
					$error = __('Error during user page creation', 'pg_ml');
					echo '<div class="error"><p>'.$error.'</p></div>';	
				}
				else {
					// add
					$query_arr['insert_date'] = date("Y-m-d H:i:s"); // add insert date
					$query_arr['page_id'] = $entry_id;
					$query_arr['status'] = 1;
					$wpdb->insert($table_name, $query_arr);	
					
					$user_id = $wpdb->insert_id;
				}
			}
			
			if(!$error) {
				//////////////////////////////////////////////////////////////
				// CUSTOM DATA SAVING - USER DATA ADD-ON
				do_action( 'pcud_save_custom_data', $fdata, $user_id, true);
				//////////////////////////////////////////////////////////////
				
				echo '<div class="updated"><p><strong>'. __('User saved ' ) .'</strong></p></div>';	
			}
		}
	}
	
	// if updating - retrieve data
	if($upd && !isset($validator)) {
		$fdata = $wpdb->get_row("SELECT * FROM ".$table_name." WHERE id = '".$user_id."'", ARRAY_A);
	}
	
	// re-normalyze vars
	if($upd && !isset($validator) || isset($validator) && !$error) {
		$fdata['psw'] = base64_decode($fdata['psw']);
		$fdata['categories'] = unserialize($fdata['categories']);
	}
	?>
    
    <br/>
    <form name="pg_user" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" class="form-wrap">  
	
    <table class="widefat pg_table">
      <thead>
      <tr>  
        <th colspan="2"><?php _e("User Data", 'pg_ml'); ?></th>
        <th style="padding-left: 3%;"><?php _e("User Category", 'pg_ml'); ?></th>
      </tr>  
      </thead>
      <tbody>
      <tr>
      	<td class="pg_label_td"><?php _e("Name"); ?></td>
        <td class="pg_field_td">
        	<input type="text" name="name" value="<?php if($upd || $error) echo htmlentities($fdata['name'], ENT_QUOTES); ?>" maxlength="150" />
        </td>
        
        <td class="pg_field_td" rowspan="7" style="min-width:50%; border-left: 1px solid #DFDFDF; vertical-align: top;">
        	<ul class="pg_checkbox_list">
			  <?php
              $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
              
              if(count($user_categories) == 0) {
                  echo '
				  <li>
				  	<a href="edit-tags.php?taxonomy=pg_user_categories" style="color: red;">'.__('Create a user category').'</a>
				  </li>';
              }
              
              foreach ($user_categories as $ucat) {
                  if(($upd || $error) && is_array($fdata['categories'])) {
                      (in_array($ucat->term_id, $fdata['categories'])) ? $check_cat = 'checked="checked"' : $check_cat = '';
                  }
                  else {$check_cat = '';}
                  
                  echo '
                  <li style="padding-left: 15px;">
                    <input type="checkbox" name="categories[]" value="'.$ucat->term_id.'" '.$check_cat.' class="ip_checks" />
                    <label>'.$ucat->name.'</label> 
                  </li>
                  ';  
              }
              ?>
            </ul>
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("Surname", 'pg_ml'); ?></td>
        <td class="pg_field_td">
        	<input type="text" name="surname" value="<?php if($upd || $error) echo htmlentities($fdata['surname'], ENT_QUOTES); ?>" maxlength="150" />
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("Username" ); ?> <span class="pg_req_field">*</span></td>
        <td class="pg_field_td">
        	<input type="text" name="username" value="<?php if($upd || $error) echo htmlentities($fdata['username'], ENT_QUOTES); ?>" maxlength="150" />
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("Password" ); ?> <span class="pg_req_field">*</span></td>
        <td class="pg_field_td">
        	<input type="text" name="psw" value="<?php if($upd || $error) echo htmlentities($fdata['psw'], ENT_QUOTES); ?>" maxlength="50" />
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("E-mail" ); ?></td>
        <td class="pg_field_td">
        	<input type="text" name="email" value="<?php if($upd || $error) echo htmlentities($fdata['email'], ENT_QUOTES); ?>" maxlength="255" />
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("Telephone", 'pg_ml'); ?></td>
        <td class="pg_field_td">
        	<input type="text" name="tel" value="<?php if($upd || $error) echo htmlentities($fdata['tel'], ENT_QUOTES); ?>" maxlength="20" />
        </td>
      </tr>
      <tr>
      	<td class="pg_label_td"><?php _e("Disable user private page", 'pg_ml'); ?></td>
        <td class="pg_field_td">
        	<input type="checkbox" name="disable_pvt_page" value="1" <?php if($upd && $fdata['disable_pvt_page'] == 1) echo 'checked="checked"' ?> class="ip_checks" />
        </td>
      </tr>
      </tbody>  
    </table>  
    
    <?php
    //////////////////////////////////////////////////////////////
    // CUSTOM DATA SAVING - USER DATA ADD-ON
	if(!isset($user_id) || !$upd && !$error) {$user_id = false;} 
	if(!isset($fdata) || isset($fdata) && !$error) {$fdata = false;}
    do_action( 'pcud_admin_user_fields', $user_id, $fdata);
    //////////////////////////////////////////////////////////////
    ?>
	
    <?php ($upd) ? $btn_val = __('Update User', 'pg_ml') : $btn_val = __('Add User', 'pg_ml'); ?>
   	<input type="submit" name="pg_man_user_submit" value="<?php echo $btn_val; ?>" class="button-primary" />  
    
    </form>
</div>  

<?php // SCRIPTS ?>
<script src="<?php echo PG_URL; ?>/js/iphone_checkbox/iphone-style-checkboxes.js" type="text/javascript"></script>
<script src="<?php echo PG_URL; ?>/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" >
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
});
</script>