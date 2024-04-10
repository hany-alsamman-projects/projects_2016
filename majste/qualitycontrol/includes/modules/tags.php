<?php
/**
 * @package Quality_Control
 * @subpackage Ticket Taxonomies
 * @since Quality Control 0.2
 */

class QC_Ticket_Tags extends QC_Taxonomy {

	function __construct() {
		parent::__construct(
			'post_tag',
			'tag',
			array(
				'name' => __( 'Tags', APP_TD ),
				'singular_name' => __( 'Tags', APP_TD ),
				'search_items' => __( 'Search Tags', APP_TD ),
				'popular_items' => __( 'Popular Tags', APP_TD ),
				'all_items' => __( 'All Tags', APP_TD ),
				'update_item' => __( 'Update Tag', APP_TD ),
				'add_new_item' => __( 'Add New Tag', APP_TD ),
				'new_item_name' => __( 'New Tag Name', APP_TD ),
				'edit_item' => __( 'Edit Tag', APP_TD )
			)
		);
	}

	/**
	 * We don't want to add all the actions/filters as the
	 * other taxonomies
	 */
	function actions() {
		add_action( 'init', array( $this, 'register_taxonomy' ) );

		add_action( 'qc_ticket_fields_between', array( $this, 'ticket_meta' ) );

		add_action( 'qc_create_ticket', array( $this, 'save_taxonomy_frontend' ), 10, 2 );
		add_action( 'pre_comment_on_post', array( $this, 'update_taxonomy_frontend' ), 9 );

		add_filter( 'manage_edit-ticket_columns', array( $this, 'manage_column_titles' ) );
		add_action( 'manage_posts_custom_column', array( $this, 'manage_columns' ) );
	}

	function save_taxonomy_frontend( $ticket_id, $ticket ) {
		wp_set_post_terms( $ticket_id, $ticket['ticket_tags'], $this->taxonomy );
	}

	/**
	 * When a comment has been created, the tags have to be checked slightly
	 * differently.
	 */
	function update_taxonomy_frontend() {
		$ticket_id = $GLOBALS['post']->ID;

		$old = wp_get_post_terms( $ticket_id, 'post_tag', array( 'fields' => 'names' ) );

		wp_set_post_terms( $ticket_id, $_POST['ticket_tags'], 'post_tag', false );

		$new = wp_get_post_terms( $ticket_id, 'post_tag', array( 'fields' => 'names' ) );

		$added = array_diff( $new, $old );
		$deleted = array_diff( $old, $new );

		$msg = _qc_get_message_diff( $added, $deleted );

		if ( empty( $msg ) )
			return;

		$msg = '<strong>' . __( 'Tags', APP_TD ) . '</strong> ' . implode( '; ', $msg ) . '.';

		// Store message for when we have a comment id
		self::$attr_changes[] = apply_filters( "qc_ticket_update_{$this->taxonomy}",
			$msg, $old_term, $new_term
		);

		add_filter( 'qc_did_change_ticket', '__return_true' );
	}

	/**
	 * Override to add the tags class
	 */
	function ticket_meta( $exclude ) {
		global $post;

		// Only display on single pages
		if(!is_single()){
		    return;
		}

		$tax_object = get_taxonomy( $this->taxonomy );

		echo'<li class="tags">
				<small>' . $tax_object->labels->singular_name. '</small>';
				if ( get_the_term_list( $post->ID, $this->taxonomy, '', ', ', '' ) )
					echo get_the_term_list( $post->ID, $this->taxonomy, '', ', ', '' );
				else
					echo'&mdash;';
		echo'</li>';
	}
}

$qc_ticket_tags = new QC_Ticket_Tags;
