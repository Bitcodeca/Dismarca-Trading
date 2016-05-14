<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once '/home1/bitcodeweb/public_html/wp-content/themes/metroacero/phpmailer/PHPMailerAutoload.php';

if (isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['empresa']) && isset($_POST['message'])) {

    //check if any of the inputs are empty
    if (empty($_POST['nombre']) || empty($_POST['email']) || empty($_POST['empresa']) || empty($_POST['message'])) {
        $data = array('success' => false, 'message' => 'Please fill out the form completely.');
        echo json_encode($data);
        exit;
    }
    $motivo=$_POST['motivo'];
    $mail = new PHPMailer();
    $mail->CharSet = 'UTF-8';
    $mail->From = $_POST['email'];
    $mail->FromName = $_POST['nombre'];
    if ($motivo=='compras'){
        $mail->AddAddress('compras@metroacero.com');
        $mail->Subject = $_POST['empresa'];
        $mail->Body = "Nombre: " . $_POST['nombre'] . "\r\n\r\nEmail: " . $_POST['email'] . "\r\n\r\nTeléfono: " . $_POST['telefono'] . "\r\n\r\nEmpresa: " . $_POST['empresa'] . "\r\n\r\nMotivo: " . $motivo . "\r\n\r\nMensaje: " . stripslashes($_POST['message']);
    }
    else if ($motivo=='ventas'){
        $mail->AddAddress('ventas@metroacero.com');
        $mail->Subject = $_POST['empresa'];
        $mail->Body = "Nombre: " . $_POST['nombre'] . "\r\n\r\nEmail: " . $_POST['email'] . "\r\n\r\nTeléfono: " . $_POST['telefono'] . "\r\n\r\nEmpresa: " . $_POST['empresa'] . "\r\n\r\nMotivo: " . $motivo . "\r\n\r\nMensaje: " . stripslashes($_POST['message']);
    }
    else if ($motivo=='rrhh'){
        $mail->AddAddress('rrhh@metroacero.com');
        $mail->Subject = $_POST['empresa'];
        $mail->Body = "Nombre: " . $_POST['nombre'] . "\r\n\r\nEmail: " . $_POST['email'] . "\r\n\r\nTeléfono: " . $_POST['telefono'] . "\r\n\r\nEmpresa: " . $_POST['empresa'] . "\r\n\r\nMotivo: " . $motivo . "\r\n\r\nMensaje: " . stripslashes($_POST['message']);
    } 

    if(!$mail->send()) {
        $data = array('success' => false, 'message' => 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo);
        echo json_encode($data);
        exit;
    }

    $data = array('success' => true, 'message' => 'enviado');
    echo json_encode($data);

} else {
    $data = array('success' => false, 'message' => 'Por favor, termine de llenar el formulario.');
    echo json_encode($data);
}