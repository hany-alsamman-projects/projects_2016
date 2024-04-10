<?php
// add custom post type to add user pages

add_action( 'init', 'register_pg_user_page' );
function register_pg_user_page() {

    $labels = array( 
        'name' => _x( 'User Pages', 'pg_user_page' ),
        'singular_name' => _x( 'User Page', 'pg_user_page' ),
        'add_new' => _x( 'Add New', 'pg_user_page' ),
        'add_new_item' => _x( 'Add New User Page', 'pg_user_page' ),
        'edit_item' => _x( 'Edit User Page', 'pg_user_page' ),
        'new_item' => _x( 'New User Page', 'pg_user_page' ),
        'view_item' => _x( 'View User Page', 'pg_user_page' ),
        'search_items' => _x( 'Search User Pages', 'pg_user_page' ),
        'not_found' => _x( 'No user pages found', 'pg_user_page' ),
        'not_found_in_trash' => _x( 'No user pages found in Trash', 'pg_user_page' ),
        'parent_item_colon' => _x( 'Parent User Page:', 'pg_user_page' ),
        'menu_name' => _x( 'User Pages', 'pg_user_page' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => false,
        'description' => 'Private pages of the private content users',
        'supports' => array( 'editor', 'thumbnail', 'custom-fields', 'revisions', 'page-attributes', 'post-formats', 'revisions', 'title' ),
        
        'public' => false,
        'show_ui' => false,
        'show_in_nav_menus' => false,
        'publicly_queryable' => false,
        'exclude_from_search' => true,
        'has_archive' => false,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => false,
        'capability_type' => 'page'
    );

    register_post_type( 'pg_user_page', $args );
}


////////////////////////////////////////
// Edit custom post type edit page /////
//////////////////////////////////////// 

// FIX FOR QTRANSLATE - to avoid qtranslate JS error i have to add title support to post type
// but I've hidden them with the CSS

// edit submitbox - hide minor submit minor-publishing and delete page

add_action( 'admin_head-post-new.php', 'user_page_admin_script', 15 );
add_action( 'admin_head-post.php', 'user_page_admin_script', 15 );

function user_page_admin_script() {
    global $post_type;
	global $wpdb;
	$table_name = $wpdb->prefix . "pg_users";
	
    if( 'pg_user_page' == $post_type ) {
		
		// hide ADD PAGE
		echo '
<style type="text/css">
	.add-new-h2,
	#titlediv,
	.qtrans_title_wrap,
	.qtrans_title {
		display: none;	
	}
	
	#minor-publishing {
		display: none;	
	}
	#delete-action {
		display: none;	
	}
</style>
		';
		
		// append username to the edit-page title 
		$user_data = $wpdb->get_row( $wpdb->prepare( "SELECT username FROM  ".$table_name." WHERE page_id = '".$_REQUEST['post']."' ") );
		$username = $user_data->username;
		
		echo '
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery(".wrap h2").append(" - '.addslashes($username).'");
});
</script>
		';
	}
}


?>