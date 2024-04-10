<?php

/**
 * Get the term associated to a ticket
 *
 * @since Codex Corp 0.1
 * @uses get_the_terms
 */
function qc_taxonomy( $taxonomy, $format = 'term_id', $post_id = null ) {
	if ( empty( $post_id ) )
		$post_id = get_the_ID();

	$terms = get_the_terms( $post_id, $taxonomy );

	if ( empty( $terms ) )
		return false;

	$term = reset( $terms );

	if ( $format )
		return $term->$format;

	return $term;
}

/**
 * Show ticket status label
 */
function qc_status_label() {
	if ( $ticket_status = qc_taxonomy( 'ticket_status', false ) ) {
		echo html( 'a', array(
			'href' => get_term_link( $ticket_status ),
			'class' => 'ticket-status ' . $ticket_status->slug,
		), $ticket_status->name );
	}
}

function qc_status_slug() {
    if ( $ticket_status = qc_taxonomy( 'ticket_status', false ) ) {
        return $ticket_status->slug;
    }
}

/**
 * Does the query produce more than 1 page?
 *
 * @global object $wp_query
 * @return boolean If pagination needs to be shown or not.
 */
function qc_show_pagination() {
	global $wp_query;

	return ( $wp_query->max_num_pages > 1 );
}

/**
 * Create a comma separated flat list of the current
 * tags.
 *
 * @since Codex Corp 0.1.5
 * @uses get_the_tags
 */
function qc_get_ticket_tags( $post_id = null, $separator = ', ', $taxonomy = 'post_tag' ) {
	global $post;

	if ( null == $post_id )
		$post_id = $post->ID;

	if ( !$post_id )
		return false;

	$tags = wp_get_post_terms( $post_id, $taxonomy, array() );

	if ( !$tags )
		return false;

	if ( is_wp_error($tags) )
		return $tags;

	foreach ( $tags as $tag )
		$tag_names[] = $tag->name;
	$tags_to_edit = join( ', ', $tag_names );
	$tags_to_edit = esc_attr( $tags_to_edit );
	$tags_to_edit = apply_filters( 'terms_to_edit', $tags_to_edit, $taxonomy );

	return $tags_to_edit;
}

function qc_can_create_ticket() {
	return current_user_can( 'edit_posts' );
}

function qc_can_view_all_tickets() {
	global $qc_options;

	return 'protected' != $qc_options->assigned_perms || current_user_can( 'edit_others_posts' );
}

/**
 * Go through a series of checks to see if the current
 * user has permission to update the ticket.
 *
 * @return false if no other conditions are true.
 */
function qc_can_edit_ticket() {
	global $post, $qc_options;

	if ( ! is_user_logged_in() )
		return false;

	if ( current_user_is_assigned_to_ticket( $post->ID ) )
		return true;

	if ( 'read-write' == $qc_options->assigned_perms || current_user_can( 'edit_post', $post->ID ) )
		return true;

	return false;
}

/**
 * Check wether the current user is assigned to particular ticket
 *
 * @param int $ticket_id
 */
function current_user_is_assigned_to_ticket( $ticket_id ) {
	if ( !current_theme_supports( 'ticket-assignment' ) )
		return false;

	return in_array( get_current_user_id(), (array) qc_assigned_to( $ticket_id ) );
}

