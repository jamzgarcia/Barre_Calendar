$(document).ready(function () {
    console.log('Entry Page Actual');
    
    $("#sendInfo").off("click");
    $("#sendInfo").click(function () {
        var names = $("#names").val();
        var last_names = $("#last_names").val();
        var document = $("#document").val();
        var mobile = $("#mobile").val();
        var email = $("#email").val();
        var company = $("#company").val();
        var validForm = validateForms([
            { 'data': names, 'item': 'names', 'type': 'text', 'obligatory': true },
            { 'data': last_names, 'item': 'last_names', 'type': 'text', 'obligatory': true },
            { 'data': document, 'item': 'document', 'type': 'text', 'obligatory': true },
            { 'data': mobile, 'item': 'mobile', 'type': 'text', 'obligatory': true },
            { 'data': email, 'item': 'email', 'type': 'text', 'obligatory': true },
            { 'data': company, 'item': 'company', 'type': 'text', 'obligatory': true }
        ]);
        if (validForm["validate"]) {
            $("#sendInfo").html("Ingresando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfo").attr('disabled', true);
            actionEntry = insertInspectors(names, last_names, document, mobile, email, company);
            $.when(actionEntry).done(function (respAction) {
                console.log(respAction);
            }).fail(function (respFail) {
                console.log(respFail);
            }).always(function (respAlways) {
                $("#sendInfo").html('Guardar Información <i class="fa fa-floppy-o" aria-hidden="true"></i>');
                $("#sendInfo").removeAttr('disabled');
                $(".itemIncorrect").each(function () {
                    $(this).removeClass("itemIncorrect");
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
        }
    });
});