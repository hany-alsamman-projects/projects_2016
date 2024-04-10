<?php
// manage the private content
// - user private page
// - categories completely hidden


// function to know if a user have the access to a restricted area
// @param allowed = string with allowed categories
function pg_check_user_permiss($allowed) {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	if(!isset($_SESSION['pg_user_id'])) {return false;}
	else {
		// get user cats
		$user_categories = $wpdb->get_var(
			$wpdb->prepare( "SELECT categories FROM  ".$table_name." WHERE ID = '".$_SESSION['pg_user_id']."' AND status = 1 ") 
		);
		$cat_array = unserialize($user_categories);	
		
		if(!is_array($cat_array)) {return false;}
		else {
			// is all categoriess are allowed
			if($allowed == 'all') {return true;}
			else {
				
				$allowed_cats = explode(',', $allowed);
				
				$has_the_pass = false;
				foreach($cat_array as $u_cat) {
					if(in_array($u_cat, $allowed_cats)) {$has_the_pass = true; break;}	
				}
				
				return ($has_the_pass) ? true : false;		
			}	
		}
	}	
}

/////////////////////////////////////////////////


// if isset a specific page as user global login manage the page to display a plugin page
add_filter('the_content', 'pg_manage_user_global_login' );
function pg_manage_user_global_login($the_content) {
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
	$target_page = (int)get_option('pg_target_page');
	$curr_page_id = (int)get_the_ID();
	
	if($target_page == $curr_page_id) {
		// hide the page comments
		add_filter('comments_template', 'pg_comments_template');
		
		if(isset($_SESSION['pg_user_id'])) {
			$user_data = $wpdb->get_row( 
				$wpdb->prepare( "
					SELECT page_id, disable_pvt_page FROM  ".$table_name." 
					WHERE ID = '".$_SESSION['pg_user_id']."' AND status = 1
				") 
			);
			
			// if not have a reserved area
			if($user_data->disable_pvt_page == 1) {
				if(!get_option('pg_default_nhpa_mex')) {
					$nhpa_message = __("You don't have a reserved area", 'pg_ml');
				}
				else {$nhpa_message = get_option('pg_default_nhpa_mex');}
				
				$content = '<p>'.$nhpa_message.'</p>';	
			}
			
			else {
				// get user page content
				$page_data = get_post( $user_data->page_id );
				
				$content =  apply_filters('the_content', $page_data->post_content);
			}
			
			// se è loggato mostro il contenuto della pagina utente
			if(isset($content)) {$the_content = $content;}
		}
			
		// altrimeti stampo il contenuto in base alle impostazioni
		else {
			// preparo il form
			$login_form = pg_login_form();
			$pvt_nl_content = get_option('pg_target_page_content');
			
			// orig content
			if(!$pvt_nl_content || $pvt_nl_content == 'original_content') {
				$the_content = $the_content;
			}
			
			// orig + form
			elseif($pvt_nl_content == 'original_plus_form') {
				$the_content = $the_content . $login_form;   
			}
			
			// form + orif
			elseif($pvt_nl_content == 'form_plus_original') {
				$the_content = $login_form . $the_content;   
			}
			
			// only form
			else {$the_content = $login_form;}
		}

		return $the_content;
	}	
	
	else {return $the_content;}
}



/////////////////////////////////////////////////////////


// if the post category has a pg limitation, hide the content
add_filter( 'the_content', 'pg_manage_cat_limit_post' );
function pg_manage_cat_limit_post($the_content) {
	
	if(is_single()) {
		global $post;
	
		// check if term has PG limitations
		$terms = get_the_terms($post->ID, 'category');
		
		$pg_limit = '';
		if(is_array($terms)) {
			foreach($terms as $post_term) {
				if(get_option('taxonomy_'.$post_term->term_id.'_pg_cats')) {
					$pg_limit = get_option('taxonomy_'.$post_term->term_id.'_pg_cats');
					break;
				}
			}
		}

		// executing and adding the shortcode to content
		if($pg_limit != '') {
			
			if(pg_check_user_permiss($pg_limit)) { return $the_content; }
			else {
				add_filter('comments_template', 'pg_comments_template');	
				return 	'[pc-pvt-content allow="'.$pg_limit.'"]' . $the_content . '[/pc-pvt-content]';	
			}
		}
		
		else {return $the_content;}
	}
	else {return $the_content;}
}


// hack to hide comments on pvt pages 
function pg_comments_template($template){
    return PG_DIR . "/comment_hack.php";
}


///////////////////////////////////////////////////////////////


/* CHECK IF USER CAN SEE A REDIRECTED PAGE
 *
 * @param subj = subject to analyze (category or page)
 * @subj_data = data object of the subject
 */
function pg_redirect_check($subj, $subj_data) {
	if($subj == 'page') {
		if(get_post_meta($subj_data->ID, 'pg_redirect', true)) {
			$allowed = trim(implode(',', get_post_meta($subj_data->ID, 'pg_redirect', true)));
			
			if($allowed != '' && pg_user_check($allowed) != 1) {return false;}
			else {return true;}
		}
		// check parents page
		else {
			if($subj_data->post_parent != 0) {
				$parent = get_page($subj_data->post_parent);
				// recursive
				return pg_redirect_check('page', $parent);	
			}
			else {return true;}
		}
	}
	
	// category
	else {
		if(get_option('taxonomy_'.$subj_data->term_id.'_pg_redirect')) {
			$allowed = trim(get_option('taxonomy_'.$subj_data->term_id.'_pg_redirect'));

			if($allowed != '' && pg_user_check($allowed) != 1) {return false;}
			else {return true;}
		}
		// parent
		else {
			if($subj_data->category_parent != 0) {
				$parent = get_category($subj_data->category_parent, false);
				
				// recursive
				return pg_redirect_check('category', $parent);	
			}
			else {return true;}
		}
	}
}


// REDIRECT TO SPECIFIED PAGE 
function pg_pvt_redirect() {
	
	// only if redirect option is setted
	if(get_option('pg_redirect_page')) {
		// get redirect page url
		$redirect = (int)get_option('pg_redirect_page');
		$redirect_url = get_permalink($redirect);
		
		// single page/post redirect
		if(is_page() || is_single()) {
			global $post;
			
			if(!pg_redirect_check('page', $post)) {
				header('location: '.$redirect_url);
				die();	
			}
		}
		
		// if is category or archive
		if(is_category() || is_archive()) {
			$cat_data = get_category(get_query_var('cat'),false);
			
			if(!pg_redirect_check('category', $cat_data)) {
				header('location: '.$redirect_url);
				die();	
			}
		}
		
		// if is a single post (check category restriction)
		if(is_single()) {
			global $post;
			
			// get all the post terms
			$term_list = wp_get_post_terms($post->ID, 'category');
			foreach($term_list as $term) {
				$cat_data = get_category($term->term_id, false);
				if(!pg_redirect_check('category', $cat_data)) {
					header('location: '.$redirect_url);
					die();	
				}	
			}	
		}
	}	
}
add_action('template_redirect', 'pg_pvt_redirect', 1);


// CREATE AN ARRAY OF POSTS ID TO HIDE THEM IN FEEDS
function pg_pvt_redirect_post_array() {
	$exclude_array = array();
	
	$args = array( 'numberposts' => 10000000, 'post_status' => 'publish');
	$myposts = get_posts( $args );
	
	foreach( $myposts as $post ) { 
		
		if(!pg_redirect_check('page', $post)) {$exclude_array[] = $post->ID;}	
		else {
			$term_list = wp_get_post_terms($post->ID, 'category');
			foreach($term_list as $term) {
				$cat_data = get_category($term->term_id, false);
				if(!pg_redirect_check('category', $cat_data)) {$exclude_array[] = $post->ID;}	
			}		
		}
	}
	
	return $exclude_array;	
}


// CREATE AN ARRAY OF CATEGORIES ID TO HIDE THEM IN FEEDS
function pg_pvt_redirect_cat_array() {
	$exclude_array = array();
	
	$args = array( 'hide_empty' => 0);
	$categories = get_categories( $args );
	
	foreach( $categories as $category ) { 
		if(!pg_redirect_check('category', $category)) {$exclude_array[] = $category->term_id;}	
	}
	
	return $exclude_array;	
}

	
// HIDE RESTRICTED POSTS IN FEEDS
function pg_pvt_redirect_feeds($query) {
	if ( $query->is_feed) {
		$to_exclude_posts = pg_pvt_redirect_post_array(); 
		$query->set('post__not_in', $to_exclude_posts ); //Post ID array
		
		$to_exclude_cats = pg_pvt_redirect_cat_array(); 
		$exclude_cat = array();
        foreach($to_exclude_cats as $cat_id) {
			$exclude_cat[] = '-'.$cat_id;	
		}
		if(count($exclude_cat) > 0) {
			$exclude_cat_string = implode(',', $exclude_cat);
			$query->set('cat', $exclude_cat_string); //Category ID string
		}
    }
    return $query;
}
add_filter( 'pre_get_posts', 'pg_pvt_redirect_feeds' );	


/////////////////////////////////////////////////////////////////////

// SINGLE MENU ITEM CHECK
function pg_single_menu_check($items, $item_id) {
	foreach($items as $item) {
		if($item->ID == $item_id) {
			
			if($item->menu_item_parent) {
				$parent_check = pg_single_menu_check($items, $item->menu_item_parent);	
				if(!$parent_check) {return false;}
			}

			// se esiste l'array di utenti ammessi
			if(isset($item->pg_hide_item) && is_array($item->pg_hide_item)) {
				$allowed = implode(',', $item->pg_hide_item);
				
				if(pg_user_check($allowed) == 1) {return true;}	
				else {return false;}
			}	
		}		
	}
	
	return true;
}



// HIDE MENU ITEMS IF USER HAS NO PERMISSIONS
function pg_menu_filter($items) {	
	$new_items = array();
	
	foreach($items as $item) {
		
		if($item->menu_item_parent) {
			$parent_check = pg_single_menu_check($items, $item->menu_item_parent);	
		}
		else {$parent_check = true;}
		
		if($parent_check) {
			// se esiste l'array di utenti ammessi
			if(isset($item->pg_hide_item) && is_array($item->pg_hide_item)) {
				$allowed = implode(',', $item->pg_hide_item);
				
				if(pg_user_check($allowed) == 1) {$new_items[] = $item;}	
			}
			else {$new_items[] = $item;}
		}
	}
	
	return $new_items;
}
add_action( 'wp_nav_menu_objects', 'pg_menu_filter' );



?>