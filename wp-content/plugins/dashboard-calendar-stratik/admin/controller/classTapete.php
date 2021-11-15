<?php

/* Clase Principal del Plugin Para el Coaches. */
class Tapete
{
  public function formTapete()
  {
    $html = "<!DOCTYPE html>
<html lang='en'>

<head>
  <meta charset='UTF-8'>
  <meta http-equiv='X-UA-Compatible' content='IE=edge'>
  <meta name='viewport' content='width=device-width, initial-scale=1.0'>
</head>

<body>
  <div class='contenedor'>
    <dv class='contenedor-1'>

      <div class='card' >
      
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete1'/>
      
      </div>

      <div class='card'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete2' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete3' />
      </div>

      <div class='card' id='tapete'>
        <img src=' https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete4' />
      </div>

      <div class='card' id='tapete'>
        <img src=' https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete5' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete6'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete7'/>
      </div>

    </dv>

    <dv class='contenedor-2'>

      <div class='card1' id='coach'>

        <img src=' https://barremx.online/imgBarre/Tapetes-Coach.jpg' width='150' height='80' />

      </div>

      <div class='card' id='tapete' id='tapete77'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete8'/>
      </div>

    </dv>

    <dv class='contenedor-1'>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete9'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete10'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete11'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete12'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete13'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete14'/>
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' class ='tapetesMX' id='tapete15'/>
      </div>

    </dv>

  </div>
  
</body>

<!-- Modal -->
                        <div class='modal fade' id='nuevotapete' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
                          <div class='modal-dialog'>
                            <div class='modal-content'>
                              <div class='modal-header'>
                                <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                              </div>
                              <div class='modal-body'>
                                <form id='formCoach'>
                                  <div class='form-group'>
                                    <label for='dash_coach_nombre'>Nombre</label>
                                    <input type='text' class='form-control' id='dash_coach_nombre'>
                                    <label for='dash_coach_apellido'>Apellido</label>
                                    <input type='text' class='form-control' id='dash_coach_apellido'>
                                    <label for='dash_coach_correo'>Correo Electronico</label>
                                    <input type='email' class='form-control' id='dash_coach_correo'>
                                    <label for='dash_coach_fecha_nacimiento'>Fecha de Nacimiento</label>
                                    <input type='date' class='form-control' id='dash_coach_fecha_nacimiento'>
                                    
                                  </div>
                                  
                                  
                                  
                                </form>
                              </div>
                              <div class='modal-footer'>
                                <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                <div class='row text-center'><div class='col-lg-12'><button type='button' class='btn btn-lg mr-4' id='sendInfoCoach'>Enviar</button></div></div>
                              </div>
                            </div>
                          </div>
                        </div>

</html>";
    return $html;
  }
}
