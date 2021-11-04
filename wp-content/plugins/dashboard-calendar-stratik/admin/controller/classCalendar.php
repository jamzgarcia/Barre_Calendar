<?php

/* Clase Principal del Plugin Para el Calendario se carga desde un Iframe.  */

class Calendar
{

    public function iframeCaledar(){
      $html = "<iframe src='https://jamzpcs.com/BarreCalendar/' width='100%' height='720' ></iframe>";
        return $html;

    }

}

