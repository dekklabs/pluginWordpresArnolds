<?php 

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

/* Base */
define('RESOURCE_LINK', (get_site_url() . '/wp-content/plugins/burgerReservas/src/resources/img'));

/* Vista RUTAS */
define("URL_BASE", admin_url( 'admin.php?page=burguer-reservas' ));
define("RESERVA_SINGLE", admin_url( 'admin.php?page=burguer-reservas-views' ));
define("RESERVA_DELETE", admin_url( 'admin.php?page=burguer-reservas-delete' ));

/* MAIL */
define("EMAIL_DEFAULT", "linkinpark_7_9@hotmail.com");

/* FECHA */
define("FECHA_INIT", "2020-01-01");
define("FECHA_END", "2020-12-31");