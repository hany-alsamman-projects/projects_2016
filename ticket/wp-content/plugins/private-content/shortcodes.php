<?php
////////// LIST OF SHORCODES

// [pc-pvt-content] 
// hide the content of the shortcode if the user is not logged and is not of the specified category
function pg_pvt_content_shortcode( $atts, $content = null ) {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	extract( shortcode_atts( array(
		'allow' => 'all',
		'message' => ''
	), $atts ) );

	// create array of users categories
	$allowed_cat_arr = explode(',', $allow);
	
	// switch for js login system
	if(!get_option('pg_js_inline_login')) {$js_login = '';}
	else {$js_login = ' - <span class="pg_login_trig pg_trigger">'.__('login', 'pg_ml').'</span>';}
	
	
	// prepare the message if user is not logget
	if($message == '') {
		if(!get_option('pg_default_nl_mex')) {$message = __('You must be logged in to view this content', 'pg_ml');}
		else {$message = get_option('pg_default_nl_mex');}
	}
	$message = '<div class="pg_login_block" id="'.$allow.'"><p>'.$message.$js_login.'</p></div>';
	
	
	// prepare message if user has not the right category
	if(!get_option('pg_default_uca_mex')) {$not_has_level_err = __("Sorry, you don't have the right permissions to view this content", 'pg_ml');}
	else {$not_has_level_err = get_option('pg_default_uca_mex');}
	$not_has_level_err = '<div class="pg_login_block" id="'.$allow.'"><p>'.$not_has_level_err.'</p></div>';

	
	// if is a logged wordpress user return the content
	if ( is_user_logged_in()) {return do_shortcode($content);}
	else {
	
		// try to retrieve the current user ID
		if(!isset($_SESSION['pg_user_id'])) {
			return $message;
		}
		else {	
			$user_id = $_SESSION['pg_user_id'];
			
			// if the allow parameter is set to ALL, return content
			if($allowed_cat_arr[0] == 'all') {return do_shortcode($content);}
			else {
			
				// get the user categories
				$user_categories = $wpdb->get_var( $wpdb->prepare( "SELECT categories FROM  ".$table_name." WHERE ID = '".$user_id."' AND status = 1") );
				$cat_array = unserialize($user_categories);
				
				if(!is_array($cat_array)) {return $message;}
				else {
					
					// search if the user categories are in the shortcode's allowed
					$has_the_pass = false;
					foreach($cat_array as $u_cat) {
						if(in_array($u_cat, $allowed_cat_arr)) {$has_the_pass = true; break;}	
					}
					
					return ($has_the_pass) ? do_shortcode($content) : $not_has_level_err;	
				}	
			}
		}
	}
}
add_shortcode('pc-pvt-content', 'pg_pvt_content_shortcode');



// [pc-login-form] 
// get the login form
function pg_login_form_shortcode( $atts, $content = null ) {
	return pg_login_form();
}
add_shortcode('pc-login-form', 'pg_login_form_shortcode');


// [pc-logout-box] 
// get the logout box
function pg_logout_box_shortcode( $atts, $content = null ) {	
	return pg_logout_btn($content);
}
add_shortcode('pc-logout-box', 'pg_logout_box_shortcode');


// [pc-registration-form] 
// get the registration form
function pg_registration_form_shortcode( $atts, $content = null ) {
	return pg_registration_form();	
}
add_shortcode('pc-registration-form', 'pg_registration_form_shortcode');


?>