$(document).ready(function(){
	
    
    $(document).bind('close.facebox', function() {
            // close
            $('#datepicker').focus();
    });
     
     $('#DataProcess').submit(function(e) {
          
          if($('input[name="delivery_date"]').val().length == 0)
          {
                jQuery.facebox("Note: Please select a delivery date");
                return false;
          }      
		 
	});
    
    
    
    $('#regForm').submit(function(e) {
	   
		var myurl = $("#regForm").attr('action');
        register(myurl);
		e.preventDefault();
		 
	});
    
    //Run Password Strength
    $('input[name="password"]').passwordStrength({targetDiv: '#iSM',classes : Array('weak','medium','strong')});
	
});

function register(act)
{
	hideshow('loading',1);
	error(0);

	
	$.ajax({
		type: "POST",
		url: act,
		data: $('#regForm').serialize(),
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
	hideshow('error',act);
	if(txt) $('#error p').html(txt);
}


/*
    Password Strength Indicator 
 */
 
$.fn.passwordStrength = function( options ){
	return this.each(function(){
		var that = this;that.opts = {};
		that.opts = $.extend({}, $.fn.passwordStrength.defaults, options);

		that.div = $(that.opts.targetDiv);
		that.defaultClass = that.div.attr('class');

		that.percents = (that.opts.classes.length) ? 100 / that.opts.classes.length : 100;

		v = $(this)
		.keyup(function(){
			if( typeof el == "undefined" )
			this.el = $(this);
			var s = getPasswordStrength (this.value);
			var p = this.percents;
			var t = Math.floor( s / p );

			if( 100 <= s )
			t = this.opts.classes.length - 1;

			this.div
			.removeAttr('class')
			.addClass( this.defaultClass )
			.addClass( this.opts.classes[ t ] );
		})
		// Removed generate password button creation
	});

	function getPasswordStrength(H){
		var D=(H.length);
		
		// Added below to make all passwords less than 4 characters show as weak
		if (D<4) { D=0 }
		
		
		if(D>5){
			D=5
		}
		var F=H.replace(/[0-9]/g,"");
		var G=(H.length-F.length);
		if(G>3){G=3}
		var A=H.replace(/\W/g,"");
		var C=(H.length-A.length);
		if(C>3){C=3}
		var B=H.replace(/[A-Z]/g,"");
		var I=(H.length-B.length);
		if(I>3){I=3}
		var E=((D*10)-20)+(G*10)+(C*15)+(I*10);
		if(E<0){E=0}
		if(E>100){E=100}
		return E
	}
	
	//Removed generate password function
};