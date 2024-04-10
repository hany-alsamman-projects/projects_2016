
// wall.js
$(document).ready(function () {
    // Update Status
    $("#update_button").click(function () {
        var updateval = $("#update").val();
        var dataString = 'update=' + updateval;
        if (updateval == '') {
            alert("الرجاء كتابة الحالة , لا يمكن ترك هذا المربع فارغا");
        } else {
            $("#flash").show();
            $("#flash").fadeIn(400).html('يتم التحميل ...');
            $.ajax({
                type: "POST",
                url: BASE_URI+"wall/insert_update",
                data: dataString,
                cache: false,
                success: function (html) {
                    
                    $("#flash").fadeOut('slow');
                    $("#wall_area").prepend(html);
                                        
                    //$('html, body').animate({scrollTop: $("#wall_area").offset().top}, 2500);
                    
                    $("#update").val('');
                    $("#update").focus();

                    //$("#stexpand").oembed(updateval);
                }
            });
        }
        return false;
    });
    
    function returnEnterPress(e){
        var keynum; // set the variable that will hold the number of the key that has been pressed.
     
        //now, set keynum = the keystroke that we determined just happened...
        if(window.event) // (IE)
        {keynum = e.keyCode;}
     
        else if(e.which) // (other browsers)
        {keynum = e.which;}
     
        else{ // something funky is happening and no keycode can be determined...
            alert('nothing found');
            keynum = 0;
        }
     
        // now that keynum is set, interpret keynum
        if(keynum == 13){ // this is Enter (keyascii code 13)
            return true;
        }
        else{ // this is something other than enter
            return false;
        }
    }
        
    
    var code =null;

    //commment Submint
    $('.ctextarea').live('keyup', function(a) {
        
       var enterPress = returnEnterPress(a);

        a = a || window.event;
        var b = a.target || a.srcElement;
        var c = a.keyCode == 13 && !a.altKey && !a.ctrlKey && !a.metaKey && !a.shiftKey;
        
        if (c){       
            
            var ID = $(this).attr("id");            
            var comment = $(this).val();
            
            var dataString = 'comment=' + comment + '&msg_id=' + ID;
    
            if (comment == '') {
                alert("Please Enter Comment Text");
            } else {
                $.ajax({
                    type: "POST",
                    url: BASE_URI+"wall/insert_comment",
                    data: dataString,
                    cache: false,
                    success: function (html) {
                        $(html).insertBefore("#comment_text_area" + ID);
                        $("#comment_text_area" + ID).find("textarea").val('');
                        $("#comment_text_area" + ID).find("textarea").focus();
                    }
                });
            }
        }
        a.preventDefault();
    });
    
    // comment text_area open 
    $('.commentopen').live("click", function () {
        var ID = $(this).attr("id");
        $("#comment_text_area" + ID).slideToggle('slow');
        $('html, body').animate({scrollTop: $("#comment_text_area" + ID).offset().top}, 2500);
        return false;
    });

    // delete comment
    $('.stcommentdelete').live("click", function () {
        var ID = $(this).attr("id");
        var dataString = 'com_id=' + ID;

        if (confirm("Sure you want to delete this comment? There is NO undo!")) {

            $.ajax({
                type: "POST",
                url: BASE_URI+"wall/delete_comment",
                data: dataString,
                cache: false,
                success: function (html) {
                    $("#stcommentbody" + ID).slideUp();
                }
            });

        }
        return false;
    });
    
    // delete update
    $('.stdelete').live("click", function () {
        var ID = $(this).attr("id");
        var dataString = 'msg_id=' + ID;
        
        if (confirm("Sure you want to delete this update? There is NO undo!")) {

            $.ajax({
                type: "POST",
                url: BASE_URI+"wall/delete_update",
                data: dataString,
                cache: false,
                success: function (html) {
                    $("#wall_content" + ID).fadeOut(1500);
                }
            });
        }
        return false;
    });
});