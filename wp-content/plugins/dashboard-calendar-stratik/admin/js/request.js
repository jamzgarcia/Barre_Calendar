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

function insertCoach(dash_coach_nombre,dash_coach_apellido,dash_coach_correo,dash_coach_fecha_nacimiento) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'insertCoach', nonce: url_secure,dash_coach_nombre,dash_coach_apellido,dash_coach_correo,dash_coach_fecha_nacimiento}
    });
}

function insertStudent(dash_student_nombre,dash_student_apellido,dash_student_correo,dash_student_fecha_nacimiento, dash_student_tipo_estudiante) {
    return $.ajax({
        type: "POST",
        url: url_dest,
        dataType: 'json',
        data: { action: 'insertStudent', nonce: url_secure,dash_student_nombre,dash_student_apellido,dash_student_correo,dash_student_fecha_nacimiento, dash_student_tipo_estudiante}
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