/* Author:
  Hany alsamman <hany.alsamman@gmail.com>
*/
'use strict';
$(function() {
  $(window).scroll(function() {
    $('.you-can-call-me').fadeIn('slow');
  });
  $('#airport-board').airport(['Somewhere In Middle East']);
});

/*
  Device Orientation
*/
window.addEventListener('deviceorientation', function (event) {
  var angle = -(parseInt(event.gamma / 1.33));
  var portrait = document.getElementById('hany');
  portrait.style.webkitTransform = 'rotate3d(0,0,1,'+angle+'deg)';
}, true);

/*
  Google Maps
*/
function initialize() {
  var marker;
  var map;
  var porto_alegre = new google.maps.LatLng(39.266284, 35.720214);
  var mapOptions = {
    zoom: 4,
    disableDefaultUI: true,
    panControl: false,
    zoomControl: false,
    mapTypeControl: false,
    scrollwheel: false,
    scaleControl: false,
    streetViewControl: false,
    draggable: false,
    overviewMapControl: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: porto_alegre
  };
  map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);
  marker = new google.maps.Marker({
    map:map,
    draggable: false,
    animation: google.maps.Animation.DROP,
    position: porto_alegre
  });
  google.maps.event.addListener(marker, 'click', toggleBounce);
  function toggleBounce() {
    if (marker.getAnimation() != null) {
      marker.setAnimation(null);
    } else {
      marker.setAnimation(google.maps.Animation.BOUNCE);
    }
  }
}
function loadScript() {
  var script = document.createElement("script");
  script.type = "text/javascript";
  script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyBg5LbmaUg-3aWKWguWTumQJgjvtg3PF2I&sensor=false&callback=initialize";
  document.body.appendChild(script);
}
window.onload = loadScript;

/* Author:
  Mary Lou : http://tympanus.net/codrops/2011/12/05/lateral-on-scroll-sliding-with-jquery/
  Lateral on Scroll Sliding
*/
$(function() {
  var $sidescroll = (function() {
    var $rows = $('div.ss-container > div.ss-row'),
    $rowsViewport, $rowsOutViewport,
    $win = $(window),
    winSize = {},
    anim = false,
    scollPageSpeed = 2000 ,
    scollPageEasing = 'easeInOutExpo',
    init = function() {
      getWinSize();
      initEvents();
      defineViewport();
      setViewportRows();
      placeRows();
    },
    defineViewport = function() {
      $.extend( $.expr[':'], {
        inviewport: function (el) {
          if ( $(el).offset().top < winSize.height ) {
            return true;
          }
          return false;
        }
      });
    },
    setViewportRows = function() {
      $rowsViewport = $rows.filter(':inviewport');
      $rowsOutViewport = $rows.not( $rowsViewport );
    },
    getWinSize = function() {
      winSize.width = $win.width();
      winSize.height = $win.height();
    },
    initEvents = function() {
      $(window).on({
        'resize.Scrolling' : function( event ) {
          getWinSize();
          setViewportRows();
          $rowsViewport.each( function() {
            $(this)
              .find('.ss-left').css({ left: '0%' }).end()
              .find('.ss-right').css({ right: '0%' }).end()
          });
        },
        'scroll.Scrolling' : function(event) {
          if (anim) return false;
          anim = true;
          setTimeout( function() {
            placeRows();
            anim = false;
          }, 10 );
        }
      });
    },
    placeRows = function() {
      var winscroll = $win.scrollTop(),
      winCenter = winSize.height / 2 + winscroll;
      $rowsOutViewport.each( function(i) {
        var $row = $(this),
        $rowL = $row.find('.ss-left'),
        $rowR = $row.find('.ss-right'),
        rowT = $row.offset().top;
        if( rowT > winSize.height + winscroll ) {
          $rowL.css({ left: '-50%' });
          $rowR.css({ right: '-50%' });
        } else {
          var rowH = $row.height(),
          factor = ( ( ( rowT + rowH / 2 ) - winCenter ) / ( winSize.height / 2 + rowH / 2 ) ),
          val = parseInt(Math.max( factor * 50, 0 ));
          if( val <= 0 ) {
            if( !$row.data('pointer') ) {
              $row.data( 'pointer', true );
            }
          } else {
            if( $row.data('pointer') ) {
              $row.data( 'pointer', false );
            }
          }
          $rowL.css({ left: - parseInt(val) + '%' });
          $rowR.css({ right: - parseInt(val) + '%' });
        }
      });
    };
    return { init : init };
  })();
  $sidescroll.init();
});
/* Author:
  Vitor Baptista
  Rotating-Words
*/
$(function () {
  var rotatingWords = (function () {
    var problems = ['flow', 'structure', 'organization', 'behaviour', 'design', 'usability'],
        problemsContainer = $("#rotating-words"),
        win = $(window);
    // We have to set the div value before calculating the bottom, because
    // the height changes depending on what's inside it.
    problemsContainer.text(problems[0]);
    var problemsTop = problemsContainer.offset().top,
        problemsBottom = problemsTop + problemsContainer.height();
    function problemsVisible() {
      var winBottom = win.scrollTop() + win.height();
      return (winBottom > problemsTop && win.scrollTop() < problemsBottom)
    }
    return function () {
      if (!problemsVisible()) return;
      var winBottom = win.scrollTop() + win.height(),
          heightToScrollBeforeChanging = win.height() / problems.length,
          i = Math.floor((winBottom - problemsBottom) / heightToScrollBeforeChanging) % problems.length,
          problem = problems[i];
      problemsContainer.text(problem);
    };
  })();
  $(window).scroll(rotatingWords);
});
/*
  Konami Code Fun
*/

var konami = new Konami();
var fun = function () {
  $('body').toggleClass('fun');
}
konami.code = function() {
  fun();
}
konami.load();
