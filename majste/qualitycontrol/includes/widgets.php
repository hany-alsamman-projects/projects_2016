<?php
/**
 * Widget for the taxonomies
 *
 * @since Quality Control 0.1
 */
class QC_Widget_Taxonomy extends scbWidget {

	protected $defaults = array(
		'title' => '',
		'taxonomy' => '',
		'show_rss' => '',
		'show_count' => ''
	);

	function __construct() {
		parent::__construct(
			'cat-tax',
			 __( 'QC: Taxonomy', APP_TD ),
			array(
				'description' => __( 'Create a list of any taxonomy.', APP_TD )
			)
		);
	}

	function form( $instance ) {
		if ( empty( $instance ) )
			$instance = $this->defaults;

		$taxonomies = array();
		foreach ( get_taxonomies( array( 'public' => true ), 'object' ) as $tax )
			$taxonomies[$tax->name] = $tax->labels->singular_name;

		$fields = array(
			array(
				'name'  => 'title',
				'type'  => 'text',
				'desc' => __( 'Title:', APP_TD ),
				'extra' => array( 'class' => 'widefat' )
			),

			array(
				'name'  => 'taxonomy',
				'type'  => 'select',
				'desc' => __( 'Taxonomy:', APP_TD ),
				'values' => $taxonomies
			),

			array(
				'name'  => 'show_rss',
				'type'  => 'checkbox',
				'desc' => __( 'Show RSS Link', APP_TD ),
			),

			array(
				'name'  => 'show_count',
				'type'  => 'checkbox',
				'desc' => __( 'Show Ticket Count', APP_TD ),
			),
		);

		foreach ( $fields as $field )
			echo html( 'p', $this->input( $field, $instance ) );
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		$instance[ 'taxonomy' ] = strip_tags( $new_instance[ 'taxonomy' ] );
		$instance[ 'show_rss' ] = isset( $new_instance[ 'show_rss' ] );
		$instance[ 'show_count' ] = isset( $new_instance[ 'show_count' ] );

		return $instance;
	}

	function content( $instance ) {
		extract( $instance );
?>
			<ul>
				<?php
					$taxes = get_categories( array(
						'hide_empty' => 0,
						'taxonomy' => $instance[ 'taxonomy' ],
						'orderby' => 'name'
					) );
					if ( $taxes ) : foreach ( $taxes as $tax ) :
				?>
						<li>
							<a href="<?php echo get_term_link( $tax, $instance[ 'taxonomy' ] ); ?>?feed=rss2" class="rss">
								<img src="<?php echo get_template_directory_uri(); ?>/images/rss.gif" alt="RSS" />
							</a>
							<a href="<?php echo get_term_link( $tax, $instance[ 'taxonomy' ] ); ?>" title="<?php printf( __( 'View all tickets marked %s', APP_TD ), $tax->name ); ?>">
								<?php echo $tax->name; ?>
								<?php if ( isset( $instance[ 'show_count' ] ) ) : ?><small>(<?php echo $tax->count; ?>)</small><?php endif; ?>
							</a>
						</li>
				<?php endforeach; else : ?>

					<li><?php _e( 'No Results', APP_TD ); ?></li>

				<?php endif; ?>
			</ul>
<?php
	}
}
register_widget( 'QC_Widget_Taxonomy' );


/**
 * Used by QC_Widget_Team widget
 */
class QC_User_Activity {

	static function init() {
		add_action( 'wp_insert_comment', array( __CLASS__, 'post_comment' ), 10, 2 );
		add_action( 'qc_create_ticket', array( __CLASS__, 'post_ticket' ), 10, 2 );
	}

	static function post_ticket( $ticket_id, $ticket ) {
		self::update_last_activity( $ticket['ticket_author'] );
	}

	static function post_comment( $comment_id, $comment ) {
		self::update_last_activity( $comment->user_id );
	}

	static function update_last_activity( $user_id ) {
		update_user_meta( $user_id, '_last_activity', current_time( 'mysql' ) );
	}

	static function get( $user_id ) {
		return get_user_meta( $user_id, '_last_activity', true );
	}
}
QC_User_Activity::init();

/**
 * Widget for the project team to list
 * them out with last activity time
 *
 * @since Quality Control 0.4
 */
class QC_Widget_Team extends scbWidget {

	function __construct() {
		$this->defaults = array(
			'title' => __( 'Project Team', APP_TD )
		);

		parent::__construct( 'qc_project_team', __( 'QC: Project Team', APP_TD ), array(
			'description' => __( 'Lists all team members assigned to this project and the time of their last activity.', APP_TD )
		) );
	}

	function content( $instance ) {
		extract( $instance );

		$users = get_users();

		echo '<ul>';

		foreach ( $users as $user ) {
			echo '<li>';
			echo '<a href="' . get_author_posts_url( $user->ID, $user->user_nicename ) . '">';

			echo get_avatar( $user->ID, '28' );

			echo $user->display_name;

			echo '</a>';

			if ( $last_activity = QC_User_Activity::get( $user->ID ) ) {
				echo ' <span class="activity">' . sprintf( __( 'Last activity: %s ago', APP_TD ), human_time_diff( strtotime( $last_activity ) ) ) . '</span>';
			}

			echo '</li>';
		}

		echo '</ul>';
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$new_instance = wp_parse_args( (array) $new_instance, array( 'title' => '') );
		$instance[ 'title' ] = strip_tags( $new_instance[ 'title' ] );
		return $instance;
	}

	function form( $instance ) {
		if ( empty( $instance ) )
			$instance = $this->defaults;

		extract( $instance );
?>
		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e( 'Title:', APP_TD ); ?></label>
			<input type="text" name="<?php echo $this->get_field_name('title'); ?>"  value="<?php echo esc_attr( $title ); ?>" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" />
		</p>
<?php
	}
}
register_widget( 'QC_Widget_Team' );


// remove some of the default sidebar widgets
function appthemes_unregister_widgets() {
    //unregister_widget('WP_Widget_Pages');
    unregister_widget( 'WP_Widget_Calendar' );
    //unregister_widget('WP_Widget_Archives');
    //unregister_widget('WP_Widget_Links');
    //unregister_widget('WP_Widget_Categories');
    //unregister_widget('WP_Widget_Recent_Posts');
    //unregister_widget('WP_Widget_Search');
    //unregister_widget('WP_Widget_Tag_Cloud');
}
add_action( 'widgets_init', 'appthemes_unregister_widgets' );

?>
