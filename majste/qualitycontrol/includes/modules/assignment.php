<?php

class QC_Assignment {
	private static $msg;

	function init() {
		add_action( 'qc_ticket_form_advanced_fields', array( __CLASS__, 'add_assign_field' ), 100, 1 );

		add_action( 'qc_create_ticket', array( __CLASS__, 'assign_user' ), 10, 2 );

		add_action( 'pre_comment_on_post', array( __CLASS__, 'update_ticket_owners' ), 9 );
		add_action( 'wp_insert_comment', array( __CLASS__, 'store_attr_changes' ) );

		add_action( 'pre_get_posts', array( __CLASS__, 'pre_get_posts' ) );
		add_filter( 'posts_clauses', array( __CLASS__, 'posts_clauses' ), 10, 2 );

		add_filter( 'wp_ajax_qc-user-search', array( __CLASS__, 'user_search' ) );
	}

	function add_assign_field( $context ) {
		echo'<p id="ticket-assign">
			<label for="ticket_assign">' . __( 'Assigned To: <em>(Optional) Separated multiple usernames with commas.</em>', APP_TD ) . '</label>
			<input type="text" name="ticket_assign" value="' . ( 'update' == $context ? qc_assigned_to_flat() : '' ) . '" />
			</p>';
	}

	/**
	 * Assign users to a ticket when one is created.
	 */
	function assign_user( $ticket_id, $ticket ) {
		$users = self::get_users_from_str( $ticket['ticket_assign'] );

		foreach ( $users as $user_id ) {
			add_post_meta( $ticket_id, '_assigned_to', $user_id );

			self::notify( $user_id, $ticket_id );
		}
	}

	/**
	 * When a comment has been created, check to see if the assigned
	 * users have been changed. If so, see if you can find the difference.
	 */
	function update_ticket_owners() {
		$ticket_id = $GLOBALS['post']->ID;

		$old_ids = get_post_meta( $ticket_id, '_assigned_to' );

		if ( empty( $old_ids ) ) {
			$old = array();
		} else {
			$old = get_users( array(
				'include' => $old_ids,
				'fields' => 'ids',
			) );
		}

		$new = self::get_users_from_str( $_POST['ticket_assign'] );

		$added = array_diff( $new, $old );
		$deleted = array_diff( $old, $new );

		foreach ( $added as $user_id ) {
			add_post_meta( $ticket_id, '_assigned_to', $user_id );
			self::notify( $user_id, $ticket_id ); // TODO: use add_post_meta hook instead
		}

		foreach ( $deleted as $user_id )
			delete_post_meta( $ticket_id, '_assigned_to', $user_id );

		$added = self::ids_to_names( $added );
		$deleted = self::ids_to_names( $deleted );

		$msg = _qc_get_message_diff( $added, $deleted );

		if ( empty( $msg ) )
			return;

		$msg = '<strong>' . __( 'Assignment', APP_TD ) . '</strong> ' . implode( '; ', $msg ) . '.';

		self::$msg = apply_filters( 'qc_ticket_update_assignment', $msg, $old, $new );

		add_filter( 'qc_did_change_ticket', '__return_true' );
	}

	function store_attr_changes( $comment_id ) {
		if ( self::$msg )
			add_comment_meta( $comment_id, 'ticket_updates', self::$msg );
	}

	private function ids_to_names( $list ) {
		$names = array();

		foreach ( $list as $user_id )
			$names[] = get_userdata( $user_id )->user_login;

		return $names;
	}

	private function get_users_from_str( $string ) {
		$users = array();
		foreach ( explode( ',', $string ) as $login ) {
			$user = get_user_by( 'login', $login );
			if ( $user )
				$users[] = $user->ID;
		}

		return $users;
	}

	private function notify( $user_id, $ticket_id ) {
		$owner = get_userdata( $user_id );

		if ( current_theme_supports( 'ticket-notifications' ) ) {
			$to = $owner->user_email;
			$subject = apply_filters( 'qc_ticket_create_subject', sprintf( __( 'Updated Ticket on %s', APP_TD ), get_bloginfo( 'name' ) ) );
			$message = apply_filters( 'qc_ticket_create_message', sprintf( __( 'A new ticket has been updated on %1$s, and you are currently assigned to it: %2$s', APP_TD ), get_bloginfo( 'name' ), get_permalink( $ticket_id ) ) );
			$headers = apply_filters( 'qc_ticket_create_headers', sprintf( __( 'From: %1$s <%2$s>', APP_TD ), get_bloginfo( 'name' ), get_bloginfo( 'admin_email' ) ) );

			@wp_mail( $to, $subject, $message, $headers );
		}
	}

	function pre_get_posts( $wp_query ) {
		if ( $wp_query->is_page() )
			return;

		$assigned = $wp_query->get( 'assigned' );
		$author = $wp_query->get( 'author_name' );

		if ( !qc_can_view_all_tickets() ) {
			if ( !is_user_logged_in() ) {
				$wp_query->set( 'year', 2525 );
				return;
			}

			$user_slug = wp_get_current_user()->user_nicename;

			if (
				( $assigned && $assigned != $user_slug ) ||
				( $author && $author != $user_slug )
			) {
				$wp_query->set( 'year', 2525 );
				return;
			}

			if ( !$assigned && !$author )
				$wp_query->set( '_assigned_or_author', true );
		}

		if ( $assigned ) {
			$user = get_user_by( 'login', $assigned );

			if ( empty( $user ) ) {
				$wp_query->set( 'year', 2525 );
				return;
			}

			$wp_query->set( 'meta_key', '_assigned_to' );
			$wp_query->set( 'meta_value', $user->ID );
		}
	}

	function posts_clauses( $clauses, $wp_query ) {
		global $wpdb;

		if ( $wp_query->get( '_assigned_or_author' ) ) {
			$user_id = get_current_user_id();

			$clauses['join'] .= " LEFT JOIN $wpdb->postmeta AS assign ON ($wpdb->posts.ID = assign.post_id)";

			$clauses['where'] .= $wpdb->prepare( " AND (
				(assign.meta_key = '_assigned_to' AND assign.meta_value = %d) OR
				$wpdb->posts.post_author = %d
			)", $user_id, $user_id );

			if ( empty( $clauses['groupby'] ) )
				$clauses['groupby'] = "$wpdb->posts.ID";
		}

		return $clauses;
	}

	/**
	 * Handle assignment autosuggest
	 */
	function user_search() {
		$users = get_users( array(
			'search' => $_GET['q'] . '*',
			'fields' => array( 'user_login' )
		) );

		echo implode( "\n", wp_list_pluck( $users, 'user_login' ) );
		exit;
	}
}
QC_Assignment::init();


/**
 * Check to see if this ticket has been assigned to someone.
 * If yes, it will return an array of owners.
 */
function qc_assigned_to( $post_id = null ) {
	if ( null == $post_id )
		$post_id = get_the_ID();

	return get_post_meta( $post_id, '_assigned_to' );
}

/**
 * Create a comma separated flat list of the current
 * owners. The owners are not linked (see qc_assigned_to_list)
 */
function qc_assigned_to_flat( $post_id = null, $separator = ', ' ) {
	return implode( $separator, wp_list_pluck( _qc_assigned_to_users( $post_id ), 'user_login' ) );
}

/**
 * Create a list of linked owners. Links to a page
 * showing all tickets assigned to that user.
 */
function qc_assigned_to_linked( $post_id = null, $separator = ', ' ) {
	$links = array();
	foreach ( _qc_assigned_to_users( $post_id ) as $user ) {
		$links[] = sprintf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			add_query_arg( 'assigned', $user->user_login, home_url() ),
			esc_attr( sprintf( __( 'Tickets by %s', APP_TD ), $user->display_name ) ),
			$user->display_name
		);
	}

	return implode( $separator, $links );
}

function _qc_assigned_to_users( $post_id ) {
	$user_ids = qc_assigned_to( $post_id );
	if ( empty( $user_ids ) )
		return array();

	return get_users( array( 'include' => $user_ids ) );
}

