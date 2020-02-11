<?php
/*
    Plugin Name: ArnodlsBurguer
    Plugin URI: http://diaeconomico.com/
    Description: Registra reservas para los clientes de Arnolds Burguer
    Version: 1.0
    Author: Jonathan J. R
    Author URI: https://jromero.dev
    License: GPL2
*/

defined('ABSPATH') or die("Bye bye");
define('PLUGIN_BURGUER_PATH', plugin_dir_path(__FILE__));
define('PLUGIN_BURGUER_NAME', "ArnodlsBurguer");
require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

setlocale(LC_TIME, "es_ES", "eso_esp");
setlocale(LC_TIME, 'es_ES.UTF-8');

/* Imports */
if( ! defined('BURGUER_FILE') ) {
    define('BURGUER_FILE', __FILE__);
}

require_once( __DIR__ . '/imports.php');