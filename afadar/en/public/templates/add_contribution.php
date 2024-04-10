<?php
	if ( ! defined( 'IN_SCRIPT' ) )
	{
        print "<h1>Incorrect access</h1>You cannot access this file directly.";
        exit();
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1256" />
<title><? print SITE_NAME ?></title>

</head>

<body>
<table style="width: 98%; background-color:white; margin-top:15px; margin-bottom:15px" cellpadding="5" cellspacing="0" align="center">

<form method="post">
	<tr>
		<td colspan="3" style="text-align:center; height: 42px; background-color: #C0C0C0;">
		
		اضافة مساهمة
		<br />
		<?php
		if(isset($_POST['sub_ok'])){
			
			if($ok){
				echo 'لقد تم اضافة المسامهمة , سيتم تفعيلها في اقرب وقت';
			}else{
				echo 'يوجد مشكلة في ادخل البيانات';
			}	
			
		}

		?>
		</td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_add_name" style="width: 280px" type="text" /></td>
		<td style="text-align:right; height: 35px; width: 25%;"><span lang="ar-sa">
		: اسم الكاتب</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_title" style="width: 280px" type="text" /></td>
		<td style="text-align:right; height: 35px; width: 25%;"><span lang="ar-sa">
		: عنوان المساهمة</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<input name="t_short" style="width: 280px" type="text" /></td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: ملخص المساهمة
		</span></td>
	</tr>
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
		<select dir="rtl" size="1" name="in_dept">
		<?
			$result = mysql_query("SELECT id,d_name FROM `departments` WHERE `id` = '7' and `d_active` = '1' ORDER BY id");
			
				while($row = mysql_fetch_object($result)){
					//if($row->id != 2)
					echo "<option value=\"$row->id\">$row->d_name</option>";
				}
		?>	
		</select>
		</td>
		<td style="text-align:right; width: 25%;">
		: ضمن القسم
		</td>
	</tr>
	
	<tr>
		<td style="width: 75%; text-align:right; height: 210px;" colspan="2">
		<textarea name="t_content" style="width: 450px; height: 200px" cols="20" rows="1"></textarea></td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: نص 
		المساهمة</span></td>
	</tr>
	
	<tr>
		<td style="width: 75%; text-align:right; height: 35px;" colspan="2">
                <select dir="rtl" name="country">
                  <option value="سوريا" selected="selected"> سوريا</option>
                  <option value="أستراليا"> أستراليا</option>
                  <option value="أفغانستان"> أفغانستان</option>
                  <option value="ألبانيا"> ألبانيا</option>
                  <option value="الجزائر"> الجزائر</option>
                  <option value="أنغولا"> أنغولا</option>
                  <option value="الأرجنتين"> الأرجنتين</option>
                  <option value="أرمينيا"> أرمينيا</option>
                  <option value="الهند"> الهند</option>
                  <option value="إندونيسيا"> إندونيسيا</option>
                  <option value="إيران"> إيران</option>
                  <option value="العراق"> العراق</option>
                  <option value="الدومينيكان"> الدومينيكان</option>
                  <option value="الإكوادور"> الإكوادور</option>
                  <option value="إيرلندا"> إيرلندا</option>
                  <option value="السلفادور"> السلفادور</option>
                  <option value="إستونيا"> إستونيا</option>
                  <option value="إثيوبيا"> إثيوبيا</option>
                  <option value="إيطاليا"> إيطاليا</option>
                  <option value="النمسا"> النمسا</option>
                  <option value="البرازيل"> البرازيل</option>
                  <option value="أذربيجان"> أذربيجان</option>
                  <option value="البحرين"> البحرين</option>
                  <option value="التشيك"> التشيك</option>
                  <option value="الدانمارك"> الدانمارك</option>
                  <option value="أوغندا"> أوغندا</option>
                  <option value="أوكرانيا"> أوكرانيا</option>
                  <option value="الإمارات"> الإمارات</option>
                  <option value="المكسيك"> المكسيك</option>
                  <option value="اليمن"> اليمن</option>
                  <option value="الصين"> الصين</option>
                  <option value="الولايات المتحدة"> الولايات المتحدة</option>
                  <option value="أفريقيا الوسطى"> أفريقيا الوسطى</option>
                  <option value="الأوروغواي"> الأوروغواي</option>
                  <option value="الكونغو"> الكونغو</option>
                  <option value="أوزباكستان"> أوزباكستان</option>
                  <option value="النيجر"> النيجر</option>
                  <option value="النروج"> النروج</option>
                  <option value="الباكستان"> الباكستان</option>
                  <option value="الفيليبين"> الفيليبين</option>
                  <option value="البارغواي"> البارغواي</option>
                  <option value="البيرو"> البيرو</option>
                  <option value="البرتغال"> البرتغال</option>
                  <option value="بولندا"> بولندا</option>
                  <option value="بورتوريكو"> بورتوريكو</option>
                  <option value="بنغلاديش"> بنغلاديش</option>
                  <option value="بلجيكا"> بلجيكا</option>
                  <option value="بوليفيا"> بوليفيا</option>
                  <option value="بلغاريا"> بلغاريا</option>
                  <option value="بوركينا فاسو"> بوركينا فاسو</option>
                  <option value="بنما"> بنما</option>
                  <option value="تاجكستان"> تاجكستان</option>
                  <option value="تنزانيا"> تنزانيا</option>
                  <option value="تايلاندا"> تايلاندا</option>
                  <option value="تونس"> تونس</option>
                  <option value="تركيا"> تركيا</option>
                  <option value="تركمانستان"> تركمانستان</option>
                  <option value="تشاد"> تشاد</option>
                  <option value="تشيلي"> تشيلي</option>
                  <option value="كمبوديا"> كمبوديا</option>
                  <option value="كندا"> كندا</option>
                  <option value="كولومبيا"> كولومبيا</option>
                  <option value="كوستاريكا"> كوستاريكا</option>
                  <option value="كرواتيا"> كرواتيا</option>
                  <option value="كوبا"> كوبا</option>
                  <option value="قبرص"> قبرص</option>
                  <option value="جيبوتي"> جيبوتي</option>
                  <option value="مصر"> مصر</option>
                  <option value="فيجي"> فيجي</option>
                  <option value="فنلندا"> فنلندا</option>
                  <option value="فرنسا"> فرنسا</option>
                  <option value="الغابون"> الغابون</option>
                  <option value="غامبيا"> غامبيا</option>
                  <option value="جورجيا"> جورجيا</option>
                  <option value="ألمانيا"> ألمانيا</option>
                  <option value="غانا"> غانا</option>
                  <option value="بريطانيا"> بريطانيا</option>
                  <option value="اليونان"> اليونان</option>
                  <option value="غرينادا"> غرينادا</option>
                  <option value="غواتيمالا"> غواتيمالا</option>
                  <option value="غينيا"> غينيا</option>
                  <option value="هاييتي"> هاييتي</option>
                  <option value="هندوراس"> هندوراس</option>
                  <option value="هونغ كونغ"> هونغ كونغ</option>
                  <option value="هنغاريا"> هنغاريا</option>
                  <option value="جامايكا"> جامايكا</option>
                  <option value="اليابان"> اليابان</option>
                  <option value="الأردن"> الأردن</option>
                  <option value="زامبيا"> زامبيا</option>
                  <option value="زمبابوي"> زمبابوي</option>
                  <option value="كازاخستان"> كازاخستان</option>
                  <option value="كينيا"> كينيا</option>
                  <option value="كوريا الشمالية"> كوريا الشمالية</option>
                  <option value="كوريا الجنوبية"> كوريا الجنوبية</option>
                  <option value="الكويت"> الكويت</option>
                  <option value="لبنان"> لبنان</option>
                  <option value="ليبيريا"> ليبيريا</option>
                  <option value="ليبيا"> ليبيا</option>
                  <option value="ليتوانيا"> ليتوانيا</option>
                  <option value="لوكسمبورغ"> لوكسمبورغ</option>
                  <option value="ماكاو"> ماكاو</option>
                  <option value="مدغشقر"> مدغشقر</option>
                  <option value="مالاوي"> مالاوي</option>
                  <option value="ماليزيا"> ماليزيا</option>
                  <option value="ملديف"> ملديف</option>
                  <option value="مالي"> مالي</option>
                  <option value="مالطا"> مالطا</option>
                  <option value="موريتانيا"> موريتانيا</option>
                  <option value="موناكو"> موناكو</option>
                  <option value="منغوليا"> منغوليا</option>
                  <option value="المغرب"> المغرب</option>
                  <option value="موزامبيق"> موزامبيق</option>
                  <option value="ناميبيا"> ناميبيا</option>
                  <option value="نيبال"> نيبال</option>
                  <option value="هولندا"> هولندا</option>
                  <option value="نيوزيلندا"> نيوزيلندا</option>
                  <option value="نيكاراغوا"> نيكاراغوا</option>
                  <option value="نيجيريا"> نيجيريا</option>
                  <option value="عمان"> عمان</option>
                  <option value="قطر"> قطر</option>
                  <option value="رومانيا"> رومانيا</option>
                  <option value="روسيا الاتحادية"> روسيا الاتحادية</option>
                  <option value="راوندا"> راوندا</option>
                  <option value="سان مارينو"> سان مارينو</option>
                  <option value="السعودية"> السعودية</option>
                  <option value="السنغال"> السنغال</option>
                  <option value="تشيلي"> تشيلي</option>
                  <option value="سنغافورة"> سنغافورة</option>
                  <option value="سلوفاكيا"> سلوفاكيا</option>
                  <option value="سلوفينيا"> سلوفينيا</option>
                  <option value="الصومال"> الصومال</option>
                  <option value="جنوب إفريقيا"> جنوب إفريقيا</option>
                  <option value="إسبانيا"> إسبانيا</option>
                  <option value="سيريلانكا"> سيريلانكا</option>
                  <option value="السودان"> السودان</option>
                  <option value="سويسرا"> سويسرا</option>
                  <option value="السويد"> السويد</option>
                  <option value="فنزويلا"> فنزويلا</option>
                  <option value="فيتنام"> فيتنام</option>
                  <option value="يوغسلافيا"> يوغسلافيا</option>
                </select>
		</td>
		<td style="text-align:right; width: 25%;"><span lang="ar-sa">: الدولة</span></td>
	</tr>
	<tr>
		<td style="width: 40%; text-align:right; height: 35px;">
<a href="#" onclick="document.getElementById('image').src = '<?php echo SITE_DIR?>/library/securimage/view.php?sid=' + Math.random(); return false">تغيير الصورة</a>

<img src="<?php echo SITE_DIR?>/library/securimage/view.php?sid=<?php echo md5(uniqid(time())); ?>" id="image" align="absmiddle" />

		</td>
		<td style="width: 35px; text-align:right">
		<input name="image_captcha" style="width: 280px" type="text" /></td>
		<td style="text-align:right; width: 25%;">: ادخل بيانات الصورة في الحقل </td>
	</tr>
	<tr>
		<td style="text-align:center; height: 35px;" colspan="3">
		<input name="Reset1" type="reset" value="مسح" />
		<input name="submit" type="submit" value="ادخال" />
		<input type="hidden" value="<?php echo time() ?>" name="start_date" />
		<input type="hidden" value="1" name="sub_ok" />
		</td>
	</tr>
	</form>
</table>
</body>
</html>