<!-- Contact Form CSS files -->
<link type='text/css' href='<?php echo get_template_directory_uri(); ?>/scripts/contact/css/contact.css' rel='stylesheet' media='screen' />
<script type='text/javascript' src='<?php echo get_template_directory_uri(); ?>/scripts/contact/js/contact.js'></script>

<?php
$mypost = get_post( get_the_ID() );

$post_assigned_to = get_post_meta(get_the_ID(), '_assigned_to');

$send_to = get_userdata($post_assigned_to[0]);

$sender = get_userdata(get_current_user_id());
?>
<?php
if( current_user_can( 'super_visor' ) || current_user_can( 'administrator' )  ){ // only if super_visor
?>
<div id='content'>
    <div id='contact-form'> <input type="submit" value="ملاحظة" name="submit" class="button contact" style="text-align: center"></div>
    <!-- preload the images -->
    <div style='display:none'>
        <input type="hidden" id="eticket_id" value="ID#<?=$mypost->ID?> ملاحظة على المراسلة ">
        <input type="hidden" id="eticket_send_to" value="<?=$send_to->user_email?>">
        <input type="hidden" id="eticket_sender_name" value="<?=$sender->user_login?>">
        <img src='<?php echo get_template_directory_uri(); ?>/scripts/contact/img/contact/loading.gif' alt='' />
    </div>
</div>

<?php
} // only if super_visor >
?>
<div id="main" role="main">

	<?php appthemes_before_loop(); ?>

	<?php if ( have_posts() ): ?>
		<?php
        if( current_user_can( 'super_visor' ) && !current_user_can( 'administrator' ) ){ // only if super_visor
        while ( have_posts() ) : the_post();

        //get super_visor group id
        $visor_gid = $wpdb->get_var("SELECT group_id from wp_groups_user_group WHERE `user_id` = '".get_current_user_id( )."' and group_id != '1' LIMIT 1");

        $check_ass = get_post_meta(  $post->ID, '_assigned_to' );


            //check if this sales in visor group
        if ( Groups_User_Group::read( $post->post_author , $visor_gid ) || Groups_User_Group::read( $check_ass[0] , $visor_gid ) ) {


                $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

            $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';

        ?>

			<div id="ticket-manager-<?php the_ID(); ?>" <?php post_class( 'tabber' ); ?>>

				<?php appthemes_before_post(); ?>

				<?php get_template_part( 'templates/navigation', 'single' ); ?>

				<div class="panel">
					<ol class="ticket-list">
						<li id="single-ticket" class="ticket" style="direction: rtl; text-align: left">

                            <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
                                <?php qc_status_label(); ?> &nbsp;&nbsp;
                                <h1 class="ticket-title">
                                    <?php appthemes_before_post_title(); ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    <?php appthemes_after_post_title(); ?>
                                </h1>
                            </div>


                            <p class="ticket-author" style="text-align: left; float: left">
                                <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                                <?php if ( current_user_can( 'delete_post', $post->ID ) ) : ?>
                                &mdash;
                                <a href="<?php echo get_delete_post_link( $post->ID ); ?>"><?php _e( 'حذف هذه المراسلة بالكامل', APP_TD ); ?></a>
                                <?php endif; ?>
                            </p>

							<ul class="ticket-meta single" style="text-align: right">
								<?php get_template_part( 'templates/ticket-meta', 'single' ); ?>
							</ul>

							<div class="entry single-ticket">
								<?php appthemes_before_post_content(); ?>
									<?php the_content(); ?>
								<?php appthemes_after_post_content(); ?>

								<?php wp_link_pages(); ?>
							</div>

							<ol class="update-list">
<?php
							$attachments = get_posts( array(
								'post_type' => 'attachment',
								'numberposts' => -1,
								'post_status' => null,
								'post_parent' => $post->ID
							) );

							if ( $attachments ) :
?>
								<li><strong class="title"><?php _e( 'المرفقات:', APP_TD ); ?></strong>
									<ul>
									<?php foreach ( $attachments as $post ) : setup_postdata( $post ); ?>
										<li id="attachment-<?php echo $post->ID; ?>"><?php echo qc_get_attachment_link( $post->ID ); ?> <?php printf( __( 'by %1$s on %2$s', APP_TD ), get_the_author(), get_the_date() ); ?></li>
									<?php endforeach; ?>
									</ul>
								</li>

								<?php endif; wp_reset_query(); ?>
							</ol>
						</li>

						<?php comments_template(); ?>

					</ol>
				</div><!-- .panel -->

				<?php appthemes_after_post(); ?>

			</div><!-- #post -->

		<?php
            }//check if this post for user in visor group

            endwhile;
        }//check if is visor
        ?>

        <?php
/**
        if(current_user_can( 'administrator' ) ){
            $i = 0;
            while ( have_posts() ) : the_post();

                    $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

                    $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';

                    ?>

                <div id="ticket-manager-<?php the_ID(); ?>" <?php post_class( 'tabber' ); ?>>

                    <?php appthemes_before_post(); ?>

                    <?php get_template_part( 'templates/navigation', 'single' ); ?>

                    <div class="panel">
                        <ol class="ticket-list">
                            <li id="single-ticket" class="ticket" style="direction: rtl; text-align: left">

                                <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
                                    <?php qc_status_label(); ?> &nbsp;&nbsp;
                                    <h1 class="ticket-title">
                                        <?php appthemes_before_post_title(); ?>
                                        <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                        <?php appthemes_after_post_title(); ?>
                                    </h1>
                                </div>


                                <p class="ticket-author" style="text-align: left; float: left">
                                    <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                                    <?php if ( current_user_can( 'delete_post', $post->ID ) ) : ?>
                                    &mdash;
                                    <a href="<?php echo get_delete_post_link( $post->ID ); ?>"><?php _e( 'حذف هذه المراسلة بالكامل', APP_TD ); ?></a>
                                    <?php endif; ?>
                                </p>

                                <ul class="ticket-meta single" style="text-align: right">
                                    <?php get_template_part( 'templates/ticket-meta', 'single' ); ?>
                                </ul>

                                <div class="entry single-ticket" >
                                    <?php appthemes_before_post_content(); ?>
                                    <?php the_content(); ?>
                                    <?php appthemes_after_post_content(); ?>

                                    <?php wp_link_pages(); ?>
                                </div>

                                <ol class="update-list">
                                    <?php
                                    $attachments = get_posts( array(
                                        'post_type' => 'attachment',
                                        'numberposts' => -1,
                                        'post_status' => null,
                                        'post_parent' => $post->ID
                                    ) );

                                    if ( $attachments ) :
                                        ?>
                                        <li><strong class="title"><?php _e( 'المرفقات:', APP_TD ); ?></strong>
                                            <ul>
                                                <?php foreach ( $attachments as $post ) : setup_postdata( $post ); ?>
                                                <li id="attachment-<?php echo $post->ID; ?>"><?php echo qc_get_attachment_link( $post->ID ); ?> <?php printf( __( 'by %1$s on %2$s', APP_TD ), get_the_author(), get_the_date() ); ?></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </li>

                                        <?php endif; wp_reset_query(); ?>
                                </ol>
                            </li>

                            <?php comments_template(); ?>

                        </ol>
                    </div><!-- .panel -->

                    <?php appthemes_after_post(); ?>

                </div><!-- #post -->

                    <?php
            endwhile;
        }//check if not visor
**/
        ?>


        <?php
        if(current_user_can( 'author' ) || current_user_can( 'contributor' )){
            $i = 0;
            while ( have_posts() ) : the_post();

                $full_name = ( get_the_author_meta( 'last_name', $post->post_author ) != false)? get_the_author_meta( 'last_name', $post->post_author ) : 'لا يوجد اسم';

                $mobile = ( get_the_author_meta( 'aim', $post->post_author ) != false)? get_the_author_meta( 'aim', $post->post_author ) : 'لايوجد';

                $check_ass = get_post_meta(  $post->ID, '_assigned_to' );

                $assigned_to = ( $check_ass[0] == get_current_user_id())? true : false;

                if($assigned_to || $post->post_author == get_current_user_id()){


                ?>

            <div id="ticket-manager-<?php the_ID(); ?>" <?php post_class( 'tabber' ); ?>>

                <?php appthemes_before_post(); ?>

                <?php get_template_part( 'templates/navigation', 'single' ); ?>

                <div class="panel">
                    <ol class="ticket-list">
                        <li id="single-ticket" class="ticket" style="direction: rtl; text-align: left">

                            <div style="width:50%; margin-bottom: 10px; text-align: right; float: right">
                                <?php qc_status_label(); ?> &nbsp;&nbsp;
                                <h1 class="ticket-title">
                                    <?php appthemes_before_post_title(); ?>
                                    <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
                                    <?php appthemes_after_post_title(); ?>
                                </h1>
                            </div>


                            <p class="ticket-author" style="text-align: left; float: left">
                                <?php printf( __( 'من قبل <strong>%1$s</strong> رقم موبايل <strong>%2$s</strong>  بتاريخ <em>%3$s</em>', APP_TD ), $full_name, $mobile,  get_the_date() ); ?>

                                <?php if ( current_user_can( 'delete_post', $post->ID ) ) : ?>
                                &mdash;
                                <a href="<?php echo get_delete_post_link( $post->ID ); ?>"><?php _e( 'حذف هذه المراسلة بالكامل', APP_TD ); ?></a>
                                <?php endif; ?>
                            </p>

                            <ul class="ticket-meta single" style="text-align: right">
                                <?php get_template_part( 'templates/ticket-meta', 'single' ); ?>
                            </ul>

                            <div class="entry single-ticket" >
                                <?php appthemes_before_post_content(); ?>
                                <?php the_content(); ?>
                                <?php appthemes_after_post_content(); ?>

                                <?php wp_link_pages(); ?>
                            </div>

                            <ol class="update-list">
                                <?php
                                $attachments = get_posts( array(
                                    'post_type' => 'attachment',
                                    'numberposts' => -1,
                                    'post_status' => null,
                                    'post_parent' => $post->ID
                                ) );

                                if ( $attachments ) :
                                    ?>
                                    <li><strong class="title"><?php _e( 'المرفقات:', APP_TD ); ?></strong>
                                        <ul>
                                            <?php foreach ( $attachments as $post ) : setup_postdata( $post ); ?>
                                            <li id="attachment-<?php echo $post->ID; ?>"><?php echo qc_get_attachment_link( $post->ID ); ?> <?php printf( __( 'by %1$s on %2$s', APP_TD ), get_the_author(), get_the_date() ); ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>

                                    <?php endif; wp_reset_query(); ?>
                            </ol>
                        </li>

                        <?php comments_template(); ?>

                    </ol>
                </div><!-- .panel -->

                <?php appthemes_after_post(); ?>

            </div><!-- #post -->

                    <?php
                }
            endwhile;

        }//check if not visor
        ?>

		<?php appthemes_after_endwhile(); ?>

	<?php else: ?>

		<?php appthemes_loop_else(); ?>

	<?php endif; ?>

   <?php appthemes_after_loop(); ?>

</div><!-- End #main -->
