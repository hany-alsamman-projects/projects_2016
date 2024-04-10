<?php
// public utilities


/* CHECK IF A USER IS LOGGED */
function pg_user_logged() {
	if(!isset($_SESSION['pg_user_id'])) {return false;}
	
	else {
		global $wpdb;
		$table_name = $wpdb->prefix . "pg_users";
		
		$user_data = $wpdb->get_row( 
			$wpdb->prepare( "SELECT * FROM  ".$table_name." WHERE id = '".$_SESSION['pg_user_id']."' AND status = 1 ") 
		);
		
		return $user_data;	
	}
}


/* CHECK IF CURRENT USER CAN ACCESS TO AN AREA
 *  given the allowed param, check if the user have the right permissions
 *
 * @param allowed = allowed user categories
 *		single 	= all users 	
 *		all 	= all categories
 * 		string of cat id: NUM,NUM,NUM
 *
 * return
 *	false = non logged
 * 	2 = user have no permissions
 *  1 = right access
 */
function pg_user_check($allowed = 'all') {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	$allowed_cat_arr = explode(',', $allowed);
	
	// if is a logged wordpress user return the content
	if ( is_user_logged_in()) {return 1;}
	else {
	
		// try to retrieve the current user ID
		if(!isset($_SESSION['pg_user_id'])) {return false;}
		else {	
			$user_id = $_SESSION['pg_user_id'];
			
			// if the allow parameter is set to ALL, return content
			if($allowed_cat_arr[0] == 'all') {return 1;}
			else {
			
				// get the user categories
				$user_categories = $wpdb->get_var( 
					$wpdb->prepare( "SELECT categories FROM  ".$table_name." WHERE ID = '".$user_id."' ") 
				);

				$cat_array = unserialize($user_categories);
				
				if(!is_array($cat_array)) {return false;}
				else {
					
					// search if the user categories are in the shortcode's allowed
					$has_the_pass = false;
					foreach($cat_array as $u_cat) {
						if(in_array($u_cat, $allowed_cat_arr)) {$has_the_pass = true; break;}	
					}
					
					return ($has_the_pass) ? 1 : 2;	
				}	
			}
		}
	}
}


/* GET THE MESSSAGE FOR NON LOGGED USERS 
 * @param mess = override the default message with a custom one
 */
function get_nl_message($mess = '') {
	if($mess == '') {
		if(!get_option('pg_default_nl_mex')) {$message = __('You must be logged in to view this content', 'pg_ml');}
		else {$message = get_option('pg_default_nl_mex');}	
		
		return $message;
	}
	else {return $mess;}
}


/* GET THE MESSSAGE FOR USER THAT HAVEN'T THE RIGT PERMISSIONS
 * @param mess = override the default message with a custom one
 */
function get_uca_message($mess = '') {
	if($mess == '') {
		if(!get_option('pg_default_uca_mex')) {
			$message = __("Sorry, you don't have the right permissions to view this content", 'pg_ml');
		}
		else {$message = get_option('pg_default_uca_mex');}
		
		return $message;
	}
	else {return $mess;}
}



/* GET THE LOGIN FORM
 * print the login form
 *
 * @param allowed = allowed user categories
 *		single 	= all users 	
 *		all 	= all categories
 * 		string of cat id: NUM,NUM,NUM
 */
function pg_login_form($allowed = 'single') {
	$form = '
	<form class="pg_inline_login_form">
		<input type="hidden" name="auca" value="'.$allowed.'" id="pg_auth_auca" />
		
		<label>'. __('Username') .'</label>
		<input type="text" name="pg_auth_username" value=""  />
		
		<br/>
		
		<label>'. __('Password') .'</label>
		<input type="password" name="pg_auth_psw" value=""  />
		
		<br/>
		<div id="pg_auth_message"></div>

		<input type="button" class="pg_auth_btn" value="'. __('Login') .'" />
		<div class="pg_loginform_loader"></div>
	</form>
	';
	
	if(pg_user_logged()) {return false;}
	else {return $form;}
}


/* GET THE LOGOUT CODE
 * print the logout trigger (remember to use the "pg_logout_btn" class)
 *
 * @param code = logout trigger code
 */
function pg_logout_btn($code = '') {
	
	$logout = '<div class="pg_logout_box"><span class="pg_logout_btn">'. __('Logout', 'pg_ml') .'</span> </div>';
	
	if($code != '') {$logout = $code;}
	
	if(!pg_user_logged()) {return false;}
	else {
		return $logout;
	}
}



/* LOGGING OUT USER */
function pg_logout() {
	if(pg_user_logged()) {unset($_SESSION['pg_user_id']);}
	
	return true;	
}


/* REGISTRATION FORM */
function pg_registration_form() {
	include_once(PG_DIR.'/functions.php');
	include_once(PG_DIR.'/classes/recaptchalib.php');
	
	// if is not set the target user category, return an error
	if(!get_option('pg_registration_cat') || !get_option('pg_registration_form')) {
		return __('You have to set the default category for registered users.');
	}
	else {
		$form_structure = get_option('pg_registration_form');	
		
		$form = '
		<script type="text/javascript">
		 var RecaptchaOptions = {
			theme : "white"
		 };
		 </script>
		
		<form class="pg_registration_form">';
		
		// re-captcha
		if(!get_option('pg_disable_recaptcha')) {
			$publickey = "6LfQas0SAAAAAIdKJ6Y7MT17o37GJArsvcZv-p5K";
			$captcha = '<li>' . pg_recaptcha_get_html($publickey) . '</li>';
		}
		else {$captcha = false;}
		
		$form .= pg_form_generator($form_structure, $captcha);
	
		$form .= '
		<div id="pg_reg_message"></div>

		<input type="button" class="pg_reg_btn" value="'. __('Submit') .'" />
		<div class="pg_loginform_loader"></div>
		
		</form>
		';
		
		return $form;
	}
}

?>