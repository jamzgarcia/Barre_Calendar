<?php

/* Clase Principal del Plugin Para el Calendario. 
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

*/



/* Clase Principal del Plugin Para el Coaches. */
class Calendar
{
  public function layoutCalendarUsers()
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
                <a href='http://localhost/wordpress/dashboard-admin/' class='d-block text-light p-3 border-0'><i class='icon ion-md-apps lead mr-2'></i>
                    Principal</a>

                <a href='http://localhost/wordpress/dashboard-students/' class='d-block text-light p-3 border-0'><i class='icon ion-md-people lead mr-2'></i>
                    Usuarios</a>

                <a href='http://localhost/wordpress/dashboard-students/' class='d-block text-light p-3 border-0'><i class='icon ion-md-contact lead mr-2'></i>
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
                          <div class='col-lg-9 col-md-8 col-xl-12'>
                            <h2 class='font-weight-bold mb-0'>Calendario BarreMX</h2>
                            
                            <!-- Button trigger modal -->
                            <div class='col-sm-6 col-md-6 col-lg-6 col-xl-12 d-flex justify-content-end'>
                              <button type='button' class='btn btn-primary btn-lg xl-12 d-flex justify-content-end' data-toggle='modal' data-target='#evento'>
                                Launch
                              </button>
                            </div>
                          </div>
                          
                      </div>
                  </div>
              </section>

              <section class='bg-mix py-3'>
              <div class = 'container'>
              
                <div class='table-responsive'>

                  <div class='container'>
                      <div id='calendario' width='100' height='100'>
                          Calendario
                      </div>

                  </div>
                    
                    
                
                </div>
                
                  <!-- Modal -->
                      <div class='modal fade' id='evento' tabindex='-1' role='dialog' aria-labelledby='modelTitleId' aria-hidden='true'>
                        <div class='modal-dialog' role='document'>
                          <div class='modal-content'>
                            <div class='modal-header'>
                              <h5 class='modal-title'>Modal title</h5>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                  <span aria-hidden='true'>&times;</span>
                                </button>
                            </div>
                            <div class='modal-body'>
                              Body
                            </div>
                            <div class='modal-footer'>
                              <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                              <button type='button' class='btn btn-primary'>Save</button>
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
