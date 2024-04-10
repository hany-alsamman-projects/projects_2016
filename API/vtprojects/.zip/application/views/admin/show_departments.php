<div id="box1" class="box box-60"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Show Departments</h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td class="tc first">ID</td>
												<td class="tc">Type</td>
												<th>City Name</th>
												<td>Last update</td>
												<td class="tc">Visibility</td>
												<td class="tc last">Actions</td>
											</tr>
										</thead>

										<tbody>
<?php

$result = mysql_query("SELECT * FROM `departments` ORDER BY id DESC") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);    
    
    $i = 1;
    
    while($row = mysql_fetch_object($result)){
                                    		
    	if($row->d_active == 1){
    		$show = 'Visible';
    	}else{
    		$show = 'Unvisible';
    	}
        
        $class = ($i == 1) ? 'class="first"' : '';
        //$lastupdate = date("j-m-Y",$row->last_update);

print <<<EOF

                                            <tr $class>
												<td class="tc first"><a class="ico-comms" href="#">$i</a></td>
												<td class="tc"><span class="tag tag-gray">$row->d_type</span></td>
												<th><a target="_blank" href="../index.php?action=dept&id=$row->id">$row->d_name_en</a></th>
												<td>$row->last_update</td>
												<td class="tc">$show</td>
												<td class="tc last">
													<ul class="actions">
														<li><a class="ico" href="index.php?section=EditDepartment&id=$row->id" title="edit"><img src="images/pencil.png" alt="edit"></a></li>
														<li><a class="ico" href="index.php?section=RemoveDepartment&id=$row->id" title="Remove"><img src="images/delete.png" alt="delete"></a></li>
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