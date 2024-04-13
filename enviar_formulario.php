<?php
// Incluir PHPMailer
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Recoger los datos del formulario
$institucion = $_POST['id_institucion'] ?? 'No especificado';
$nombre = $_POST['nombre'] ?? 'Anónimo';
$email = $_POST['mail'] ?? 'No especificado';
$phone = $_POST['phone'] ?? 'No especificado';
$type_company = $_POST['type_company'] ?? 'No especificado';
$asuntoForm = $_POST['asunto'] ?? 'Sin asunto';
$comentarios = $_POST['comentarios'] ?? 'Sin comentarios';

// Crear instancia de PHPMailer
$mail = new PHPMailer(true);

try {
    //Configuración del servidor SMTP utilizando Gmail
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  
    $mail->SMTPAuth = true;
    $mail->Username = 'cunjamajc@gmail.com'; // Tu dirección de correo de Gmail
    $mail->Password = 'Bsdfds'; // Contraseña de Gmail o contraseña de aplicación
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    //Remitentes y destinatarios
    $mail->setFrom('cunjamajc@gmail.com', 'Formulario de Contacto');
    $mail->addAddress('cunjamajc@gmail.com', 'Nombre del Destinatario'); // Añade tu propio correo como destinatario

    // Contenido del mensaje
    $contenido = "Institución: $institucion\nNombre: $nombre\nCorreo Electrónico: $email\nTeléfono: $phone\nTipo de Compañía: $type_company\nAsunto: $asuntoForm\nComentarios: $comentarios\n";

    $mail->isHTML(true); // Establecer el formato de email a HTML
    $mail->Subject = 'Nuevo formulario de contacto';
    $mail->Body = nl2br($contenido); // Convierte los saltos de línea en etiquetas <br> para el HTML

    $mail->send();
    echo 'El mensaje ha sido enviado';
} catch (Exception $e) {
    echo "El mensaje no pudo ser enviado. Error de PHPMailer: {$mail->ErrorInfo}";
}

// Redirigir de vuelta a la página del formulario
header('Location: formulario.html');
?>
