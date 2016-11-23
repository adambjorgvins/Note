$(document).ready(function(){
    var model = {

    };

    var controller = {
        getAllClocks: function(callback){
            $.ajax({
                type: 'POST',
                url: "php/functions.php",
                data: {'action': 'getAllClocks'},
                dataType: "json",
                success: callback
            })
        },
        insertTime_InIntoDB: function(){
            $.ajax({
                type: 'POST',
                url: "php/functions.php",
                data: {'param1': controller.getCurrentTime(), 'action': 'insertClock'},
                success: function (response) {
                    $('#clockInTime').html(controller.unixConv(controller.getCurrentTime()));
                },
                error: function () {
                    alert('Could not clock you in!');
                }
            })
        },
        insertTime_OutIntoDB: function(){
            $.ajax({
                type: 'POST',
                url: "php/functions.php",
                data: {'param1': controller.getCurrentTime(), 'action': 'endClock'},
                success: function () {
                    controller.getAllClocks(function(response){
                        view.render(response)
                    })
                },
                error: function () {
                    alert('Could not clock you out!');
                }
            })
        },
        calculateTime: function(inTime, outTime){
            if(inTime <= outTime){
                inTime = moment.unix(inTime);
                outTime = moment.unix(outTime);
                var seconds = outTime.diff(inTime, 'seconds') % 60;
                var minutes = outTime.diff(inTime, 'minutes') % 60;
                var hours = outTime.diff(inTime, 'hours') % 24;
                var days = outTime.diff(inTime, 'days');
                seconds = checkTime(seconds);
                minutes = checkTime(minutes);
                hours = checkTime(hours);

                if(days < 2){
                    days = days + " Day";
                }
                else{
                    days = days + " Days";
                }
                function checkTime(time){
                    if(time < 10){
                        time = "0"+time;
                    }
                    return time;
                }
                return days + " and " + hours + ':' + minutes + ":" + seconds;
            }
            else{
                return "No out time";
            }
        },
        unixConv: function(unix){
            return moment.unix(unix).format('HH:mm:ss');
        },
        getCurrentTime: function(){
            return moment().unix();
        },
        timer: function(){
            $('#clock').html(moment().format('HH:mm:ss'));
        },
        startTime: function(){
            $('#clock').fadeOut();
            var t = setInterval(controller.timer, 500);
            $('#clock').fadeIn();
        },
        checkIfClockedIn: function(data){
            if(data.length == 0){
                view.changeButtonToOut();
            }
            else if(data[0].time_out == null){
                view.changeButtonToIn();
                $('#clockInTime').html(controller.unixConv(model[0].time_in));
            }
            else{
                view.changeButtonToOut();
                $('#clockInTime').html(controller.unixConv(model[0].time_in));
            }
        }
    };

    var view = {
        init: function(){
            controller.getAllClocks(function(data){
                model = data;
                controller.startTime();
                view.render(model);
                controller.checkIfClockedIn(model);
                view.assignButtonOnClick();
            });
        },
        assignButtonOnClick: function(){
            $('#in').on('click', function(){
                if($('#in').hasClass('light-green')){
                    view.changeButtonToIn();
                    controller.insertTime_InIntoDB();
                }else if($('#in').hasClass('red')){
                    view.changeButtonToOut();
                    controller.insertTime_OutIntoDB();
                }
            });
        },
        changeButtonToIn: function(){
            $('#in').removeClass('light-green').addClass('red').html('Clock out');
            $('#inORout').html('in');
        },
        changeButtonToOut: function(){
            $('#in').removeClass('red').addClass('light-green').html('Clock in');
            $('#inORout').html('out');
        },
        render: function(data){
            $('#tableContent').empty();
            for(var i = 0; i < data.length; i++){
                $('#tableContent').append(
                    '<tr>' +
                    '<td>' + controller.unixConv(data[i].time_in) + '</td>' +
                    '<td>' + controller.unixConv(data[i].time_out) + '</td>' +
                    '<td>' + controller.calculateTime(data[i].time_in, data[i].time_out) + '</td>' +
                    '<td><button class="btn deleteRow red text-white" id="' + data[i].id + '"><i class="material-icons">delete</i></button></td>' +
                    '</tr>');
            }
        }
    }
    view.init();
});