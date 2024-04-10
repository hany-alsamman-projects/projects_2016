<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content.  See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package Quality_Control
 * @since Quality Control 0.1
 */

global $qc_options;

appthemes_before_loop();

 if ( is_user_logged_in() ) {

if ( have_posts() ) : $i = 0; ?>

	<ol class="ticket-list">

    <?
    if( current_user_can( 'super_visor' ) ){ // only if super_visor
    while ( have_posts() ) : the_post(); $i++;

    $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

    $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';


    //get super_visor group id
    $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".get_current_user_id( )."' and group_id != '1' LIMIT 1");

    $check_ass = get_post_meta(  $post->ID, '_assigned_to' );


    //check if this sales in visor group
    if ( Groups_User_Group::read( $post->post_author , $visor_gid ) || Groups_User_Group::read( $check_ass[0] , $visor_gid ) ) {


    ?>

		<li style="direction: rtl; text-align: left" id="ticket-<?php the_ID(); ?>" <?php post_class( 'ticket ' . ( $i % 2 ? '' : 'alt ' ) . qc_taxonomy( 'ticket_status', 'slug' ) ); ?>>

            <?php appthemes_before_post(); ?>
            <?php
            if(qc_status_slug() != 'close' && qc_status_slug() != 'finish' ){
                if (current_user_can('level3' || 'manage_options') || is_admin() ){
                    $now = time();
                    $event_time = strtotime(date("F j, Y, g:i a",get_the_date("G")));
                    if( ($now - $event_time) >= (60 * 60 * 48))
                    {
                        // 5 minutes before
                        echo '<div style="color: #C68E24; font-size: 10px" >هذه المراسلة مضى عليها اكثر من 48 ساعة</div>';
                    }
                }
            }
            ?>
            <?php  ?>
			<p class="ticket-author" style="float: left">
                <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                <?
                if(qc_status_slug() == 'finish' && current_user_can('edit_published_posts')){
                    $paid = get_post_meta( get_the_ID(), '_paid' );

                    echo ' <span>المسدد</span>  ';
                    echo '<strong style="font-size:12pt">'.$paid[0].'</strong>';

                    $remain = get_post_meta( get_the_ID(), '_remain' );

                    echo ' <span>المتبقي</span>  ';
                    echo '<strong style="font-size:12pt">'.$remain[0].'</strong>';
                }
                ?>
			</p>

            <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
            <?php qc_status_label(); ?> &nbsp;&nbsp;
			<h2 class="ticket-title">

				<?php appthemes_before_post_title(); ?>
				<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				<?php appthemes_after_post_title(); ?>
			</h2>
            </div>

			<ul class="ticket-meta" style="text-align: right">
				<?php get_template_part( 'templates/ticket-meta' ); ?>
			</ul>

                        <?php appthemes_after_post(); ?>

		</li>


	<?php

           }//check if this post for user in visor group

    endwhile;
    }//check if is visor


    if(current_user_can( 'administrator' )){
    while ( have_posts() ) : the_post(); $i++;

        $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

        $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';

        ?>

        <li style="direction: rtl; text-align: left" id="ticket-<?php the_ID(); ?>" <?php post_class( 'ticket ' . ( $i % 2 ? '' : 'alt ' ) . qc_taxonomy( 'ticket_status', 'slug' ) ); ?>>

            <?php appthemes_before_post(); ?>
            <?php
            if(qc_status_slug() != 'close' && qc_status_slug() != 'finish' ){
                if (current_user_can('level3' || 'manage_options') || is_admin() ){
                    $now = time();
                    $event_time = strtotime(date("F j, Y, g:i a",get_the_date("G")));
                    if( ($now - $event_time) >= (60 * 60 * 48))
                    {
                        // 5 minutes before
                        echo '<div style="color: #C68E24; font-size: 10px" >هذه المراسلة مضى عليها اكثر من 48 ساعة</div>';
                    }
                }
            }
            ?>
            <?php  ?>
            <p class="ticket-author" style="float: left">
                <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                <?
                if(qc_status_slug() == 'finish' && current_user_can('edit_published_posts')){
                    $paid = get_post_meta( get_the_ID(), '_paid' );

                    echo ' <span>المدفوع</span>  ';
                    echo '<strong style="font-size:12pt">'.$paid[0].'</strong>';

                    $remain = get_post_meta( get_the_ID(), '_remain' );

                    echo ' <span>المتبقي</span>  ';
                    echo '<strong style="font-size:12pt">'.$remain[0].'</strong>';
                }
                ?>
            </p>

            <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
                <?php qc_status_label(); ?> &nbsp;&nbsp;
                <h2 class="ticket-title">

                    <?php appthemes_before_post_title(); ?>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    <?php appthemes_after_post_title(); ?>
                </h2>
            </div>

            <ul class="ticket-meta" style="text-align: right">
                <?php get_template_part( 'templates/ticket-meta' ); ?>
            </ul>

            <?php appthemes_after_post(); ?>

        </li>


        <?php
    endwhile;
    }

    if(current_user_can( 'author' )){


        while ( have_posts() ) : the_post(); $i++;

        $check_ass = get_post_meta(  $post->ID, '_assigned_to' );

        $assigned_to = ( $check_ass[0] == get_current_user_id())? true : false;

        if($assigned_to){

            $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

            $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';

            ?>

        <li style="direction: rtl; text-align: left" id="ticket-<?php the_ID(); ?>" <?php post_class( 'ticket ' . ( $i % 2 ? '' : 'alt ' ) . qc_taxonomy( 'ticket_status', 'slug' ) ); ?>>

            <?php appthemes_before_post(); ?>
            <?php
            if(qc_status_slug() != 'close' && qc_status_slug() != 'finish' ){
                if (current_user_can('level3' || 'manage_options') || is_admin() ){
                    $now = time();
                    $event_time = strtotime(date("F j, Y, g:i a",get_the_date("G")));
                    if( ($now - $event_time) >= (60 * 60 * 48))
                    {
                        // 5 minutes before
                        echo '<div style="color: #C68E24; font-size: 10px" >هذه المراسلة مضى عليها اكثر من 48 ساعة</div>';
                    }
                }
            }
            ?>
            <?php  ?>
            <p class="ticket-author" style="float: left">
                <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                <?
                if(qc_status_slug() == 'finish' && current_user_can('edit_published_posts')){
                    $paid = get_post_meta( get_the_ID(), '_paid' );

                    echo ' <span>المدفوع</span>  ';
                    echo '<strong style="font-size:12pt">'.$paid[0].'</strong>';

                    $remain = get_post_meta( get_the_ID(), '_remain' );

                    echo ' <span>المتبقي</span>  ';
                    echo '<strong style="font-size:12pt">'.$remain[0].'</strong>';
                }
                ?>
            </p>

            <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
                <?php qc_status_label(); ?> &nbsp;&nbsp;
                <h2 class="ticket-title">

                    <?php appthemes_before_post_title(); ?>
                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                    <?php appthemes_after_post_title(); ?>
                </h2>
            </div>

            <ul class="ticket-meta" style="text-align: right">
                <?php get_template_part( 'templates/ticket-meta' ); ?>
            </ul>

            <?php appthemes_after_post(); ?>

        </li>


            <?php
        }

        endwhile;

    }
    ?>



    <?php appthemes_after_endwhile(); ?>

	</ol>

	<?php if ( qc_show_pagination() ) : ?>

		<div class="tabber-navigation bottom"><?php
			appthemes_pagenavi();
		?></div><!-- #nav-above -->

	<?php endif; ?>

<?php else : ?>

<ol class="ticket-list" style="list-style: none">
    <li class="ticket no-results" style="text-align: right; color: #c68e24">
			<?php _e( 'لا توجد مراسلات للعرض', APP_TD ); ?>
		</li>
	</ol>

<?php endif; ?>

<?php }else { ?>

     <ol class="ticket-list" style="list-style: none">
		<li class="ticket no-results" style="text-align: right; color: #c68e24">
			<?php _e( 'نحيطك علما انه يجب عليك الاشتراك لتتمكن من انشاء مراسلة', APP_TD ); ?>
		</li>
	</ol>

<?}?>

<?php appthemes_after_loop(); ?>

