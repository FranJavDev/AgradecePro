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

$username = $_POST["username"];
$password = $_POST["password"];

// Login NO SEGURO (vulnerable a inyección SQL)
$sql = "SELECT id, nombre FROM prueba_alumno
WHERE username='" . $username . "'
AND passwd='" . $password . "'";

$result = $db->query($sql);

if ($result && $result->num_rows > 0) {
    $fila = $result->fetch_array();
    $_SESSION['id_usuario'] = $fila['id'];
    $_SESSION['nombre_usuario'] = $fila['nombre'];
    header("Location: ../bienvenida.php");
    exit();
}
else {
    header("Location: ../login_error.html");
    exit();
}

?>