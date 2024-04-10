<?php
////////////////////////////////////////////////
////// USER LIST - REMOVE //////////////////////
////////////////////////////////////////////////

// php handler
function delete_pg_user_php() {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	$user_id = trim(addslashes($_POST['pg_user_id'])); 

	if (!filter_var($user_id, FILTER_VALIDATE_INT)) {die( __('Error processing the action', 'pg_ml') );}
	
	$wpdb->query("UPDATE ".$table_name." SET status = 0 WHERE ID = '".$user_id."' ");
	
	echo 'success';
	die();	
}
add_action('wp_ajax_delete_pg_user', 'delete_pg_user_php');



////////////////////////////////////////////////
////// GET CATEGORY LIST FOR TINTMCE ///////////
////////////////////////////////////////////////

function pg_get_user_cats() {
	$cats_list = '<ul>';
	$user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
	
	if(!is_array($user_categories)) {$cats_list .= '<li>'. __('No categories found .. ', 'pg_ml') .'<br/><br/></li>';}
	else {
	  foreach ($user_categories as $ucat) {
		$cats_list .= '
		<li>
		  <input type="checkbox" name="categories[]" value="'.$ucat->term_id.'" />
		  <label>'.$ucat->name.'</label> 
		</li>';		
	  }		
	}
	
	echo $cats_list . '</ul>';
	die();	
}
add_action('wp_ajax_pg_get_user_cats', 'pg_get_user_cats');






?>