<?php 

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

class Reservas {
    public static function getReservas() {
        global $wpdb;
        $table = $wpdb->prefix . "anoldsburder_reservas";
        $rows = $wpdb->get_results( "SELECT * FROM $table ORDER BY id DESC");
        $data = array();
        $i = 0;
        foreach( $rows as $key => $item ) {
            $data[$i]["id"]          = $item->id;
            $data[$i]["nombre"]      = $item->nombre;
            $data[$i]["apellido"]    = $item->apellido;
            $data[$i]["nPersonas"]   = $item->nPersonas;
            $data[$i]["hora"]        = $item->hora;
            $data[$i]["fecha"]       = $item->fecha;
            $data[$i]["motivo"]      = $item->motivo;
            $data[$i]["correo"]      = $item->correo;
            $data[$i]["celular"]     = $item->celular;
            $data[$i]["comentario"]  = $item->comentario;
            $i++;
        }
        return $data;
    }
    public static function getReservasCount() {
        global $wpdb;
        $table = $wpdb->prefix . "anoldsburder_reservas";
        $count = $wpdb->get_results( "SELECT COUNT(*) AS total_clientes FROM $table");

        $__data = 0;
        $data   = 0;
        foreach($count as $key => $item) {
            $__data = $item->total_clientes;
        }
        $data = intval($__data);

        return $data;
    }
    public static function getReservaID($id) {
        global $wpdb;
        $table = $wpdb->prefix . "anoldsburder_reservas";
        $rows = $wpdb->get_results( "SELECT * FROM $table WHERE id = $id LIMIT 1");
        $data = array();
        $i = 0;
        foreach( $rows as $key => $item ) {
            $data["id"]          = $item->id;
            $data["nombre"]      = $item->nombre;
            $data["apellido"]    = $item->apellido;
            $data["nPersonas"]   = $item->nPersonas;
            $data["hora"]        = $item->hora;
            $data["fecha"]       = $item->fecha;
            $data["motivo"]      = $item->motivo;
            $data["correo"]      = $item->correo;
            $data["celular"]     = $item->celular;
            $data["comentario"]  = $item->comentario;
        }
        return $data;
    }
    public function deleteReservaID($id) {
        global $wpdb;
        $table = $wpdb->prefix . "anoldsburder_reservas";
        $wpdb->delete($table, array("id" => $id));
    }
    public function getContadorFechaMes() {
        global $wpdb, $functions;

        /* Obtener fecha en español */
        $mes = self::getMesEspanish();
        /* Convertir la fecha a su index */
        $numeroMes = $functions::parseFechaNumber($mes);

        $table = $wpdb->prefix . "anoldsburder_reservas";
        $resultado = $wpdb->get_results( "SElECT COUNT(*) AS total FROM $table WHERE MONTH(created_at) = $numeroMes" );

        $data = "";
        foreach($resultado as $key => $item) {
            $data = $item;
        }

        return $data;
    }
    public function getMesEspanish() {
        $year = date("Y");
        $mes = strtoupper(strftime("%B", mktime($mes)));

        return $mes;
    }
    /* TEST */
    public function getCountByMonth() {
        global $wpdb;

        $arr_data = array();
        
        $table = $wpdb->prefix . "anoldsburder_reservas";
        for( $i = 1; $i< 13; $i++ ) {
            $arr_data[] = $wpdb->get_results( "SElECT COUNT(*) AS total FROM $table WHERE MONTH(created_at) = $i" )[0]->total;
        }

        $data = implode(",", $arr_data);

        $arr_convert = array_map('intval', explode(',', $data));
    }
    public function testMotivo() {
        global $wpdb;

        $motivos_list = ["cumpleaños", "aniversario", "babyshower", "matine", "15", "18", "50"];

        $tmpdata = array();
      
        foreach( $motivos_list as $key => $item ) {
          $tmpdata[] = $wpdb->get_results( "SELECT COUNT(*) as total FROM wp_anoldsburder_reservas WHERE motivo = '". $item ."'" )[0]->total;
        }

        $data = implode(",", $tmpdata);

        $arr_convert = array_map('intval', explode(',', $data));
      
    }
    public function getYearActual() {
        $hoy = getdate();
    }
    /* END TEST */
}

$reservas = new Reservas();