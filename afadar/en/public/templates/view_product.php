<link href="css/showcase.css" rel="stylesheet" />

<script src="js/jquery.popupWindow.js" type="text/javascript"></script>

<script src="js/jquery.aw-showcase.js" type="text/javascript"></script>
<script type="text/javascript">

$(document).ready(function()
{
	$("#showcase").awShowcase(
	{
		content_width:			840,
		content_height:			470,
		fit_to_parent:			false,
		auto:					false,
		interval:				3000,
		continuous:				false,
		loading:				true,
		tooltip_width:			200,
		tooltip_icon_width:		32,
		tooltip_icon_height:	32,
		tooltip_offsetx:		18,
		tooltip_offsety:		0,
		arrows:					true,
		buttons:				true,
		btn_numbers:			false,
		keybord_keys:			true,
		mousetrace:				false, /* Trace x and y coordinates for the mouse */
		pauseonover:			true,
		stoponclick:			true,
		transition:				'hslide', /* hslide/vslide/fade */
		transition_delay:		10,
		transition_speed:		800,
		show_caption:			'onhover', /* onload/onhover/show */
		thumbnails:				true,
		thumbnails_position:	'outside-last', /* outside-last/outside-first/inside-last/inside-first */
		thumbnails_direction:	'horizontal', /* vertical/horizontal */
		thumbnails_slidex:		1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
		dynamic_height:			false, /* For dynamic height to work in webkit you need to set the width and height of images in the source. Usually works to only set the dimension of the first slide in the showcase. */
		speed_change:			false, /* Set to true to prevent users from swithing more then one slide at once. */
		viewline:				false /* If set to true content_width, thumbnails, transition and dynamic_height will be disabled. As for dynamic height you need to set the width and height of images in the source. */
	});
    
    $('.gallery').live('click', function(){
        $(this).popupWindow({ 
        centerBrowser:1,
        height:400, 
        width:600, 
        top:50, 
        left:50 
        });
        return false;
    }); 
    
});

</script>
<div id="boarder_inside">
	
    <div id="boarder_inside_l">
		<div id="welcome_logo_inside">
		</div>
	</div>
    
	<div id="boarder_inside_m">
		
        <div id="showcase" class="showcase">
<?php

foreach($myData as $GetData){

print <<<EOF

            <div class="showcase-slide">
				<div class="showcase-content">
					<div class="floatLeft">
						<div id="product_title">
							<p><font class="floatLeft" color="#666666">$GetData[prodcut_name]
							</font></p>
							<br />
							<div class="floatLeft" style="width: 75%; margin-top: 10px; font-size:10pt; text-align: left;">
								$GetData[prodcut_details]
							</div>
						</div>
						<div id="atatch_insid">
							<div id="pwr_atatch_insid">
								<div style="width: 93px; float: right; margin: 10px 0px 0px 0px;">
									<a href="">Attach file</a><br />
                                    Power Point</div>
							</div>
							<div id="pdf_atatch_insid">
								<div style="width: 93px; float: right; margin: 10px 0px 0px 0px;">
									<a href="">Attach file</a><br />
                                    Adobe reader</div>
							</div>
						</div>
						<div id="photo_inside">
							<div id="gallery">
								<p>Gallery</p>
								<a href="index.php?get=gallery&id=$GetData[id]" class="gallery"><p>Click to view</p></a></div>
						</div>
						<div id="pic_fram_in">
							<div id="pic_in_l">
							</div>
							<div id="pic_in_m">
								<div id="exam_inside">
									<img src="../upload/$GetData[prodcut_picture]" />
								</div>
							</div>
							<div id="pic_in_r">
							</div>
							<div id="zoom_inside">
								<a href="../upload/$GetData[prodcut_picture_big]" rel="shadowbox">Click to enlarge</a> </div>
						</div>
					</div>
				</div>
				<div class="showcase-thumbnail">
					<img alt="01" src="../upload/$GetData[prodcut_picture]" width="140px" />
					<div class="showcase-thumbnail-cover">
					</div>
				</div>
			</div><!-- close slide -->  

EOF;

}
?>			

		</div><!-- close showcase -->
	</div>
    
	<div id="boarder_inside_r">
	</div>
</div>
<!--end boarder inside-->

<div id="lastnews_in">
	<div id="last_news_in_l">
	</div>
	<div id="last_news_in_m">
	</div>
	<div id="last_news_in_r">
	</div>
</div>
