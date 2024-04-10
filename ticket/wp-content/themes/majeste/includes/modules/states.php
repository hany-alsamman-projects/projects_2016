<?php
/**
 * @package Quality_Control
 * @subpackage Ticket Taxonomies
 * @since Codex Corp 0.2
 */

class QC_Ticket_Status extends QC_Taxonomy {

	function __construct() {
		parent::__construct(
			'ticket_status',
			'status',
			array(
				'name' => __( 'States', APP_TD ),
				'singular_name' => __( 'حالة المراسلات', APP_TD ),
				'search_items' => __( 'Search States', APP_TD ),
				'popular_items' => __( 'Popular States', APP_TD ),
				'all_items' => __( 'All States', APP_TD ),
				'update_item' => __( 'Update Status', APP_TD ),
				'add_new_item' => __( 'Add New Status', APP_TD ),
				'new_item_name' => __( 'New Status Name', APP_TD ),
				'edit_item' => __( 'Edit Status', APP_TD )
			)
		);
	}

	function add_to_form( $context ) {
		if ( 'create' == $context )
			return;

		parent::add_to_form( $context );
	}

	function save_taxonomy_frontend( $ticket_id, $ticket ) {
		if ( !isset( $ticket[ $this->taxonomy ] ) )
			$ticket[ $this->taxonomy ] = $GLOBALS['qc_options']->ticket_status_new;

		parent::save_taxonomy_frontend( $ticket_id, $ticket );
	}
}

$GLOBALS['ticket_status'] = new QC_Ticket_Status;
