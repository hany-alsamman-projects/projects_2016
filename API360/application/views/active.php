<?php

if($data == true){
        
print <<<EOF
        <div class="registered">
        <h1>Your account has been activated</h1>
        <h2>Now you can login</h2>
        </div>
EOF;

}else{
    
print <<<EOF
        <div class="registered">
        <h1>Your activaion link was expired OR Your account activated before</h1>
        </div>
EOF;

}

?>