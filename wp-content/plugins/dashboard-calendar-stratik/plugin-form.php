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

function EnablePluginForm()
{
  global $wpdb;
}

function DisablePluginForm()
{
  global $wpdb;

  //  $sqlDelete = "";
  $sqlDelete = "DROP TABLE {$wpdb->prefix}questions_forms, {$wpdb->prefix}list_forms, {$wpdb->prefix}list_company, {$wpdb->prefix}list_inspectors, {$wpdb->prefix}list_users, {$wpdb->prefix}list_answers, {$wpdb->prefix}options_questions, {$wpdb->prefix}list_questions, {$wpdb->prefix}type_questions;";
  $wpdb->query($sqlDelete);
  flush_rewrite_rules();
}

register_activation_hook(__FILE__, "EnablePluginForm");
register_deactivation_hook(__FILE__, "DisablePluginForm");

add_action("admin_menu", "CreateMenu");
function CreateMenu()
{
  add_menu_page("Dashboard Calendar", "Calendar Home", "manage_options", root_file . "dashboard_admin.php", null, plugin_dir_url(__file__) . "admin/images/icon.png", "4");
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
  wp_enqueue_script('jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", array('jquery'));
  wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
  wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
  wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
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

function add_styles_page()
{
  global $post;
  if (is_a($post, 'WP_Post') && has_shortcode($post->post_content, 'print_questions')) {
    wp_enqueue_style('bootstrap_css', plugins_url('admin/css/bootstrap/css/bootstrap.min.css', __FILE__));
    wp_enqueue_style('font_awesome_css', plugins_url('admin/css/font-awesome/css/font-awesome.min.css', __FILE__));
    wp_enqueue_style('asap_font', "https://fonts.googleapis.com/css?family=Didact+Gothic");
    wp_enqueue_style('animated_css', "https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css");
    wp_enqueue_style('toaster_css', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css");
    wp_enqueue_style('custom_css', plugins_url('admin/css/admin_page.css', __FILE__));
    wp_enqueue_script('jquery_js', "https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js", array('jquery'));
    wp_enqueue_script('pdfobject_js', "https://cdnjs.cloudflare.com/ajax/libs/pdfobject/2.1.1/pdfobject.min.js", array('jquery'));
    wp_enqueue_script('popper_js', plugins_url('admin/css/popper/popper.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('bootstrap_js', plugins_url('admin/css/bootstrap/js/bootstrap.min.js', __FILE__), array('jquery'));
    wp_enqueue_script('toaster_js', "//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js", array('jquery'));
    wp_enqueue_script('validators_js', plugins_url('admin/js/validators.js', __FILE__), array('jquery'));
    wp_enqueue_script('request_js', plugins_url('admin/js/request.js', __FILE__), array('jquery'));
    wp_enqueue_script('admin_page', plugins_url('admin/js/admin-page.js', __FILE__), array('jquery'));
    wp_localize_script('request_js', 'SolicitudesAjax', [
      'url' => admin_url('admin-ajax.php'),
      'seguridad' => wp_create_nonce('seg')

    ]);
  }
}
add_action('wp_enqueue_scripts', 'add_styles_page');
