<?php
error_reporting(E_ALL); // Verifica errores si algo falla.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $mensaje = $_POST['mensaje'];

    // Dirección de correo destino
    $destinatario = "est.juliana.bonillac@unimilitar.edu.co"; 
    $asunto = "Prueba de formulario de contacto";
    
    // Crear el cuerpo del mensaje
    $cuerpo = "Nombre: $nombre\n";
    $cuerpo .= "Email: $email\n";
    $cuerpo .= "Teléfono: $telefono\n";
    $cuerpo .= "Mensaje: $mensaje\n";
    
    // Enviar el correo
    if (mail($destinatario, $asunto, $cuerpo)) {
        echo "¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.";
    } else {
        echo "Hubo un problema al enviar el mensaje.";
    }
}
?>