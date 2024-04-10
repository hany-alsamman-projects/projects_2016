<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<title><?php wp_title(''); ?></title>

	<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/ie.css" type="text/css" media="screen" /><![endif]-->
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/styles/1140.css" />
	<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php appthemes_before(); ?>

	<?php $base = app_template_base(); ?>

	<?php appthemes_before_header(); ?>
	<?php get_header( $base ); ?>
	<?php appthemes_after_header(); ?>

	<div id="content" class="container">
		<div class="row">
			<div class="ninecol">
				<?php include app_template_path(); ?>
			</div><!--.col-->

			<div class="threecol last">
				<?php get_sidebar( $base ); ?>
			</div><!--.col-->
		</div><!--.row-->
		<div class="push"></div>
	</div><!-- .container -->

	<?php appthemes_before_footer(); ?>
	<?php get_footer( $base ); ?>
	<?php appthemes_after_footer(); ?>

	<?php appthemes_after(); ?>

	<?php wp_footer();?>
</body>
</html>
