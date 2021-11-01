<?php

/* Clase Principal del Plugin Para generar las vistas necesarias. */
class DashboardAdmin
{
  public function layoutDashboardAdmin()
  {
    global $wpdb;
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
            <img src='admin/images/logoBarre.png' class='img-fluid rounded-circle avatar mr-2'>
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
                            <h1 class='font-weight-bold mb-0'>Bienvenido</h1>
                            <p class='lead text-muted'>Revisa la última información</p>
                          </div>
                          
                      </div>
                  </div>
              </section>

              <section class='bg-mix py-3'>
                <div class='container'>
                    <div class='card rounded-0'>
                        <div class='card-body'>
                            <div class='row'>
                                <div class='col-lg-3 col-md-6 d-flex stat my-3'>
                                    <div class='mx-auto'>
                                        <h6 class='text-muted'>Ingresos mensuales</h6>
                                        <h3 class='font-weight-bold'>$50000</h3>
                                        
                                    </div>
                                </div>
                                <div class='col-lg-3 col-md-6 d-flex stat my-3'>
                                    <div class='mx-auto'>
                                        <h6 class='text-muted'>Reservas</h6>
                                        <h3 class='font-weight-bold'>36</h3>
                                        
                                    </div>
                                </div>
                                <div class='col-lg-3 col-md-6 d-flex stat my-3'>
                                    <div class='mx-auto'>
                                        <h6 class='text-muted'>No. de usuarios</h6>
                                        <h3 class='font-weight-bold'>2500</h3>
                                        
                                    </div>
                                </div>
                                <div class='col-lg-3 col-md-6 d-flex my-3'>
                                    <div class='mx-auto'>
                                        <h6 class='text-muted'>Usuarios nuevos</h6>
                                        <h3 class='font-weight-bold'>500</h3>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
              </section>

              <section>
                  <div class='container'>
                      <div class='row'>
                          <div class='col-lg-8 my-3'>
                              <div class='card rounded-0'>
                                  <div class='card-header bg-light'>
                                    <h6 class='font-weight-bold mb-0'>Número de usuarios de paga</h6>
                                  </div>
                                  <div class='card-body'>
                                    <canvas id='myChart2' width='300' height='150'></canvas>
                                  </div>
                              </div>
                          </div>
                          <div class='col-lg-4 my-3'>
                            <div class='card rounded-0'>
                                <div class='card-header bg-light'>
                                    <h6 class='font-weight-bold mb-0'>Estudios BarreMx</h6>
                                </div>
                                <div class='card-body pt-2'>
                                    <div class='d-flex border-bottom py-2'>
                                        <div class='d-flex mr-3'>
                                          <h2 class='align-self-center mb-0'><i class='icon ion-md-fitness'></i></h2>
                                        </div>
                                        <div class='align-self-center'>
                                          <h6 class='d-inline-block mb-0'>Estudio</h6><span class='badge badge-warning ml-1'>Interlomas</span>
                                          <small class='d-block text-muted'>BarreMx</small>
                                        </div>
                                    </div>
                                    <button class='btn btn-primary w-100'>Ver mas...</button>
                                    
                                    <div class='d-flex border-bottom py-2'>
                                        <div class='d-flex mr-3'>
                                          <h2 class='align-self-center mb-0'><i class='icon ion-md-fitness'></i></h2>
                                        </div>
                                        
                                        <div class='align-self-center'>
                                          <h6 class='d-inline-block mb-0'>Estudio</h6><span class='badge badge-warning ml-1'>Supra-Roma</span>
                                          <small class='d-block text-muted'>BarreMx</small>
                                        </div>
                                    </div>
                                    <button class='btn btn-primary w-100'>Ver mas...</button>
                                    <div class='d-flex border-bottom py-2'>
                                        <div class='d-flex mr-3'>
                                          <h2 class='align-self-center mb-0'><i class='icon ion-md-fitness'></i></h2>
                                        </div>
                                        <div class='align-self-center'>
                                          <h6 class='d-inline-block mb-0'>Estudio</h6><span class='badge badge-warning ml-1'>Esmeralda</span>
                                          <small class='d-block text-muted'>BarreMX</small>
                                        </div>
                                    </div>
                                    <button class='btn btn-primary w-100'>Ver mas...</button>
                                </div>
                            </div>
                          </div>
                      </div>
                  </div>
              </section>

        </div>

        </div>
    </div>

    
    
        
</body>

</html>
              
              ";
    return $html;
  }
}
