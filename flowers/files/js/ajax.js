/**
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 
$(document).ready(function(){
    
    //Run Password Strength
    $('input[name="password"]').passwordStrength({targetDiv: '#iSM',classes : Array('weak','medium','strong')});
	
});
 
 
    function showdiv(id){
    
        var nShow = 0;
        
        var divs = document.getElementsByTagName("DIV"); 
        
        //loop through all the td
        for (var i=0; i<divs.length; i++){
          if ((divs[i].id.indexOf("mymenu") == 0) && (i>=nShow)) divs[i].style.visibility = 'hidden';
        }
       
       document.getElementById('mymenu'+id+'').style.visibility = 'visible';   
       
    }
 
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
	function confirmDelete(delUrl) {
	  if (confirm("Are You Sure Delete This Email !")) {
		document.location = delUrl;
	  }
	}
 
	function SetAllCheckBoxes(FormName, FieldName, CheckValue)
	{
		if(!document.forms[FormName])
			return;
		var objCheckBoxes = document.forms[FormName].elements[FieldName];
		if(!objCheckBoxes)
			return;
		var countCheckBoxes = objCheckBoxes.length;
		if(!countCheckBoxes)
			objCheckBoxes.checked = CheckValue;
		else
			// set the check value for all check boxes
			for(var i = 0; i < countCheckBoxes; i++)
				objCheckBoxes[i].checked = CheckValue;
	}
	
	function doBlink() {
	var blink = document.all.tags("blink")
	for (var i=0; i<blink.length; i++)
	blink[i].style.visibility = blink[i].style.visibility == "" ? "hidden" : ""
	}
	function startBlink() {
	if (document.all)
	setInterval("doBlink()",1000)
	}
  
  function change_active(active)
  {
		
	var divIndex = 0;
	var divFields = document.getElementById(""+active+"").getElementsByTagName("div");
	var liFields = document.getElementById(""+active+"").getElementsByTagName("li");
	
	 for (var myIndex=0;myIndex<divFields.length;myIndex++)
	   {
			var divID = divFields[myIndex].getAttribute("id");
			var liID = liFields[0].getAttribute("id");
			
			if(divID == 'shadow_top_false'){
				divFields[myIndex].setAttribute("id", 'shadow_top');
			}else if(divID == 'shadow_links_false'){
				divFields[myIndex].setAttribute("id", 'shadow_links');
			}else if(divID == 'shadow_bottom_false'){
				divFields[myIndex].setAttribute("id", 'shadow_bottom');
			}
			
			if(liID == 'link_one_false'){
				liFields[0].setAttribute("id", 'link_one');
			}
			
			divIndex++;
	  }	
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