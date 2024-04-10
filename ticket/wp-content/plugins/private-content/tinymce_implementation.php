<?php
// implement tinymce button

class pg_tinymce_btn {
	function __construct() {
		add_action( 'admin_init', array( $this, 'action_admin_init' ) );
	}
	
	function action_admin_init() {
		// only hook up these filters if we're in the admin panel, and the current user has permission
		// to edit posts and pages
		if ( current_user_can( 'edit_posts' ) && current_user_can( 'edit_pages' ) ) {
			add_filter( 'mce_buttons', array( $this, 'filter_mce_button' ) );
			add_filter( 'mce_external_plugins', array( $this, 'filter_mce_plugin' ) );
		}
	}
	
	function filter_mce_button( $buttons ) {
		array_push( $buttons, '|', 'pg_btn' );
		return $buttons;
	}
	
	function filter_mce_plugin( $plugins ) {
		$plugins['PrivateContent'] = PG_URL . '/js/tinymce_btn.js';
		return $plugins;
	}
}

$mygallery = new pg_tinymce_btn();



?>