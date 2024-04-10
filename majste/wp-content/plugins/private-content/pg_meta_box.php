<?php
// post and page metabox 

add_action('admin_init','pg_redirect_meta_init'); 
function pg_redirect_meta_init() {
    // add a meta box for each of the wordpress page types: posts and pages
    foreach (array('post','page') as $type){
        add_meta_box('pg_redirect_meta', 'PrivateContent Redirect', 'pg_redirect_meta_setup', $type, 'side', 'default');
    }
	
    // add a callback function to save any data a user enters in
    add_action('save_post','pg_redirect_meta_save');
}
 
 
// create box 
function pg_redirect_meta_setup() {
    global $post;
 	
	// check for existing values
    $pg_redirect = get_post_meta($post->ID, 'pg_redirect', true);
	if(!$pg_redirect) {$pg_redirect = array();}
   ?>
   	 <p><?php _e('Which PrivateContent categories can see the page?', 'pg_ml') ?></p>
   
   	 <div class="pg_sidemeta_catlist">
      <ul class="tax_cat_list">
          <?php (isset($pg_redirect[0]) && $pg_redirect[0]=='all') ? $pg_redirect_all = 'checked="checked"' : $pg_redirect_all = ''; ?>
          <li>
            <input type="checkbox" name="pg_redirect[]" value="all" <?php echo $pg_redirect_all; ?> />
            <label><?php _e('All') ?></label> 
          </li>
      
      <?php
      $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
      foreach ($user_categories as $ucat) {
          (in_array($ucat->term_id, $pg_redirect)) ? $check_cat = 'checked="checked"' : $check_cat = '';
          
          echo '
          <li>
            <input type="checkbox" name="pg_redirect[]" value="'.$ucat->term_id.'" '.$check_cat.' />
            <label>'.$ucat->name.'</label> 
          </li>
          ';  
      }
      ?>
      </ul>
     </div>    
	<?php
    // create a custom nonce for submit verification later
    echo '<input type="hidden" name="pg_redirect_noncename" value="' . wp_create_nonce(__FILE__) . '" />';
}
 
 
// save 
function pg_redirect_meta_save($post_id) {
	if(isset($_POST['pg_redirect_noncename'])) {
		// authentication checks
		// make sure data came from our meta box
		if (!wp_verify_nonce($_POST['pg_redirect_noncename'], __FILE__)) return $post_id;

		// check user permissions
		if ($_POST['post_type'] == 'page') {
			if (!current_user_can('edit_page', $post_id)) return $post_id;
		}
		else {
			if (!current_user_can('edit_post', $post_id)) return $post_id;
		}

		// take the passed data
		$pg_redirect = $_POST['pg_redirect'];
		
		// sanitize - if all is selected, discard the rest
		if(!isset($pg_redirect)) {$pg_redirect == array();}
		else {
			if($pg_redirect[0] == 'all') {$pg_redirect = array('all');}	
		}
		
		delete_post_meta($post_id, 'pg_redirect');
		add_post_meta($post_id, 'pg_redirect', $pg_redirect, true);
	}
 
    return $post_id;
}


/////////////////////////////////////////////////////////////////////


// add column in catgory table
add_filter('manage_posts_columns', 'pg_redirect_table_col');
add_filter('manage_pages_columns', 'pg_redirect_table_col');
function pg_redirect_table_col($columns) {
    $columns['pg_redirect'] = 'PC Redirect';
    return $columns;
}

add_action('manage_posts_custom_column',  'show_pg_redirect_table_col');
add_action('manage_pages_custom_column',  'show_pg_redirect_table_col');
function show_pg_redirect_table_col($column){
  global $post;

  if($column == 'pg_redirect') {	
	  if(get_post_meta($post->ID, 'pg_redirect', true) && count(get_post_meta($post->ID, 'pg_redirect', true)) > 0) {	
	  
		  $cat_allowed = get_post_meta($post->ID, 'pg_redirect', true);
		  
		  if($cat_allowed[0] == 'all') { _e('All'); }
		  else {
			  $allow_string = '<ul style="margin: 0;">';
			  
			  foreach($cat_allowed as $allow) {
				  $term_data = get_term( $allow, 'pg_user_categories'); 
				  
				  if(is_object($term_data)) {
					  $allow_string .= '<li>'.$term_data->name.'</li>'; 	
				  }
			  }
			  
			  echo $allow_string . '</ul>';
		  }  
	  }
	  else {echo'&nbsp;';}
  }
}

?>