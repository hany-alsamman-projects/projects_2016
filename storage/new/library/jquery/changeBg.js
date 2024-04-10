var eventHistory = (function(){
    var methods = {
        add: function(event){
            events.push(event);
            event();
            return methods;
        },
        rebindAll: function(){
            for(var i in events){
                events[i]();
            }
            return methods;
        }
    }, events = [];

    return methods;
})();

jQuery(function ($) {
    eventHistory.add(function(){
        var bg;

        function setCookie(c_name,value,exdays){
            var exdate=new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());
            document.cookie=c_name + "=" + c_value;
        }

        function getCookie(c_name){
            var i,x,y,ARRcookies=document.cookie.split(";");
            for (i=0;i<ARRcookies.length;i++){
                x=ARRcookies[i].substr(0,ARRcookies[i].indexOf("="));
                y=ARRcookies[i].substr(ARRcookies[i].indexOf("=")+1);
                x=x.replace(/^\s+|\s+$/g,"");
                if (x==c_name)
                {
                return unescape(y);
                }
            }
        }
        
        bg = getCookie('bg');

        if(!$('#changeBg')[0]){
            var $bg = $('<div id="changeBg" />').attr('title', 'Change background').css({
                position: 'fixed',
                top: '50%',
                left: '0',
                background: '#000',
                width: '20px',
                padding: '10px 5px 5px 0',
                border: '1px solid #ccc',
                borderLeft: 'none',
                marginTop: '-80px'
            }).html('<a href="#"><img src="images/bg/bg_1.jpg" width="15" height="15" /></a><br /><a href="#"><img src="images/bg/bg_2.jpg" width="15" height="15" /></a><br /><a href="#"><img src="images/bg/bg_3.jpg" width="15" height="15" /></a>').appendTo($('body')).find('a').click(function(){
                $('body, .wrapper').css('background-image', 'url(' + $(this).find('img').attr('src') + ')');
                setCookie('bg', $(this).find('img').attr('src'), 365);
                return false;
            }).end();

            if(bg){
                $bg.find('img[src="' + bg + '"]').parent().click();
            }
        }

    });
});
