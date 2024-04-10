<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&language=ar"></script>

<script>
    var latLng = new google.maps.LatLng({{ $data->lat }},{{ $data->lng }});
    var config = {
        zoom: 12,
        center: latLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP};
</script>
@javascripts('pointmarker')

<style>
    #mapCanvas {
        width: 100%;
        height: 300px;
        float: left;
    }
    #infoPanel {
        margin-right: 10px;
        float: right;
        width: 100%;
    }
    #infoPanel div {
        margin-bottom: 5px;
    }
</style>

<div class="block" style="height: 500px; margin-bottom: 25px">
    <h3 class="block-title">تحديد العنوان</h3>
    <div class="with-padding">
        <div id="infoPanel">
            <b>اختيار العنوان على الخريطة:</b>
            <div id="markerStatus"><i>اضغط على العلامة الحمراء وقم بسحبها الى عنوانك.</i></div>
            <br>
            <b>العنوان الذي تم اكتشافه:</b>
            <div id="address"></div>
        </div>
        <div id="mapCanvas"></div>
    </div>
</div>
<div class="block">
    <h3 class="block-title">اضافة عقار</h3>
    <div class="with-padding">
        <form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="post" id="addproperty">
        <fieldset class="fieldset fields-list">

            <legend class="legend">معلومات العقار</legend>

            <!-- Standard line -->
            <div class="field-block button-height five-columns">

                <label for="input-1" class="label">عنوان الاعلان</label>
                <input type="text" name="title" id="input-1" value="{{ $data->title }}" class="input full-width validate[required]">
                <small class="input-info"></small>

                <label for="input-1" class="label">سعر العقار</label>
                <input type="text" name="price" id="input-2" value="{{ $data->price }}" class="input full-width validate[required, custom[onlyNumberSp]]">
                <small class="input-info"></small>

                <label for="input-1" class="label">اختر المدينة</label>

                {{ Form::select('city_id', $city_id, $data->city_id, array('class' => 'select full-width', 'id' => 'city_id')) }}

                <small class="input-info"></small>

                <label for="input-1" class="label">نوع العقار</label>
                {{ Form::select('type_id', $type_id, $data->type_id, array('class' => 'select full-width', 'id' => 'type_id')) }}
                <small class="input-info"></small>

                <label for="input-1" class="label">نوع العملية</label>
                {{ Form::select('section_id', $section_id, $data->section_id, array('class' => 'select full-width', 'id' => 'section_id')) }}
                <small class="input-info"></small>

                <label for="input-1" class="label">الطابق</label>
                <input type="text" name="floor_number" id="input-3" value="{{ $data->floor_number }}" class="input full-width validate[required]">
                <small class="input-info"></small>

                <label for="input-1" class="label">الغرف</label>
                <input type="text" name="rooms" id="input-4" value="{{ $data->rooms }}" class="input full-width validate[required, custom[onlyNumberSp]]">
                <small class="input-info"></small>

                <label for="input-1" class="label">الحمامات</label>
                <input type="text" name="bathrooms" id="input-5" value="{{ $data->bathrooms }}" class="input full-width validate[required, custom[onlyNumberSp]]">
                <small class="input-info"></small>

                <label for="input-1" class="label">المساحة</label>
                <input type="text" name="floor_area" id="input-6" value="{{ $data->floor_area }}" class="input full-width validate[required, custom[onlyNumberSp]]">
                <small class="input-info"></small>

                <label for="input-1" class="label">تاريخ البناء</label>
                <input type="text" name="year_built" style="direction:ltr" class="input full-width validate[required, custom[date]]" value="{{ $data->year_built }}">
                <small class="input-info"></small>

                <label for="input-1" class="label">التشطيب</label>
                <input type="text" name="finishing" id="input-7" value="{{ $data->finishing }}" class="input full-width validate[required]">
                <small class="input-info"></small>

                <label for="input-1" class="label">عنوان العقار</label>
                <textarea class="input full-width validate[required]" name="address"  id="map-address">{{ $data->address }}</textarea>
                <input type="hidden" name="lat" id="map-lat" value="{{ $data->lat }}">
                <input type="hidden" name="lng" id="map-lng" value="{{ $data->lng }}">
                <small class="input-info">من الممكن ان تكون صيغة العنوان غير واضحة ولكنها واضحة بالنسبة لجوجل :)</small>

            </div>

            <div class="field-drop button-height black-inputs">
                <label for="input-2" class="label">ارفاق صور <img src="{{asset('assets/admin/img/fineFiles/32/jpg.png')}}"> </label>
                <div id="mulitplefileuploader">اضعط هنا</div>
            </div>
            <small class="input-info"></small>

            <br><br>
            <div class="field-block mid-margin-top">
                <label for="input-1" class="label">التحكم بالصور</label>
                <a class="button ajax-check-gallery" href="#">
                    <span class="button-icon"><span class="icon-download"></span></span>
                   التحكم بمعرض الصور
                </a>
            </div>
            <small class="input-info"></small>
            <br><br>

            <!-- Carved line -->
            <div class="field-block button-height mid-margin-top">
                <label for="input-1" class="label">اضف روابط فيديو</label>
                <a class="add_video button orange-gradient" href="#">اضافة رابط فيديو</a>
                <div class="form-dynamic-fields">
                    @if(isset($data->videos))
                        @foreach (unserialize($data->videos) as $link)
                        <div class="form-dynamic-row"><input style="width: 350px; text-align: left" type="text" name="videos[]" value="{{$link}}" class="input"><a href="#" class="remove_row">حذف</span></a><br></div>
                        @endforeach
                    @endif
                </div>

                <small class="input-info">مثال: <br>http://www.youtube.com/watch?v=_Z4Z-E-Mxbo <br> http://vimeo.com/55331511</small>
            </div>

            @if( Sentry::getUser()->isSuperUser() )

            <div class="field-block mid-margin-top">
                <label for="input-1" class="label">عقار مميز</label>
                هل تريد التفعيل
                {{ Form::checkbox('featured', '1', ($data->featured == '1') ? true : false, array('class'=>'switch tiny')) }}
            </div>
            <small class="input-info"></small>

            <div class="field-block mid-margin-top">
                <label for="input-1" class="label">الرقم التعريفي للمسوق</label>
                <input type="text" name="sales_id" value="{{ $data->sales_id }}" class="input">
                <small class="input-info"></small>
            </div>
            <small class="input-info"></small>
            @else
            <input type="hidden" name="sales_id" value="{{ $data->sales_id }}">
            @endif

            <div class="field-block mid-margin-top">

                <label for="input-1" class="label">حالة العقار</label>
                نشر
                {{ Form::radio('status', 'approved', ($data->status == 'approved') ? true : false, array('class'=>'switch tiny')) }}

                @if( Sentry::getUser()->isSuperUser() )
                    ينتظر التفعيل
                    {{ Form::radio('status', 'pending', ($data->status == 'pending') ? true : false, array('class'=>'switch tiny')) }}
                @endif

                 مباع
                 {{ Form::radio('status', 'sold', ($data->status == 'sold') ? true : false, array('class'=>'switch tiny')) }}


                <small class="input-info"></small>
            </div>
            <small class="input-info"></small>


            <br class="clear">

                <span class="button submit_property glossy">
                    <span class="button-icon"><span class="icon-tick"></span></span>                    تعديل
                </span>
        </fieldset>
     </form>
    </div>
</div>

<div id="images_content" style="display: none" data-modal-options='{"title":"التحكم بصور العقار"}'>
    @foreach ($images as $id => $image)
    <div class="edit-upload-statusbar" id="{{ $id }}">
        <div><img width="150" id="{{$image}}" src="{{URL::asset(Image::open(URL::asset($images_path.$image))->forceResize(200)) }}"><br></div>
        <div id="{{$image}}" class="ajax-file-upload-red ajax-remove-photo" style="">حذف</div>
    </div>
    @endforeach
</div>

@stylesheets('uploader')

@javascripts('uploader')

<script>
    $(document).ready(function() {

        $("#city_id, #type_id").styleSelect({searchField: true});

        $('.ajax-check-gallery').click(function() {
            $("#images_content").modal({
                resizeToFit: true,
                width: '325',
                minHeight: '250',
                buttons: {
                'اغلاق' : {
                    classes: 'blue-gradient glossy big full-width',
                    click: function(modal) { modal.closeModal(); }}
                }
            })
        });

        $('.ajax-remove-photo').click(function() {
            var id = $(this).closest('.edit-upload-statusbar').attr('id');
            var image = $(this).attr('id');
            /* Send the data using post */
            var posting = $.post("{{ URL::to('admin/property/removephoto') }}", {id: id, target_id: '{{Request::segment(4)}}', image: image});
            /* Put the results in a div */
            posting.done(function (data) {
                    $('#'+id).remove();
            });
        });

        var settings = $("#mulitplefileuploader").uploadFile({
            url: "{{ URL::to('admin/property/upload') }}",
            method: "POST",
            allowedTypes:"jpg,png,gif",
            fileName: "myfile",
            autoSubmit:false,
            dragDropStr: '<span><b> او امسك وافلت الملفات هنا</b></span>',
            formData: { target:'{{Request::segment(3)}}',target_id:'{{Request::segment(4)}}' },
            showStatusAfterSuccess:true,
            onSuccess:function(files,data,xhr)
            {
                var obj = jQuery.parseJSON(data);

                $.each(obj, function (index, value) {

                    $('<input>').attr({
                        type: 'hidden',
                        id: 'property_file',
                        name: 'property_file[]',
                        value: index
                    }).appendTo('#addproperty');

                });

                //$('#addproperty').submit();
            },
            onError: function(files,status,errMsg)
            {
                $("#status").html("<font color='green'>يوجد مشكلة في التحميل</font>");
            }
        });

        $('.submit_property').click(function(event) {

            var validate = $("#addproperty").validationEngine('validate');
            var has_file = $(".ajax-file-upload-statusbar").length //check if there files need upload

            if(validate){
                if(has_file != false){
                    settings.startUpload();

                    $.modal({
                        contentBg: false,
                        contentAlign: 'center',
                        content: 'بإنتظار تحميل الصور لاضافة العقار .. سوف يتم تحويلك تلقائيا',
                        resizable: false,
                        actions: {},
                        buttons: {
                            'Close' : {classes :	'green-gradient',click : function(modal) { modal.closeModal(); }}
                        },
                        buttonsAlign: 'center'
                    });

                    $(document).ajaxStop(function () {
                        $('#addproperty').submit();
                    });

                }else{

                    $.modal({
                        contentBg: false,
                        contentAlign: 'center',
                        content: 'جاري تعديل العقار , سوف يتم نقلك تلقائيا عند الانتهاء',
                        resizable: false,
                        actions: {},
                        buttons: {
                            'Close' : {classes :	'green-gradient',click : function(modal) { modal.closeModal(); }}
                        },
                        buttonsAlign: 'center'
                    });

                    $('#addproperty').submit();
                }
            }
            event.preventDefault();
        });

        $('.add_video').click(function(event){

            var howmany = 1;
            //var container = jQuery(this).parent('#addproperty').find('.form-dynamic-fields').empty();
            if (howmany > 0){
                for (i=1; i<=howmany; i++){
                    $('.form-dynamic-fields').append(jQuery('<div class="form-dynamic-row"><input style="width: 350px; text-align: left" class="input" type="text" name="videos[]" /><a href="#" class="remove_row">حذف</span></a></div>'));
                }
            }
            return false;
        });

        $('#addproperty').delegate('a[class="remove_row"]', 'click', function(event){
            $(this).parent('.form-dynamic-row').remove();
            return false;
        });

        @include('frontend/notifications');
        <!-- check for error flash var -->

    });

</script>
