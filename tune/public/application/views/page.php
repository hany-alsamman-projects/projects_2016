<?php

//                   $subcat = mysql_query("SELECT i.p_name,i.p_content,i.in_parent,i.last_update,d.id AS dept_id,
//                                          d.".$DEPT_NAME."
//                                          FROM `departments` d, `".$this->prefix_lang."_items` i WHERE i.in_parent = d.id");

				$result = mysql_query("SELECT * FROM `pages` WHERE `id` = '{$_GET['id']}'");
						
				//$DEPT_NAME = $this->prefix_lang.'_d_name';
				
				if($row = mysql_fetch_object($result)){
				    
                    
                    echo '<div>
                        
                            <span style="color: #2b5d96; font-size: 15pt;"><h1><b>'.$row->title.'</b></h1></span>
                            
                            <span style="color: #2b5d96; font-size: 10pt"><h1><b>'.$row->desc.'</b></h1></span>
                            
                            <p>'.$row->content.'</p>
                        
                        
                         </div>';                    
                  			    
                }## end dept
?>