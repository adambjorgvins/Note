/**
 * Created by Aron on 17/10/2016.
 */

$(document).ready(function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition);
    } else {
        console.log("Geolocation is not supported by this browser.");
        $("#lat").val("");
        $("#lng").val("");
    }

    function showPosition(position) {
        $("#lat").val(position.coords.latitude);
        $("#lng").val(position.coords.longitude);
    }

    $("#submitt").off('click').on("click",function () {
        var title = $("#title").val();
        var start = $("#start").val();
        var end = $("#end").val();
        var color = $("#color").val();
        var lat = $("#lat").val();
        var lng = $("#lng").val();
        var place = $("#place").val();

        $.ajax({
            url: 'assets/addevent.php',
            data: 'title='+ title + '&start='+ start +'&end='+ end + '&place=' + place + '&color=' + color + '&lat=' + lat + '&lng=' + lng,
            type: "POST",
            success: function(json) {
                alert('added!');
                $("#modal_add").closeModal();
            }
        });
    });
});