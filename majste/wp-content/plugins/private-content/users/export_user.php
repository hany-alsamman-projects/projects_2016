<?php 
if(isset($_POST['pg_export_user_data'])) {
	include(PG_DIR . '/users/export_script.php');	
}
?>

<div class="wrap pg_form lcwp_form">  
	<div class="icon32" id="icon-pg_user_manage"><br></div>
    <?php echo '<h2 class="pg_page_title">' . __( 'Export Users', 'pg_ml' ) . "</h2>"; ?>  
    
    <?php if(isset($error)) {echo $error;} ?>
    
    <br/>
    <form method="post" class="form-wrap" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" target="_blank">
    	<table class="widefat pg_table">
          <thead>
            <tr>  
              <th colspan="2">Choose what to export</th>
            </tr>  
          </thead>
          <tbody>
          <tr>
            <td class="pg_label_td"><?php _e("Users type" ); ?></td>
            <td class="pg_field_td">
            	<select name="users_type" class="chzn-select" data-placeholder="Select an option .." tabindex="2">
                  <option value="all">All</option>
                  <option value="actives">Only actives</option>
                  <option value="disabled">Only disabled</option>
                </select>
            </td>
          </tr>
          
          <tr>
            <td class="pg_label_td"><?php _e("Export as" ); ?></td>
            <td class="pg_field_td">
            	<select name="export_type" class="chzn-select" data-placeholder="Select an option .." tabindex="2">
                  <option value="excel">Excel (.xls)</option>
                  <option value="csv">CSV</option>
                </select>
            </td>
          </tr>
          
          <tr>
            <td class="pg_label_td"><?php _e("Categories" ); ?></td>
            <td class="pg_field_td">
              <ul class="pg_checkbox_list">
                <li>
                    <input type="checkbox" name="pg_categories[]" id="pg_export_all_cat" value="all" class="ip_checks" />
                    <label style="display:inline; padding-right:30px;"><?php _e('All') ?></label>
                </li>
              
                <?php
                $user_categories = get_terms('pg_user_categories', 'orderby=name&hide_empty=0');
                foreach ($user_categories as $ucat) {
                    echo '
                    <li class="pg_cat_lists">
                      <input type="checkbox" name="pg_categories[]" value="'.$ucat->term_id.'" class="ip_checks" />
                      <label style="display:inline; padding-right:30px;">'.$ucat->name.'</label> 
                    </li>
                    ';  
                }
                ?>
              </ul>
            </td>
          </tr>
          </tbody>
        </table>
       
      <input type="submit" name="pg_export_user_data" value="<?php _e('Export') ?>" class="button-primary" />  
    </form>
</div>  

<?php // SCRIPTS ?>
<script src="<?php echo PG_URL; ?>/js/iphone_checkbox/iphone-style-checkboxes.js" type="text/javascript"></script>
<script src="<?php echo PG_URL; ?>/js/chosen/chosen.jquery.min.js" type="text/javascript"></script>

<script type="text/javascript" >
jQuery(document).ready(function($) {
	
	// select/deselect all
	jQuery('#pg_export_all_cat').iphoneStyle({
        onChange: function(elem, value) {
			if(value == true) {
				jQuery('.pg_cat_lists').slideUp();	
			}
			else {jQuery('.pg_cat_lists').slideDown();}
        }
    });
	
	
	// iphone checks
	jQuery('.ip_checks').iphoneStyle({
	  checkedLabel: 'YES',
	  uncheckedLabel: 'NO'
	});
	

	// chosen
	jQuery('.chzn-select').each(function() {
		jQuery(".chzn-select").chosen(); 
		jQuery(".chzn-select-deselect").chosen({allow_single_deselect:true});
	});

});
</script>


