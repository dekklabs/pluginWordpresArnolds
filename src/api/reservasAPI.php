<?php

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

add_action( 'rest_api_init', 'burguer_rest_api_init', 10, 0 );

function burguer_rest_api_init() {
  $namespace = "burguer/v1";
  /* Route General */
  register_rest_route( $namespace,
      '/burguer-forms',
      array(
          array(
              'methods' => WP_REST_Server::CREATABLE,
              'callback' => 'create_feedback',
          ),
      )
  );
  register_rest_route( $namespace,
      '/cantidad-mes',
      array(
          array(
              'methods' => WP_REST_Server::READABLE,
              'callback' => 'getCountByMes',
          )
      )
  );
  register_rest_route( $namespace,
      '/cantidad-motivo',
      array(
          array(
              'methods' => WP_REST_Server::READABLE,
              'callback' => 'getMotivoCount',
          )
      )
  );
}

function create_feedback(WP_REST_Request $request) {
  global $wpdb, $mailData;

  $response = array(
    "nombre"      => isset($request['nombre'])      ? $request['nombre']     : 'sin data',
    "apellido"    => isset($request['apellido'])    ? $request['apellido']   : 'sin data',
    "nPersonas"   => isset($request['nPersonas'])   ? $request['nPersonas']  : 'sin data',
    "hora"        => isset($request['hora'])        ? $request['hora']       : 'sin data',
    "fecha"       => isset($request['fecha'])       ? $request['fecha']      : 'sin data',
    "correo"      => isset($request['correo'])      ? $request['correo']     : 'sin data',
    "motivo"      => isset($request['motivo'])      ? $request['motivo']     : 'sin data',
    "celular"     => isset($request['celular'])     ? $request['celular']    : 'sin data',
    "comentario"  => isset($request['comentario'])  ? $request['comentario'] : 'sin data'
  );

  $table = $wpdb->prefix . "anoldsburder_reservas";
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
  header("Content-Type: application/json");

  $var = $wpdb->insert($table, $response, $format = null);

  /* Enviar Correo */
  $mailData::sendMail($response);
  /* ---- */

  $res = "Se envio correctamente";
  return rest_ensure_response($res);
}

function getCountByMes(WP_REST_Request $request) {
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
  header("Content-Type: application/json");

  global $wpdb;


  $arr_data = array();
  
  $table = $wpdb->prefix . "anoldsburder_reservas";
  for( $i = 1; $i< 13; $i++ ) {
      $arr_data[] = $wpdb->get_results( "SElECT COUNT(*) AS total FROM $table WHERE MONTH(created_at) = $i" )[0]->total;
  }

  $data = implode(", ", $arr_data);

  // $data2 = str_replace(",", " ", $data);

  $arr_convert = array_map('intval', explode(',', $data));

  return rest_ensure_response($arr_convert);
}

function getMotivoCount() {
  global $wpdb;
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: Authorization, Origin, X-Requested-With, Content-Type, Accept");
  header("Content-Type: application/json");

  $motivos_list = ["cumpleaños", "aniversario", "babyshower", "matine", "15", "18", "50"];

  $tmpdata = array();

  foreach( $motivos_list as $key => $item ) {
    $tmpdata[] = $wpdb->get_results( "SELECT COUNT(*) as total FROM wp_anoldsburder_reservas WHERE motivo = '". $item ."'" )[0]->total;
  }

  $data = implode(",", $tmpdata);

  $arr_convert = array_map('intval', explode(',', $data));

  return rest_ensure_response($arr_convert);
}