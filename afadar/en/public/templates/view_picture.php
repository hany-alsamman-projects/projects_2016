<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "<h1>Incorrect access</h1>You cannot access this file directly.";
        exit();
	}
?>

<table align="center" cellpadding="0" cellspacing="0" style="width: 100%; margin-top:15px; margin-bottom:15px">
					<tr>
						<td>

						<table align="center" cellpadding="5" cellspacing="0" style="width: 98%; background-color: #FFFFFF;">
							<tr>
								<td class="style24" style="padding-left: 10px; padding-right: 10px">

								<table cellpadding="0" cellspacing="0" style="width: 100%">
									<tr>
										<td style="width: 150px; direction:rtl; text-align: left">
										<?php						
										echo '<span style="font-size: 8pt">'.date('Y/m/d G:i:s',$GetPicData[0]['insert_date']).'</span>';
										?>
										</td>
										<td dir="rtl">
										
										<?php						
										echo 'Êã ÇáÅÖÇÝÉ ÈæÇÓØÉ <b>'.$GetPicData[0]['author_name'].'</b>
:: '.$GetPicData[0]['author_email'].' ãä '.$GetPicData[0]['author_country'].'';
										?>
																			
										</td>
									</tr>
								</table>
								
								</td>
							</tr>
							<tr>
								<td class="style26" style="padding-left: 10px; text-align: center; direction:rtl; padding-right: 10px">
								<div class="ViewPic">
								<?php						
								echo '<a title="ááÊßÈíÑ ÇÖÛØ åäÇ" target="_blank" href="./uploads/'.$GetPicData[0]['pic_dept'].'/'.$GetPicData[0]['pic_short'].'"><img src="./uploads/'.$GetPicData[0]['pic_dept'].'/'.$GetPicData[0]['pic_short'].'" /></a>'
								?>
								</div>
								</td>
							</tr>
							
<tr>
						<td>

						<table cellpadding="0" cellspacing="0" style="width: 100%">
							
							<tr>
								<td class="style26">
								<br />
								<?php
									echo '<a title="ÇÖÇÝÉ ÊÚáíÞ" href="index.php?action=AddCOMMENT&id='.$GetPicData[0]['tid'].'"><img src="images/forms.gif" /></a>';

								?>			
								
								</td>
							</tr>
							
							<tr>
								<td class="style26"><img src="images/comments.jpg" /></td>
							</tr>
							<tr>
								<td>
								
								<table cellpadding="0" cellspacing="0" style="width: 100%">
									<tr>
										<td class="style26">
<?php
	if($_GET['id'] && is_numeric($_GET['id'])){
		
		$replays = mysql_query("SELECT * FROM `posts` WHERE `in_topic` = '{$_GET['id']}' and `approve` = '1'");

		if( @mysql_num_rows($replays) > 0)
		while($replay = mysql_fetch_object($replays)){
		static $i = 1;
?>										
<!-- REPLAY <?php echo $i; ?> -->										
                
<table style="width: 100%; margin-top: 15px" cellpadding="5" cellspacing="0">
	<tr>
		<td style="border-top:1px #BB3977 solid; border-bottom:1px #E6E6E6 solid; width: 30%; text-align:left">
		<span style="font-size: 8pt"><?php echo date('Y/m/d G:i:s',$replay->post_date) ?></span></td>
		<td style="border-top:1px #BB3977 solid; border-bottom:1px #E6E6E6 solid; width: 70%; text-align:right" dir="rtl">
		<?php echo parent::truncate($replay->title,90) ?></td>
	</tr>
	<tr>
		<td dir="rtl" colspan="2" style="text-align:right"><?php echo html_entity_decode(stripslashes($replay->post))?></td>
	</tr>
	<tr>
		<td  colspan="2" style="background-color: #E6E6E6; text-align:right">(<?php echo $replay->author_email; ?>) <?php echo $replay->author_name; ?></td>
	</tr>
</table>
<!-- REPLAY -->		
									
<?php
$i++;
		}
		
	}
?>								</td>
									</tr>
								</table>
								
								</td>
							</tr>
						</table>

						</td>
					</tr>
							
						</table>

						</td>
					</tr>
					
</table>