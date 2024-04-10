<?php
/**
 * The Sidebar containing the primary and secondary widget areas.
 *
 * @package Quality_Control
 * @since Quality Control 0.1
 */

global $qc_options;
?>

			<div id="sidebar" class="widget-area" role="complementary">

				<ul class="submenu">

				<?php if ( ! dynamic_sidebar( 'primary-widget-area' ) ) : ?>

					<?php
						the_widget(
							'WP_Widget_Search',
							array(),
							array(
								'before_widget' => '<li class="widget-container">',
								'after_widget' => '</li>',
								'before_title' => '<h3>',
								'after_title' => '</h3>'
							)
						);

						the_widget(
							'QC_Taxonomy_Widget',
							array(
								'show_rss' => 'on',
								'show_count' => 'on',
								'title' => __( 'States', APP_TD ),
								'taxonomy' => 'ticket_status'
							),
							array(
								'before_widget' => '<li class="widget-container">',
								'after_widget' => '</li>',
								'before_title' => '<h3>',
								'after_title' => '</h3>'
							)
						);

						if ( current_theme_supports( 'ticket-milestones' ) ) :

							the_widget(
								'QC_Taxonomy_Widget',
								array(
									'show_rss' => 'on',
									'title' => __( 'Milestones', APP_TD ),
									'taxonomy' => 'ticket_milestone'
								),
								array(
									'before_widget' => '<li class="widget-container">',
									'after_widget' => '</li>',
									'before_title' => '<h3>',
									'after_title' => '</h3>'
								)
							);

						endif;

						if ( current_theme_supports( 'ticket-categories' ) ) :

							the_widget(
								'QC_Taxonomy_Widget',
								array(
									'show_rss' => 'on',
									'title' => __( 'Categories', APP_TD ),
									'taxonomy' => 'category'
								),
								array(
									'before_widget' => '<li class="widget-container">',
									'after_widget' => '</li>',
									'before_title' => '<h3>',
									'after_title' => '</h3>'
								)
							);

						endif;
					?>

				<?php endif; ?>

				</ul>

			</div><!-- End #sidebar -->
