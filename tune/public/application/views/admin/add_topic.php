
	<script type="text/javascript" src="js/jscripts/ckeditor/ckeditor.js"></script>
	<script type="text/javascript" src="js/jscripts/ckeditor/adapters/jquery.js"></script>

<script type="text/javascript">

        $(function() {           
            
            
        	var ckeditor_config = {skin : 'office2003'};
            
        	// Initialize the editor.
        	// Callback function can be passed and executed after full instance creation.
        	$('.jquery_ckeditor').ckeditor(ckeditor_config);
            
            //on click upload new picture animate plz
            $('#cities_box').hide();
            
            
            // if this page check as addtional page disable the parent dropdown and set as main
            $('input[name$="addtional"]').click(function() {
   
                   if($('input[name=main]').is(':checked')){
                       $('input[name=main]').attr('checked', false);  
                       
                      $(':input[name=parent]').toggle('slow', function() {
                        // Animation complete.
                      });
                           
                   }else{
                       $('input[name=main]').attr('checked', true);
                        
                      $(':input[name=parent]').toggle('slow', function() {
                        // Animation complete.
                      });
                         
                   }
            });
            
        
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
				<h1>Add Page</h1>
				
				
				<fieldset>
					
                    <?php
                    
                    if(isset($_POST['sub_ok']) && $ok == true){                                    
                        print '<ul class="message success no-margin"><li>The new page ('.$_POST['title'].') was <strong>created</strong> successfully !</li></ul>';
                    
                    }elseif(isset($_POST['sub_ok']) && $ok == false){
                        print '<ul class="message error no-margin"><li>This is an <strong>error message</strong>, Please fill all fields below</li></ul>';
                    }
                    
                    ?>
					
					                                    
                    <p>
                        <label for="field1" class="required">Topic title</label>
                        <input type="text" name="t_title" id="t_title" class="half-width">
                    </p>
                    
                    
                    <p>
                        <label for="field2" class="required">Topic Sub Title:</label>
                        <input type="text" name="t_sub" id="t_sub" class="half-width">
                    </p>
                    
                                        
                    
                    <p>
                        <label for="field2" class="required">Content</label>
                        <textarea name="t_content" id="mycontent" class="mycontent" cols="45" rows="4"><span style="font-size: 11pt; font-family: Calibri, Arial, sans-serif;">Content</span></textarea>
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
                    

			<fieldset class="grey-bg no-margin">
				<legend>Topic DEPT</legend>
				<p class="input-with-button">
                
                    <select name="in_dept" id="simple-action">
                		<?
            				foreach($this->DEPT as $id => $dept){
            					echo "<option value=\"$id\">$dept</option>";
            				}
                		?>	                            		
					</select>
				</p>
			</fieldset>                  
                    
            
            
			<div class="columns">
				<div class="colx2-left">
                
                    <label for="field2" class="required">Add By</label>
                    <i>Me</i> <small>(login session)</small>

				</div>
				<p class="colx2-right">
                

                    <label for="field2">Creation Date</label>
                    <input type="text" name="start_date" disabled="true" id="field13" value="<?=date("Y/n/j",time())?>" >

				</p>
			</div>	
            						
					
				</fieldset>
				
        		<fieldset class="grey-bg no-margin">
        			<legend>Action on create</legend>
        			<p class="input-with-button">
        				<label for="simple-action">Select action</label>
        				<select name="sub_ok" id="simple-action">
        					<option value="1">Save and publish</option>
        				</select>
        				<button type="submit">Create</button>
        			</p>
        		</fieldset>
                
        		<?php
        		if( session_is_registered('admin') ){
        		echo '<input type="hidden" value="1" name="approve">';
        		}
        		?>
        		
        		<input type="hidden" value="<?=$_SESSION['user_id']?>" name="t_add_by" />
                
					
			</form></div>
		</section>