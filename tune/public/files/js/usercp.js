$(document).ready(function(){
	
	$("a#linkslist").click(function(e) {

		var myurl = 'index.php?task=linkslist';
        GetData(myurl);
		e.preventDefault();
		 
	});

});


function GetData(act)
{
    $.get(act, function(data) {
        
        
        jQuery.facebox(data);
        
        
        $('#pagination-links li').click(function() {
            
            //get the next page
            var STEP = $(this).find("a").attr("id");                        
            GetData("index.php?task=linkslist&step="+STEP+"");            
            //e.preventDefault();
            
        });

        $(".delete").click(function(){
        var element = $(this);
        var I = element.attr("id");
        var answer = confirm("Do you really want to delete this link ?") 
        
             if(answer){
                 $('li#list'+I).fadeOut('slow', function() {
                    //Remove the link selected from link list (as visible)
                    $(this).remove();
                    //Remove the link selected from the database 
                    //RemoveData(I);
                 });
                      
             return false;
             }
         
        });
               
    });
}


function RemoveData(id)
{
    $.get("index.php?task=linkslist&remove_link="+id+"", function(data) {
        if(data != '1') alert('The Selected link its removed before');
    });
}

function InsertData(pic)
{
    $.get("index.php?task=profilepicture&pic="+pic+"", function(data) {
        if(data != '') return true;
    });
}

function ajaxFileUpload()
{
    
	$("#myloading")
	.ajaxStart(function(){
		$(this).show();
	})
	.ajaxComplete(function(){
		$(this).hide();
	});

	$.ajaxFileUpload
	(
		{
			url:'http://www.tune-forex.com/en/library/upload_avatar.php',
			secureuri:false,
			fileElementId:'fileToUpload',
			dataType: 'json',
			success: function (data, status)
			{
				if(typeof(data.error) != 'undefined')
				{
					if(data.error != '')
					{
						//alert(data.error);
                        jQuery.facebox(data.error);
					}else
					{
						//alert(data.msg);
                        jQuery.facebox(data.msg);
                        InsertData(data.picture);
                        $("#mypicture").attr("src",'upload/'+data.picture);                        
					}
				}
			},
			error: function (data, status, e)
			{
				//alert(e);
                jQuery.facebox(e);
			}
		}
	)
	
	return false;

}