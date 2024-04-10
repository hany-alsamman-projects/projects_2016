<?php
/**
 * @package Quality_Control
 * @subpackage Changesets
 * @since Quality Control 0.2
 */

if ( ! defined( 'QC_CHANGESET_PTYPE' ) )
	define( 'QC_CHANGESET_PTYPE', 'changeset' );

/**
 * Creates the 'changeset' post type.
 *
 * @since Quality Control 0.2
 */
class QC_Changesets {
	private static $apis;

	private static $repo_type;
	private static $repo_class;

	private static $settings_group;
	private static $form;

	function init() {
		foreach ( array( 'beanstalk' => 'QC_Beanstalk', 'github' => 'QC_Github' ) as $id => $class ) {
			self::$apis[ $id ] = new $class;
		}

		add_action( 'init', array( __CLASS__, 'register_cpt' ) );
		add_action( 'save_post', array( __CLASS__, 'reference_tickets' ), 10, 2 );

		// Cron
		$cronjob = new scbCron( '', array(
			'callback' => array( __CLASS__, 'maybe_import_changesets' ),
			'interval' => 300	// 5 minutes
		) );
		add_action( 'appthemes_first_run', array( $cronjob, 'reset' ) );

		// Settings
		add_action( 'qc_settings_head', array( __CLASS__, 'settings_head' ) );
		add_action( 'qc_create_settings', array( __CLASS__, 'create_settings' ), 10, 2 );
		add_filter( 'qc_valid_settings', array( __CLASS__, 'validate_settings' ), 10, 2 );

		if ( self::$repo_type = @$GLOBALS['qc_options']->repository['type'] ) {
			self::$repo_class = self::$apis[ self::$repo_type ];

			// Import button
			add_action( 'restrict_manage_posts', array( __CLASS__, 'import_changesets_button' ) );
			add_action( 'load-edit.php', array( __CLASS__, 'import_changesets_handler' ) );
			add_action( 'admin_notices', array( __CLASS__, 'import_changesets_message' ) );
		}
	}

	function register_cpt() {
		$labels = array(
			'name' => _x( 'Changesets', 'changeset', APP_TD ),
			'singular_name' => _x( 'Changeset', 'changeset', APP_TD ),
			'add_new' => _x( 'Add New', 'changeset', APP_TD ),
			'add_new_item' => _x( 'Add New Changeset', 'changeset', APP_TD ),
			'edit_item' => _x( 'Edit Changeset', 'changeset', APP_TD ),
			'new_item' => _x( 'New Changeset', 'changeset', APP_TD ),
			'view_item' => _x( 'View Changeset', 'changeset', APP_TD ),
			'search_items' => _x( 'Search Changesets', 'changeset', APP_TD ),
			'not_found' => _x( 'No changesets found', 'changeset', APP_TD ),
			'not_found_in_trash' => _x( 'No changesets found in Trash', 'changeset', APP_TD ),
			'parent_item_colon' => _x( 'Parent Changeset:', 'changeset', APP_TD ),
			'menu_name' => _x( 'Changesets', 'changeset', APP_TD ),
		);

		$args = array(
			'labels' => $labels,
			'hierarchical' => false,

			'supports' => array( 'title', 'excerpt', 'custom-fields' ),

			'public' => false,
			'show_ui' => true,
			'menu_position' => 5,
		);

		register_post_type( QC_CHANGESET_PTYPE, $args );
	}

	function reference_tickets( $changeset_id, $changeset ) {
		if ( QC_CHANGESET_PTYPE != $changeset->post_type )
			return;

		$changeset_url = $changeset->guid;

		$comment_text = <<<EOB
In <a class="changeset-link" href="$changeset_url">[$changeset->post_title]</a>:

<div class="changeset-message">$changeset->post_excerpt</div>
EOB;

		$results = self::parse_commit_message( $changeset->post_excerpt );

		foreach ( $results as $ticket_id => $action ) {
			if ( !$ticket = get_post( $ticket_id ) )
				continue;

			// TODO: duplicate check

			$data = array(
				'comment_post_ID' => $ticket_id,
				'comment_author' => get_post_meta( $changeset_id, 'author', true ),
				'comment_author_email' => get_post_meta( $changeset_id, 'email', true ),
				'user_id' => $changeset->post_author,
				'comment_content' => addslashes( $comment_text )
			);

			$comment_id = wp_insert_comment( $data );

			if ( 'close' == $action ) {
				$GLOBALS['ticket_status']->update_ticket( $ticket_id, $GLOBALS['qc_options']->ticket_status_closed, $comment_id );
			}

			// TODO: call wp_notify_post_author() ?
		}
	}

	// Looks for ticket references in a commit message
	function parse_commit_message( $msg ) {
		$results = array();

		$action = 'ref';

		foreach ( preg_split( '/[\s,]+#/', $msg ) as $token ) {
			if ( preg_match( '/^\d+/i', $token, $matches ) ) {
				$ticket_id = $matches[0];
				$results[ $ticket_id ] = $action;
			}

			if ( preg_match( '/(Closes|Fixes)$/i', $token, $matches ) ) {
				$action = 'close';
			} else {
				$action = 'ref';
			}
		}

		return $results;
	}


	function maybe_import_changesets() {
		if ( !self::$repo_class )
			return false;

		return self::$repo_class->import_changesets( $GLOBALS['qc_options']->repository['details'] );
	}


	function create_settings( $settings_group, $form ) {
		self::$form = $form->traverse_to( 'repository' );
		self::$settings_group = $settings_group;

		$section = 'qc_changeset';

		add_settings_section( $section , __( 'Source Control', APP_TD ), '__return_false', $settings_group );
		add_settings_field( 'repo_type', __( 'Repository Type', APP_TD ), array( __CLASS__, 'setting_repo_type' ), $settings_group, $section );

		$form = self::$form->traverse_to( 'details' );

		foreach ( self::$apis as $repo_type => $repo_obj ) {
			$repo_obj->form = $form;

			$section = ( self::$repo_type == $repo_type ) ? 'qc_changeset' : 'qc_hidden';

			foreach ( $repo_obj->get_fields() as $field_id => $title ) {
				add_settings_field( $repo_type . '-' . $field_id, $title, array( $repo_obj, 'setting_' . $field_id ), $settings_group, $section );
			}
		}

		add_settings_field( 'changesets_link', '', array( __CLASS__, 'setting_changesets_link' ), $settings_group, 'qc_changeset' );
	}

	function settings_head() {
		add_action( 'admin_footer', array( __CLASS__, 'settings_foot' ) );
	}

	function settings_foot() {
?>
<table id="qc-hidden-fields" style="display:none">
<?php qc_do_settings_fields( self::$settings_group, 'qc_hidden' ); ?>
</table>

<script type="text/javascript">
jQuery(function($) {
	var
		$select = $('#setting-repo_type select'),
		old_val = $select.val();

	function get_fields(type) {
		return $('[id^="setting-' + type + '-"]');
	}

	$('form').get(0).reset();

	$select.change(function() {
		var new_val = $(this).val();

		get_fields(new_val).insertAfter('#setting-repo_type');
		get_fields(old_val).appendTo('#qc-hidden-fields');

		old_val = new_val;
	});
});
</script>
<?php
	}

	function setting_repo_type() {
		$options = array();

		foreach ( self::$apis as $id => $repo_obj ) {
			$options[$id] = $repo_obj->get_title();
		}

		echo self::$form->input( array(
			'type' => 'select',
			'name' => 'type',
			'values' => $options
		) );
	}

	function setting_changesets_link() {
		echo html_link( admin_url( 'edit.php?post_type=' . QC_CHANGESET_PTYPE ), __( 'View Changesets', APP_TD ) );
	}

	function validate_settings( $old, $new ) {
		$type = $new['repository']['type'];

		if ( !in_array( $type, array_keys( self::$apis ) ) ) {
			$old['repository']['type'] = false;
		} elseif ( isset( $new['repository']['details'] ) ) {
			$old['repository'] = array(
				'type' => $type,
				'details' => self::$apis[ $type ]->settings_validate( $new['repository']['details'] )
			);
		}

		return $old;
	}


	function import_changesets_button() {
		if ( QC_CHANGESET_PTYPE != $GLOBALS['post_type'] )
			return;

?>
<input style="display: block; float: right; margin-left: 1em;" class="button" type="submit" name="update_repo" value="<?php _e( 'Import changesets now', APP_TD ); ?>" />
<?php
	}

	function import_changesets_handler() {
		if ( !isset( $_REQUEST['update_repo'] ) || QC_CHANGESET_PTYPE != $_REQUEST['post_type'] )
			return;

		if ( !current_user_can( 'manage_options' ) )
			return;

		$data = self::maybe_import_changesets();

		if ( is_wp_error( $data ) ) {
			set_transient( 'qc_repo_update', $data->get_error_message() );
			$str = 'error';
		} else {
			set_transient( 'qc_repo_update', $data );
			$str = 'success';
		}

		wp_redirect( admin_url( add_query_arg( array( 'post_type' => QC_CHANGESET_PTYPE, 'repo_update' => $str ), 'edit.php' ) ) );
		die;
	}

	function import_changesets_message() {
		if ( !isset( $_REQUEST['repo_update'] ) || 'edit.php' != $GLOBALS['pagenow'] || QC_CHANGESET_PTYPE != $_REQUEST['post_type'] )
			return;

		$data = get_transient( 'qc_repo_update' );
		if ( false === $data )
			return;
		delete_transient( 'qc_repo_update' );

		if ( 'error' == $_REQUEST['repo_update'] ) {
			echo html( 'div class="error"', html( 'p', sprintf( __( 'Error while fetching changesets: %s.', APP_TD ), $data ) ) );
		} else {
			echo html( 'div class="updated"', html( 'p', sprintf( __( 'Imported %d changests.', APP_TD ), $data ) ) );
		}
	}
}

QC_Changesets::init();


abstract class QC_SourceControl {
	public $form;

	protected $const_name;
	protected $request;

	protected $url_form = 'https://{{auth}}@{{account}}.beanstalkapp.com/api/changesets/repository.xml?repository_id={{repo}}';

	function setting_url() {
		$fields = array(
			'account' => __( 'account', APP_TD ),
			'repo' => __( 'repository', APP_TD )
		);

		foreach ( $fields as $key => $placeholder ) {
			$fields[ $key ] = $this->form->input( array(
				'name' => $key,
				'type' => 'text',
				'extra' => array( 'style' => 'width: 10em', 'placeholder' => $placeholder )
			) );
		}

		echo self::substitute( $this->url_form, $fields );

		$example_url = self::substitute( $this->url_form, array(
			'account' => 'scribu',
			'repo' => 'wp-posts-to-posts',
		) );

		echo '<span class="description">' . sprintf( __( 'Example: %s', APP_TD ), $example_url ) . '</span>';
	}

	// Poor-man's Mustache
	private static function substitute( $template, $data ) {
		foreach ( $data as $key => $value ) {
			$template = str_replace( '{{' . $key . '}}', $value, $template );
		}

		return $template;
	}

	abstract static function get_title();

	abstract function store_changesets( $data, $settings );

	abstract function get_fields();

	function __construct() {
		global $blog_id;

		if ( is_multisite() && 1 != $blog_id ) {
			$this->const_name .= '_' . $blog_id;
		}
	}

	function import_changesets( $settings ) {
		$data = array(
			'{{auth}}' => $settings['user'] . ':' . constant( $this->const_name ),
			'{{account}}' => $settings['account'],
			'{{repo}}' => $settings['repo']
		);

		$changesets_url = str_replace( array_keys( $data ), array_values( $data ), $this->request );

		$r = wp_remote_get( $changesets_url );
		if ( is_wp_error( $r ) )
			return $r;

		if ( 200 != $r['response']['code'] )
			return new WP_Error( 'remote_error', $r['response']['message'] );

		return $this->store_changesets( $r['body'], $settings );
	}

	static function settings_validate( $input ) {
		return array_map( 'strip_tags', $input );
	}

	function setting_user() {
		echo $this->form->input( array(
			'name' => 'user',
			'type' => 'text',
			'extra' => 'style="width: 10em"'
		) );
	}

	function setting_pass() {
		if ( defined( $this->const_name ) && '' != constant( $this->const_name ) ) {
			_e( 'Password is set in <code>wp-config.php</code>:', APP_TD );
			echo ' <code>' . $this->const_name . '</code>.';
		} else {
			_e( 'Please set the password in your <code>wp-config.php</code> file:', APP_TD );
?>
<br>
<input type="text" class="code" style="width: 50.2em" readonly value="define( '<?php echo $this->const_name; ?>', 'your password' );" />
<?php
		}
	}
}

class QC_Beanstalk extends QC_SourceControl {
	protected $const_name = 'QC_BEANSTALK_PASS';

	protected $request = 'https://{{auth}}@{{account}}.beanstalkapp.com/api/changesets/repository.xml?repository_id={{repo}}';

	protected $url_form = 'https://{{account}}.beanstalkapp.com/{{repo}}';

	static function get_title() {
		return __( 'Beanstalk', APP_TD );
	}

	function store_changesets( $xmlstr, $settings ) {
		global $wpdb;

		$xml = new SimpleXMLElement( $xmlstr );	// TODO: handle parse errors

		$count = 0;
		foreach ( $xml->{'revision-cache'} as $changeset ) {
			$changeset_url = 'https://' . $settings['account'] . '.beanstalkapp.com/' . $settings['repo'] . '/changesets/' . $changeset->revision;

			// Check for duplicates
			if ( $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid = %s", $changeset_url ) ) )
				continue;

			$post_data = array(
				'post_type' => QC_CHANGESET_PTYPE,
				'guid' => $changeset_url,
				'post_title' => (string) $changeset->revision,
				'post_excerpt' => (string) $changeset->message,
				'post_date' => date( 'Y-m-d H:i:s', strtotime( $changeset->time ) ),
				'post_status' => 'publish'
			);

			$author = get_user_by( 'email', (string) $changeset->email );
			if ( $author )
				$post_data['post_author'] = $author->ID;

			$post_id = wp_insert_post( $post_data, true );
			if ( is_wp_error( $post_id ) )
				continue;

			foreach ( array( 'author', 'email', 'changed-files', 'changed-dirs' ) as $key ) {
				$value = (string) $changeset->$key;
				if ( !empty( $value ) )
					add_post_meta( $post_id, $key, $value );
			}

			$count++;
		}

		return $count;
	}


	function get_fields() {
		return array(
			'url' => __( 'Repository URL', APP_TD ),
			'user' => __( 'Beanstalk User', APP_TD ),
			'pass' => __( 'Beanstalk Password', APP_TD ),
		);
	}
}


class QC_Github extends QC_SourceControl {
	protected $const_name = 'QC_GITHUB_PASS';

	protected $request = 'https://{{auth}}@api.github.com/repos/{{account}}/{{repo}}/commits';

	protected $url_form = 'http://github.com/{{account}}/{{repo}}';

	static function get_title() {
		return __( 'Github', APP_TD );
	}

	function store_changesets( $jsonstr, $settings ) {
		global $wpdb;

		$data = json_decode( $jsonstr );	// TODO: handle parse errors

		$count = 0;
		foreach ( $data as $push ) {
			$changeset_url = "https://github.com/{$settings['account']}/{$settings['repo']}/commit/{$push->sha}";

			// Check for duplicates
			if ( $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE guid = %s", $changeset_url ) ) )
				continue;

			$post_data = array(
				'post_type' => QC_CHANGESET_PTYPE,
				'guid' => $changeset_url,
				'post_title' => $push->sha,
				'post_excerpt' => $push->commit->message,
				'post_date' => date( 'Y-m-d H:i:s', strtotime( $push->commit->author->date ) ),
				'post_status' => 'publish'
			);

			$author = get_user_by( 'name', $push->commit->author->name );
			if ( $author )
				$post_data['post_author'] = $author->ID;

			$post_id = wp_insert_post( $post_data, true );
			if ( is_wp_error( $post_id ) )
				continue;

			add_post_meta( $post_id, 'author', $push->commit->author->name );

			$count++;
		}

		return $count;
	}


	function get_fields() {
		return array(
			'url' => __( 'Repository URL', APP_TD ),
			'user' => __( 'Github User', APP_TD ),
			'pass' => __( 'Github Password', APP_TD ),
		);
	}
}

