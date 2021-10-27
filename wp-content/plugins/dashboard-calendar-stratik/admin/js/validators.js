function bs_input_file(itemClass) {
    $(itemClass).after(
        function () {
            if (!$(this).prev().hasClass('input-ghost')) {
                var element = $("<input type='file' class='input-ghost' style='visibility:hidden; height:0'>");
                element.attr("id", $(this).attr("name"));
                element.change(function () {
                    element.prev(element).find('input').val((element.val()).split('\\').pop());
                });
                $(this).find("button.btn-choose").click(function () {
                    element.click();
                });
                $(this).find("button.btn-reset").click(function () {
                    element.val(null);
                    $(this).parents(".input-file").find('input').val('');
                });
                $(this).find('input').css("cursor", "pointer");
                $(this).find('input').mousedown(function () {
                    $(this).parents('.input-file').next().click();
                    return false;
                });
                return element;
            }
        }
    );
}

function toastr_message(code, messages) {
    //console.log(code);
    switch (code) {
        case 200:
            response = toastr.success(messages, "Notificación");
            break;
        case 300:
            response = toastr.info(messages, "Notificación");
            break;
        case 400:
            response = toastr.warning(messages, "Notificación");
            break;
        case 500:
            response = toastr.error(messages, "Notificación");
            break;
        default:
            response = false
            break;
    }
    //console.log(response);
    return response;
}

function validateForms(opts) {
    var valid = true;
    var items = Array();
    $.each(opts, function (index, el) {
        if (el['obligatory']) {
            if (el['data'] !== null && el['data'] !== '' && typeof (el['data']) !== undefined) {
                //console.log(el['item'] + " : " +el['data']);
                switch (el['type']) {
                    case 'text':
                        if (el['data'] === null || el['data'].length === 0 || /^\s+$/.test(el['data'])) {
                            valid = false;
                            items.push(el['item']);
                            //return false;
                        }
                        break;
                    case 'number':
                        if (isNaN(el['data'])) {
                            valid = false;
                            items.push(el['item']);
                            //return false;
                        }
                        break;
                    case 'radio':
                        if (el['data'] === null || el['data'] == undefined || el['data'] === '') {
                            valid = false;
                            items.push(el['item']);
                            //return false;
                        }
                        break;
                    case 'select':
                        if (el['data'] === null || el['data'].length === 0 || el['data'] === '--') {
                            valid = false;
                            items.push(el['item']);
                            //return false;
                        }
                        break;
                    case 'date':
                        if (el['data'] == null || el['data'].length === 0 || el['data'] === '') {
                            valid = false;
                            items.push(el['item']);
                            //return false;
                        }
                        break;
                }
            }
            else {
                items.push(el['item']);
                valid = false;
                //return false;
            }
        }

    });
    var response = { 'validate': valid, 'items': items }
    //return valid;
    return response;
}