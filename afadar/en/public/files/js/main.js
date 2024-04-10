/**
 *
 * @package NONE
 * @programmer Hany alsamman ('hany.alsamman@gmail.com')
 * @copyright CODEXC.COM
 * @version $Id$
 * @pattern private
 * @access private
 */
 

(function($,sr){
 
  // debouncing function from John Hann
  // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
  var debounce = function (func, threshold, execAsap) {
      var timeout;
 
      return function debounced () {
          var obj = this, args = arguments;
          function delayed () {
              if (!execAsap)
                  func.apply(obj, args);
              timeout = null; 
          };
 
          if (timeout)
              clearTimeout(timeout);
          else if (execAsap)
              func.apply(obj, args);
 
          timeout = setTimeout(delayed, threshold || 500); 
      };
  }
	// smartresize 
	jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };
 
})(jQuery,'smartresize');

 
$(document).ready( 
    function() {
        $(window).load( function( ){
            
			//TODO: add checking to see the browser version
			//$(document).pngFix();
              
            //$('#main_menu').fadeTo('slow', 0.9);
            var winheight = $(window).height();
            var winwidth = $(window).width();
                    
            $("#wrapper").css({
              width: winwidth+'px',
              height: winheight+'px'
            });
            

            $("#withflash").hide();  
            $("#noflash").hide();
            $("#menu").hide();
            $('#by_codeXc, #copyright').hide();		  
            $("#menu").css("z-index", "50");
            $("#flashcontent object").css("z-index", "10");
            
            //SetParm();
            
            //smart resize killed me to working fine :)
            $(window).smartresize(function(){  
            var winheight = $(window).height();
            var winwidth = $(window).width();
                    $("#wrapper").css({
                          width: winwidth+'px',
                          height: winheight+'px',
                          backgroundPosition : 'top left'
                    });      
                    
                    var play = SetParm();                 
                    preloader("#flashcontent", play); 
                    
             });
             
            
            function SetParm(){
                
                    var winheight = $(window).height();
                    var winwidth = $(window).width();
                
                    if( $('#withflash').attr('class') == 'gallery') {
                        
                        if (winwidth > 1400){
                            flashw = 1030; flashh = 420; flashn = 'gallery_big.swf';
                            flashvars = {      
                                xml: "swf/xmlsetting/big_gallery_config.xml"     
                            };
                         }else{
                            flashw = 520; flashh = 320; flashn = 'gallery_small.swf';     
                            flashvars = {      
                                xml: "swf/xmlsetting/small_gallery_config.xml"                                
                            };                                        
                        }
                    }
                    
                    
                    if( $('#withflash').attr('class') == 'contactus') {
                        
                        if (winwidth > 1400){
                            flashw = 1030; flashh = 420; flashn = 'contact_big.swf';
                            flashvars = {      
                                xml: "swf/xmlsetting/small_contact_config.xml"                                
                            };
                          }else{
                            flashw = 520; flashh = 320; flashn = 'contact.swf';     
                            flashvars = {
                                xml: "swf/xmlsetting/small_contact_config.xml"                                
                            };
                        }
                    }
                
                    //dont make change if are on home
                    if($('#withflash').attr('class') != 'intro'){ 
                        
                        GetMe();
                                                
                    }else{
                        
                        GetHome();  
                    }

            }

            function GetMe(){
                
              swfobject.removeSWF("flashcontent");
              
        	  $('#withflash').show().animate({
        		height: [flashh, 'easeOutQuint'],
                width: [flashw, 'easeOutQuint'],
                top: ['80', 'easeOutQuint']
                }, { duration: 2000, 
        				complete: function() {
        
                            var attributes = false;
                            var params = {
                              menu: "false",
                              wmode: "transparent",
                              allowscriptaccess: "always"
                            };
                            
                            $("#withflash").append("<div id='flashcontent'></div>");
                            
                                                           
                            swfobject.embedSWF("swf/"+flashn+"", "flashcontent",  flashw, flashh, "9.0.0","js/expressInstall.swf", flashvars, params, attributes);
                                                
                             $(this).animate({
                                border: "0"
                            }, 2000);

                            
        		        }
        		});       
                  
            }
            
            function GetHome(){
                
			  swfobject.removeSWF("flashcontent");
              
              $('#withflash').attr('class', 'intro');
             
              $('#withflash').show().animate({
				height: ['240', 'easeOutQuint'],
                //opacity: 0.3,
                top: ['80', 'easeOutQuint']
                }, { duration: 2000, 
    					complete: function() {
    					   
                            $('#withflash').attr('class', 'intro'); 

                            flashvars = {      
                                xml: "swf/xmlsetting/home_config.xml"                                
                            };
                            var attributes = false;
                            var params = {
                              menu: "false",
                              wmode:"transparent"
                            };
                            
                            $("#withflash").append("<div id='flashcontent'></div>");
                                                           
                            return swfobject.embedSWF("swf/home.swf", "flashcontent", "480", "240", "9.0.0","js/expressInstall.swf", flashvars, params, attributes);                            
                             
                              
				        }
    			});                
            }
            
            function preloader(id, callback){
                                
                //$("#flashcontent").append("<div id='preloader'><img src='images/loading.gif'> Loading Please Wait ...</div>");

                swfobject.removeSWF("flashcontent");
                
    			var $this = $(id);
    			var opts = {
    				img: 'images/loading.png',
    				height: 50,
    				width: 50,
    				onStart: function() { $("#flashcontent").append("<div id='preloader'> Loading Please Wait</div>"); },
    				onFinish: function() { callback }
    			};
    			$this.spinner(opts);
    			setTimeout(function() {
    				$this.spinner('remove');
    			}, 4000);
    			return false;
                                                                
                
            }
            

            /**
             * Selectors Events
             */  
             
        	$(".pclose").click(function(){
        		$(".panel").toggle("fast");
        		$(this).toggleClass("active");
        		return false;
        	});
                         
        	$(".trigger").click(function(){
        		$(".panel").toggle("fast");
        		$(this).toggleClass("active");
        		return false;
        	});
            
        	$(".gclose").click(function(){
        		$(".gogallery").toggle("fast");
        		$(this).toggleClass("active");
        		return false;
        	});
            
        	$(".mygallery").click(function(){
        	    //swfobject.removeSWF("flashcontent");
        		$(".gogallery").toggle("fast");
        		$(this).toggleClass("active");
                
                flashvars = {      
                    //xmlpath: "../upload/3D/iml.xml"                                
                };
                var attributes = false;
                var params = {
                  menu: "false",
                  wmode:"transparent"
                };

                swfobject.embedSWF("../upload/3D/index.swf", "3d", "100%", "100%", "9.0.0","js/expressInstall.swf", flashvars, params, attributes);                          
                
                $(".gogallery").fadeTo("slow", 0.90);

                //$(".gogallery").css("z-index", "7000");
        		return false;
        	});
            

            
            $('a#products').live("click",function() {              
            
                //check if page requested               
                if( $("#withflash").hasClass("gallery") == false ){
                    
                    //attach to page
                    $('#withflash').attr('class', 'gallery');                    
                    var play = SetParm();                 
                    preloader("#flashcontent", play);
                                    
                }

            });
            
            
            $('a#contactus').live("click", function() {                
                
                $('#withflash').attr('class', 'contactus');                 
                var play = SetParm();            
                preloader("#flashcontent", play);
                
            });
            
            $('a#home').live("click", function() {                
                
                //check if page requested               
                if( $("#withflash").hasClass("intro") == false ){                    
                    //attach to page
                    $('#withflash').attr('class', 'intro');
                    var play = GetHome();                    
                    preloader("#flashcontent", play);
                                    
                }
                
            });
            
            
            /**
             * Home int
             */  
			  
            $('#header').animate({
                opacity: 0.7,
                height: '50px',
                width: ['100%', 'easeOutBounce']
            }, { duration: 2000, 
            		complete: function() {
            		  
                       $("#menu").fadeIn('slow');
                      
                       $("#menu").lavaLamp({
                        	fx: 'easeOutExpo',
                        	speed: 2000,
                        	startItem: 1,
                        	homeTop:-1,
                        	homeLeft:-1,
                            returnDelay:1000
                      });
                      
            			$("#footer").show().animate({
            			height: ['40', 'easeOutBounce']
            			}, { duration: 2000, 
            				complete: function() {
            				                                  
            											
                                $('#by_codeXc, #copyright').fadeTo('slow', 1);                                          
                                
                                //check flash player if available      
                                if(swfobject.hasFlashPlayerVersion("9.0.115"))
                                {                
                                    
                                    GetHome();
                                                                                                                                                            
                                }else{
                                      $("#noflash").show ();  
                                }
            
            				}// complete footer
            			});// end footer                            
            		}// complete header
            	});// end header      
        });
});