<div id="box1" class="box box-50"><!-- box full-width -->
					<div class="boxin">
						<div class="header">
							<h3>��� �������� <?=$active_title = (isset($_GET['think'])) ? '(<small>����� �������</small>)' : null;?></h3>
						</div>
						<div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
								<fieldset>
									<table cellspacing="0">
										
                                        <thead><!-- universal table heading -->
											<tr>
												<td class="tc first">�����</td>
												<td>��� ��������</td>
												<td>����� �������</td>
												<td class="tc">��������</td>
                                                <td class="tc">������</td>
												<td class="tc last">��������</td>
											</tr>
										</thead>

										<tbody>
<?php

$where =  (!isset($_GET['think'])) ? "WHERE `approve` = '1'" : "WHERE `activated` = '0' OR `approve` = '0'";

$result = mysql_query("SELECT * FROM `accounts` $where ORDER BY group_id") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

    $i = 1;
    
    while($row = mysql_fetch_object($result)){
                                    		
        
        $class = ($i == 1) ? 'class="first"' : '';
        $signin = date("j-m-Y",$row->action_time);
        
		if($row->group_id == 1){
			$mod_name = '����';
		}elseif($row->group_id == 2){
			$mod_name = '���� ���';
		}elseif($row->group_id == 3){
			$mod_name = '����';
		}elseif($row->group_id == 4){
			$mod_name = '����';
		}elseif($row->group_id == 5){
			$mod_name = '�����';
		}
        
        $row->creation_date = date("j-m-Y, g:i a",$row->creation_date);
        
        $active_btn = (isset($_GET['think'])) ? '<li><a class="ico" href="index.php?section=ActiveAccount&id='.$row->id.'" title="�����"><img src="images/admin/led-ico/accept.png" alt="�����"></a></li>' : null;
        
											
print <<<EOF

                                            <tr $class>
												<td class="tc first">$i</td>
												<td>$row->user_name</td>
												<td>$row->creation_date</td>
												<td class="tc"><img src="images/admin/$row->group_id.png" /> $mod_name</td>
                                                <td class="tc">$row->phone</td>
												<td class="tc last">
													<ul class="actions">
                                                        $active_btn
                                                        <li><a class="ico" href="index.php?section=EditAccount&id=$row->id" title="�����"><img src="images/admin/edit.png" alt="�����"></a></li>
														<li><a class="ico" href="index.php?section=RemoveAccount&id=$row->id" title="���"><img src="images/admin/led-ico/cross_octagon.png" alt="���"></a></li>
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