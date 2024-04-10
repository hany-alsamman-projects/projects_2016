<?php 

// get file extension from a filename
function pg_stringToExt($string) {
	$pos = strrpos($string, '.');
	$ext = strtolower(substr($string,$pos));
	return $ext;	
}


// get filename without extension
function pg_stringToFilename($string, $raw_name = false) {
	$pos = strrpos($string, '.');
	$name = substr($string,0 ,$pos);
	if(!$raw_name) {$name = ucwords(str_replace('_', ' ', $name));}
	return $name;	
}


// string to url format
function pg_stringToUrl($string){
	$trans = array("à" => "a", "è" => "e", "é" => "e", "ò" => "o", "ì" => "i", "ù" => "u");
	$string = trim(strtr($string, $trans));
	$string = preg_replace('/[^a-zA-Z0-9-.]/', '_', $string);
	$string = preg_replace('/-+/', "_", $string);
	return $string;
}


// normalize a url string
function pg_urlToName($string) {
	$string = ucwords(str_replace('_', ' ', $string));
	return $string;	
}


// stripslashes for options inserted
function pg_strip_opts($fdata) {
	if(!is_array($fdata)) {return false;}
	
	foreach($fdata as $key=>$val) {
		if(!is_array($val)) {
			$fdata[$key] = stripslashes($val);
		}
		else {
			$fdata[$key] = array();
			foreach($val as $arr_val) {$fdata[$key][] = stripslashes($arr_val);}
		}
	}
	
	return $fdata;
}


// manage the form creator checks
function pg_reg_form_check($index, $type = 'include') {
	$reg_form_data = get_option('pg_registration_form');
	
	if($reg_form_data) {
		if(in_array($index, $reg_form_data[$type])) {return 'checked="checked"';}
		else {return false;}
	}
	else {return false;}	
}


// return all the fields available to use
function pg_form_fields($field = false, $order = true) {
	$fields = array(
		'name' => array(
			'label' 	=> __('Name', 'pg_ml'),
			'type' 		=> 'text',
			'subtype' 	=> '',
			'maxlen' 	=> 150,
			'opt'		=> '',
			'note' 		=> 'User name'
		),
		'surname' => array(
			'label' 	=> __('Surname', 'pg_ml'),
			'type' 		=> 'text',
			'subtype' 	=> '',
			'maxlen' 	=> 150,
			'opt'		=> '',
			'note'		=> 'User Surname'
		),
		'username' => array(
			'label' 	=> __('Username'),
			'type' 		=> 'text',
			'subtype' 	=> '',
			'maxlen' 	=> 150,
			'opt'		=> '',
			'note' 		=> 'Username used for the login',
			'sys_req' 	=> true,
		),
		'psw' => array(
			'label' 	=> __('Password'),
			'type' 		=> 'password',
			'subtype' 	=> '',
			'maxlen' 	=> 150,
			'opt'		=> '',
			'note' 		=> 'Password used for the login',
			'sys_req' 	=> true
		),
		'email' => array(
			'label' 	=> __('E-Mail', 'pg_ml'),
			'type' 		=> 'text',
			'subtype' 	=> 'email',
			'maxlen' 	=> 255,
			'opt'		=> '',
			'note' 		=> 'User E-mail'
		),
		'tel' => array(
			'label' 	=> __('Telephone', 'pg_ml'),
			'type' 		=> 'text',
			'subtype' 	=> '',
			'maxlen' 	=> 20,
			'opt'		=> '',
			'note' 		=> 'User Telephone'
		)
	);	
	
	// ADD FIELDS - WP FILTER
	$fields = apply_filters( 'pg_form_fields_filter', $fields);


	if(!$field) { return $fields; }
	else {
		return (isset($fields[$field])) ? $fields[$field] : false;
	}
}


// return the registration form fields - already orderd
function pg_reg_form_fields($field = false, $order = true) {
	$fields = pg_form_fields();
	
	if(!$field) {
		// order the fields and move at the end the un-odered indexes
		if(get_option('pg_field_order')) {
			foreach(get_option('pg_field_order') as $ord_field) {
				if(isset($fields[$ord_field])) {
					$ord_fields[$ord_field] = $fields[$ord_field];
					unset($fields[$ord_field]);	
				}
			}
			
			if(is_array($fields)) {
				foreach($fields as $index => $val) { $ord_fields[$index] = $val; }
			}
			
			return $ord_fields;
		}
		else {return $fields;}
	}
	else {
		return (isset($fields[$field])) ? $fields[$field] : false;
	}
}


// easy validator - field array generator
//// $fields = ('(array)include', '(array)require')
function pg_validator_generator($fields) {
	$included = $fields['include'];
	$required = $fields['require'];
	
	if(!is_array($included)) {return false;}
	
	$indexes = array();
	$a = 0;
	foreach($included as $index) {
		$fval = pg_form_fields($index);

		// index
		$indexes[$a]['index'] = $index;
		
		// label
		$indexes[$a]['label'] = utf8_decode($fval['label']);
		
		// required
		if(in_array($index, $required)) {$indexes[$a]['required'] = true;}
		
		// maxlenght
		if($fval['type'] == 'text' && $fval['subtype'] == '') {$indexes[$a]['maxlen'] = $fval['maxlen'];}
		
		// specific types
		if($fval['type'] == 'text' && $fval['subtype'] != '') {
			$indexes[$a]['type'] = $fval['subtype'];
		}

		////////////////////////////
		// password check validation
		if($index == 'psw') {
			// add fields check
			$indexes[$a]['equal'] = 'check_psw';
			
			// check psw validation
			$a++;
			$indexes[$a]['index'] = 'check_psw';
			$indexes[$a]['label'] = __('Repeat', 'pg_ml') .' '.$fval['label'];
			$indexes[$a]['maxlen'] = $fval['maxlen'];
		}

		$a++;	
	}
	
	return $indexes;
}


// form generator
//// $fields = ('(array)include', '(array)require')
function pg_form_generator($fields, $manual_fields = false, $user_id = false) {
	$included = $fields['include'];
	$required = $fields['require'];
	
	if(!is_array($included)) {return false;}
	
	// if is specified the user id get the data to fill the field
	($user_id) ? $ud = pg_get_user_full_data($user_id) : $ud = false;

	
	$form = '<ul class="pg_form_flist">';
	foreach($included as $field) {
		$fdata = pg_form_fields($field);		
		if($fdata) {
			// required message
			if(!in_array($field, $required)) {$req = '';}
			else {$req = '<span class="pg_req_field">*</span>';}
			
			// options for specific types
			$opts = pg_form_get_options($fdata['opt']);
			
			
			// text types
			if($fdata['type'] == 'text') {
				($ud) ? $val = $ud[$field] : $val = false;
				$form .= '
				<li>
					<label>'. utf8_decode(__($fdata['label'], 'pg_ml')) .' '.$req.'</label>
					<input type="'.$fdata['type'].'" name="'.$field.'" value="'.$val.'" maxlength="' . $fdata['maxlen'] . '"  />
				</li>';		
			}
			
			// password type
			elseif($fdata['type'] == 'password') {					
				$form .= '
				<li>
					<label>'. utf8_decode(__($fdata['label'], 'pg_ml')) .' '.$req.'</label>
					<input type="'.$fdata['type'].'" name="'.$field.'" value="" maxlength="' . $fdata['maxlen'] . '"  />
				</li>
				<li>	
					<label>'. __('Repeat') .' '. __($fdata['label'], 'pg_ml') .' '.$req.'</label>
					<input type="'.$fdata['type'].'" name="check_'.$field.'" value="" maxlength="' . $fdata['maxlen'] . '"  />
				
				</li>';			
			}
			
			// textarea
			elseif($fdata['type'] == 'textarea') {
				($ud) ? $val = $ud[$field] : $val = false;
				$form .= '
				<li>
					<label class="pg_textarea_label">'. utf8_decode(__($fdata['label'], 'pg_ml')) .' '.$req.'</label>
					<textarea name="'.$field.'" class="pg_textarea">'.$val.'</textarea>
				
				</li>';		
			}
			
			// select
			elseif($fdata['type'] == 'select') {	
				$form .= '
				<li>
					<label>'. utf8_decode(__($fdata['label'], 'pg_ml')) .' '.$req.'</label>
					<select name="'.$field.'">';
				
				foreach($opts as $opt) { 
					($ud && $ud[$field] == $opt) ? $sel = 'selected="selected"' : $sel = false;
					$form .= '<option value="'.$opt.'" '.$sel.'>'.$opt.'</option>'; 
				}
				
				$form .= '
					</select>
				</li>';			
			}
			
			// checkbox
			elseif($fdata['type'] == 'checkbox') {	
				$form .= '
				<li>
					<label>'. utf8_decode(__($fdata['label'], 'pg_ml')) .' '.$req.'</label>
					<div class="pg_check_wrap">';
					
					foreach($opts as $opt) { 
						($ud && is_array($ud[$field]) && in_array($opt, $ud[$field])) ? $sel = 'checked="checked"' : $sel = false;
						$form .= '<input type="checkbox" name="'.$field.'[]" value="'.$opt.'" '.$sel.' /> <label class="pg_check_label">'.$opt.'</label>'; 
					}
				$form .= '
					</div>
					<div style="clear: both;"></div>
				</li>';
			}
		}
	}
	
	if($manual_fields) { $form = $form . $manual_fields;}
	return $form . '</ul>';
}


// create the options for the select, checkbox and radio
function pg_form_get_options($opts) {
	if(trim($opts) == '') {return false;}
	
	$opts_arr = explode(',', $opts);
	foreach($opts_arr as $opt) {
		$right_opts[] = trim($opt);	
	}
	return $right_opts;
}


// get user data to fill the fields in the form generator
function pg_get_user_full_data($user_id) {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	$user_data = array();
	
	// standard data
	$standard_fields = array('id', 'insert_date', 'name', 'surname', 'username', 'email', 'tel');
	$standard_data = $wpdb->get_results( 
		$wpdb->prepare("SELECT ".implode(',', $standard_fields)." FROM  ".$table_name." WHERE id = '".$user_id."' AND status = 1") 
	);
	
	$standard_data = $standard_data[0];
	foreach($standard_fields as $standard_field) {
		$user_data[$standard_field] = $standard_data->$standard_field;	
	}
	
	///////////////////////////////////////////////////////////////////
	// CUSTOM DATA - USER DATA ADD-ON
	$user_data = apply_filters( 'pcud_get_user_custom_data', $user_data, $user_id);
	///////////////////////////////////////////////////////////////////	
	
	return $user_data;
}

?>