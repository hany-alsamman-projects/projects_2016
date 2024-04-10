/**
 * YAANEWS.php
 *
 * @package WIX
 * @programmer Hany alsamman < hany.alsamman@gmail.com >
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 
 
 function isValidURL(url){ 
    var RegExp = /^(([\w]+:)?\/\/)?(([\d\w]|%[a-fA-f\d]{2,2})+(:([\d\w]|%[a-fA-f\d]{2,2})+)?@)?([\d\w][-\d\w]{0,253}[\d\w]\.)+[\w]{2,4}(:[\d]+)?(\/([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)*(\?(&?([-+_~.\d\w]|%[a-fA-f\d]{2,2})=?)*)?(#([-+_~.\d\w]|%[a-fA-f\d]{2,2})*)?$/; 
    if(RegExp.test(url)){
        return true; 
    }else{
        return false; 
    } 
 }
 
   function pre_checking(url){
        
        if(!isValidURL(url)){
            jQuery.facebox('Please enter a valid URL');
        }
        
        return false;       
   }

   var http_request_url = false;
   
   function GetUrl(parameters) {
        
      http_request_url = false;
      if (window.XMLHttpRequest) { // Mozilla, Safari,...
         http_request_url = new XMLHttpRequest();
         if (http_request_url.overrideMimeType) {
         	// set type accordingly to anticipated content type
            //http_request_url.overrideMimeType('text/xml');
            http_request_url.overrideMimeType('text/html');
         }
      } else if (window.ActiveXObject) { // IE
         try {
            http_request_url = new ActiveXObject("Msxml2.XMLHTTP");
         } catch (e) {
            try {
               http_request_url = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
         }
      }
      if (!http_request_url) {
         alert('Cannot create XMLHTTP instance');
         return false;
      }
      http_request_url.onreadystatechange = function () { alertContents (parameters); };
      
      if(parameters){
        
      var myparm = parameters.replace(/&/g, "HANY");
      
      //alert(myparm);
    
      http_request_url.open('GET','index.php?task=search&url='+myparm, true);
      
	  }else{
	  	
      http_request_url.open('GET','index.php?task=he', true);
      
      }
      
      http_request_url.send(null);
   }

   function alertContents(parameters) {
      	
   var ShowPic = document.getElementById('results');
   	
      if (http_request_url.readyState == 4) {
      	
	   //ShowPic.innerHTML = '<div><img align="middle" src="images/loading.gif"> Loading Now... </div>';
	   
         if (http_request_url.status == 200) {
         	
			//ShowPic.innerHTML = '';
			
			var ajax_url = http_request_url.responseText;
            
            var parts = ajax_url.split('||');
            
            var url_title = parts[0];

            var thumbnail_links = '';
            
            document.getElementById('links_thumbnail').innerHTML = '';
            
            for(i = 1; i < parts.length; i++){
                //thumbnail_links.join('<li><a href="'+parts[i]+'"><img src="'+parts[i]+'" /></a></li>');
                document.getElementById('links_thumbnail').innerHTML += '<li><a href="'+parts[i]+'"><img src="'+parts[i]+'" /></a></li>';
            }            
            
            document.getElementById('links_title').innerHTML = url_title;
           
           //document.getElementById('links_thumbnail').innerHTML += thumbnail_links;
           
            $(document).ready(function () {                
                $('#ppy1').popeye(options3 = {caption:    false,opacity:    1});
            });
            //jQuery.facebox(url_thumbnail);
            

         } else {
            alert('There was a problem with the request.');
         }
      }
   }
   