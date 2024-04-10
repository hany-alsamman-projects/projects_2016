$(function () {


$("#myrental").submit(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "send-actions.php",
		data: $(this).serialize(),
		dataType: "html",
		success: function(msg){
	
			jQuery.facebox({ div: '#info' });	
		}
	});
});

$("#mysale").submit(function(e){
	e.preventDefault();
	$.ajax({
		type: "POST",
		url: "send-actions.php",
		data: $(this).serialize(),
		dataType: "html",
		success: function(msg){
	
			jQuery.facebox({ div: '#info' });	
		}
	});
});

/* --- ScrollBar --- */
var nice = $("html").niceScroll();
var obj = window;

/* --- onePageNav --- */
$('#nav').onePageNav();

/* --- NavBar Search --- */
$('.navbar form input[type=text]').click(function () {
  $(".navbar form").addClass("form-hover");
  return false;
});
$('.navbar form input[type=text]').blur(function () {
  $(".navbar form").removeClass("form-hover");
  return false;
});

/* --- Opacity effect --- */
$('.thumbnails li').mouseover(function () {
  $(this).siblings().css({
    opacity: 0.35
  });
}).mouseout(function () {
  $(this).siblings().css({
    opacity: 1
  });
});

/* --- SuperSlide --- */
$(document).on('init.slides', function () {
  additional_slides = $('#additional-slides').html();
  $(additional_slides).appendTo('#slides .slides-container');
  $('#slides').superslides('update');
});
$('#slides').superslides({
  slide_easing: 'easeInOutCubic',
  slide_speed: 800,
  play: 4000,
  pagination: true,
  hashchange: true,
  scrollable: true
}).on('animated.slides', function (e) {
  $(".detail").each(function () {
    var z = parseInt($(this).css("z-index"), 10);
    $(this)
      .css('opacity', 0)
      .animate({'opacity': 1}, 300);
  });
});

/* --- Fancybox --- */
$('.fancybox').fancybox();

/* --- toTop --- */
$(window).scroll(function () {
  if ($(this).scrollTop() != 0) {
    $('#toTop').fadeIn();
  } else {
    $('#toTop').fadeOut();
  }
});
$('#toTop').click(function () {
  $('body,html').animate({
    scrollTop: 0
  }, 1000);
});

/* --- FullScreen --- */
$(".fullscreen-supported").toggle($(document).fullScreen() != null);
$(".fullscreen-not-supported").toggle($(document).fullScreen() == null);
$(document).bind("fullscreenchange", function (e) {
  $("#status").text($(document).fullScreen() ?
    "Full screen enabled" : "Full screen disabled");
});
$(document).bind("fullscreenerror", function (e) {
  $("#status").text("Browser won't enter full screen mode for some reason.");
});

/* --- Swap color --- */
$('.swap').click(function () {
  $('#swap-bg').attr('href','css/'+$(this).data('bg')+'.css');
  $('#swap-color').attr('href','css/color/'+$(this).data('color')+'.css');
  return false;
});

function initialize() {
  var mapOptions = {
    zoom: 14,
    center: new google.maps.LatLng(40.716818, -74.005451),
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    mapTypeControl: false
  }
  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  var image = 'img/map-marker.png';
  var myLatLng = new google.maps.LatLng(40.716818, -74.005451);
  var beachMarker = new google.maps.Marker({
    position: myLatLng,
    map: map,
    icon: image
  });
  var styles = [{
      "featureType": "administrative",
      "stylers": [{
          "weight": 0.3
        }, {
          "color": "#666666"
        }
      ]
    }, {
      "featureType": "landscape",
      "stylers": [{
          "color": "#E5E5E5"
        }
      ]
    }, {
      "featureType": "poi",
      "stylers": [{
          "color": "#999999"
        }, {
          "visibility": "off"
        }
      ]
    }, {
      "featureType": "road",
      "stylers": [{
          "color": "#999999"
        }, {
          "weight": 0.2
        }, {
          "visibility": "on"
        }
      ]
    }, {
      "featureType": "road",
      "elementType": "labels",
      "stylers": [{
          "visibility": "off"
        }
      ]
    }, {
      "featureType": "water",
      "stylers": [{
          "weight": 0.1
        }, {
          "color": "#F0F0F0"
        }
      ]
    }, {
      "featureType": "transit",
      "stylers": [{
          "visibility": "off"
        }
      ]
    }
  ];
  var styledMap = new google.maps.StyledMapType(styles, {
    name: "map_style"
  });
  map.mapTypes.set('map_style', styledMap);
  map.setMapTypeId('map_style');
}

});

