{pyro:theme:js file="jquery.coolautosuggest.js"}

{pyro:theme:css file="jquery.coolautosuggest.css"}

<script type="text/javascript">
	function MM_jumpMenu(targ,selObj,restore){ //v3.0
	  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
	  if (restore) selObj.selectedIndex=0;
	}
    
$(document).ready(function(){
    
    $("#SearchInput").coolautosuggest({
		url: BASE_URI + "ajax/vcard_search?word=",
    	showThumbnail:true,
    	showDescription:true,
    	idField:$("#uid"),
    	width:280,
    	minChars:2
	});
    
    // check if user selected and redirect to wall page
	$(".suggest_item").live('click', function () {
        
        var myfiled = $(this).attr("id_field");
        
        eval("document.location='"+BASE_URI+"vcard/view/"+myfiled+"'");
 
	});
    
});
</script>
  
<p><label class="custom-select">
    
    <select onchange="MM_jumpMenu('parent',this,0)">
<?php

    foreach (array_reverse(range(2000,2011)) as $year ){
       
       if($this->uri->segment(3) == $year)        
            print '<option selected>'.$year.'</option>';
       else
            print '<option>'.$year.'</option>';
    }

?>
    </select>
  :اختر السنة 
  
  
</label></p>

<p style=" margin: 20px; clear: both;" >
<input type="text" style="width: 220px; text-align: right;" id="SearchInput" size="40" onblur="if ( this.value == '' ) this.value = this.defaultValue" onfocus="if ( this.value == this.defaultValue ) this.value = ''" value="ابدأ البحث هنا" />
</p>
<?php

    foreach($vcards as $vcard):
    
    $vcard['description'] = word_limiter($vcard['description'], 25);
    
    $vcardurl = site_url().'vcard/view';
    
print <<<EOF

    <div id="main_v_card"> 
    <a href="$vcardurl/$vcard[id]"><img src="/uploads/files/$vcard[picture]" /><h3> $vcard[name] </h3></a>
           <li>	
           العام : <b>$vcard[date]</b>
           </li> 
            <li style="width:350px; direction: rtl">
                <p>$vcard[description]</p>
          </li> 
    </div>
EOF;

    endforeach;

?>


   
