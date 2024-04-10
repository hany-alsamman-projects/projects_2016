<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "ÇáÑÌÇÁ ÚÏã ØáÈ ÇáãáÝ ãÈÇÔÑÉ";
        exit();
	}
?>

<?php
echo '<table align="center" cellpadding="0" cellspacing="0" style="margin-top: 10px; margin-bottom: 10px; text-align: left; width: 95%"><tr>
										<td style="width: 16px">
										<a href="index.html?do=ShowCat&id='.$_GET['id'].'"><img alt="" height="16" src="images/resultset_first.png" width="16" /></a></td>
										<td style="width: 16px">';
								
								if($this->step>1){
								
								echo '<a href="index.html?do=ShowCat&id='.$_GET['id'].'&step='.($this->step-1).'"><img alt="" height="16" src="images/resultset_previous.png" width="16" /></a>';
									
								}else{
								
								echo '<img alt="" height="16" src="images/resultset_previous.png" width="16" />';
								
								}
										
								echo '</td><td style="width: 511px">';
									  
										for ($i = 1; $i <= $count_step; $i++) {
										    $sep = ($i<$count_step) ? ' , ' : '';
										    $page = (isset($this->step) && $this->step == $i) ? "<i>$i</i>" : $i;
											echo "<a class='style24' href=\"index.html?do=ShowCat&id=$_GET[id]&step=$i\">$page</a>".$sep;
										}
										
								echo '</td><td style="width: 16px">';
								
								if($this->step>0){
								
								$next = ( ($this->step+1) <= $count_step ? ($this->step+1) : $this->step);
								
								echo '<a href="index.html?do=ShowCat&id='.$_GET['id'].'&step='.($next).'"><img alt="" height="16" src="images/resultset_next.png" width="16" /></a>';
								
								}else{
								
								echo '<img alt="" height="16" src="images/resultset_next.png" width="16" />';
								
								}
										
								echo '</td><td style="width: 16px">
										<a href="index.html?do=ShowCat&id='.$_GET['id'].'&step='.$count_step.'"><img alt="" height="16" src="images/resultset_last.png" width="16" /></a></td>
									</tr>
									
									</table>';
?>


<div class="clear" style="float:left; padding: 15px"><a title="ÇáÑÌæÚ" href="javascript: history.go(-1)"><img alt="ÇáÑÌæÚ" src="images/back_page.png" /></a>&nbsp;&nbsp;&nbsp;<a title="ØÈÇÚÉ ÇáÕÝÍÉ" href="javascript: PrintPage()"><img alt="ØÈÇÚÉ ÇáÕÝÍÉ" src="images/print_page.png" /></a></div>