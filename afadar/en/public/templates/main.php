      <div id="intro">
        <div id="photos_board">
            <div class='aviaslider' id="frontpage-slider"> 
                <div class="featured"><img src="images/banner1.jpg" /></div> 
                <div class="featured"><img src="images/banner2.jpg" /></div> 
                <div class="featured"><img src="images/banner3.jpg" /></div> 
                <div class="featured"><img src="images/banner4.jpg" /></div> 
            </div>                                           
        </div><!--end of photos_board-->
                    
          <div id="logos_board">
               <div id="slider">
			<ul>				
				<li><div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=25"><img alt="" src="images/umo.jpg" style="margin-left:18px" /></a></div>
                <div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=24"><img alt="" src="images/jesys.jpg" style="margin:18px 0 0 15px;" /></a></div>
                <div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=27"><img alt="" src="images/srs.jpg" style="margin:20px 0 0 18px;" /></a></div></li>
                <li><div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=25"><img alt="" src="images/umo.jpg" style="margin-left:18px" /></a></div>
                <div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=24"><img alt="" src="images/jesys.jpg" style="margin:18px 0 0 15px;" /></a></div>
                <div id='jeisys_bg'><a href="index.php?do=ShowProduct&id=27"><img alt="" src="images/srs.jpg" style="margin:20px 0 0 18px;" /></a></div></li>
			</ul>
            
		</div>
               
               
          </div><!--end of logos_board-->
      </div><!--end of intro -->
        <div id="dot"></div>    
        <div id="click_to_slideshow"></div>             
        <div id="how_it_works"></div>
        <div style="width: 100%;" class="clear">
            <div id="welcome_board">           
                <div id="welcome_lboard"></div>
                    <div id='welcome_logo'></div>
                    <div id="welcome_mboard">
                        <div id='welcome_board_containt'>
                             <p><?=mysql_result(mysql_query("SELECT a_content FROM `additional_pages` WHERE `id` = '1'"),0); ?></p>
                        </div>
                    </div> <!--end of welcome mboard-->               
                <div id="welcome_rboard"></div>
            </div><!--end of welcome board-->
            <div id="latest_news">
                	<div id="latest_title"><h1>NEW EVENTS</h1></div>
                    <div id="content">
                            <p>MEDerm has an infra red light + bipolar
                            radio frequency in the first hand piece ,
                            and a monopolar RF in the second 
                            bipolar radio frequency in the first hand piece
                            , and a monopolar RF in the second
                        <div style="border-bottom:dotted 2px #d98d00; padding:5px;"><br /> <h1>CUSTUMER REVIEWS</h1></div> 
                            <br />
                            Really good serivce, i can’t imagine how you make
                            something like this, i was
                            thinking it’s not possible to do something
                            like this but now i’m “HAPPY”, Thanks<br />
                            </p><br />
                        <div><img align="middle" alt="" src="images/ok-logo.png" style="float:left" /> &nbsp;Hany alsamman</div>
                    </div><!--end of content-->
             </div><!--end of latest_news-->
                  <div class="beands_photo">
                      <img src="images/feat1.jpg" />
                      <img src="images/feat2.jpg" />
                      <img src="images/feat3.jpg" />
                  </div><!--beands_photo---> 
        </div> 