<?php
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

function mostrar_datos()
{
    $db = conectar();
    $sql = 'SELECT * from alumnos';
    $resultado = $db->query($sql);
    while ($fila = $resultado->fetch_array()) {
        echo 'Nombre alumno: ' . $fila['nombre'] . '<br>';

        // falta poner nombre e ID, en este orden [ID][NOMBRE]
    }
    $db->close();
}
mostrar_datos();
