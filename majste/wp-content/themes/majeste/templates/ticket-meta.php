<?php do_action( 'qc_ticket_fields_before' ); ?>

<li>
	<small><?php _e( 'مراسلة', APP_TD ); ?></small>
	<a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', APP_TD ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">#<?php the_ID(); ?></a>
</li>

<?php do_action( 'qc_ticket_fields_between' ); ?>

<?php if ( current_theme_supports( 'ticket-assignment' ) ) : ?>

	<?php // TODO: move this block into a callback ?>

	<li>
		<small><?php _e( 'المسوق المسؤول', APP_TD ); ?></small>
		<?php if ( qc_assigned_to() ) : ?>
			<?php echo qc_assigned_to_linked(); ?>
		<?php else : ?>
			&mdash;
		<?php endif; ?>
	</li>

	<li>
		<small><?php _e( 'اخر تعديل', APP_TD ); ?></small>
		<?php echo get_the_modified_time( 'g:i a' ); ?>
	</li>

	<li>
		<small><?php _e( 'لقد عدلها', APP_TD ); ?></small>
		<?php if ( get_the_modified_author() ) : ?>
			<?php echo get_the_modified_author(); ?>
		<?php else : ?>
			&mdash;
		<?php endif; ?>
	</li>

<?php endif; ?>

<?php do_action( 'qc_ticket_fields_after' ); ?>

