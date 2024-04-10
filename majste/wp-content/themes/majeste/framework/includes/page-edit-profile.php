<?php

class APP_User_Profile extends APP_Page_Template {

	private $error;

	function __construct() {
		parent::__construct( 'edit-profile.php', __( 'Edit Profile', APP_TD ) );
		add_action( 'init', array( $this, 'update' ) );
	}

	function update() {
		if ( !isset( $_POST['action'] ) || 'app-edit-profile' != $_POST['action'] )
			return;

		check_admin_referer( 'app-edit-profile' );

		require ABSPATH . '/wp-admin/includes/user.php';

		$r = edit_user( $_POST['user_id'] );

		if ( is_wp_error( $r ) ) {
			$this->error = $r->get_error_message();
		} else {
			wp_redirect( './?updated=true' );
			exit();
		}
	}

	// Prevent non-logged-in users from accessing the edit-profile.php page
	function template_redirect() {
		appthemes_auth_redirect_login();

		add_action( 'appthemes_notice', array( $this, 'show_notice' ) );
	}

	function show_notice() {
		if ( !empty( $this->error ) ) {
			echo html( 'div class="error"', $this->error );
		} elseif ( isset( $_GET['updated'] ) ) {
			echo html( 'div class="updated"', __( 'User updated.', APP_TD ) );
		}
	}
}

function appthemes_get_edit_profile_url() {
	if ( $page_id = APP_Page_Template::get_id( 'edit-profile.php' ) )
		return get_permalink( $page_id );

	return get_edit_profile_url( get_current_user_id() );
}
