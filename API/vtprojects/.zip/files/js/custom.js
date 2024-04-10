/* Configs */
var current  = 0,
slides   = 0,
flickrID = '40840736',
twitterUser = 'CamoKrooked',
interval = 4000; //interval in ms


/* Don't edit below */
var 	fixedHeight = 0,
	$container;



/* Code */
$(window).load(function(){
	
	/* Scroll to top */
	$('.go_top').click(function(){
		$('body').animate({scrollTop: 0}, 1000);
	});

	/* Hover Effect Portfolio */	
	$('.project_container .project, .project_container_index .project').hover(function(){
		$(this).addClass('active');
	},function(){
		$(this).removeClass('active');
	});

	/* Header Text Slides */
	$(".slide_item").each(function() {
		
		$(this).hide(0);
		
		$(this).attr('data-slide', slides);
    
		//show first slide
		if(slides === 0) {
			var h = $(this).addClass('active').height();
			$(".slide_item[data-slide="+current+"]").addClass('active')
			$('.slider').css({'height': h + 30 + 'px'});
		}
		
		$(this).show(0);
		
		slides++;
		
	});
	  
	  setInterval(function() {
	    next_slide();
	  }, interval);

	function next_slide() {
		
		var hide = current;
		current++;
		
		if(current == slides) {
		  current = 0;
		}
		
		$(".slide_item[data-slide="+hide+"]").removeClass('active');
		var h = $(".slide_item[data-slide="+current+"]").addClass('active').height();
		
		$('.slider').css({'height': h + 30 + 'px'});
	  
	}

	$("#slides").slidesjs({
		width: 1170,
		height: 580,
		pagination: false
	});
	
	/* Isotope */
	$container = $('.project_container');
	$container.isotope({
		resizable: false
	});

	$('#nav-select a').click(function(){
	  var selector = $(this).attr('data-filter');
	    $container.isotope({ 
		filter: selector,
		animationOptions: {
	     duration: 750,
	     easing: 'linear',
	     queue: false
		 
	   }
	  });
	  return false;
	});
	
	/* Flicker Feed */
	$('<ul />').appendTo('.flickr');
	$.getJSON('http://api.flickr.com/services/feeds/photos_public.gne?id='+flickrID+'@N06&lang=en-us&format=json&jsoncallback=?', function(data) {
		  $.each(data.items, function(i,item) {
		    var squares = (item.media.m).replace('_m.jpg', '_q.jpg');
		    if(i < 4){
		      $('<img/>').attr({
			alt: item.title, 
			src: squares, 
			height: '52', 
			width: '52'
		      }).appendTo('.flickr ul').wrap('<li class="img"><a href="' + item.link + '"></a></li>');
		    }
		  });
	});
	
	/* Twitter Feed */	
	$.getJSON("https://api.twitter.com/1/statuses/user_timeline/"+twitterUser+".json?count=1&include_rts=1&callback=?", function(data) {
		$("#twitter").html(data[0].text);
	});
	
	/* Responsive dropdown menu */
	selectnav('nav');

	$(window).resize(sizeFix);

	sizeFix();	
	  
});

var onSize = false;

function sizeFix(){
	
	if(onSize){return;}
	
	onSize = true;
	
	setTimeout(function(){
	
		$('.services .service-cnt').each(function(){
			var h = $(this).outerHeight();
			$(this).parent().find('.ic-left').css({'height' : h + 'px'});
		});
	
		$('.project-infos .project-info-right').css({'height' : $('.project-infos .project-info-right').parent().find('.project-info-left').outerHeight() + 'px'});
	
	
		var w = $(window).width();
		masonryDivider = 3;
		if(w < 1000 ){
			masonryDivider = 2;
		}
		if(w < 400){
			masonryDivider = 1;
		}
		
		$container.isotope({
			masonry: { columnWidth: $container.width() / masonryDivider }
		});
	
	
		onSize = false;
	
	}, 50);
}


window.loadMaps = function(){
	/* Google Map */
	var map;
		
		function addMarker(location) {
			marker = new google.maps.Marker({
			position: location,
			map: map
		    });
		}
		
		function initialize() {
		
		    var stylez = [
			    {
				featureType: "all",
				elementType: "all",
				stylers: [
				{ saturation: -100 }
				]
			    }
			];
		
		    var myLatlng = new google.maps.LatLng(25.265872, 55.315132);
		    var mapOptions = {
			zoom: 8,
			center: myLatlng,
			mapTypeId: google.maps.MapTypeId.ROADMAP,
			mapTypeControl: false,
			mapTypeControlOptions: {
			    mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'grey']
			},
			  zoomControl: true,
							      zoomControlOptions: {
								      style: google.maps.ZoomControlStyle.SMALL
							      }
		    };
		
		    map = new google.maps.Map(document.getElementById('map'), mapOptions);
		    var mapType = new google.maps.StyledMapType(stylez, { name: "Grayscale" });
		    map.mapTypes.set('grey', mapType);
		    map.setMapTypeId('grey');
		
		    var marker = new google.maps.Marker({
			position: myLatlng,
			map: map
		    });
		
		};
		
		google.maps.event.addDomListener(window, 'load', initialize);
}




