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

      $html.="<!-- #dialog is the id of a DIV defined in the code below -->
                <a href='#exampleModal' name='modal'>Simple Modal Window</a>
                
                <div id='boxes'>
                
                  
                  <!-- #customize your modal window here -->
                
                  <div id='dialog' class='window'>
                    <b>Testing of Modal Window</b> | 
                    
                    <!-- close button is defined as close class -->
                    <a href='#' class='close'>Close it</a>
                
                  </div>
                
                  
                  <!-- Do not remove div#mask, because you'll need it to fill the whole screen -->	
                  <div id='mask'></div>
                </div>";

        return $html;


    }

}