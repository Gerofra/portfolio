<?php

if ($_POST['g-recaptcha-response'] == '') {
    echo "Captcha invalido";
} else {
    $obj = new stdClass();
    $obj->secret = "6Le3EPQbAAAAAG_BpSDenURYeRK_gbesR3Vu5x26";
    $obj->response = $_POST['g-recaptcha-response'];
    $obj->remoteip = $_SERVER['REMOTE_ADDR'];
    $url = 'https://www.google.com/recaptcha/api/siteverify';

    $options = array(
        'http' => array(
            'header' => "Content-type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($obj)
        )
    );
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    $validar = json_decode($result);

    /*  FIN DE CAPTCHA   */

    if ($validar->success) {
        $email = trim($_POST['email']);
        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $telefono = trim($_POST['telefono']);
        $comentario = trim($_POST['comentario']);
        $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        $mensaje = '           
            Recibido de: <b>'. $email .'</b><br>
            Nombre: <b>' . $apellido . ', ' . $nombre . '</b><br>
            Mensaje:<br> 
            ' . $comentario . '  
        ';

        //$consulta = "- E-mail: <br>" . $email . "- Nombre: <br>" . $nombre . "- Apellido: <br><br>" . $apellido . "- Comentario: <br>" . $comentario;

        mail("geronimopericoli@gmail.com", "Contacto desde Gerofra Web", $mensaje, $headers);
    } else {
        echo "Captcha invalido";
    }
    return require './index.html';
}
