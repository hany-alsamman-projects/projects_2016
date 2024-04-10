<?php include(PG_DIR . '/classes/paginator.php'); 

// QUERY SETUP AND PAGINATOR
global $wpdb;
$table_name = $wpdb->prefix . "pg_users";
$p = new paginator;

// USER MANAGEMENT ACTIONS (REMOVE - DISABLE - ENABLE)
if(isset($_GET['ucat_action']) && $_GET['ucat_action'] != '') {
	if(is_array($_GET['uca_bulk_act'])) {
		$user_involved = implode(',', $_GET['uca_bulk_act']);
	}
	else {$user_involved = $_GET['uca_bulk_act'];}
	
	$action = $_GET['ucat_action'];
	switch($action) {
		case 'delete' : 
			$act_q = 0;
			$act_message = __('User deleted', 'pg_ml');
			break;
		case 'disable' : 
			$act_q = 2;
			$act_message = __('User disabled', 'pg_ml');
			break;
		default : 
			$act_q = 1;	
			$act_message = __('User enabled', 'pg_ml');
			break;
	}
	
	$user_data = $wpdb->query( 
		$wpdb->prepare( "UPDATE ".$table_name." SET status = '".$act_q."' WHERE ID IN (".$user_involved.")") 
	);
}


/////////////////////////////////////////////////


// GET param 
$p->pag_param = 'pagenum';

// limit
$p->limit = 20;

// curr page
(isset($_GET['pagenum'])) ? $cur_page = $_GET['pagenum'] : $cur_page = 1;
$p->curr_pag = $cur_page;


////////////////////////////////
// if are filtering ////////////

// cat
if(!isset($_GET['cat']) || isset($_GET['cat']) && $_GET['cat'] == '') {$filter_cat = ''; $cat_filter_query = '';}
else {
	$filter_cat = addslashes($_GET['cat']); 
	$cat_filter_query = " AND categories LIKE '%\"$filter_cat\"%' ";
}

// username
if(!isset($_GET['username']) || isset($_GET['username']) && $_GET['username'] == '') {$filter_user = ''; $user_filter_query = '';}
else {
	$filter_user = addslashes($_GET['username']); 
	$user_filter_query = " AND (username LIKE '%$filter_user%' OR  name LIKE '%$filter_user%' OR surname LIKE '%$filter_user%')";
}

// status
if(!isset($_GET['status']) || isset($_GET['status']) && $_GET['status'] == 1) {$status = '1';}
elseif($_GET['status'] == 'disabled') {$status = '2';}
else {$status = '3';}


//////////////////////////////////////////


// total rows for active users
$wpdb->query("SELECT ID FROM ".$table_name." WHERE status = 1 ".$cat_filter_query." ".$user_filter_query."");
$total_act_rows = $wpdb->num_rows;

// total rows for disabled users
$wpdb->query("SELECT ID FROM ".$table_name." WHERE status = 2 ".$cat_filter_query." ".$user_filter_query."");
$total_dis_rows = $wpdb->num_rows;

// total rows for pending users
$wpdb->query("SELECT ID FROM ".$table_name." WHERE status = 3 ".$cat_filter_query." ".$user_filter_query."");
$total_pen_rows = $wpdb->num_rows;


($status==1) ? $total_rows = $total_act_rows : $total_rows = $total_dis_rows; 
$p->total_rows = $total_rows;


// offset
$offset = $p->get_offset();

// users query
$user_query = $wpdb->get_results("
	SELECT * FROM ".$table_name." 
	WHERE status = '".$status."' ".$cat_filter_query." ".$user_filter_query." 
	LIMIT ".$offset.", ".$p->limit.""
, ARRAY_A);

?>

<div class="wrap pg_form">  
	<div class="icon32" id="icon-pg_user_manage"><br></div>
    <?php echo '<h2 class="pg_page_title">' . 
	__( 'PrivateContent Users', 'pg_ml' ) . 
	'<a class="add-new-h2" href="admin.php?page=pg_add_user">'. __( 'Add New', 'pg_ml') .'</a>
	</h2>'; ?>  
	
    <?php
    if(isset($_GET['ucat_action']) && $_GET['ucat_action'] != '') { 
    	echo '<div class="updated"><p><strong>'. $act_message .'</strong></p></div>';	
	}
	?>
    
    <ul class="subsubsub">
            <li id="pg_active_users">
                <a href="admin.php?page=pg_user_manage&status=1" <?php if($status == 1) echo 'class="current"'; ?>>
					<?php _e('actives', 'pg_ml') ?> (<span><?php echo $total_act_rows; ?></span>)
                </a>
            </li> | 
            <li id="pg_disabled_users">
                <a href="admin.php?page=pg_user_manage&status=disabled" <?php if($status == 2) echo 'class="current"'; ?>>
					<?php _e('disabled', 'pg_ml') ?> (<span><?php echo $total_dis_rows; ?></span>)
                </a>
            </li> | 
            <li id="pg_pending_users">
                <a href="admin.php?page=pg_user_manage&status=pending" <?php if($status == 3) echo 'class="current"'; ?>>
					<?php _e('pending', 'pg_ml') ?> (<span><?php echo $total_pen_rows; ?></span>)
                </a>
            </li>
        </ul>
    
    
    <form method="get" id="pg_user_list_form" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
        <div class="tablenav">
            <?php
            echo $p->get_pagination('<div class="tablenav-pages">', '</div>');
            ?>
        
        	<input type="hidden" name="page" value="pg_user_manage"  />
            <input type="hidden" name="pagenum" value="1"  />
            <input type="hidden" name="status" value="
				<?php 
				if($status == 1) 	{echo 1;}
				elseif($status == 2){echo 'disabled';}
				else 				{echo 'pending';}
				?>" 
            />
            
            <select name="ucat_action" id="pg_ulist_action">
            	<option value=""><?php _e('Bulk Actions') ?></option>
                
                 <?php if(isset($_GET['status']) && ($_GET['status'] == 'disabled' || $_GET['status'] == 'pending')): ?>
                	<option value="enable"><?php echo __('Enable').' '.__('Users'); ?></option>
                <?php else : ?>
                	<option value="disable"><?php echo __('Disable').' '.__('Users'); ?></option>
                <?php endif; ?>
                
                <option value="delete"><?php echo __('Delete').' '.__('Users'); ?></option>
            </select>
            <input type="button" value="<?php _e('Apply'); ?>" class="button-secondary pg_submit" name="ucat_action" style="margin-right: 15px;">
            
        
        	<label for="username" style="padding-right: 5px;"><?php _e('Search') ?></label>
        	<input type="text" name="username" value="<?php echo stripslashes($filter_user); ?>" size="25" />
            
        	<select name="cat" id="pg_ulist_filter" style="margin-left: 15px;">
            	<option value=""><?php _e('All Categories') ?></option>
                <?php
                $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
				foreach ($user_categories as $ucat) {
					
					($filter_cat == $ucat->term_id) ? $ucat_sel = 'selected="selected"' : $ucat_sel = '';
					echo '<option value="'.$ucat->term_id.'" '.$ucat_sel.'>'.$ucat->name.'</selected>';	
				}
				?>
            </select>
            
            <input type="button" value="<?php _e('Filter'); ?>" class="button-secondary pg_submit" name="ucat_filter">
    	</div>
    
    
    	<table class="widefat pg_table">
        <thead>
            <tr>
              <th id="cb" class="manage-column column-cb check-column" scope="col">
                <input type="checkbox" />
              </th>
              <th>ID</th>
              <th><?php _e('Name') ?></th>
              <th><?php _e('Username') ?></th>
              <th>E-mail</th>
              <th><?php _e('Telephone') ?></th>
              <th><?php _e('Categories') ?></th>
              <th>Insert Date</th>
              <th style="width: 125px;">&nbsp;</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
              <th></th>
              <th>ID</th>
              <th><?php _e('Name') ?></th>
              <th><?php _e('Username') ?></th>
              <th>E-mail</th>
              <th><?php _e('Telephone') ?></th>
              <th><?php _e('Categories') ?></th>
              <th>Insert Date</th>
              <th>&nbsp;</th>
            </tr>
        </tfoot>
        <tbody>
		  <?php 
		  foreach($user_query as $user) : 
		  
		  	// get category name and paginate it
		  	$user_cats = unserialize($user['categories']);
			
			$user_cat_name_arr = array();
			if(is_array($user_cats)) {
				foreach($user_cats as $u_cat) {
					$cat_obj = get_term_by('id', $u_cat, 'pg_user_categories');
					if(is_object($cat_obj)) {
						$user_cat_name_arr[] = $cat_obj->name;
					}
				}
			}
			$user_cat_string = implode(', ', $user_cat_name_arr);
		  ?>
          <tr class="content_row">
          	 <td class="uca_bulk_input_wrap">
                <input type="checkbox" name="uca_bulk_act[]" value="<?php echo $user['id'] ?>" />
             </td>
             <td># <?php echo $user['id'] ?></td>
             <td><?php echo $user['name'].' '.$user['surname'] ?></td>
             <td id="pguu_<?php echo $user['id'] ?>"><?php echo $user['username'] ?></td>
             <td>&nbsp;<?php echo $user['email'] ?></td>
             <td>&nbsp;<?php echo $user['tel'] ?></td>
             <td><?php echo $user_cat_string ?></td>
             <td><?php echo  date_i18n(get_option('date_format') ,strtotime($user['insert_date'])); ?></td>
             <td style="text-align: right;">
             	
                <?php // EDIT USER PAGE ?>
             	<?php if($user['disable_pvt_page'] == 0 && (!isset($_GET['status']) || $_GET['status'] != 'pending') ) : ?>
				<a href="<?php echo get_bloginfo('url'); ?>/wp-admin/post.php?post=<?php echo $user['page_id'] ?>&action=edit">
					<img src="<?php echo PG_URL; ?>/img/user_page.png" alt="user_page" title="<?php _e('User Page', 'pg_ml'); ?>" />
                </a>
                <span class="v_divider">|</span>
				<?php endif; ?>
             
             
             	<?php // EDIT USER ?>
                <?php if(!isset($_GET['status']) || $_GET['status'] != 'pending') : ?>
             	<a href="admin.php?page=pg_add_user&user=<?php echo $user['id'] ?>">
					<img src="<?php echo PG_URL; ?>/img/edit_user.png" alt="edit_user" title="<?php _e('Edit'); ?>" />
                </a> 
                
                <span class="v_divider">|</span> 
                <?php endif; ?>
                
                
                <?php // ENABLE / DISABLE USER ?>
                <?php if(isset($_GET['status']) && ($_GET['status'] == 'disabled' || $_GET['status'] == 'pending')) : ?>
                	<a href="<?php echo $p->getManager('ucat_action=enable&uca_bulk_act[]='.$user['id']) ?>">
                        <img src="<?php echo PG_URL; ?>/img/enable_user.gif" alt="ena_user" title="<?php _e('Enable'); ?>" />
                    </a>
                <?php else: ?>
                	<a href="<?php echo $p->getManager('ucat_action=disable&uca_bulk_act[]='.$user['id']) ?>">
                        <img src="<?php echo PG_URL; ?>/img/disable_user.gif" alt="dis_user" title="<?php _e('Disable'); ?>" />
                    </a>
                <?php endif; ?>
                
                <span class="v_divider">|</span> 
                
                
                <?php // DELETE USER ?>
                <span class="pg_trigger del_pg_user" id="dpgu_<?php echo $user['id'] ?>">
					<img src="<?php echo PG_URL; ?>/img/del_user.png" alt="del_user" title="<?php _e('Delete'); ?>" />
                </span>
             </td>
           </tr>
          <?php endforeach; ?>
        </tbody>
        </table>
	</form>
    
    <?php
	echo $p->get_pagination('<div class="tablenav"><div class="tablenav-pages">', '</div></div>');
	?>
	
    <div id="pg_users_table"></div>    
</div>

<script type="text/javascript" >
jQuery(document).ready(function($) {
	
	// select/deselect all
	jQuery('#cb input').click(function() {
		if(jQuery(this).is(':checked')) {
			jQuery('.uca_bulk_input_wrap input').attr('checked', 'checked');	
		}
		else {jQuery('.uca_bulk_input_wrap input').removeAttr('checked');}
	});
	
	
	// group deleting confirm
	jQuery('#pg_user_list_form .pg_submit').click(function() {
		var e = true;
		
		if( jQuery('#pg_ulist_action').val() == 'delete') {
			if(confirm("<?php _e('Do you really want to delete these users?'); ?> ")) {
				e = true;	
			}
			else {e = false;}
		}
		
		if(e == true) {jQuery('#pg_user_list_form').submit();}
	});
	
	
	// ajax delete
	jQuery('.del_pg_user').click(function() {
		var user_id = jQuery(this).attr('id').substr(5);
		var user_username = jQuery('#pguu_' + user_id).html();
		
		if(confirm('<?php _e('Do you really want to delete ', 'pg_ml') ?> ' + user_username + '?')) {
			var data = {
				action: 'delete_pg_user',
				pg_user_id: user_id
			};
			
			jQuery.post(ajaxurl, data, function(response) {
				jQuery('#pguu_' + user_id).parent().slideUp(function() {
					jQuery(this).remove();
					
					// decrease number in header
					jQuery('.subsubsub a').each(function() {
						if(jQuery(this).hasClass('current')) {
							var curr_num = jQuery(this).children('span').html();
							var new_num = parseInt(curr_num) - 1;	
							jQuery(this).children('span').html(new_num);
						}
					});
				});
			});	
		}
		
	});
});
</script>
