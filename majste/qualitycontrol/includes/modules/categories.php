<?php
/**
 * @package Quality_Control
 * @subpackage Ticket Taxonomies
 * @since Quality Control 0.2
 */

class QC_Ticket_Category extends QC_Taxonomy {

	function __construct() {
		parent::__construct(
			'category'
		);
	}

	function actions() {
		add_action( 'qc_navigation_after', array( $this, 'add_navigation' ) );
		add_action( 'qc_ticket_fields_between', array( $this, 'ticket_meta' ) );
		add_action( 'qc_ticket_form_advanced_fields', array( $this, 'add_to_form' ), 10, 1 );

		add_action( 'qc_create_ticket', array( $this, 'save_taxonomy_frontend' ), 10, 2 );
		add_action( 'pre_comment_on_post', array( $this, 'update_taxonomy_frontend' ), 9 );

		add_action( 'manage_posts_custom_column', array( $this, 'manage_columns' ) );
		add_filter( 'manage_edit-ticket_columns', array( $this, 'manage_column_titles' ) );
	}

	/**
	 * Don't display the ticket count.
	 */
	function add_navigation() {
		$tax_object = get_taxonomy( $this->taxonomy );

		$class = array( 'hierarchical' );
		if ( is_category() )
		   $class[] = 'current-tab';

		echo'<li class="' . implode( ' ', $class ) . '">
				<a href="#">' . $tax_object->labels->singular_name. '</a>
				<ul class="second-level children">';
					wp_list_categories( 'title_li=&orderby=name' );
		echo'	</ul>
			</li>';
	}
}

$ticket_category = new QC_Ticket_Category;
