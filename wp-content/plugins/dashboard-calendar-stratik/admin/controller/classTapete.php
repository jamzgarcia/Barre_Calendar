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

      <div class='card'>
      <button onclick='tapete1()'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' id='tapeteA'/>
      </button>
      </div>

      <div class='card' onclick='tapete1()'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' id='tapeteB' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' id='tapeteC' />
      </div>

      <div class='card' id='tapete'>
        <img src=' https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' id='tapete' />
      </div>

      <div class='card' id='tapete'>
        <img src=' https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' id='tapete' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

    </dv>

    <dv class='contenedor-2'>

      <div class='card1' id='coach'>

        <img src=' https://barremx.online/imgBarre/Tapetes-Coach.jpg' width='150' height='80' />

      </div>

      <div class='card' id='tapete' id='tapete7'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

    </dv>

    <dv class='contenedor-1'>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

      <div class='card' id='tapete'>
        <img src='https://barremx.online/imgBarre/Tapetes-Disponible.jpg' width='80' height='150' />
      </div>

    </dv>

  </div>
  
</body>

</html>";
    return $html;
  }
}
