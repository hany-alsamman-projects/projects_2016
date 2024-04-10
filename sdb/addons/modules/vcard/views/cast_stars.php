<ul>
<?php
    
    $data = $ci->vcard_m->get_cast_by_id($vid, $gid);
    
    if($data):
    
        foreach($data as $art):
        
            echo '<li class="artists"><a href="#"><img src="img/photo2.jpg" /><h4>'.$art->display_name.'</h4> </a></li>';
        
        endforeach;
    
    endif;

?>    
     
                     
</ul> 