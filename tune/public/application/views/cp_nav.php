<div id="blog" class="register">                
    <div id="btop"><div id="bleft"></div><div id="btitle"><h1><b><? print $this->lang['LABEL_CONTROL_PANEL']?></b></h1></div><div id="bright"></div></div>
    <div id="blog_sub"><? print $this->lang['LABEL_WELCOME']?></div>
    
    <div id="bcontent">
    
        <div style="margin: 15px auto 15px 15px;">
                    
            <h2>Hello, <b><?=$_SESSION['user_name']?></b></h2>
            
            <a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=usercp&pro=profile"><h2><?=$this->lang['USERCP_LABEL_PROFILE']?></h2></a>
            <a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=usercp&pro=password"><h2><?=$this->lang['USERCP_LABEL_CHPASS']?></h2></a> 
            <!--
<a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=usercp&pro=picture"><h2><?=$this->lang['USERCP_LABEL_CHPIC']?></h2></a>
-->
            <a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=usercp&pro=MoneyDeposit"><h2><?=$this->lang['USERCP_LABEL_ADD']?></h2></a>
            <a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=usercp&pro=FundsWithdrawal"><h2><?=$this->lang['USERCP_LABEL_WITH']?></h2></a>
            <a href="<?=SITE_DIR.'/'.LANG_EXT.'/'?>index.php?action=logout"><h2><?=$this->lang['BTN_LOGOUT']?></h2></a>

        </div>

    </div>
    
    <div id="bbottom"></div>
                
</div><!-- end blog register-->  