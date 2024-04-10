<?php

			$q = mysql_query("SELECT * FROM `additional_pages` WHERE `in_class` = '1'");
			
            echo '<span class="main_link">гд“бн</span>
                  <ul>';
                  	
			while($row = mysql_fetch_object($q)){
		
			echo '
			<li><a href="index.html?do=ShowCat&id='.$row->id.'" rel="container"><b>'.$row->a_name.'</b></a></li>
			';
			}
            
            echo '</ul>';
?>