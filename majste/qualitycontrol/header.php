<div id="branding_container" class="container">
	<div class="row">
		<div class="ninecol">
			<div id="branding" role="banner">
				<a class="brand_bug">&nbsp;</a>
				<?php qc_page_title(); ?>
				<?php $heading_tag = ( is_home() || is_front_page() ) ? 'h1' : 'div'; ?>
				<<?php echo $heading_tag; ?> id="site-title">
					<a href="<?php echo home_url( '/' ); ?>"><?php bloginfo( 'name' ); ?></a> <?php wp_title( '&rarr;', true, 'left' ); ?>
				</<?php echo $heading_tag; ?>>
				<div class="tagline"><?php bloginfo( 'description' ); ?></div>
			</div><!-- #branding -->
		</div>

		<div id="current-user-box" class="threecol last">
			<?php echo get_avatar( is_user_logged_in() ? wp_get_current_user()->user_email : 0, 30 ); ?>

			<div id="current-user-name">
			<?php
			if ( is_user_logged_in() )
				echo wp_get_current_user()->display_name;
			else
				_e( 'Visitor', APP_TD );
			?>
			</div>

			<div id="current-user-links">
			<?php
			if ( is_user_logged_in() ) {
				echo html_link( appthemes_get_edit_profile_url(), __( 'Edit profile', APP_TD ) );
				echo ' | ';
			}
			wp_loginout( get_bloginfo('url') );
			?>
			</div>
		</div>
	</div>
</div>
