<div id="box1" class="box box-70"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Show <?=$_GET['think']?> website</h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td class="tc first">ID</td>
												<td>Site Domain</td>
                                                <td>Site title</td>
												<td>Added Time</td>
												<td class="tc">Added By</td>
												<td style="width: 100px;" class="tc last">Actions</td>
											</tr>
										</thead>

										<tbody>
<?php

if (isset($_GET['think'])) $where = "WHERE `approved` = '0'"; else $where = "WHERE `approved` = '1'";

$result = mysql_query("SELECT * FROM `links` $where ORDER BY added_time") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
    
    $i = 1;
    
    while($row = mysql_fetch_object($result)){
                                    		
    	if($row->d_active == 1){
    		$show = 'Visible';
    	}else{
    		$show = 'Unvisible';
    	}
        
        $class = ($i == 1) ? 'class="first"' : '';
        $approved = ($row->approved == 1) ? 'class="first"' : '';
        $added_time = date("h - i , j-m-Y",$row->added_time);
        $added_by = mysql_result( mysql_query("SELECT name FROM `members` WHERE `id` = '{$row->added_by}' ") , 0);

print '                                      <tr '.$class.'>
												<td class="tc first"><a class="ico-comms" href="#">'.$i.'</a></td>
												<td>'.$row->domain.'</td>
                                                <td>'.$row->desc.'</td>
												<td>'.$added_time.'</td>
												<td class="tc">'.$added_by.'</td>
												<td class="tc last">
													<ul class="actions">';
                                                
                                                if($row->approved == 2){
                                                    print '<li><a class="ico" href="#" title="Approved and Published"><img src="images/led-ico/exclamation.png" alt="Approved and Published"></a></li>';
                                                    print '<li><a class="ico" href="index.php?section=ChangeLink&id='.$row->id.'" title="Disable"><img src="images/deactive.png" alt="Disable"></a></li>';
                                                }													
                                                    
                                                if($row->approved == 1){
                                                    print '<li><a class="ico" href="index.php?section=ApproveLink&id='.$row->id.'" title="Approve"><img src="images/accept.png" alt="Approve"></a></li>';
                                                    print '<li><a class="ico" href="index.php?section=ChangeLink&id='.$row->id.'" title="Disable"><img src="images/deactive.png" alt="Disable"></a></li>';
                                                }
                                                                                                        
                                                 if($row->approved == 0){
                                                    print '<li><a class="ico" href="index.php?section=ChangeLink&id='.$row->id.'" title="Enable"><img src="images/active.png" alt="Enable"></a></li>';
                                                 }
                                                    
                                                    //print '<li><a class="ico" href="index.php?section=EditLink&id='.$row->id.'" title="edit"><img src="images/pencil.png" alt="edit"></a></li>';
													print '<li><a class="ico" href="index.php?section=RemoveLink&id='.$row->id.'" title="Remove"><img src="images/delete.png" alt="delete"></a></li>';

print '												</ul>
												</td>
											</tr>';
                                            

        $i++;
}

?>                                                      
										</tbody>
									</table>
								</fieldset>
						</div><!-- .content#box-1-holder -->
                </div>
</div>
