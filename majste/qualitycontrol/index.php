<div id="main" role="main">
	<div id="ticket-manager" class="tabber">
		<?php get_template_part( 'templates/navigation', 'dashboard' ); ?>

		<div id="recent-tickets" class="panel">
			<?php get_template_part( 'templates/loop', 'ticket' ); ?>
		</div>
	</div><!-- End #ticket-manager -->
</div><!-- End #main -->
