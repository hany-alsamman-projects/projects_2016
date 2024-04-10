<?php
// setting up USER MANAGEMENT admin menù
function pg_users_admin_menu() {	
	$menu_img = PG_URL.'/img/users_icon.png'; 
	$capability = 'upload_files';
	
	add_menu_page('PrivateContent', 'PrivateContent', $capability, 'pg_user_manage', 'pg_users_overview', $menu_img, 45);
	
	// submenus
	add_submenu_page('pg_user_manage', __('All users', 'pg_ml'), __('All users', 'pg_ml'), $capability, 'pg_user_manage', 'pg_users_overview');
	add_submenu_page('pg_user_manage', 'Add User', 'Add User', $capability, 'pg_add_user', 'pg_add_user');	
	add_submenu_page('pg_user_manage', 'User Categories', 'User Categories', $capability, 'edit-tags.php?taxonomy=pg_user_categories');
	add_submenu_page('pg_user_manage', 'Export Users', 'Export Users', $capability, 'pg_export_users', 'pg_export_users');
}
add_action('admin_menu', 'pg_users_admin_menu');


// fix to set the taxonomy and user pages as menù page sublevel
function user_cat_tax_menu_correction($parent_file) {
	global $current_screen;

	// hack for taxonomy
	if(isset($current_screen->taxonomy)) {
		$taxonomy = 'pg_user_categories';
		if($taxonomy == $current_screen->taxonomy) {
			$parent_file = 'pg_user_manage';
		}	
	}
	
	// hack for user pages
	if(isset($current_screen->base)) {
		$page_type = 'pg_user_page';
		if($current_screen->base == 'post' && $current_screen->id == $page_type) {
			$parent_file = 'pg_user_manage';
		}
	}
	
	return $parent_file;
}
add_action('parent_file', 'user_cat_tax_menu_correction');



////////////////////////////////////////////
// USER MANAGEMENT PAGES ///////////////////
////////////////////////////////////////////

// user pages basedir
$pg_user = PG_DIR . '/users/';


// USER LIST VIEW
function pg_users_overview() {
	include(PG_DIR . '/users/users_list.php');
}


// ADD USER
function pg_add_user() {
	include(PG_DIR . '/users/add_user.php');	
}


// EXPORT USERS
function pg_export_users() {
	include(PG_DIR . '/users/export_user.php');	
}


// USER CATEGORIES
add_action( 'init', 'pg_user_cat_taxonomy' );
function pg_user_cat_taxonomy() {
    $labels = array( 
        'name' => _x( 'User Categories', 'user category' ),
        'singular_name' => _x( 'User Category', 'user category' ),
        'search_items' => _x( 'Search User Categories', 'user category' ),
        'popular_items' => _x( 'Popular User Categories', 'user category' ),
        'all_items' => _x( 'All User Categories', 'user category' ),
        'parent_item' => _x( 'Parent User Category', 'user category' ),
        'parent_item_colon' => _x( 'Parent User Category:', 'user category' ),
        'edit_item' => _x( 'Edit User Category', 'user category' ),
        'update_item' => _x( 'Update User Category', 'user category' ),
        'add_new_item' => _x( 'Add New User Category', 'user category' ),
        'new_item_name' => _x( 'New User Category Name', 'user category' ),
        'separate_items_with_commas' => _x( 'Separate user categories with commas', 'user category' ),
        'add_or_remove_items' => _x( 'Add or remove user categories', 'user category' ),
        'choose_from_most_used' => _x( 'Choose from the most used user categories', 'user category' ),
        'menu_name' => _x( 'User Categories', 'user category' ),
    );

    $args = array( 
        'labels' => $labels,
        'public' => true,
        'show_in_nav_menus' => false,
        'show_ui' => true,
        'show_tagcloud' => false,
        'hierarchical' => false,
        'rewrite' => false,
        'query_var' => true
    );

    register_taxonomy( 'pg_user_categories', '', $args );	
}


/////////////////////////////////////////////////////////////


// remove the "articles" column from the taxonomy table
add_filter( 'manage_edit-pg_user_categories_columns', 'pg_user_cat_colums', 10, 1);
function pg_user_cat_colums($columns) {
   if(isset($columns['posts'])) {
		unset($columns['posts']); 
   }

    return $columns;
}


////////////////////////////////////////////////////////////////


//if there are pending users, show them on the WP dashboard
function pg_pending_users_warning() {	
	global $wp_admin_bar, $wpdb;
	$table_name = $wpdb->prefix . "pg_users";

	// pending users only if they exists
	$wpdb->query("SELECT ID FROM ".$table_name." WHERE status = 3");
	$total_pen_rows = $wpdb->num_rows;
	
	if($total_pen_rows > 0) {
		// add submenu
		add_submenu_page('pg_user_manage', 'Pending Users ('.$total_pen_rows.')', 'Pending Users ('.$total_pen_rows.')', 'upload_files', 'admin.php?page=pg_user_manage&status=pending');	
	
		// add wp admin bar alert
		if(is_admin_bar_showing()) {
			$wp_admin_bar->add_menu( array( 
				'id' => 'pg_pending_users', 
				'title' => '<span>PrivateContent <span id="ab-updates">'.$total_pen_rows.' Pending Users</span></span>', 
				'href' => get_admin_url() . 'admin.php?page=pg_user_manage&status=pending' 
			) );
		}
	}	
}
add_action('admin_menu', 'pg_pending_users_warning', 1000);  
	

?>