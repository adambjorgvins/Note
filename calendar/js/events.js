$(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
        customButtons: {
            location: {
                text: 'Locations',
                click: function () {
                    window.location = "locations.php";
                }
            }
        }, // CustomButton linkar á location.php
        editable: true, // Svo að það se hægt að breyta eventum
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,list,location',
            backgroundColor: '#000'
        }, // Headerinn (Takkarnir sem eru fyrir ofan calendarinn)
        eventLimit: true, // Fyrir alla non-agenda views
        views: {
            agenda: {
                eventLimit: 4 // adjust to 4 only for agendaWeek/agendaDay
            }
        }, // Limit events
        events: "assets/events.php", // Nær i events JSON
        eventColor: '', // Enable colors
        selectable: true, // Hægt að velja eventa
        selectHelper: true,
        forceEventDuration: true, // Lagar Null event's
        timeFormat: 'YYYY-MM-DD HH:mm',

        /**
         * Ef eventinn er merktur sem allday i gagnagrunninum breytir þetta funtion eventnum í Allday event
         * @param event
         */
        eventRender: function(event) {
            if(event.allDay === 'true') {
                event.allDay = true;
            } else {
                event.allDay = false;
            }
        },

        /**
         * Þegar ítt er á glugga opnar þetta modal með formi sem userinn fyllir út
         * Svo setur þetta gögnin i gagnagrunnin
         * @param start
         * @param end
         */
        select: function(start,end) {
            $("#modal_add").openModal();
            var start = start.format('YYYY-MM-DD');
            var end = end.format('YYYY-MM-DD');
            $("#start").val(start);
            $("#end").val(end);

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
                        calendar.fullCalendar( 'refetchEvents' );
                        $("#modal_add").closeModal();
                    }
                });
            });
        },

        /**
         * Event Drop.. Setur inn nýjar uppls í gagnagrunn
         * @param event
         */
        eventDrop: function(event) {
            var start = event.start.format('YYYY-MM-DD HH:mm');
            var end = event.end.format('YYYY-MM-DD HH:mm');
            $.ajax({
                url: 'assets/updateevent.php',
                data: 'title='+ event.title + '&start='+ start +'&end='+ end +'&id='+ event.id ,
                type: "POST",
                success: function(json) {
                    calendar.fullCalendar( 'refetchEvents' );
                }
            });
        },

        /**
         * Event resize.. Setur inn nýjar uppls í gagnagrunn
         * @param event
         */
        eventResize: function(event) {
            var start = event.start.format('YYYY-MM-DD HH:mm');
            var end = event.end.format('YYYY-MM-DD HH:mm');
            $.ajax({
                url: 'assets/updateevent.php',
                data: 'title='+ event.title+'&start='+ start +'&end='+ end +'&id='+ event.id ,
                type: "POST",
                success: function(json) {
                    calendar.fullCalendar( 'refetchEvents' );
                }
            });
        },

        /**
         * Opnar modal til að sjá nánar um event
         * Delete event
         * Share event with user
         * @param event
         * @param element
         * @param title
         * @param start
         * @param end
         */
        eventClick: function(event, element, title, start, end) {
            $("#colabrator").html("");
            $("#modal_update").openModal();
            $("#eventInfo").html(
                "<h4 class='center'>" + event.title + "!</h4>" +
                "<p>Starts: " + event.start.format('DD-MM-YYYY HH:mm') + "<br>" +
                "Ends: " + event.end.format('DD-MM-YYYY HH:mm') + "<br>" +
                "Where? " + event.place + "</p>"
            );
            // Ef colabrator er ekki null þá byr hann til auka línu sem stendur á "Event Shared with: USER"
            if(event.colabrator != null){
                $("#colabrator").html("<p>Event shared with: " + event.colabrator +  " <button id='remove_btn' class='btn red'>Remove</button></p>");
            }

            // Button to invite users to event's
            $("#invite_btn").off('click').on('click',function () {
                var user = $("#invite").val();
                $.ajax({
                    url: 'assets/addusertoevent.php',
                    data: 'user=' + user + '&id=' + event.id,
                    type: 'POST',
                    success: function (data) {
                        console.log(data);
                        console.log("Ye");
                        calendar.fullCalendar( 'refetchEvents' );
                        $("#colabrator").html("<p>Event shared with: " + user +  "</p>");
                        $("#invite").val("");
                    },error: function () {
                        console.log("Error!");
                    }
                })
            });

            // Remove user from event
            $("#remove_btn").off('click').on('click',function () {
                $.ajax({
                    url: 'assets/removeuserevent.php',
                    data: 'id=' + event.id,
                    type: 'POST',
                    success: function (data) {
                        calendar.fullCalendar( 'refetchEvents' );
                        $("#modal_update").closeModal();
                    }
                })
            });

            // Delete event
            $("#delete").off("click").on("click", function () {
                    $.ajax({
                        url: 'assets/deleteevent.php',
                        data: 'id=' + event.id,
                        type: "POST",
                        success: function(json){
                            calendar.fullCalendar( 'refetchEvents' );
                        }
                    });
                $("#modal_update").closeModal();
            });
        }
    });
});
