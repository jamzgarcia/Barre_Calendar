$(document).ready(function() {
    console.log('coach.js ingrensado ok');
    
    $('#coaches').DataTable({
        //para cambiar el lenguaje a español
            "language": {
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sSearch": "Buscar:",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast":"Último",
                        "sNext":"Siguiente",
                        "sPrevious": "Anterior"
                     },
                     "sProcessing":"Procesando...",
                }
        });
        $("#sendInfoCoach").off("click");
$("#sendInfoCoach").click(function () {
        console.log("dio clic para update");
        alert("Actualizar Datos Coach");
        var nameCoach = $("#dash_coach_nombre").val();
        var lastNameCoach = $("#dash_coach_apellido").val();
        var emailCoach = $("#dash_coach_correo").val();
        var dateCoach = $("#dash_coach_fecha_nacimiento").val();
        
        console.log(nameCoach);
        console.log(lastNameCoach);
        console.log(emailCoach);
        console.log(dateCoach);
        
        
        var validForm = validateForms([
            { 'data': nameCoach, 'item': 'nameCoach', 'type': 'text', 'obligatory': true },
            { 'data': lastNameCoach, 'item': 'lastNameCoach', 'type': 'text', 'obligatory': true },
            { 'data': emailCoach, 'item': 'emailCoach', 'type': 'email', 'obligatory': true },
            { 'data': dateCoach, 'item': 'dateCoach', 'type': 'date', 'obligatory': true }
            
            
        ]);
        if (validForm["validate"]) {
            $("#sendInfoCoach").html("Ingresando Informacion...   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfoCoach").attr('disabled', true);
            actionEntry = insertCoach(nameCoach,lastNameCoach,emailCoach,dateCoach); 
            $.when(actionEntry).done(function (respAction) {
                console.log(respAction);
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfoCoach").html('Guardar Datos <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#updateInfoUser").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $("#formCoach")[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Coach Actualizado Correctamente!',
                  showConfirmButton: false,
                  timer: 1500
                })
                location.reload();
                console.log("Actualizar informacion  del coach oki!!");
            });
        }
        else {
            $(".itemIncorrect").each(function () {
                $(this).removeClass("itemIncorrect");
            });
            $.each(validForm["items"], function (index, label) {
                $("#label_" + label).addClass("itemIncorrect");
            });
        }
    });
} );

