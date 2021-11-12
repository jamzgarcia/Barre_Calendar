<?php

/* Clase Principal del Plugin Para el Coaches. */
class Coach
{
  public function formCoach()
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

    $table_coach = "{$wpdb->prefix}dash_coahc";
    $sql = "SELECT dash_coach_nombre, dash_coach_apellido, dash_coach_correo,dash_coach_fecha_nacimiento 
            from  {$wpdb->prefix}dash_coach ";
    $dataCoach = $wpdb->get_results($sql, ARRAY_A);

    $html = "<!doctype html>
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
                      <a href='#' class='d-block text-light p-3 border-0'><i class='icon ion-md-apps lead mr-2'></i>
                          Tablero</a>

                      <a href='#' class='d-block text-light p-3 border-0'><i class='icon ion-md-people lead mr-2'></i>
                          Usuarios</a>

                      <a href='#' class='d-block text-light p-3 border-0'><i class='icon ion-md-contact lead mr-2'></i>
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
                                  <h2 class='font-weight-bold mb-0'>Coaches</h2>
                                  
                                </div>
                                
                            </div>
                        </div>
                    </section>

                    <section class='bg-mix py-3'>
                    <div class = 'container'>
                    <div class='col-sm-6 col-md-6 col-lg-6 col-xl-12 d-flex justify-content-end'><button type='button' class='btn btn-info text-white bg-secondary' data-toggle='modal' data-target='#nuevoCoach'>Nuevo Coach </button></div>
                      ";
    $html .= "<div class='table-responsive'>
                          <table id='coaches' id='excel'class='table table-striped' style='width:100%'>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Correo</th>
                                    <th>Fecha Nacimiento</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>";
    $var = 1;
    foreach ($dataCoach as $key => $value) {
      $html .= "<tr><td>" . $var . "</td>";

      // Nombre coach

      $html .= "<td>" . $value['dash_coach_nombre'] . "</td>";

      // Apellido coach               
      $html .= "<td>" . $value['dash_coach_apellido'] . "</td>";

      // correo electronico coach
      $html .= "<td>" . $value['dash_coach_correo'] . "</td>";

      // fecha de nacimiento coach
      $html .= "<td>" . $value['dash_coach_fecha_nacimiento'] . "</td>";

      $html .= "<td>'<button type='button' class='btn btn-info'>Editar</button><br><button type='button' class='btn btn-danger'>Eliminar</button>'</td>";

      $html .= "</tr>";

      $var++;
    }

    $html .= "</table></div></div></div>";

    $html .= "<!-- Modal -->
                        <div class='modal fade' id='nuevoCoach' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
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
                    </section>

                    
                        
                    </section>

              </div>

              </div>
          </div> 
      </body>

      </html>

    ";
    $html .= "</tbody></table></div></div>";
    $html .= "";

    return $html;
  }
}
