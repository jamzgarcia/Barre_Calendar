$(document).ready(function() {
    console.log('shortcode_calendar_users.js ok ok ok :D');
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        locale:"es",
        
        defaultDate: '2021-11-05',
        buttonIcons: true,
        weekNumbers: false,
        editable: true,
        eventLimit: true,
        events: [
            {
                title: 'Viaje Cartagena',
                description: 'Que Chimba hp',
                start: '2021-11-16',
                color: '#000',
                textColor: '#ffffff',
            }
        ],
        dayClick: function (date, jsEvent, view) {
            alert('Has hecho click en: '+ date.format());
            $('exampleModal').modal("show");
            
        }, 
        eventClick: function (calEvent, jsEvent, view) {
            $('#event-title').text(calEvent.title);
            $('#event-description').html(calEvent.description);
            $('#modal-event').modal();
        },  
    });
});