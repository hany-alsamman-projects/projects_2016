<script type="text/javascript">

$(function() {
    
            
	//Change this to the ID of the country input you want to be autocompleted
	//make sure to update the CSS for this ID as well
	var ac_dept = "#ac_dept";
    
    var deptval = $("#ac_dept").val(); 

      var getlang = $(":input[name=lang]").val();
      
           $(ac_dept).change(function () { 
            
                if(deptval == '' || deptval == false){
                    
                    $(":input[name=parent]").val('0');
                    
                }
           
           });
      
            
        	function parent_format(data) {
        		return "<a style='margin-bottom:8px' class='button red'>" + data.parent_title + "</a> &nbsp; <a class='button'>" + data.title + "</a>";
        	}
            
        	function single_format(data) {
        		return "<a style='margin-bottom:8px' class='button'>" + data.title + "</a>";
        	}
                        
        
        	$(ac_dept).autocomplete("index.php?task=dept_search&q="+deptval+"&getlang="+getlang+"", {
        		//multiple: true,
                cacheLength: 0,
        		dataType: "json",
        		parse: function(data) {
        			return $.map(data, function(row) {
        
                        return {
        					data: row,
        					value: row.title,
        					result: row.title
        				}
        			});
        		},
        		formatItem: function(item) {
        		  
                  if(item.id == 'error' ){
                      $("#select_error").html("<p class='message warning'><span class='close-bt'></span> " + item.title + "</p>");
                  
                  }else if(item.parent && item.parent != ''){
                     //alert('have child');
                     return parent_format(item);
                     
                  }else{
                    
                     return single_format(item);
                     
                  }

                    $(ac_dept).flushCache();
                }
                
        	}).result(function(e, item) {
//        	    if(getlang == 0){
//        	       $("#select_error").html("<p class='message warning'><span class='close-bt'></span>Please select the language you want to add</p>");
//                   return false;
//        	    }
                
        		$("#select_error").html("<p class='message success'><span class='close-bt'></span>you are set the page " + item.title + " !</p>");
                
                
                $(":input[name=parent]").val(item.id);
          

        	});

});

</script>
 
	<script type="text/javascript" src="js/jscripts/ckeditor/ckeditor.js"></script>

<script type="text/javascript">

        $(function() {           
            
            
//        	var ckeditor_config = {
//        	   
//               skin : 'v2',
//               docType : '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">',
//               enterMode : CKEDITOR.ENTER_BR,
//               htmlEncodeOutput : false,
//               ignoreEmptyParagraph : true,
//               uiColor : '#AADC6E',
//               
//               
//               };
//            
        	// Initialize the editor.
        	// Callback function can be passed and executed after full instance creation.
        	
            //$('.jquery_ckeditor').ckeditor(ckeditor_config);
                
            //on click upload new picture animate plz
            $('#cities_box').hide();
        
            $('option#get_cities_box').toggle(function() {
                      $('#cities_box').fadeIn('slow', function() {
                        // Animation complete
                      });
            }, function() {
                      $('#cities_box').fadeOut('slow', function() {
                        // Animation complete
                      });
            });
            
                
        });


</script>
        
        <section class="grid_3">
			<!--<div class="block-border"><div class="block-content">-->
				<h1>Management Pages</h1>
				
                    <ul class="favorites no-margin">
                         
                        <li>
                            <img src="images/icons/web-app/48/Add.png" width="48" height="48">
                            <a href="#">Add Page<br>
                            <small>Pages > Add Page</small></a>
                        </li>
                         
                        <li>
                            <img src="images/icons/web-app/48/Add.png" width="48" height="48">
                            <a href="#">Add Translation<br>
                            <small>Pages > Add Translation</small></a>
                        </li>
                         
                        <li>
                            <img src="images/icons/web-app/48/Modify.png" width="48" height="48">
                            <a href="#">View Pages<br>
                            <small>Pages > View Pages</small></a>
                        </li>

                    </ul>
			
		</section>
		
		<section class="grid_9">
			<div class="block-border"><form class="block-content form" id="simple_form" method="post" action="<?=$_SERVER["REQUEST_URI"]?>">
				<h1>Edit Page</h1>
				
				
				<fieldset>
					
                    <?php
                    
                    if(isset($_POST['sub_ok']) && $ok == true){                                    
                        print '<ul class="message success no-margin"><li>The page ('.$_POST['title'].') was <strong>updated</strong> successfully !</li></ul>';
                        
                        echo '<meta http-equiv="refresh" content="2;url=?section=ShowPages&active=pages">';
                        return false;
                    
                    }elseif(isset($_POST['sub_ok']) && $ok == false){
                        print '<ul class="message error no-margin"><li>This is an <strong>error message</strong>, Please fill all fields below</li></ul>';
                    }
                    
                    
                    ?>
					
					                                    
                    <p>
                        <label for="field1" class="required">Page Title</label>
                        <input type="text" name="title" id="field13" value="<?=$title?>" class="half-width">
                    </p>
                    
                    
                    <p>
                        <label for="field2" class="required">Page Description</label>
                        <input type="text" name="desc" id="field13" value="<?=$desc?>" class="half-width">
                    </p>
                    
                                        
                    
                    <p>
                        <label for="field2" class="required">Content</label>
                        <textarea name="mycontent" id="mycontent" class="jquery_ckeditor" cols="45" rows="4"><?=$mycontent?></textarea>
                    </p>
                            
			<script type="text/javascript">
			//<![CDATA[
            
                CKEDITOR.config.enterMode = CKEDITOR.ENTER_BR;

				CKEDITOR.replace( 'mycontent',
					{

						/*
						 * Core styles.
						 */
						coreStyles_bold	: { element : 'b' },
						coreStyles_italic	: { element : 'i' },
						coreStyles_underline	: { element : 'u'},
						coreStyles_strike	: { element : 'strike' },

						/*
						 * Font face
						 */
						// Define the way font elements will be applied to the document. The "font"
						// element will be used.
						font_style :
						{
								element		: 'font',
								attributes		: { 'face' : '#(family)' }
						},

						/*
						 * Font sizes.
						 */
//						fontSize_sizes : 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
//						fontSize_style :
//							{
//								element		: 'font',
//								attributes	: { 'size' : '#(size)' }
//							} ,

						/*
						 * Font colors.
						 */
						colorButton_enableMore : true,

						colorButton_foreStyle :
							{
								element : 'font',
								attributes : { 'color' : '#(color)' },
								overrides	: [ { element : 'span', attributes : { 'class' : /^FontColor(?:1|2|3)$/ } } ]
							},

						colorButton_backStyle :
							{
								element : 'font',
								styles	: { 'background-color' : '#(color)' }
							},


						on : { 'instanceReady' : configureHtmlOutput }
					});

/*
 * Adjust the behavior of the dataProcessor to avoid styles
 * and make it look like FCKeditor HTML output.
 */
function configureHtmlOutput( ev )
{
	var editor = ev.editor,
		dataProcessor = editor.dataProcessor,
		htmlFilter = dataProcessor && dataProcessor.htmlFilter;

	// Out self closing tags the HTML4 way, like <br>.
	dataProcessor.writer.selfClosingEnd = '>';

	// Make output formatting behave similar to FCKeditor
	var dtd = CKEDITOR.dtd;
	for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) )
	{
		dataProcessor.writer.setRules( e,
			{
				indent : true,
				breakBeforeOpen : true,
				breakAfterOpen : false,
				breakBeforeClose : !dtd[ e ][ '#' ],
				breakAfterClose : true
			});
	}

	// Output properties as attributes, not styles.
	htmlFilter.addRules(
		{
			elements :
			{
				$ : function( element )
				{
					// Output dimensions of images as width and height
					if ( element.name == 'img' )
					{
						var style = element.attributes.style;

						if ( style )
						{
							// Get the width from the style.
							var match = /(?:^|\s)width\s*:\s*(\d+)px/i.exec( style ),
								width = match && match[1];

							// Get the height from the style.
							match = /(?:^|\s)height\s*:\s*(\d+)px/i.exec( style );
							var height = match && match[1];

							if ( width )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
								element.attributes.width = width;
							}

							if ( height )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
								element.attributes.height = height;
							}
						}
					}

					// Output alignment of paragraphs using align
					if ( element.name == 'p' )
					{
						style = element.attributes.style;

						if ( style )
						{
							// Get the align from the style.
							match = /(?:^|\s)text-align\s*:\s*(\w*);/i.exec( style );
							var align = match && match[1];

							if ( align )
							{
								element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );
								element.attributes.align = align;
							}
						}
					}

					if ( !element.attributes.style )
						delete element.attributes.style;

					return element;
				}
			},

			attributes :
				{
					style : function( value, element )
					{
						// Return #RGB for background and border colors
						return convertRGBToHex( value );
					}
				}
		} );
}


/**
* Convert a CSS rgb(R, G, B) color back to #RRGGBB format.
* @param Css style string (can include more than one color
* @return Converted css style.
*/
    function convertRGBToHex( cssStyle )
    {
    	return cssStyle.replace( /(?:rgb\(\s*(\d+)\s*,\s*(\d+)\s*,\s*(\d+)\s*\))/gi, function( match, red, green, blue )
    		{
    			red = parseInt( red, 10 ).toString( 16 );
    			green = parseInt( green, 10 ).toString( 16 );
    			blue = parseInt( blue, 10 ).toString( 16 );
    			var color = [red, green, blue] ;
    
    			// Add padding zeros if the hex value is less than 0x10.
    			for ( var i = 0 ; i < color.length ; i++ )
    				color[i] = String( '0' + color[i] ).slice( -2 ) ;
    
    			return '#' + color.join( '' ) ;
    		 });
    }
    			//]]>
</script>
                    
<?php

            if($_GET['translation'] == false){

?>  
    				<fieldset class="grey-bg no-margin">
    					<legend>Follow</legend>
    					<p class="input-with-button">
    						<label for="simple-action">Select page</label>                            
                            <input type="text" name="follow" value="<?=$follow?>" id="ac_dept" class="half-width">
                            <input type="hidden" name="parent" id="parent" value="<?=$myparent?>">
                            <input type="hidden" name="lang" id="lang" value="0">
                            <div id="select_error"></div>
    					</p>
    				</fieldset>
<?php

           }                                                          

?>  
					<div class="columns">
						<div class="colx2-left">
							<label for="simple-switch-off">Visibility</label>
                            
							<input type="checkbox" name="hidden" id="complex-switch-on" class="switch with-tip" title="Visible/Hidden switch" <?=$hidden?> />

						</div>
						<p class="colx2-right">

                            <label for="field2">Creation Date</label>
<!--                    
                            <span class="input-type-text">
                            <input type="text" name="creation_date" id="simple-calendar" value="" class="datepicker"><img src="images/icons/fugue/calendar-month.png" width="16" height="16">
                            </span> 
-->
                            <input type="text" name="creation_date" disabled="true" id="field13" value="<?=date("Y/n/j")?>" >


						</p>
					</div>	
                    
                    
<?php

            if($_GET['translation'] == true){                                                              

?>                     	


        					<fieldset class="grey-bg no-margin">
        						<legend>Translation</legend>
        						<p class="input-with-button">
        							<label for="simple-action">Select page</label>
        							<select name="translation_for" id="simple-action">
                                		<?
                                			$result = mysql_query("SELECT id,title FROM `pages` WHERE `lang` = '0' ORDER BY id DESC");
                                			
                                				while($row = mysql_fetch_object($result)){
                                					echo "<option value=\"$row->id\">$row->title</option>";
                                				}
                                		?>                              		
        							</select>
        						</p>
        					</fieldset>


        					<fieldset class="grey-bg no-margin">
        						<legend>Languages</legend>
        						<p class="input-with-button">
        							<label for="simple-action">Select Lang</label>
        							<select name="languages" id="simple-action">
                                		<?
                                			$result = mysql_query("SELECT * FROM `languages` WHERE `active` = '1' ORDER BY name");
                                			
                                				while($row = mysql_fetch_object($result)){
                                					echo "<option value=\"$row->id\">$row->name</option>";
                                				}
                                		?>                             		
        							</select>
        						</p>
        					</fieldset>	

<?php

            }else{ 

?>
            <p>
                <label for="field2" class="required">Current Language</label>
                <input type="radio" name="translation_for" value="0" checked="1"/> <i>English</i> <small>(as default)</small>
            </p>	
            
<?php
            }                                                         
?>							
					
				</fieldset>
				
				<fieldset class="grey-bg no-margin">
					<legend>Action on create</legend>
					<p class="input-with-button">
						<label for="simple-action">Select action</label>
						<select name="sub_ok" id="simple-action">
							<option value="1">Save and publish</option>
						</select>
						<button type="submit">Change</button>
					</p>
				</fieldset>
                

                <input type="hidden" name="added_by" value="<?=$_SESSION['user_id']?>" />
					
			</form></div>
		</section>