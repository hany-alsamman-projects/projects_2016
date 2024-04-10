<?php
/**
 * Theme functions file
 *
 * DO NOT MODIFY THIS FILE. Make a child theme instead: http://codex.wordpress.org/Child_Themes
 *
 * @package Codex Corp
 * @author AppThemes
 */

// Constants
define( 'QC_VERSION', '0.5.3-alpha' );

// Framework
require_once dirname( __FILE__ ) . '/framework/load.php';
require_once dirname( __FILE__ ) . '/framework/wrapping.php';

// Theme-spAllowed to start PM topicsecific files
require_once dirname( __FILE__ ) . '/includes/utils.php';

// When the theme is activated, go straight to the settings page.
if ( is_admin() && isset( $_GET[ 'activated' ] ) && 'themes.php' == $GLOBALS['pagenow'] ) {
	wp_redirect( admin_url( 'admin.php?page=app-settings&firstrun=1' ) );
	exit;
}


function prevent_admin_access()
{
    if ( false !== strpos( strtolower( $_SERVER['REQUEST_URI'] ), '/wp-admin' ) && !current_user_can( 'administrator' ) )
        wp_redirect( home_url() );
}


function remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}

add_action('init', 'remove_admin_bar');
add_action( 'init', 'prevent_admin_access', 0 );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since Codex Corp 0.1
 * @global array $qc_options User-defined settings.
 */
function qc_setup() {
	global $qc_options;

	$qc_options = new scbOptions( 'qc_options', false, array(
		'assigned_perms' => 'protected',
		'ticket_status_new' => false,
		'ticket_status_closed' => false,
		'repository' => array()
	) );

	require dirname( __FILE__ ) . '/includes/classes/qc-taxonomy.php';
	require dirname( __FILE__ ) . '/includes/modules/states.php';

	require dirname( __FILE__ ) . '/includes/widgets.php';
	require dirname( __FILE__ ) . '/includes/template-tags.php';
	require dirname( __FILE__ ) . '/includes/tickets.php';
	require dirname( __FILE__ ) . '/includes/comments.php';

	add_theme_support( 'ticket-priorities' );
	add_theme_support( 'ticket-milestones' );
	add_theme_support( 'ticket-tags' );
	add_theme_support( 'ticket-categories' );
	add_theme_support( 'ticket-attachments' );
	add_theme_support( 'ticket-assignment' );
	add_theme_support( 'ticket-notifications' );
	add_theme_support( 'changesets' );

	add_theme_support( 'automatic-feed-links' );

	add_custom_background();

	add_editor_style();

	register_sidebar( array(
		'name' => __( 'Primary Widget Area', APP_TD ),
		'id' => 'primary-widget-area',
		'description' => __( 'The primary widget area', APP_TD ),
		'before_widget' => '<li id="%1$s" class="widget-container ads-widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-head">',
		'after_title' => '</h3>',
	) );

	if ( is_admin() ) {
		require dirname( __FILE__ ) . '/includes/admin/dashboard.php';
		require dirname( __FILE__ ) . '/includes/admin/options.php';
		require dirname( __FILE__ ) . '/includes/admin/admin.php';
	}
}
add_action( 'after_setup_theme', 'qc_setup', 10 );

function qc_scripts() {
	wp_register_script( 'jquery-validate', get_template_directory_uri() . '/scripts/jquery.validate.min.js', array( 'jquery' ), '1.8.1', true );
	wp_localize_script( 'jquery-validate', 'qcValidateI18N', array(
		'required' => __( 'This field is required.', APP_TD ),
		'email'    => __( 'Please enter a valid email address.', APP_TD ),
		'url'      => __( 'Please enter a valid URL.', APP_TD ),
		'date'     => __( 'Please enter a valid date.', APP_TD ),
		'dateISO'  => __( 'Please enter a valid date (ISO).', APP_TD ),
		'number'   => __( 'Please enter a valid number.', APP_TD ),
		'digits'   => __( 'Please enter only digits.', APP_TD ),
		'equalTo'  => __( 'Please enter the same value again.', APP_TD ),
		'accept'   => __( 'Please enter a value with a valid extension.', APP_TD )
	) );

	if ( ! is_archive() ) {
		wp_enqueue_script( 'qc', get_template_directory_uri() . '/scripts/qc.js', array( 'suggest', 'jquery-validate' ), QC_VERSION, true );
		wp_localize_script( 'qc', 'QC_L10N', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' )
		) );
	}

	// used in 1140px framework
	wp_enqueue_script( 'css3-mediaqueries', get_template_directory_uri() . '/scripts/css3-mediaqueries.js', array( 'jquery' ), '1.0' );
}
add_action( 'template_redirect', 'qc_scripts', 9 );

/**
 * Includes files for supported modules. Needs to be loaded after
 * the child theme has had a chance to deactive some stuff.
 *
 * @since Codex Corp 0.2
 */
function qc_theme_support_files() {
	require_if_theme_supports( 'ticket-priorities', dirname( __FILE__ ) . '/includes/modules/priorities.php' );
	require_if_theme_supports( 'ticket-milestones', dirname( __FILE__ ) . '/includes/modules/milestones.php' );
	require_if_theme_supports( 'ticket-tags', dirname( __FILE__ ) . '/includes/modules/tags.php' );
	require_if_theme_supports( 'ticket-categories', dirname( __FILE__ ) . '/includes/modules/categories.php' );
	require_if_theme_supports( 'ticket-attachments', dirname( __FILE__ ) . '/includes/modules/attachments.php' );
	require_if_theme_supports( 'ticket-assignment', dirname( __FILE__ ) . '/includes/modules/assignment.php' );
	require_if_theme_supports( 'ticket-notifications', dirname( __FILE__ ) . '/includes/modules/notifications.php' );
	require_if_theme_supports( 'changesets', dirname( __FILE__ ) . '/includes/modules/changesets.php' );
}
add_action( 'after_setup_theme', 'qc_theme_support_files', 12 );

function qc_install() {
	global $qc_options;

	// Create default states
	if ( !_tax_has_terms( 'ticket_status' ) ) {
		$r = wp_insert_term( __( 'New', APP_TD ), 'ticket_status' );
		$qc_options->ticket_status_new = $r['term_id'];

		$r = wp_insert_term( __( 'Closed', APP_TD ), 'ticket_status' );
		$qc_options->ticket_status_closed = $r['term_id'];
	}

	// Create default priorities
	if ( !_tax_has_terms( 'ticket_priority' ) ) {
		$default_priorities = array(
			__( 'Low', APP_TD ),
			__( 'Medium', APP_TD ),
			__( 'High', APP_TD ),
		);

		foreach ( $default_priorities as $prio )
			wp_insert_term( $prio, 'ticket_priority' );
	}
}
add_action( 'appthemes_first_run', 'qc_install' );

function _tax_has_terms( $taxonomy ) {
	return (int) get_terms( $taxonomy, array( 'hide_empty' => false, 'fields' => 'count' ) );
}

function qc_query_vars( $qvars ) {
	$qvars[] = 'assigned';
	$qvars[] = 'ticket_trashed';

	return $qvars;
}
add_filter( 'query_vars', 'qc_query_vars' );

function qc_ticket_listing( $query ) {
	if ( !$query->is_page() && in_array( $query->get( 'post_type' ), array( '', 'post', 'ticket' ) ) ) {
		$query->set( 'post_type', 'ticket' );
		$query->set( 'orderby', 'modified' );
	}
}
add_action( 'parse_query', 'qc_ticket_listing' );

/**
 * Create the CSS to style the .ticket-status links.
 *
 * @since Codex Corp 0.1
 * @global array $qc_options User-defined settings.
 */
function qc_status_colors_css() {
	global $qc_options;

	if ( empty( $qc_options->status_colors ) )
		return;

	echo "\n<style type='text/css'>\n";

	foreach ( $qc_options->status_colors as $state => $colors ) {
		if ( empty( $colors ) )
			continue;

		echo ".ticket-status.$state {";

		if ( !empty( $colors['background'] ) )
			printf( 'background: %s;', $colors['background'] );

		if ( !empty( $colors['text'] ) )
			printf( 'color: %s;', $colors['text'] );

		echo "}\n";
	}

	echo "</style>\n";
}
add_action( 'wp_head', 'qc_status_colors_css' );

/**
 * Remove the default Category Widget.
 *
 * The default widget does not support defining a custom taxonomy. The
 * Widget that is created by the theme does, as well as counts, and RSS links.
 *
 * @since Codex Corp 0.1
 * @uses unregister_widget
 */
function qc_unregister_widgets() {
	unregister_widget( 'WP_Widget_Categories' );
}
add_action( 'widgets_init', 'qc_unregister_widgets' );

/**
 * When this function is called, add_filter is called
 * to filter wp_title. This needs to be run after the
 * initial wp_title is called for the <title>
 *
 * @since Codex Corp 0.1
 * @uses add_filter
 */
function qc_page_title() {
	add_filter( 'wp_title', 'qc_filter_page_title', 10, 2 );
}

/**
 * This filter is run on wp_title. It wraps the separator in a
 * <span> tag so it can be styled. Also allows for more precise
 * control over certain page titles.
 *
 * @since Codex Corp 0.1
 * @uses unregister_widget
 */
function qc_filter_page_title( $title, $separator ) {
	global $paged, $page, $post, $wp_query;

	$title = str_replace( $separator, '<span>' . $separator . '</span>', $title );

	if ( is_search() )
		$title = '<span>' . $separator . '</span> ' . sprintf( __( 'Containing "%s"', APP_TD ), get_search_query() );
	elseif ( is_single() )
		$title = '<span>' . $separator . '</span> ' . sprintf( __( 'Ticket #%d', APP_TD ), $post->ID );
	elseif ( get_query_var( 'assigned' ) )
		$title = '<span>' . $separator . '</span> ' . sprintf( __( 'Assigned to %s', APP_TD ), get_query_var( 'assigned' ) );
	elseif ( is_home() )
		$title = '<span>' . $separator . '</span> ' . __( 'Dashboard', APP_TD );

	return $title;
}

/**
 * When a ticket is deleted, redirect them back to the homepage.
 * Adds a variable to the URL so you can add a message if you want.
 *
 * A ticket can be undeleted by going into the WordPress Control Panel,
 * viewing your posts, and restoring it from the trash.
 *
 * @since Codex Corp 0.1
 * @uses wp_redirect
 */
function qc_trashed_ticket() {
	if ( ! isset( $_GET[ "ids" ] ) )
		return false;

	$ticket_id = esc_attr( $_GET[ "ids" ] );

	if ( isset( $_REQUEST[ "trashed" ] ) ) {
		do_action( 'qc_delete_ticket', $ticket_id );

		wp_redirect( home_url() . '?ticket_trashed=' . $ticket_id, 302 );
	}
}
add_action( 'template_redirect', 'qc_trashed_ticket' );

/**
 * For people who allow guests to submit tickets,
 * the author is blank. Create a label so something shows.
 *
 * @since Codex Corp 0.1.2
 */
function qc_the_author( $display_name ) {
	if ( empty ( $display_name ) )
		return apply_filters( 'qc_anon_author', __( 'Anonymous', APP_TD ) );
	else
		return $display_name;
}
add_filter( 'the_author', 'qc_the_author' );
add_filter( 'get_the_author_display_name', 'qc_the_author' );

/**
 * Create a shortcode so tickets can be easily
 * called when creating/updating tickets.
 *
 * [ticket id=""] where id is the ID of the post (ticket).
 *
 * @since Codex Corp 0.1.4
 * @global array $qc_options User-defined settings.
 * @param array   $atts    Attributes applied to the shortcode.
 * @param string  $content The content the shortcode surrounds.
 * @return string The filter content.
 */
function qc_link_ticket_shortcode( $atts, $content = null ) {
	global $qc_options;

	extract( shortcode_atts( array(
		'id' => 0,
		'before' => '',
		'after' => '',
	), $atts ) );

	$ticket = get_post( absint( $id ) );

	if ( $ticket->post_status != 'publish' )
		return apply_filters( 'qc_invalid_ticket_shortcode', '#' . $id );

	if ( empty( $content ) )
		$content = '#' . $ticket->ID;

	$ticket_status = qc_taxonomy( 'ticket_status', false, $ticket->ID );

	$class = 'link-to-ticket';
	if ( $ticket_status->term_id == $qc_options->ticket_status_closed )
		$class .= ' closed';

	$link = $before . html( 'a', array(
		'href' => get_permalink( $ticket->ID ),
		'title' => $ticket->post_title,
		'class' => $class,
	), $content ) . $after;

	return apply_filters( 'qc_link_ticket_shortcode', $link );
}
add_shortcode( 'ticket', 'qc_link_ticket_shortcode' );
add_filter( 'get_comment_text', 'do_shortcode' );

/**
 * Automatically create links to other tickets when
 * someone submits #xxx where xxx is the ticket ID.
 *
 * TODO: don't replace tickets already inside links
 */
add_filter( 'get_the_content', 'qc_create_ticket_link' );
add_filter( 'get_comment_text', 'qc_create_ticket_link' );

function qc_create_ticket_link( $content ) {
	return preg_replace_callback( '/#([0-9]+)/i', '_qc_create_ticket_link_cb', $content );
}

function _qc_create_ticket_link_cb( $matches ) {
	return html_link( get_permalink( $matches[1] ), $matches[0] );
}

/**
 * Update post_modified whenever a comment is added
 */
function _qc_touch_post( $comment_id, $comment ) {
	global $wpdb;

	$wpdb->update( $wpdb->posts,
		array(
			'post_modified' => current_time( 'mysql' ),
			'post_modified_gmt' => current_time( 'mysql', true ),
		),
		array( 'ID' => $comment->comment_post_ID )
	);

	update_post_meta( $comment->comment_post_ID, '_edit_last', $comment->user_id );
}
add_action( 'wp_insert_comment', '_qc_touch_post', 10, 2 );

/**
 * Customize the admin bar
 */
function qc_admin_bar() {
	if ( !is_admin() && !current_user_can( 'edit_users' ) )
		remove_action( 'admin_bar_menu', 'wp_admin_bar_dashboard_view_site_menu', 25 );

	remove_action( 'admin_bar_menu', 'wp_admin_bar_new_content_menu', 40 );
	remove_action( 'admin_bar_menu', 'wp_admin_bar_comments_menu', 50 );
}
add_action( 'add_admin_bar_menus', 'qc_admin_bar' );

// run the appthemes_init() action hook
appthemes_init();
