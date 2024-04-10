<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo $this->settings->site_name; ?> - <?php echo lang('login_title');?></title>
	
	<base href="<?php echo base_url(); ?>" />
	<meta name="robots" content="noindex, nofollow" />


	<!-- metadata needs to load before some stuff -->
<?php
Asset::js('jquery/jquery.js');
Asset::js_inline('jQuery.noConflict();');
?>


<!-- JAVASCRIPTs -->
<!--[if lt IE 9]>
    <script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<?php
Asset::js(array(
	'admin/jquery-ui-1.8.18.custom.min.js',
	'admin/jquery.tipsy.js',
	'admin/jquery.formalize.min.js',
	'admin/jquery.modal.js',
	'admin/prefixfree.min.js',
	'admin/datables/js/jquery.dataTables.min.js',
    'admin/jquery.prettyPhoto.js',
	'admin/jquery.autogrowtextarea.js',
	'admin/jquery.easing.1.3.js',
	'admin/jquery.fileinput.js',
	'admin/chosen.jquery.min.js',
	'admin/ui.checkBox.js',
    'admin/ui.spinner.min.js',
	'admin/jquery.loading.js',
	'admin/jquery.path.js',
	
    'admin/jqPlot/jquery.jqplot.min.js',
	'admin/jqPlot/plugins/jqplot.pieRenderer.min.js',
	'admin/jqPlot/plugins/jqplot.cursor.min.js',
    
	'admin/jqPlot/plugins/jqplot.highlighter.min.js',
	'admin/jqPlot/plugins/jqplot.dragable.min.js',
    'admin/jqPlot/plugins/jqplot.dateAxisRenderer.min.js',
    'admin/jqPlot/plugins/jqplot.ohlcRenderer.min.js',
    'admin/jqPlot/plugins/jqplot.trendline.min.js',
    'admin/jqPlot/plugins/jqplot.barRenderer.min.js',
    'admin/jqPlot/plugins/jqplot.categoryAxisRenderer.min.js',
    'admin/jqPlot/plugins/jqplot.pointLabels.min.js',
    
	'admin/fullcalendar.min.js',
	'admin/jquery.miniColors.min.js',
	'admin/jquery.maskedinput-1.3.min.js',
	'admin/jquery-ui-timepicker-addon.js',
    'admin/elrte.min.js',
	'admin/elfinder.min.js',
	'admin/jquery.validate.min.js',
    'admin/jquery.metadata.js',
    'admin/main.js',
    'admin/demo.js',
)); ?>





<!-- CSSs -->
<?php Asset::css(array( 'modules/reset.css', 'modules/960.css', 'modules/icons.css'
                        ,'modules/tipsy.css', 'modules/formalize.css', 'modules/prettyPhoto.css'
                        ,'modules/jquery-ui-1.8.18.custom.css', 'modules/chosen.css', 'modules/ui.spinner.css'
                        ,'modules/jquery.jqplot.min.css', 'modules/fullcalendar.css', 'modules/jquery.miniColors.css'
                        ,'modules/elrte.min.css', 'modules/elfinder.css', 'modules/main.css')); ?>
     

<?php echo Asset::render(); ?>


<style type="text/css">
<!--
.main-box {
  width: 280px;
  background: #EDEDED;

  margin-bottom: 70px;
  overflow: hidden;
  border-radius: 10px;
  box-shadow: 4px 4px 2px rgba(0, 0, 0, 0.2), inset 2px -2px 0 #ffffff, inset -2px 2px 0 #ffffff;
  text-shadow: 0 1px 0 #ffffff;
}
-->
</style>

</head>

<body>


        <!-- show loading until the all page scripts are fully loaded and cached (use this only on login page) -->
        <div id="loading">
            <div class="inner">
                <div>
                    <div class="ajax-loader"></div>
                    <p>Loading<span>...</span></p>
                </div>
            </div>
        </div>
        <script>document.getElementById('loading').style.display = 'block';</script>

    <div style="position: fixed; z-index: 9999; left: 50%; margin-left: -310px; display: none;" class="box grid_8 modal-window-hidden" id="myModal">
        <header>
            <div class="inner">
                <div class="left title">
                    <h1>Newsletter</h1>
                </div>
                <div class="right">
                    <a href="#" class="close">close</a>
                </div>
            </div>
        </header>
    
        <div class="box-content">
            <iframe style="width:1000px; height:400px" scrolling=auto width=1000 height=400 align=top frameborder=0  src="http://mall.vip4it.com/widget_newsletter/" > </iframe>
            <footer class="pane">
                <a href="#" class="close bt red">Close Newsletter</a>
            </footer>
        </div>
    </div>

        <!-- wrapper -->
        <div id="wrapper">

            <section>
                <div class="container_12">
                    <div id="content" class="compact-page">
                        <div class="min">
                            <div id="logo" style="margin-top: 60px;">
                                <img src="system/cms/themes/pyrocms/img/admin/logo.png" alt="logo" />
                            </div>
                            <div class="main-box">
                                <!-- If you don't want that the theme opens that fancy menu through ajax, remove "jmenu" class -->
                                <!-- If you want the fancy menu, the "action" must return the dashboard html (or similar page), so that we can extract menu informations. A AJAX request will be made
                                     with the form data (without the X-Request-With header), if the response is a valid successfully logged-user page, the fancy menu will appear, otherwise the form will procced normally -->
                                <?php echo form_open('admin/login'); ?>
                                                                
                                    <header class="head">
                                        <h1>Login</h1>
                                        
                                        <div class="alignright">
                                            <div class="note small">
                                                <input class="remember" class="remember" id="remember" type="checkbox" name="remember" value="1" /> <label for="ck">remember your password?</label>
                                            </div>
                                        </div>
                                        <span class="divider"></span>
                                    </header>
                                    <div class="alert grey air">
                                        <p><strong>You need the password!</strong> then click login.</p>
                                        <a class="close" href="#">close</a>
                                    </div>
                                    <div class="field fullwidth">
                                        <input type="text" name="email" placeholder="<?php echo lang('email_label'); ?>" data-icon="user" />
                                    </div>
                                    <div class="field fullwidth">
                                        <input type="password" name="password" placeholder="<?php echo lang('password_label'); ?>" data-icon="closed-lock" />
                                    </div>

                                    <span class="divider"></span>

                                    <div class="field fullwidth last">
                                       <input class="bt blue large" type="submit" name="submit" value="<?php echo lang('login_label'); ?>" />
                                    </div>
                                <?php echo form_close(); ?>
                            <div class="extension-wrap-center" style="margin-top: 10px;">
                                <div class="extension top bottom menu">
                                    <?php $this->load->view('admin/partials/notices') ?>
                                    <nav>
                                        <ul>
                                            <li><a href="#myModal" class="vipmodal">Login To NewsLetter</a></li>
                                            <!-- The ajax class only works on theses kind of pages (login and forgot, or any other page that have the same kind of layout) -->
                                            <li><a href="forgot-password.html" class="ajax">forgot your password?</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- /wrapper -->
        
</body>
</html>
