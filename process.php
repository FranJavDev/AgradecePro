<?php
session_start();
require 'pruebas/configdb.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $person = $_POST['person'] ?? null;
    $message = $_POST['message'] ?? '';

    if (!$person || empty($message)) {
        $_SESSION['error_agradecer'] = "Debes seleccionar a un alumno y escribir un mensaje.";
        header("Location: agradecer.php");
        exit();
    }

    if ($person == $id_usuario) {
        $_SESSION['error_agradecer'] = "No puedes enviarte un agradecimiento a ti mismo.";
        header("Location: agradecer.php");
        exit();
    }

    $db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    $db->set_charset('utf8');

    // Comprobar si ya le ha enviado uno
    $check_sql = "SELECT idagradecimiento FROM agradecimientos WHERE idAlumnoEnvia = ? AND idAlumnoRecibe = ?";
    $stmt_check = $db->prepare($check_sql);
    $stmt_check->bind_param("ii", $id_usuario, $person);
    $stmt_check->execute();
    $res_check = $stmt_check->get_result();

    if ($res_check && $res_check->num_rows > 0) {
        $_SESSION['error_agradecer'] = "Ya has enviado un agradecimiento a este alumno. Solo puedes enviar uno.";
        $stmt_check->close();
        $db->close();
        header("Location: agradecer.php");
        exit();
    }
    $stmt_check->close();

    $insert_sql = "INSERT INTO agradecimientos (mensaje, idAlumnoEnvia, idAlumnoRecibe) VALUES (?, ?, ?)";
    $stmt_insert = $db->prepare($insert_sql);
    $stmt_insert->bind_param("sii", $message, $id_usuario, $person);
    
    if ($stmt_insert->execute()) {
        $_SESSION['mensaje_agradecer'] = "¡Agradecimiento enviado con éxito!";
    } else {
        $_SESSION['error_agradecer'] = "Ha ocurrido un error al enviar el agradecimiento.";
    }

    $stmt_insert->close();
    $db->close();

    header("Location: agradecer.php");
    exit();
} else {
    header("Location: agradecer.php");
    exit();
}
?>
