<?php
/**
 * process.php
 * Archivo PHP básico preparado para procesar el formulario de agradecimientos.
 * Actualmente no hace nada complejo.
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Aquí es donde en el futuro se capturará los datos del formulario:
    // $person = isset($_POST['person']) ? htmlspecialchars($_POST['person']) : '';
    // $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
    
    // Y luego los guardarías en una base de datos o enviarías un email.
    
    // Por ahora, solo indicamos que el procesamiento fue exitoso enviando un JSON,
    // o podríamos redirigir de vuelta.
    
    header('Content-Type: application/json');
    echo json_encode([
        'status' => 'success',
        'message' => '¡Gracias! El formulario HTML se ha comunicado exitosamente con este script PHP (Simulación).'
    ]);
    exit;
} else {
    // Si el usuario accede a /process.php directamente a través del navegador sin enviar el formulario (petición GET)
    echo "<!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <title>Procesamiento</title>
        <style>
            body { font-family: sans-serif; background-color: #0f172a; color: white; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
            .msg { background: #1e293b; padding: 2rem; border-radius: 1rem; border: 1px solid #334155; }
        </style>
    </head>
    <body>
        <div class='msg'>
            <h2>Endpoint PHP</h2>
            <p>Este archivo está listo para procesar datos. Por favor, envía información a través del formulario.</p>
            <a href='index.html' style='color: #8b5cf6;'>Volver al inicio</a>
        </div>
    </body>
    </html>";
}
?>
