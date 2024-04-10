                <div class="box box-50">
					<div class="boxin">
						<div class="header">
							<h3>«·„‰ Ã« </h3>
	<!--
						<a class="button" href="index.php?section=">Full View&nbsp;ª</a>
-->

						</div>
						<div class="content">
							<form class="plain" action="" method="post" enctype="multipart/form-data">
								<fieldset>
									<div class="grid"><!-- grid view -->
                                    
                                    <div class="line even firstline">
										
<?php

            /**
             *  
             */

			$c = mysql_query("SELECT * FROM `ar_products` ORDER BY id DESC");
			
			$i=0; 
            	
			while($row = mysql_fetch_object($c)){
                
                $dept_name = @mysql_result( mysql_query("SELECT d_name FROM `departments` WHERE `id` = '{$row->in_dept}'") , 0) or die(mysql_error());
				
    			$lastline_start = ($i == 2) ? '</div><!-- end firstline --><div class="line lastline">' : '';
                $lastline_end = ($i == 3) ? '</div><!-- end lastline -->' : '';
                $added_time = date("F j, Y",$row->last_update);       
                //$thumbnail = ( parent::is_url($row->prodcut_picture) ) ? $row->prodcut_picture : "../upload/$row->prodcut_picture";  
                $thumbnail = "http://www.amc-syria.com/upload/$row->prodcut_picture";
                    
//                print '<!--Box Content '.$i.' element -->
//                <DIV id="mymenu'.$row->id.'" class="message" style="position:absolute; visibility: hidden; text-align:center; width: 300px; margin: 100px 170px; padding: 1px;">
//    			        <ul class="first-of-type">
//    			            <li><a href="index.php?section=EditItem&lang=en&id='.$row->id.'">English</a></li>
//    			            <li><a href="index.php?section=EditItem&lang=ar&id='.$row->id.'">Arabic</a></li>
//    			        </ul> 
//                </DIV>';
                
print <<<EOF
                                        $lastline_start
											<div class="item">
												<div class="inner">
													<a class="thumb" href="#"><img src="$thumbnail" alt=""></a>
													<div class="data">
														<h4><a target="_blank" href="$row->url">$row->prodcut_name</a></h4>
														<div class="meta">$added_time</div>
														<ul class="actions">
                                                        
															<li><a class="ico" href="index.php?section=EditItem&lang=ar&id=$row->id" title=" ⁄œÌ·"><img src="images/admin/pencil.png" alt="edit"></a></li>
															<li><a class="ico" href="index.php?section=DeleteItem&id=$row->id" title="Õ–›"><img src="images/admin/delete.png" alt="delete"></a></li>
														</ul>
													</div>
												</div>
											</div><!-- end item -->
                                        $lastline_end
EOF;
        
                $i++;
                
                }
?>
                                        
									</div><!-- end grid view -->
								</fieldset>
							</form>
						</div>
					</div>
				</div>