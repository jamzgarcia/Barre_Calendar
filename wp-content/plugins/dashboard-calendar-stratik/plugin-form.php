<?php

/* 
Plugin Name: Dashboard Calendar
Plugin URI: https://www.stratik.com.co/
Description: Este plugin ayudará a crear una dashboard con un calendario para mostrar los eventos de cada mes.
Version: 1.0
Author: Stratik Publicidad
*/
define('root_file', plugin_dir_path(__file__));
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
require(ABSPATH . "wp-content/plugins/dashboard-calendar-stratik/admin/controller/code128.php");
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classFunction.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classCalendar.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classCoach.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classStudent.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classReserva.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classTapete.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classSede.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classClase.php');
include(ABSPATH . 'wp-content/plugins/dashboard-calendar-stratik/admin/controller/classCalendarioU.php');

function EnablePluginForm()
{
  global $wpdb;

  $sqlstudent = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_student(
      dash_student_id INT(11) NOT NULL AUTO_INCREMENT,
      dash_student_nombre INT(11) NOT NULL,
      dash_student_apellido VARCHAR(20) NULL,
      dash_student_correo VARCHAR(20) NULL,
      dash_student_fecha_nacimiento VARCHAR(20) NULL,
      dash_student_tipo_estudiante VARCHAR(20) NULL, 
      PRIMARY KEY (dash_student_id) 
  );";
  $createstudent = dbDelta($sqlstudent, true);

  $sqlcoach = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_coach(
      dash_coach_id INT(11) NOT NULL AUTO_INCREMENT,
      dash_coach_nombre INT(11) NOT NULL,
      dash_coach_apellido VARCHAR(20) NULL,
      dash_coach_correo VARCHAR(20) NULL,
      dash_coach_fecha_nacimiento VARCHAR(20) NULL,
      PRIMARY KEY (dash_coach_id)
  );";
  $createcoach = dbDelta($sqlcoach, true);

  $sqlsede = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_sede(
      dash_sede_id INT(11) NOT NULL AUTO_INCREMENT,
      dash_sede_nombre INT(11) NOT NULL,
      dash_sede_direccion VARCHAR(20) NULL,
      dash_sede_telefono VARCHAR(20) NULL,
      PRIMARY KEY (dash_sede_id)
  );";
  $createsede = dbDelta($sqlsede, true);

  $sqlClass = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_class( dash_class_id INT(11) NOT NULL AUTO_INCREMENT, 
  dash_student_id INT(11) NOT NULL, 
  dash_coach_id INT(11) NOT NULL, 
  dash_sede_id INT(11) NOT NULL, 
  id_user BIGINT(20) unsigned NOT NULL, 
  dash_class_date DATE NOT NULL, 
  PRIMARY KEY (dash_class_id), 
  FOREIGN KEY (dash_student_id) REFERENCES {$wpdb->prefix}dash_student(dash_student_id) ON DELETE CASCADE, 
  FOREIGN KEY (dash_coach_id) REFERENCES {$wpdb->prefix}dash_coach(dash_coach_id) ON DELETE CASCADE, 
  FOREIGN KEY (dash_sede_id) REFERENCES {$wpdb->prefix}dash_sede(dash_sede_id) ON DELETE CASCADE, 
  FOREIGN KEY (id_user) REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE)";
  $createClass = dbDelta($sqlClass, true);




  $sqlCalendar = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_calendar(
      dash_calendar_id INT(11) NOT NULL AUTO_INCREMENT,
      dash_class_id INT(11) NOT NULL,
      dash_calendar_color_evento VARCHAR(20) NULL,
      dash_calendar_fecha_inicio VARCHAR(20) NULL,
      dash_calendar_fecha_fin VARCHAR(20) NULL,
      PRIMARY KEY (dash_calendar_id),
      FOREIGN KEY (dash_class_id) 
          REFERENCES {$wpdb->prefix}dash_class(dash_class_id) ON DELETE CASCADE
  );";
  $createCalendar = dbDelta($sqlCalendar, true);



  $sqlreserva = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_reserva(
  dash_reserva_id INT(11) NOT NULL AUTO_INCREMENT,
  dash_student_id INT(11) NOT NULL,
  dash_coach_id INT(11) NOT NULL,
  dash_sede_id INT(11) NOT NULL,
  id_user BIGINT(20) unsigned NOT NULL,
  dash_reserva_date DATE NOT NULL,
  PRIMARY KEY (dash_reserva_id),
  FOREIGN KEY (dash_student_id) 
      REFERENCES {$wpdb->prefix}dash_student(dash_student_id) ON DELETE CASCADE,
  FOREIGN KEY (dash_coach_id) 
      REFERENCES {$wpdb->prefix}dash_coach(dash_coach_id) ON DELETE CASCADE,
  FOREIGN KEY (dash_sede_id) 
      REFERENCES {$wpdb->prefix}dash_sede(dash_sede_id) ON DELETE CASCADE,
  FOREIGN KEY (id_user) 
      REFERENCES {$wpdb->prefix}users(ID) ON DELETE CASCADE   
);";
  $createClass = dbDelta($sqlreserva, true);
}

function DisablePluginForm()
{
  global $wpdb;
  $sqlDelete = "DROP TABLE {$wpdb->prefix}dash_class, {$wpdb->prefix}dash_calendar, {$wpdb->prefix}dash_student, {$wpdb->prefix}dash_coach, {$wpdb->prefix}dash_sede, {$wpdb->prefix}dash_reserva;";
  $wpdb->query($sqlDelete);
  flush_rewrite_rules();
}

register_activation_hook(__FILE__, "EnablePluginForm");
register_deactivation_hook(__FILE__, "DisablePluginForm");

add_action("admin_menu", "CreateMenu");
function CreateMenu()
{
  add_menu_page("Dashboard Calendar", "Calendar Home", "manage_options", root_file . "dashboard_admin.php", null, plugin_dir_url(__file__) . "admin/images/iconStratik.png", "4");
}

function bootstrap_css($hook)
{
  wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
  wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
  wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,700;1,400&display=swap");
  wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
  wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
  wp_enqueue_style('checkbox_css', plugins_url('admin/css/checkbox.css', __FILE__));
  wp_enqueue_style('custom_css', plugins_url('admin/css/admin.css', __FILE__));
}
add_action('admin_enqueue_scripts', 'bootstrap_css');

function bootstrap_js($hook)
{
  /* if($hook != "plugin-test.php/admin/lista-encuestas.php"){
        return ;
    } */
  wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.6.0.js", array('jquery'));
  wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
  wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
  wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
  wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.bundle.min.js', __FILE__), array('jquery'));
}
add_action('admin_enqueue_scripts', 'bootstrap_js');

function EncolarJS($hook)
{
  wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
  wp_enqueue_script('JSExterno', plugins_url('admin/js/list-form.js', __FILE__), array('jquery'));
  wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
  wp_localize_script('request_js', 'SolicitudesAjax', [
    'url' => admin_url('admin-ajax.php'),
    'seguridad' => wp_create_nonce('seg')

  ]);
}
add_action('admin_enqueue_scripts', 'EncolarJS');



// shotrcodes 

function viewDashboardAdmin()
{
  $adminData = new DashboardAdmin();
  $html = $adminData->layoutDashboardAdmin();
  return $html;
}

add_shortcode("view_dashboard_admin", "viewDashboardAdmin");

/* ShortCode For Coaches */

function viewCoaches()
{
  $coachData = new Coach();
  $html = $coachData->formCoach();
  return $html;
}

add_shortcode("view_coach_admin", "viewCoaches");

/* ShortCode For Coaches */

function viewCalendario()
{
  $eventoData = new CalendarioU();
  $html = $eventoData->CalendarioU();
  return $html;
}

add_shortcode("view_calendario_admin", "viewCalendario");

/* ShortCode For Estudiantes */
function viewStudents()
{
  $studentData = new Student();
  $html = $studentData->formStudent();
  return $html;
}

add_shortcode("view_student_user", "viewStudents");

/* ShortCode For Reservas */

function viewReservas()
{
  $reservaData = new Reserva();
  $html = $reservaData->formReserva();
  return $html;
}

add_shortcode("view_reserva_user", "viewReservas");

/* ShortCode For Calendar */

function iframeCalendarUsers()
{
  $calendarData = new Calendar();
  $html = $calendarData->iframeCaledar();
  return $html;
}

add_shortcode("iframe_calendar_users", "iframeCalendarUsers");

/* ShortCode For Tapetes */

function viewTapetes()
{
  $tapeteData = new Tapete();
  $html = $tapeteData->formTapete();
  return $html;
}

add_shortcode("view_tapete_user", "viewTapetes");

/* ShortCode For Sedes */

function viewSedes()
{
  $sedeData = new Sede();
  $html = $sedeData->formSede();
  return $html;
}

add_shortcode("view_sede_user", "viewSedes");


/* ShortCode For Clase */

function viewClase()
{
  $claseData = new Clase();
  $html = $claseData->formClase();
  return $html;
}

add_shortcode("view_clase_user", "viewClase");

function insertStudent()
{
  global $wpdb;
  $wpdb->show_errors();
  try {
    if (isset($_POST)) {
      //  print_r($_POST); //debug

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

      $dataStudent = $_POST;
      $tableStudent = "{$wpdb->prefix}dash_student";
      $response = array();
      $names = $dataStudent["dash_student_nombre"];
      $lastName = $dataStudent["dash_student_apellido"];
      $dashStudentCorreo = $dataStudent["dash_student_correo"];
      $dateStudent = $dataStudent["dash_student_fecha_nacimiento"];
      $typeStudent = $dataStudent["dash_student_tipo_estudiante"];
      $dataInsert = array("dash_student_nombre" => $names, "dash_student_apellido" => $lastName, "dash_student_correo" => $dashStudentCorreo, "dash_student_fecha_nacimiento" => $dateStudent, "dash_student_tipo_estudiante" => $typeStudent);
      // var_dump($dataInsert); die;
      $result = $wpdb->insert($tableStudent, $dataInsert);
      if ($result == 1) {
        $response = json_encode(array("code" => 200, "message" => "Estudiante creado Exitosamente", "result" => $result));
      } else {
        $response = json_encode(array("code" => 500, "message" => "Estudiante no pudo ser creado", "result" => $result));
      }
    } else {
      $response = json_encode(array("code" => 400, "message" => "Los datos necesarios están incompletos"));
    }
    echo $response;
  } catch (Exception $e) {
    echo json_encode(array("code" => 500, "error" => $e));
  }
  wp_die();
}

add_action('wp_ajax_insertStudent', 'insertStudent');

/*
Funcion para insertar uno o varios Coach en la base de datos OK
Author: Jimmy Cantor
Email: jamzgarcia16@gmail.com
Full Stack Developer 
www.jamzpcs.com 
*/
function insertCoach()
{
  global $wpdb;
  $wpdb->show_errors();
  try {
    if (isset($_POST)) {
      // print_r($_POST); //debug

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

      $dataCoach = $_POST;
      $tableCoach = "{$wpdb->prefix}dash_coach";
      $response = array();
      $dash_coach_nombre = $dataCoach["dash_coach_nombre"];
      $dash_coach_apellido = $dataCoach["dash_coach_apellido"];
      $dash_coach_correo = $dataCoach["dash_coach_correo"];
      $dash_coach_fecha_nacimiento = $dataCoach["dash_coach_fecha_nacimiento"];
      $dataInsert = array("dash_coach_nombre" => $dash_coach_nombre, "dash_coach_apellido" => $dash_coach_apellido, "dash_coach_correo" => $dash_coach_correo, "dash_coach_fecha_nacimiento" => $dash_coach_fecha_nacimiento);
      // var_dump($dataInsert); die;
      $result = $wpdb->insert($tableCoach, $dataInsert);
      if ($result == 1) {
        $response = json_encode(array("code" => 200, "message" => "coach creado Exitosamente", "result" => $result));
      } else {
        $response = json_encode(array("code" => 500, "message" => "Coach no pudo ser creado", "result" => $result));
      }
    } else {
      $response = json_encode(array("code" => 400, "message" => "Los datos necesarios están incompletos"));
    }
    echo $response;
  } catch (Exception $e) {
    echo json_encode(array("code" => 500, "error" => $e));
  }
  wp_die();
}

add_action('wp_ajax_insertCoach', 'insertCoach');

/*
Funcion para insertar Sedes

*/
function insertSede()
{
  global $wpdb;
  $wpdb->show_errors();
  try {
    if (isset($_POST)) {
      // print_r($_POST); //debug

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

      $dataSede = $_POST;
      $tableSede = "{$wpdb->prefix}dash_sede";
      $response = array();
      $dash_sede_nombre = $dataSede["dash_sede_nombre"];
      $dash_sede_direccion = $dataSede["dash_sede_direccion"];
      $dash_sede_telefono = $dataSede["dash_sede_telefono"];
      $dataInsert = array("dash_sede_nombre" => $dash_sede_nombre, "dash_sede_direccion" => $dash_sede_direccion, "dash_sede_telefono" => $dash_sede_telefono);
      // var_dump($dataInsert); die;
      $result = $wpdb->insert($tableSede, $dataInsert);
      if ($result == 1) {
        $response = json_encode(array("code" => 200, "message" => "sede creada Exitosamente", "result" => $result));
      } else {
        $response = json_encode(array("code" => 500, "message" => "Sede no pudo ser creada", "result" => $result));
      }
    } else {
      $response = json_encode(array("code" => 400, "message" => "Los datos necesarios están incompletos"));
    }
    echo $response;
  } catch (Exception $e) {
    echo json_encode(array("code" => 500, "error" => $e));
  }
  wp_die();
}

add_action('wp_ajax_insertSede', 'insertSede');

/*
Funcion para insertar Clases

*/
function insertClase()
{
  global $wpdb;
  $wpdb->show_errors();
  try {
    if (isset($_POST)) {
      // print_r($_POST); //debug

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

      $dataClase = $_POST;
      $tableClase = "{$wpdb->prefix}dash_class";
      $response = array();
      $dash_student_id = $dataClase["dash_student_id"];
      $dash_coach_id = $dataClase["dash_coach_id"];
      $dash_sede_id = $dataClase["dash_sede_id"];
      $dash_class_date = $dataClase["dash_class_date"];
      $dataInsert = array("dash_student_id" => $dash_student_id, "dash_coach_id" => $dash_coach_id, "dash_sede_id" => $dash_sede_id, "dash_class_date" => $dash_class_date);
      // var_dump($dataInsert); die;
      $result = $wpdb->insert($tableClase, $dataInsert);
      if ($result == 1) {
        $response = json_encode(array("code" => 200, "message" => "clase creada Exitosamente", "result" => $result));
      } else {
        $response = json_encode(array("code" => 500, "message" => "clase no pudo ser creada", "result" => $result));
      }
    } else {
      $response = json_encode(array("code" => 400, "message" => "Los datos necesarios están incompletos"));
    }
    echo $response;
  } catch (Exception $e) {
    echo json_encode(array("code" => 500, "error" => $e));
  }
  wp_die();
}

add_action('wp_ajax_insertClase', 'insertClase');


function add_styles_page()
{
  global $post;
  if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_dashboard_admin')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('datatables_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('adminlte_js', plugins_url('admin/js/adminlte.min.js', __FILE__));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/view_dashboard_admin.js', __FILE__), array('jquery'));
    wp_enqueue_script('chart_page', plugins_url('admin/js/chart.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } //elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_calendario_admin')) {
  //   wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
  //   wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
  //   wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Didact+Gothic");
  //   wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
  //   wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
  //   // style fullCalendar
  //   wp_enqueue_style('fullCalendar_css', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css");
  //   wp_enqueue_style('custom_css', plugins_url('admin/css/view_calendar_users.css', __FILE__));
  //   wp_register_style('select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all');
  //   wp_register_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array('jquery'), '1.0', true);
  //   wp_enqueue_style('select2css');
  //   wp_enqueue_script('select2');
  //   wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
  //   // script fullCalendar
  //   wp_enqueue_script('fullCalendar1_js', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js");
  //   wp_enqueue_script('fullCalendar2_js', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js");
  //   wp_enqueue_script('jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", array('jquery'));
  //   wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
  //   wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
  //   wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
  //   wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
  //   wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
  //   wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
  //   wp_enqueue_script('select', plugins_url('admin/js/mi-script.js', __FILE__), array('jquery'));
  //   //Archivo JS
  //   wp_enqueue_script('fullCalendar_js', plugins_url('admin/js/evento.js', __FILE__), array(), false, true);
  //   wp_localize_script('request_js', 'SolicitudesAjax', [
  //     'url' => admin_url('admin-ajax.php'),
  //     'seguridad' => wp_create_nonce('seg')
  //   ]);}
  elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_calendario_admin')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    // style fullCalendar
    wp_enqueue_style('fullCalendar_css', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    // script fullCalendar
    wp_enqueue_script('fullCalendar1_js', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/main.min.js");
    wp_enqueue_script('fullCalendar2_js', "https://cdn.jsdelivr.net/npm/fullcalendar@5.6.0/locales-all.js");
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    //Archivo JS
    wp_enqueue_script('fullCalendar_js', plugins_url('admin/js/evento.js', __FILE__), array(), false, true);

    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_calendar_users')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Didact+Gothic");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_calendar_users.css', __FILE__));
    wp_register_style('select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all');
    wp_register_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array('jquery'), '1.0', true);
    wp_enqueue_style('select2css');
    wp_enqueue_script('select2');
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('view_calendar_users_js', plugins_url('admin/js/view_calendar_users.js', __FILE__), array('jquery'));
    wp_enqueue_script('select', plugins_url('admin/js/mi-script.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')
    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'iframe_calendar_users')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Didact+Gothic");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/iframe_calendar_users.css', __FILE__));
    wp_register_style('select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all');
    wp_register_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array('jquery'), '1.0', true);
    wp_enqueue_style('select2css');
    wp_enqueue_script('select2');
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('view_calendar_users_js', plugins_url('admin/js/iframe_calendar_users.js', __FILE__), array('jquery'));
    wp_enqueue_script('select', plugins_url('admin/js/mi-script.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')
    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_coach_admin')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    //  Para usar los botones
    wp_enqueue_script('butExcel_js', "https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js");
    wp_enqueue_script('butExcel2_js', "https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js");
    wp_enqueue_script('butExcel3_js', "https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js");
    //  Para los estilos en Excel
    wp_enqueue_script('estExcel_js', "https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.min.js");
    wp_enqueue_script('estExcel2_js', "https://cdn.jsdelivr.net/npm/datatables-buttons-excel-styles@1.1.1/js/buttons.html5.styles.templates.min.js");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('adminlte_js', plugins_url('admin/js/adminlte.min.js', __FILE__));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/coach.js', __FILE__), array('jquery'));
    wp_enqueue_script('chart_page', plugins_url('admin/js/chart.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_student_user')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('adminlte_js', plugins_url('admin/js/adminlte.min.js', __FILE__));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/student.js', __FILE__), array('jquery'));
    wp_enqueue_script('chart_page', plugins_url('admin/js/chart.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_reserva_user')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('adminlte_js', plugins_url('admin/js/adminlte.min.js', __FILE__));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/reserva.js', __FILE__), array('jquery'));
    wp_enqueue_script('chart_page', plugins_url('admin/js/chart.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_tapete_user')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/tapetes.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('tapete_page', plugins_url('admin/js/tapete.js', __FILE__), array(), false, true);
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));


    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_sede_user')) {
    wp_enqueue_style('bootstrap_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Didact+Gothic");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/sede.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_register_style('select2css', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.css', false, '1.0', 'all');
    wp_register_script('select2', '//cdnjs.cloudflare.com/ajax/libs/select2/3.4.8/select2.js', array('jquery'), '1.0', true);
    wp_enqueue_style('select2css');
    wp_enqueue_script('select2');

    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('view_calendar_users_js', plugins_url('admin/js/sede.js', __FILE__), array('jquery'));
    wp_enqueue_script('select', plugins_url('admin/js/mi-script.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')
    ]);
  } elseif (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'view_clase_user')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('adminlte_css', plugins_url('admin/css/font-awesome/css/adminlte.min.css', __FILE__));
    wp_enqueue_style('styles_css', plugins_url('admin/css/style.css', __FILE__));
    wp_enqueue_style('asap_font', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css");
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Muli:300,700&display=swap");
    wp_enqueue_style('icon_font', "https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('cloudflare_css', "https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css");
    wp_enqueue_style('datatables_css', "https://cdn.datatables.net/1.11.3/css/dataTables.bootstrap4.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/view_dashboard_admin.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.4.1.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('codejquery_js', "https://code.jquery.com/jquery-3.5.1.js", array('jquery'));
    wp_enqueue_script('datatables1_js', "https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('datatables2_js', "https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap4.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js", array('jquery'));
    wp_enqueue_script('jquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('popper_js', "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js", array('jquery'));
    wp_enqueue_script('bootstrap_js', "https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js", array('jquery'));
    wp_enqueue_script('chart_js', "https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js", array('jquery'));
    wp_enqueue_script('datatablesjquery_js', "https://code.jquery.com/jquery-3.3.1.slim.min.js", array('jquery'));
    wp_enqueue_script('sweetalert_js', "https://cdn.jsdelivr.net/npm/sweetalert2@10");
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('scriipt_js', plugins_url('admin/js/scripts.js', __FILE__), array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/clase.js', __FILE__), array('jquery'));

    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  }
}
add_action('wp_enqueue_scripts', 'add_styles_page');
