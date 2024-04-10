<!DOCTYPE html>
<html>
<head>
<?php

$active = ( isset($_GET['active']) && !empty($_GET['active']) ) ? $_GET['active'] : 'dashboard'; 

?>
	<title><?php echo lang('cp_admin_title').' - '.$template['title'];?></title>
	
	<base href="<?php echo base_url(); ?>" />
    
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<!-- Always force latest IE rendering engine & Chrome Frame -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    
    <!-- Combined stylesheets load -->
	<!-- Load either 960.gs.fluid or 960.gs to toggle between fixed and fluid layout -->
    <?php 
//    display_css(
//        array(
//        'admin/style.css','admin/reset.css','admin/form.css','admin/960.gs.fluid.css',
//        'admin/standard.css', 'admin/simple-lists.css','admin/block-lists.css','admin/planning.css','admin/table.css','admin/calendars.css',
//        'admin/wizard.css','admin/gallery.css'
//        )
//    );
    ?>
    
    
	<!-- Global stylesheets -->
    <link href="system/codexfw/assets/css/admin/style.css" rel="stylesheet" type="text/css">
    
	<link href="system/codexfw/assets/css/admin/reset.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/common.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/form.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/standard.css" rel="stylesheet" type="text/css">

	<!-- Comment/uncomment one of these files to toggle between fixed and fluid layout -->
	<!--<link href="system/codexfw/assets/css/admin/960.gs.css" rel="stylesheet" type="text/css">-->
	<link href="system/codexfw/assets/css/admin/960.gs.fluid.css" rel="stylesheet" type="text/css">
	
	<!-- Custom styles -->
	<link href="system/codexfw/assets/css/admin/simple-lists.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/block-lists.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/planning.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/table.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/calendars.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/wizard.css" rel="stylesheet" type="text/css">
	<link href="system/codexfw/assets/css/admin/gallery.css" rel="stylesheet" type="text/css">
    
    
	<!-- Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="admin/favicon.ico">
	<link rel="icon" type="image/png" href="favicon-large.png">
		
    
	<!-- Generic libs -->
    <!-- html5.js has to be loaded before anything else -->    
	<script type="text/javascript" src="system/codexfw/assets/js/admin/html5.js"></script>				<!-- this has to be loaded before anything else -->
	
    <script type="text/javascript" src="system/codexfw/assets/js/jquery/jquery.js"></script>	
    
    <!-- Grab Google CDNs jQuery, fall back if necessary
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
	<script>!window.jQuery && document.write('<script src="<?php echo js_path('jquery/jquery.js'); ?>"><\/script>')</script>
     -->    
	<script type="text/javascript" src="system/codexfw/assets/js/admin/old-browsers.js"></script>		<!-- remove if you do not need older browsers detection -->
	
	<!-- Template libs -->
	<script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.accessibleList.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/searchField.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/common.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/standard.js"></script>
	<!--[if lte IE 8]><script type="text/javascript" src="system/codexfw/assets/js/admin/standard.ie.js"></script><![endif]-->
	<script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.tip.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.hashchange.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.contextMenu.js"></script>
	<script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.modal.js"></script>
	
	<!-- Custom styles lib -->
	<script type="text/javascript" src="system/codexfw/assets/js/admin/list.js"></script>
    
    <!-- Custom jQuery UI lib -->
    <script type="text/javascript" src="system/codexfw/assets/js/jquery/jquery-ui.min.js"></script>  
    
    <script type="text/javascript" src="system/codexfw/assets/js/jquery/jquery.colorbox.min.js"></script>
    <script type="text/javascript" src="system/codexfw/assets/js/jquery/jquery.livequery.min.js"></script>
    <script type="text/javascript" src="system/codexfw/assets/js/jquery/jquery.uniform.min.js"></script>
   	
	<!-- Plugins -->    
    <script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="system/codexfw/assets/js/admin/jquery.datepick/jquery.datepick.min.js"></script>
    
    
    <link href="system/codexfw/assets/css/jquery/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="system/codexfw/assets/css/jquery/colorbox.css" rel="stylesheet" type="text/css">

    <script type="text/javascript">jQuery.noConflict();</script>
    
    
    <script type="text/javascript" src="system/codexfw/assets/js/admin/functions.js"></script>  
    
    
    <!--[if lt IE 9]><script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

    
    <?php echo $template['partials']['metadata']; ?>
    
	<!--[if lte IE 8]><script type="text/javascript" src="system/codexfw/assets/js/admin/standard.ie.js"></script><![endif]-->
	

	<!-- Charts library -->
	<!--Load the AJAX API
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
	<script type="text/javascript">
	
		// Load the Visualization API and the piechart package.
		//google.load('visualization', '1', {'packages':['corechart']});
        

          jQuery(function($) {          
                
           		$('a[rel=codex_box], a.codex_box').live('click',function() {
        
        			$.modal({
        				content: '',
        				title: 'Loading',
        				maxWidth: 500,
                        draggable: true,
        				buttons: {
        				    //'Open new modal': function(win) { openModal(); },
        					'Close': function(win) { win.closeModal(); }
        				}
        			});
                     
                    $('.modal-window').setModalTitle( $(this).next(".mail_subject").text() );
                    $('.modal-window').setModalContent( $(this).next(".mail_subject").next(".mail_body").html() );
                    
        		}); 
            
           });
        
	</script>

	
</head>

<body>

<noscript>
	Codex CMS requires that JavaScript be turned on for many of the functions to work correctly. Please turn JavaScript on and reload the page.
</noscript>
<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
<!--[if lt IE 9]><div class="ie"><![endif]-->
<!--[if lt IE 8]><div class="ie7"><![endif]-->
	
    <div id="logo" title="Code Experts Ltd"></div>
    
	<!-- Header -->
	
    <div id="default_header">
	<!-- Server status -->
	<header><div class="container_12">
		
		<p id="skin-name"> <small>Codex <br> Control Panel</small><strong><?php echo CMS_VERSION; ?></strong></p>
		<div class="server-info">Server: <strong>Apache {apache_version}</strong></div>
		<div class="server-info">Php: <strong>{phpversion()}</strong></div>
		
	</div></header>
	<!-- End server status -->
    </header>  
    </div>  
    

	
	<!-- Main nav -->
    <div id="default_nav">
    <?php 
    
    /**
    **
    *
    * future navigation
    */
    
    echo $template['partials']['navigation']; 
    
    ?>
	<!-- End main nav -->
	
	<!-- Sub nav -->
	<div id="sub-nav"><div class="container_12">
		
		<a href="#" title="Help" class="nav-button"><b>Help</b></a>
	
		<form id="search-form" name="search-form" method="post" action="http://127.0.0.1/tune/CodexCP/index.php?task=search">
			<input type="text" name="s" id="s" value="" title="Search admin..." autocomplete="off">
		</form>
	
	</div></div>
	<!-- End sub nav -->
    
    </div><!-- End default nav -->
	
	<!-- Status bar -->
	<div id="status-bar"><div class="container_12">
	
    <?php echo $template['partials']['header']; ?>


    <ul id="breadcrumb">
        
        <li><a href="#" title="Home">Home</a></li>
    	<li><?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?><li>
    	<li><?php echo $module_details['description'] ? $module_details['description'] : ''; ?><li>
    	<?php if($module_details['slug']): ?>
    		<li><?php echo anchor('admin/help/'.$module_details['slug'], '?', array('title' => lang('help_label').'->'.$module_details['name'], 'class' => 'modal')); ?></li>
    	<?php endif; ?>
    
    </ul>

	</div></div>
	<!-- End status bar -->
	
	<div id="header-shadow"></div>
	<!-- End header -->
	
	<!-- Always visible control bar 
	<div id="control-bar" class="grey-bg clearfix"><div class="container_12">
	
		<div class="float-left">
			<button type="button"><img src="admin/icons/fugue/navigation-180.png" width="16" height="16"> Back to list</button>
		</div>
		
		<div class="float-right"> 
			<button type="button" disabled="disabled">Disabled</button>
			<button type="button" class="red">Cancel</button> 
			<button type="button" class="grey">Reset</button> 
			<button type="button"><img src="admin/icons/fugue/tick-circle.png" width="16" height="16"> Save</button>
		</div>
			
	</div></div>-->
	<!-- End control bar -->
	
	<!-- Content -->
	<article class="container_12">
    

<!--
    <div class="fieldset with-legend">
       <div class="legend">
            <?php echo $module_details['name'] ? anchor('admin/' . $module_details['slug'], $module_details['name']) : lang('cp_admin_home_title'); ?>
       </div>
		<p><?php echo $module_details['description'] ? $module_details['description'] : ''; ?></p>
		<?php if($module_details['slug']): ?>
			<p id="page-header-help"><?php echo anchor('admin/help/'.$module_details['slug'], '?', array('title' => lang('help_label').'->'.$module_details['name'], 'class' => 'modal')); ?></p>
		<?php endif; ?>
    </div>     
    
-->

    
    <?php $this->load->view('admin/partials/notices') ?>
    
	<?php if(!empty($template['partials']['shortcuts'])): ?>
		<?php echo $template['partials']['shortcuts']; ?>
	<?php endif; ?>
	
	<?php if(!empty($template['partials']['filters'])): ?>
		<?php echo $template['partials']['filters']; ?>
	<?php endif; ?>

	
    <div id="content">	
       <?php echo $template['body']; ?>
		
	</div>
    
    </article>
	
	<!-- End content -->
	
	<footer>
    <div class="float-right">
		<div id="lang-select">
		<form action="<?php echo current_url(); ?>" id="change_language" method="get">
				<select name="lang" onchange="this.form.submit();">
					<option value="">-- Select Language --</option>
			<?php foreach($this->config->item('supported_languages') as $key => $lang): ?>
		    		<option value="<?php echo $key; ?>" <?php echo CURRENT_LANGUAGE == $key ? 'selected="selected"' : ''; ?>>
						<?php echo $lang['name']; ?>
					</option>
        	<?php endforeach; ?>
	        	</select>

		</form>
		</div>
     </div>   
		<div class="float-left">
			<a href="#" class="button">Copyright © 2004 - 2011 <?php echo $this->settings->site_name; ?> All Rights Reserved</a>
			<a href="http://codexc.com/" target="_blank" class="button">By CodeXperts Ltd</a>.
            <a href="http://codexc.com/" target="_blank" class="button">Rendered in {elapsed_time} sec. using {memory_usage}</a>
		</div>
		
		<div class="float-right">
			<a href="#top" class="button"><img src="admin/icons/fugue/navigation-090.png" width="16" height="16"> Page top</a>
		</div>
		
	</footer>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->

</body>
</html>