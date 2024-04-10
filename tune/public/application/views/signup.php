<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1>You  have been registered successfully. Thank you for opening a new account with  Tune Forex</h1>
<br />
<h2><p>
  Please  check your e-mail box for activation e-mail. If you are not able to locate the  e-mail make sure it is not in your junk folder then contact live support. &nbsp;<br />
  Once  your account has been activated you will be contacted shortly by one of our  sales representatives via e-mail to provide you with your Tune Trader account  number and password.<br />
  After  receiving your Tune Trader account number you may deposit via your client  cabinet and start trading using our leading MetaTrader based platform Tune  Trader.<br />
  If  you have registered for an IB account your unique tracking link will be located  inside your cabinet.</p></h2>
</div>

<? }elseif($_GET['active'] == '1'){ ?>

<div class="registered">
<h1>You have been registered successfully. Thank you for opening a new account with Tune Forex. </h1>
<p>
Please check your e-mail box for activation e-mail. If you are not able to locate the e-mail make sure it is not in your junk folder then contact live support.  
Once your account has been activated you will be contacted shortly by one of our sales representatives via e-mail to provide you with your Tune Trader account number and password.
After receiving your Tune Trader account number you may deposit via your client cabinet and start trading using our leading MetaTrader based platform Tune Trader.
If you have registered for an IB account your unique tracking link will be located inside your cabinet.
<h2><a href="https://www.tune-forex.com/en/index.php?action=login">Click Here to Login</a></h2>
</p>
</div>

<? }else{ ?>


<div id="div-regForm">

<div class="form-title"><? print $this->lang['SIGNUP_LABEL_TITLE']?></div>
<div class="form-sub-title"><? print $this->lang['SIGNUP_LABEL_ALT']?></div>


                    <form id="regForm" action="public/home.php?task=signup" method="post">
                    
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
                                <option value="Micro">
                                Micro
                                </option>
                                <option value="Extra">
                                Extra
                                </option>
                                <option value="Ultimate">
                                Ultimate
                                </option>
                                <option value="IB">
                                
                                IB
                                </option>
                                <option value="Golden Label">
                                Golden Label
                                </option>
                                <option value="Partner lead">
                                Partner lead
                                </option>
                                <option value="Client lead">
                                Client lead
                                </option>
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
                      <td><input type="submit" class="greenButton" value="<?=$this->lang['SIGNUP_LABEL_TITLE']?>" /><div style="float: right;"><img id="loading" src="images/reg-loader.gif" alt="working.." /><span></span></div></td>
                      </tr>                      
                      
                      </tbody>
                    </table>
                    <input type="hidden" name="nationality" id="fixed_nat"/>
                    <?php
                        echo '<input type="hidden" name="assignedto" id="'.$_GET['partner'].'"/>'
                    ?>
                    </form>
                    
                    <div class="msg msg-error" id="error"><p></p></div>
                    </div>


<? } ?>