<div id="box1" class="box box-75"><!-- box full-width -->
    <div class="boxin">
        <div class="header">
            <h3>Show Virtual Tour Places</h3>
        </div>
        <div id="box1-tabular" class="content"><!-- content box 1 for tab switching -->
            <fieldset>
                <table cellspacing="0">

                    <thead><!-- universal table heading -->
                    <tr>
                        <td class="first">Full Name</td>
                        <th>Requested By</th>
                        <th>Place name</th>
                        <td>Place link</td>
                        <td>Plan name</td>
                        <td class="tc">Gmap</td>
                        <td class="tc last">Actions</td>
                    </tr>
                    </thead>

                    <tbody>
                    <?php

                        $Campagin= "and `campaign_place` != '1'";
                        if($_GET['Campagin'] == '1'){
                            $Campagin = "and `campaign_place` = '1' ";
                        }
                    $result = mysql_query("SELECT * FROM `tour_requests` where `approved` = '1' $Campagin ORDER BY active_date DESC") or parent::_debug(mysql_error(),__CLASS__,"MYSQL ERROR ON LINE ". __LINE__);

                    $i = 1;

                    while($row = mysql_fetch_object($result)){

                        $class = ($i == 1) ? 'class="first"' : '';
                        //https://maps.google.com.eg/maps?q=33.525941,-7.599106&num=1&t=m&z=11
                        $account_owner = @mysql_result( mysql_query("SELECT name FROM `members` where `id` = {$row->account_id}") ,0 );

                        print <<<EOF

                                            <tr $class>
												<td class="tc first">$row->name $row->last_name</td>
												<th>$account_owner</th>
												<td>$row->place_name</td>
												<td class="tc">$row->place_link</td>
												<td class="tc">$row->plan_name</td>
                                                <td class="tc"><a target="_blank" href="https://maps.google.com.eg/maps?q=$row->latitude,$row->longitude&num=1&t=m&z=11">link</a></span></td>
												<td class="tc last">
													<ul class="actions">
														<li><a class="ico" href="index.php?section=RemoveVtREQ&id=$row->id" title="Remove"><img src="images/delete.png" alt="delete"></a></li>
														<li><a class="ico" href="index.php?section=EditPlace&id=$row->id" title="edit"><img src="images/h-ico/edit.png" alt="edit"></a></li>
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