<div id="box1" class="box box-60"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Show Members</h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td class="tc first">ID</td>
												<th>First Name</th>
												<td>Creation date</td>
												<td class="tc">City</td>
                                                <td class="tc">Gmap</td>
												<td class="tc last">Actions</td>
											</tr>
										</thead>

										<tbody>
<?php

if (!isset($_GET['think'])) $where = "WHERE `activated` = '1'"; else $where = "WHERE `activated` = '0'";

$result = mysql_query("SELECT * FROM `members` $where ORDER BY group_id") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

    $i = 1;
    
    while($row = mysql_fetch_object($result)){
                                    		
    	if($row->d_active == 1){
    		$show = 'Visible';
    	}else{
    		$show = 'Unvisible';
    	}
        
        $class = ($i == 1) ? 'class="first"' : '';
        //https://maps.google.com.eg/maps?q=33.525941,-7.599106&num=1&t=m&z=11
        $city_id = @mysql_result( mysql_query("SELECT d_name_en FROM `departments` where `id` = {$row->city}") ,0 );

print <<<EOF

                                            <tr $class>
												<td class="tc first"><a class="ico-comms" href="#">$i</a></td>
												<th>$row->name</th>
												<td>$row->action_time</td>
												<td class="tc">$city_id</td>
                                                <td class="tc"><a target="_blank" href="https://maps.google.com.eg/maps?q=$row->gmap&num=1&t=m&z=11">link</a></span></td>
												<td class="tc last">
													<ul class="actions">
                                                    <li><a class="ico" href="index.php?section=ActiveMember&id=$row->id" title="active"><img src="images/led-ico/accept.png" alt="active"></a></li>
                                                    <li><a class="ico" href="index.php?section=EditMember&id=$row->id" title="edit"><img src="images/h-ico/edit.png" alt="edit"></a></li>
														<li><a class="ico" href="index.php?section=RemoveMember&id=$row->id" title="Remove"><img src="images/delete.png" alt="delete"></a></li>
													</ul>
												</td>
											</tr>
                                            
EOF;

        $i++;
    }

?>                                                      
										</tbody>
									</table>
								</fieldset>
						</div><!-- .content#box-1-holder -->
                </div>
</div>