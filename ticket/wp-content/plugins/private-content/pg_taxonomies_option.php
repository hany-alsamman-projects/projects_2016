<?php
// add visibility option to all the public taxonomies


// add the fields
add_action('category_add_form_fields','pg_taxonomy_pvt_content', 10, 2 );
add_action("category_edit_form_fields" , "pg_taxonomy_pvt_content", 10, 2);
add_action('category_add_form_fields','pg_taxonomy_redirect', 10, 2 );
add_action("category_edit_form_fields" , "pg_taxonomy_redirect", 10, 2);


// ALLOW CONTENT OPTION
function pg_taxonomy_pvt_content($tax_data) {
   //check for existing taxonomy meta for term ID
   if(is_object($tax_data)) {
	  $term_id = $tax_data->term_id;
	  $tax_pg_cat = get_option("taxonomy_".$term_id."_pg_cats");
	  $tax_pg_cat = explode(',', $tax_pg_cat);
	}
	else {$tax_pg_cat = array();}
	
	// creator layout
	if(!is_object($tax_data)) :
?>
		<div class="form-field">
            <label><?php _e('<strong>PrivateContent Hide Post Contents</strong><br/> Which user categories can see the post contents?', 'pg_ml'); ?></label>
            
            <ul class="tax_cat_list" style="float: none;">
            	<li>
                  <input type="checkbox" name="pg_pvt_categories[]" value="all" />
                  <label><?php _e('All') ?></label> 
                </li>
                
            <?php
            $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
            foreach ($user_categories as $ucat) {
                echo '
                <li>
                  <input type="checkbox" name="pg_pvt_categories[]" value="'.$ucat->term_id.'" />
                  <label>'.$ucat->name.'</label> 
                </li>
                ';  
            }
            ?>
            </ul>
        </div>
	<?php
	else:
	?>
	 <tr class="form-field">
      <th scope="row" valign="top"><label><?php _e('<strong>PrivateContent Hide Post Contents</strong><br/> Which user categories can see the post contents?', 'pg_ml'); ?></label></th>
      <td>
    	<ul class="tax_cat_list">
        	<?php ($tax_pg_cat[0] == 'all') ? $tax_pg_all = 'checked="checked"' : $tax_pg_all = ''; ?>
            <li>
              <input type="checkbox" name="pg_pvt_categories[]" value="all" <?php echo $tax_pg_all; ?> />
              <label><?php _e('All') ?></label> 
            </li>
        
		<?php
        $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
        foreach ($user_categories as $ucat) {
            (in_array($ucat->term_id, $tax_pg_cat)) ? $check_cat = 'checked="checked"' : $check_cat = '';
            
            echo '
            <li>
              <input type="checkbox" name="pg_pvt_categories[]" value="'.$ucat->term_id.'" '.$check_cat.' />
              <label>'.$ucat->name.'</label> 
            </li>
            ';  
        }
        ?>
        </ul>
      </td>
    </tr>
<?php
	endif;
}


// REDIRECT OPTION
function pg_taxonomy_redirect($tax_data) {
   //check for existing taxonomy meta for term ID
   if(is_object($tax_data)) {
	  $term_id = $tax_data->term_id;
	  $tax_pg_red = get_option("taxonomy_".$term_id."_pg_redirect");
	  $tax_pg_red = explode(',', $tax_pg_red);
	}
	else {$tax_pg_red = array();}
	
	// creator layout
	if(!is_object($tax_data)) :
?>
		<div class="form-field">
            <label><?php _e('<strong>PrivateContent Redirect</strong><br/> Which user categories can see the contents?', 'pg_ml'); ?></label>
            
            <ul class="tax_cat_list" style="float: none;">
            	<li>
                  <input type="checkbox" name="pg_red_categories[]" value="all" />
                  <label><?php _e('All') ?></label> 
                </li>
            
            <?php
            $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
            foreach ($user_categories as $ucat) {
                echo '
                <li>
                  <input type="checkbox" name="pg_red_categories[]" value="'.$ucat->term_id.'" />
                  <label>'.$ucat->name.'</label> 
                </li>
                ';  
            }
            ?>
            </ul>
        </div>
	<?php
	else:
	?>
	 <tr class="form-field">
      <th scope="row" valign="top"><label><?php _e('<strong>PrivateContent Redirect</strong><br/> Which user categories can see the contents?', 'pg_ml'); ?></label></th>
      <td>
    	<ul class="tax_cat_list">
        	<?php ($tax_pg_red[0] == 'all') ? $tax_pg_all = 'checked="checked"' : $tax_pg_all = ''; ?>
            <li>
              <input type="checkbox" name="pg_red_categories[]" value="all" <?php echo $tax_pg_all; ?> />
              <label><?php _e('All') ?></label> 
            </li>
        
		<?php
        $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
        foreach ($user_categories as $ucat) {
            (in_array($ucat->term_id, $tax_pg_red)) ? $check_cat = 'checked="checked"' : $check_cat = '';
            
            echo '
            <li>
              <input type="checkbox" name="pg_red_categories[]" value="'.$ucat->term_id.'" '.$check_cat.' />
              <label>'.$ucat->name.'</label> 
            </li>
            ';  
        }
        ?>
        </ul>
      </td>
    </tr>
<?php
	endif;
}




// save the fields
add_action('created_category', 'save_pg_cat_taxonomy', 10, 2);
add_action('edited_category', 'save_pg_cat_taxonomy', 10, 2);
add_action('created_category', 'save_pg_red_taxonomy', 10, 2);
add_action('edited_category', 'save_pg_red_taxonomy', 10, 2);


// SAVE ALLOW CONTENT OPTION
function save_pg_cat_taxonomy( $term_id ) {
	
    if ( isset($_POST['pg_pvt_categories']) ) {
		
		// check if ALL is selected
		if(in_array('all', $_POST['pg_pvt_categories'])) {
			$tax_pg_cat = 'all';	
		}
		else {
			$tax_pg_cat = implode(',', $_POST['pg_pvt_categories']);
		}
		
		//save the option array
        update_option("taxonomy_".$term_id."_pg_cats", $tax_pg_cat); 
    }
	else {delete_option("taxonomy_".$term_id."_pg_cats");}
}


// SAVE REDIRECT CONTENTS OPTION
function save_pg_red_taxonomy( $term_id ) {
	
    if ( isset($_POST['pg_red_categories']) ) {
		
		// check if ALL is selected
		if(in_array('all', $_POST['pg_red_categories'])) {
			$tax_pg_red = 'all';	
		}
		else {
			$tax_pg_red = implode(',', $_POST['pg_red_categories']);
		}
		
		//save the option array
        update_option("taxonomy_".$term_id."_pg_redirect", $tax_pg_red); 
    }
	else {delete_option("taxonomy_".$term_id."_pg_redirect");}
}




/////////////////////////////////////////////////////////////////////////


// manage category taxonomy table
add_filter( 'manage_edit-category_columns', 'pg_category_column_headers', 10, 1);
add_filter( 'manage_category_custom_column', 'pg_category_column_row', 10, 3);


// ALLOW CONTENT - add the table column
// REDIRECT CONTENTS - add the table column
function pg_category_column_headers($columns) {
    $columns_local = array();
	
    if (!isset($columns_local['pg_hide'])) { 
        $columns_local['pg_hide'] = "PC Hide";
	}
	
    if (!isset($columns_local['pg_redirect'])) { 
        $columns_local['pg_redirect'] = "PC Redirect";
	}

    return array_merge($columns, $columns_local);
}


// ALLOW CONTENT - fill the custom column rows
// REDIRECT CONTENTS - fill the custom column rows
function pg_category_column_row( $row_content, $column_name, $term_id){
	
	if($column_name == 'pg_hide') {
		if(get_option('taxonomy_'.$term_id.'_pg_cats')) {	
			$cat_allowed = get_option('taxonomy_'.$term_id.'_pg_cats');
			
			if($cat_allowed == 'all') {return __('All');}
			else {
				$allow_array = explode(',', $cat_allowed);
				$allow_string = '<ul style="margin: 0;">';
				
				foreach($allow_array as $allow) {
					$term_data = get_term( $allow, 'pg_user_categories'); 
					
					if(is_object($term_data)) {
						$allow_string .= '<li>'.$term_data->name.'</li>'; 	
					}
				}
				
				return $allow_string . '</ul>';
			}
		}
		
		else {return '&nbsp;';}
	}
	
	else if($column_name == 'pg_redirect') {
		if(get_option('taxonomy_'.$term_id.'_pg_redirect')) {	
			$cat_allowed = get_option('taxonomy_'.$term_id.'_pg_redirect');
			
			if($cat_allowed == 'all') {return __('All');}
			else {
				$allow_array = explode(',', $cat_allowed);
				$allow_string = '<ul style="margin: 0;">';
				
				foreach($allow_array as $allow) {
					$term_data = get_term( $allow, 'pg_user_categories'); 
					
					if(is_object($term_data)) {
						$allow_string .= '<li>'.$term_data->name.'</li>'; 	
					}
				}
				return $allow_string . '</ul>';
			}
		}
		else {return '&nbsp;';}
	}
	
	else {return '&nbsp;';}
}



?>