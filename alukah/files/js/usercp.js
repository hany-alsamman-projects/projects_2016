$(document).ready(function(){

    $('#Domainloading').hide();


    $("a#pre_addlink").live('click', function (e) {


        var myurl = 'index.php?task=preaddlink';

            $.ajaxSetup({cache: false});

            $.ajax({
                url: myurl,
                type: "GET",
                cache: false
            }).done(function( html ) {
                    jQuery.facebox(html);
            });

        e.preventDefault();

    });

	$("a#linkslist").click(function(e) {

		var myurl = 'index.php?task=linkslist';
        GetData(myurl);
		e.preventDefault();
		 
	});


    var timer;
    var x;

    $("#domain").keyup(function () {
        var message = false;
        var domain = $("#domain").val();
        var myurl = 'scripts/whois.php?domain='+domain;
        $('#Domainloading').hide();
        if (x) { x.abort() } // If there is an existing XHR, abort it.
        $('#Domainloading').show();
        clearTimeout(timer); // Clear the timer so we don't end up with dupes.
        timer = setTimeout(function() { // assign timer a new timeout
            x =  $.get(myurl, function(data) {
                if ($(data).is(":contains('ns1.domainto.net')")) {
                    message = 'هذا النطاق محجوز بالفعل على مخدماتنا';
                }else if($(data).is(":contains('Invalid Input')")){
                    message = 'لقد ادخلت نطاق غير صحيح';
                }else if($(data).is(":contains('No match for')")){
                    message = 'هذا النطاق لم يحجز بعد';
                }else if($(data).is(":contains('Error: No')")){
                    message = 'لا توجد نتائج لهذا النطاق يرجى التأكد';
                }else if($(data).is(":contains('Invalid Input')")){
                    message = 'لقد ادخلت اسم نطاق غير صحيح يرجى التأكد';
                }else{
                    message = 'لا توجد معلومات عن هذا النطاق في هذه اللحظة يرجى التأكد';
                }
                $('#Domainloading').hide();
                jQuery.facebox(message);
            });
        }, 2000); // 2000ms delay, tweak for faster/slower
    });

	$("#enterdomain").click(function(e) {
        var message = false;
        var domain = $("#domain").val();
        var myurl = 'scripts/whois.php?domain='+domain;
        $.get(myurl, function(data) {
            if ($(data).is(":contains('ns1.domainto.net')")) {
                message = 'هذا النطاق محجوز بالفعل على مخدماتنا';
            }else if($(data).is(":contains('Invalid Input')")){
                message = 'لقد ادخلت نطاق غير صحيح';
            }else if($(data).is(":contains('No match for')")){
                message = 'هذا النطاق لم يحجز بعد';
            }else if($(data).is(":contains('Error: No')")){
                message = 'لا توجد نتائج لهذا النطاق يرجى التأكد';
            }else{
                message = 'لا توجد معلومات عن هذا النطاق في هذه اللحظة يرجى التأكد';
            }

            jQuery.facebox(message);
        });
	});

});


function GetData(act)
{
    $.get(act, function(data) {
        
        
        jQuery.facebox(data);
        
        
        $('#pagination-links li').click(function() {
            
            //get the next page
            var STEP = $(this).find("a").attr("id");                        
            GetData("index.php?task=linkslist&step="+STEP+"");            
            //e.preventDefault();
            
        });

        $(".delete").click(function(){
        var element = $(this);
        var I = element.attr("id");
        var answer = confirm("Do you really want to delete this link ?") 
        
             if(answer){
                 $('li#list'+I).fadeOut('slow', function() {
                    //Remove the link selected from link list (as visible)
                    $(this).remove();
                    //Remove the link selected from the database 
                    //RemoveData(I);
                 });
                      
             return false;
             }
         
        });
               
    });
}


function RemoveData(id)
{
    $.get("index.php?task=linkslist&remove_link="+id+"", function(data) {
        if(data != '1') alert('The Selected link its removed before');
    });
}

function InsertData(pic)
{
    $.get("index.php?task=profilepicture&pic="+pic+"", function(data) {
        if(data != '') return true;
    });
}

function ajaxFileUpload()
{
	$("#myloading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload
	(
		{
			url:'application/models/doajaxfileupload.php',
			secureuri:false,
			fileElementId:'fileToUpload',
			dataType: 'json',
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						//alert(data.error);
                        jQuery.facebox(data.error);
					}else
					{
						//alert(data.msg);
                        jQuery.facebox(data.msg);
                        InsertData(data.picture);
                        $("#mypicture").attr("src",'upload/'+data.picture);                        
					}
				}
			},
			error: function (data, status, e)
			{
				//alert(e);
                jQuery.facebox(e);
			}
		}
	)
	
	return false;

}
