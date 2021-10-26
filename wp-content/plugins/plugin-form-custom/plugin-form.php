<?php

/* 
Plugin Name: Plugin Form
Plugin URI: https://www.dandatechnology.com/
Description: Este plugin ayudará a crear formularios personalizados
Version: 1.0
Author: DANDA Technology
*/
define('root_file',plugin_dir_path(__file__));
// define('root_file',plugin_dir_url(__file__));

// require_once dirname(__FILE__) . '/admin/controller/classFunction.php'; 
// require_once (ABSPATH . 'wp-content/plugins/plugin-form-custom/admin/controller/classFunction.php'); 
require_once (ABSPATH . 'wp-admin/includes/upgrade.php'); 
// require_once (ABSPATH . "wp-content/plugins/plugin-form-custom/admin/controller/dompdf_config.inc.php");
require (ABSPATH . "wp-content/plugins/plugin-form-custom/admin/controller/code128.php");
include (ABSPATH . 'wp-content/plugins/plugin-form-custom/admin/controller/classFunction.php'); 

function EnablePluginForm(){
    global $wpdb;
    /* Creación de la tabla de tipo de preguntas y se ingresan todos los tipos */
    $sqlType = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}type_questions(
                    id_type_question INT NOT NULL AUTO_INCREMENT,
                    description_type VARCHAR(50) NOT NULL,
                    status_question INT NOT NULL DEFAULT 1,
                    PRIMARY KEY (id_type_question)
                );
                INSERT INTO {$wpdb->prefix}type_questions (description_type)
                VALUES ('Fecha'),('Texto'),('Número'),('Opción Múltiple'),('Casillas de Verificación'),('Si - No - N/A'),('Archivo adjunto');";
    // $wpdb->query($sqlType);
    $createType = dbDelta($sqlType,true);

    /* Creación de la tabla de lista de formularios, donde se ingresarán todos los formularios creados */
    $sqlForms = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_forms(
                        id_form INT NOT NULL AUTO_INCREMENT,
                        description_form TEXT NOT NULL,
                        PRIMARY KEY (id_form)
                    );";
    // $wpdb->query($sqlForms);
    $createForms = dbDelta($sqlForms,true);

    /* Creación de la tabla de lista de preguntas, donde se registrarán todas las preguntas ingresadas */
    $sqlQuestions = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_questions(
                        id_question INT NOT NULL AUTO_INCREMENT,
                        description_question TEXT NOT NULL,
                        description_answer TEXT NULL DEFAULT NULL,
                        attached INT NOT NULL DEFAULT 0,
                        link_attached TEXT NULL,
                        is_dependent INT NOT NULL DEFAULT 0,
                        dependent_question INT NULL DEFAULT NULL,
                        dependent_options TEXT NULL DEFAULT NULL,
                        risk INT NULL DEFAULT NULL,
                        status_question INT NOT NULL DEFAULT 1,
                        id_type_question INT NOT NULL,
                        PRIMARY KEY (id_question),
                        FOREIGN KEY (id_type_question) REFERENCES {$wpdb->prefix}type_questions(id_type_question) ON DELETE CASCADE
                    );";
    // $wpdb->query($sqlQuestions);
    $createQuestions = dbDelta($sqlQuestions,true);

    /* Creación de la tabla de lista de formularios, donde se ingresarán todos los formularios creados */
    $sqlQuestionsForms = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}questions_forms(
                        id_form INT NOT NULL AUTO_INCREMENT,
                        id_question INT NOT NULL,
                        PRIMARY KEY (id_form, id_question),
                        FOREIGN KEY (id_form) REFERENCES {$wpdb->prefix}list_forms(id_form) ON DELETE CASCADE,
                        FOREIGN KEY (id_question) REFERENCES {$wpdb->prefix}list_questions(id_question) ON DELETE CASCADE
                    );";
    // $wpdb->query($sqlQuestionsForms);
    $createQuestionsForms = dbDelta($sqlQuestionsForms,true);
    
    /* Creación de la tabla de las opciones de preguntas, las cuales para algunos tipos de preguntas se alimentará con las diferentes opciones */
    $sqlOptions = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}options_questions(
                        id_option INT NOT NULL AUTO_INCREMENT,
                        description_option TEXT NOT NULL,
                        description_answer TEXT NOT NULL,
                        attached INT NOT NULL DEFAULT 0,
                        link_attached TEXT NULL,
                        id_question INT NOT NULL,
                        PRIMARY KEY (id_option),
                        FOREIGN KEY (id_question) REFERENCES {$wpdb->prefix}list_questions(id_question) ON DELETE CASCADE
                    );";
    // $wpdb->query($sqlOptions);
    $createOptions = dbDelta($sqlOptions,true);
    
    /* Creación de la tabla de las respuestas, las cual se alimentará con todas las respuestas ingresadas */
    $sqlAnswers = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_answers(
                        id_answer INT NOT NULL AUTO_INCREMENT,
                        answer_text TEXT NULL,
                        answer_date DATE NULL,
                        answer_file TEXT NULL,
                        answer_multiple TEXT NULL,
                        id_question INT NOT NULL,
                        id_user INT NOT NULL DEFAULT 0,
                        PRIMARY KEY (id_answer),
                        FOREIGN KEY (id_question) REFERENCES {$wpdb->prefix}list_questions(id_question) ON DELETE CASCADE
                    );";
    // $wpdb->query($sqlAnswers);
    $createAnswers = dbDelta($sqlAnswers,true);
    
    /* Creación de la tabla de las compañias, las cual se alimentará con todas las empresas registradas */
    $sqlCompany = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_company(
                        id_company INT NOT NULL AUTO_INCREMENT,
                        names TEXT NOT NULL,
                        identify TEXT NOT NULL,
                        address_company TEXT NOT NULL,
                        type_society TEXT NOT NULL,
                        business_name TEXT NOT NULL,
                        PRIMARY KEY (id_company)
                    );";
    // $wpdb->query($sqlCompany);
    $createCompany = dbDelta($sqlCompany,true);
    
    /* Creación de la tabla de las respuestas, las cual se alimentará con todas las respuestas ingresadas */
    $sqlInspectors = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_inspectors(
                        id_inspector INT NOT NULL AUTO_INCREMENT,
                        names TEXT NOT NULL,
                        last_names TEXT NOT NULL,
                        document TEXT NOT NULL,
                        mobile TEXT NOT NULL,
                        email TEXT NOT NULL,
                        id_company INT NOT NULL,
                        PRIMARY KEY (id_inspector),
                        FOREIGN KEY (id_company) REFERENCES {$wpdb->prefix}list_company(id_company) ON DELETE CASCADE
                    );";
    // $wpdb->query($sqlInspectors);
    $createInspectors = dbDelta($sqlInspectors,true);
    
    /* Creación de la tabla de las respuestas, las cual se alimentará con todas las respuestas ingresadas */
    $sqlUsers = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}list_users(
                        id_user INT NOT NULL AUTO_INCREMENT,
                        names TEXT NOT NULL,
                        last_names TEXT NOT NULL,
                        document TEXT NOT NULL,
                        attached_report TEXT NULL,
                        date_report DATETIME NULL,
                        PRIMARY KEY (id_user)
                    );";
    // $wpdb->query($sqlUsers);
    $createUsers = dbDelta($sqlUsers,true);
    
}

function DisablePluginForm(){
    global $wpdb;
    /* Creación de la tabla de tipo de preguntas y se ingresan todos los tipos */
    // $sqlType = "DELETE FROM {$wpdb->prefix}type_questions;";
    $sqlDelete = "DROP TABLE {$wpdb->prefix}questions_forms, {$wpdb->prefix}list_forms, {$wpdb->prefix}list_company, {$wpdb->prefix}list_inspectors, {$wpdb->prefix}list_users, {$wpdb->prefix}list_answers, {$wpdb->prefix}options_questions, {$wpdb->prefix}list_questions, {$wpdb->prefix}type_questions;";
    // $sqlDelete = "DROP TABLE {$wpdb->prefix}type_questions;";
    // $sqlType = "TRUNCATE TABLE {$wpdb->prefix}type_questions;";
    // $wpdb->query($sqlType);
    $wpdb->query($sqlDelete);
    // $deleteTables = dbDelta($sqlDelete,true);
    flush_rewrite_rules();
}

register_activation_hook(__FILE__,"EnablePluginForm");
register_deactivation_hook(__FILE__,"DisablePluginForm");

add_action( "admin_menu", "CreateMenu" );
function CreateMenu() {
    add_menu_page( "Form Custom", "Menu Form", "manage_options", root_file."form-list.php", null, plugin_dir_url(__file__)."admin/images/icon.png" , "4");
}

function bootstrap_css($hook){
    /* if($hook != "plugin-test.php/admin/lista-encuestas.php"){
        return ;
    } */
    wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
    wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
    wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,700;1,400&display=swap");
    wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('checkbox_css',plugins_url('admin/css/checkbox.css',__FILE__));
    wp_enqueue_style('custom_css',plugins_url('admin/css/admin.css',__FILE__));
}

add_action('admin_enqueue_scripts','bootstrap_css');

function bootstrap_js($hook){
    /* if($hook != "plugin-test.php/admin/lista-encuestas.php"){
        return ;
    } */
    wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
    wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
}

add_action('admin_enqueue_scripts','bootstrap_js');

function EncolarJS($hook){
    /* if($hook != "plugin-test.php/admin/lista-encuestas.php"){
        return ;
    } */
    wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
    wp_enqueue_script('JSExterno',plugins_url('admin/js/list-form.js',__FILE__),array('jquery'));
    wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
        'url' => admin_url('admin-ajax.php'),
        'seguridad' => wp_create_nonce('seg')

    ]);
}

add_action('admin_enqueue_scripts','EncolarJS');


function insertAnswers(){
    global $wpdb;
    try {
        if(isset($_POST)){
            // print_r($_POST);
            $adminData = new adminQuestions();
            $dataAnswer = $_POST;
            $root = realpath($_SERVER["DOCUMENT_ROOT"]);
            $table_answers = "{$wpdb->prefix}list_answers";
            $table_users = "{$wpdb->prefix}list_users";
            $status_insert = true;
            $listAnswers = str_replace("\\","",$_POST["dataSend"]);
            $listAnswers = json_decode($listAnswers,true);
            // print_r($listAnswers);
            $dataUser = array("id_user"=>null,"names"=>$dataAnswer["names"],"last_names"=>$dataAnswer["last_names"],"document"=>$dataAnswer["document"]);
            $insertUser = $wpdb->insert($table_users,$dataUser);
            if($insertUser == 1){
                $sql = "SELECT id_user FROM $table_users ORDER BY id_user DESC LIMIT 1";
                $data = $wpdb->get_results($sql,ARRAY_A);
                $id_user = $data[0]["id_user"];
                foreach ($listAnswers as $id_question => $content) {
                    $id_type_question = $content["data_type"];
                    if ($id_type_question == 7) {
                        $file = "";
                        $file = $_FILES["fileAttached_".$id_question]["name"];
                        $file = str_replace(" ", "_", $file);
                        // $dir_ = $root."/attached/".$id_question."";
                        $dir_ = ABSPATH."wp-content/plugins/plugin-form-custom/admin/controller/attached/answers/".$id_user."";
                        if(!is_dir($dir_)) 
                            mkdir($dir_, 0777, true);
                        $route_doc = "wp-content/plugins/plugin-form-custom/admin/controller/attached/answers/".$id_user."/".$file;
                        if ($file && move_uploaded_file($_FILES["fileAttached_".$id_question]['tmp_name'],$dir_."/".$file)){
                            sleep(3);
                            // $data_val = "anexos/".$id_evaluation."/".$file;
                            $data_val = $route_doc;
                        }
                        else{
                            print_r("no se cargo el archivo");
                        }
                    }
                    else {
                        $data_val = $content["data_val"];
                    }
                    switch ($id_type_question) {
                        case '1':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>null,"answer_date"=>$data_val,"answer_file"=>null,"answer_multiple"=>null,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '2':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>$data_val,"answer_date"=>null,"answer_file"=>null,"answer_multiple"=>null,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '3':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>$data_val,"answer_date"=>null,"answer_file"=>null,"answer_multiple"=>null,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '4':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>null,"answer_date"=>null,"answer_file"=>null,"answer_multiple"=>$data_val,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '5':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>null,"answer_date"=>null,"answer_file"=>null,"answer_multiple"=>$data_val,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '6':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>null,"answer_date"=>null,"answer_file"=>null,"answer_multiple"=>$data_val,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        case '7':
                            $dataInsert = array("id_answer"=>null,"answer_text"=>null,"answer_date"=>null,"answer_file"=>$data_val,"answer_multiple"=>null,"id_question"=>$id_question,"id_user"=>$id_user);
                            break;
                        
                        default:
                            echo $id_type_question;
                            break;
                    }
                    $result = $wpdb->insert($table_answers,$dataInsert);
                    if(!$result){
                        $status_insert = false;
                    }
                }
                if($status_insert == true){
                    $file_report = $adminData->loadAnswers($id_user);
                    $current_date = date("Y-m-d H:i:s");
                    $updUser = array("attached_report"=>$file_report,"date_report"=>$current_date);
                    $whereUser = array("id_user"=>$id_user);
                    $status_update = $wpdb->update($table_users,$updUser,$whereUser);
                    $response = json_encode(array("code"=>200, "message"=>"Respuestas Ingresadas Exitosamente", "result"=>$status_insert, "attached_report"=>$file_report));
                }
                else {
                    $response = json_encode(array("code"=>500, "message"=>"Hubo un problema con las respuestas", "result"=>$status_insert));
                }
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"No pudo ser creado el usuario", "result"=>$insertUser));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
    /* print_r($_POST);
    $nonce = $_POST['nonce'];
    if(!wp_verify_nonce($nonce, 'seg')){
        die('no tiene permiso para ejecutar ese ajax');
    }*/

}

add_action('wp_ajax_insertAnswers','insertAnswers');

function insertForm(){
    global $wpdb;
    try {
        if(isset($_POST)){
            // print_r($_POST);
            $dataForm = $_POST;
            $table_forms = "{$wpdb->prefix}list_forms";
            $response = array();
            $description_form = $dataForm["description_form"];
            $dataInsert = array("id_form"=>null,"description_form"=>$description_form);
            $result = $wpdb->insert($table_forms,$dataInsert);
            if($result == 1){
                $response = json_encode(array("code"=>200, "message"=>"Pregunta Creada Exitosamente", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"El formulario no pudo ser creado", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();

}

add_action('wp_ajax_requestInsertForm','insertForm');

function insertQuestion(){
    global $wpdb;
    try {
        if(isset($_POST)){
            // print_r($_POST);
            $dataQuestion = $_POST;
            $table_questions = "{$wpdb->prefix}list_questions";
            $response = array();
            $question_description = $dataQuestion["question_description"];
            $description_answer = $dataQuestion["description_answer"];
            $selectType = $dataQuestion["selectType"];
            $attached = ($dataQuestion["attached"] == "Si")?1:0;
            $link_attached = "";
            $dependent = ($dataQuestion["dependent"] == "Si")?1:0;
            $selectQuestion = ($dataQuestion["dependent"] == "Si")?$dataQuestion["selectQuestion"]:null;
            $optionsSel = ($dataQuestion["dependent"] == "Si")?$dataQuestion["optionsSel"]:null;
            $risk = ($selectType == 6)?$dataQuestion["risk"]:null;
            $dataInsert = array("id_question"=>null,"description_question"=>$question_description,"description_answer"=>$description_answer,"attached"=>$attached,"link_attached"=>$link_attached,"is_dependent"=>$dependent,"dependent_question"=>$selectQuestion,"dependent_options"=>$optionsSel,"risk"=>$risk,"status_question"=>1,"id_type_question"=>$selectType);
            $result = $wpdb->insert($table_questions,$dataInsert);
            if($result == 1){
                $sql = "SELECT id_question FROM $table_questions ORDER BY id_question DESC LIMIT 1";
                $data = $wpdb->get_results($sql,ARRAY_A);
                $id_question = $data[0]["id_question"];
                if($selectType == 4 || $selectType == 5 || $selectType == 6){
                    $listOptions = str_replace("\\","",$_POST["dataSend"]);
                    $listOptions = json_decode($listOptions,true);
                    $table_options = "{$wpdb->prefix}options_questions";
                    foreach ($listOptions as $key => $value) {
                        $attached_option = ($value["attached"] == "Si")?1:0;
                        $dataOptions = array("id_option"=>null,"description_option"=>$value["text_option"],"description_answer"=>$value["text_answer"],"attached"=>$attached_option,"link_attached"=>"","id_question"=>$id_question);
                        $wpdb->insert($table_options,$dataOptions);
                    }
                }
                if($attached == 1){
                    $file = "";
                    // print_r($_FILES);
                    $file = $_FILES["fileAttached"]["name"];
                    $file = str_replace(" ", "_", $file);
                    // $dir_ = $root."/attached/".$id_question."";
                    $dir_ = ABSPATH."wp-content/plugins/plugin-form-custom/admin/controller/attached/questions/".$id_question."";
                    if(!is_dir($dir_)) 
                        mkdir($dir_, 0777, true);
                    $route_doc = "wp-content/plugins/plugin-form-custom/admin/controller/attached/questions/".$id_question."/".$file;
                    if ($file && move_uploaded_file($_FILES["fileAttached"]['tmp_name'],$dir_."/".$file)){
                        sleep(3);
                        // $data_val = "anexos/".$id_evaluation."/".$file;
                        // $data_val = $route_doc;
                        $link_attached = $route_doc;
                        $updQuestion = array("link_attached"=>$link_attached);
                        $whereUser = array("id_question"=>$id_question);
                        $status_update = $wpdb->update($table_questions,$updQuestion,$whereUser);
                    }
                    else{
                        print_r("no se cargo el archivo");
                    }
                }
                $response = json_encode(array("code"=>200, "message"=>"Pregunta Creada Exitosamente", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser creada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
    /* print_r($_POST);
    $nonce = $_POST['nonce'];
    if(!wp_verify_nonce($nonce, 'seg')){
        die('no tiene permiso para ejecutar ese ajax');
    }*/

}

add_action('wp_ajax_requestInsertQuestion','insertQuestion');

function insertCompany(){
    global $wpdb;
    try {
        if(isset($_POST)){
            // print_r($_POST);
            $dataCompany = $_POST;
            $table_company = "{$wpdb->prefix}list_company";
            $response = array();
            $names = $dataCompany["names"];
            $identify = $dataCompany["identify"];
            $address = $dataCompany["address"];
            $type_society = $dataCompany["type_society"];
            $business_name = $dataCompany["business_name"];
            $dataInsert = array("id_company"=>null,"names"=>$names,"identify"=>$identify,"address_company"=>$address,"type_society"=>$type_society,"business_name"=>$business_name);
            $result = $wpdb->insert($table_company,$dataInsert);
            if($result == 1){
                $response = json_encode(array("code"=>200, "message"=>"Compañía Creada Exitosamente", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La compañía no pudo ser creada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_insertCompany','insertCompany');

function insertInspectors(){
    global $wpdb;
    try {
        if(isset($_POST)){
            // print_r($_POST);
            $dataInspectors = $_POST;
            $table_inspectors = "{$wpdb->prefix}list_inspectors";
            $response = array();
            $names = $dataInspectors["names"];
            $last_names = $dataInspectors["last_names"];
            $document = $dataInspectors["document"];
            $mobile = $dataInspectors["mobile"];
            $email = $dataInspectors["email"];
            $company = $dataInspectors["company"];
            $dataInsert = array("id_inspector"=>null,"names"=>$names,"last_names"=>$last_names,"document"=>$document,"mobile"=>$mobile,"email"=>$email,"id_company"=>$company);
            $result = $wpdb->insert($table_inspectors,$dataInsert);
            if($result == 1){
                $response = json_encode(array("code"=>200, "message"=>"Inspector Creado Exitosamente", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"El inspector no pudo ser creado", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_insertInspectors','insertInspectors');

function getQuestionId(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_question = $_POST["id_question"];
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_type = "{$wpdb->prefix}type_questions";
            $table_options = "{$wpdb->prefix}options_questions";
            $response = array();
            $sql = "SELECT Q.id_question, Q.description_question, Q.description_answer, Q.attached, Q.link_attached, Q.status_question, Q.id_type_question, T.description_type
                FROM $table_questions as Q INNER JOIN $table_type as T ON Q.id_type_question = T.id_type_question
                WHERE Q.id_question = $id_question";
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $id_question = $result[0]["id_question"];
                $id_type_question = $result[0]["id_type_question"];
                if($id_type_question == 4 || $id_type_question == 5 || $id_type_question == 6){
                    $sql_options = "SELECT * FROM $table_options WHERE id_question = $id_question";
                    $result_options = $wpdb->get_results($sql_options,ARRAY_A);
                    $result[0]["dataOptions"] = $result_options;
                }
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result[0]));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser consultada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_getQuestionId','getQuestionId');

function getForms(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $table_forms = "{$wpdb->prefix}list_forms";
            $response = array();
            $sql = "SELECT F.id_form, F.description_form
                FROM $table_forms as F";
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser consultada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_getForms','getForms');

function getQuestionsForms(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_form = $_POST["id_form"];
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_questions_forms = "{$wpdb->prefix}questions_forms";
            $response = array();
            $sql = "SELECT Q.id_question, Q.description_question, IFNULL(QF.id_question,NULL) as status_question
                    FROM $table_questions as Q LEFT JOIN $table_questions_forms as QF ON QF.id_question = Q.id_question AND QF.id_form = $id_form";
            //print_r($sql);
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser consultada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_getQuestionsForms','getQuestionsForms');

function statusQuestionForms(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_form = $_POST["id_form"];
            $id_question = $_POST["id_question"];
            $status = $_POST["status"];
            $table_questions_forms = "{$wpdb->prefix}questions_forms";
            $response = array();
            $dataFormQuestions = array("id_form"=>$id_form,"id_question"=>$id_question);
            if($status == 1){
                $result = $wpdb->insert($table_questions_forms,$dataFormQuestions);
            }
            else if ($status == 0) {
                $result = $wpdb->delete($table_questions_forms,$dataFormQuestions);
            }
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"No se pudo asignar la pregunta al formulario", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_statusQuestionForms','statusQuestionForms');

function getQuestions(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_question = $_POST["id_question"];
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_type = "{$wpdb->prefix}type_questions";
            $table_options = "{$wpdb->prefix}options_questions";
            $response = array();
            $sql = "SELECT Q.id_question, Q.description_question, Q.description_answer, Q.attached, Q.link_attached, Q.is_dependent, Q.status_question, Q.id_type_question, T.description_type
                FROM $table_questions as Q INNER JOIN $table_type as T ON Q.id_type_question = T.id_type_question
                WHERE Q.status_question = 1
                ORDER BY Q.id_question ASC";
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser consultada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_getQuestions','getQuestions');

function deleteForm(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_form = $_POST["id_form"];
            $dataDelete = array("id_form"=>$id_form);
            $table_questions_forms = "{$wpdb->prefix}questions_forms";
            $table_forms = "{$wpdb->prefix}list_forms";
            $wpdb->delete($table_questions_forms,$dataDelete);
            $result = $wpdb->delete($table_forms,$dataDelete);
            if($result){
                $response = json_encode(array("code"=>200, "message"=>"Formulario Eliminado", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"El formulario no pudo ser eliminado", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_deleteForm','deleteForm');

function deleteQuestion(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_question = $_POST["id_question"];
            $dataDelete = array("id_question"=>$id_question);
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_options = "{$wpdb->prefix}options_questions";
            $wpdb->delete($table_options,$dataDelete);
            $result = $wpdb->delete($table_questions,$dataDelete);
            if($result){
                $response = json_encode(array("code"=>200, "message"=>"Pregunta Eliminada", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"La pregunta no pudo ser eliminada", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action('wp_ajax_deleteQuestion','deleteQuestion');

function printForm($atts){
    $adminData = new adminQuestions();
    $id_form = $atts["id"];
    $html = $adminData->loadQuestions($id_form);
    $html .= "<div class='row'><div class='col-lg-12 text-center'><button type='button' class='btn btn-lg' id='sendInfo'>Guardar Información <i class='fa fa-floppy-o' aria-hidden='true'></i></button></div></div>";
    return $html;
}

add_shortcode( "print_questions", "printForm" );

function printFormCompany(){
    $adminData = new adminQuestions();
    $html = $adminData->loadFormCompany();
    $html .= "<div class='row'><div class='col-lg-12 text-center'><button type='button' class='btn btn-lg' id='sendInfo'>Guardar Información <i class='fa fa-floppy-o' aria-hidden='true'></i></button></div></div>";
    return $html;
}

add_shortcode( "print_form_company", "printFormCompany" );

function printFormInspectors(){
    $adminData = new adminQuestions();
    $html = $adminData->loadFormInspectors();
    $html .= "<div class='row'><div class='col-lg-12 text-center'><button type='button' class='btn btn-lg' id='sendInfo'>Guardar Información <i class='fa fa-floppy-o' aria-hidden='true'></i></button></div></div>";
    return $html;
}

add_shortcode( "print_form_inspectors", "printFormInspectors" );

function getReports(){
    $adminData = new adminQuestions();
    $report = $adminData->loadReports();
    return $report;
}

add_shortcode( "print_reports", "getReports" );

function getAllReports(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $table_users = "{$wpdb->prefix}list_users";
            $sql = "SELECT id_user, names, last_names, document, attached_report, date_report
                    FROM $table_users as LU";
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Reporte General", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"El reporte no pudo ser eliminado", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action( "wp_ajax_getAllReports", "getAllReports" );

function removeReport(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_user = $_POST["id_user"];
            $dataDelete = array("id_user"=>$id_user);
            $table_users = "{$wpdb->prefix}list_users";
            $result = $wpdb->delete($table_users,$dataDelete);
            if($result){
                $response = json_encode(array("code"=>200, "message"=>"Reporte Eliminado", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"El reporte no pudo ser eliminado", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action( "wp_ajax_deleteReport", "removeReport" );

function getReportsImage(){
    global $wpdb;
    try {
        if(isset($_POST)){
            $id_user = $_POST["id_user"];
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_answers = "{$wpdb->prefix}list_answers";
            $response = array();
            $sql = "SELECT LA.id_answer as id_answer, LQ.description_question as description_question, LQ.id_type_question as id_type_question, LA.answer_file as answer_file
                FROM $table_answers as LA INNER JOIN $table_questions as LQ ON LA.id_question = LQ.id_question
                WHERE LA.id_user = $id_user AND LQ.id_type_question = 7";
            $result = $wpdb->get_results($sql,ARRAY_A);
            if(!empty($result)){
                $response = json_encode(array("code"=>200, "message"=>"Ejecución Exitosa", "result"=>$result));
            }
            else {
                $response = json_encode(array("code"=>500, "message"=>"Las preguntas no pudieron ser consultadas", "result"=>$result));
            }
        }
        else {
            $response = json_encode(array("code"=>400, "message"=>"Los datos necesarios están incompletos"));
        }
        echo $response;
    }
    catch(Exception $e){
        echo json_encode(array("code"=>500,"error"=>$e));
    }
    wp_die();
}

add_action( "wp_ajax_reportsImage", "getReportsImage" );

function add_styles_page(){
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_questions') ) {
        wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
        wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
        wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css?family=Didact+Gothic");
        wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
        wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
        wp_enqueue_style('custom_css',plugins_url('admin/css/admin_page.css',__FILE__));
        wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
        wp_enqueue_script('pdfobject_js',"https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js",array('jquery'));
        wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
        wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
        wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
        wp_enqueue_script('admin_page',plugins_url('admin/js/admin-page.js',__FILE__),array('jquery'));
        wp_localize_script('request_js', 'SolicitudesAjax', [
            'url' => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('seg')

        ]);
    }
    else if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_reports') ) {
        wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
        wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
        wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css?family=Didact+Gothic");
        wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
        wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
        wp_enqueue_style('custom_css',plugins_url('admin/css/reports_page.css',__FILE__));
        wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
        wp_enqueue_script('pdfobject_js',"https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js",array('jquery'));
        wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
        wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
        wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
        wp_enqueue_script('reports_page',plugins_url('admin/js/reports-page.js',__FILE__),array('jquery'));
        wp_localize_script('request_js', 'SolicitudesAjax', [
            'url' => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('seg')

        ]);
    }
    else if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_form_company') ) {
        wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
        wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
        wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css?family=Didact+Gothic");
        wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
        wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
        wp_enqueue_style('custom_css',plugins_url('admin/css/reports_page.css',__FILE__));
        wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
        wp_enqueue_script('pdfobject_js',"https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js",array('jquery'));
        wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
        wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
        wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
        wp_enqueue_script('company_page',plugins_url('admin/js/company-page.js',__FILE__),array('jquery'));
        wp_localize_script('request_js', 'SolicitudesAjax', [
            'url' => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('seg')

        ]);
    }
    else if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_form_inspectors') ) {
        wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
        wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
        wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css?family=Didact+Gothic");
        wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
        wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
        wp_enqueue_style('custom_css',plugins_url('admin/css/reports_page.css',__FILE__));
        wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
        wp_enqueue_script('pdfobject_js',"https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js",array('jquery'));
        wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
        wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
        wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
        wp_enqueue_script('inspectors_page',plugins_url('admin/js/inspectors-page.js',__FILE__),array('jquery'));
        wp_localize_script('request_js', 'SolicitudesAjax', [
            'url' => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('seg')

        ]);
    }
}

add_action( 'wp_enqueue_scripts', 'add_styles_page' );

/* function add_scripts_page(){
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_questions') ) {

    }
}

add_action( 'wp_enqueue_scripts', 'add_scripts_page' );
 */
?>