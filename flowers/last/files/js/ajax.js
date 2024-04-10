/**
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 
 
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