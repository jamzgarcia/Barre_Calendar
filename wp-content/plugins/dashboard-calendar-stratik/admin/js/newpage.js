$(document).ready(function () {
    console.log('Entry Intermediario Page');  
    
    $("#sendInfo").off("click");
    $("#sendInfo").click(function () {
        //alert("dio clic");
        var names = $("#names").val(); 
        var type_identity = $("#type_identity").val();
        var identify = $("#identify").val();
        var email = $("#email").val();
        var phone = $("#phone").val(); 
        var pais = $("#pais").val();
        var departamento = $("#departamento").val();
        var city = $("#city").val();
        var adress_to_insp = $("#adress_to_insp").val();
        var name_edif_to_insp = $("#name_edif_to_insp").val();
        var name_pers_to_insp = $("#name_pers_to_insp").val();
        var numb_cont_to_insp = $("#numb_cont_to_insp").val();
        var desc_site_to_insp = $("#desc_site_to_insp").val();
        var user_id_wp = $("#user_id_wp").val();
        
      
        
        console.log(city);
        var validForm = validateForms([
            { 'data': names, 'item': 'names', 'type': 'text', 'obligatory': true },
            { 'data': type_identity, 'item': 'type_identity', 'type': 'text', 'obligatory': true },
            { 'data': identify, 'item': 'identify', 'type': 'text', 'obligatory': true },
            { 'data': email, 'item': 'email', 'type': 'text', 'obligatory': true },
            { 'data': phone, 'item': 'phone', 'type': 'text', 'obligatory': true },
            { 'data': pais, 'item': 'pais', 'type': 'text', 'obligatory': true },
            { 'data': departamento, 'item': 'departamento', 'type': 'text', 'obligatory': true },
            { 'data': city, 'item': 'city', 'type': 'text', 'obligatory': true },
            { 'data': adress_to_insp, 'item': 'adress_to_insp', 'type': 'text', 'obligatory': true },
            { 'data': name_edif_to_insp, 'item': 'name_edif_to_insp', 'type': 'text', 'obligatory': true },
            { 'data': name_pers_to_insp, 'item': 'name_pers_to_insp', 'type': 'text', 'obligatory': true },
            { 'data': numb_cont_to_insp, 'item': 'numb_cont_to_insp', 'type': 'text', 'obligatory': true },
            { 'data': desc_site_to_insp, 'item': 'desc_site_to_insp', 'type': 'text', 'obligatory': true },
            { 'data': user_id_wp, 'item': 'user_id_wp', 'type': 'text', 'obligatory': true }
           
        ]);
        if (validForm["validate"]) {


            $("#sendInfo").html("Ingresando Datos...  <i class='fa fa-spinner fa-spin' style='font-size:30px'></i>");
            $("#sendInfo").attr('disabled', true);
            actionEntry = insertIntermediario(names,type_identity,identify,email,phone,pais,departamento,city,adress_to_insp,name_edif_to_insp,name_pers_to_insp,numb_cont_to_insp,desc_site_to_insp,user_id_wp);
           //actionEntry = null;
            $.when(actionEntry).done(function (respAction) {
                //console.log(respAction);
            }).fail(function (respFail) {
                //console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfo").html('Ingresar Datos <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#sendInfo").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $("#formQuestions")[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Datos Ingresados Correctamente!', 
                  showConfirmButton: false,
                  timer: 1500
                });
                    location.reload();
                    console.log("Enviar informacion okii");  
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
    
    
    $("#sendInfoAsigned").off("click");
    $("#sendInfoAsigned").click(function () {
        var fecha_solicitud_insp = $("#fecha_solicitud_insp").val(); 
        var user_id = $("#user_id").val();
        
        console.log(fecha_solicitud_insp); 
        console.log(user_id);
        
        var validForm = validateForms([
            { 'data': fecha_solicitud_insp, 'item': 'fecha_solicitud_insp', 'type': 'text', 'obligatory': true },
            { 'data': user_id, 'item': 'user_id', 'type': 'text', 'obligatory': true }
           
        ]);
        if (validForm["validate"]) {
            $("#sendInfoAsigned").html("Ingresando Datos...  <i class='fa fa-spinner fa-spin' style='font-size:30px'></i>");
            $("#sendInfoAsigned").attr('disabled', true);
            actionEntry = insertIntermediario2(fecha_solicitud_insp,user_id); 
           //actionEntry = null;
            $.when(actionEntry).done(function (respAction) {
                //console.log(respAction);
            }).fail(function (respFail) { 
                //console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfoAsigned").html('Ingresar Datos <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#sendInfoAsigned").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $("#formQuestions")[0].reset();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Usuario Asignado Correctamente!',
                  showConfirmButton: false,
                  timer: 1500
                })
                //  location.reload();  
                 window.location.href = 'https://iesconsultores.com/formulario-para-intermediarios-evaluacion/';
                console.log("Enviar informacion okii");  
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
});