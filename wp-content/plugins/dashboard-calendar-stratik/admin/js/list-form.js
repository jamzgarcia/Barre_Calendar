function questionMultiple(number, type, array_options = false) {
    console.log("Entro a multiple " + number);
    $("#div_options").children().remove();
    var div_info = '<hr class="style1"><div class="control-group p-3 alert-info"><label class="label label-default font-weight-bold">Defina cada una de las opciones para esta pregunta</label></div><hr class="style1">';
    $("#div_options").append(div_info);
    if (array_options != false) {
        $.each(array_options, function (index, val) {
            options = '<div class="row text-center" id="label_answer_' + val["id_option"] + '"><div class="col-lg-1"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="'+type+'" name="question" id="option_' + val["id_option"] + '" value="option_' + val["id_option"] + '"></div></div><div class="col-lg-5"><input id="answer_' + val["id_option"] + '" class="form-control form-control-sm txtQuestion" value="' + val["text_option"] + '" data-option="' + val["id_option"] + '" type="text" placeholder="Escriba aqui la opción ' + val["id_option"] + '"></div></div>';
            $("#div_options").append(options);
        });
    }
    else {
        for (var i = 1; i <= number; i++) {
            // options = '<div class="row text-center" id="label_answer_' + i + '"><div class="col-lg-1"><div class="form-check p-1 "><input class="form-check-input radioQuestion" type="'+type+'" name="question" id="option_' + i + '" value="option_' + i + '" disabled="disabled"></div></div><div class="col-lg-5 p-1"><input id="answer_' + i + '" class="form-control form-control-sm txtQuestion" value="" data-option="' + i + '" type="text" placeholder="Escriba aqui la opción ' + i + '"></div><div class="col-lg-2 inputGroupContainer"><label class="control-label input-label font-weight-bold" id="label_attached_' + i + '">Adjuntar archivo:</label></div><div class="col-lg-1 inputGroupContainer"><div class="btn-group" data-toggle="buttons"><label class="btn btn-outline-success btn-sm optAttach attached_option_' + i + '" data-item="attached_option_' + i + '" data-val="Si"><input class="form-control" type="radio" name="attached_option_' + i + '">Si <i class="fa fa-check" aria-hidden="true"></i></label><label class="btn btn-outline-danger btn-sm optAttach attached_option_' + i + ' active" data-item="attached_option_' + i + '" data-val="No"><input class="form-control" type="radio" name="attached_option_' + i + '">No <i class="fa fa-times" aria-hidden="true"></i></label></div></div><div class="col-lg-3"><div id="div_link_attached_option_' + i + '" class="d-none animated fadeIn"><div class="form-group"><div class="input-group input-file link_attached_option_' + i + '" name="fileAttached_' + i + '"><span class="input-group-btn"><button class="btn btn-default btn-choose btn-sm" type="button">Adjuntar</button></span><input type="text" class="form-control form-control-sm" placeholder="Adjunte el archivo..." /><span class="input-group-btn"><button class="btn btn-warning btn-reset btn-sm" type="button">Reset</button></span></div></div></div></div></div>';
            options = '<div class="row text-center" id="label_answer_' + i + '"><div class="col-lg-1"><div class="form-check p-1 "><input class="form-check-input radioQuestion" type="' + type + '" name="question" id="option_' + i + '" value="option_' + i + '" disabled="disabled"></div></div><div class="col-lg-5 p-1"><input id="answer_' + i + '" class="form-control form-control-sm txtQuestion" value="" data-option="' + i + '" type="text" placeholder="Escriba aqui la opción ' + i + '"></div><div class="col-lg-5 p-1"><input id="answer_custom_' + i + '" class="form-control form-control-sm" value="" data-item="answer" data-option="' + i + '" type="text" placeholder="Escriba aqui la respuesta para la opción ' + i + '"></div></div>';
            $("#div_options").append(options);
            // bs_input_file('.input-file.link_attached_option_' + i);
            $(".optAttach").click(function () {
                var item_option = $(this).data('item');
                console.log(item_option);
                if ($(this).data('val') == "Si") {
                    $("#div_link_" + item_option).removeClass("d-none");
                }
                else if ($(this).data('val') == "No") {
                    $("#div_link_" + item_option).addClass("d-none");
                }
            });
        }
    }
}

function questionBinary(array_options = false) {
    console.log("Entro a verdadero o falso ");
    $("#div_options").children().remove();
    var options = '<hr class="style1"><div class="control-group p-3 alert-info"><label class="label label-default font-weight-bold">Seleccione el tipo riesgo.</label></div><hr class="style1">';
    var selectRisk = '<div class="col-lg-4"><label class="label label-default font-weight-bold">Nivel de Riesgo</label><div class="input-group" id="selectRisk"><select class="form-control novelty form-control-sm selectRisk"><option value="--">--</option>';
    for (let i = 1; i <= 10; i++) {
        selectRisk = selectRisk+'<option value="'+i+'">'+i+'</option>';
    }
    selectRisk = selectRisk +'</select></div></div>';
    if (array_options != false) {
        $.each(array_options, function (index, val) {
            options = options + '<div class="col-lg-6" id="label_TrueFalse"><div class="form-check p-1"><input class="form-check-input radioQuestion optTrueFalse" type="radio" name="question" id="option_' + val["id_option"] + '" value="option_' + val["id_option"] + '" ' + valid_check + '><label class="label label-default font-weight-bold" data-option=' + val["id_option"] + ' data-item="text">' + val["text_option"] + '</label></div></div>';
        });
        $("#div_options").append(options);
    }
    else {
        options = options + '<div class="row p-1">' + selectRisk +'</div><hr class="style1">    ';
        options = options + '<div class="row"><div class="col-lg-1" id="label_TrueFalse"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="radio" name="question" id="option_1" value="1" disabled="disabled"></div></div><div class="col-lg-2"><label class="label label-default font-weight-bold">Si</label></div><div class="col-lg-5 p-1"><input id="answer_custom_yes" class="form-control form-control-sm" value="" data-item="answer" data-option="yes" type="text" placeholder="Escriba aqui la respuesta para la opción Si"></div></div>';
        options = options + '<div class="row"><div class="col-lg-1"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="radio" name="question" id="option_2" value="0" disabled="disabled"></div></div><div class="col-lg-2"><label class="label label-default font-weight-bold">No</label></div><div class="col-lg-5 p-1"><input id="answer_custom_not" class="form-control form-control-sm" value="" data-item="answer" data-option="not" type="text" placeholder="Escriba aqui la respuesta para la opción No"></div></div>';
        options = options + '<div class="row"><div class="col-lg-1"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="radio" name="question" id="option_3" value="2" disabled="disabled"></div></div><div class="col-lg-2"><label class="label label-default font-weight-bold">N/A</label></div><div class="col-lg-5 p-1"><input id="answer_custom_na" class="form-control form-control-sm" value="" data-item="answer" data-option="na" type="text" placeholder="Escriba aqui la respuesta para la opción N/A"></div></div>';
        $("#div_options").append(options);
    }
}

function showQuestion(type,infoQuestion) {
    var show_detail = "";
    if (type == 1) {
        show_detail = '<div class="col-lg-4"><div class="input-group"><input id="" class="form-control form-control-sm" value="" type="date"></div></div>';
    }
    else if (type == 2) {
        // show_detail = '<div class="col-lg-4"><div class="input-group"><input id="" class="form-control form-control-sm" value="" type="text"></div></div>';
        show_detail = '<div class="col-lg-8"><div class="input-group"><textarea id="" class="form-control form-control-sm" value="" type="text"></textarea></div></div>';
    }
    else if (type == 3) {
        show_detail = '<div class="col-lg-4"><div class="input-group"><input id="" class="form-control form-control-sm" value="" type="number"></div></div>';
    }
    else if (type == 4 || type == 6) {
        show_detail += '<div class="col-lg-6"><div class="row text-center" id=""><div class="col-lg-8"><select class="form-control form-control-sm selectForm">';
        show_detail += (type == 4) ?'<option value="--">--</option>':'';
        $.each(infoQuestion["dataOptions"], function (index, value) { 
            var selected = (value["description_option"] == "N/A")?'selected':'';
            show_detail += '<option value="'+value["id_option"]+'" '+selected+'>' + value["description_option"] +'</option>';
        });
        show_detail += '</select></div></div></div>';
    }
    else if (type == 5) {
        show_detail += '<div class="col-lg-6">';
        var type_input = (type == 5)?"checkbox":"radio";
        $.each(infoQuestion["dataOptions"], function (index, value) { 
            show_detail += '<div class="row text-center" id=""><div class="col-lg-1"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="' + type_input + '" name="question" id="" value=""></div></div><div class="col-lg-5"><label class="label label-default">' + value["description_option"] +'</label></div></div>';
        });
        show_detail += '</div>';
    }
    else if (type == 7) {
        show_detail = '<div class="col-lg-6"><div class="form-group"><div class="input-group input-file" name="fileAttached"><span class="input-group-btn"><button class="btn btn-default btn-choose btn-sm" type="button">Adjuntar</button></span><input type="text" class="form-control form-control-sm" placeholder="Escoge el archivo..." /><span class="input-group-btn"><button class="btn btn-warning btn-reset btn-sm" type="button">Reset</button></span></div></div></div>';
    }
    return show_detail;
}

function dataOptions(typeQuestion) {
    var items = Array();
    var dataSend = {};
    if (typeQuestion == 4 || typeQuestion == 5) {
        $(".txtQuestion").each(function () {
            var data_id = $(this).attr("id");
            var data_val = $(this).val();
            var num_option = $(this).data("option");
            var data_id_answer = $("input[data-item='answer'][data-option='"+num_option+"']").attr("id");
            var data_val_answer = $("input[data-item='answer'][data-option='"+num_option+"']").val();
            // var attached = $(".attached_option_" + num_option + ".active").data("val");
            // var text_fileAttached = $("#fileAttached_" + num_option).val();
            // var fileAttached = $("#fileAttached_" + num_option).prop('files')[0];
            dataSend[data_id] = { "text_option": data_val, "text_answer": data_val_answer, "attached": "No", "num_option": num_option }
            items.push({ 'data': data_val, 'item': data_id, 'type': 'text', 'obligatory': true });
            items.push({ 'data': data_val_answer, 'item': data_id_answer, 'type': 'text', 'obligatory': true });
            // dataSend[data_id] = { "text_option": data_val, "attached": attached, "num_option": num_option }
            // items.push({ 'data': data_val, 'item': data_id, 'type': 'text', 'obligatory': (attached == "No") ? true : false });
            // items.push({ 'data': text_fileAttached, 'item': 'attached_' + num_option, 'type': 'text', 'obligatory': (attached == "Si") ? true : false });
        });
    }
    else if (typeQuestion == 6) {
        var answer_yes = $("#answer_custom_yes").val();
        var answer_not = $("#answer_custom_not").val();
        var answer_na = $("#answer_custom_na").val();
        dataSend["option_1"] = { "text_option": "Si", "text_answer": answer_yes, "attached": "No", "num_option": 1 }
        dataSend["option_2"] = { "text_option": "No", "text_answer": answer_not, "attached": "No", "num_option": 2 }
        dataSend["option_3"] = { "text_option": "N/A", "text_answer": answer_na, "attached": "No", "num_option": 3 }
    }
    return { 'items': items, 'dataSend': dataSend };
}

function loadViewQuestions(){
    let listQuestions = getQuestions();
    $.when(listQuestions).done(function (respList) {
        console.log(respList);
        var bodyQuestions = ""
        var num = 1;
        $.each(respList["result"], function (key, value) { 
            bodyQuestions += "<tr><th scope='row' class='text-center'>" + num + "</th><td>" + value["description_question"] + "</td><td>" + value["description_type"] + "</td><td class='text-center'>" + ((value["is_dependent"] == 1)?"Si":"No") +"</td><td class='text-center'><button type='button' class='btn btn-info btnDetail' data-val='"+value["id_question"]+"'><i class='fa fa-eye' aria-hidden='true'></i></button></td><td class='text-center'><button type='button' class='btn btn-outline-danger btnDelete' data-val='"+value["id_question"]+"'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>"
            num+=1;
        });
        $("#contentQuestions").children().remove();
        $("#contentQuestions").append(bodyQuestions);
        $(".btnDelete").off("click");
        $(".btnDelete").click(function(){
            var id_question = $(this).data('val');
            $("#titleModal").text("Notificación");
            $("#bodyTag").append("<p>Seguro desea eliminar esta pregunta?</p>");
            $("#btnModal").html('Eliminar <i class="fa fa-trash" aria-hidden="true"></i>')
            $("#btnModal").off("click");
            $("#btnModal").click(function (e) { 
                actionQuestion = deleteQuestion(id_question);
                $("#btnModal").html("Eliminando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
                $("#btnModal").attr('disabled', true);
                $.when(actionQuestion).done(function (respAction) {
                    console.log(respAction);
                    toastr_message(respAction["code"], respAction["message"]);
                }).fail(function (respFail) {
                    console.log(respFail);
                }).always(function (respAlways) {
                    $("#btnModal").html('Eliminar Pregunta <i class="fa fa-trash aria-hidden="true"></i>');
                    $("#btnModal").removeAttr('disabled');
                    $("#ModalObs").modal("hide");
                    loadViewQuestions();
                });
                e.preventDefault();
                
            });
            $("#ModalObs").modal("show");
        });
        $(".btnDetail").off("click");
        $(".btnDetail").click(function(){
            var id_question = $(this).data('val');
            let detailQuestion = getQuestionId(id_question);
            $.when(detailQuestion).done(function (respQuestion) {
                console.log(respQuestion);
                var infoQuestion = respQuestion["result"];
                if (respQuestion["code"] == 200) {
                    $("#titleModalLarge").text("Visualización de Pregunta");
                    $("#bodyTagLarge").children().remove();
                    var div_image = "";
                    if (infoQuestion["attached"] == 1) {
                        div_image = "<div class='col-sm-12 col-md-12 col-xl-12 w-100 p-3' align='center'><img id='imageQuestion' src='../"+infoQuestion["link_attached"]+"' class='rounded mx-auto d-block' style='width: 50%; height: 50%;'></div><br>";
                    }
                    var detail = "<div class='row'><div class='col-lg-12'><label class='control-label input-label font-weight-bold'>Descripción de la pregunta:</label><br><label class='control-label'>" + infoQuestion["description_question"] + "</label></div></div><div class='row'><div class='col-lg-12'><label class='control-label input-label font-weight-bold'>Respuesta de la pregunta:</label><br><label class='control-label'>" + infoQuestion["description_answer"] + "</label></div></div>"+div_image+"<hr class='style1'>";
                    detail = detail+"<div class='row'>"+showQuestion(infoQuestion["id_type_question"],infoQuestion)+"</div>";
                    $("#bodyTagLarge").append(detail);
                    if (infoQuestion["id_type_question"] == 7) {
                        $(function () {
                            bs_input_file(".input-file");
                        });
                    }
                    $("#btnModalLarge").addClass("d-none");
                    $("#ModalLarge").modal("show");
                }
                else {
                    toastr_message(respQuestion["code"], respQuestion["message"]);
                }
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {

            });
        });
        $("#ModalLarge").on('hidden.bs.modal', function() {
            $("#bodyTagLarge").children().remove();
        });
        $("#ModalObs").on('hidden.bs.modal', function() {
            $("#bodyTag").children().remove();
        });
    }).fail(function (respFail) {
        console.log(respFail);
    }).always(function (respAlways) {
    });
}

function loadCreateQuestions() {
    /* $(function () {
        bs_input_file(".input-file");
    }); */
    $(".attached").off("click");
    $(".attached").click(function () {
        console.log("Entro al boton attach")
        if ($(this).data('val') == "Si") {
            $("#div_link_attached").removeClass("d-none");
        }
        else if ($(this).data('val') == "No") {
            $("#div_link_attached").addClass("d-none");
        }
    });
    $(".dependent").off("click");
    $(".dependent").click(function () {
        console.log("Entro al boton attach")
        if ($(this).data('val') == "Si") {
            $("#div_dependent").removeClass("d-none");
            getQuestions().done(function(respQuestions){
                console.log(respQuestions);
                if (respQuestions["code"] == 200) {   
                    var selectQuestion = '<select class="form-control novelty form-control-sm selectQuestion"><option value="--" selected>--</option>';
                    $.each(respQuestions["result"], function (index, value) { 
                        if (value["id_type_question"] == 4 || value["id_type_question"] == 6) {
                            selectQuestion += '<option value="'+value["id_question"]+'">'+value["description_question"]+'</option>';
                        }
                    });
                    selectQuestion += '</select>';
                    $("#selectQuestion").children().remove();
                    $("#selectQuestion").append(selectQuestion);
                    $(".selectQuestion").change(function (e) { 
                        var id_question_sel = $(this).val();
                        if (id_question_sel != "--") {
                            getQuestionId($(this).val()).done(function(respOptions){
                                console.log(respOptions);
                                var show_detail = '<div class="col-lg-6">';
                                $.each(respOptions["result"]["dataOptions"], function (index, value) {
                                    show_detail += '<div class="row text-center" id=""><div class="col-lg-1"><div class="form-check p-1"><input class="form-check-input radioQuestion" type="checkbox" name="question" id="' + value["id_option"] + '" data-question="' + id_question_sel + '" value="' + value["id_option"] + '"></div></div><div class="col-lg-5"><label class="label label-default">' + value["description_option"] + '</label></div></div>';
                                });
                                show_detail += '</div>';
                                $("#div_dependent_options").children().remove();
                                $("#div_dependent_options").append(show_detail);
                                $("#div_dependent_options").removeClass("d-none");
                            }).fail(function(respFail){
                                console.log(respFail)
                            });
                        }
                        else {
                            $("#div_dependent_options").children().remove();
                            $("#div_dependent_options").addClass("d-none");
                        }
                        e.preventDefault();
                    });
                }
                else {
                    toastr_message(500, "No hay ninguna pregunta ingresada primero cree una.");
                }
            }).fail(function(respFail){
                console.log(respFail);
            })
        }
        else if ($(this).data('val') == "No") {
            $("#selectQuestion").children().remove();
            $("#div_dependent_options").children().remove();
            $("#div_dependent").addClass("d-none");
        }
    });
    $(".selectType").change(function (e) {
        $("#div_options").children().remove();
        $("#num_options").val('');
        if ($(this).val() == 4 || $(this).val() == 5) {
            $("#div_num_options").removeClass("d-none");
            $("#div_options").removeClass("d-none");
            $("#description_answer").attr("disabled", true);
            $("#description_answer").val('');
            // questionMultiple();
        }
        else if ($(this).val() == 6) {
            $("#div_num_options").addClass("d-none");
            $("#num_options").val('');
            $("#div_options").removeClass("d-none");
            $("#description_answer").attr("disabled", true);
            $("#description_answer").val('');
            questionBinary();
        }
        else {
            $("#div_options").addClass("d-none");
            $("#div_num_options").addClass("d-none");
            $("#num_options").val('');
            $("#description_answer").removeAttr("disabled");
        }
        e.preventDefault();
    });
    $("#num_options").keyup(function () {
        if ($(this).val() != "" && $(this).val() != 0 && $(this).val() > 1 && $(this).val() <= 12) {
            var type = ($(".selectType").val() == 4)?'radio':'checkbox';
            questionMultiple($(this).val(), type);
        }
        else {
            var text_message = ($(this).val() == 0 || $(this).val() == 1) ? "Debe ingresar al menos 2 opciones." : "Ingrese una cantidad valida de opciones.";
            // var toastMessage_ = { "service": "Alerta", "500": text_message };
            toastr_message(500, text_message);
            $("#div_options").children().remove();
        }
    });
    $("#saveQuestion").off("click");
    $("#saveQuestion").click(function (e) {
        var question_description = $("#question_description").val();
        var description_answer = $("#description_answer").val();
        var selectType = $(".selectType").val();
        var attached = $(".attached.active").data('val');
        var text_fileAttached = $("#fileAttached").val();
        var fileAttached = $("#fileAttached").prop('files')[0];
        var dependent = $(".dependent.active").data('val');
        var selectQuestion = $(".selectQuestion").val();
        var obligatory_answer = (selectType == 4 || selectType == 5 || selectType == 6)?false:true;
        if (selectQuestion != "--") {
            var check_options = Array();
            $("input[data-question='"+selectQuestion+"'][name='question']:checked").each(function () {
                if ($(this).prop("checked") == true) {
                    check_options.push(parseInt($(this).val()));
                }
            });
            console.log(check_options);
            var optionsSel = check_options.join();
            console.log(optionsSel);
        }
        else {
            var optionsSel = "";
        }
        var listOptions = dataOptions(selectType);
        var validForm = validateForms([
            { 'data': question_description, 'item': 'question_description', 'type': 'text', 'obligatory': true },
            { 'data': description_answer, 'item': 'description_answer', 'type': 'text', 'obligatory': obligatory_answer },
            { 'data': selectType, 'item': 'selectType', 'type': 'select', 'obligatory': true },
            { 'data': attached, 'item': 'attached', 'type': 'radio', 'obligatory': true },
            { 'data': text_fileAttached, 'item': 'fileAttached', 'type': 'text', 'obligatory': (attached == "Si") ? true : false },
            { 'data': dependent, 'item': 'dependent', 'type': 'radio', 'obligatory': true },
            { 'data': selectQuestion, 'item': 'question_dependent', 'type': 'select', 'obligatory': (dependent == "Si") ? true : false },
            { 'data': optionsSel, 'item': 'question_dependent', 'type': 'text', 'obligatory': (dependent == "Si") ? true : false },
        ]);
        console.log(validForm);
        console.log(listOptions);
        var validOptions = validateForms(listOptions["items"]);
        if (validForm["validate"] && validOptions["validate"]) {
            var dataRequest = new FormData();
            dataRequest.append('action', 'requestInsertQuestion');
            dataRequest.append('question_description', question_description);
            dataRequest.append('description_answer', description_answer);
            dataRequest.append('selectType', selectType);
            dataRequest.append('attached', attached);
            dataRequest.append('fileAttached', fileAttached);
            dataRequest.append('dependent', dependent);
            dataRequest.append('selectQuestion', selectQuestion);
            dataRequest.append('optionsSel', optionsSel);
            dataRequest.append('dataSend', JSON.stringify(listOptions["dataSend"]));
            if (selectType == 6) {
                var selectRisk = $(".selectRisk").val();
                dataRequest.append('risk', selectRisk);
            }
            $("#saveQuestion").html("Ingresando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#saveQuestion").attr('disabled', true);
            actionQuestion = createQuestion(dataRequest);
            $.when(actionQuestion).done(function(respAction){
                console.log(respAction);
                toastr_message(respAction["code"], respAction["message"]);
            }).fail(function(respFail){
                console.log(respFail);
            }).always(function(respAlways){
                $("#saveQuestion").html('Guardar Pregunta <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#saveQuestion").removeAttr('disabled');
                $("#formCreation")[0].reset();
                $("#div_options").addClass("d-none");
                $("#div_num_options").addClass("d-none");
                $("#div_link_attached").addClass("d-none");
                $("#div_options").children().remove();
                $("#createQuestion").click();
                $(".selectQuestion").val("--");
                $("#div_dependent_options").children().remove();
                $("#div_dependent").addClass("d-none");
                $(".dependent").removeClass("active");
                $(".attached").removeClass("active");
                $(".dependent[data-val='No']").addClass("active");
                $(".attached[data-val='No']").addClass("active");
                $("#description_answer").removeAttr("disabled");
                $("#question_description").focus();
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
            });
        }
        else {
            $(".itemIncorrect").each(function () {
                $(this).removeClass("itemIncorrect");
                // $(this).removeClass("itemIncorrect");
            });
            $.each(validForm["items"], function (index, label) {
                $("#label_" + label).addClass("itemIncorrect");
                // $("#label_" + label).addClass("itemIncorrect");
            });
        }
        e.preventDefault();
    });
}

function loadListForms() {
    let listForms = getForms();
    $.when(listForms).done(function (respList) {
        console.log(respList);
        var bodyQuestions = ""
        var num = 1;
        $.each(respList["result"], function (key, value) {
            bodyQuestions += "<tr><th scope='row' class='text-center'>" + num + "</th><td>" + value["description_form"] + "</td><td class='text-center'>[print_questions id='" + value["id_form"] + "']</td><td class='text-center'><button type='button' class='btn btn-info btnDetailForm' data-val='" + value["id_form"] + "'><i class='fa fa-eye' aria-hidden='true'></i></button></td><td class='text-center'><button type='button' class='btn btn-outline-danger btnDeleteForm' data-val='" + value["id_form"] + "'><i class='fa fa-trash' aria-hidden='true'></i></button></td></tr>"
            num += 1;
        });
        $("#contentForms").children().remove();
        $("#contentForms").append(bodyQuestions);
        $("#newForm").click(function () {
            $(this).attr("disabled",true);
            $("#table_forms").addClass("d-none");
            $("#div_new_forms").removeClass("d-none");
        });
        $("#cancelForm").click(function () {
            $("#newForm").attr("disabled",false);
            $("#table_forms").removeClass("d-none");
            $("#div_new_forms").addClass("d-none");
        });
        $(".btnDetailForm").off("click");
        $(".btnDetailForm").click(function () {
            var id_form = $(this).data('val');
            let detailForm = getQuestionsForms(id_form);
            $.when(detailForm).done(function (respQuestionsForms) {
                console.log(respQuestionsForms);
                var infoQuestionsForms = respQuestionsForms["result"];
                if (respQuestionsForms["code"] == 200) {
                    $("#titleModalLarge").text("Preguntas Asociadas");
                    $("#bodyTagLarge").children().remove();
                    var detail = '<div class="row p-3"><div class="col-lg-12 p-3 alert-info"><label class="label label-default font-weight-bold">Para asignar una pregunta al formulario seleccionado, dé clic en el check frente a cada pregunta.</label></div></div><table class="table table-stripped table-hover"><thead class="thead-dark text-center" ><tr><th scope="col" class="text-center">#</th><th scope="col" class="text-center">Pregunta</th><th scope="col" class="text-center">Estado</th></tr></thead><tbody>';
                    var num = 1;
                    $.each(infoQuestionsForms, function (index, value) { 
                        var check_status = (value["status_question"] != null)?"checked":"";
                        detail += '<tr><th scope="row" class="text-center">' + num + '</th><td>' + value["description_question"] + '</td><td class="text-center"><label class="checkboxSpecial"><input type="checkbox" class="btn btn-sm btnStatus" data-form="' + id_form + '" data-question="' + value["id_question"] + '" id="' + value["id_question"] + '" ' + check_status +'/><span class="primary"></span></label></td></tr>';
                        num+=1;
                    });
                    $("#bodyTagLarge").append(detail);
                    $(".btnStatus").off("click"); 
                    $(".btnStatus").click(function () { 
                        var id_form = $(this).data('form');
                        var id_question = $(this).data('question');
                        var status = ($(this).prop("checked") == true)?1:0;
                        let changeStatus = statusQuestionForms(id_form, id_question, status);
                        $.when(changeStatus).done(function (respStatus) {
                            console.log(respStatus);
                        }).fail(function (respFail) {
                            console.log(respFail);
                        }).always(function (respAlways) {

                        });
                    });
                    $("#btnModalLarge").addClass("d-none");
                    $("#ModalLarge").modal("show");

                }
                else {
                    toastr_message(respQuestion["code"], respQuestion["message"]);
                }
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {

            });
        });
        $(".btnDeleteForm").off("click");
        $(".btnDeleteForm").click(function () {
            var id_form = $(this).data('val');
            $("#titleModal").text("Notificación");
            $("#bodyTag").append("<p>Seguro desea eliminar este formulario?</p>");
            $("#btnModal").html('Eliminar <i class="fa fa-trash" aria-hidden="true"></i>')
            $("#btnModal").off("click");
            $("#btnModal").click(function (e) {
                actionQuestion = deleteForm(id_form);
                $("#btnModal").html("Eliminando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
                $("#btnModal").attr('disabled', true);
                $.when(actionQuestion).done(function (respAction) {
                    console.log(respAction);
                    toastr_message(respAction["code"], respAction["message"]);
                }).fail(function (respFail) {
                    console.log(respFail);
                }).always(function (respAlways) {
                    $("#btnModal").html('Eliminar Pregunta <i class="fa fa-trash aria-hidden="true"></i>');
                    $("#btnModal").removeAttr('disabled');
                    $("#ModalObs").modal("hide");
                    loadListForms();
                });
                e.preventDefault();

            });
            $("#ModalObs").modal("show");
        });

        $("#saveForm").off("click");
        $("#saveForm").click(function (e) {
            var description_form = $("#description_form").val();
            var validForm = validateForms([
                { 'data': description_form, 'item': 'description_form', 'type': 'text', 'obligatory': true },
            ]);
            console.log(validForm);
            if (validForm["validate"]) {
                $("#saveForm").html("Guardando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
                $("#saveForm").attr('disabled', true);
                actionQuestion = insertForm(description_form);
                $.when(actionQuestion).done(function(respAction){
                    console.log(respAction);
                    toastr_message(respAction["code"], respAction["message"]);
                }).fail(function(respFail){
                    console.log(respFail);
                }).always(function(respAlways){
                    $("#saveForm").html('Crear Formulario <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                    $("#saveForm").removeAttr('disabled');
                    $("#formCreationForms")[0].reset();
                    $("#table_forms").removeClass("d-none");
                    $("#div_new_forms").addClass("d-none");
                    $("#newForm").attr("disabled", false);
                    loadListForms();
                });
            }
            else {
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                    // $(this).removeClass("itemIncorrect");
                });
                $.each(validForm["items"], function (index, label) {
                    $("#label_" + label).addClass("itemIncorrect");
                    // $("#label_" + label).addClass("itemIncorrect");
                });
            }
            e.preventDefault();
        });
        $("#ModalLarge").on('hidden.bs.modal', function () {
            $("#bodyTagLarge").children().remove();
        });
        $("#ModalObs").on('hidden.bs.modal', function () {
            $("#bodyTag").children().remove();
        });
    }).fail(function (respFail) {
        console.log(respFail);
    }).always(function (respAlways) {
    });
}

$(document).ready(function () {
// jQuery(document).ready(function ($) {
    console.log('Entry Page Actual');
    $(function () {
        bs_input_file(".input-file");
    });
    $(".itemAction").click(function () {
        var id_item = $(this).attr("id");
        $(".itemAction").parent().removeClass("active animated flipInX");
        $(".itemAction").removeClass("active animated flipInX");
        $(".tabsView").addClass("d-none");
        $("#list_" + id_item).addClass("active animated flipInX");
        $("#div_" + id_item).removeClass("d-none");
        if (id_item == "listQuestions") {
            loadViewQuestions();
        }
        else if (id_item == "createQuestion") {
            loadCreateQuestions();
        }
        else if (id_item == "createForms") {
            loadListForms();
        }
        console.log(id_item);
    });
    // $("#createQuestion").click();
    // $("#listQuestions").click();
    $("#createForms").click();
});