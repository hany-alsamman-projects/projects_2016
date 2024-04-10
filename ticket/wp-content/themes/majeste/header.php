<header>
    <h1 id="logo"><a href="./" class="notext">مشروعات الأعمال</a></h1>

    <div style="width: 90%; font-size: 10pt; direction: rtl; position: absolute; text-align: right; bottom: 70px; right: 0">

        <?
            $geturl = explode("/", $_SERVER['REQUEST_URI']);
            $mydir = trim($geturl[2]);
        ?>
        <?php if(isset($mydir) && $mydir == 'ticket'){

        //$page = get_page_by_title(trim($_GET['ticket']),false, 'ticket' );

        //get ticket meta
        $meta = get_post_meta( get_the_ID() );
        //get tick who _assigned_to
        //print $meta['_assigned_to'][0];

        $user_info = get_userdata($meta['_assigned_to'][0]);

        $user_phone = get_usermeta($meta['_assigned_to'][0],'aim');

        $WhatsUp = get_usermeta($meta['_assigned_to'][0],'jabber');



        ?>

        <h5 style="direction: rtl">أهلا بك في مشروعات الأعمال أنت الآن مع:</h5>

        <span style="color:#C68E24">المسوق: </span>&nbsp;&nbsp;&nbsp;<span style="color:#FFFFFF"><?= $user_info->data->display_name; ?></span>&nbsp;&nbsp;&nbsp;

        <span style="color:#C68E24">رقم هاتف: </span>&nbsp;&nbsp;&nbsp;<span style="color:#FFFFFF"><?= $user_phone; ?></span>&nbsp;&nbsp;&nbsp;

        <span style="color:#C68E24">واتس اب: </span>&nbsp;&nbsp;&nbsp;<span style="color:#FFFFFF"><?= $WhatsUp; ?></span>&nbsp;&nbsp;&nbsp;

        <span style="color:#C68E24">البريد اللكتروني: </span>&nbsp;&nbsp;&nbsp;<span style="color:#FFFFFF"><?= $user_info->data->user_email; ?></span>


        <?
        }
        ?>


    </div>


    <div style="position: absolute; right: 0; top: 70px"></div>

    <?php do_action( 'qc_above_navigation' ); ?>
    <nav>
        <ul class="main-nav">
            <?php do_action( 'qc_navigation_before' ); ?>

            <?php if ( qc_can_view_all_tickets() ) : ?>
            <li <?php if ( is_home() && !get_query_var( 'assigned' ) ) : ?>class="current-tab"<?php endif; ?>>
                <a href="<?php echo home_url( '/' ); ?>"><?php _e( 'الرئيسية', APP_TD ); ?></a>
            </li>
            <?php endif; ?>

            <?php if ( !is_user_logged_in() ) : ?>
            <li>
                <a href="wp-login.php" class="simplemodal-login">تسجيل دخول</a>
            </li>
            <li>
                <a href="wp-login.php?action=register" class="simplemodal-register">تسجيل</a>
            </li>
            <?php endif; ?>

            <?php if ( is_user_logged_in() ) : $current_user = wp_get_current_user(); ?>

            <li <?php if ( is_author( $current_user->ID ) || get_query_var( 'assigned' ) ) : ?>class="current-tab"<?php endif; ?>>


                <ul class="second-level children">
                    <li><a href="<?php echo get_author_posts_url( $current_user->ID, $current_user->user_nicename ); ?>"><?php _e( 'مراسلات مفتوحة', APP_TD ); ?></a></li>

                    <?php if ( current_theme_supports( 'ticket-assignment' ) ) : ?>

                    <li><a href="<?php echo home_url( '/?assigned=' . $current_user->user_login ); ?>"><?php _e( 'مراسلاتي الخاصة', APP_TD ); ?></a></li>

                    <?php endif; ?>
                </ul>
            </li>

            <? if ( current_user_can('manage_options') || current_user_can( 'super_visor' ) ) :?>
            <li>
                <a id="target" href="<?php echo home_url('تقرير-عمل'); ?>"">التقرير</a>
            </li>
            <li>
                <a href="<?php echo home_url('قائمة-المسوقين'); ?>""><?php _e( 'قائمة المسوقين', APP_TD ); ?></a>
            </li>
            <?php endif ?>

            <? //if ( current_user_can('manage_options') ) :?>

            <li><a href="<?php echo home_url('مراسلاتي'); ?>"><?php _e( 'مراسلاتي', APP_TD ); ?></a></li>

            <?php endif ?>

            <?php do_action( 'qc_navigation_after' ); ?>

            <?php// endif; ?>



            <?php $page_id = qc_get_ticket_page_id(); if ( $page_id && !is_page( $page_id ) && qc_can_create_ticket() ) : ?>

            <li class="alignright">
                <a href="<?php echo get_permalink( $page_id ); ?>"><?php echo get_the_title( $page_id ); ?></a>
            </li>

            <?php endif; ?>


        </ul>


        <ul class="socials">
            <li class="facebook"><a href="http://www.facebook.com/bpsaudi">Facebook</a></li>
            <li class="twitter"><a href="https://twitter.com/bpsaudi">Twitter</a></li>
        </ul>
    </nav>
</header>

<?php if ( !is_user_logged_in() ){ ?>

<?php }
?>
