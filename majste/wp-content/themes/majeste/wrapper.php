<!DOCTYPE html>
<html>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <link rel="profile" href="http://gmpg.org/xfn/11" />

    <title><?php wp_title(''); ?></title>

    <!--[if lte IE 9]><link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/styles/ie.css" type="text/css" media="screen" /><![endif]-->
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo get_template_directory_uri(); ?>/styles/1140.css" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/theme.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo get_template_directory_uri(); ?>/assets/css/alertify.css" rel="stylesheet">



    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/base.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/default.css" type="text/css" media="all" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/assets/css/flexslider.css" type="text/css" media="all" />
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/assets/<?php echo get_template_directory_uri(); ?>/assets/css/images/favicon.ico" />


    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/modernizr.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/colorbox.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/flexslider.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/livevalidation.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/twitter.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/easing.js" type="text/javascript"></script>
    <script src="<?php echo get_template_directory_uri(); ?>/assets/js/functions.js" type="text/javascript"></script>

    <!--
   <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet" type="text/css">

   HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
    <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script type="text/javascript">
        var templateUrl = '<?= get_bloginfo("template_url"); ?>';
        function home_url(value){
            return '<?= home_url("'+value+'"); ?>';
        }



    </script>
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php appthemes_before(); ?>

<section id="wrapper">

    <section class="shell">

        <?php appthemes_before_header(); ?>
        <?php get_header($base); ?>
        <?php appthemes_after_header(); ?>

            <section id="main">

                <?php $base = app_template_base(); ?>

                <section id="page-head">
                    <h1><?php wp_title( '&rarr;', true, 'left' ); ?></h1>
                    <?php qc_page_title(); ?>
                    <?php $heading_tag = ( is_home() || is_front_page() ) ? 'div' : 'div'; ?>
                </<?php echo $heading_tag; ?>>
                <h1><?php qc_page_title(); ?></h1>

                </section>

                <section id="content">

                    <?php include app_template_path(); ?>


                </section>
<!--
                <section id="sidebar" class="right">

                    <?php //get_sidebar($base); ?>

                </section>
            </section>
-->
        </section>

        <section id="footer-push"></section>

    <?php
    if ( is_user_logged_in() ){
    ?>
        <div style="margin: 25px 0px 25px 0px;" class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container-fluid">
                        <div class="logo">

                                <?php
                                echo get_avatar( is_user_logged_in() ? wp_get_current_user()->user_email : 0, 30 );
                                    if ( is_user_logged_in() )
                                        echo "<span style='color:white'> ".wp_get_current_user()->display_name." </span>";
                                    else
                                        _e( 'Visitor', APP_TD );
                                ?>

                        </div>

                        <a class="btn btn-navbar visible-phone" data-toggle="collapse" data-target=".nav-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>
                        <a class="btn btn-navbar slide_menu_left visible-tablet">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </a>

                        <div class="top-menu visible-desktop">

                            <ul class="pull-left">
                                <?php if ( qc_can_create_ticket() ) do_action( 'qc_get_new_ticket' ); ?>
                                <li><a id="profile" data-notification="0" href="<?= home_url('edit-profile/'); ?>"><i class="icon-user"></i> تعديل الملف الشخصي</a></li>
                            </ul>
                            <ul class="pull-right">
                                <li><a href="<?php echo wp_logout_url( get_bloginfo('url') ); ?>"><i class="icon-off"></i> تسجيل خروج</a></li>
                            </ul>
                        </div>

                        <div class="top-menu visible-phone visible-tablet">
                            <ul class="pull-right">
                                <li><a title="link to View all Notifications page, no popover in phone view or tablet" href="#"><i class="icon-globe"></i></a></li>
                                <li><a href="<?= home_url('wp-login.php?action=logout"'); ?>"><i class="icon-off"></i></a></li>
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        <?
}
    ?>


</section>
<?php appthemes_before_footer(); ?>
<?php get_footer($base); ?>
<?php appthemes_after_footer(); ?>

<?php appthemes_after(); ?>

<?php wp_footer();?>
</body>
</html>