<div style="width:450px;">
<ul id="mylinks">

	<?php
		
        if(!is_array($GetData) && !sizeof($GetData) > 0){
            
            echo 'ليس لديك اي طلبات في قائمة مواقعك';
        
        }else{     
            
            for ($s = 0; $s < count($GetData); $s++) {	
    		      
                $approved = ($GetData[$s]['approved'] > 0) ? '<span class="del"><a href="#" class="delete" title="حذف الطلب" id="'.$GetData[$s]['id'].'">X</a></span>' : '<span class="wait">يتم العمل على طلبك</span>';
    
                echo '<li id="list'.$GetData[$s]['id'].'">
                		'.$approved.'
                		'.$GetData[$s]['title'].'
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
            echo '<li class="prevnext"><a id="'.($back).'" href="#">Previous</a></li>';
      }

	  for ($i = 1; $i <= $count_step; $i++) {
		    $myclass = (isset($this->step) && $this->step == $i) ? "class='currentpage'" : '';
          if($this->step>=1)echo "<li><a $myclass id=\"$i\" href=\"#\">$i</a></li>";
	  }

	  if($this->step>=1 && $this->step<$count_step){
            echo '<li class="prevnext"><a id="'.($this->step+1).'" href="#">Next </a></li>';
      }

?>
</ul> 
</div>