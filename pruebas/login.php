<?php
session_start();
require 'pruebas/configdb.php';
function conectar()
{
    $db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    $db->set_charset('utf8');
    return $db;
}




$username = $_POST["username"];
$password = $_POST["password"];

$sql = "SELECT idALumno FROM alumno
WHERE username='" . $username . "'
AND password='" . $password . "'";




$result = $db->query($sql);
if ($result->num_rows > 0) {
    $fila = $result->fetch_array();
}

?>