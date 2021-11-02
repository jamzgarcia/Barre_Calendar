var url_dest = SolicitudesAjax.url;
var url_secure = SolicitudesAjax.seguridad;

function createQuestion(dataRequest) {
    dataRequest.append('nonce', url_secure);
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: dataRequest,
        contentType: false,
        processData: false,
        cache: false
    });
}

function insertAnswers(dataRequest) {
    dataRequest.append('nonce', url_secure);
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: dataRequest,
        contentType: false,
        processData: false,
        cache: false
    });
}

function insertForm(description_form) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'requestInsertForm', nonce: url_secure, description_form }
    });
}

function getQuestions() {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'getQuestions', nonce: url_secure }
    });
}

function getForms() {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'getForms', nonce: url_secure }
    });
}

function getQuestionsForms(id_form) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'getQuestionsForms', nonce: url_secure, id_form }
    });
}

function getQuestionId(id_question) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'getQuestionId', nonce: url_secure, id_question }
    });
}

function deleteQuestion(id_question) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'deleteQuestion', nonce: url_secure, id_question }
    });
}

function deleteForm(id_form) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'deleteForm', nonce: url_secure, id_form }
    });
}

function statusQuestionForms(id_form, id_question, status) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'statusQuestionForms', nonce: url_secure, id_form, id_question, status }
    });
}

function insertCoach(nameCoach, lastNameCoach, dash_coach_correo, dateCoach) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'insertCoach', nonce: url_secure, nameCoach,lastNameCoach,dash_coach_correo,dateCoach }
    });
}



function insertInspectors(names, last_names, document, mobile, email, company) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'insertInspectors', nonce: url_secure, names, last_names, document, mobile, email, company }
    });
}

function printAnswers() {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'printAnswers', nonce: url_secure }
    });
}

function deleteReport(id_user) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'deleteReport', nonce: url_secure, id_user }
    });
}

function reportsImage(id_user) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'reportsImage', nonce: url_secure, id_user }
    });
}

function getAllReports() {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'getAllReports', nonce: url_secure }
    });
}