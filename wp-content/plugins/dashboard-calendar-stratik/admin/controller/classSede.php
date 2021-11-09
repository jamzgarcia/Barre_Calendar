<?php

/* Clase Principal del Plugin Para el Coaches. */
class Sede
{
  public function formSede()
  {

    global $wpdb;
    $wpdb->show_errors();
    $current_user = wp_get_current_user();

    /*
            * @example Safe usage: $current_user = wp_get_current_user();
            * if ( ! ( $current_user instanceof WP_User ) ) {
            *     return;
            * }
            */
    //printf( __( 'Username: %s', 'textdomain' ), esc_html( $current_user->user_login ) ) . '<br />';
    //printf( __( 'User email: %s', 'textdomain' ), esc_html( $current_user->user_email ) ) . '<br />';
    //printf( __( 'User first name: %s', 'textdomain' ), esc_html( $current_user->user_firstname ) ) . '<br />';
    //printf( __( 'User last name: %s', 'textdomain' ), esc_html( $current_user->user_lastname ) ) . '<br />';
    //printf( __( 'User display name: %s', 'textdomain' ), esc_html( $current_user->display_name ) ) . '<br />';
    //printf( __( 'User ID: %s', 'textdomain' ), esc_html( $current_user->ID ) );
    $id_user = $current_user->ID;

    $table_sede = "{$wpdb->prefix}dash_sede";
		$sqlSede = "SELECT dash_sede_nombre, 
                  dash_sede_direccion, 
                  dash_sede_telefono 
            from  {$wpdb->prefix}dash_sede";
		$dataSede = $wpdb->get_results($sqlSede,ARRAY_A);
    $html =
      "<!doctype html>
<html lang='en'>

<head>
    <!-- Required meta tags -->
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>

   

    <title>Dashboard - Templune</title>
</head>

<body>
    <div class='d-flex' id='content-wrapper'>

        <!-- Sidebar -->
        <div id='sidebar-container' class='bg-secondary'>
            <div class='logo'>
            <img src='https://jamzpcs.com/imgBarre/logoBarre.png'  width='70' height='70' class='img-fluid rounded-circle avatar mr-2'>
                <h4 class='text-light font-weight-bold mb-0'>BarreMX</h4>
            </div>
            <div class='menu'>
                <a href='http://localhost/wordpress/dashboard-admin/' class='d-block text-light p-3 border-0'><i class='icon ion-md-apps lead mr-2'></i>
                    Principal</a>

                <a href='http://localhost/wordpress/dashboard-students/' class='d-block text-light p-3 border-0'><i class='icon ion-md-people lead mr-2'></i>
                    Usuarios</a>

                <a href='http://localhost/wordpress/dashboard-coach/' class='d-block text-light p-3 border-0'><i class='icon ion-md-contact lead mr-2'></i>
                    Coaches</a>

                <a href='#' class='d-block text-light p-3 border-0'><i class='icon ion-md-stats lead mr-2'></i>
                    Estadísticas</a>
                <a href='#' class='d-block text-light p-3 border-0'><i class='icon ion-md-calendar lead mr-2'></i>
                    Calendario</a>
                <a href='#' class='d-block text-light p-3 border-0'> <i class='icon ion-md-checkbox lead mr-2'></i>
                    Reservas</a>
            </div>
        </div>
        <!-- Fin sidebar -->

        <div class='w-100'>

         <!-- Navbar -->
         <nav class='navbar navbar-expand-lg navbar-light bg-light border-bottom'>
            <div class='container'>
    
              <button class='navbar-toggler' type='button' data-toggle='collapse' data-target='#navbarSupportedContent'
                aria-controls='navbarSupportedContent' aria-expanded='false' aria-label='Toggle navigation'>
                <span class='navbar-toggler-icon'></span>
              </button>
    
              <div class='collapse navbar-collapse' id='navbarSupportedContent'>
                <form class='form-inline position-relative d-inline-block my-2'>
                  <input class='form-control' type='search' placeholder='Buscar' aria-label='Buscar'>
                  <button class='btn position-absolute btn-search' type='submit'><i class='icon ion-md-search'></i></button>
                </form>
                <ul class='navbar-nav ml-auto mt-2 mt-lg-0'>
                  <li class='nav-item dropdown'>
                    <a class='nav-link text-dark dropdown-toggle' href='#' id='navbarDropdown' role='button'
                      data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      
                    Administrador
                    </a>
                    <div class='dropdown-menu dropdown-menu-right' aria-labelledby='navbarDropdown'>
                      <a class='dropdown-item' href='#'>Mi perfil</a>
                      <a class='dropdown-item' href='#'>Suscripciones</a>
                      <div class='dropdown-divider'></div>
                      <a class='dropdown-item' href='#'>Cerrar sesión</a>
                    </div>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <!-- Fin Navbar -->

        <!-- Page Content -->
        <div id='content' class='bg-grey w-100'>

              <section class='bg-light py-3'>
                  <div class='container'>
                      <div class='row'>
                          <div class='col-lg-9 col-md-8'>
                            <h2 class='font-weight-bold mb-0'>Sedes Barre MX</h2>
                            
                          </div>
                          
                      </div>
                  </div>
              </section>

              <section class='bg-mix py-3'>
              <div class = 'container'>
              ";

    $html .= "<div class='col-sm-6 col-md-6 col-lg-6 col-xl-12 d-flex justify-content-end '><button type='button' class='btn btn-info text-white bg-secondary' data-toggle='modal' data-target='#nuevaSede'>Nuevo Estudiante </button></div>
                <div class='table-responsive'>
                    <table id='sedes' class='table table-striped' style='width:100%'>
                      <thead>
                          <tr>
                              <th>#</th>    
                              <th>Nombre de la Sede</th>
                              <th>Direccion de la Sede</th>
                              <th>Telefono de la sede</th>              
                          </tr>
                      </thead>
                      <tbody>
                      ";
        $var = 1;
        foreach ($dataSede as $key => $value) {

          //id de la sede          
          $html .= "<tr><td>".$var."</td>";         

          // nombre de la sede
          $html .= "<td>".$value['dash_sede_nombre']."</td>";
          
          // direccion de la sede
          $html .= "<td>".$value['dash_sede_direccion']."</td>";

          // telefono de la sede
          $html .= "<td>".$value['dash_sede_telefono']."</td>";          

          $var++;
      }

      $html .= "</table></div></div></div>";

    $html .= "<!-- Modal -->
                  <div class='modal fade' id='nuevaSede' tabindex='-1' aria-labelledby='nuevaSede' aria-hidden='true'>
                    <div class='modal-dialog'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='nuevoSede'>Nueva Sede</h5>
                          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                          </button>
                        </div>
                        <div class='modal-body'>
                          <form id='formSede'>
                            <div class='form-group'>
                              <label for='dash_sede_nombre'>Nombre de la sede</label>
                              <input type='text' class='form-control' id='dash_sede_nombre'>
                              <label for='dash_sede_direccion'>Direccion de la Sede</label>
                              <input type='text' class='form-control' id='dash_sede_direccion'>
                              <label for='dash_sede_telefono'>Telefono de la sede</label>
                              <input type='number' class='form-control' id='dash_sede_telefono'>
                            </div>
                          </form>
                        </div>
                        <div class='modal-footer'>
                          <button type='button' class='btn btn-danger text-light' data-dismiss='modal'>Close</button>
                          <div class='row text-center'><div class='col-lg-12'><button type='button' class='btn btn-lg mr-4 btn btn-warning text-light' id='sendInfoSede'>Enviar</button></div></div>
                        </div>
                      </div>
                    </div>
                  </div>
              </section>

              
                  
              </section>

        </div>

        </div>
    </div> 
</body>

</html>";
    return $html;
  }
}
