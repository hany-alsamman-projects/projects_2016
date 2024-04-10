<?php

	// Get apache version
	function apache_version()
	{
		if (function_exists('apache_get_version'))
		{
			if (preg_match('|Apache\/(\d+)\.(\d+)\.(\d+)|', apache_get_version(), $version))
			{
				return $version[1].'.'.$version[2].'.'.$version[3];
			}
		}
		elseif (isset($_SERVER['SERVER_SOFTWARE']))
		{
			if (preg_match('|Apache\/(\d+)\.(\d+)\.(\d+)|', $_SERVER['SERVER_SOFTWARE'], $version))
			{
				return $version[1].'.'.$version[2].'.'.$version[3];
			} 
		}
		
		return '(unknown)';
	}

?><!DOCTYPE html>
<html lang="en">
<head>

    <title>
    <?php
   
    $active = ( isset($_GET['active']) && !empty($_GET['active']) ) ? $_GET['active'] : 'dashboard';
   
    print SITE_NAME.' - '.$active;
    	
    ?>
    </title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	
	<!-- Combined stylesheets load -->
	<!-- Load either 960.gs.fluid or 960.gs to toggle between fixed and fluid layout -->
	<link href="css/mini.php?files=reset,common,form,standard,960.gs.fluid,simple-lists,block-lists,planning,table,calendars,wizard,gallery" rel="stylesheet" type="text/css">
	
	<!-- Favicon -->
	<link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
	<link rel="icon" type="image/png" href="favicon-large.png">
	
	<!-- Combined JS load -->
	<!-- html5.js has to be loaded before anything else    -->
	<script type="text/javascript" src="js/mini.php?files=html5,jquery.min,old-browsers,jquery.accessibleList,searchField,common,standard,jquery.tip,jquery.hashchange,jquery.contextMenu,jquery.modal,list"></script>


    <script  type="text/javascript" src="js/jquery.autocomplete.js"></script>
    
    
<!--
    <script type="text/javascript" src="js/html5.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/old-browsers.js"></script>
    <script type="text/javascript" src="js/jquery.autocomplete.js"></script>
    <script type="text/javascript" src="js/jquery.accessibleList.js"></script>
    <script type="text/javascript" src="js/searchField.js"></script>
    <script type="text/javascript" src="js/common.js"></script>
    <script type="text/javascript" src="js/standard.js"></script>
    <script type="text/javascript" src="js/jquery.tip.js"></script>
    <script type="text/javascript" src="js/jquery.hashchange.js"></script>
    <script type="text/javascript" src="js/jquery.contextMenu.js"></script>
    <script type="text/javascript" src="js/jquery.modal.js"></script>
    <script type="text/javascript" src="js/list.js"></script>
-->
    
	<!--[if lte IE 8]><script type="text/javascript" src="js/standard.ie.js"></script><![endif]-->
	
	<!-- Plugins -->
	<script  type="text/javascript" src="js/jquery.dataTables.min.js"></script>
	<script  type="text/javascript" src="js/jquery.datepick/jquery.datepick.min.js"></script>
	
	<!-- Charts library -->
	<!--Load the AJAX API
	<script type="text/javascript" src="http://www.google.com/jsapi"></script>-->
	<script type="text/javascript">
	
		// Load the Visualization API and the piechart package.
		//google.load('visualization', '1', {'packages':['corechart']});
		
	</script>
	
	<script type="text/javascript">

        
        function change_active(BeActive)
        {
            if(BeActive != 'dashboard'){                
            
                 $("ul #"+BeActive+"").addClass("current");
            
            }else{
             
                $("ul #home").addClass("current");   
            
            }
        
        }
        
		$(document).ready(function()
		{
		  
            change_active("<?=$active?>");
            
			/*
			 * Example context menu
			 */
			
			// Context menu for all favorites
			$('.favorites li').bind('contextMenu', function(event, list)
			{
				var li = $(this);
				
				// Add links to the menu
				if (li.prev().length > 0)
				{
					list.push({ text: 'Move up', link:'#', icon:'up' });
				}
				if (li.next().length > 0)
				{
					list.push({ text: 'Move down', link:'#', icon:'down' });
				}
				list.push(false);	// Separator
				list.push({ text: 'Delete', link:'#', icon:'delete' });
				list.push({ text: 'Edit', link:'#', icon:'edit' });
			});
			
			// Extra options for the first one
			$('.favorites li:first').bind('contextMenu', function(event, list)
			{
				list.push(false);	// Separator
				list.push({ text: 'Settings', icon:'terminal', link:'#', subs:[
					{ text: 'General settings', link: '#', icon: 'blog' },
					{ text: 'System settings', link: '#', icon: 'server' },
					{ text: 'Website settings', link: '#', icon: 'network' }
				] });
			});
			
			/*
			 * Table sorting
			 */
			
			// A small classes setup...
			$.fn.dataTableExt.oStdClasses.sWrapper = 'no-margin last-child';
			$.fn.dataTableExt.oStdClasses.sInfo = 'message no-margin';
			$.fn.dataTableExt.oStdClasses.sLength = 'float-left';
			$.fn.dataTableExt.oStdClasses.sFilter = 'float-right';
			$.fn.dataTableExt.oStdClasses.sPaging = 'sub-hover paging_';
			$.fn.dataTableExt.oStdClasses.sPagePrevEnabled = 'control-prev';
			$.fn.dataTableExt.oStdClasses.sPagePrevDisabled = 'control-prev disabled';
			$.fn.dataTableExt.oStdClasses.sPageNextEnabled = 'control-next';
			$.fn.dataTableExt.oStdClasses.sPageNextDisabled = 'control-next disabled';
			$.fn.dataTableExt.oStdClasses.sPageFirst = 'control-first';
			$.fn.dataTableExt.oStdClasses.sPagePrevious = 'control-prev';
			$.fn.dataTableExt.oStdClasses.sPageNext = 'control-next';
			$.fn.dataTableExt.oStdClasses.sPageLast = 'control-last';
			

			
			/*
			 * Datepicker
			 * Thanks to sbkyle! http://themeforest.net/user/sbkyle
			 */
			$('.datepicker').datepick({
				alignment: 'bottom',
				showOtherMonths: true,
				selectOtherMonths: true,
				renderer: {
					picker: '<div class="datepick block-border clearfix form"><div class="mini-calendar clearfix">' +
							'{months}</div></div>',
					monthRow: '{months}', 
					month: '<div class="calendar-controls" style="white-space: nowrap">' +
								'{monthHeader:M yyyy}' +
							'</div>' +
							'<table cellspacing="0">' +
								'<thead>{weekHeader}</thead>' +
								'<tbody>{weeks}</tbody></table>', 
					weekHeader: '<tr>{days}</tr>', 
					dayHeader: '<th>{day}</th>', 
					week: '<tr>{days}</tr>', 
					day: '<td>{day}</td>', 
					monthSelector: '.month', 
					daySelector: 'td', 
					rtlClass: 'rtl', 
					multiClass: 'multi', 
					defaultClass: 'default', 
					selectedClass: 'selected', 
					highlightedClass: 'highlight', 
					todayClass: 'today', 
					otherMonthClass: 'other-month', 
					weekendClass: 'week-end', 
					commandClass: 'calendar', 
					commandLinkClass: 'button',
					disabledClass: 'unavailable'
				}
			});
		});
		
		// Demo modal
		function openModal()
		{
			$.modal({
				content: '<p>This is an example of modal window. You can open several at the same time (click button below!), move them and resize them.</p>'+
						  '<p>The plugin provides several other functions to control them, try below:</p>'+
						  '<ul class="simple-list with-icon">'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'\')">Remove title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().setModalTitle(\'New title\')">Change title</a></li>'+
						  '    <li><a href="javascript:void(0)" onclick="$(this).getModalWindow().loadModalContent(\'ajax-modal.html\')">Load Ajax content</a></li>'+
						  '</ul>',
				title: 'Example modal window',
				maxWidth: 500,
				buttons: {
					'Open new modal': function(win) { openModal(); },
					'Close': function(win) { win.closeModal(); }
				}
			});
		}
	
	</script>
	
</head>

<body>
<!-- The template uses conditional comments to add wrappers div for ie8 and ie7 - just add .ie or .ie7 prefix to your css selectors when needed -->
<!--[if lt IE 9]><div class="ie"><![endif]-->
<!--[if lt IE 8]><div class="ie7"><![endif]-->
	
    <div id="logo" title="Code Experts Ltd"></div>
    
	<!-- Header -->
	
	<!-- Server status -->
	<header><div class="container_12">
		
		<p id="skin-name"> <small>Codex <br> Control Panel</small><strong>3.0</strong></p>
		<div class="server-info">Server: <strong>Apache <?php echo apache_version(); ?></strong></div>
		<div class="server-info">Php: <strong><?php echo phpversion(); ?></strong></div>
		
	</div></header>
	<!-- End server status -->
	
	<!-- Main nav -->
	<nav id="main-nav">
		
		<ul class="container_12">
			<li id="home" class="home"><a href="./index.php" title="Home">Home</a>
				<ul>
					<li class="current"><a href="./index.php" title="Dashboard">Dashboard</a></li>
					<li><a href="#" title="My profile">My profile</a></li>
                    <li><a href="./?section=ChangePassword&active=dashboard" title="Change Password">Change Password</a></li>
                    
					<li class="with-menu"><a href="#" title="My settings">My settings</a>
						<div class="menu">
							<img src="images/menu-open-arrow.png" width="16" height="16">
							<ul>
								<li class="icon_address"><a href="#">Browse by</a>
									<ul>
										<li class="icon_blog"><a href="#">Blog</a>
											<ul>
												<li class="icon_alarm"><a href="#">Recents</a>
													<ul>
														<li class="icon_building"><a href="#">Corporate blog</a></li>
														<li class="icon_newspaper"><a href="#">Press blog</a></li>
													</ul>
												</li>
												<li class="icon_building"><a href="#">Corporate blog</a></li>
												<li class="icon_computer"><a href="#">Support blog</a></li>
												<li class="icon_search"><a href="#">Search...</a></li>
											</ul>
										</li>
										<li class="icon_server"><a href="#">Website</a></li>
										<li class="icon_network"><a href="#">Domain</a></li>
									</ul>
								</li>
								<li class="icon_export"><a href="#">Export</a>
									<ul>
										<li class="icon_doc_excel"><a href="#">Excel</a></li>
										<li class="icon_doc_csv"><a href="#">CSV</a></li>
										<li class="icon_doc_pdf"><a href="#">PDF</a></li>
										<li class="icon_doc_image"><a href="#">Image</a></li>
										<li class="icon_doc_web"><a href="#">Html</a></li>
									</ul>
								</li>
								<li class="sep"></li>
								<li class="icon_refresh"><a href="#">Reload</a></li>
								<li class="icon_reset">Reset</li>
								<li class="icon_search"><a href="#">Search</a></li>
								<li class="sep"></li>
								<li class="icon_terminal"><a href="#">Custom request</a></li>
								<li class="icon_battery"><a href="#">Stats server load</a></li>
							</ul>
						</div>
					</li>
				</ul>
			</li>
			<li id="pages" class="write"><a href="#" title="Write">Pages</a>
				<ul>
					<li><a href="./?section=AddPage&active=pages" title="Add Page">Add Page</a></li>
					<li><a href="./?section=AddPage&translation=true&active=pages" title="Add Translation">Add Translation</a></li>
					<li><a href="./?section=ShowPages&active=pages" title="Show Pages">View Pages</a></li>
				</ul>
			</li>
			<li class="comments"><a href="#" title="Topics">Topics</a>
				<ul>
					<li><a href="index.php?section=ShowObjects" title="Show Topics">Show Topics</a></li>
                    <li><a href="index.php?section=ShowObjects&in_dept=3" title="Show Archive">Show Archive</a></li>
					<li><a href="index.php?section=AddTopic" title="Add Topic">Add Topic</a></li>
				</ul>
			</li>
			<li class="medias"><a href="#" title="Medias">Medias</a>
				<ul>
					<li><a href="#" title="Browse">Browse</a></li>
					<li><a href="#" title="Add file">Add file</a></li>
					<li><a href="#" title="Manage">Manage</a></li>
					<li><a href="#" title="Settings">Settings</a></li>
				</ul>
			</li>
			<li class="users"><a href="#" title="Accounts">Accounts</a>
				<ul>
					<li><a href="?section=ShowAccounts" title="Show Accounts">Show Accounts</a></li>
					<li><a href="#" title="Add account">Add account</a></li>
					<li><a href="#" title="Settings">Settings</a></li>
				</ul>
			</li>
			<li class="stats"><a href="#" title="Stats">Stats</a></li>
			<li class="settings"><a href="#" title="Settings">Settings</a></li>
			<li class="backup"><a href="#" title="Backup">Backup</a></li>
            <li class="facebook"><a href="http://www.facebook.com/pages/Codex-Corporation/126986967368181" target="_blank" title="Facebook">Facebook</a></li>
            <li class="twitter"><a href="http://twitter.com/CodeXperts" target="_blank" title="twitter">twitter</a></li>
		</ul>
	</nav>
	<!-- End main nav -->
	
	<!-- Sub nav -->
	<div id="sub-nav"><div class="container_12">
		
		<a href="#" title="Help" class="nav-button"><b>Help</b></a>
	
		<form id="search-form" name="search-form" method="post" action="index.php?task=search">
			<input type="text" name="s" id="s" value="" title="Search admin..." autocomplete="off">
		</form>
	
	</div></div>
	<!-- End sub nav -->
	
	<!-- Status bar -->
	<div id="status-bar"><div class="container_12">
	
		<ul id="status-infos">
			<li class="spaced">Logged as: <img align="absmiddle" src="../images/admin/<?php echo $_SESSION["group_id"] ?>.png" />&nbsp; <strong><? print $_SESSION["user_name"] ?></strong></li>
<!--
			<li>
				<a href="#" class="button" title="5 messages"><img src="images/icons/fugue/mail.png" width="16" height="16"> <strong>5</strong></a>
				<div id="messages-list" class="result-block">
					<span class="arrow"><span></span></span>
					
					<ul class="small-files-list icon-mail">
						<li>
							<a href="#"><strong>10:15</strong> Please update...<br>
							<small>From: System</small></a>
						</li>
						<li>
							<a href="#"><strong>Yest.</strong> Hi<br>
							<small>From: Jane</small></a>
						</li>
						<li>
							<a href="#"><strong>Yest.</strong> System update<br>
							<small>From: System</small></a>
						</li>
						<li>
							<a href="#"><strong>2 days</strong> Database backup<br>
							<small>From: System</small></a>
						</li>
						<li>
							<a href="#"><strong>2 days</strong> Re: bug report<br>
							<small>From: Max</small></a>
						</li>
					</ul>
					
					<p id="messages-info" class="result-info"><a href="#">Go to inbox &raquo;</a></p>
				</div>
			</li>
			<li>
				<a href="#" class="button" title="25 comments"><img src="images/icons/fugue/balloon.png" width="16" height="16"> <strong>25</strong></a>
				<div id="comments-list" class="result-block">
					<span class="arrow"><span></span></span>
					
					<ul class="small-files-list icon-comment">
						<li>
							<a href="#"><strong>Jane</strong>: I don't think so<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Ken_54</strong>: What about using a different...<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Jane</strong> Sure, but no more.<br>
							<small>On <strong>Another post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Max</strong>: Have you seen that...<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Anonymous</strong>: Good luck!<br>
							<small>On <strong>My first post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Sébastien</strong>: This sure rocks!<br>
							<small>On <strong>Another post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>John</strong>: Me too!<br>
							<small>On <strong>Third post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>John</strong> This can be solved by...<br>
							<small>On <strong>Another post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Jane</strong>: No prob.<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Anonymous</strong>: I had the following...<br>
							<small>On <strong>My first post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Anonymous</strong>: Yes<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Lian</strong>: Please make sure that...<br>
							<small>On <strong>Last post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Ann</strong> Thanks!<br>
							<small>On <strong>Last post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Max</strong>: Don't tell me what...<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Gordon</strong>: Here is an article about...<br>
							<small>On <strong>My another post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Lee</strong>: Try to reset the value first<br>
							<small>On <strong>Last title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Lee</strong>: Sure!<br>
							<small>On <strong>Second post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Many</strong> Great job, keep on!<br>
							<small>On <strong>Third post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>John</strong>: I really like this<br>
							<small>On <strong>First title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Paul</strong>: Hello, I have an issue with...<br>
							<small>On <strong>My first post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>June</strong>: Yuck.<br>
							<small>On <strong>Another title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Jane</strong>: Wow, sounds amazing, do...<br>
							<small>On <strong>Another title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Esther</strong>: Man, this is the best...<br>
							<small>On <strong>Another post</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>Max</strong>: Thanks!<br>
							<small>On <strong>Post title</strong></small></a>
						</li>
						<li>
							<a href="#"><strong>John</strong>: I'd say it is not safe...<br>
							<small>On <strong>My first post</strong></small></a>
						</li>
					</ul>
					
					<p id="comments-info" class="result-info"><a href="#">Manage comments &raquo;</a></p>
				</div>
			</li>
-->
			<li><a href="./?section=logout" class="button red" title="Logout"><span class="smaller">LOGOUT</span></a></li>
		</ul>
		
		<ul id="breadcrumb">
			<li><a href="#" title="Home">Home</a></li>
			<li><a href="#" title="Dashboard">Dashboard</a></li>
		</ul>
	
	</div></div>
	<!-- End status bar -->
	
	<div id="header-shadow"></div>
	<!-- End header -->
	
	<!-- Always visible control bar 
	<div id="control-bar" class="grey-bg clearfix"><div class="container_12">
	
		<div class="float-left">
			<button type="button"><img src="images/icons/fugue/navigation-180.png" width="16" height="16"> Back to list</button>
		</div>
		
		<div class="float-right"> 
			<button type="button" disabled="disabled">Disabled</button>
			<button type="button" class="red">Cancel</button> 
			<button type="button" class="grey">Reset</button> 
			<button type="button"><img src="images/icons/fugue/tick-circle.png" width="16" height="16"> Save</button>
		</div>
			
	</div></div>-->
	<!-- End control bar -->
	
	<!-- Content -->
	<article class="container_12">
		
        <?php $this->CHECK_PAGES(); ?>
		
	</article>
	
	<!-- End content -->
	
	<footer>
		
		<div class="float-left">
			<a href="#" class="button">Copyright © 2004 - 2011 <?=SITE_NAME?> All Rights Reserved</a>
			<a href="http://codexc.com/" target="_blank" class="button">By CodeXperts Ltd</a>
		</div>
		
		<div class="float-right">
			<a href="#top" class="button"><img src="images/icons/fugue/navigation-090.png" width="16" height="16"> Page top</a>
		</div>
		
	</footer>

<!--[if lt IE 8]></div><![endif]-->
<!--[if lt IE 9]></div><![endif]-->

</body>
</html>