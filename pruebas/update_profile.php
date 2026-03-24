<?php
session_start();
require 'configdb.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: ../login.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_usuario = $_SESSION['id_usuario'];
    $nombre_jesuita = $_POST['nombre_jesuita'] ?? '';
    $imagen_jesuita = $_POST['imagen_jesuita'] ?? '';
    $frase_jesuita = $_POST['frase_jesuita'] ?? '';
    $webalumno = $_POST['webalumno'] ?? '';

    // Validacion basica
    if (empty($nombre_jesuita) || empty($frase_jesuita)) {
        $_SESSION['error_perfil'] = "El nombre del jesuita y la frase son obligatorios.";
        header("Location: ../perfil.php");
        exit();
    }

    $db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    $db->set_charset('utf8');

    $sql = "UPDATE alumnos SET nombre_jesuita = ?, imagen_jesuita = ?, frase_jesuita = ?, webalumno = ? WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param("ssssi", $nombre_jesuita, $imagen_jesuita, $frase_jesuita, $webalumno, $id_usuario);

    if ($stmt->execute()) {
        $_SESSION['mensaje_perfil'] = "Perfil actualizado correctamente.";
    } else {
        $_SESSION['error_perfil'] = "Error al actualizar el perfil o URL web ya en uso.";
    }

    $stmt->close();
    $db->close();

    header("Location: ../perfil.php");
    exit();
} else {
    header("Location: ../perfil.php");
    exit();
}
?>