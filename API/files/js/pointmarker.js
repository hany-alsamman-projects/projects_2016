    var geocoder = new google.maps.Geocoder();

    function geocodePosition(pos) {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                updateMarkerAddress(responses[0].formatted_address);
            } else {
                updateMarkerAddress('Cannot determine address at this location.');
            }
        });
    }

    function updateMarkerStatus(str) {
        document.getElementById('markerStatus').innerHTML = str;
    }

    function updateMarkerPosition(latLng) {
        //document.getElementById('info').innerHTML = [latLng.lat(), latLng.lng()].join(', ');
        $("#map-lat").val(latLng.lat());
        $("#map-lng").val(latLng.lng());
    }

    function updateMarkerAddress(str) {

        $("#map-address").val(str);
        document.getElementById('address').innerHTML = str;
    }

    function initialize() {

        var map = new google.maps.Map(document.getElementById('mapCanvas'), config);

        var marker = new google.maps.Marker({
            position: latLng,
            title: 'Point A',
            map: map,
            draggable: true
        });

        // Update current position info.
        updateMarkerPosition(latLng);
        geocodePosition(latLng);

        // Add dragging event listeners.
        google.maps.event.addListener(marker, 'dragstart', function() {
            updateMarkerAddress('Starting Search ...');
        });

        google.maps.event.addListener(marker, 'drag', function() {
            updateMarkerStatus('Matching Now ...');
            updateMarkerPosition(marker.getPosition());
        });

        google.maps.event.addListener(marker, 'dragend', function() {
            updateMarkerStatus('Done !');
            geocodePosition(marker.getPosition());
        });
        //check user if resize the window
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });
    }

    // Onload handler to fire off the app.
    google.maps.event.addDomListener(window, 'load', initialize);
