<div id="box1" class="box box-60"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>Show License</h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td class="tc first">ID</td>
                                                <td class="tc">Domain</td>
												<th>System License</th>
                                                <td>User License</td>
												<td class="tc last">Actions</td>
											</tr>
										</thead>

										<tbody>
<?php

$result = mysql_query("SELECT * FROM `license` ORDER BY id DESC") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);
    
    $i = 1;
    
    while($row = mysql_fetch_object($result)){

        $class = ($i == 1) ? 'class="first"' : '';
        $lastupdate = date("j-m-Y",$row->last_update);
											
print <<<EOF

                                            <tr $class>
												<td class="tc first"><a class="ico-comms" href="#">$i</a></td>
												<td class="tc"><span class="tag tag-gray">$row->domain</span></td>
												<th>$row->gkey</th>
												<td>$row->ukey</td>
												<td class="tc last">
													<ul class="actions">
														<li><a class="ico" href="index.php?section=RemoveLicense&id=$row->id" title="Remove"><img src="images/delete.png" alt="delete"></a></li>
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