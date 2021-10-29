function dataInformation(){
    var items = Array();
    var dataSend = {};
    $(".divQuestion").each(function () { 
        var id_question = $(this).data('question');
        var id_type_question = $(this).data('type');
        var is_dependent = $(this).data('dependent');
        if (is_dependent == 1) {
            var dependquestion = $(this).data('dependquestion');
            var dependoptions = $(this).data('dependoptions').toString();
            var opt_checked = $("input[name='question_"+dependquestion+"']:checked").val();
            var obligatory = (dependoptions.includes(opt_checked))?true:false;
        }
        else {
            var obligatory = true;
        }
        if (id_type_question == 1 || id_type_question == 2 || id_type_question == 3 || id_type_question == 4 || id_type_question == 6) {
            var data_question = $("#question_"+id_question).val();
        }
        else if (id_type_question == 5) {
            var type = (id_type_question == 5)?'checkbox':'radio';
            var opts_question = Array();
            $("input[name='question_"+id_question+"']").each(function () { 
                if ($(this).prop("checked") == true) {
                    opts_question.push($(this).val());
                }
            });
            var data_question = opts_question.join();
        }
        else if (id_type_question == 7){
            var data_question =  $("#fileAttached_" + id_question).val();
            // var fileAttached = $("#fileAttached_" + id_question).prop('files')[0];
        }
        items.push({ 'data': data_question, 'item': 'question_'+id_question, 'type': 'text', 'obligatory': obligatory });
        if (obligatory) {
            dataSend[id_question] = {'data_type': id_type_question, 'data_val': data_question}
        }
    });
    return { 'items': items, 'dataSend': dataSend };
}

$(document).ready(function () {
    console.log('Entry Page Actual');
    $(".divQuestion").each(function () { 
        var id_question = $(this).data('question');
        var id_type_question = $(this).data('type');
        if (id_type_question == 7){
            bs_input_file('.input-file.link_attached_option_' + id_question);
        }
    });
    $(".selectForm").change(function () { 
        var id_question_sel = $(this).data('question');
        var option_sel = $(this).val().toString();
        $(".divQuestion[data-dependent='1'][data-dependquestion='"+id_question_sel+"']").each(function () { 
            var dependent_options = $(this).data('dependoptions').toString();
            if (dependent_options.includes(option_sel)) {
                $(this).removeClass("d-none");
            }
            else {
                $(this).addClass("d-none");
            }
        });
    });
    /* $(".radioQuestion").click(function (e) { 
        var id_question_sel = $(this).data('question');
        var option_sel = $(this).val().toString();
        $(".divQuestion[data-dependent='1'][data-dependquestion='"+id_question_sel+"']").each(function () { 
            var dependent_options = $(this).data('dependoptions').toString();
            if (dependent_options.includes(option_sel)) {
                $(this).removeClass("d-none");
            }
            else {
                $(this).addClass("d-none");
            }
        });
        // e.preventDefault();
    }); */
    $("#sendInfo").off("click");
    $("#sendInfo").click(function () {
        var evento = $("#evento").val();
        var fecha_inicio = $("#fecha_inicio").val();
        var fecha_fin = $("#fecha_fin").val();
        var validForm = validateForms([
            { 'data': evento, 'item': 'evento', 'type': 'text', 'obligatory': true },
            { 'data': fecha_inicio, 'item': 'fecha_inicio', 'type': 'text', 'obligatory': true },
            { 'data': fecha_fin, 'item': 'fecha_fin', 'type': 'text', 'obligatory': true }
        ]);
        var dataInfo = dataInformation();
        var validInfo = validateForms(dataInfo["items"]);
        if (validForm["validate"] && validInfo["validate"]) {
            $("#sendInfo").html("Ingresando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfo").attr('disabled', true);
            var dataRequest = new FormData();
            dataRequest.append('action', 'insertAnswers');
            dataRequest.append('evento', evento);
            dataRequest.append('fecha_inicio', fecha_inicio);
            dataRequest.append('fecha_fin', fecha_fin);
            dataRequest.append('dataSend', JSON.stringify(dataInfo["dataSend"]));            
            actionEntry = insertCalendar(dataRequest);
            $.when(actionEntry).done(function (respAction) {
                console.log(respAction);
                toastr_message(respAction["code"], respAction["message"]);
               
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfo").html('Guardar Información <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#sendInfo").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
                });
                $(".divQuestion[data-dependent='1']").each(function () {
                    $(this).addClass("d-none");
                });
                $("#formQuestions")[0].reset();
                console.log("Enviar información");
            });
        }
        else {
            $(".itemIncorrect").each(function () {
                $(this).removeClass("itemIncorrect");
            });
            $.each(validForm["items"], function (index, label) {
                $("#label_" + label).addClass("itemIncorrect");
            });
            $.each(validInfo["items"], function (index, label) {
                $("#label_" + label).addClass("itemIncorrect");
            });
        }
        console.log(dataInfo);
    });
    $("#printInfo").off("click");
    $("#printInfo").click(function () {
        actionEntry = printAnswers();
        $.when(actionEntry).done(function (respAction) {
            console.log(respAction);
            $("#printInfo").after('<br><div id="content" class="p-1" style="heigth:auto; width:auto;"></div>');
            PDFObject.embed("/wordpress"+respAction["result"], "#content");
            // toastr_message(respAction["code"], respAction["message"]);
            var url = respAction["result"].replaceAll('\\','/');
            console.log(url);
            window.open("../"+url, '_blank');

        }).fail(function (respFail) {
            console.log(respFail);
        }).always(function (respAlways) {
            console.log("Enviar información");
        });
    });
});