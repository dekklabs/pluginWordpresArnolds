<?php

defined( 'ABSPATH' ) or die( 'Direct access is not permitted' );

class Database {
    public function __construct() {
        register_activation_hook(__FILE__, $this->db_table_reservas());
    }

    public function db_table_reservas() {
        global $wpdb;

        $reservas_db = $wpdb->prefix . "anoldsburder_reservas";
        $created = dbDelta(
            "CREATE TABLE IF NOT EXISTS $reservas_db(
                    id              INT(20)         PRIMARY KEY NOT NULL AUTO_INCREMENT,
                    nombre          VARCHAR(255)    NOT NULL,
                    apellido        VARCHAR(255)    NOT NULL,
                    nPersonas       VARCHAR(255)    NOT NULL,
                    hora            TIME            NOT NULL,
                    fecha           DATE            NOT NULL,
                    motivo          VARCHAR(255)    NOT NULL,
                    correo          VARCHAR(255)    NOT NULL,
                    celular         varchar(12)     NOT NULL,
                    comentario      TEXT            NOT NULL,
                    created_at      TIMESTAMP       NOT NULL DEFAULT NOW(),
              		updated_at      TIMESTAMP       NOT NULL DEFAULT NOW() ON UPDATE now()
            ) CHARACTER SET utf8 COLLATE utf8_general_ci;"
        );
    }
}
