function initMap() {
    /**
     * Sets map and center
     * @type {google.maps.Map}
     */
    var map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: 64.835109, lng: -18.696558},
        zoom: 7 // Zoom sett á 7 því það er cool
    });

    /**
     * InfoWindow
     * @type {google.maps.InfoWindow}
     */
    var infoWindow = new google.maps.InfoWindow({map: map});

    /**
     * HTML5 Geolocation
     * Finnur user location
     * Setur i lat & long
     */
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            infoWindow.setPosition(pos);
            infoWindow.setContent('You are here.');
            //map.setCenter(pos);
        }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
        });
    } else {
        // Browser doesn't support Geolocation
        handleLocationError(false, infoWindow, map.getCenter());
    }

    /**
     * Users seys NO
     * @param browserHasGeolocation
     * @param infoWindow
     * @param pos
     */
    function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
            'Error: The location service failed.' :
            'Error: Your browser doesn\'t support geolocation.');
    }

    // Locations OBJ
    var locations = [];
    $.ajax({
        url: 'assets/load_locations.php',
        type: "GET",
        success: function(data) {
            // Make OBJ from JSON
            var obj = JSON.parse(data);
            locations = (obj);
        }
    }).then(function () {
        // Then add marks
        mark();
    });

    // Marks
    function mark() {
        // Labels
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        // Setur marks á mapið (MADE BY GOOGLE)
        var markers = locations.map(function(locat, i) {
            return new google.maps.Marker({
                position: locat,
                label: labels[i % labels.length]
            });
        });

        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
    }
}