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
        var nameStudent = $("#dash_student_nombre").val();
        var lastNameStudent = $("#dash_student_apellido").val();
        var dashStudentCorreo = $("#dash_student_correo").val();
        var dateStudent = $("#dash_student_fecha_nacimiento").val();
        var typeStudent = $("#dash_student_tipo_estudiante").val();
        
        console.log(nameStudent);
        console.log(lastNameStudent);
        console.log(dashStudentCorreo);
        console.log(dateStudent);
        console.log(typeStudent);
        
        
        var validForm = validateForms([
            { 'data': nameStudent, 'item': 'nameStudent', 'type': 'text', 'obligatory': true },
            { 'data': lastNameStudent, 'item': 'lastNameStudent', 'type': 'text', 'obligatory': true },
            { 'data': dashStudentCorreo, 'item': 'dashStudentCorreo', 'type': 'email', 'obligatory': true },
            { 'data': dateStudent, 'item': 'dateStudent', 'type': 'date', 'obligatory': true },
            { 'data': typeStudent, 'item': 'typeStudent', 'type': 'text', 'obligatory': true }
            
            
        ]);
        if (validForm["validate"]) {
            $("#sendInfoStudent").html("Ingresando Informacion...   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfoStudent").attr('disabled', true);
            actionEntry = insertStudent(nameStudent,lastNameStudent,dashStudentCorreo,dateStudent, typeStudent); 
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
                location.reload();
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

