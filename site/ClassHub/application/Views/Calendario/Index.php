<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-body no-padding">
                <!-- THE CALENDAR -->
                <div id="calendar"></div>
            </div><!-- /.box-body -->
        </div><!-- /. box -->
    </div><!-- /.col -->
</div>

<script type="text/javascript">
    $(function () {



        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            lang: 'pt-br',
            buttonText: {
                today: 'Hoje',
                month: 'Mês',
                week: 'Semana',
                day: 'Dia'
            },
            //Random default events
            events: '<?=URL?>handler/Calendario/GetAll/',
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar !!!
            drop: function (date, allDay) { // this function is called when something is dropped

                // retrieve the dropped element's stored Event Object
                var originalEventObject = $(this).data('eventObject');

                // we need to copy it, so that multiple events don't have a reference to the same object
                var copiedEventObject = $.extend({}, originalEventObject);

                // assign it the date that was reported
                copiedEventObject.start = date;
                copiedEventObject.allDay = allDay;
                copiedEventObject.backgroundColor = $(this).css("background-color");
                copiedEventObject.borderColor = $(this).css("border-color");

                // render the event on the calendar
                // the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
                $('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }

            },
            eventDrop: function(event){
                var sendObj = {
                    id : event.id,
                    start : ((event.start != null) ? event.start.format("YYYY-MM-DD hh:mm:ss") : ''),
                    end : ((event.end != null) ?  event.end.format("YYYY-MM-DD hh:mm:ss") : '')
                };
                $.post('<?=URL?>handler/Calendario/UpdateEvent/', sendObj, function(data){
                });
            },
            eventResize: function(event){
                var sendObj = {
                    id : event.id,
                    start : ((event.start != null) ? event.start.format("YYYY-MM-DD hh:mm:ss") : ''),
                    end : ((event.end != null) ?  event.end.format("YYYY-MM-DD hh:mm:ss") : '')
                };
                $.post('<?=URL?>handler/Calendario/UpdateEvent/', sendObj, function(data){
                });
            }
        });


    });
</script>