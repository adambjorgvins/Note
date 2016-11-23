<!DOCTYPE html>
<html>
<head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 90%;
        }
        #top {
            height: 10%;
        }
        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
    <?php require('assets/head.php'); ?>
</head>

<body>
<div id="top">
    <h3>Locations!</h3>
    <a href="index.php">Calendar</a>
</div>
<div id="map"></div>
<script src="js/map.js"></script>
<script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDJdzlQLWEhLsN0d1VwfwNwV5mXjSwiVGw&callback=initMap">
</script>
</body>
</html>