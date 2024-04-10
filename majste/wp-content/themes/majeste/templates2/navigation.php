<?php do_action( 'qc_above_navigation' ); ?>

<div class="tabber-navigation top">

	<ul>
		<?php do_action( 'qc_navigation_before' ); ?>

		<?php if ( qc_can_view_all_tickets() ) : ?>
			<li <?php if ( is_home() && !get_query_var( 'assigned' ) ) : ?>class="current-tab"<?php endif; ?>>
				<a href="<?php echo home_url( '/' ); ?>"><?php _e( 'All Tickets', APP_TD ); ?></a>
			</li>
		<?php endif; ?>

		<?php if ( get_the_modified_author() ) : $current_user = wp_get_current_user(); ?>

			<li <?php if ( is_author( $current_user->ID ) || get_query_var( 'assigned' ) ) : ?>class="current-tab"<?php endif; ?>>
				<a href="#"><?php _e( 'My Tickets', APP_TD ); ?></a>

				<ul class="second-level children">
					<li><a href="<?php echo get_author_posts_url( $current_user->ID, $current_user->user_nicename ); ?>"><?php _e( 'Tickets Started', APP_TD ); ?></a></li>

					<?php if ( current_theme_supports( 'ticket-assignment' ) ) : ?>

						<li><a href="<?php echo home_url( '/?assigned=' . $current_user->user_login ); ?>"><?php _e( 'Assigned Tickets', APP_TD ); ?></a></li>

					<?php endif; ?>
				</ul>
			</li>

		<?php endif; ?>

		<?php do_action( 'qc_navigation_after' ); ?>

		<?php $page_id = qc_get_ticket_page_id(); if ( $page_id && !is_page( $page_id ) && qc_can_create_ticket() ) : ?>

			<li class="alignright">
				<a href="<?php echo get_permalink( $page_id ); ?>"><?php echo get_the_title( $page_id ); ?></a>
			</li>

		<?php endif; ?>

	</ul>

</div>
