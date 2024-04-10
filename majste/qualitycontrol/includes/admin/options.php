<?php
/**
 * Creates options for admin area.
 *
 * @package Quality_Control
 * @subpackage Administration
 * @since Quality Control 0.1
 */

class QC_Options_Page extends scbAdminPage {
	protected $form;

	protected $settings_group = 'qc_control';

	protected $assigned_perms_options;

	function setup() {
		$this->assigned_perms_options = array(
			'protected' => __( 'Protected', APP_TD ),
			'read-only' => __( 'Read Only', APP_TD ),
			'read-write' => __( 'Readable/Editable', APP_TD ),
		);

		$this->textdomain = APP_TD;

		$this->args = array(
			'page_title' => __( 'Quality Control Settings', $this->textdomain ),
			'menu_title' => __( 'Settings', $this->textdomain ),
			'page_slug' => 'app-settings',
			'parent' => 'app-dashboard',
			'screen_icon' => 'options-general',
		);

		$this->form = new scbForm( $GLOBALS['qc_options']->get(), 'qc_options' );

		add_action( 'admin_init', array( $this, 'admin_init' ) );
		add_action( 'qc_settings_head', 'qc_status_colors_css' );
	}

	function admin_init() {
		register_setting( $this->settings_group, 'qc_options', array( $this, 'validate_options' ) );

		$this->add_section( 'qc_main', __( 'General Settings', APP_TD ), array(
			'require_assign' => __( 'Assignment Permissions', APP_TD ),
		) );

		$this->add_section( 'qc_states', __( 'States', APP_TD ), array(
			'status_default' => __( 'Default State', APP_TD ),
			'ticket_resolved' => __( 'Resolved State', APP_TD ),
			'status_colors' => __( 'Colors', APP_TD ),
		) );

		do_action( 'qc_create_settings', $this->settings_group, $this->form );
	}

	function add_section( $section_id, $section_title, $fields = array(), $callback = '__return_false' ) {
		add_settings_section( $section_id, $section_title, $callback, $this->settings_group );

		foreach ( $fields as $id => $title ) {
			$this->add_field( $id, $title, $section_id );
		}
	}

	function add_field( $id, $title, $section ) {
		add_settings_field( $id, $title, array( $this, 'setting_' . $id ), $this->settings_group, $section );
	}

	function page_head() {
?>
<style type="text/css">
.ticket-status {
	text-decoration: none;
	padding: 5px 10px;
	text-transform: uppercase;
	font-weight: bold;
	border-radius: 3px;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	min-width:  100px;
}
</style>
<?php
		do_action( 'qc_settings_head' );
	}

	function page_content() {
		if ( isset( $_GET['firstrun'] ) )
			do_action( 'appthemes_first_run' );

?>
		<form method="post" action="options.php">
<?php
			settings_fields( $this->settings_group );
			qc_do_settings_sections( $this->settings_group );
?>

			<p class="submit">
				<input type="submit" name="Submit" class="button-primary" value="<?php _e('Save Changes', APP_TD ) ?>">
			</p>
		</form>
<?php
	}

	function validate_options( $input ) {
		$output = $GLOBALS['qc_options']->get();

		$output[ 'ticket_status_new' ] = absint( $input[ 'ticket_status_new' ] );
		$output[ 'ticket_status_closed' ] = absint( $input[ 'ticket_status_closed' ] );

		if ( in_array( $input[ 'assigned_perms' ], array_keys( $this->assigned_perms_options ) ) )
			$output[ 'assigned_perms' ] = $input[ 'assigned_perms' ];

		if ( !empty( $input['status_colors'] ) ) {
			foreach ( $input['status_colors'] as $status => $colors ) {
				foreach ( $colors as $key => $color ) {
					if ( preg_match( '/^#[a-f0-9]{3,6}$/i', $color ) || empty($color)) {
						$output[ 'status_colors' ][ $status ][ $key ] = $color;
					}
				}
			}
		}

		return apply_filters( 'qc_valid_settings', $output, $input );
	}

	function setting_require_assign() {
		echo html( 'span class="description"', __( 'Tickets not assigned to the current user are ', APP_TD ) );
		echo $this->form->input( array(
			'type' => 'select',
			'name' => 'assigned_perms',
			'values' => $this->assigned_perms_options,
			'text' => false
		) );
	}

	function setting_status_default() {
		self::ticket_states( 'ticket_status_new' );

		echo html( 'span class="description"', __( 'This state will be selected by default when creating a ticket.', APP_TD ) );
	}

	function setting_ticket_resolved() {
		self::ticket_states( 'ticket_status_closed' );

		echo html( 'span class="description"', __( 'Tickets in this state are assumed to no longer need attention.', APP_TD ) );
	}

	protected function ticket_states( $key ) {
		global $qc_options;

		wp_dropdown_categories( array(
			'title_li=' => '',
			'show_option_none' => __( '&mdash; Select &mdash;', APP_TD ),
			'hide_empty' => 0,
			'taxonomy' => 'ticket_status',
			'name' => "qc_options[$key]",
			'selected' => $qc_options->get( $key )
		) );
	}

	function setting_status_colors() {
		$states = get_terms( 'ticket_status', 'hide_empty=0' );

		if ( empty( $states ) )
			printf( 'You haven&#39;t created any states. Please visit the <a href="%s">states</a> screen to add them.', admin_url( 'edit-tags.php?taxonomy=ticket_status&post_type=ticket' ) );

		$form = $this->form->traverse_to( 'status_colors' );

		echo '<table id="state-colors" class="widefat">';
?>
	<tr>
		<th><?php _e( 'Background', APP_TD ); ?></th>
		<th><?php _e( 'Text', APP_TD ); ?></th>
		<th><?php _e( 'Preview', APP_TD ); ?></th>
	</tr>
<?php
		foreach ( $states as $state ) {
			echo '<tr>';

			echo html( 'td', $form->input( array(
				'type' => 'text',
				'name' => array( $state->slug, 'background' ),
				'extra' => 'class="colorwell"'
			) ) );

			echo html( 'td', $form->input( array(
				'type' => 'text',
				'name' => array( $state->slug, 'text' ),
				'extra' => 'class="colorwell"'
			) ) );

?>
			<td><span class="ticket-status <?php echo $state->slug; ?>"><?php echo $state->name; ?></span></td>
<?php
			echo '</tr>';
		}
?>
	</table>
	<span class="description"><?php _e( 'Enter colors in a hexadecimal format (i.e. #F66 or #557544).', APP_TD ); ?></span>
<?php
	}
}

new QC_Options_Page;


// Settings API polyfill
// http://core.trac.wordpress.org/ticket/17851

function qc_do_settings_sections($page) {
	global $wp_settings_sections, $wp_settings_fields;

	if ( !isset($wp_settings_sections) || !isset($wp_settings_sections[$page]) )
		return;

	foreach ( (array) $wp_settings_sections[$page] as $section ) {
		echo '<div id="section-' . sanitize_html_class( $section['id'] ) . '" class="settings-section">';
		echo "<h3>{$section['title']}</h3>\n";
		call_user_func($section['callback'], $section);
		if ( !isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section['id']]) )
			continue;
		echo '<table class="form-table">';
		qc_do_settings_fields($page, $section['id']);
		echo '</table>';
		echo '</div>';
	}
}

function qc_do_settings_fields($page, $section) {
	global $wp_settings_fields;

	if ( !isset($wp_settings_fields) || !isset($wp_settings_fields[$page]) || !isset($wp_settings_fields[$page][$section]) )
		return;

	foreach ( (array) $wp_settings_fields[$page][$section] as $field ) {
		echo '<tr id="setting-' . sanitize_html_class( $field['id'] ) . '" class="settings-field" valign="top">';
		if ( !empty($field['args']['label_for']) )
			echo '<th scope="row"><label for="' . $field['args']['label_for'] . '">' . $field['title'] . '</label></th>';
		else
			echo '<th scope="row">' . $field['title'] . '</th>';
		echo '<td>';
		call_user_func($field['callback'], $field['args']);
		echo '</td>';
		echo '</tr>';
	}
}

