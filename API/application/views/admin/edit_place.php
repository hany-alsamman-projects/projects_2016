<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=en"></script>

<script>
    var latLng = new google.maps.LatLng(<?=$place->latitude?>,<?=$place->longitude?>);
    var config = {
        zoom: 5,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP};
</script>
<script type="text/javascript" src="js/pointmarker.js"></script>
<style>
    #mapCanvas {
        width: 100%;
        height: 300px;
        float: left;

        margin-bottom: 15px;
    }
    #infoPanel {
        margin-left: 10px;
        float: left;
        width: 100%;
        padding: 10px;
        text-align: left;
    }
    #infoPanel div {
        margin-bottom: 5px;
    }
</style>


<div class="box box-75 altbox">
					<div class="boxin">
						<div class="header">
							<h3>Add Place</h3>
						</div>

                        <div class="block">

                            <div class="with-padding">
                                <div id="infoPanel">
                                    <b>Select your target from map:</b>
                                    <div id="markerStatus"><i>Drag and drop the pointer on the place</i></div>
                                    <br>
                                    <b>Matched place informations:</b>
                                    <div id="address"></div>
                                </div>
                                <div id="mapCanvas"></div>
                            </div>
                        </div>

                        <form class="fields" id="addplace" action="<?= $_SERVER['REQUEST_URI']?>" method="post"><!-- Forms (plain layout, cleaner) -->
							<fieldset class="last">
								<legend><strong>Form</strong></legend>

                                
								<label for="some21">Place name:</label>
								<input class="txt" name="place_name"  value="<?= $place->place_name ?>" style="width: 250px" type="text">
								<small></small>

                                <label for="some21">Name of the owner of the place:</label>
                                <select id="some210" name="account_id" id="type-select">
                                    <option value="0">Select:</option>
                                <?
                                $a = mysql_query("SELECT * FROM `members` WHERE `activated` = '1'");
                                if(mysql_num_rows($a) > 0){
                                    while($row = mysql_fetch_object($a) ){
                                        if($place->account_id == $row->id)
                                            echo '<option value="'.$row->id.'" selected>'.$row->name.'</option>';
                                        else
                                            echo '<option value="'.$row->id.'">'.$row->name.'</option>';
                                    }
                                }
                                ?>
                                </select>
                                <small></small>

                                <label for="some21">Latitude:</label>
                                <input class="txt" id="map-lat" name="latitude" value="<?= $place->latitude ?>" style="width: 250px" type="text">
                                <small></small>

                                <label for="some21">Longitude:</label>
                                <input class="txt" id="map-lng" name="longitude" value="<?= $place->longitude ?>" style="width: 250px" type="text">
                                <small></small>

                                <label for="some21">Place address:</label>
                                <input class="txt" value="<?=$place->tour_address?>" name="tour_address" style="width: 250px" type="text">
                                <small></small>

                                <label for="some21">Place Information:</label>
                                <input class="txt" name="place_info" value="<?= $place->place_info ?>" style="width: 250px" type="text">
                                <small></small>

                                <label for="some21">City</label>
                                <select id="some210" name="city_id" id="type-select">
                                    <option value="0">Select:</option>
                                    <?
                                    $a = mysql_query("SELECT * FROM `departments` WHERE `d_type` = 'city'");
                                    if(mysql_num_rows($a) > 0){
                                        while($row = mysql_fetch_object($a) ){
                                            if($place->city_id ==  $row->id)
                                                echo '<option value="'.$row->id.'" selected>'.$row->d_name_en.'</option>';
                                            else
                                                echo '<option value="'.$row->id.'">'.$row->d_name_en.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <small></small>

                                <label for="some21">DEPT</label>
                                <select id="some210" name="dept_id" id="type-select">
                                    <option value="0">Select:</option>
                                    <?
                                    $a = mysql_query("SELECT * FROM `departments` WHERE `d_type` = 'cat'");
                                    if(mysql_num_rows($a) > 0){
                                        while($row = mysql_fetch_object($a) ){
                                            if($place->dept_id ==  $row->id)
                                                echo '<option value="'.$row->id.'" selected>'.$row->d_name_en.'</option>';
                                            else
                                                echo '<option value="'.$row->id.'">'.$row->d_name_en.'</option>';
                                        }
                                    }
                                    ?>
                                </select>
                                <small></small>

                                <label for="some21">Place thumbnail image and HTML5 File:</label>
                                <span id="html_settings">Upload</span>

                                <div style="margin-top: 10px; min-height: 70px">

                                    <label for="some21">Thumbnail: (<a href="<?= SITE_URL.'/'.$place->place_image?>" rel="facebox">preview</a>) <a href="#" class="remove_place_image"><img src="images/delete.png"></a></label>

                                    <label for="some21">Virtual Tour: (<a href="<?= SITE_URL.'/'.$place->place_link?>" target="_blank">preview</a>) <a href="#" class="remove_place_link"><img src="images/delete.png"></a></label>

                                </div>

                                <small>upload thumbnail image, HTML5 File or both</small>

                                <label for="some21">Date of place activated:</label>
                                <small>the date is <?= $place->active_date ?></small>

                                <label for="some21">Date of Expiration of the place subscription:</label>
                                <input class="txt" name="days_left" value="<?= $place->days_left ?>" style="width: 250px" type="text"><br>
                                <small>days left for expiration related to plan type</small>

                                <label for="some210">Requestor name:</label>
                                <input class="txt" name="first_name" value="<?= $place->first_name ?>" style="width: 250px" type="text"><br>
                                <small>for the activation of the place</small>

                                <label for="some210">Type of purchase:</label>
                                <small>(from device or manually) for the Virtual Tour subscription</small>

                                <label for="some21">Place type:</label>
                                <div class="sep">
                                    <label class="radio"><input class="radio" name="campaign_place" value="1" type="radio" <?= ($place->campaign_place == '1') ? 'checked' : '' ?>>campaign place</label>
                                    <label class="radio"><input class="radio" name="campaign_place" value="0" type="radio" <?= ($place->campaign_place == '1') ? '' : 'checked' ?> >normal place</label>
                                </div>
                                <small>Select the type for this place</small>

                                <label for="some21">Activate Status:</label>
                                    <label class="radio"><input class="radio" name="approved" value="1" type="radio" <?= ($place->approved == '1') ? 'checked' : '' ?>>enable</label>
                                    <label class="radio"><input class="radio" name="approved" value="0" type="radio" <?= ($place->approved == '1') ? '' : 'checked' ?>>disable</label><br>
                                <small>Activated or deactivated symbol for the place</small>

                                <div class="sep">
                                    <input type="hidden" name="sub_ok" value="1">
									<input class="button submit" value="Submit" type="button">
								</div>


							</fieldset>
						</form>
					</div>
				</div>


<script>
    $(document).ready(function() {

        var html_settings = $("#html_settings").uploadFile({
            url: "../index.php?task=zip_upload",
            method: "POST",
            allowedTypes:"jpg,png,gif,zip",
            fileName: "myfile",
            autoSubmit:false,
            multiple:true,
            //formData: { parent: 'value1', store_id: 'value2', book_dir: 'value2' },
            showStatusAfterSuccess:false,
            onSuccess:function(files,data,xhr)
            {
                var obj = jQuery.parseJSON(data);

                $.each(obj, function (index, value) {

                    var ext = value.split('.').pop().toLowerCase();

                    if(ext == 'zip'){

                        $('<input>').attr({
                            type: 'hidden',
                            id: 'htm_file',
                            name: 'htm_file',
                            value: value
                        }).appendTo('#addplace');

                    }else{
                        $('<input>').attr({
                            type: 'hidden',
                            id: 'photo_file',
                            name: 'photo_file',
                            value: value
                        }).appendTo('#addplace');
                    }

                });

            },
            onError: function(files,status,errMsg)
            {
                $("#status").html("<font color='green'>يوجد مشكلة في التحميل</font>");
            }
        });


        $('.submit').click(function() {

            var has_file = $(".ajax-file-upload-statusbar").length //check if there files need upload

            if(has_file != false){

                html_settings.startUpload();

                $(document).ajaxStop(function () {
                    $('#addplace').submit();
                });
            }else{
                $('#addplace').submit();
            }
        });

    });

</script>