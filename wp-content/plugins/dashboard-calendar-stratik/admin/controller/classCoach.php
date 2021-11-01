<?php

/* Clase Principal del Plugin Para el Coaches. */
class Coach
{
  public function formCoach()
  {
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
                            <h2 class='font-weight-bold mb-0'>Coaches</h2>
                            
                          </div>
                          
                      </div>
                  </div>
              </section>

              <section class='bg-mix py-3'>
                <div class='container'>
                    <table id='example' class='table table-striped' style='width:100%'>
        <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            <tr>
                <td>Ashton Cox</td>
                <td>Junior Technical Author</td>
                <td>San Francisco</td>
                <td>66</td>
                <td>2009/01/12</td>
                <td>$86,000</td>
            </tr>
            <tr>
                <td>Cedric Kelly</td>
                <td>Senior Javascript Developer</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2012/03/29</td>
                <td>$433,060</td>
            </tr>
            <tr>
                <td>Airi Satou</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>33</td>
                <td>2008/11/28</td>
                <td>$162,700</td>
            </tr>
            <tr>
                <td>Brielle Williamson</td>
                <td>Integration Specialist</td>
                <td>New York</td>
                <td>61</td>
                <td>2012/12/02</td>
                <td>$372,000</td>
            </tr>
            <tr>
                <td>Herrod Chandler</td>
                <td>Sales Assistant</td>
                <td>San Francisco</td>
                <td>59</td>
                <td>2012/08/06</td>
                <td>$137,500</td>
            </tr>
            <tr>
                <td>Rhona Davidson</td>
                <td>Integration Specialist</td>
                <td>Tokyo</td>
                <td>55</td>
                <td>2010/10/14</td>
                <td>$327,900</td>
            </tr>
            <tr>
                <td>Colleen Hurst</td>
                <td>Javascript Developer</td>
                <td>San Francisco</td>
                <td>39</td>
                <td>2009/09/15</td>
                <td>$205,500</td>
            </tr>
            <tr>
                <td>Sonya Frost</td>
                <td>Software Engineer</td>
                <td>Edinburgh</td>
                <td>23</td>
                <td>2008/12/13</td>
                <td>$103,600</td>
            </tr>
            <tr>
                <td>Jena Gaines</td>
                <td>Office Manager</td>
                <td>London</td>
                <td>30</td>
                <td>2008/12/19</td>
                <td>$90,560</td>
            </tr>
            <tr>
                <td>Quinn Flynn</td>
                <td>Support Lead</td>
                <td>Edinburgh</td>
                <td>22</td>
                <td>2013/03/03</td>
                <td>$342,000</td>
            </tr>
            <tr>
                <td>Charde Marshall</td>
                <td>Regional Director</td>
                <td>San Francisco</td>
                <td>36</td>
                <td>2008/10/16</td>
                <td>$470,600</td>
            </tr>
            <tr>
                <td>Haley Kennedy</td>
                <td>Senior Marketing Designer</td>
                <td>London</td>
                <td>43</td>
                <td>2012/12/18</td>
                <td>$313,500</td>
            </tr>
            <tr>
                <td>Tatyana Fitzpatrick</td>
                <td>Regional Director</td>
                <td>London</td>
                <td>19</td>
                <td>2010/03/17</td>
                <td>$385,750</td>
            </tr>
            <tr>
                <td>Michael Silva</td>
                <td>Marketing Designer</td>
                <td>London</td>
                <td>66</td>
                <td>2012/11/27</td>
                <td>$198,500</td>
            </tr>
            <tr>
                <td>Paul Byrd</td>
                <td>Chief Financial Officer (CFO)</td>
                <td>New York</td>
                <td>64</td>
                <td>2010/06/09</td>
                <td>$725,000</td>
            </tr>
            <tr>
                <td>Gloria Little</td>
                <td>Systems Administrator</td>
                <td>New York</td>
                <td>59</td>
                <td>2009/04/10</td>
                <td>$237,500</td>
            </tr>
            <tr>
                <td>Bradley Greer</td>
                <td>Software Engineer</td>
                <td>London</td>
                <td>41</td>
                <td>2012/10/13</td>
                <td>$132,000</td>
            </tr>
            <tr>
                <td>Dai Rios</td>
                <td>Personnel Lead</td>
                <td>Edinburgh</td>
                <td>35</td>
                <td>2012/09/26</td>
                <td>$217,500</td>
            </tr>
            <tr>
                <td>Jenette Caldwell</td>
                <td>Development Lead</td>
                <td>New York</td>
                <td>30</td>
                <td>2011/09/03</td>
                <td>$345,000</td>
            </tr>
            <tr>
                <td>Yuri Berry</td>
                <td>Chief Marketing Officer (CMO)</td>
                <td>New York</td>
                <td>40</td>
                <td>2009/06/25</td>
                <td>$675,000</td>
            </tr>
            
            
            
            
            
            
            
            
            
        </tbody>
        
    </table>
                    
                </div>
              </section>

              
                  
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
