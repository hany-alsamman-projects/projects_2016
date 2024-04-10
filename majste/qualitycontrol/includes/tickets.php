<?php

new APP_Page_Template( 'create-ticket.php', __( 'Create Ticket', APP_TD ) );

function qc_get_ticket_page_id() {
	return APP_Page_Template::get_id( 'create-ticket.php' );
}

class QC_Tickets {

	function init() {
		add_action( 'init', array( __CLASS__, 'custom_post_types' ) );
		add_action( 'init', array( __CLASS__, 'add_ticket' ), 11 );
	}

	/**
	 * Register the Tickets post type, and remove the default "Post" type.
	 *
	 * @since Quality Control 0.1
	 * @global array $wp_post_types The registered post types.
	 * @uses register_post_type
	 */
	function custom_post_types() {
		// Disable 'post' post type
		foreach ( get_post_type_object( 'post' )->cap as &$value ) {
			$value = 'do_not_allow';
		}

		// Register 'ticket' post type
		$ticket_labels = array(
			'name'               => __( 'Tickets', APP_TD ),
			'singular_name'      => __( 'Ticket', APP_TD ),
			'add_new'            => __( 'Add New', APP_TD ),
			'add_new_item'       => __( 'Add New Ticket', APP_TD ),
			'edit_item'          => __( 'Edit Ticket', APP_TD ),
			'new_item'           => __( 'New Ticket', APP_TD ),
			'view'               => __( 'View Ticket', APP_TD ),
			'view_item'          => __( 'View Ticket', APP_TD ),
			'search_items'       => __( 'Search Tickets', APP_TD ),
			'not_found'          => __( 'No Tickets Found', APP_TD ),
			'not_found_in_trash' => __( 'No Tickets found in trash', APP_TD )
		);

		register_post_type( 'ticket', array(
			'labels'          => $ticket_labels,
			'rewrite'         => array( 'slug' => 'ticket', 'with_front' => false ),
			'supports'        => array( 'title', 'editor', 'author', 'comments'),
			'taxonomies'      => array( 'category', 'post_tag' ),
			'menu_position'   => 5,
			'public'          => true,
			'show_ui'         => true,
			'can_export'      => true,
			'capabilities' => array(
				'edit_published_posts' => 'edit_posts'
			),
			'map_meta_cap' => true,
			'query_var'       => true
		) );
	}

	/**
	 * Create a fresh ticket via the front-end form submission.
	 * Checks for valid permissions, then gathers
	 * the information, and creates a new post.
	 *
	 * @since Quality Control 0.1
	 */
	function add_ticket() {
		global $qc_options, $current_user;

		if ( !empty( $_POST['action'] ) && 'qc-create-ticket' === $_POST['action'] ) {
			check_admin_referer( 'qc-create-ticket' );

			$ticket = array();

			foreach ( $_POST as $key => $value )
				$ticket[ $key ] = isset( $value ) ? $value : "";

			get_currentuserinfo();
			$ticket[ 'ticket_author' ] = $current_user->ID;

			if ( ! empty( $ticket[ 'ticket_title' ] ) && !empty( $ticket[ 'comment' ] ) ) {
				$args = array(
					'post_type' => 'ticket',
					'post_status' => 'publish',
					'comment_status' => 'open',
					'post_category' => array( $ticket[ 'category' ] ),
					'tags_input' => $ticket[ 'ticket_tags' ],
					'post_content' => $ticket[ 'comment' ],
					'post_title' => $ticket[ 'ticket_title' ],
					'post_author' => $ticket[ 'ticket_author' ]
				);

				$args = apply_filters( 'qc_ticket_args', $args );

				$ticket_id = wp_insert_post( $args );

				do_action( 'qc_create_ticket', $ticket_id, $ticket );

				if ( ! empty( $ticket_id ) && ! is_wp_error( $ticket_id ) ) {
					wp_redirect( get_permalink( $ticket_id ) );

					exit();
				}
			}
		}
	}
}

QC_Tickets::init();

