$(document).ready(function () {
    console.log('Entry Page Actual');
    
    $("#sendInfo").off("click");
    $("#sendInfo").click(function () {
        var names = $("#names").val();
        var identify = $("#identify").val();
        var address = $("#address").val();
        var type_society = $("#type_society").val();
        var business_name = $("#business_name").val();
        var validForm = validateForms([
            { 'data': names, 'item': 'names', 'type': 'text', 'obligatory': true },
            { 'data': identify, 'item': 'identify', 'type': 'text', 'obligatory': true },
            { 'data': address, 'item': 'address', 'type': 'text', 'obligatory': true },
            { 'data': type_society, 'item': 'type_society', 'type': 'text', 'obligatory': true },
            { 'data': business_name, 'item': 'business_name', 'type': 'text', 'obligatory': true }
        ]);
        if (validForm["validate"]) {
            $("#sendInfo").html("Ingresando   <i class='fa fa-spinner fa-spin' style='font-size:24px'></i>");
            $("#sendInfo").attr('disabled', true);
            actionEntry = insertCompany(names,identify,address,type_society,business_name);
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