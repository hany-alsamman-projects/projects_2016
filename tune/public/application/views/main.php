            <div id="welcome_board">
                <span style="color: #2b5d96; font-size: 15pt;"><?= html_entity_decode(  @mysql_result( mysql_query("SELECT `desc` FROM `pages` WHERE `type` = '2' and `lang` = '0' and `title` LIKE 'home'") ,0) ); ?></span>
                <?= html_entity_decode(  @mysql_result( mysql_query("SELECT `content` FROM `pages` WHERE `type` = '2' and `lang` = '0' and `title` LIKE 'home'") ,0) ); ?>
            </div>        
        
            <div id="back1">
            
                <div class='aviaslider' id="frontpage-slider"> 
                <?= html_entity_decode( @mysql_result( mysql_query("SELECT `content` FROM `pages` WHERE `type` = '2' and `lang` = '0' and `title` LIKE 'slider'") ,0) ); ?>
                </div>  
            
            </div>
                    
             <div id='up'><?= html_entity_decode(  @mysql_result( mysql_query("SELECT `desc` FROM `pages` WHERE `type` = '2' and `lang` = '0' and `title` LIKE 'trading terms'") ,0) ); ?></div>
             <div id='down'>
                <?= html_entity_decode(  @mysql_result( mysql_query("SELECT `content` FROM `pages` WHERE `type` = '2' and `lang` = '0' and `title` LIKE 'trading terms'") ,0) ); ?>
             </div>