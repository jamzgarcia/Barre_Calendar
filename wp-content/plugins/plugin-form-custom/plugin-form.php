<?php

/* 
Plugin Name: Dashboard Calendar
Plugin URI: https://www.stratik.com.co/
Description: Este plugin ayudará a crear una dashboard con un calendario para mostrar los eventos de cada mes.
Version: 1.0
Author: Stratik Publicidad
*/
define('root_file',plugin_dir_path(__file__));
require_once (ABSPATH . 'wp-admin/includes/upgrade.php'); 
require (ABSPATH . "wp-content/plugins/plugin-form-custom/admin/controller/code128.php");
include (ABSPATH . 'wp-content/plugins/plugin-form-custom/admin/controller/classFunction.php'); 

function EnablePluginForm(){
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
    $createstudent = dbDelta($sqlstudent,true);
    
    $sqlcoach = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_coach(
        dash_coach_id INT(11) NOT NULL AUTO_INCREMENT,
        dash_coach_nombre INT(11) NOT NULL,
        dash_coach_apellido VARCHAR(20) NULL,
        dash_coach_correo VARCHAR(20) NULL,
        dash_coach_fecha_nacimiento VARCHAR(20) NULL,
        PRIMARY KEY (dash_coach_id)
    );";
    $createcoach = dbDelta($sqlcoach,true);
    
    $sqlsede = "CREATE TABLE IF NOT EXISTS {$wpdb->prefix}dash_sede(
        dash_sede_id INT(11) NOT NULL AUTO_INCREMENT,
        dash_sede_nombre INT(11) NOT NULL,
        dash_sede_direccion VARCHAR(20) NULL,
        dash_sede_telefono VARCHAR(20) NULL,
        PRIMARY KEY (dash_sede_id)
    );";
    $createsede = dbDelta($sqlsede,true);

    $sqlClass = "CREATE TABLE IF NOT EXISTS wp_dash_class( dash_class_id INT(11) NOT NULL AUTO_INCREMENT, 
    dash_student_id INT(11) NOT NULL, 
    dash_coach_id INT(11) NOT NULL, 
    dash_sede_id INT(11) NOT NULL, 
    id_user BIGINT(20) unsigned NOT NULL, 
    dash_class_date DATE NOT NULL, 
    PRIMARY KEY (dash_class_id), 
    FOREIGN KEY (dash_student_id) REFERENCES wp_dash_student(dash_student_id) ON DELETE CASCADE, 
    FOREIGN KEY (dash_coach_id) REFERENCES wp_dash_coach(dash_coach_id) ON DELETE CASCADE, 
    FOREIGN KEY (dash_sede_id) REFERENCES wp_dash_sede(dash_sede_id) ON DELETE CASCADE, 
    FOREIGN KEY (id_user) REFERENCES wp_users(ID) ON DELETE CASCADE)";
$createClass = dbDelta($sqlClass,true);




    $sqlCalendar = "CREATE TABLE IF NOT EXISTS wp_dash_calendar(
        dash_calendar_id INT(11) NOT NULL AUTO_INCREMENT,
        dash_class_id INT(11) NOT NULL,
        dash_calendar_color_evento VARCHAR(20) NULL,
        dash_calendar_fecha_inicio VARCHAR(20) NULL,
        dash_calendar_fecha_fin VARCHAR(20) NULL,
        PRIMARY KEY (dash_calendar_id),
        FOREIGN KEY (dash_class_id) 
            REFERENCES wp_dash_class(dash_class_id) ON DELETE CASCADE
    );";
$createCalendar = dbDelta($sqlCalendar,true);



$sqlreserva = "CREATE TABLE IF NOT EXISTS wp_dash_reserva(
    dash_reserva_id INT(11) NOT NULL AUTO_INCREMENT,
    dash_student_id INT(11) NOT NULL,
    dash_coach_id INT(11) NOT NULL,
    dash_sede_id INT(11) NOT NULL,
    id_user BIGINT(20) unsigned NOT NULL,
    dash_reserva_date DATE NOT NULL,
    PRIMARY KEY (dash_reserva_id),
    FOREIGN KEY (dash_student_id) 
        REFERENCES wp_dash_student(dash_student_id) ON DELETE CASCADE,
    FOREIGN KEY (dash_coach_id) 
        REFERENCES wp_dash_coach(dash_coach_id) ON DELETE CASCADE,
    FOREIGN KEY (dash_sede_id) 
        REFERENCES wp_dash_sede(dash_sede_id) ON DELETE CASCADE,
    FOREIGN KEY (id_user) 
        REFERENCES wp_users(ID) ON DELETE CASCADE   
);";
$createClass = dbDelta($sqlreserva,true);






   
    
}

function DisablePluginForm(){
    global $wpdb;
    $sqlDelete = "DROP TABLE {$wpdb->prefix}dash_class, {$wpdb->prefix}dash_calendar, {$wpdb->prefix}dash_student, {$wpdb->prefix}dash_coach, {$wpdb->prefix}dash_sede, {$wpdb->prefix}dash_reserva;";
    $wpdb->query($sqlDelete);
    flush_rewrite_rules();
}

register_activation_hook(__FILE__,"EnablePluginForm");
register_deactivation_hook(__FILE__,"DisablePluginForm");

add_action( "admin_menu", "CreateMenu" );
function CreateMenu() {
    add_menu_page( "Dashboard Calendar", "Calendar Home", "manage_options", root_file."dashboard_admin.php", null, plugin_dir_url(__file__)."admin/images/icon.png" , "4");
}

function bootstrap_css($hook){
    wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
    wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
    wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css2?family=Asap:ital,wght@0,400;0,500;0,700;1,400&display=swap");
    wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('checkbox_css',plugins_url('admin/css/checkbox.css',__FILE__));
    wp_enqueue_style('custom_css',plugins_url('admin/css/admin.css',__FILE__));
}
add_action('admin_enqueue_scripts','bootstrap_css');

function bootstrap_js($hook){
    /* if($hook != "plugin-test.php/admin/lista-encuestas.php"){
        return ;
    } */
    wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
    wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
    wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
}
add_action('admin_enqueue_scripts','bootstrap_js');

function EncolarJS($hook){
    wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
    wp_enqueue_script('JSExterno',plugins_url('admin/js/list-form.js',__FILE__),array('jquery'));
    wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
        'url' => admin_url('admin-ajax.php'),
        'seguridad' => wp_create_nonce('seg')

    ]);
}
add_action('admin_enqueue_scripts','EncolarJS');

function add_styles_page(){
    global $post;
    if( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'print_questions') ) {
        wp_enqueue_style('bootstrap_css',plugins_url('admin/css/bootstrap/css/bootstrap.min.css',__FILE__));
        wp_enqueue_style('font_awesome_css',plugins_url('admin/css/font-awesome/css/font-awesome.min.css',__FILE__));
        wp_enqueue_style('asap_font',"https://fonts.googleapis.com/css?family=Didact+Gothic");
        wp_enqueue_style('animated_css',"https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
        wp_enqueue_style('toaster_css',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
        wp_enqueue_style('custom_css',plugins_url('admin/css/admin_page.css',__FILE__));
        wp_enqueue_script('jquery_js',"https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js",array('jquery'));
        wp_enqueue_script('pdfobject_js',"https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js",array('jquery'));
        wp_enqueue_script('popper_js',plugins_url('admin/css/popper/popper.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('bootstrap_js',plugins_url('admin/css/bootstrap/js/bootstrap.min.js',__FILE__),array('jquery'));
        wp_enqueue_script('toaster_js',"//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js",array('jquery'));
        wp_enqueue_script('validators_js',plugins_url('admin/js/validators.js',__FILE__),array('jquery'));
        wp_enqueue_script('request_js',plugins_url('admin/js/request.js',__FILE__),array('jquery'));
        wp_enqueue_script('admin_page',plugins_url('admin/js/admin-page.js',__FILE__),array('jquery'));
        wp_localize_script('request_js', 'SolicitudesAjax', [
            'url' => admin_url('admin-ajax.php'),
            'seguridad' => wp_create_nonce('seg')

        ]);
    }
}
add_action( 'wp_enqueue_scripts', 'add_styles_page' );
?>