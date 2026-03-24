<?php
require 'configdb.php';
function conectar()
{
    $db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
    if ($db->connect_error) {
        die("Error de conexión: " . $db->connect_error);
    }
    return $db;
}
function insertar()
{
    // pendiente de desarrollo en clase
}