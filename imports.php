<?php
/* DEFINES */
require_once __DIR__ . '/src/config/defines.php';

/* Database */
require_once __DIR__ . '/src/db/database.php';

/* Funciones Alternativas */
require_once __DIR__ . '/src/class/functions.php';

/* INC */
require_once __DIR__ . '/src/inc/reservas.php';
require_once __DIR__ . '/src/inc/reportes.inc.php';

/* Control |rutas y funciones */
require_once __DIR__ . '/src/rutas.php';
require_once __DIR__ . '/src/resources.php';


/* API */
require_once __DIR__ . '/src/api/reservasAPI.php';

/* MAIL */
require_once __DIR__ . '/src/mail/reservas.mail.php';


$rutas       = new Rutas();
$recursos    = new Resources();
$db          = new Database();