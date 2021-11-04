document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',

          locale: "es",

            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,listWeek'
            },

            dateClick:function(info){
              $("#evento").modal("show");

            }
        });
        calendar.render();
      });
