//Define the Uploadify settings
$(document).ready(function() {
  $('#file_upload').uploadify({
    'uploader'  : 'contact_lib/uploadify/uploadify.swf',
    'script'    : 'contact_lib/uploadify/uploadify.php',
    'cancelImg' : 'contact_lib/uploadify/cancel.png',
    'folder'    : 'contact_lib/uploadify/uploads/',
    'auto'      : false,
    'multi'      : true,
    'fileExt'     : '*.jpg;*.gif;*.png',
    'fileDesc'    : 'Web Image Files (.JPG, .GIF, .PNG)',
  });
});
//Define the custom skin for reCAPTCHA
var RecaptchaOptions = {
   theme : 'custom',
   tabindex : 2,
   custom_theme_widget: 'recaptcha_widget'
};

//Validation Functions for each field
$(document).ready(function(){
	$("#submit").click(function(){					   				   
		$(".error").hide();
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		
		var emailToVal = $("#nameFrom").val();
		if(emailToVal == '') {
                        $("#nameFrom").addClass("highlightError");
			hasError = true;
                 }
		
		var emailFromVal = $("#emailFrom").val();
		if(emailFromVal == '') {
			$("#emailFrom").addClass("highlightError");
                         hasError = true;
		} else if(!emailReg.test(emailFromVal)) {
                        $("#emailFrom").addClass("highlightError");	
			hasError = true;
		}
		
		var subjectVal = $("#subject").val();
		if(subjectVal == '') {
                        $("#subject").addClass("highlightError");
			hasError = true;
		}
		
		var messageVal = $("#message").val();
		if(messageVal == '') {
                        $("#message").addClass("highlightError");
			hasError = true;
		}

                  var recaptchaexists = document.getElementById("recaptcha_widget");
                     if (recaptchaexists != null) {	 	
			var recaptchaVal = $("#recaptcha_response_field").val();
		if(recaptchaVal == '') {
			$("#recaptcha_response_field").addClass("highlightError");
			hasError = true;
			
		}	

		
		if(recaptchaVal != '')  {
				
			var challengeField = $("#recaptcha_challenge_field").val();
    		        var responseField = $("#recaptcha_response_field").val();
   			 var html = $.ajax({
   			 type: "POST",
   			 url: "contact_lib/recaptcha/ajax.recaptcha.php",
   			 data: "recaptcha_challenge_field=" + challengeField + "&recaptcha_response_field=" + responseField,
   			 async: false
   			 }).responseText;
    
    		if(html == "success"){}
   			else {
                  $("#recaptcha_response_field").addClass("highlightError");
      		  Recaptcha.reload();
              hasError = true;
  			 }
		}
}				

//Finally send the email, Upload the files and Reset the Form if the validation is completed.
		if(hasError == false) {
 var filenames = $('span.fileName').map(function(){
    return $(this).text();
}).get();
var filenamesfinal = filenames.toString();
var locationVal = $("#location").val();
			$('#file_upload').uploadifyUpload();
			$.post("contact_lib/mail.php",
   				{ emailTo: emailToVal, emailFrom: emailFromVal, subject: subjectVal, message: messageVal, uploadifyFiles: filenamesfinal, location: locationVal},
   					function(data){
						$("#success").fadeIn("slow");	
                                                $("#mapcanvas").fadeOut("slow");
                                                $('#sendEmail')[0].reset();
                                                 Recaptcha.reload();
                                                 
   					}
				 );
		}
		
		return false;
	});		
		   
});

//Normalize the Form when an error is found in the validation after onClick.
$(document).ready(function(){
	$("#nameFrom").click(function(){
	$("#nameFrom").removeClass("highlightError");
});
$("#emailFrom").click(function(){
	$("#emailFrom").removeClass("highlightError");
});
$("#location").click(function(){
	$("#location").removeClass("highlightError");
});
$("#subject").click(function(){
	$("#subject").removeClass("highlightError");
});

$("#subject").focus(function(){
        $("#displayLater").fadeIn();
});

$("#message").click(function(){
	$("#message").removeClass("highlightError");
});
$("#recaptcha_response_field").click(function(){
	$("#recaptcha_response_field").removeClass("highlightError");
});
});