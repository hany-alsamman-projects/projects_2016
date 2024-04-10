<?php
/**
 * @package Export_Ticket_to_CSV
 * @version 0.1
 */
/*
Plugin Name: Export Sales Report to CSV
Plugin URI: http://codexc.com/plugins/
Description: Export Sales Report to a csv file.
Version: 0.1
Author: hany alsamman
Author URI: http://codexc.com/
License: GPL2
Text Domain: export-sales-to-csv
*/

load_plugin_textdomain( 'export-sales-to-csv', false, basename( dirname( __FILE__ ) ) . '/languages' );

/**
 * Main plugin class
 *
 * @since 0.1
 **/
class PP_EU_Export_SALES {

	/**
	 * Class contructor
	 *
	 * @since 0.1
	 **/
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_pages' ) );
		add_action( 'init', array( $this, 'generate_csv' ) );
        add_shortcode( 'generate_csv', 'init' );
        add_shortcode( 'front_out_page', array( $this, 'front_out_page' ) );

		add_filter( 'pp_eu_exclude_data', array( $this, 'exclude_data' ) );

	}

	/**
	 * Add administration menus
	 *
	 * @since 0.1
	 **/
	public function add_admin_pages() {
		add_users_page( __( 'تصدير تقرير المسوقين', 'export-sales-to-csv' ), __( 'تصدير تقرير المسوقين', 'export-sales-to-csv' ), 'list_users', 'export-sales-to-csv', array( $this, 'users_page' ) );
	}

    public function get_the_fucker($post_id, $taxonomy){

//     SELECT * FROM `wp_term_relationships` r,  `wp_terms` t, `wp_term_taxonomy` x WHERE `object_id` = '59'  and t.`term_id` = r.`term_taxonomy_id` and r.`term_taxonomy_id` = x.`term_taxonomy_id`

        global $wpdb;
        $get_term = $wpdb->get_results( "SELECT * FROM `wp_term_relationships` r,  `wp_terms` t, `wp_term_taxonomy` x WHERE `object_id` = '".$post_id."'  and t.`term_id` = r.`term_taxonomy_id` and r.`term_taxonomy_id` = x.`term_taxonomy_id` and x.`taxonomy` = '".$taxonomy."'" );
        return $get_term;
    }

    public function filter_dates_between( $where =''  ) {
        global $dateFrom,$dateTo,$wpdb;

        $dateFrom = $_POST['start_date'];

        $dateTo= $_POST['end_date'];

        $where .= $wpdb->prepare( " AND post_date >= %s", $dateFrom );
        $where .= $wpdb->prepare( " AND post_date <= %s", $dateTo );

        return $where;
    }

    public function get_sales_posts($meta_key='_assigned_to', $sales_id='4'){


        $args = array('orderby' => 'post_date','order'=> 'DESC','meta_key' => $meta_key,'meta_value' => $sales_id,'post_type' => 'ticket','post_status' => 'publish','suppress_filters' => false );

        /*
            [0] => WP_Post Object
                    (
                    [ID] => 39
                    [post_author] => 1
                    [post_date] => 2013-02-28 00:51:37
                    [post_date_gmt] => 2013-02-27 21:51:37
                    [post_content] => sdfsf
                    [post_title] => hany
                    [post_excerpt] =>
                    [post_status] => publish
                    [comment_status] => open
                    [ping_status] => open
                    [post_password] =>
                    [post_name] => hany
                    [to_ping] =>
                    [pinged] =>
                    [post_modified] => 2013-02-28 11:27:03
                    [post_modified_gmt] => 2013-02-28 08:27:03
                    [post_content_filtered] =>
                    [post_parent] => 0
                    [guid] => http://127.0.0.1/majste/ticket/hany/
                    [menu_order] => 0
                    [post_type] => ticket
                    [post_mime_type] =>
                    [comment_count] => 1
                    [filter] => raw
                )*/

        add_filter( 'posts_where', array( $this, 'filter_dates_between' ) );
        $posts = get_posts( $args );
        remove_filter( 'posts_where',array( $this, 'filter_dates_between' ) );
        return $posts;
    }

    public function fetch_sales($mygroup){

        global $wpdb;

        $ticket_status = array();
        $sales_users = array();
        $ticket_paid = array('paid'=>0);
        $ticket_remain = array('remain'=>0);
        $mypaid = false;
        $myremain = false;
        $my_report = array();
        $sales_target = array();

        foreach($mygroup->users AS $user_group){


            //get posts assigned to this user
            $sale_assigned_to = $this->get_sales_posts('_assigned_to',$user_group->user->ID);

            //print print_r($sale_assigned_to);
            if(is_array($sale_assigned_to) and !empty($sale_assigned_to)){

                foreach($sale_assigned_to AS $sales_post){
                    $terms = $this->get_the_fucker($sales_post->ID,'ticket_status');
                    if($terms[0]->slug != false) array_push($ticket_status,$terms[0]->slug);

                    $paid = get_post_meta($sales_post->ID, '_paid');

                    if($paid[0] > 0) {
                        $mypaid += $paid[0];
                    }

                    $remain = get_post_meta($sales_post->ID, '_remain');
                    if($remain[0] > 0){
                        $myremain += $remain[0];
                    }
                }

                $ticket_paid = array('paid' => $mypaid);
                $ticket_remain = array('remain' => $myremain);

                $sales_target = array('target' => number_format(($mypaid/SALES_TARGET*100), 2, '.', ''));

            }


            $target_total = array('target_total' => SALES_TARGET);

            $appended = array_merge(array('name' => $user_group->user->data->user_nicename, 'app' => array_count_values($ticket_status)),array('app' => array_count_values($ticket_status)),$ticket_remain,$ticket_paid,$target_total,$sales_target);

            array_push($my_report, $appended);
        }
        return $my_report;
    }

    /**
	 * Process content of CSV file
	 *
	 * @since 0.1
	 **/
	public function generate_csv() {

        global $wpdb;

		if ( isset( $_POST['_wpnonce-pp-eu-export-users-users-page_export'] ) ) {
			check_admin_referer( 'pp-eu-export-users-users-page_export', '_wpnonce-pp-eu-export-users-users-page_export' );

            if( isset($_POST['start_date']) ){

                //here i get the target from submitted value
                $mydate = $_POST['start_date'];

                //$target = array( [1] => January [2] => February [3] => March [4] => April [5] => May [6] => June [7] => July [8] => August [9] => September [10] => October [11] => November [12] => December );
                $target = array( "1" => '28000', "2" => '28000', "3" => '28000', "4" => '28000', "5" => '28000', "6" => '28000', "7" => '28000', "8" => '28000', "9" => '28000', "10" => '28000', "11" => '28000', "12" => '28000' );

                $month = date("n",strtotime($mydate));

                //here i set the target for get
                define("SALES_TARGET", $target[$month]);
            }


            if($_POST['role'] != 'all'){


                ## get all super_visor
                $visor_id = $_POST['role'];

                //get super_visor group id
                $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".$visor_id."' and group_id != '1' LIMIT 1");

                //get users list for this group
                $mygroup = new Groups_Group( $visor_gid );

                //here hany magic
                $people = $this->fetch_sales($mygroup);


            }else{

                ## get all super_visor
                $users = get_users( array( 'role'=> 'super_visor','orderby' => 'login', 'order' => 'ASC') );

                if ( ! $users ) {
                    $referer = add_query_arg( 'error', 'empty', wp_get_referer() );
                    wp_redirect( $referer );
                    exit;
                }

                foreach ($users as $visor){
                    //get super_visor group id
                    $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".$visor->data->ID."' and group_id != '1' LIMIT 1");

                    //get users list for this group
                    $mygroup = new Groups_Group( $visor_gid );

                    //here hany magic
                    $people = $this->fetch_sales($mygroup);

                }


            }





			$sitename = sanitize_key( get_bloginfo( 'name' ) );
			if ( ! empty( $sitename ) )
				$sitename .= '.';
			$filename = $sitename . 'sales.' . date( 'Y-m-d-H-i-s' ) . '.csv';

			header( 'Content-Description: File Transfer' );
			header( 'Content-Disposition: attachment; filename=' . $filename );
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Content-type: application/vnd.ms-excel charset=windows-1256");


            $data_keys = array(
                'اسم المسوق', 'مغلقة', 'تمت العملية',  'مفتوحة', 'قيد المعالجة','المبلغ المسدد' , 'المبلغ المتبقي', 'مبلغ الشهر' , 'التارجت'		);



			$headers = array();
			foreach ( $data_keys as $key => $field ) {
                    $field = iconv('UTF-8', 'windows-1256', $field);
					$headers[] = '"' . $field . '"';
			}
            echo implode( ',', $headers ) . "\n";



            /*
            Array
            (
                [name] => sales
                [app] => Array
                    (
                        [new] => 1
                        [finish] => 2
                    )

                [remain] => 700
                [paid] => 2700
            )
            */

            for($i = 0, $size = count($people); $i < $size; ++$i) {
                $data = array();
                if(!array_key_exists('new',$people[$i]['app'])) $people[$i]['app']['new'] = '0';
                if(!array_key_exists('closed',$people[$i]['app'])) $people[$i]['app']['closed'] = '0';
                if(!array_key_exists('finish',$people[$i]['app'])) $people[$i]['app']['finish'] = '0';
                if(!array_key_exists('pending',$people[$i]['app'])) $people[$i]['app']['pending'] = '0';

                ksort($people[$i]['app']);

                //print_r($people[$i]['app']);

                $data[] = '"' . str_replace( '"', '""', $people[$i]['name'] ) . '"';

                foreach($people[$i]['app'] as $state => $value){

                    $data[] = '"' . str_replace( '"', '""', $value ) . '"';
                }

                $data[] = '"' . str_replace( '"', '""', $people[$i]['remain'] ) . '"';
                $data[] = '"' . str_replace( '"', '""', $people[$i]['paid'] ) . '"';

                $data[] = '"' . str_replace( '"', '""', $people[$i]['target_total'] ) . '"';
                $data[] = '"' . str_replace( '"', '""', $people[$i]['target'] ) . '"';

                echo implode( ',', $data ) . "\n";
            }

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
                        echo '<option value="all">الكل</option>';
                        $this->get_supervisor_list();
						?>
					</select>
				</td>
			</tr>
			<tr valign="top">
				<th scope="row"><label><?php _e( 'تحديد التاريخ', 'export-users-to-csv' ); ?></label></th>
				<td>
					<select name="start_date" id="pp_eu_users_start_date">
						<option value="0"><?php _e( 'من تاريخ', 'export-users-to-csv' ); ?></option>
						<?php $this->export_start_date(); ?>
					</select>
					<select name="end_date" id="pp_eu_users_end_date">
						<option value="0"><?php _e( 'الى تاريخ', 'export-users-to-csv' ); ?></option>
						<?php $this->export_end_date(); ?>

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

	private function export_start_date() {
		global $wpdb, $wp_locale;

		$months = $wpdb->get_results( "
			SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month
			FROM $wpdb->posts
			ORDER BY post_date DESC
		" );

		$month_count = count( $months );
		if ( !$month_count || ( 1 == $month_count && 0 == $months[0]->month ) )
			return;

		foreach ( $months as $date ) {
			if ( 0 == $date->year )
				continue;

			$month = zeroise( $date->month, 2 );

			echo '<option value="' . $date->year . '-' . $month . '-1">' . $wp_locale->get_month( $month ) . ' ' . $date->year . '</option>';
		}
	}

    /**
     * Content of the settings page
     *
     * @since 0.1
     **/
    public function front_out_page() {
        if ( ! current_user_can( 'super_visor' ) )
            wp_die( __( 'ليس لديك الصلاحية لمشاهدة هذه الصفحة', 'export-users-to-csv' ) );
        ?>

<div class="wrap">
    <h2><?php _e( 'تصدير قائمة الموظفين الخاصة بك', 'export-users-to-csv' ); ?></h2>
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
                        echo '<option value="">' . __( 'تخريج مجموعتي الخاصة', 'export-users-to-csv' ) . '</option>';
                        echo '<option value="<?=get_current_user_id( )?">مجموعتي</option>';

                        ?>
                    </select>
                </td>
            </tr>
            <tr valign="top">
                <th scope="row"><label><?php _e( 'تحديد التاريخ', 'export-users-to-csv' ); ?></label></th>
                <td>
                    <select name="start_date" id="pp_eu_users_start_date">
                        <option value="0"><?php _e( 'من تاريخ', 'export-users-to-csv' ); ?></option>
                        <?php $this->export_start_date(); ?>
                    </select>
                    <select name="end_date" id="pp_eu_users_end_date">
                        <option value="0"><?php _e( 'الى تاريخ', 'export-users-to-csv' ); ?></option>
                        <?php $this->export_end_date(); ?>

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

    function get_supervisor_list(){
        global $wpdb;
        ## get all super_visor
        $users = get_users( array( 'role'=> 'super_visor','orderby' => 'login', 'order' => 'ASC') );

        foreach ($users as $visor){
            //get super_visor group id
            $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".$visor->data->ID."' and group_id != '1' LIMIT 1");
            echo '<option value="' . $visor_gid .'">' . $visor->user_nicename . '</option>';
        }

    }

    private function export_end_date() {
        global $wpdb, $wp_locale;

        $months = $wpdb->get_results( "
			SELECT DISTINCT YEAR( post_date ) AS year, MONTH( post_date ) AS month
			FROM $wpdb->posts
			ORDER BY post_date DESC
		" );

        $month_count = count( $months );
        if ( !$month_count || ( 1 == $month_count && 0 == $months[0]->month ) )
            return;

        foreach ( $months as $date ) {
            if ( 0 == $date->year )
                continue;

            $month = zeroise( $date->month, 2 );
            $days = cal_days_in_month(CAL_GREGORIAN, $date->month, $date->year);
            echo '<option value="' . $date->year . '-' . $month . '-' . $days.'">' . $wp_locale->get_month( $month ) . ' ' . $date->year . '</option>';
        }
    }
}

new PP_EU_Export_SALES;
