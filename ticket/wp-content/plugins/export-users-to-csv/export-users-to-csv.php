<?php
/**
 * @package Export_Ticket_to_CSV
 * @version 0.1
 */
/*
Plugin Name: Export Ticket to CSV
Plugin URI: http://codexc.com/plugins/
Description: Export Ticket data and metadata to a csv file.
Version: 0.1
Author: hany alsamman
Author URI: http://codexc.com/
License: GPL2
Text Domain: export-ticket-to-csv
*/

load_plugin_textdomain( 'export-ticket-to-csv', false, basename( dirname( __FILE__ ) ) . '/languages' );

/**
 * Main plugin class
 *
 * @since 0.1
 **/
class PP_EU_Export_Tickets {

	/**
	 * Class contructor
	 *
	 * @since 0.1
	 **/
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		add_action( 'init', array( $this, 'generate_csv' ) );
		add_filter( 'pp_eu_exclude_data', array( $this, 'exclude_data' ) );
	}

	/**
	 * Add administration menus
	 *
	 * @since 0.1
	 **/
	public function add_admin_pages() {
		add_users_page( __( 'CSV تصدير المراسلات', 'export-ticket-to-csv' ), __( 'CSV تصدير المراسلات', 'export-ticket-to-csv' ), 'list_users', 'export-ticket-to-csv', array( $this, 'users_page' ) );
	}

    function xlsWriteLabel($Row, $Col, $Value ) {
        $L = strlen($Value);
        echo pack("ssssss", 0x204, 8 + $L, $Row, $Col, 0x0, $L);
        echo $Value;
        return;
    }


    function array_put_to_position(&$array, $object, $position, $name = null)
    {
        $count = 0;
        $return = array();
        foreach ($array as $k => $v)
        {
            // insert new object
            if ($count == $position)
            {
                if (!$name) $name = $count;
                $return[$name] = $object;
                $inserted = true;
            }
            // insert old object
            $return[$k] = $v;
            $count++;
        }
        if (!$name) $name = $count;
        if (!$inserted) $return[$name];
        $array = $return;
        return $array;
    }

    public function get_the_fucker($post_id, $taxonomy){

//     SELECT * FROM `wp_term_relationships` r,  `wp_terms` t, `wp_term_taxonomy` x WHERE `object_id` = '59'  and t.`term_id` = r.`term_taxonomy_id` and r.`term_taxonomy_id` = x.`term_taxonomy_id`

        global $wpdb;
        $get_term = $wpdb->get_results( "SELECT * FROM `wp_term_relationships` r,  `wp_terms` t, `wp_term_taxonomy` x WHERE `object_id` = '".$post_id."'  and t.`term_id` = r.`term_taxonomy_id` and r.`term_taxonomy_id` = x.`term_taxonomy_id` and x.`taxonomy` = '".$taxonomy."'" );
        return $get_term;
    }

    /**
	 * Process content of CSV file
	 *
	 * @since 0.1
	 **/
	public function generate_csv() {

		if ( isset( $_POST['_wpnonce-pp-eu-export-users-users-page_export'] ) ) {
			check_admin_referer( 'pp-eu-export-users-users-page_export', '_wpnonce-pp-eu-export-users-users-page_export' );

			$args = array(
                    'post_type' => 'ticket',
                    'posts_per_page' => 1
			);

			//add_action( 'pre_user_query', array( $this, 'pre_user_query' ) );
			$users = get_posts( $args );
            //remove_action( 'pre_user_query', array( $this, 'pre_user_query' ) );

			if ( ! $users ) {
				$referer = add_query_arg( 'error', 'empty', wp_get_referer() );
				wp_redirect( $referer );
				exit;
			}

			$sitename = sanitize_key( get_bloginfo( 'name' ) );
			if ( ! empty( $sitename ) )
				$sitename .= '.';
			$filename = $sitename . 'tickts.' . date( 'Y-m-d-H-i-s' ) . '.csv';

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Content-type: application/vnd.ms-excel charset=windows-1256");

			//$exclude_data = apply_filters( 'pp_eu_exclude_data', array() );

			global $wpdb;

			$data_keys = array(
                'رقم المراسلة', 'تاريخ المراسلة',  'عنوان المراسلة', 'التصنيف' , 'اسم الزبون','بريد الزبون','اسم المسوق' , 'حالة المراسلة' , 'رقم الهاتف', 'المسدد', 'المتبقي' , 'الاهمية' , 'رابط المراسلة'			);

            /*Array
                (
                [0] => stdClass Object
                        (
                        [ticket_id] => 11
                        [phone] => 1
                        [ticket_date] => 2013-02-19 12:46:22
                        [ticket_title] => rwar
                        [post_id] => 11
                        [ticket_author] => admin
                        [assgined] =>
                        [status] => 11
                        [balance] =>
                        [ticket_url] => http://127.0.0.1/majste/?post_type=ticket&#038;p=11
                    )*/


			$meta_keys = $wpdb->get_results( "SELECT p.`ID` AS ticket_id, p.`post_date` AS ticket_date, p.`post_title` AS ticket_title,p.`ID` AS post_id,u.`display_name` AS ticket_author,u.`user_email` AS author_email,(SELECT u.`display_name` FROM `wp_postmeta` p , `wp_users` u WHERE p.`meta_key` = '_assigned_to' and p.`post_id` = p.`ID`  and p.`meta_value` = u.`ID`) AS assgined,p.`ID` AS status, u.`ID` AS phone,(SELECT p.`meta_value` FROM `wp_postmeta` p , `wp_users` u WHERE p.`meta_key` = '_paid' and p.`post_id` = p.`ID` LIMIT 1) AS paid ,(SELECT p.`meta_value` FROM `wp_postmeta` p , `wp_users` u WHERE p.`meta_key` = '_remain' and p.`post_id` = p.`ID` LIMIT 1) AS remain,p.`ID` AS priority,p.`guid` AS ticket_url FROM `wp_posts` p , `wp_users` u WHERE p.`post_type` = 'ticket' and u.`ID` = p.`post_author` and p.`post_status` = 'publish'" );

            $catid = get_the_category( get_the_ID() );

			$headers = array();
			foreach ( $data_keys as $key => $field ) {
                    $field = iconv('UTF-8', 'windows-1256', $field);
					$headers[] = '"' . $field . '"';
			}
			echo implode( ',', $headers ) . "\n";

            ## aim as mobile

            //array_put_to_position($meta_keys, '', 2, 'mobile');

            //print_r($meta_keys);

            ## status of ticket

            ## Pority

			foreach ( $meta_keys as $ticket ) {
				$data = array();
                $i = 0;
				foreach ( $ticket as $key => $value ) {
					if($key == 'assgined' && !isset($value)) $value = 'لا يوجد';

                    if($key == 'post_id'){
                      $catid = get_the_category( $value );
                      $value = $catid[0]->cat_name;
                    }

                    if($key == 'phone'){
                       $value = get_usermeta($value, 'aim' );
                    }


                    if($key == 'priority'){
                        $terms = $this->get_the_fucker($value,'ticket_priority');
                        $value =  $terms[0]->name;
                    }

                    if($key == 'status'){
                        $terms = $this->get_the_fucker($value,'ticket_status');
                        $value =  $terms[0]->name;
                    }

                    if($key == 'balance'){
                        //$value =  number_format(($value/SALES_TARGET*100), 2, '.', '');
                    }

                    $value = iconv('UTF-8', 'windows-1256', $value);
                    $data[] = '"' . str_replace( '"', '""', $value ) . '"';
                    $i++;
				}
				echo implode( ',', $data ) . "\n";

			}
            //print_r($data);
			exit;
		}
	}

	/**
	 * Content of the settings page
	 *
	 * @since 0.1
	 **/
	public function users_page() {
		if ( ! current_user_can( 'list_users' ) )
			wp_die( __( 'You do not have sufficient permissions to access this page.', 'export-users-to-csv' ) );
?>

<div class="wrap">
	<h2><?php _e( 'تصدير قائمة بالموظفين او المشتركين في قائمة اكسل', 'export-users-to-csv' ); ?></h2>
	<?php
	if ( isset( $_GET['error'] ) ) {
		echo '<div class="updated"><p><strong>' . __( 'No user found.', 'export-users-to-csv' ) . '</strong></p></div>';
	}
	?>
	<form method="post" action="" enctype="multipart/form-data">
		<?php wp_nonce_field( 'pp-eu-export-users-users-page_export', '_wpnonce-pp-eu-export-users-users-page_export' ); ?>
		<table class="form-table">
			<tr valign="top">
				<th scope="row"><label for"pp_eu_users_role"><?php _e( 'المجموعة', 'export-users-to-csv' ); ?></label></th>
				<td>
					<select name="role" id="pp_eu_users_role">
						<?php
						echo '<option value="">' . __( 'حسب المجموعة', 'export-users-to-csv' ) . '</option>';
						global $wp_roles;

						foreach ( $wp_roles->role_names as $role => $name ) {
							echo "\n\t<option value='" . esc_attr( $role ) . "'>$name</option>";
						}
						?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php _e( 'تحديد التاريخ', 'export-users-to-csv' ); ?></label></th>
				<td>
					<select name="start_date" id="pp_eu_users_start_date">
						<option value="0"><?php _e( 'من تاريخ', 'export-users-to-csv' ); ?></option>
						<?php $this->export_date_options(); ?>
					</select>
					<select name="end_date" id="pp_eu_users_end_date">
						<option value="0"><?php _e( 'الى تاريخ', 'export-users-to-csv' ); ?></option>
						<?php $this->export_date_options(); ?>
					</select>
				</td>
			</tr>
		</table>
		<p class="submit">
			<input type="hidden" name="_wp_http_referer" value="<?php echo $_SERVER['REQUEST_URI'] ?>" />
			<input type="submit" class="button-primary" value="<?php _e( 'تصدير', 'export-users-to-csv' ); ?>" />
		</p>
	</form>
<?php
	}

	public function exclude_data() {
		$exclude = array( 'user_pass','user_status','user_url','user_activation_key','admin_color','aim','closedpostboxes_changeset','comment_shortcuts','description','dismissed_wp_pointers','jabber','managenav-menuscolumnshidden','metaboxhidden_changeset','metaboxhidden_nav-menus','rich_editing','show_admin_bar_front','show_welcome_panel','use_ssl','wp_capabilities','wp_dashboard_quick_press_last_post_id','wp_user_level','yim','_last_activity' );

		return $exclude;
	}

	public function pre_user_query( $user_search ) {
		global $wpdb;

		$where = '';

		if ( ! empty( $_POST['start_date'] ) )
			$where .= $wpdb->prepare( " AND $wpdb->users.user_registered >= %s", date( 'Y-m-d', strtotime( $_POST['start_date'] ) ) );

		if ( ! empty( $_POST['end_date'] ) )
			$where .= $wpdb->prepare( " AND $wpdb->users.user_registered < %s", date( 'Y-m-d', strtotime( '+1 month', strtotime( $_POST['end_date'] ) ) ) );

		if ( ! empty( $where ) )
			$user_search->query_where = str_replace( 'WHERE 1=1', "WHERE 1=1$where", $user_search->query_where );

		return $user_search;
	}

	private function export_date_options() {
		global $wpdb, $wp_locale;

		$months = $wpdb->get_results( "
			SELECT DISTINCT YEAR( user_registered ) AS year, MONTH( user_registered ) AS month
			FROM $wpdb->users
			ORDER BY user_registered DESC
		" );

		$month_count = count( $months );
		if ( !$month_count || ( 1 == $month_count && 0 == $months[0]->month ) )
			return;

		foreach ( $months as $date ) {
			if ( 0 == $date->year )
				continue;

			$month = zeroise( $date->month, 2 );
			echo '<option value="' . $date->year . '-' . $month . '">' . $wp_locale->get_month( $month ) . ' ' . $date->year . '</option>';
		}
	}
}

new PP_EU_Export_Tickets;
