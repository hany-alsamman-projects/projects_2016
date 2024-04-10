<?php
add_filter( 'manage_edit-ticket_columns', 'qc_manage_column_titles' );
add_filter( 'manage_edit-ticket_columns', 'qc_manage_column_titles_date', 100, 1 );
add_action( 'admin_menu', 'qc_custom_types_menu' );
add_action( 'admin_print_styles', 'qc_admin_styles' );


/**
 * Add Extra columns to the ticket overview.
 */
function qc_manage_column_titles( $columns ) {
	$columns = array(
		'cb' => '<input type="checkbox" />',
		'title' => __( 'Ticket', APP_TD ),
	);

	return $columns;
}

/**
 * Add Extra columns to the ticket overview.
 *
 * Delay this one until the end, so we can put the creation date
 * at the end of the table.
 */
function qc_manage_column_titles_date( $columns ) {
	$columns[ 'date' ] = __( 'Created', APP_TD );

	return $columns;
}

/**
 * Remove the "Post" menu item. Because the "Post" post type is
 * hard coded into the menu, we need to manually remove it.
 */
function qc_custom_types_menu() {
	remove_menu_page( 'edit.php' );
}

function qc_admin_styles() {
	appthemes_menu_sprite_css( array(
		'#toplevel_page_app-dashboard',
		'#adminmenu #menu-posts-ticket',
		'#adminmenu #menu-posts-changeset'
	) );
}

