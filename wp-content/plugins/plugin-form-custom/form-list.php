
<?php 
// defined('ABSPATH') or die("Bye bye");
// include (ABSPATH . 'wp-content/plugins/plugin-form-custom/admin/controller/classFunction.php'); 
// require_once (ABSPATH . 'wp-content/plugins/plugin-form-custom/admin/controller/classFunction.php'); 
$adminData = new adminQuestions();
$data_type = $adminData->getTypeQuestions();
$data_forms = $adminData->getListForms();
// $data_questions = $adminData->getQuestions();
?>
<br>
<div class="container-fluid">
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark rounded">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" id="list_viewReport">
                    <a class="nav-link itemAction" id="createForms" href="#">Formularios <i class="fa fa-clipboard" aria-hidden="true"></i></a>
                </li>
                <li class="nav-item active" id="list_listQuestions">
                    <a class="nav-link itemAction" id="listQuestions" href="#">Preguntas <i class="fa fa-list-ul" aria-hidden="true"></i></a>
                    </li>
                <li class="nav-item" id="list_createQuestion">
                    <a class="nav-link itemAction" id="createQuestion" href="#">Crear Preguntas <i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" id="find" type="search" placeholder="Buscar" aria-label="Buscar">
                <!-- <button class="btn btn-light my-2 my-sm-0" type="button">Buscar</button> -->
            </form>
        </div>
    </nav>
    <div class="bodyTheme">
        <div class="animated fadeIn tabsView d-none" id="div_createForms">
            <div class="row text-center p-3">
                <div class="col-lg-12 p-3 alert-info ">
                    <h5>Lista de Formularios</h5>                
                </div>
            </div>
            <div class="row p-1" id="table_forms">
                <div class="col-lg-12">
                    <table class="table table-stripped table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Nombre de Formulario</th>
                                <th scope="col" class="text-center">Shortcode</th>
                                <th scope="col" class="text-center">Gestionar Preguntas</th>
                                <th scope="col" class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="contentForms">

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row p-1 text-center">
                <div class="col-lg-12">
                    <button type="button" class="btn btn-sm btn-primary" id="newForm">Nuevo Formulario <i class="fa fa-clipboard" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="p-1 d-none animated fadeIn" id="div_new_forms">
                <div class="row">
                    <div class="col-lg-12">
                        <form id="formCreationForms">
                            <div class="control-group p-3">
                                <!-- <div class="control-group p-3 rounded alert-info">
                                    <label class="label label-default font-weight-bold">Ingrese el nombre del nuevo formulario.</label>
                                </div>
                                <hr class="style1"> -->
                                <div class="row">
                                    <div class="col-xl-12">
                                        <label class="control-label input-label font-weight-bold" id="label_description_form">Escriba el nombre del formulario:</label>
                                        <div class="input-group"><input id="description_form" class="form-control form-control-sm" value="" type="text" placeholder="Escriba aqui el nombre del formulario"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="row p-1 text-center">
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-sm btn-success" id="saveForm">Crear Formulario <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-lg-6">
                        <button type="button" class="btn btn-sm btn-outline-danger" id="cancelForm">Cancelar <i class="fa fa-times" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>
        </div>
        <div class="animated fadeIn tabsView d-none" id="div_listQuestions">
            <div class="row text-center p-3">
                <div class="col-lg-12 p-3 alert-info ">
                    <h5>Lista de Preguntas</h5>                
                </div>
            </div>
            <div class="row p-1">
                <div class="col-lg-12">
                    <table class="table table-stripped table-hover">
                        <thead class="thead-dark text-center">
                            <tr>
                                <th scope="col" class="text-center">#</th>
                                <th scope="col" class="text-center">Pregunta</th>
                                <th scope="col" class="text-center">Tipo de Pregunta</th>
                                <th scope="col" class="text-center">Condicional</th>
                                <th scope="col" class="text-center">Ver</th>
                                <th scope="col" class="text-center">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody id="contentQuestions">

                        </tbody>
                    </table>
                </div>
            </div>
            <fieldset class="scheduler-border">
            </fieldset>
        </div>
        <div class="animated fadeIn tabsView d-none" id="div_createQuestion">   
            <fieldset class="scheduler-border">
                <legend class="scheduler-border" id="legend_name"></legend>
                <form id="formCreation">
                    <div class="control-group p-3">
                        <div class="control-group p-3 rounded alert-info">
                            <label class="label label-default font-weight-bold">Para crear una pregunta elige el tipo que deseas utilizar y sigue los pasos.</label>
                        </div>
                        <hr class="style1">
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="control-label input-label font-weight-bold" id="label_question_description">Escriba el enunciado de la pregunta:</label>
                                <div class="input-group"><textarea id="question_description" placeholder="Enunciado" rows="2" class="form-control form-control-sm" value=""></textarea></div>
                            </div>
                            <div class="col-xl-2 inputGroupContainer text-center">
                                <label class="control-label input-label font-weight-bold" id="label_dependent">Agregar condición a la pregunta:</label>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class='btn btn-outline-success btn-sm dependent' data-val='Si'><input class='form-control' type='radio' name='dependent'>Si <i class="fa fa-check" aria-hidden="true"></i></label>
                                    <label class='btn btn-outline-danger btn-sm dependent active' data-val='No'><input class='form-control' type='radio' name='dependent'>No <i class="fa fa-times" aria-hidden="true"></i></label>
                                </div>
                            </div>
                            <div class="col-xl-4">
                                <div id="div_dependent" class="d-none animated fadeIn">
                                    <label class="control-label input-label font-weight-bold" id="label_question_dependent">Seleccione la pregunta y la(s) opción(es) que depende esta pregunta:</label>
                                    <div class="input-group" id="selectQuestion">
                                        <select class="form-control novelty form-control-sm selectQuestion">
                                            <option value="--" selected>--</option>
                                        </select>
                                    </div>
                                    <hr class="style1">
                                    <div id="div_dependent_options" class="d-none animated fadeIn"></div>
                                </div>
                            </div>
                        </div>
                        <hr class="style1">
                        <div class="row">
                            <div class="col-xl-6">
                                <label class="control-label input-label font-weight-bold" id="label_description_answer">Escriba la respuesta personalizada para esta pregunta:</label>
                                <div class="input-group"><textarea id="description_answer" placeholder="Respuesta" rows="2" class="form-control form-control-sm" value=""></textarea></div>
                            </div>
                            <div class="col-xl-2 inputGroupContainer text-center">
                                <!-- <label class="control-label input-label font-weight-bold" id="label_dependent">Agregar condición a la pregunta:</label> -->
                            </div>
                            <div class="col-xl-4">
                                
                            </div>
                        </div>
                        <hr class="style1">
                        <div class="row">
                            <div class="col-xl-3">
                                <label class="control-label input-label font-weight-bold" id="label_selectType">Seleccione el tipo de pregunta:</label>
                                <div class="input-group" id="selectType">
                                    <select class="form-control novelty form-control-sm selectType">
                                        <option value="--" selected>--</option>
                                        <?php 
                                        foreach ($data_type as $key => $value) {
                                            $id_type = $value["id_type_question"];
                                            $desc_type = $value["description_type"];
                                            echo "<option value='$id_type'>$desc_type</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xl-1">

                            </div>
                            <div class="col-xl-1">
                                <div id="div_num_options" class="d-none animated fadeIn">
                                    <label class="control-label input-label font-weight-bold" id="label_num_options">N° Opciones:</label>
                                    <input id="num_options" class="form-control form-control-sm" value="" type="number" maxlength="2" size="1">
                                </div>
                            </div>
                            <div class="col-xl-1">
                            
                            </div>
                            <div class="col-xl-2 inputGroupContainer text-center">
                                <label class="control-label input-label font-weight-bold" id="label_attached">Agregar imagen a la pregunta:</label>
                                <div class="btn-group" data-toggle="buttons">
                                    <label class='btn btn-outline-success btn-sm attached' data-val='Si'><input class='form-control' type='radio' name='attached'>Si <i class="fa fa-check" aria-hidden="true"></i></label>
                                    <label class='btn btn-outline-danger btn-sm attached active' data-val='No'><input class='form-control' type='radio' name='attached'>No <i class="fa fa-times" aria-hidden="true"></i></label>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div id="div_link_attached" class="d-none animated fadeIn">
                                    <label class="control-label input-label font-weight-bold" id="label_fileAttached">Adjunte el archivo</label>
                                    <div class="form-group">
                                        <div class="input-group input-file" name="fileAttached">
                                            <span class="input-group-btn">
                                                <button class="btn btn-default btn-choose btn-sm" type="button">Adjuntar</button>
                                            </span>
                                            <input type="text" class="form-control form-control-sm" placeholder='Escoge el archivo...' />
                                            <span class="input-group-btn">
                                                <button class="btn btn-warning btn-reset btn-sm" type="button">Reset</button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-none animated fadeIn" id="div_options">
                            
                        </div>
                        <hr class="style1">
                        <div class="row text-center">
                            <div class="col-lg-12 inputGroupContainer">
                                <button type="button" id="saveQuestion" class="btn btn-outline-success btn-sm">Guardar Pregunta <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                            </div>
                        </div>
                    </div>
                </form>
            </fieldset>
        </div>
        <div id="modalLargeView">
            <div class="modal fade bd-example-modal-lg" id="ModalLarge" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" id= "modalLargeCreate" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style='background-color:#E6E6E6'>
                            <div id="headTag">
                                <div class="row modal-title" id="tittleContent">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <h5 id="titleModalLarge" style="text-align: center;"></h5>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form1" autocomplete="off">
                            <div class="modal-body" style='background-color:#EFFBFB'>
                                <div id="bodyTagLarge" style=""></div>
                            </div>
                            <div class="modal-footer" style='background-color:#E6E6E6'>
                                <span id="errorModalLarge" class="animated infinite flash text-center"></span>
                                <div id="buttons_action_large">
                                    <button type="button" id="btnModalLarge" class="btn btn-info btn-sm" disabled="disabled"></button>
                                </div>
                                <button type="button" class="btn btn-outline-danger btn-sm btnClose" data-dismiss="modal">Salir <i class="fa fa-window-close" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div id="modalSmallView">
            <div class="modal fade" id="ModalObs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" id= "modalCreate" role="document">
                    <div class="modal-content">
                        <div class="modal-header" style='background-color:#E6E6E6'>
                            <div id="headTag">
                                <div class="row modal-title" id="tittleContent">
                                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                        <h5 id="titleModal"></h5>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="form2" autocomplete="off">
                            <div class="modal-body" style='background-color:#EFFBFB'>
                                <div id="bodyTag"></div>
                            </div>
                            <div class="modal-footer" style='background-color:#E6E6E6'>
                                <span id="errorModal" class="animated infinite flash"></span>
                                <div id="buttons_action">
                                    <button type="button" id="btnModal" class="btn btn-info btn-sm" > <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                                </div>
                                <button type="button" class="btn btn-outline-danger btn-sm" data-dismiss="modal">Cancelar <i class="fa fa-window-close" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 

?>