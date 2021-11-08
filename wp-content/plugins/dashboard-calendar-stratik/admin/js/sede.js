$(document).ready(function() {
    console.log('sede.js ingrensado ok');
    
    $('#sedes').DataTable({
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
        var dash_coach_nombre = $("#dash_coach_nombre").val();
        var dash_coach_apellido = $("#dash_coach_apellido").val();
        var dash_coach_correo = $("#dash_coach_correo").val();
        var dash_coach_fecha_nacimiento = $("#dash_coach_fecha_nacimiento").val();
        
        console.log(dash_coach_nombre);
        console.log(dash_coach_apellido);
        console.log(dash_coach_correo);
        console.log(dash_coach_fecha_nacimiento);
        
        
        var validForm = validateForms([
            { 'data': dash_coach_nombre, 'item': 'dash_coach_nombre', 'type': 'text', 'obligatory': true },
            { 'data': dash_coach_apellido, 'item': 'dash_coach_apellido', 'type': 'text', 'obligatory': true },
            { 'data': dash_coach_correo, 'item': 'dash_coach_correo', 'type': 'email', 'obligatory': true },
            { 'data': dash_coach_fecha_nacimiento, 'item': 'dash_coach_fecha_nacimiento', 'type': 'date', 'obligatory': true }
            
            
        ]);
        if (validForm["validate"]) {
            $("#sendInfoCoach").html("Ingresando Informacion...   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfoCoach").attr('disabled', true);
            actionEntry = insertCoach(dash_coach_nombre,dash_coach_apellido,dash_coach_correo,dash_coach_fecha_nacimiento); 
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

