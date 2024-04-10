<?php
// script to handle the AJAX request on the frontend and register the user


// HANDLE THE AJAX FORM SUBMIT
add_action('init', 'pg_register_user', 2);
function pg_register_user() {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
		
	if(isset($_POST['type']) && $_POST['type'] == 'js_ajax_registration') {
		include_once(PG_DIR.'/functions.php');
		require_once(PG_DIR . '/classes/simple_form_validator.php');
		require_once(PG_DIR.'/classes/recaptchalib.php');

		////////// VALIDATION ////////////////////////////////////
		
		$form_structure = get_option('pg_registration_form');	

		$validator = new simple_fv;		
		$indexes = pg_validator_generator($form_structure);
				
		// re-captcha catch
		if(!get_option('pg_disable_recaptcha')) {
			$indexes[] = array('index'=>'recaptcha_challenge_field', 'label'=>'reCAPTCHA');
			$indexes[] = array('index'=>'recaptcha_response_field', 'label'=>'reCAPTCHA');
		}


		$validator->formHandle($indexes);
		$error = $validator->getErrors();
		$fdata = $validator->form_val;
		
		// re-captcha validation
		if(!get_option('pg_disable_recaptcha')) {
			$privatekey = "6LfQas0SAAAAAIzpthJ7UC89nV9THR9DxFXg3nVL";
			$resp = pg_recaptcha_check_answer ($privatekey,
											$_SERVER["REMOTE_ADDR"],
											$fdata['recaptcha_challenge_field'],
											$fdata['recaptcha_response_field']);
		   if (!$resp->is_valid) {
			   $validator->custom_errors[__("reCAPTCHA" )] = __("wasn't entered correctly", 'pg_ml');
		   } 
		}
		
		
		// check username unicity
		if(trim($fdata['username']) != '') {
			$wpdb->query("SELECT ID FROM ".$table_name." WHERE username = '".$fdata['username']."' AND status != 0");
			if($wpdb->num_rows > 0) {$validator->custom_error[__("Username", 'pg_ml')] =  __("Another user already has this username", 'pg_ml');}
		}
		
		$error = $validator->getErrors();
		
		if($error) {
			$mess = json_encode(array( 
				'resp' => 'error',
				'mess' => $error
			));
			die($mess);
		}
		else {
			//// REGISTRATION /////////////////////////

			// create array for the query
			foreach($fdata as $fkey => $fval) {
				// index to avoid
				$avoid = array('check_psw', 'recaptcha_challenge_field', 'recaptcha_response_field');
				
				if(!in_array($fkey, $avoid)) {$query_arr[$fkey] = $fval;}
			}
			
			// create the user page
			$new_entry = array();
			$new_entry['post_author'] = 1;
			$new_entry['post_content'] = get_option('pg_pvtpage_default_content');
			$new_entry['post_status'] = 'publish';
			$new_entry['post_title'] = $fdata['username'];
			$new_entry['post_type'] = 'pg_user_page';
			$entry_id = wp_insert_post( $new_entry, true );
			
			if(!$entry_id) {
				$mess = json_encode(array( 
					'resp' => 'error',
					'mess' => __('Error during user registration, contact the website administrator', 'pg_ml')
				));
				die($mess);
			}
			else {
				$fdata = pg_strip_opts($fdata);

				// set automatically to status 1?
				(get_option('pg_registered_pending')) ? $status = 3 : $status = 1;
				
				// enable private page?
				(get_option('pg_registered_pvtpage ')) ? $pp_status = 0 : $pp_status = 1;
				
				// add
				$query_arr = array();
				
				$standard_fields = array('name', 'surname', 'username', 'email', 'tel');
				foreach($standard_fields as $sf) {
					if(isset($fdata[$sf])) {$query_arr[$sf] = $fdata[$sf];}	
				}
				
				$query_arr['insert_date'] = date("Y-m-d H:i:s"); // add insert date
				$query_arr['page_id'] = $entry_id;
				$query_arr['psw'] = base64_encode($fdata['psw']);
				$query_arr['categories'] = serialize(array(get_option('pg_registration_cat')));
				$query_arr['status'] = $status;
				$query_arr['disable_pvt_page'] = $pp_status;
				$wpdb->insert($table_name, $query_arr);	

				$user_id = $wpdb->insert_id;


				//////////////////////////////////////////////////////////////
				// CUSTOM DATA SAVING - USER DATA ADD-ON
				do_action( 'pcud_save_custom_data', $fdata, $user_id);
				//////////////////////////////////////////////////////////////
				
				
				// success message
				if(get_option('pg_default_sr_mex')) { $mex = get_option('pg_default_sr_mex'); }
				else {$mex = __('Registration was succesful. Welcome!', 'pg_ml');}
				
				// registered user redirect
				$target = (int)get_option('pg_registered_user_redirect');
				($target != 0) ? $redirect_url = get_permalink($target): $redirect_url = '';
				
				$mess = json_encode(array( 
					'resp' 		=> 'success',
					'mess' 		=> $mex,
					'redirect'	=> $redirect_url
				));
				die($mess);
			}
		}
		die(); // security block
	}
}

?>