$(document).ready(function(){
	  
    
    $('#loginForm').submit(function(e) {
	   
		var myurl = $("#loginForm").attr('action');
        login(myurl);
		e.preventDefault();
		 
	});
    

});

function login(act)
{
	hideshow('loading',1);
	error(0);

	
	$.ajax({
		type: "POST",
		url: act,
		data: $('#loginForm').serialize(),
		dataType: "json",
		success: function(msg){
			
			if(parseInt(msg.status)==1)
			{
				window.location=msg.txt;
			}
			else if(parseInt(msg.status)==0)
			{
				error(1,msg.txt);
			}
			
			hideshow('loading',0);
		}
	});

}


function hideshow(el,act)
{
	if(act){ 
    $('#'+el).css('visibility','visible'); 
    $('#'+el).css('display','block');
	}else {$('#'+el).css('visibility','hidden'); }
}

function error(act,txt)
{
	hideshow('loginForm #error',act);
	if(txt) $('#loginForm #error').html(txt);
}