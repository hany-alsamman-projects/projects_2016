<?php
/*
Template Name: List of authors
*/


function contributors() {
    global $wpdb;

    $authors = $wpdb->get_results("SELECT ID, user_nicename from $wpdb->users WHERE display_name <> 'admin' ORDER BY display_name");

    if( current_user_can( 'super_visor' ) ){

        $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".get_current_user_id( )."' and group_id != '1' LIMIT 1");

        foreach ($authors as $author ) {

            //check if this sales in visor group
            if ( Groups_User_Group::read( $author->ID  , $visor_gid ) ) {

                $user_gid = $wpdb->get_var("SELECT name from wp_groups_group WHERE `group_id` = '".$visor_gid."' and group_id != '1' LIMIT 1");

                $user = get_userdata( $author->ID );

                if($user->roles[0] == 'author'){

                echo "<li>";
                echo "<a href=\"".get_bloginfo('url')."/author/";
                the_author_meta('user_nicename', $author->ID);
                echo "/\">";
                echo '<img style="float:left" src="'.get_template_directory_uri().'/images/user_avatar.jpg" >';
                echo "</a>";
                echo '<div>';
                echo "<a href=\"".get_bloginfo('url')."/author/";
                the_author_meta('user_nicename', $author->ID);
                echo "/\">";
                the_author_meta('display_name', $author->ID);
                echo "</a>";
        /*        echo "<br />";
                echo "Website: <a href=\"";
                the_author_meta('user_url', $author->ID);
                echo "/\" target='_blank'>";
                the_author_meta('user_url', $author->ID);
                echo "</a>";*/
                echo "<br />";
                echo "رقم الهاتف :  ";
                the_author_meta('aim', $author->ID);
                echo "<br />";
                echo "<a href=\"".get_bloginfo('url')."/author/";
                the_author_meta('user_nicename', $author->ID);
                echo "/\">استعراض مراسلات&nbsp;";
                the_author_meta('display_name', $author->ID);
                echo "</a>";
                echo "<br />";
                echo "المجموعة $user_gid";
                echo "</div>";
                echo "</li>";
                }

            }//end check if this sales in visor group

        }
    }

    if(current_user_can( 'administrator' )){

        foreach ($authors as $author ) {

                $user = get_userdata( $author->ID );

                if($user->roles[0] == 'author'){

                    echo "<li>";
                    echo "<a href=\"".get_bloginfo('url')."/author/";
                    the_author_meta('user_nicename', $author->ID);
                    echo "/\">";
                    echo '<img style="float:left" src="'.get_template_directory_uri().'/images/user_avatar.jpg" >';
                    echo "</a>";
                    echo '<div>';
                    echo "<a href=\"".get_bloginfo('url')."/author/";
                    the_author_meta('user_nicename', $author->ID);
                    echo "/\">";
                    the_author_meta('display_name', $author->ID);
                    echo "</a>";
                    /*        echo "<br />";
                            echo "Website: <a href=\"";
                            the_author_meta('user_url', $author->ID);
                            echo "/\" target='_blank'>";
                            the_author_meta('user_url', $author->ID);
                            echo "</a>";*/
                    echo "<br />";
                    echo "رقم الهاتف :  ";
                    the_author_meta('aim', $author->ID);
                    echo "<br />";
                    echo "<a href=\"".get_bloginfo('url')."/author/";
                    the_author_meta('user_nicename', $author->ID);
                    echo "/\">استعراض مراسلات&nbsp;";
                    the_author_meta('display_name', $author->ID);
                    echo "</a>";
                    echo "</div>";
                    echo "</li>";
                }
        }
    }


}
?>

<div id="main" role="main">


<style>
    #authorlist ul{
    list-style: none;
    margin: 0;
    padding: 0;
    text-align: left;
    width: 800px;
    }
    #authorlist li {
    margin: 0 0 5px 0;
    list-style: none;
    height: 90px;
    padding: 15px 0 15px 0;
    border-bottom: 1px solid #ececec;
    direction: rtl;
    width: 450px;
        float:left;
        margin-right: 20px;
    }

    #authorlist img.photo {
    width: 80px;
    height: 80px;
    float: left;
    margin: 0 0px 0 15px;
    padding: 3px;
    border: 1px solid #ececec;

    }

    #authorlist div.authname {
    margin: 20px 0 0 10px;
    }
</style>

<ul id="authorlist">
    <?php contributors() ?>
</ul>
</div><!-- End #main -->
