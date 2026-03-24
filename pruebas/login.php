<?php
session_start();
require 'configdb.php';

function conectar()
{
    $db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    $db->set_charset('utf8');
    return $db;
}

$db = conectar();

$nickname = $_POST["nickname"] ?? '';
$password = $_POST["password"] ?? '';

// Login con texto plano e inyección evitada con statements
$sql = "SELECT id, nombre_completo FROM alumnos WHERE nickname = ? AND password = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("ss", $nickname, $password);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $fila = $result->fetch_assoc();
    
    $_SESSION['id_usuario'] = $fila['id'];
    $_SESSION['nombre_usuario'] = $fila['nombre_completo'];
    header("Location: ../bienvenida.php");
    exit();
} else {
    header("Location: ../login_error.html");
    exit();
}
$stmt->close();
$db->close();
?>