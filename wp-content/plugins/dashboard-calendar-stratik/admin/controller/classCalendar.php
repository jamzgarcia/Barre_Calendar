<?php

/* Clase Principal del Plugin Para el Calendario. */
class Calendar
{

    public function layoutCalendarUsers(){
        $html = "<div class='mt-5'></div>

        <div class='container'>
          <div class='row'>
            <div class='col msjs'>
        ";
        if(isset($_REQUEST['e'])){
        $html .="<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                    <strong>Felicitaciones!</strong> El evento fue registrado correctamente.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                    </button>
                </div>";
        }
        if(isset($_REQUEST['ea'])){
        $html.="<div class='alert alert-success alert-dismissible fade show text-center' role='alert'>
                        <strong>Felicitaciones!</strong> El evento fue actualizado correctamente.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
                    }
        else
        {
        $html.="<div class='alert alert-danger alert-dismissible fade show text-center' role='alert' style='display: none;'>
                        <strong>Felicitaciones!</strong> El evento fue borrado correctamente.
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>";
        }
        $html .= "                     
            </div>
          </div>      
          <div class='row'>
            <div class='col-md-12 mb-3'>
              <h3 class='text-center' id='title'>Calendario de Prueba Barre MX</h3>
            </div>
          </div>
        </div>
      
      
      
        <div id='calendar'></div>
      ";

      $html.="<div class='modal' id='exampleModal' tabindex='-1' role='dialog'>
                <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title'>Registrar Nuevo Evento</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>


                        <div id='bodyQuestions'><form name='formEvento' id='formEvento'>
                        <div class='form-group'>
                        <label for='evento' class='col-sm-12 control-label'>Nombre de la clase</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                        </div>
                        </div>
                        <div class='form-group'>
                        <label for='evento' class='col-sm-12 control-label'>Nombre del Estudio</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                        </div>
                        </div>
                        <div class='form-group'>
                        <label for='evento' class='col-sm-12 control-label'>Nombre del Coach</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                        </div>
                        </div>
                        <div class='form-group'>
                        <label for='fecha_inicio' class='col-sm-12 control-label'>Fecha Inicio</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='fecha_inicio' id='fecha_inicio' placeholder='Fecha Inicio'>
                        </div>
                        </div>
                        <div class='form-group'>
                        <label for='fecha_fin' class='col-sm-12 control-label'>Fecha Final</label>
                        <div class='col-sm-10'>
                            <input type='text' class='form-control' name='fecha_fin' id='fecha_fin' placeholder='Fecha Final'>
                        </div>
                        </div>
                
                        <div class='col-md-12' id='grupoRadio'>
                
                        <input type='radio' name='color_evento' id='orange' value='#FF5722' checked>
                        <label for='orange' class='circu' style='background-color: #FF5722;'> </label>
                
                        <input type='radio' name='color_evento' id='amber' value='#FFC107'>
                        <label for='amber' class='circu' style='background-color: #FFC107;'> </label>
                
                        <input type='radio' name='color_evento' id='lime' value='#8BC34A'>
                        <label for='lime' class='circu' style='background-color: #8BC34A;'> </label>
                
                        <input type='radio' name='color_evento' id='teal' value='#009688'>
                        <label for='teal' class='circu' style='background-color: #009688;'> </label>
                
                        <input type='radio' name='color_evento' id='blue' value='#2196F3'>
                        <label for='blue' class='circu' style='background-color: #2196F3;'> </label>
                
                
                        <label for='indigo' class='circu' style='background-color: #FFB6C1;'> <input type='radio' name='color_evento' id='indigo' value='#FFB6C1'></label>
                
                        </div>
                
                        <div class='modal-footer'>
                        <button type='button' class='btn btn-lg' id='sendInfo'>Guardar Evento <i class='fa fa-floppy-o' aria-hidden='true'></i></button>
                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Salir</button>
                        </div>
                    </form>
                
                    </div>
                </div>
                </div>";

        $html.="<div class='modal' id='modalUpdateEvento' tabindex='-1' role='dialog'>
                    <div class='modal-dialog' role='document'>
                    <div class='modal-content'>
                        <div class='modal-header'>
                        <h5 class='modal-title'>Actualizar mi Evento</h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                        </div>
                        <form name='formEventoUpdate' id='formEventoUpdate' action='UpdateEvento.php' class='form-horizontal' method='POST'>
                        <input type='hidden' class='form-control' name='idEvento' id='idEvento'>
                        <div class='form-group'>
                            <label for='evento' class='col-sm-12 control-label'>Nombre de la clase</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='evento' class='col-sm-12 control-label'>Nombre del Estudio</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='evento' class='col-sm-12 control-label'>Nombre del Coach</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='evento' class='col-sm-12 control-label'>Hora</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='evento' id='evento' placeholder='Nombre del Evento' required />
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='fecha_inicio' class='col-sm-12 control-label'>Fecha Inicio</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='fecha_inicio' id='fecha_inicio' placeholder='Fecha Inicio'>
                            </div>
                        </div>
                        <div class='form-group'>
                            <label for='fecha_fin' class='col-sm-12 control-label'>Fecha Final</label>
                            <div class='col-sm-10'>
                            <input type='text' class='form-control' name='fecha_fin' id='fecha_fin' placeholder='Fecha Final'>
                            </div>
                        </div>
                
                        <div class='col-md-12 activado'>
                
                            <input type='radio' name='color_evento' id='orangeUpd' value='#FF5722' checked>
                            <label for='orangeUpd' class='circu' style='background-color: #FF5722;'> </label>
                
                            <input type='radio' name='color_evento' id='amberUpd' value='#FFC107'>
                            <label for='amberUpd' class='circu' style='background-color: #FFC107;'> </label>
                
                            <input type='radio' name='color_evento' id='limeUpd' value='#8BC34A'>
                            <label for='limeUpd' class='circu' style='background-color: #8BC34A;'> </label>
                
                            <input type='radio' name='color_evento' id='tealUpd' value='#009688'>
                            <label for='tealUpd' class='circu' style='background-color: #009688;'> </label>
                
                            <input type='radio' name='color_evento' id='blueUpd' value='#2196F3'>
                            <label for='blueUpd' class='circu' style='background-color: #2196F3;'> </label>
                
                            <input type='radio' name='color_evento' id='indigoUpd' value='#9c27b0'>
                            <label for='indigoUpd' class='circu' style='background-color: #9c27b0;'> </label>
                
                        </div>
                
                
                        <div class='modal-footer'>
                            <button type='submit' class='btn btn-success'>Guardar Cambios de mi Evento</button>
                            <button type='button' class='btn btn-secondary' data-dismiss='modal'>Salir</button>
                        </div>
                        </form>
                
                    </div>
                    </div>
                </div>";


        return $html;


    }

}