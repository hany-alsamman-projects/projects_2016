<?php

    if(!isset($_GET['approve'])){
        
        echo $this->lang['APPROVAL_MSG'].'</p><br><br>';
        
        echo '<a href="index.php?action=dept&approve=1&id='.$_GET['id'].'" class="greenButton">'.$this->lang['APPROVAL_BTN1'].'</a>';
        
        echo '&nbsp;&nbsp;&nbsp;&nbsp;';
        
        echo '<a href="index.php?action=dept&approve=2&id='.$_GET['id'].'" class="greenButton">'.$this->lang['APPROVAL_BTN2'].'</a>';
        
    }

?>

<?php
if(isset($_GET['approve'])){

echo '<ul id="mylinks" style=" border: 1px dotted #BBE0EB;">';

		for ($s = 0; $s < count($data); $s++) {	

            echo '<li id="'.$data[$s]['id'].'">
            		<img src="'.$data[$s]['thumbnail'].'" />
            		<a target="_blank" href="'.$data[$s]['url'].'" class="user-title">'.$data[$s]['title'].'</a>
            		<span class="addas">'.$data[$s]['desc'].'</span>
        	     </li>';
        }
echo '</ul>';

}
?>

</div>