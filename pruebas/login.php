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
    // ESTA COMPROBACION ES LA CORRECTA PARA EVITAR CRASHES EN PHP
    // AUNQUE NO SE HAYA DADO EN CLASE
    // explicación:
    // Si solo se pone $result->num_rows > 0 y $result es NULL PHP CRASHEA
    // De lo contrario, si se pone $result en un AND, en caso de que la consulta SQL
    // no funcionase correctamente, seria false y ya nisiquiera llega a comprobar el num_rows
    // No se puede llamar a num_rows si $result es NULL
    $fila = $result->fetch_array();
    $_SESSION['id_usuario'] = $fila['id'];
    $_SESSION['nombre_usuario'] = $fila['nombre'];
    header("Location: ../bienvenida.php");
    exit();
} else {
    header("Location: ../login_error.html");
    exit();
}

?>