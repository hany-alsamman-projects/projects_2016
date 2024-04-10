<div style="width:450px;">
<ul id="mylinks">

	<?php
		
        if(!is_array($GetData) && !sizeof($GetData) > 0){
            
            echo 'you can do some activity and add some links to your list';
        
        }else{     
            
            for ($s = 0; $s < count($GetData); $s++) {	
    		      
                $approved = ($GetData[$s]['approved'] > 0) ? '<span class="del"><a href="#" class="delete" title="Delete this link" id="'.$GetData[$s]['id'].'">X</a></span>' : '<span class="wait">WAITING</span>';
    
                echo '<li id="list'.$GetData[$s]['id'].'">
                		<img src="'.$GetData[$s]['thumbnail'].'" /> '.$approved.'
                		<a target="_blank" href="'.$GetData[$s]['url'].'" class="user-title">'.$GetData[$s]['title'].'</a>
                		<span class="addas">'.$GetData[$s]['desc'].'</span>
            	     </li>';
            }## end for
            
        }
    ?>	
	
</ul>

<ul id="pagination-links">

<?php

      if($this->step > 1){
            $back = ( ($this->step) < $count_step ? ($this->step+1) : ($this->step-1) );            
            echo '<li class="prevnext"><a id="'.($back).'" href="#">«Previous</a></li>';
      }

	  for ($i = 1; $i <= $count_step; $i++) {
		    $myclass = (isset($this->step) && $this->step == $i) ? "class='currentpage'" : '';           
			echo "<li><a $myclass id=\"$i\" href=\"#\">$i</a></li>";
	  }

	  if($this->step>=1 && $this->step<$count_step){            
            echo '<li class="prevnext"><a id="'.($this->step+1).'" href="#">Next »</a></li>';
      }

?>
</ul> 
</div>