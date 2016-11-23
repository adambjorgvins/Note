$(document).ready(function(){
    getAllClocks(function(response){
        if(response.length == 0){
            changeButtonOut();
        }
        else if(response[0].time_out == null){
            changeButtonIn();
            $('#clockInTime').html(unixConv(response[0].time_in));
        }
        else{
            changeButtonOut();
            $('#clockInTime').html(unixConv(response[0].time_in));
        }
        updateTable(response);
        startTime();
    });
    function changeButtonIn(){
        $('#in').addClass('red').html('Clock out');
        $('#inORout').html('in');
    }
    function changeButtonOut(){
        $('#in').removeClass('red').addClass('light-green').html('Clock in');
        $('#inORout').html('out');
    }
    // TODO: Finna aðra leið til að reikna
    function calculateTime(inTime, outTime){
        if(inTime <= outTime){
            inTime = moment.unix(inTime);
            outTime = moment.unix(outTime);

            return outTime.diff(inTime, 'days') + " Days and " + outTime.diff(inTime, 'hours') + ':' + outTime.diff(inTime, 'minutes') + ":" + outTime.diff(inTime, 'seconds');
        }
        else{
            return "No out time";
        }
    }
    function updateTable(data){
        $('#tableContent').empty();
        for(var i = 0; i < data.length; i++){
            $('#tableContent').append(
                '<tr>' +
                '<td>' + unixConv(data[i].time_in) + '</td>' +
                '<td>' + unixConv(data[i].time_out) + '</td>' +
                '<td>' + calculateTime(data[i].time_in, data[i].time_out) + '</td>' +
                '</tr>');
        }
    }
    function getAllClocks(callback){
        $.ajax({
            type: 'POST',
            url: "php/functions.php",
            data: {'action': 'getAllClocks'},
            dataType: "json",
            success: callback
        })
    }
    function unixConv(unix){
        return moment.unix(unix).format('HH:mm:ss');
    }
    function getTime() {
        return moment().unix();
    }
    function timer() {
        $('#clock').html(moment().format("HH:mm:ss"));
    }
    function startTime(){
        $('#clock').fadeOut('slow');
        var t = setInterval(timer, 500);
        $('#clock').fadeIn('slow');
    }


    // Þegar ýtt er á Clock in takkann

    //Clock in
    $('#in').on('click', function() {
        if ($('#in').hasClass('light-green')) {
            $.ajax({
                type: 'POST',
                url: "php/functions.php",
                data: {'param1': getTime(), 'action': 'insertClock'},
                success: function (response) {
                    changeButtonOut();
                    $('#clockInTime').html(unixConv(getTime()));
                },
                error: function () {
                    alert('Could not clock you in!');
                }
            })
        }
        // Clock out
        else if ($('#in').hasClass('red')) {
            $.ajax({
                type: 'POST',
                url: "php/functions.php",
                data: {'param1': getTime(), 'action': 'endClock'},
                success: function (response) {
                    changeButtonIn();
                    getAllClocks(function(data){
                        updateTable(data);
                    })
                },
                error: function () {
                    alert('Could not clock you out!');
                }
            })
        }
    });
});