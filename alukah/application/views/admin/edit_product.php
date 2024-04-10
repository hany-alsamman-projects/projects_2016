
<div class="block">
    <h3 class="block-title">اضافة الى المتجر</h3>
    <div class="with-padding">
        <form enctype="multipart/form-data" action="<?=$_SERVER['REQUEST_URI']?>" method="post" id="editstore">
            <fieldset class="fieldset fields-list">

                <legend class="legend">معلومات المنتج</legend>

                <!-- Standard line -->
                <div class="field-block button-height">

                    <label for="input-1" class="label">اسم الكتاب</label>
                    <input type="text" name="book_name" id="input-1" value="<?=$book_name?>" class="input validate[required]">
                    <small class="input-info"></small>


                    <label for="input-1" class="label">تاريخ النشر</label>
                    <input type="text" name="publish_date" style="direction:ltr" class="input datepicker validate[required,custom[date]]" value="<?=$publish_date?>">
                    <small class="input-info"></small>


                    <label for="input-1" class="label">صورة الكتاب</label>
                    <input type="file" class="file" name="book_image">
                    <small class="input-info">اذا كنت لاتريد تعديل الصورة اترك الحقل فارغا</small>
                </div>

                <!-- Carved line -->
                <div class="field-drop button-height black-inputs">
                    <label for="input-2" class="label">ارفاق ملف <img src="img/fineFiles/32/pdf.png"> </label>
                    <input type="file" class="file" name="book_extra">
                    <small class="input-info">اذا كنت لاتريد تعديل الملف اترك الحقل فارغا</small>
                </div>


                <div class="field-block button-height">
                    <label for="input-1" class="label">سعر الكتاب</label>
                    <input type="text" value="<?=$book_price?>" name="book_price" size="4" class="input">
                    <small class="input-info"></small>


                    <label for="input-1" class="label">سياسة النشر</label>
                    <select name="book_type" class="select check-list">
                        <?php
                            if($book_type == 1) $selected = 'selected=true'; else $selected = false;
                            if($book_type == 2) $selected = 'selected=true'; else $selected = false;
                        ?>
                        <option value="1" <?=$selected?>>مجاني</option>
                        <option value="2" <?=$selected?>>مدفوع</option>
                    </select>
                    <small class="input-info"></small>

                    <label for="input-1" class="label">الحالة</label>
                    <select name="approved" class="select check-list validate[required]" multiple>
                        <?php
                        if($approved == 1){
                            echo '<option value="1" selected=true ?>منشور</option>';
                            echo '<option value="2">ليس بعد</option>';
                        }else{
                            echo '<option value="1" ?>منشور</option>';
                            echo '<option value="2" selected=true>ليس بعد</option>';
                        }
                        ?>
                    </select>
                    <small class="input-info"></small>

                    <label for="input-1" class="label">ترتيب البرنامج</label>
                    <select name="parent" class="select check-list">
                        <?php
                        if($parent && $parent > 0){
                            echo '<option value="'.$parent.'">فرعي</option>';
                        }else{
                            echo '<option value="'.$parent.'">رئيسي</option>';
                        }
                        ?>
                    </select>

                    <small class="input-info">
                        <?php
                        if(isset($parent)){
                            $checkID = @mysql_result( mysql_query("SELECT book_name FROM `books` where `id` = {$parent} LIMIT 1"), 0);
                            echo "سوف يندرج هذا الكتاب تحت $checkID ";
                        }
                        ?>
                    </small>

                    <label for="input-1" class="label">تحديد اتجاه الصفحات</label>
                    <select name="book_dir" class="select check-list validate[required]" multiple>
                        <?php
                        if($book_dir == 1){
                            echo '<option value="1" selected=true ?>من اليسار الى اليمين</option>';
                            echo '<option value="2" >من اليمين الى اليسار</option>';
                        }
                        if($book_dir == 2){
                            echo '<option value="1" ?>من اليسار الى اليمين</option>';
                            echo '<option value="2" selected=true >من اليمين الى اليسار</option>';
                        }
                        ?>
                    </select>
                    <small class="input-info"></small>

                    <label for="input-1" class="label"> ملخص عن الكتاب</label>

                    <textarea class="input" name="book_summary" ><?=$book_summary?></textarea>
                    <small class="input-info"></small>

                    <!-- label for="input-1" class="label">العنوان التقني للكتاب</label>
                     <span class="input">
                        <input type="text" name="store_id" id="pseudo-input-4" class="input-unstyled validate[required]" value="">
                        <span class="info-spot">
                            <span class="icon-info-round"></span>
                            <span class="info-bubble">
                                مثال :com.alukah_paid.itunes
                            </span>
                        </span>
                    </span>
                    <small class="input-info"></small>-->

                    <button class="button glossy mid-margin-right" type="submit">
                        <input type="hidden" name="sub_ok" value="1">

                        <span class="button-icon"><span class="icon-tick"></span></span>
                        اضافة
                    </button>
                </div>
            </fieldset>
        </form>

    </div>
</div>

<script>
    $(document).ready(function() {
        $("#editstore").validationEngine();
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