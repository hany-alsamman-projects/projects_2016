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
 * @since Codex Corp 0.1
 */

global $qc_options;

appthemes_before_loop();

if ( have_posts() ) : $i = 0; ?>

<div class="row-fluid">
    <div class="widget-top widget span12">
        <div class="widget-header">
            <i style="float: right" class="icon-tasks"></i>
            <h5 style="float: right">المراسلات</h5>
            <div class="widget-buttons">
                <a href="#" data-title="Collapse" data-collapsed="false" class="collapse"><i class="icon-chevron-up"></i></a>
            </div>
        </div>
        <div class="widget-body clearfix" style="height: 350px;">
            <div class="widget-tasks-assigned">
                <ul>

    <?php while ( have_posts() ) : the_post(); $i++; ?>


    <div id="modal-<?php the_ID(); ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">معلومات سريعة</h3>
        </div>
        <div class="modal-body">
            <ul class="ticket-meta">
            <?php do_action( 'qc_ticket_fields_before' ); ?>

            <li>
                <small><?php _e( 'Ticket', APP_TD ); ?></small>
                <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">#<?php the_ID(); ?></a>
            </li>

            <?php do_action( 'qc_ticket_fields_between' ); ?>

            <?php if ( current_theme_supports( 'ticket-assignment' ) ) : ?>

            <?php // TODO: move this block into a callback ?>

            <li>
                <small><?php _e( 'Assigned to', APP_TD ); ?></small>
                <?php if ( qc_assigned_to() ) : ?>
                <?php echo qc_assigned_to_linked(); ?>
                <?php else : ?>
                &mdash;
                <?php endif; ?>
            </li>

            <li>
                <small><?php _e( 'Last Updated', APP_TD ); ?></small>
                <?php echo get_the_modified_time( 'g:i a' ); ?>
            </li>

            <li>
                <small><?php _e( 'Modified by', APP_TD ); ?></small>
                <?php if ( get_the_modified_author() ) : ?>
                <?php echo get_the_modified_author(); ?>
                <?php else : ?>
                &mdash;
                <?php endif; ?>
            </li>

            <?php endif; ?>

            <?php do_action( 'qc_ticket_fields_after' ); ?>

            </ul>
        </div>

        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">اغلاق</button>
        </div>
    </div>

    <li class="priority-<?=qc_taxonomy('ticket_priority', 'slug' ) ?>-left" id="ticket-<?php the_ID(); ?>" >
        <?php appthemes_before_post(); ?>
        <a href="#" data-toggle="modal" data-target="#modal-<?php the_ID(); ?>">
            <div class="content" style="text-align: right; float: right">
                <h5><?=get_the_author()?></h5>
                <?php appthemes_before_post_title(); ?>
                <span><?php the_title(); ?></span>
                <?php appthemes_after_post_title(); ?>
            </div>
            <ul class="rightboxes">

                <li><?=qc_taxonomy( 'ticket_status', 'slug' )?><span>الحالة</span></li>
                <li><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">اضغط للمشاهدة</a></li>
            </ul>
            <div class="info">
                <div class="date"><?= get_the_date() ?></div>
            </div>
        </a>
        <div class="progress">
            <div style="width: 100%;" class="bar"></div>
        </div>
        <?php appthemes_after_post(); ?>
    </li>

    <?php endwhile; ?>

                </ul>
            </div>
        </div>
    </div>
</div>

<?php appthemes_after_endwhile(); ?>


<?php if ( qc_show_pagination() ) : ?>

    <div class="tabber-navigation bottom"><?php
        appthemes_pagenavi();
        ?></div><!-- #nav-above -->

    <?php endif; ?>

<?php else : ?>

<ol class="ticket-list">
    <li class="ticket no-results">
        <?php _e( 'No tickets found.', APP_TD ); ?>
    </li>
</ol>

<?php endif; ?>

<?php appthemes_after_loop(); ?>







