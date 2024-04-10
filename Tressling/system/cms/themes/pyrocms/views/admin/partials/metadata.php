<?php
Asset::js('jquery/jquery.js');
Asset::js_inline('jQuery.noConflict();');
//Asset::js('jquery/jquery-ui.min.js', 'jquery/jquery-ui.min.js');
Asset::js('jquery/jquery.colorbox.js');
Asset::js('jquery/jquery.cooki.js');

Asset::js(array('codemirror/codemirror.js',
	'codemirror/mode/css/css.js',
	'codemirror/mode/htmlmixed/htmlmixed.js',
	'codemirror/mode/javascript/javascript.js',
	'codemirror/mode/markdown/markdown.js',
	'plugins.js',
	'scripts.js'
)); ?>

<?php if (isset($analytic_visits) OR isset($analytic_views)): ?>
	<?php Asset::js('jquery/jquery.excanvas.min.js'); ?>
	<?php Asset::js('jquery/jquery.flot.js'); ?>
<?php endif; ?>

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
    'cufon.js',
    'qk.font.js'
)); ?>




<script type="text/javascript">
	pyro = { 'lang' : {} };
	var APPPATH_URI					= "<?php echo APPPATH_URI;?>";
	var SITE_URL					= "<?php echo rtrim(site_url(), '/').'/';?>";
	var BASE_URL					= "<?php echo BASE_URL;?>";
	var BASE_URI					= "<?php echo BASE_URI;?>";
	var UPLOAD_PATH					= "<?php echo UPLOAD_PATH;?>";
	var DEFAULT_TITLE				= "<?php echo addslashes($this->settings->site_name); ?>";
	pyro.admin_theme_url			= "<?php echo BASE_URL . $this->admin_theme->path; ?>";
	pyro.apppath_uri				= "<?php echo APPPATH_URI; ?>";
	pyro.base_uri					= "<?php echo BASE_URI; ?>";
	pyro.lang.remove				= "<?php echo lang('global:remove'); ?>";
	pyro.lang.dialog_message 		= "<?php echo lang('global:dialog:delete_message'); ?>";
	pyro.csrf_cookie_name			= "<?php echo config_item('cookie_prefix').config_item('csrf_cookie_name'); ?>";
	pyro.foreign_characters			= <?php echo json_encode(accented_characters()); ?>
</script>


<!-- CSSs -->
<?php Asset::css(array( 'modules/reset.css', 'modules/960.css', 'modules/icons.css'
                        ,'modules/tipsy.css', 'modules/formalize.css', 'modules/prettyPhoto.css'
                        //,'modules/jquery-ui-1.8.18.custom.css'
                        , 'modules/chosen.css', 'modules/ui.spinner.css'
                        ,'modules/jquery.jqplot.min.css', 'modules/fullcalendar.css', 'modules/jquery.miniColors.css'
                        ,'modules/elrte.min.css', 'modules/elfinder.css', 'modules/main.css')); ?>
     
<?php Asset::css(array('plugins.css', 'jquery/colorbox.css', 'codemirror.css')); ?>

<?php echo Asset::render(); ?>


<?php if ($module_details['sections']): ?>
<style>section#content {margin-top: 170px!important;}</style>
<?php endif; ?>

<?php echo $template['metadata']; ?>
