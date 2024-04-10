<?php

if( LOGIN::CHECK_PARTNER() ) {
print <<<EOF
<script>

$(document).ready(function(){
    
    $('html, body').animate({scrollTop: $(".register").offset().top}, 1500);
    $('#name').focus();
  
});
</script>
EOF;
}
?>
            
            <div id="blog" class="register">                
                <div id="btop"><div id="bleft"></div><div id="btitle"><? print $this->lang['SIGNUP_mainsign']?></div><div id="bright"></div></div>
                <div id="blog_sub"><? print $this->lang['SIGNUP_realaccount']?></div>
                
                <div id="bcontent">    

<div id="div-regForm">

                    <form id="regForm" action="/public/home.php?task=signup" method="post">
                    
                    <table>
                      <tbody>
                      <tr>
                        <td><label for="fname"><?=$this->lang['SIGNUP_LABEL_NAME']?>:</label><div class="input-container"><input name="name" id="name" type="text" /></div></td>
                      </tr>
                      
                      <tr>
                        <td><label><?=$this->lang['SIGNUP_LABEL_NAT']?>:</label><div class="input-container clear"><input style="width: 158px" name="pre_nationality" id="ac_country" type="text" /></div></td>
                      </tr>
                                            
                      <tr>
                        <td><label for="email"><?=$this->lang['SIGNUP_LABEL_EMAIL']?>:</label><div class="input-container"><input name="email" id="email" type="text" /></div></td>
                      </tr>
                      
                      <tr>
                        <td><label for="address"><?=$this->lang['SIGNUP_LABEL_PHONE']?>:</label><div class="input-container"><input name="phone" id="phone" type="text" /></div></td>
                      </tr>
                      
                      <tr>
                        <td><label for="pass"><?=$this->lang['SIGNUP_LABEL_PASS']?>:</label>
                        <div class="input-container"><input name="password" id="pass" type="password" /></div>
                            <div id="iSM">
                            	<ul class="weak">
                            		<li id="iWeak"><?=$this->lang['SIGNUP_PASS_WEAK']?></li>
                            		<li id="iMedium"><?=$this->lang['SIGNUP_PASS_MEDIUM']?></li>
                            		<li id="iStrong"><?=$this->lang['SIGNUP_PASS_STRONG']?></li>
                            	</ul>
                            </div>
                        </td>
                      </tr>
                                                                 
                      <tr>
                        <td>
                        <label><?=$this->lang['SIGNUP_LABEL_BRITHDAY']?>:</label>
                        <div class="input-container clear">
                        <select name="month"><option value="0"><?=$this->lang['SIGNUP_MONTH']?>:</option><?=FUNCTIONS::generate_options(1,12,true)?></select>
                        <select name="day"><option value="0"><?=$this->lang['SIGNUP_DAY']?>:</option><?=FUNCTIONS::generate_options(1,31)?></select>
                    	<select name="year"><option value="0"><?=$this->lang['SIGNUP_YEAR']?>:</option><?=FUNCTIONS::generate_options(date('Y'),1900)?></select>
                        </div>
                        </td>
                      </tr>
                      
                      <tr>      
                        <td>
                        <label for="account-type"><?=$this->lang['SIGNUP_LABEL_TYPE']?>:</label>
                            <div class="input-container">
                            <select name="account">
<?php

                                foreach($this->AccountTypes AS $type => $status){
                                    if( isset($_GET['in_partners']) && $_GET['in_partners'] == 'true'){
                                        if($type == 'IB')
                                        echo '<option value="'.$type.'">'.$type.'</option>';
                                    }else{
                                        if($type != 'IB')
                                        echo '<option value="'.$type.'">'.$type.'</option>';
                                    }
                                    
                                }
?>
                            </select>
                            </div>
                        </td>
                      </tr>
                      
                      <tr>      
                        <td>
                        <img src="library/captcha/captcha.php" id="captcha" />
                        <div class="input-container"><input type="text" name="captcha" id="captcha-form" /><br /><a href="#" onclick="document.getElementById('captcha').src='library/captcha/captcha.php?'+Math.random(); document.getElementById('captcha-form').focus(); return false" id="change-image"><small><?=$this->lang['SIGNUP_LABEL_CAPTCHA']?></small></a></div>
                        </td>
                      </tr>
                      
                      <tr>      
                        <td>
                        <div class="input-container"><input name="terms" id="terms" type="checkbox" /> <a href="/en/index.php?task=page&id=35" rel="facebox"><? print $this->lang['SIGNUP_terms']?></a></div>
                        </td>
                      </tr>
                      
                      <tr>
                      <td><input type="submit" class="greenButton" value="<?=$this->lang['SIGNUP_LABEL_TITLE']?>" /><div style="float: right;"><img id="loading" src="images/reg-loader.gif" alt="working.." /><span></span></div></td>
                      </tr>                      
                      
                      </tbody>
                    </table>
                    
<?php

                    if( LOGIN::CHECK_PARTNER() ){
                    echo '<input type="hidden" name="partner" id="partner" value="'.$_GET['partner'].'"/>';
                    }
?>                    
                    
                    <input type="hidden" name="nationality" id="fixed_nat"/>
                    
                    
                    </form>
                    
                    <div class="msg msg-error" id="error"><p></p></div>
                    </div>
                    
                </div>
                
                <div id="bbottom"></div>
                            
            </div><!-- end blog register-->  