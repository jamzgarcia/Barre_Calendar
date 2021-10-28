function loadAnswers(){
    $("#contentAnswers").children().remove();
    let detailReport = getAllReports();
    $.when(detailReport).done(function (respReports) {
        console.log(respReports);
        if (respReports["code"] == 200) {
            var detail = "";
            var num = 1
            $.each(respReports["result"], function (index, value) {
                detail += "<tr><th scope='col' class='text-center'>"+num+"</th><td style='width: 100px'>"+value["names"]+"</td><td style='width: 100px'>"+value["last_names"]+"</td><td style='width: 100px'>"+value["document"]+"</td><td style='width: 100px'>"+value["date_report"]+"</td><td style='width: 100px'><a href='"+value["attached_report"]+"' target='_blank'>Ver Reporte <i class='fa fa-file-pdf-o' aria-hidden='true'></a></td><td class='text-center' style='width: 100px'><button class='btn btn-info viewReport' data-user='"+value["id_user"]+"'>Ver Reporte <i class='fa fa-file-image-o' aria-hidden='true'></button></td><td class='text-center' style='width: 100px'><button class='btn btn-outline-danger deleteReport' data-user='"+value["id_user"]+"'><i class='fa fa-trash' aria-hidden='true'></button></td></tr>";
                num+=1;
            });
            $("#contentAnswers").append(detail);
        }
        else {
            toastr_message(respReports["code"], respReports["message"]);
        }
    }).fail(function (respFail) {
        console.log(respFail);
    }).always(function (respAlways) {

    });
}

function deleteRep(id_user){
    $("#titleModal").text("Notificación");
    $("#bodyTag").append("<p>Seguro desea eliminar este reporte?</p>");
    $("#btnModal").html('Eliminar <i class="fa fa-trash" aria-hidden="true"></i>')
    $("#btnModal").off("click");
    $("#btnModal").click(function (e) {
        $("#btnModal").html("Eliminando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
        $("#btnModal").attr('disabled', true);
        deleteReport(id_user).done(function (respDone) {
            toastr_message(respDone["code"], respDone["message"]);
        }).fail(function (respFail) {
            console.log(respFail);
        }).always(function (respAlways) {
            $("#btnModal").html('Eliminar Pregunta <i class="fa fa-trash aria-hidden="true"></i>');
            $("#btnModal").removeAttr('disabled');
            $("#ModalObs").modal("hide");
            loadAnswers();
        });
        e.preventDefault();
    });
    $("#ModalObs").modal("show");
}

function viewRep(id_user){
    let detailReport = reportsImage(id_user);
    $.when(detailReport).done(function (respReports) {
        console.log(respReports);
        if (respReports["code"] == 200) {
            $("#titleModalLarge").text("Reporte de Imagenes");
            // $("#bodyTagLarge").children().remove();
            var detail = "";
            $.each(respReports["result"], function (index, value) {
                var div_image = "";
                div_image = "<div class='col-sm-12 col-md-12 col-xl-12 w-100 p-3' align='center'><img id='imageQuestion' src='../" + value["answer_file"] + "' class='rounded mx-auto d-block' style='width: 50%; height: 50%;'></div><br>";
                detail += "<div class='row'><div class='col-lg-12'><label class='control-label'>" + value["description_question"] + "</label></div></div>" + div_image + "<hr class='style1'>";
            });
            $("#bodyTagLarge").append(detail);
            $("#btnModalLarge").addClass("d-none");
            $("#ModalLarge").modal("show");
        }
        else {
            toastr_message(respReports["code"], respReports["message"]);
        }
    }).fail(function (respFail) {
        console.log(respFail);
    }).always(function (respAlways) {

    });
}

$(document).ready(function () {
    $(".deleteReport").click(function (e) { 
        var id_user = $(this).data('user');
        deleteRep(id_user);
        e.preventDefault();
    });
    $(".viewReport").click(function (e) { 
        var id_user = $(this).data('user');
        viewRep(id_user);
        e.preventDefault();
    });
    $("#ModalLarge").on('hidden.bs.modal', function () {
        $("#bodyTagLarge").children().remove();
    });
    $("#ModalObs").on('hidden.bs.modal', function () {
        $("#bodyTag").children().remove();
    });
});