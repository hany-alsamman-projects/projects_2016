<?
/*
Plugin Name: Ajax Categories Posts Dropdown
Plugin URI: http://codexc.com/plugins/
Description: easy to use Ajax dropdown of all categories. After selecting a category next dropdown.
Version: 0.1
Author: hany alsamman
Author URI: http://codexc.com
*/

function parent_child_cat_select() { ?>
<script type="text/javascript">
    /* <![CDATA[ */
    jQuery(document).ready(function() {
        jQuery('#parent_cat').change(function(){
            var parentCat=jQuery('#parent_cat').val();
            // call ajax
            jQuery.ajax({
                url:"/ticket/wp-admin/admin-ajax.php",
                type:'POST',
                data:'action=category_select_action&parent_cat_ID=' + parentCat,
                success:function(results)
                {
                    results = results.replace("cat", "category"); // value = 9:61
                    jQuery("#sub_cat_div").html(results);
                    //alert(results);
                }
            });
        });
    });
    /* ]]> */
</script>


    <div id="parent_cat_div"><?php wp_dropdown_categories("show_option_none=اختر القسم المطلوب&orderby=name&hierarchical=1&id=parent_cat&depth=1"); ?></div>

    <div id="sub_cat_div"><select name="sub_cat_disabled" id="sub_cat_disabled" disabled="disabled"><option>اختر الخدمة المطلوبة</option></select></div>

<?php
}

function implement_ajax() {
    $parent_cat_ID = $_POST['parent_cat_ID'];
    if ( isset($parent_cat_ID) )
    {
        $has_children = get_categories("parent=$parent_cat_ID");
        if ( $has_children ) {
            wp_dropdown_categories("orderby=name&parent=$parent_cat_ID");
        } else {
            ?><select name="sub_cat_disabled" id="sub_cat_disabled" disabled="disabled"><option>لاتوجد خدمات في هذا القسم</option></select><?php
        }
        die();
    } // end if
}
add_action('wp_ajax_category_select_action', 'implement_ajax');
add_action('wp_ajax_nopriv_category_select_action', 'implement_ajax');//for users that are not logged in.

//this is optional, only if you are not already using jQuery
//function load_jquery() {
//    wp_enqueue_script('jquery');
//}
//add_action('init', 'load_jquery');

?>
