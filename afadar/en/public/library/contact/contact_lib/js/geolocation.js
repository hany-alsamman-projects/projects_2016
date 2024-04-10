//Call the HTML5 GeoLocation feature
function success(position) {
  var s = document.querySelector('#location');
  
  if (s.className == 'success') {
    return;
  }
  
//Write the value in the location field "found you" if the GeoLocation is successful
  s.value = "found you!";
  s.className = 'success';
  
  var mapcanvas = document.createElement('div');
  mapcanvas.id = 'mapcanvas';
  mapcanvas.style.height = '250px';
  mapcanvas.style.width = '520px';
   
//Write the found address in the location field.
  document.querySelector('article').appendChild(mapcanvas);
var geocoder = new google.maps.Geocoder();
var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
geocoder.geocode({'latLng': latlng}, function(results, status){
        if(status == google.maps.GeocoderStatus.OK){
            var address = results[1].formatted_address;
s.value = address;
}
});
//Define the Google Map Options.
  var myOptions = {
    zoom: 15,
    center: latlng,
    mapTypeControl: false,
    navigationControlOptions: {style: google.maps.NavigationControlStyle.SMALL},
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
 
  var map = new google.maps.Map(document.getElementById("mapcanvas"), myOptions);

//Create the marker on Google Map
  var marker = new google.maps.Marker({
      position: latlng, 
      map: map, 
      title:"You are here!"
  });
}

//Checks if GeoLocation is supported or not.
function error(msg) {
  var s = document.querySelector('#status');
  s.innerHTML = typeof msg == 'string' ? msg : "failed";
  s.className = 'fail';
  
  // console.log(arguments);
}

if (navigator.geolocation) {
  navigator.geolocation.getCurrentPosition(success, error);
} else {
  error('not supported');
}

