<?php
// script to handle the AJAX request on the frontend and  authenticate the user


// load the auth form
add_action('init', 'pg_load_auth_form');
function pg_load_auth_form() {
	if(isset($_POST['type']) && $_POST['type'] == 'pg_get_auth_form') {
		echo pg_login_form();
		
		die();
	}
}


// handle the ajax form submit
add_action('init', 'pg_user_auth');
function pg_user_auth() {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
		
	if(isset($_POST['type']) && $_POST['type'] == 'js_ajax_auth') {
		include(PG_DIR . '/classes/simple_form_validator.php');	
		
		$validator = new simple_fv;
		$indexes = array();
		
		$indexes[] = array('index'=>'pg_auth_username', 'label'=>'username', 'required'=>true);
		$indexes[] = array('index'=>'pg_auth_psw', 'label'=>'psw', 'required'=>true);
		$indexes[] = array('index'=>'auca', 'label'=>'allowed categories', 'required'=>true);

		$validator->formHandle($indexes);
		$error = $validator->getErrors();
		$fdata = $validator->form_val;
		
		// RESPONSES
		
		// error
		$base_error = json_encode(array( 
			'resp' => 'error',
			'mess' => __('Username or password incorrect', 'pg_ml')
		));
		
		// not right level
		if(!get_option('pg_default_uca_mex')) {
			$not_has_level_err = __("Sorry, you don't have the right permissions to view this content", 'pg_ml');
		}
		else {$not_has_level_err = get_option('pg_default_uca_mex');}
		
		$not_has_level_err = json_encode(array(
			'resp' => 'error',
			'mess' => $not_has_level_err
		));
		
		// success
		// redirect logged user to pvt page
		if(get_option('pg_logged_user_redirect') && (int)get_option('pg_logged_user_redirect') != 0) {
			$target = (int)get_option('pg_logged_user_redirect');
			$redirect_url = get_permalink($target);
		}
		else {$redirect_url = '';}
		
		$success = json_encode(array(
			'resp' => 'success',
			'mess' => __('Logged succesfully, welcome!', 'pg_ml'),
			'redirect' => $redirect_url
		));


		if($error) {die($base_error);}
		else {
			// create the allowed cats array
			$allowed_cat_arr = explode(',', $fdata['auca']);
			
			// db check
			$user_data = $wpdb->get_row( 
				$wpdb->prepare( "
					SELECT id, categories FROM  ".$table_name." 
					WHERE username='".$fdata['pg_auth_username']."' AND psw = '".base64_encode($fdata['pg_auth_psw'])."' AND status = 1
				") 
			);
			
			if(!$user_data) {die( $base_error );}
			
			else {
				// put the user id in the session
				$_SESSION['pg_user_id'] = $user_data->id;
				
				$user_cats = unserialize($user_data->categories);
				
				// if is a single login
				if($allowed_cat_arr[0] == 'single') {die($success);}
				
				// if user doesn't have a category
				if(!is_array($user_cats)) {die( $base_error );}
				
				// check if has the permission to view the content
				if($allowed_cat_arr[0] == 'all') {die($success);}
				else {	
					$has_the_pass = false;
					foreach($allowed_cat_arr as $a_cat) {
						if(in_array($a_cat, $user_cats)) {$has_the_pass = true; break;}	
					}

					if($has_the_pass) {die($success);}
					else {die( $not_has_level_err );}
				}
			}
		}
		die(); // security block
	}
}



////////////////////////////////////////////////////////////////


// execute logout
add_action('init', 'pg_logout_user', 1);
function pg_logout_user() {
	if(isset($_POST['type']) && $_POST['type'] == 'pg_logout') {
		unset($_SESSION['pg_user_id']);
		
		// check if a redirect is needed
		if(get_option('pg_logout_user_redirect') && (int)get_option('pg_logout_user_redirect') != 0) {
			$target = (int)get_option('pg_logout_user_redirect');
			$redirect_url = get_permalink($target);
		}
		else {$redirect_url = '';}
		
		echo $redirect_url;
		die();
	}
}


?>