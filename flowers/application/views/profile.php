<script type="text/javascript">

// set country manual
$(document).ready(function() {
        var myflag = '<?=$this->ProfileData['nationality']?>';
		var src = 'images/flags/'+myflag.toLowerCase()+'.gif';
		$('#ac_country').css('backgroundImage', 'url(' + src + ')');
        $('#ac_country').attr('value','<?=$this->countries[$this->ProfileData['nationality']]?>');
        $('#fixed_nat').val('<?=$this->ProfileData['nationality']?>');
        //alert($('#fixed_nat').attr('value'));
});
	
</script>


<div>

<a href="index.php?action=usercp&pro=profile"><span><?=$this->lang['USERCP_LABEL_CHPRO']?></span></a> -- 
<a href="index.php?action=usercp&pro=password"><span><?=$this->lang['USERCP_LABEL_CHPASS']?></span></a> -- 
<a href="index.php?action=usercp&pro=picture"><span><?=$this->lang['USERCP_LABEL_CHPIC']?></span></a>

</div>

<div id="div-regForm">

<?
/**
 * Array ( [id] => 1 [name] => hany [password] => 202cb962ac59075b964b07152d234b70 [age] => 11 [nationality] => damas [gender] => male [picture] => [email] => hany@syria-news.com [activated] => 1 [action_time] => 1279703115 [last_ip] => [session_life] => [attempt] => 10 [group_id] => 1 ) 
 */
?>


<div class="form-title"><?=$this->ProfileData['name']?></div>
<div class="form-sub-title"><?=$this->lang['PROFILE_LABEL_TITLE']?></div>

<form id="regForm" action="index.php?task=changeprofile" method="post">

<table style="line-height: 35px;">
  <tbody>
  
  <tr>
    <td><label for="name"><?=$this->lang['PROFILE_LABEL_NAME']?>:</label></td>
    <td><div class="input-container"><input value="<?=$this->ProfileData['name']?>" name="name" id="name" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="email"><?=$this->lang['PROFILE_LABEL_EMAIL']?>:</label></td>
    <td><div class="input-container"><input disabled="true" value="<?=$this->ProfileData['email']?>" name="email" id="email" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="lname"><?=$this->lang['PROFILE_LABEL_NAT']?>:</label></td>
    <td><div class="input-container"><input name="pre_nationality" id="ac_country" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="account-type"><?=$this->lang['PROFILE_LABEL_TYPE']?>:</label></td>
    <td>
    <div class="input-container">
    <select name="group_id" id="type-select">
    <option value="0">Select type:</option>
    <?php
		if($this->ProfileData['group_id'] == 1){
    		echo "<option value='1' selected>Member</option>";
            echo "<option value='2'>Company</option>";
		
        }elseif($this->ProfileData['group_id'] == 2){
    		echo "<option value='1'>Member</option>";
            echo "<option value='2' selected>Company</option>";
            
        }elseif($this->ProfileData['group_id'] == 3){
    		echo "<option value='3' selected>Mod</option>"; 
        
        }elseif($this->ProfileData['group_id'] == 4){
    		echo "<option value='4' selected>Admin</option>";
                    
		}
    ?>    
    </select>
    </div>    
    </td>
  </tr>
  
  <tr>
    <td><label for="sex-select"><?=$this->lang['PROFILE_LABEL_GENDER']?>:</label></td>
    <td>
    <div class="input-container">
    <select name="gender" id="sex-select">
    <option value="0"><?=$this->lang['SIGNUP_SEX_1']?>:</option>
    
    <?php
		if($this->ProfileData['gender'] == 1){
    		echo "<option value='1' selected>".$this->lang['SIGNUP_SEX_2']."</option>";
            echo "<option value='2'>".$this->lang['SIGNUP_SEX_3']."</option>";
		}else{
    		echo "<option value='1'>".$this->lang['SIGNUP_SEX_2']."</option>";
    		echo "<option value='2' selected>".$this->lang['SIGNUP_SEX_3']."</option>";
		}
    ?>
    </select>
    </div>
    </td>
  </tr>
  
  <tr>
    <td><label><?=$this->lang['PROFILE_LABEL_BIR']?>:</label></td>
    <td>
    
    <div class="input-container">
    
    <?
        $user_month = date('n',$this->ProfileData['age']);
        $user_day = date('j',$this->ProfileData['age']);
        $user_year = date('Y',$this->ProfileData['age']); 

        ##echo $user_month.'|'.$user_day.'|'.$user_year;   
    ?>
    
    
    <select name="month"><option value="0"><?=$this->lang['SIGNUP_MONTH']?>:</option><?=FUNCTIONS::generate_options(1,12,true,$user_month)?></select>
    <select name="day"><option value="0"><?=$this->lang['SIGNUP_DAY']?>:</option><?=FUNCTIONS::generate_options(1,31,false,$user_day)?></select>
	<select name="year"><option value="0"><?=$this->lang['SIGNUP_YEAR']?>:</option><?=FUNCTIONS::generate_options(date('Y'),1900,false,$user_year)?></select>
    </div>
    
    </td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td>
  <input type="hidden" name="nationality" id="fixed_nat"/>
  <input type="submit" class="greenButton" value="<?=$this->lang['BTN_CHANGE']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?> .." />
</td>
  </tr>  
  
  </tbody>
</table>

</form>

<div id="error">
&nbsp;
</div>

</div>