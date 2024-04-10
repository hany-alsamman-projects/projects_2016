
    $(document).ready(function() 
    {
        var page=
        {
            'about'     :   {html:'page-1.html',js:'page-1.js'},
            'services'  :   {html:'page-2.html',js:'page-2.js'},
            'clients'   :   {html:'page-3.html',js:'page-3.js'},
            'practice'  :   {html:'page-4.html',js:'page-4.js'},      
            'contact'   :   {html:'page-5.php',js:'page-5.js'}  
        };
               
        $('#themis').themis(page);



        function GetTweets(Location, UserName, NoOfTweets) {
            url = 'http://api.twitter.com/1/statuses/user_timeline/' + UserName + '.json?callback=?';
            $.getJSON(url, function (tweets) {
                var list = $('<ul/>').appendTo(Location);
                for (var i = 0; i < NoOfTweets; i++) {
                    var Tweet = tweets[i].text;
                    Tweet = Tweet.replace(/http:\/\/\S+/i, "");
                    list.append('<li><div class="news-list-date"><span>Today</span> </div><div class="news-list-content"><h6>@Ali Al Qureshi</h6><p>' + Tweet + '</p></div></li>');
                }

               // $( Location + ' ul').innerfade({animationtype: 'fade', speed: 750, timeout: 3500});


                $('.news-list').bxSlider(
                    {
                        auto:true,
                        pause:5000,
                        nextText:null,
                        prevText:null,
                        mode:'vertical',
                        displaySlideQty:2
                    });

            });
        }

        GetTweets('.news-list','VirtualTour_sa','10');
        
        $('.testimonials-list').bxSlider(
        {
            auto:false,
            pause:10000,
            nextText:null,
            prevText:null,
            mode:'vertical',
            displaySlideQty:2
        }); 
    });