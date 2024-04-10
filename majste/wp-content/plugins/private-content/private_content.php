<?php
/* 
Plugin Name: PrivateContent
Plugin URI: http://codecanyon.net/item/privatecontent-multilevel-content-plugin/1467885?ref=LCweb
Description: Create unlimited lists of users and chose which of them can view page or post contents or entire areas of your website. Plus, each user have a private page.
Author: Luca Montanari
Version: 2.32
Author URI: http://codecanyon.net/user/LCweb?ref=LCweb
*/  


/////////////////////////////////////////////
/////// MAIN DEFINES ////////////////////////
/////////////////////////////////////////////

// plugin path
$wp_plugin_dir = substr(plugin_dir_path(__FILE__), 0, -1);
define( 'PG_DIR', $wp_plugin_dir );

// plugin url
$wp_plugin_url = substr(plugin_dir_url(__FILE__), 0, -1);
define( 'PG_URL', $wp_plugin_url );


// setting up the session for the frontend
function pg_init_session() {
	if (!session_id()) {
		ob_start();
		ob_clean();
		@session_start();
	}
}
add_action('init', 'pg_init_session', 1);


// load frontend languages
function pg_multilanguage() {
  load_plugin_textdomain( 'pg_ml', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/'); 
}
add_action('init', 'pg_multilanguage', 2);


/////////////////////////////////////////////
/////// MAIN SCRIPT & CSS INCLUDES //////////
/////////////////////////////////////////////

// global script enqueuing
function pg_global_scripts() { 
	wp_enqueue_script("jquery"); // call jquery
	
	// admin css
	if (is_admin()) {  
		wp_enqueue_style('pg_admin', PG_URL . '/css/admin.css', 999);	
		
		// add tabs scripts
		wp_enqueue_style( 'pg-ui-theme', PG_URL.'/css/ui-wp-theme/jquery-ui-1.8.17.custom.css', 999);
		wp_enqueue_script( 'jquery-ui-core' );
		wp_enqueue_script( 'jquery-ui-tabs' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		
		// iphone checks
		wp_enqueue_style( 'lcwp-ip-checks', PG_URL.'/js/iphone_checkbox/style.css', 999);

		// chosen
		wp_enqueue_style( 'lcwp-chosen-style', PG_URL.'/js/chosen/chosen.css', 999);
	}
	
	// frontend css - only if is not disabled by settings
	if (!is_admin() && !get_option('pg_disable_front_css')) {  
		wp_enqueue_style('pg_frontend', PG_URL . '/css/frontend.css');	
	}
	
	// login, registering and logout JS file
	if (!is_admin()) {
		wp_enqueue_script('pg_fontend_js', PG_URL . '/js/private-content.js');	
	}
}
add_action( 'init', 'pg_global_scripts' );



//////////////////////////////////////////////////
/////////// ADMIN AREA ///////////////////////////
//////////////////////////////////////////////////

// ADD SETTINGS TO THE MAIN MENU
function pg_admin_actions() {  
	add_options_page("PrivateContent", "PrivateContent", 'install_plugins', "PrivateContent-Settings", "pg_admin");  
}  
add_action('admin_menu', 'pg_admin_actions'); 
 
function pg_admin() {  
    include(PG_DIR.'/settings.php');  
}  


// GLOBAL AJAX
include(PG_DIR . '/ajax.php');

// PUBLIC API
include(PG_DIR . '/public_api.php');

// SHORCODES
include(PG_DIR . '/shortcodes.php');

// TINYMCE BUTTON
include(PG_DIR . '/tinymce_implementation.php');

// USER POST TYPE
include(PG_DIR . '/pg_user_post_type.php');

// TAXONOMIES OPTION
include(PG_DIR . '/pg_taxonomies_option.php');

// NAV MENU OPTION
include(PG_DIR . '/pg_nav_menu_option.php');

// PAGE META BOX 
include(PG_DIR . '/pg_meta_box.php');

//  USER MANAGE AREA
include(PG_DIR . '/pg_user_menu.php');

// USER AUTH SYSTEM
include(PG_DIR . '/user_auth.php');

// USER REGISTRATION SYSTEM
include(PG_DIR . '/user_registration.php');

// MANAGE PRIVATE CONTENT
include(PG_DIR . '/pvt_content_manage.php');

// LOGIN WIDGET
include(PG_DIR . '/login_widget.php');

// UPDATE NOTIFIER
include(PG_DIR . '/update-notifier.php');



//////////////////////////////////////////////////
//////// REGISTER DATABASE TABLE /////////////////
//////////////////////////////////////////////////

global $pg_db_version;
$pg_db_version = "1.01";

// add user table
function pg_usersdb_install() {
   global $wpdb;
   global $pg_db_version;

   $table_name = $wpdb->prefix . "pg_users";
   
   if($wpdb->get_var("SHOW TABLES LIKE '".$table_name."' ") != $table_name) {   
	   $sql = "CREATE TABLE " . $table_name . " (
		  id mediumint(9) NOT NULL AUTO_INCREMENT,
		  insert_date datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		  name VARCHAR(150) DEFAULT '' NOT NULL,
		  surname VARCHAR(150) DEFAULT '' NOT NULL,
		  username VARCHAR(150) NOT NULL,
		  psw text NOT NULL,
		  categories text NOT NULL,
		  email VARCHAR(255) NOT NULL,
		  tel VARCHAR(20) NOT NULL,
		  page_id int(11)  NOT NULL,
		  disable_pvt_page smallint(1)  NOT NULL,
		  status smallint(1) NOT NULL,
		  UNIQUE KEY id (id, page_id)
		) ENGINE = MYISAM CHARACTER SET utf8 COLLATE utf8_general_ci;";
	
	   require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
	   dbDelta($sql);
   }
 
   add_option("pg_db_version", $pg_db_version);
}
register_activation_hook(__FILE__, 'pg_usersdb_install');


?>