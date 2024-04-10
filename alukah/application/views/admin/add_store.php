
<div class="block">
    <h3 class="block-title">اضافة الى المتجر</h3>
    <div class="with-padding">
        <form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="post" id="addstore">
        <fieldset class="fieldset fields-list">

            <legend class="legend">معلومات المنتج</legend>

            <!-- Standard line -->
            <div class="field-block button-height">

                <label for="input-1" class="label">اسم الكتاب</label>
                <input type="text" name="book_name" id="input-1" value="" class="input validate[required]">
                <small class="input-info"></small>


                <label for="input-1" class="label">تاريخ النشر</label>
                <input type="text" name="publish_date" style="direction:ltr" class="input datepicker validate[required,custom[date]]" value="<?=date("Y-m-d")?>">
                <small class="input-info"></small>


                <label for="input-1" class="label">صورة الكتاب</label>
                <input type="file" class="file" name="book_image">
                <small class="input-info">يرجى مراعاة ان تكون اسم الملف بالانكليزيه ومن دون فراغات</small>
            </div>

            <!-- Carved line -->
            <div class="field-drop button-height black-inputs">
                <label for="input-2" class="label">ارفاق ملف <img src="img/fineFiles/32/pdf.png"> </label>
                <input type="hidden" name="book_extra" id="book_extra" value="">
                <div id="mulitplefileuploader">اختر الملف</div>
            </div>


            <div class="field-block button-height">
                <label for="input-1" class="label">سعر الكتاب</label>
               <input type="text" value="0.00" name="book_price" size="4" class="input">
                <small class="input-info"></small>


                <label for="input-1" class="label">سياسة النشر</label>
                <select name="book_type" id="book_type" class="select check-list">
                    <option value="1">مجاني</option>
                    <option value="2">مدفوع</option>
                </select>
                <small class="input-info"></small>

                <div id="store_id" style="display: none">
                    <label for="input-1" class="label">العنوان التقني للكتاب</label>
                 <span class="input">
                    <input type="text" name="store_id" id="pseudo-input-4" class="input-unstyled validate[required]" value="">
                    <span class="info-spot">
                        <span class="icon-info-round"></span>
                        <span class="info-bubble">
                            مثال :com.alukah_paid.itunes
                        </span>
                    </span>
                </span>
                    <small class="input-info"></small>
                </div>

                <label for="input-1" class="label">الحالة</label>
                <select name="approved" class="select check-list">
                    <option value="1">منشور</option>
                    <option value="0">ليس بعد</option>
                </select>
                <small class="input-info"></small>

                <label for="input-1" class="label">ترتيب البرنامج</label>
                <select name="parent" class="select check-list">
                    <?php
                        if(isset($_GET['parent'])){
                            echo '<option value="'.$_GET['parent'].'">فرعي</option>';
                        }else{
                            echo '<option value="0">رئيسي</option>';
                        }
                    ?>
                </select>

                <small class="input-info">
                    <?php
                    if(isset($_GET['parent'])){
                        $checkID = @mysql_result( mysql_query("SELECT book_name FROM `books` where `id` = {$_GET['parent']} LIMIT 1"), 0);
                        echo "سوف يندرج هذا الكتاب تحت $checkID ";
                    }
                    ?>
                    </small>

                <label for="input-1" class="label">تحديد اتجاه الصفحات</label>
                <select name="book_dir" class="select check-list validate[required]" multiple>
                    <option value="1">من اليسار الى اليمين</option>
                    <option value="2">من اليمين الى اليسار</option>
                </select>
                <small class="input-info"></small>

                <label for="input-1" class="label"> ملخص عن الكتاب</label>
                <textarea class="input" name="book_summary" ></textarea>
                <small class="input-info"></small>



                <span class="button glossy submit">
                    <span class="button-icon"><span class="icon-tick"></span></span>
                    اضافة
                </span>
            </div>
        </fieldset>
     </form>

    </div>
</div>

<script src="js/jquery.uploadfile.min.js"></script>
<link rel="stylesheet" href="css/uploadfile.css">

<script>
    $(document).ready(function() {


        var settings = $("#mulitplefileuploader").uploadFile({
            url: "../index.php?task=upload",
            method: "POST",
            allowedTypes:"jpg,png,gif,doc,pdf",
            fileName: "myfile",
            autoSubmit:false,
            //formData: { parent: 'value1', store_id: 'value2', book_dir: 'value2' },
            showStatusAfterSuccess:false,
            onSuccess:function(files,data,xhr)
            {
                $("#book_extra").attr('value',files); //set uploaded image name

                $('#addstore').submit();
            },
            onError: function(files,status,errMsg)
            {
                $("#status").html("<font color='green'>يوجد مشكلة في التحميل</font>");
            }
        });

        $('.submit').click(function() {

            var validate = $("#addstore").validationEngine('validate');

            if(validate){
                settings.startUpload()
            }
        });

        $('#book_type').change(function(){

            if( $(this).val() == '2'){
                $('#store_id').show();
            }else{
                $('#store_id').hide();
            }
        });


        $("#addstore").validationEngine();
        $('.datepicker').glDatePicker({  selectableYears: [2013, 2014], monthNames: null , zIndex: 100 });

        <?php
            if(!empty($message) && $ok){
                echo "notify('$message', 'تنبيه', {
                            icon: 'img/demo/icon.png',
                            showCloseOnHover: false,
                            hPos: 'right',
                            groupSimilar: false
                        });";
            }
        ?>

    });

</script>
