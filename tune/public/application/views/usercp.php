<!--
<div class="head_memberinfo">
	<div class="head_memberinfo_logo">
		<span>1</span> <img alt="" src="images/icons/unreadmail.png" /> </div>
	<span class="memberinfo_span">Welcome <a href="">Admin</a> </span>
	<span class="memberinfo_span2"><a href="">1 Private Message recieved</a>
	</span></div>
-->
<!--end head_memberinfo-->
<div class="content_block">
	<h2 class="jquery_tab_title">Dashboard</h2>
    
	<a class="dashboard_button button1" href="#">
	<span class="dashboard_button_heading">Dashboard</span> <span>Edit various basic 
	settings and Options</span> </a>
	<!--end dashboard_button--><a class="dashboard_button button2" href="index.php?action=usercp&pro=status&funds=deposit">
	<span class="dashboard_button_heading">Deposit</span> <span>funds deposit history and logs and status</span> </a>
	<!--end dashboard_button--><a class="dashboard_button button3" href="index.php?action=usercp&pro=status&funds=withdrawal">
	<span class="dashboard_button_heading">Withdrawal</span> <span>funds withdrawal history and logs and status</span> </a>
	<!--end dashboard_button--><a class="dashboard_button button4" href="index.php?action=usercp&pro=TradingAccount">
	<span class="dashboard_button_heading">Add Tune Trader</span> <span>from here you can add new trading account </span> </a>
	<!--end dashboard_button-->
	<!--end dashboard_button--><a class="dashboard_button button6" href="http://www.tune-forex.com/en/index.php?action=usercp&pro=password">
	<span class="dashboard_button_heading">Password</span> <span>change your password</span> </a>
	<!--end dashboard_button--><a class="dashboard_button button5" href="http://www.tune-forex.com/en/index.php?action=usercp&pro=profile">
	<span class="dashboard_button_heading">Change Profile</span> <span>Basic and advanced 
	profile area</span> </a>

    
	<h2>Informations and Settings</h2>
<!--
	<div class="content-box box-grey">
		<h4>Lorem ipsum</h4>
		<p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
		ut labore et dolore magna aliqua.</p>
		<h4>Commodo consequat</h4>
		<p>Dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt 
		ut labore et dolore magna aliqua.</p>
	</div>
-->
<?php
    if( session_is_registered('company') ) {
    	echo '<div class="content-box box2">';
    	echo '<h4>Partner Link !</h4>';
    	echo '<p><a href="'.SITE_DIR.'/en/partners/'. $_SESSION["user_id"] .'">'.SITE_DIR.'/en/partners/'. $_SESSION["user_id"] .'</a></p>';
    	echo '</div>';
    }

?>
    
</div>
<!--end content_block-->
