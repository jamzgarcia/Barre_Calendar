<?php

/* Clase Principal del Plugin Para generar las vistas necesarias. */
class adminQuestions
{



 public function layoutDashboardAdmin()
  {
    global $wpdb;
    $html = "<!DOCTYPE html>
              <html lang='es'>
              <body class='sb-nav-fixed'>
                <nav class='sb-topnav navbar navbar-expand navbar-dark bg-secondary'>
                  <a class='navbar-brand' href='#'>BARRE MX</a><button class='btn btn-link btn-sm order-1 order-lg-0' id='sidebarToggle' href='#'><i class='fas fa-bars'></i></button><!-- Navbar Search-->
                  <!-- Navbar-->
                  <ul class='navbar-nav ml-auto mr-0 mr-md-3 my-2 my-md-0'>
                    <li class='nav-item dropdown'>
                      <a class='nav-link dropdown-toggle' id='userDropdown' href='#' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                      Name User Online<i class='fas fa-user fa-fw'></i>
                      </a>
                      <div class='dropdown-menu dropdown-menu-right' aria-labelledby='userDropdown'>
                        <a class='dropdown-item' href='#'>Configuración</a>
                        <div class='dropdown-divider'></div>
                        <a class='dropdown-item' href='#'>Salir</a>
                      </div>
                    </li>
                  </ul>
                </nav>

                <div id='layoutSidenav_content'>
                <main>
                  <div class='container-fluid'>
                    <h1 class='mt-4'>BARRE MX</h1>
                    <ol class='breadcrumb mb-4'>
                      <li class='breadcrumb-item active'>Dashboard</li>
                    </ol>
                    <div class='container-fluid'>

                      <!-- Page Heading -->
                      <div class='d-sm-flex align-items-center justify-content-between mb-4'>
                        <h1 class='h3 mb-0 text-gray-800'></h1>
                      </div>

                      <div class='row'>

                        <!-- Earnings (Monthly) Card Example -->

                        <!-- Earnings (Annual) Card Example -->
                        <div class='col-xl-3 col-md-6 mb-4'>
                          <div class='card border-left-success shadow h-100 py-2'>
                            <div class='card-body'>
                              <div class='row no-gutters align-items-center'>
                                <div class='col mr-2'>
                                  <div class='text-xs font-weight-bold text-secondary text-uppercase mb-1'>
                                    ventas (Mes)</div>
                                  <div class='h5 mb-0 font-weight-bold text-gray-800'>$215,000</div>
                                </div>
                                <div class='col-auto'>
                                  <i class='fas fa-dollar-sign fa-2x text-gray-300'></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!-- Tasks Card Example -->


                        <!-- Pending Requests Card Example -->
                        <div class='col-xl-3 col-md-6 mb-4'>
                          <div class='card border-left-warning shadow h-100 py-2'>
                            <div class='card-body'>
                              <div class='row no-gutters align-items-center'>
                                <div class='col mr-2'>
                                  <div class='text-xs font-weight-bold text-secondary text-uppercase mb-1'>
                                    Reservas (Mes)</div>
                                  <div class='h5 mb-0 font-weight-bold text-gray-800'>343</div>
                                </div>
                                <div class='col-auto'>
                                  <i class='fas fa-clipboard-list fa-2x text-gray-300'></i>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class='row'>
                      </div>
                    </div>
                  </div>
              </div> -->

                <div id='layoutSidenav_nav'>
                  <nav class='sb-sidenav accordion bg-light' id='sidenavAccordion'>
                    <div class='sb-sidenav-menu'>
                      <div class='nav'>
                        <div class='sb-sidenav-menu-heading'><img src='Logotipo-BarreMx.png' alt='Barre MX Logo' class='brand-image img-circle elevation-3' width='80' height='80'>
                          <a class='nav-link text-secondary' href='#'>
                            <div class='sb-nav-link-icon'><i class='fas fa-pager'></i></div>
                            Pagina Principal
                          </a>

                          <div class='sb-sidenav-menu-heading '>Panel de control</div>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-thumbtack'></i></div>
                            Ubicaciones
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-store-alt'></i></div>
                            Tienda
                          </a>

                          <a class='nav-link text-secondary' href='coach.php'>
                            <div class='sb-nav-link-icon '><i class='fas fa-users'></i></div>
                            Instructores
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-concierge-bell'></i></div>
                            Servicios
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-dollar-sign'></i></div>
                            Creditos
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-book-open'></i></div>
                            Catalogos
                          </a>

                          <a class='nav-link text-secondary' href='membresias.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-chart-bar'></i></div>
                            Business inteligence
                          </a>

                          <a class='nav-link text-secondary' href='membresias.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-chart-line'></i></div>
                            Metricas
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-calendar-alt'></i></div>
                            Calendario
                          </a>

                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-cog'></i></div>
                            Ajustes
                          </a>
                          <a class='nav-link text-secondary' href='calendario.php'>
                            <div class='sb-nav-link-icon'><i class='fas fa-envelope'></i></div>
                            Ajustes de correo
                          </a>

                        </div>
                      </div>
                      <div class='sb-sidenav-footer'>
                        <div class='small'></div>
                      </div>
                    </div>
                  </nav>
                </div>

               
              </div>
              </main>
              <footer class='py-4 bg-light mt-auto'>
                <div class='container-fluid'>
                  <div class='d-flex align-items-center justify-content-between small'>
                    <div class='text-muted'>Copyright &copy; Barre MX 2021</div>
                    <div>
                      <a href='#'>Privacy Policy</a>
                      &middot;
                      <a href='#'>Terminos &amp; Condiciones</a>
                    </div>
                  </div>
                </div>
              </footer>
              </div>
            </div>
  </body>
</html>
              
              ";
    return $html;
    
  } 
  
}
