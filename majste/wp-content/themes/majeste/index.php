<form style="width: 250px" action="./" id="searchform" method="get" role="search">
    <div>
        <input type="text" id="s" name="s" value="">
        <input type="submit" value="" id="searchsubmit">
    </div>
</form>

<div id="main" role="main">
	<div id="ticket-manager" class="tabber">
		<?php get_template_part( 'templates/navigation', 'dashboard' ); ?>

		<div id="recent-tickets" class="panel">
			<?php get_template_part( 'templates/loop', 'ticket' ); ?>
		</div>
	</div><!-- End #ticket-manager -->
</div><!-- End #main -->
