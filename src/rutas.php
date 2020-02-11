<?php

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

class Rutas {
    public function __construct() {
        add_action( 'admin_menu', array($this, 'initMenu'), 9, 0 );
    }

    /* Rutas */
    public function initMenu() {
        /* Talleres */
        add_menu_page( 'Burguer', 'Burguer', 'manage_options', 'burguer-reservas', array($this, 'index'), "dashicons-list-view", 26 );

        /* Single Reserva */
        add_submenu_page( null, 'Ver Reserva', 'Ver Reserva', 'manage_options', 'burguer-reservas-views', array($this, 'verReservaID'));
        add_submenu_page( null, "Delete Reserva", "Delete Reserva", "manage_options", "burguer-reservas-delete", array($this, 'deleteReservaID'));
    }

    /* Taller Funciones*/
    public function index() {
        global $reservas, $functions;

        /* Eliminar */
        if( isset($_POST) ) {
            switch($_POST['action']) {
                case 'delete':
                    $id = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
                    $reservas::deleteReservaID($id);
                break;
            }
        }

        /* Listado de Reservas */
        $listado = $reservas::getReservas();

        /* Contador Total de las reservas */
        $count_reservas = $reservas::getReservasCount();

        /* Mes */
        $mes = $reservas::getMesEspanish();

        /* Contador de reservas mensual */
        $getContadorFechaMes = $reservas::getContadorFechaMes();

        $reservas::getYearActual();

        require_once PLUGIN_BURGUER_PATH . 'src/template/reservas/listadoReserva.php';
        return;
    }

    public function verReservaID() {

        global $reservas;

        $id = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
        $single = $reservas::getReservaID($id);

        require_once PLUGIN_BURGUER_PATH . 'src/template/reservas/single.php';
        return;
    }

    public function deleteReservaID() {
        global $reservas;
        $id = isset( $_REQUEST['id'] ) ? $_REQUEST['id'] : '';
        $reservas::deleteReservaID($id);
        require_once PLUGIN_BURGUER_PATH . 'src/template/reservas/deleteReserva.php';
    }
}