<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "ÇáÑÌÇÁ ÚÏã ØáÈ ÇáãáÝ ãÈÇÔÑÉ";
        exit();
	}
?>

      <div id="intro">
        
        <div id="photos_board">                     
              
            <div style="width: 800px;">
       
    
				<?php                						
        				for ($s = 0; $s < count($GetDeptData); $s++) {							
        
							echo '<div id="reviews_box" class="round-corners"> 								
						        <div id="reviews_info">
						        	<div id="reviews_title"><a href="index.html?do=ShowPage&id='.$GetDeptData[$s]['tid'].'"><b>'.stripslashes($GetDeptData[$s]['t_title']).'</b></a></div>
						        	<div id="reviews_text">'.strip_tags(stripslashes($GetDeptData[$s]['t_short'])).'</div>

									<div id="reviews_email">
									<a href="index.html?do=ShowPage&id='.$GetDeptData[$s]['tid'].'"><small>more</small></a>
									</div>
								</div>
							</div>';  
        
        				}
				?>           
   
            </div>
        
        </div>            

      </div>

