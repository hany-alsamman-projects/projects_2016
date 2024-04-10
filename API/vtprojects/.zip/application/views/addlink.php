<meta http-equiv='cache-control' content='no-cache'>
<meta http-equiv='expires' content='0'>
<meta http-equiv='pragma' content='no-cache'>


<link href="css/steps/smart_wizard.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/steps/jquery.smartWizard-2.0.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#wizard').smartWizard({transitionEffect:'slide',onLeaveStep:leaveAStepCallback,onFinish:onFinishCallback});
        function leaveAStepCallback(obj){
            var step_num= obj.attr('rel');
            return validateAllSteps(step_num);
        }
        function onFinishCallback(){
            //alert($('#dorequest').serialize());
             $.post("index.php?task=dorequest",$('#dorequest').serialize(), function(data){

                if(data.status==1){

                    jQuery.facebox(data.txt);

                }else{

                    jQuery.facebox(data.txt);

                }

                return false;

             }, "json");

        }
    });


    var x;
    var message;
    var timer;
    function validateAllSteps(step_num){
        var isStepValid = true;


        if( step_num == 3 ){
            //jQuery("#facebox_overlay").click();
            if( $("#wizard").find("a").is(".error") ){
            jQuery.facebox('يوجد مشكلة في النطاق المختار او مفتاح التشغيل نرجو اعادة المحاولة');
            }else{

                $('#wizard').smartWizard('showMessage','يبدو ان كل شيء على مايرام يمكنك اكمال الخطوة الاخير').delay(4000).show();
               $('#steps_check').html('يبدو ان كل شيء على مايرام يمكنك اكمال الخطوة الاخيرة');


            }
        }

        if(isStepValid && step_num == 6){


        }


        $('#Domainloading').hide();


        if(isStepValid && step_num == 1 && $('#site_sn').val().replace(/-/g, '').length != 32){
            $('#msg_site_sn').html('الرجاء التأكد من الارقام المدخلة').show();
            isStepValid = false;
        }

        if(isStepValid && step_num == 1 && $('#site_sn').val().replace(/-/g, '').length == 32){
            if (x) { x.abort() }
            x = $.post("index.php?task=checklic",{key : $('#site_sn').val()}, function(data){
                //alert(data.status);
                if(data.status==1){
                    $('#msg_site_sn').hide();
                    $('.msgBox').hide();
                    isStepValid = true;
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:false});
                }

                if(!data.status || data.status!=1){

                    $('#msg_site_sn').html('رقم التشغيل غير صحيح يرجى التأكد').show();
                    isStepValid = false;
                    $('#wizard').smartWizard('setError',{stepnum:1,iserror:true});
                    $('#wizard').smartWizard('showMessage','رقم التشغيل غير صحيح يرجى التأكد').show();
                }
            }, "json");
        }

        if(isStepValid && step_num == 2){

            if (x) { x.abort() }
            $('#Domainloading').show();

            var index_at= $("#sitedomain").val().indexOf('.')
            if( index_at === -1){
                $('#msg_sitedomain').html('يرجى اضافة النطاق مع اللاحقة').show();
                isStepValid = false;
                $('#Domainloading').hide();
            }

            x = $.get("scripts/whois.php",{domain :  $("#sitedomain").val()}, function(data){


                if ($(data).is(":contains('ns1.domainto.net')")) {
                    $('#msg_sitedomain').hide();
                    $('.msgBox').hide();
                    $('#wizard').smartWizard('setError',{stepnum:2,iserror:false});
                    isStepValid = true;
                }else{

                    if($(data).is(":contains('No match for')")){
                        message = 'هذا النطاق لم يحجز بعد';
                    }else if($(data).is(":contains('Error: No')")){
                        message = 'لا توجد نتائج لهذا النطاق يرجى التأكد';
                    }else if($(data).is(":contains('Invalid Input!')")){
                        message = 'لقد ادخلت اسم نطاق غير صحيح يرجى التأكد';
                    }else{
                        message = 'قمت بإدخال غير صحيح او هذا النطاق ليس على مخدماتنا';
                    }

                    $('#msg_sitedomain').html(message).show();
                    isStepValid = false;
                    $('#wizard').smartWizard('setError',{stepnum:2,iserror:true});
                    $('#wizard').smartWizard('showMessage',message).show();
                }
                $('#Domainloading').hide();
            }, "html");
        }

        if(!isStepValid){
            $('#wizard').smartWizard('showMessage','الرجاء التأكد من الحقول');
        }

        return isStepValid;
    }


</script>
</head>
<body>

<table border="0" cellpadding="0" cellspacing="0">
    <tr>
        <td>
            <?
            if (isset($_REQUEST['issubmit'])) {
                echo "<strong>form is sumbitted</strong>";
            }

            ?>

            <form action="#" id="dorequest" method="POST">
                <input type='hidden' name="issubmit" value="1">
                <!-- Tabs -->
                <div id="wizard" class="swMain">
                    <ul>
                        <li><a href="#step-1">

                                <span class="stepDesc">
                                    اختبار مفتاح التشغيل<br/>
                                   <small>التأكد من مفتاح التشغيل</small>
                                </span>
                                <label class="stepNumber">1</label>
                            </a></li>

                        <li><a href="#step-2">

                                <span class="stepDesc">
                                   هل لديك نطاق؟<br/>
                                   <small>اختر نطاقك</small>
                                </span>

                                <label class="stepNumber">2</label>
                            </a></li>

                        <li><a href="#step-3">

                                <span class="stepDesc">
                                    التحقق من النطاق<br/>
                                   <small>تحقق سريع</small>
                                </span>

                                <label class="stepNumber">3</label>
                            </a></li>


                        <li><a href="#step-4">

                                <span class="stepDesc">
                                   انشاء الموقع<br/>
                                   <small>المعلومات الاخيرة</small>
                                </span>

                                <label class="stepNumber">4</label>
                        </a></li>

                    </ul>
                    <div id="step-1">
                        <h2 class="StepTitle"> التأكد من مفتاح التشغيل</h2>
                        <table cellspacing="6" cellpadding="5" align="center">
                            <tr>
                                <td align="center" colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right"><label>ادخل رقم مفتاح التشغيل هنا</label></td>
                                <td align="left">
                                    <input type="text" id="site_sn" name="site_sn" value="" class="txtBox">
                                    <br>
                                    <small>هذا الرقم يستعمل في انشاء موقع لمرة واحدة</small>
                                </td>
                                <td align="left"><span id="msg_site_sn"></span>&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="step-2">
                        <h2 class="StepTitle">الخطوة الثانية : النطاق المطلوب</h2>
                        <table cellspacing="3" cellpadding="3" align="center">
                            <tr>
                                <td align="center" colspan="3">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right"><label> اسم الموقع ؟</label></td>
                                <td align="left">
                                    <input type="text" id="sitename" name="sitename" value="" class="txtBox">
                                    <br>
                                    <small>اسم الموقع سوف يظهر في ترويسة الصفحات بموقعك</small>
                                </td>
                                <td align="left"><span id="msg_sitename"></span>&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right"><label> هل لديك نطاق ؟</label></td>
                                <td align="left">
                                    <input type="text" id="sitedomain"  name="sitedomain" value="" class="txtBox">
                                    <div style="margin-left:15px; margin-top: 5px;float: right;" id="Domainloading"><img src="images/ajax_loading.gif" /></div>
                                    <br>
                                    <small>يجب ان يكون النطاق محجوز على مخدماتنا يمكنك التحقق</small>
                                </td>
                                <td align="left"><span id="msg_sitedomain"></span>&nbsp;</td>
                            </tr>
                        </table>
                    </div>

                    <div id="step-3">
                        <h2 class="StepTitle">التحقق من المعلومات : انشاء البرمجية</h2>
                        <table cellspacing="3" cellpadding="3" align="center">
                            <tr>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right" >
                                    <div id="steps_check">
                                        <h1>نود تذكيرك بانه يجب ان يكون النطاق المختار محول بالفعل على مخدماتنا</h1>
                                        <small>اضغط التالي ليتم التأكيد النهائي وشكرا لاشتراكك بخدمة نطاق ويكس</small>
                                    </div>

                                </td>
                            </tr>
                        </table>
                    </div>

                    <div id="step-4">
                        <h2 class="StepTitle">الخطوة الثالثة : انشاء البرمجية</h2>
                        <table cellspacing="3" cellpadding="3" align="center">
                            <tr>
                                <td align="center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td align="right" >
                                    <h2> الآن سوف يتم انشاء برمجية على المساحة المشتراة من نطاقاتي</h2>
                                    <h3>عند الضغط على زر انشاء سوف يتم انشاء المساحة وتحويل طلبك لقسم الدعم الفني</h3>
                                    <br>

                                    <textarea name="site_information" id="site_information" class="txtBox" rows="3"></textarea>
                                    <h4>اذا كان لديك اي ملاحظات يرجى تضمينها</h4>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <!-- End SmartWizard Content -->
            </form>

        </td>
    </tr>
</table>
