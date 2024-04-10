<? 
define( "WP_INSTALLING", true );
require ('../../../wp-blog-header.php');

//http://127.0.0.1/majste/wp-content/plugins/ajax-category-posts-dropdown/getacpd_posts.php?mainCats=1

if(isset($_GET['mainCats'])){
	
//$postslist = get_posts('numberposts='.get_option(acpd_post_count).'&order=ASC&orderby=title&category='.$_GET['mainCats'].'');
    $categories=  get_categories('child_of=9');
    foreach ($categories as $category) {
        $option = '<option value="/category/archives/'.$category->category_nicename.'">';
        $option .= $category->cat_name;
        $option .= ' ('.$category->category_count.')';
        $option .= '</option>';
        echo $option;
    }

//print_r($categories);
//echo "obj.options[obj.options.length] = new Option('Select a post','');\n";

}

?> 