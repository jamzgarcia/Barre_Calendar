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
        $("#sendInfoSede").off("click");
        $("#sendInfoSede").click(function () {
        console.log("dio clic para update");
        alert("Actualizar Datos Sede");
        var dash_sede_nombre = $("#dash_sede_nombre").val();
        var dash_sede_direccion = $("#dash_sede_direccion").val();
        var dash_sede_telefono = $("#dash_sede_telefono").val();
        
        console.log(dash_sede_nombre);
        console.log(dash_sede_direccion);
        console.log(dash_sede_telefono);
        
        
        var validForm = validateForms([
            { 'data': dash_sede_nombre, 'item': 'dash_sede_nombre', 'type': 'text', 'obligatory': true },
            { 'data': dash_sede_direccion, 'item': 'dash_sede_direccion', 'type': 'text', 'obligatory': true },
            { 'data': dash_sede_telefono, 'item': 'dash_sede_telefono', 'type': 'email', 'obligatory': true }
            
            
        ]);
        if (validForm["validate"]) {
            $("#sendInfoSede").html("Ingresando Informacion...   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfoSede").attr('disabled', true);
            actionEntry = insertSede(dash_sede_nombre,dash_sede_direccion,dash_sede_telefono); 
            $.when(actionEntry).done(function (respAction) {
                console.log(respAction);
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfoSede").html('Guardar Datos <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#updateInfoUser").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $("#formSede")[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Sede Actualizada Correctamente!',
                  showConfirmButton: false,
                  timer: 1500 
                })
                location.reload();
                console.log("Actualizar informacion  de la sede oki!!");
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

