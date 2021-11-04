$(document).ready(function() {
  console.log('view_calendar_users.js');
    $("#calendar").fullCalendar({
      header: {
        left: "prev,next,today",
        center: "title",
        right: "month,agendaWeek,agendaDay"
      },

      locale: 'es',

      defaultView: "month",
      navLinks: true,
      editable: true,
      eventLimit: true,
      selectable: true,
      selectHelper: false,

      //Nuevo Evento
      select: function(start, end) {
        
        $("#exampleModal").modal();

        $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));

        var valorFechaFin = end.format("DD-MM-YYYY");
        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); //Le resto 1 dia
        $('input[name=fecha_fin').val(F_final);

      },

      events: [
       // <?php
      //  while ($dataEvento = mysqli_fetch_array($resulEventos)) { ?> {
     //       _id: '<?php echo $dataEvento['id']; ?>',
     //       title: '<?php echo $dataEvento['evento']; ?>',
     //       start: '<?php echo $dataEvento['fecha_inicio']; ?>',
     //       end: '<?php echo $dataEvento['fecha_fin']; ?>',
     //       color: '<?php echo $dataEvento['color_evento']; ?>'
    
    // },
     //   <?php 
    // } ?>
        ],


      //Eliminar Evento
      eventRender: function(event, element) {
        element
          .find(".fc-content")
          .prepend("<span id='btnCerrar'; class='closeon material-icons'>&#xe5cd;</span>");

        //Eliminar evento
        element.find(".closeon").on("click", function() {

          var pregunta = confirm("Deseas Borrar este Evento?");
          if (pregunta) {

            $("#calendar").fullCalendar("removeEvents", event._id);

            $.ajax({
              type: "POST",
              url: 'deleteEvento.php',
              data: {
                id: event._id
              },
              success: function(datos) {
                $(".alert-danger").show();

                setTimeout(function() {
                  $(".alert-danger").slideUp(500);
                }, 3000);

              }
            });
          }
        });
      },


      //Moviendo Evento Drag - Drop
      eventDrop: function(event, delta) {
        var idEvento = event._id;
        var start = (event.start.format('DD-MM-YYYY'));
        var end = (event.end.format("DD-MM-YYYY"));

        $.ajax({
          url: 'drag_drop_evento.php',
          data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
          type: "POST",
          success: function(response) {
            // $("#respuesta").html(response);
          }
        });
      },

      //Modificar Evento del Calendario 
      eventClick: function(event) {
        var idEvento = event._id;
        $('input[name=idEvento').val(idEvento);
        $('input[name=evento').val(event.title);
        $('input[name=fecha_inicio').val(event.start.format('DD-MM-YYYY'));
        $('input[name=fecha_fin').val(event.end.format("DD-MM-YYYY"));

        $("#modalUpdateEvento").modal();
      },


    });


    //select all the a tag with name equal to modal
    $('a[name=modal]').click(function(e) {
      //Cancel the link behavior
      e.preventDefault();
      //Get the A tag
      var id = $(this).attr('href');

      //Get the screen height and width
      var maskHeight = $(document).height();
      var maskWidth = $(window).width();

      //Set height and width to mask to fill up the whole screen
      $('#mask').css({'width':maskWidth,'height':maskHeight});
      
      //transition effect             
      $('#mask').fadeIn(1000);        
      $('#mask').fadeTo("slow",0.8);  

      //Get the window height and width
      var winH = $(window).height();
      var winW = $(window).width();
    
      //Set the popup window to center
      $(id).css('top',  winH/2-$(id).height()/2);
      $(id).css('left', winW/2-$(id).width()/2);

      //transition effect
      $(id).fadeIn(2000); 

});

//if close button is clicked
$('.window .close').click(function (e) {
      //Cancel the link behavior
      e.preventDefault();
      $('#mask, .window').hide();
});             

//if mask is clicked
$('#mask').click(function () {
      $(this).hide();
      $('.window').hide();
});  



   

    //Oculta mensajes de Notificacion
    setTimeout(function() {
      $(".alert").slideUp(300);
    }, 3000);
  });