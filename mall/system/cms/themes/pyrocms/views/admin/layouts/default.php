<!doctype html>

<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]> <html class="no-js" lang="en"> 		   <![endif]-->

<head>
	<meta charset="utf-8">

	<!-- You can use .htaccess and remove these lines to avoid edge case issues. -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php echo lang('cp_admin_title').' - '.$template['title'];?></title>

	<base href="<?php echo base_url(); ?>" />

	<!-- Mobile viewport optimized -->
	<meta name="viewport" content="width=device-width,user-scalable=no">

	<!-- CSS. No need to specify the media attribute unless specifically targeting a media type, leaving blank implies media=all -->
	<?php echo Asset::css('plugins.css'); ?>
	<?php echo Asset::css('workless/workless.css'); ?>
	<?php echo Asset::css('workless/application.css'); ?>
	<?php echo Asset::css('workless/responsive.css'); ?>
	<!-- End CSS-->

	<!-- Load up some favicons -->
	<link rel="shortcut icon" href="favicon.ico">
	<link rel="apple-touch-icon" href="apple-touch-icon.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-57x57-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-72x72-precomposed.png">
	<link rel="apple-touch-icon" href="apple-touch-icon-114x114-precomposed.png">

	<!-- metadata needs to load before some stuff -->
	<?php file_partial('metadata'); ?>
    
<?php
	    if(CURRENT_LANGUAGE == 'ar'){
	       
           echo '<style type="text/css">body{font-family: tahoma;font-size: 10pt;}</style>';
           
	    }
?>


</head>

<body>

<div id="wrapper">
            
            <header>
                <div class="container_12">
                    <div class="grid_12">
                		 <!-- navigation menu -->
                        <nav class="main-nav">
                			<?php file_partial('navigation'); ?>
                		</nav>
                        <!-- /navigation menu -->

                        <!-- bar -->
                        <ul class="bar">
                            <li class="search">
                                <div>
                                    <form>
                                        <!-- the "L" value represents the icon, don't change -->
                                        <input type="submit" value="L" title="Click to search" class="tooltip glyph" />
                                        <input type="text" placeholder="What you want to search?" name="s" />
                                    </form>
                                </div>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="glyph opened-chat"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="glyph comment"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="glyph settings"></span>
                                </a>
                            </li>
                            <li>
                                <a href="#" title="edit profile" class="tooltip">
                                    <span class="glyph user"></span>
                                    <span class="text">admin</span>
                                </a>
                            </li>
                        </ul>
                    </div>                
                </div>
            </header>

            <section>
                <div class="container_12">
                    <div class="grid_12" id="content-top">
                        <div id="logo">
                            <img src="system/cms/themes/pyrocms/img/admin/logo.png" alt="logo" />
                        </div>
                        <nav>
                            <ul>

                                <li>
                                    <a href="#myModal" class="vipmodal">
                                        <span class="glyph open-in-new-window"></span>
                                        Modal
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="glyph zoom-in"></span>
                                        Quick Post
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="glyph terminal"></span>
                                        Quick Action
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div>

                    <div id="content">
                        <div class="extension top inleft breadcrumbs">
                            <nav>
                                <ul>
                                    <li><?php echo $module_details['name'] ? anchor('admin/'.$module_details['slug'], $module_details['name']) : lang('global:dashboard'); ?></li>
                                    <?php if ( $this->uri->segment(2) ) { echo '&nbsp; | &nbsp;'; } ?>
                        			<?php echo '<span class="divider"></span><li>' . $module_details['description'] ? $module_details['description'] : '' ; echo '</li>'; ?>
                                </ul>
                            </nav>
                        </div>

                    <!-- The modal -->
                    <div class="box grid_8" id="myModal" hidden>
                        <header>
                            <div class="inner">
                                <div class="left title">
                                    <h1>Modal</h1>
                                </div>
                                <div class="right">
                                    <a href="#" class="close">close</a>
                                </div>
                            </div>
                        </header>
                    
                        <div class="box-content">
                            <p>I love VIP IT !.</p>
                            <footer class="pane">
                                <a href="#" class="close bt red">Close modal</a>
                                <a href="#" class="bt blue">Custom button</a>
                            </footer>
                        </div>
                    </div>
                    <?php if ( ! empty($module_details['sections'])) file_partial('sections'); ?>
                        <div class="main-box">
                        
                        <?php file_partial('notices'); ?>
    				    <?php echo $template['body']; ?>
                        
                        </div>
                    </div>
                </div>
            </section>
        </div>

	<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6. chromium.org/developers/how-tos/chrome-frame-getting-started -->
	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->

        <footer>
            <div class="container_12">
               <p>Copyright &copy; 2009 - <?php echo date('Y'); ?> VIP CMS &nbsp; -- &nbsp; Version <?php echo CMS_VERSION.' '.CMS_EDITION; ?> &nbsp; -- &nbsp; Rendered in {elapsed_time} sec. using {memory_usage}.</p>
    			
                <ul id="lang">
    				<form action="<?php echo current_url(); ?>" id="change_language" method="get">
    					<select class="chzn" name="lang" onchange="this.form.submit();">
    						<?php foreach($this->config->item('supported_languages') as $key => $lang): ?>
    						<option value="<?php echo $key; ?>" <?php echo CURRENT_LANGUAGE == $key ? 'selected="selected"' : ''; ?>>
    								<?php echo $lang['name']; ?>
    							</option>
    					<?php endforeach; ?>
    				</select>
    				</form>
    			</ul>
            </div>
        </footer>
        <script>
        // chart
        if($('#container1')[0])
        (function(){
            var data = [
                ['Heavy Industry', 12],['Retail', 9], ['Light Industry', 14],
                ['Out of home', 16],['Commuting', 7], ['Orientation', 9]
            ];
            var plot1 = jQuery.jqplot ('container1', [data],
                {
                  seriesDefaults: {
                    // Make this a pie chart.
                    renderer: jQuery.jqplot.PieRenderer,
                    rendererOptions: {
                      // Put data labels on the pie slices.
                      // By default, labels show the percentage of the slice.
                      showDataLabels: true
                    }
                  },
                  grid: { borderWidth: 0, shadow: false },
                  legend: { show:true, location: 'e' }
                }
              );
        })();
        </script>
        
        <script type="text/javascript">
        //Cufon.set('fontSize', '20px').replace('h1, h2, h3, h4');
        //Cufon.set('fontSize', '14px').replace('.main-nav a');
        //Cufon.now();
        </script>      

</body>
</html>