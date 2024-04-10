<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "ÇáÑÌÇÁ ÚÏã ØáÈ ÇáãáÝ ãÈÇÔÑÉ";
        exit();
	}
?>
<div id="boarder_inside">
	
    <div id="boarder_inside_l">
		<div id="events_inside">
		</div>
	</div>
    
	<div id="boarder_inside_m">
                        
            <div id="product_title">
    			<p><font class="floatLeft" color="#666666"><b><?=stripslashes($GetTopicData[0]['t_title'])?></b>
    			</font></p>
    			<br />
    			<div class="clear" style="width: 100%; margin-top: 10px; text-align: left; ">
    				<?=html_entity_decode(stripslashes($GetTopicData[0]['t_content']))?>
    			</div>
    		</div>
              
            
			<div id="atatch_insid">
				<div id="print_atatch_insid">
					<div style="width: 83px; float: right; margin: 10px 0px 0px 0px;">
						<a title="Print Page" href="index.html?get=PrintPage&id=<?php echo $GetTopicData[0]['tid'] ?>">Print Page</a><br />
                        safety</div>
				</div>
                
				<div id="back_insid">
					<div style="width: 83px; float: right; margin: 10px 0px 0px 0px;">
						<a title="back" href="javascript: history.go(-1)">Quick</a><br />
                        back</div>
				</div>
			</div>
     
    
	</div>
    
	<div id="boarder_inside_r">
	</div>
</div>
<!--end boarder inside-->		