<?php 

class MailReservas {
    public function sendMail($data) {
        $email_to = $data['correo'];
        $motivo = $data['motivo'];
        
        $descuento = "";

        if( $motivo == 'cumpleaños' ) {
            $descuento = "Se le dará un descuento de 20% por cumplir años";
        }
        
        $email_subject = "Reserva";
        
        $header = array();
        $header[] = 'FROM: ArnoldsBurguer <'. EMAIL_DEFAULT .'>';
        $header[] = 'Content-Type: text/html; charset=utf-8';
        
        $email_body = self::viewMail($data, $descuento);
        $send_mail = wp_mail($email_to, $email_subject, $email_body, $header);
    }

    public static function viewMail($data, $descuento) {
        $html = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title>ArnoldsBuerguer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <link href="https://fonts.googleapis.com/css?family=Oswald&display=swap" rel="stylesheet">
        </head>
        <body style="margin: 0; padding: 0;background: #F1F3F4">
            <table border="0" cellpadding="0" cellspacing="0" width="100%">	
                <tr>
                    <td bgcolor="#22112">
                        <table bgcolor="#000" align="center" border="0" cellpadding="0" cellspacing="0" width="600" style="background-size: cover;" background="' . RESOURCE_LINK .'/portada.jpg">
                            <tr>
                                <td align="left" height="360" style="padding: 90px 0;">
                                    <div width="300" height="230" style="display: block;padding: 0 30px;" align="center" >
                                        <h3 style="font-family: Oswald;color: #FFF;font-size: 60px; margin-bottom: 0">Hola '. $data['nombre'] .'</h3>
                                        <h2 style="font-family: Oswald;color: #FFF;font-size: 25px; margin-top: 0">'. $descuento .'</h2>
                                    </div>
                                </td>
                            </tr>
                            <!-- End Portada -->
                        </table>
                    </td>
                </tr>
            </table>
        </body>
        </html>';
        return $html;
    }
}

$mailData = new MailReservas();