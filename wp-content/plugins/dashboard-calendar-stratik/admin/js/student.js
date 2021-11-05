$(document).ready(function() {
    console.log('student.js ingrensado ok');
    
    $('#students').DataTable({
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

        $("#sendInfoStudent").off("click");
        $("#sendInfoStudent").click(function () {
        console.log("dio clic para update");
        alert("Actualizar Datos Estudiante");
        var dash_student_nombre = $("#dash_student_nombre").val();
        var dash_student_apellido = $("#dash_student_apellido").val();
        var dash_student_correo = $("#dash_student_correo").val();
        var dash_student_fecha_nacimiento = $("#dash_student_fecha_nacimiento").val();
        var dash_student_tipo_estudiante = $("#dash_student_tipo_estudiante").val();
        
        console.log(dash_student_nombre);
        console.log(dash_student_apellido);
        console.log(dash_student_correo);
        console.log(dash_student_fecha_nacimiento);
        console.log(dash_student_tipo_estudiante);
        
        
        var validForm = validateForms([
            { 'data': dash_student_nombre, 'item': 'dash_student_nombre', 'type': 'text', 'obligatory': true },
            { 'data': dash_student_apellido, 'item': 'dash_student_apellido', 'type': 'text', 'obligatory': true },
            { 'data': dash_student_correo, 'item': 'dash_student_correo', 'type': 'email', 'obligatory': true },
            { 'data': dash_student_fecha_nacimiento, 'item': 'dash_student_fecha_nacimiento', 'type': 'date', 'obligatory': true },
            { 'data': dash_student_tipo_estudiante, 'item': 'dash_student_tipo_estudiante', 'type': 'text', 'obligatory': true }
            
            
        ]);
        if (validForm["validate"]) {
            $("#sendInfoStudent").html("Ingresando Informacion...   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfoStudent").attr('disabled', true);
            actionEntry = insertStudent(dash_student_nombre,dash_student_apellido,dash_student_correo,dash_student_fecha_nacimiento, dash_student_tipo_estudiante); 
            $.when(actionEntry).done(function (respAction) {
                console.log(respAction);
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfoStudent").html('Guardar Datos <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#updateInfoUser").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $("#formStudent")[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Estudiante Actualizado Correctamente!',
                  showConfirmButton: false,
                  timer: 1500 
                })
               // location.reload();
                console.log("Actualizar informacion  del estudiante oki!!");
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

