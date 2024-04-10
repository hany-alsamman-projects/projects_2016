$(document).ready(function(){

    //get the next page
    $("a#createlic").click(function(e) {

        var myurl = '../index.php?task=createlic';
        GetData(myurl);
        e.preventDefault();

    });

});

function GetData(act)
{
    $.get(act, function(data) {


        jQuery.facebox(data);

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