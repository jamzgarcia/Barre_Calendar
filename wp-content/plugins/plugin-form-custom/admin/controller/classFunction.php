<?php 
/*require('fpdf/fdpf.php');
class PDF extends FPDF
{
    function Header()
    {
        $this->SetFillColor(253,135,39);
        $this->Rect(0,0,22,5, 'DF');
    }
}*/
class adminQuestions {

    public function getTypeQuestions(){
        global $wpdb;
        $table = "{$wpdb->prefix}type_questions";
        $sql = "SELECT * FROM $table";
        $data = $wpdb->get_results($sql,ARRAY_A);
        if(empty($data[0])){
            $data = array();
        }
        return $data;
    }

    public function getQuestionById($id_question){
        global $wpdb;
        try {
            $table_questions = "{$wpdb->prefix}list_questions";
            $table_type = "{$wpdb->prefix}type_questions";
            $table_options = "{$wpdb->prefix}options_questions";
            $response = array();
            print_r("Llego a by id");
            $sql = "SELECT Q.id_question, Q.description_question, Q.attached, Q.link_attached, Q.status_question, Q.id_type_question, T.description_type
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
                $response = $result[0];
            }
            else {
                $response = false;
            }
            echo $response;
        }
        catch(Exception $e){
            return false;
        }
    }
    
    public function getOptionsById($id_question){
        global $wpdb;
        try {
            /* $table_questions = "{$wpdb->prefix}list_questions";
            $table_type = "{$wpdb->prefix}type_questions"; */
            $table_options = "{$wpdb->prefix}options_questions";
            $response = array();
            $sql_options = "SELECT * FROM $table_options WHERE id_question = $id_question";
            $result_options = $wpdb->get_results($sql_options,ARRAY_A);
            if(!empty($result_options)){
                $response = $result_options;
            }
            else {
                $response = false;
            }
            // echo $response;
            return $response;
        }
        catch(Exception $e){
            return false;
        }
    }
    
    public function getListForms(){
        global $wpdb;
        try {
            $table_forms = "{$wpdb->prefix}list_forms";
            $response = array();
            $sql_forms = "SELECT * FROM $table_forms";
            $result_forms = $wpdb->get_results($sql_forms,ARRAY_A);
            if(!empty($result_forms)){
                $response = $result_forms;
            }
            else {
                $response = false;
            }
            // echo $response;
            return $response;
        }
        catch(Exception $e){
            return false;
        }
    }

    public function showQuestion($id_question,$type,$options){
        if ($type == 1) {
            $show_detail = "<div class='col-lg-8'><div class='input-group'><input id='question_$id_question' class='form-control form-control-lg' value='' type='date'></div></div>";
        }
        else if ($type == 2) {
            $show_detail = "<div class='col-lg-8'><div class='input-group'><textarea id='question_$id_question' rows='2' class='form-control form-control-lg' value='' type='text'></textarea></div></div>";
        }
        else if ($type == 3) {
            $show_detail = "<div class='col-lg-8'><div class='input-group'><input id='question_$id_question' class='form-control form-control-lg' value='' type='number'></div></div>";
        }
        else if ($type == 4 || $type == 6) {
            $show_detail = "<div class='col-lg-8'><div class='row text-center' id=''><div class='col-lg-12'><select id='question_$id_question' class='form-control form-control-lg selectForm' data-question='$id_question'>";
            $show_detail .= ($type == 4) ?"<option value='--'>--</option>":"";
            foreach ($options as $key => $value) {
                $id_option = $value['id_option'];
                $description_option = $value['description_option'];
                $selected = ($description_option == "N/A")?"selected":"";
                $show_detail .= "<option value='$id_option' $selected>$description_option</option>";
            }
            $show_detail .= "</select></div></div></div>";
        }
        else if ($type == 5) {
            $show_detail = "<div class='col-lg-8'>";
            $type_input = ($type == 5)?'checkbox':'radio';
            foreach ($options as $key => $value) {
                $id_option = $value['id_option'];
                $description_option = $value['description_option'];
                $show_detail .= "<div class='row text-center' id=''><div class='col-lg-1'><div class='form-check p-1'><input class='form-check-input radioQuestion' type='$type_input' name='question_$id_question' id='' data-question='$id_question' value='$id_option'></div></div><div class='col-lg-5'><label class='label label-default'>$description_option</label></div></div>";
            }
            $show_detail .= "</div>";
        }
        else if ($type == 7) {
            $show_detail = "<div class='col-lg-12'><div class='form-group'><div class='input-group input-file link_attached_option_$id_question' name='fileAttached_$id_question'><span class='input-group-btn p-3'><button id='btnAttach_$id_question' class='btn btn-choose btn-lg btnAttach' type='button'>Adjuntar</button></span><input type='text' class='form-control form-control-lg' placeholder='Escoge el archivo...' /><span class='input-group-btn p-3'><button class='btn btn-warning btn-reset btn-lg' type='button'>Reset</button></span></div></div></div>";
        }
        return $show_detail;
    }

    public function loadQuestions($id_form){
        global $wpdb;
        $table_questions = "{$wpdb->prefix}list_questions";
        $table_questions_forms = "{$wpdb->prefix}questions_forms";
        $sql = "SELECT * 
                FROM $table_questions as Q INNER JOIN $table_questions_forms as QF ON Q.id_question = QF.id_question AND QF.id_form = $id_form 
                WHERE status_question = 1 
                ORDER BY Q.id_question";
        $data = $wpdb->get_results($sql,ARRAY_A);
        $div_questions = "<div id='bodyQuestions'><form id='formQuestions'>";
        // $div_questions .= "<div class='divQuestion'><div class='card mb-3'><div class='card-header'><label class='control-label' id='label_names'>Informe </label></div><div class='card-body'><div class='col-lg-8'><label class='control-label' id='label_names'>Informe </label><div class='input-group'><input id='names' class='form-control form-control-lg' value='' type='text'></div></div>";
        $div_questions .= "<div class=''>
                                <div class='card mb-3'>
                                    <div class='card-header'>
                                        <label class='control-label' id='label_names'>Formulario de Inspección </label>
                                    </div>
                                    <div class='card-body'>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_names'>Nombres </label>
                                            <div class='input-group'><input id='names' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_last_names'>Apellidos </label>
                                            <div class='input-group'><input id='last_names' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_document'>N° Documento </label>
                                            <div class='input-group'><input id='document' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        if(!empty($data[0])){
            foreach ($data as $key => $value) {
                $id_question = $value["id_question"];
                $id_type_question = $value["id_type_question"];
                $description_question = $value["description_question"];
                $attached = $value["attached"];
                $link_attached = $value["link_attached"];
                $is_dependent = $value["is_dependent"];
                $dependent_question = $value["dependent_question"];
                $dependent_options = $value["dependent_options"];
                $class_hide = ($is_dependent == 1)?'d-none':'';
                $div_questions .= "<div class='divQuestion $class_hide' data-question='$id_question' data-type='$id_type_question' data-dependent='$is_dependent' data-dependquestion='$dependent_question' data-dependoptions='$dependent_options'><div class='card mb-3'><div class='card-header'><label class='control-label' id='label_question_$id_question'>$description_question</label></div>";
                $div_questions .= "<div class='card-body'>";
                if($attached == 1){ 
                    // $div_questions .= "<div class='col-sm-12 col-md-12 col-xl-12 w-100 p-3' align='center'><img id='imageQuestion' src='../$link_attached' class='rounded mx-auto d-block' style='width: 50%; height: 50%;'></div><br>";
                    $div_questions .= "<div class='col-sm-12 col-md-12 col-xl-12 w-100 p-3' align='center'><img id='imageQuestion' src='../$link_attached' class='rounded mx-auto d-block' style='width: auto; height: auto;'></div><br>";
                }
                if($id_type_question == 4 || $id_type_question == 5 || $id_type_question == 6){
                    $array_options = $this->getOptionsById($id_question);
                }
                else {
                    $array_options = array();
                }
                $div_questions .= $this->showQuestion($id_question,$id_type_question,$array_options);
                $div_questions .= "</div></div></div>";
            }
        }
        $div_questions .= "</form></div>";
        return $div_questions;
    }

    public function loadFormCompany(){
        global $wpdb;
        $div_questions = "<div id='bodyQuestions'><form id='formQuestions'>";
        $div_questions .= "<div class=''>
                                <div class='card mb-3'>
                                    <div class='card-header'>
                                        <label class='control-label' id='label_names'>Formulario de Empresas </label>
                                    </div>
                                    <div class='card-body'>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_names'>Nombre Comercial </label>
                                            <div class='input-group'><input id='names' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_identify'>Nit </label>
                                            <div class='input-group'><input id='identify' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_address'>Dirección de la Oficina </label>
                                            <div class='input-group'><input id='address' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_type_society'>Tipo de Sociedad </label>
                                            <div class='input-group'><input id='type_society' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_business_name'>Objeto Social </label>
                                            <div class='input-group'><input id='business_name' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        $div_questions .= "</form></div>";
        return $div_questions;
    }

    public function loadFormInspectors(){
        global $wpdb;
        $table_company = "{$wpdb->prefix}list_company";
        $sql = "SELECT * 
                FROM $table_company";
        $data = $wpdb->get_results($sql,ARRAY_A);        
        $select_company .= "<select id='company' class='form-control form-control-lg selectCompany'><option value='--'>--</option>";
        if(!empty($data[0])){
            foreach ($data as $key => $value) {
                $id_company = $value["id_company"];
                $names = $value["names"];
                $select_company .= "<option value='$id_company'>$names</option>";
            }
        }
        $select_company .= "</select>";
        $div_questions = "<div id='bodyQuestions'><form id='formQuestions'>";
        $div_questions .= "<div class=''>
                                <div class='card mb-3'>
                                    <div class='card-header'>
                                        <label class='control-label' id='label_names'>Formulario de Inspectores </label>
                                    </div>
                                    <div class='card-body'>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_names'>Nombres </label>
                                            <div class='input-group'><input id='names' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_last_names'>Apellidos </label>
                                            <div class='input-group'><input id='last_names' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_document'>N° de Documento </label>
                                            <div class='input-group'><input id='document' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_mobile'>Telefono de Contacto </label>
                                            <div class='input-group'><input id='mobile' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_email'>Email de Contacto </label>
                                            <div class='input-group'><input id='email' class='form-control form-control-sm' value='' type='text'></div>
                                        </div>
                                        <div class='col-lg-10 p-2'><label class='control-label' id='label_company'>Compañía </label>
                                            ".$select_company."
                                        </div>
                                    </div>
                                </div>
                            </div>";
        $div_questions .= "</form></div>";
        return $div_questions;
    }

    public function loadReports(){
        global $wpdb;
        $table_users = "{$wpdb->prefix}list_users";
        $sql = "SELECT id_user, names, last_names, document, attached_report, date_report
                FROM $table_users as LU";
        $data = $wpdb->get_results($sql,ARRAY_A);
        // $div_questions = "<div id='bodyQuestions'><form id='formQuestions'><div class='row'><div class='col-lg-12'><label class='control-label'>Aquí Comienza</label></div></div><hr class='style1'>";
        $div_questions = "<table class='table table-stripped table-hover' border='1'><thead><tr><th scope='col' width='200' class='text-center'>#</th><th scope='col' width='200' class='text-center'>Nombres</th><th scope='col' width='200' class='text-center'>Apellidos</th><th scope='col' width='200' class='text-center'>Documento</th><th scope='col' width='200' class='text-center'>Fecha Reporte</th><th scope='col' width='200' class='text-center'>Link Reporte</th><th scope='col' width='200' class='text-center'>Reporte de Imagen</th><th scope='col' width='200' class='text-center'>Eliminar</th></tr></thead><tbody id='contentAnswers'>";
        if(!empty($data[0])){
            $num = 1;
            foreach ($data as $key => $value) {
                $id_user = $value["id_user"];
                $names = $value["names"];
                $last_names = $value["last_names"];
                $document = $value["document"];
                $attached_report = "../".$value["attached_report"];
                $date_report = $value["date_report"];
                $div_questions .= "<tr><th scope='col' class='text-center'>$num</th><td style='width: 100px'>$names</td><td style='width: 100px'>$last_names</td><td style='width: 100px'>$document</td><td style='width: 100px'>$date_report</td><td style='width: 100px'><a href='$attached_report' target='_blank'>Ver Reporte <i class='fa fa-file-pdf-o' aria-hidden='true'></a></td><td class='text-center' style='width: 100px'><button class='btn btn-info viewReport' data-user='$id_user'>Ver Reporte <i class='fa fa-file-image-o' aria-hidden='true'></button></td><td class='text-center' style='width: 100px'><button class='btn btn-outline-danger deleteReport' data-user='$id_user'><i class='fa fa-trash' aria-hidden='true'></button></td></tr>";
                $num++;
            }
        }
        $div_questions .= "</tbody></table>";
        $div_questions .= "<div id='modalSmallView'>
                                <div class='modal fade' id='ModalObs' tabindex='-1' role='dialog' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog' id= 'modalCreate' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header' style='background-color:#E6E6E6'>
                                                <div id='headTag'>
                                                    <div class='row modal-title' id='tittleContent'>
                                                        <div class='col-md-12 col-sm-12 col-xs-12 text-center'>
                                                            <h5 id='titleModal'></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <form id='form2' autocomplete='off'>
                                                <div class='modal-body' style='background-color:#EFFBFB'>
                                                    <div id='bodyTag'></div>
                                                </div>
                                                <div class='modal-footer' style='background-color:#E6E6E6'>
                                                    <span id='errorModal' class='animated infinite flash'></span>
                                                    <div id='buttons_action'>
                                                        <button type='button' id='btnModal' class='btn btn-info btn-sm' > <i class='fa fa-floppy-o' aria-hidden='true'></i></button>
                                                    </div>
                                                    <button type='button' class='btn btn-outline-danger btn-sm' data-dismiss='modal'>Cancelar <i class='fa fa-window-close' aria-hidden='true'></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        $div_questions .= "<div id='modalLargeView'>
                                <div class='modal fade bd-example-modal-lg' id='ModalLarge' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
                                    <div class='modal-dialog modal-lg' id= 'modalLargeCreate' role='document'>
                                        <div class='modal-content'>
                                            <div class='modal-header' style='background-color:#E6E6E6'>
                                                <div id='headTag'>
                                                    <div class='row modal-title' id='tittleContent'>
                                                        <div class='col-md-12 col-sm-12 col-xs-12 text-center'>
                                                            <h5 id='titleModalLarge' style='text-align: center;'></h5>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                                    <span aria-hidden='true'>&times;</span>
                                                </button>
                                            </div>
                                            <form id='form1' autocomplete='off'>
                                                <div class='modal-body' style='background-color:#EFFBFB'>
                                                    <div id='bodyTagLarge' style=''></div>
                                                </div>
                                                <div class='modal-footer' style='background-color:#E6E6E6'>
                                                    <span id='errorModalLarge' class='animated infinite flash text-center'></span>
                                                    <div id='buttons_action_large'>
                                                        <button type='button' id='btnModalLarge' class='btn btn-info btn-sm' disabled='disabled'></button>
                                                    </div>
                                                    <button type='button' class='btn btn-outline-danger btn-sm btnClose' data-dismiss='modal'>Salir <i class='fa fa-window-close' aria-hidden='true'></i></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>";
        return $div_questions;
    }

    public function loadAnswers($id_user){
        /**/
        global $wpdb;
        $root = realpath($_SERVER["DOCUMENT_ROOT"]);
        $table_answers = "{$wpdb->prefix}list_answers";
        $table_questions = "{$wpdb->prefix}list_questions";
        $table_options = "{$wpdb->prefix}options_questions";
        $array_months = array("01"=>"Enero","02"=>"Febrero","03"=>"Marzo","04"=>"Abril","05"=>"Mayo","06"=>"Junio","07"=>"Julio","08"=>"Agosto","09"=>"Septiembre","10"=>"Octubre","11"=>"Noviembre","12"=>"Diciembre");
        $sql = "SELECT LA.id_answer as id_answer, LQ.description_question as description_question, LQ.description_answer as description_answer, LQ.id_type_question as id_type_question, LA.answer_text as answer_text, LA.answer_date as answer_date, LA.answer_file as answer_file, (SELECT GROUP_CONCAT(OQ.description_answer) FROM $table_options as OQ WHERE OQ.id_option IN (LA.answer_multiple)) as option_description_answer, (SELECT GROUP_CONCAT(OQ.description_option) FROM $table_options as OQ WHERE OQ.id_option IN (LA.answer_multiple)) as options_answers, LQ.risk as risk
                FROM $table_answers as LA INNER JOIN $table_questions as LQ ON LA.id_question = LQ.id_question
                WHERE LA.id_user = $id_user AND LQ.id_type_question <> 7";
        $data = $wpdb->get_results($sql,ARRAY_A);
        // $div_questions = "<div id='bodyQuestions'><form id='formQuestions'><div class='row'><div class='col-lg-12'><label class='control-label'>Aquí Comienza</label></div></div><hr class='style1'>";
        $pdf=new PDF_Code128();
        $pdf->AddPage();
        $pdf->SetFont('Arial','',14);
        $pdf->SetMargins(15, 25 , 15); 
        $pdf->Image(ABSPATH."wp-content/plugins/plugin-form-custom/admin/images/logo.png",null , null , 35, 30);
        $title = iconv('utf-8', 'cp1252', "Reporte de Inspección");
        $pdf->Cell(180,10,$title,0,0,'C');
        // $pdf->Cell(30,10,'Title',1,0,'C');
        $pdf->SetFont('Arial','',10);
        $pdf->Ln(15);
        // $pdf->Cell(85,5,"Pregunta",1,0,'C');
        $pdf->Cell(170,5,"Respuesta",0,0,'C');
        $pdf->Ln(5);
        $pdf->SetFont('Arial','',8);
        $div_questions = "<table border='1'><thead><tr><th>Pregunta</th><th>Respuesta</th></tr></thead><tbody>";
        if(!empty($data[0])){
            foreach ($data as $key => $value) {
                $id_answer = $value["id_answer"];
                $id_type_question = $value["id_type_question"];
                $description_question = iconv('utf-8', 'cp1252', $value["description_question"]);
                $description_answer = iconv('utf-8', 'cp1252', $value["description_answer"]);
                $answer_text = iconv('utf-8', 'cp1252', $value["answer_text"]);
                // $answer_text = $value["answer_text"];
                $answer_date = $value["answer_date"];
                $answer_file = $value["answer_file"];
                $options_answers = iconv('utf-8', 'cp1252', $value["options_answers"]);
                $option_description_answer = iconv('utf-8', 'cp1252', $value["option_description_answer"]);
                $risk = $value["risk"];
                // $pdf->Cell(170,5,$description_question,1,0,'L');
                if($id_type_question == 1){
                    $array_date = explode("-",$answer_date);
                    $answer_date_format =  $array_months[$array_date[1]]." ".$array_date[2]." de ".$array_date[0];
                    $div_questions .= "<tr><td>$description_question</td><td>$answer_date_format</td></tr>";
                    $pdf->Cell(170,5,$description_answer." ".$answer_date_format,0,0,'L');
                }
                else if($id_type_question == 2 || $id_type_question == 3){
                    $div_questions .= "<tr><td>$description_question</td><td>$answer_text</td></tr>";
                    $pdf->Cell(170,5,$description_answer." ".$answer_text,0,0,'L');
                }
                else if($id_type_question == 4 || $id_type_question == 5 || $id_type_question == 6){
                    $div_questions .= "<tr><td>$description_question</td><td>$options_answers</td></tr>";
                    $options_answers = ($risk != 0 && $risk != null)?$options_answers." - Riesgo: ".$risk:$options_answers;
                    $pdf->Cell(170,5,$option_description_answer." ".$options_answers,0,0,'L');
                }
                else if($id_type_question == 7){
                    $pdf->Ln(8);
                    $pdf->Cell(85,5,$pdf->Image(ABSPATH.$answer_file, $pdf->GetX() , $pdf->GetY()),0,0,'C');
                    
                }
                $pdf->Ln(5);
            }
        }
        $div_questions .= "</tbody></table>";
        // return $div_questions;
        $dir_ = ABSPATH."wp-content/plugins/plugin-form-custom/admin/controller/reports";
        if(!is_dir($dir_)) 
            mkdir($dir_, 0777, true);
        $name_file = ABSPATH."wp-content/plugins/plugin-form-custom/admin/controller/reports/$id_user.pdf";
        $pdf->Output($name_file,"F");
        $name_file = "/wp-content/plugins/plugin-form-custom/admin/controller/reports/$id_user.pdf";
        // $pdf->Output($name_file,"F");
        // $page_title = $wp_query->post->post_title;
        // $page_title = basename(get_permalink());
        // print_r(json_encode($pdf));
        return $name_file;
    }

}

?>