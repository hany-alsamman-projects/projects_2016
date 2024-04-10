<?
if($_GET['done'] == 'yes'){
?>

<div class="registered">
<h1><?=$this->lang['ADDLINK_MSG_SUB']?></h3>
<h3><?=$this->lang['ADDLINK_MSG_AUTO']?></h3>
<meta http-equiv="Refresh" content="2; URL=index.php?action=usercp">
</div>

<? }else{ ?>

<div id="div-addlink" style="background-color: #282D33">

<div class="form-title"><h2><?=$this->lang[]?></h2></div>
<div class="form-sub-title"></div>

<form id="regForm" action="index.php?task=addlink" method="post">

<table>
  <tbody>
  
  <tr>
    <td><label for="url"> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="url" id="url" type="text" /></div></td>
  </tr>

  <tr>
    <td><label for="title"><?=$this->lang['ADDLINK_LABEL_TITLE']?> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="title" id="title" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="thumbnail"><?=$this->lang['ADDLINK_LABEL_DOMAIN']?> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="domain" id="domain" type="text" /><div style="margin-left:15px; margin-top: 5px;float: right;" id="Domainloading"><img src="images/ajax_loading.gif" /></div></div>

    </td>
  </tr>
    
  <tr>
    <td><label for="desc"><?=$this->lang['ADDLINK_LABEL_DESCRIPTION']?> : </label></td>
    <td><div class="input-container"> <textarea name="desc" cols="29" rows="5" maxlength="250"></textarea></div></td>
  </tr>

  <tr>
    <td><label for="member_name"><?=$this->lang['ADDLINK_LABEL_MEMBER']?> : </label></td>
    <td><div class="input-container"><input style="width: 250px" name="member_name" disabled="true" value="<?=$_SESSION['user_name']?>" id="member_name" type="text" /></div></td>
  </tr>
  
  <tr>
    <td><label for="add_by"><?=$this->lang['ADDLINK_LABEL_DEPT']?> : </label></td>
    <td><div class="input-container">
        <select name="in_dept">

            <option value="0">DEPT:</option>
                        
            <?php
            /**
             * Array ( [0] => Array ( [id] => 1 [d_name] => World today [d_type] => cat [d_active] => 1 [last_update] => 0 ) 
             */            
            for ($i = 0; $i < count($this->MyDept); $i++) {             
            	echo "<option value='".$this->MyDept[$i]['id']."'>".$this->MyDept[$i]['d_name_'.LANG_EXT.'']."</option>";                
            }
            ?>
            
        </select>
        </div>
    </td>
  </tr>
  
  <tr>
  <td>&nbsp;</td>
  <td><input id="enterdomain" type="submit" class="greenButton" value="<?=$this->lang['BTN_ENTER']?>" /><img id="loading" src="images/loading.gif" alt="<?=$this->lang['ALT_ENTER']?>.." />
</td>
  </tr>
  
  </tbody>
</table>

<input type="hidden" value="<?=$_SESSION["user_id"]?>" name="added_by" />

</form>

<div id="error">
&nbsp;
</div>

</div>

<? } ?>