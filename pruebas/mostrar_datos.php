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
    $total_filas = $resultado->num_rows;
    $fila = $resultado->fetch_array();
    while ($fila) {
        echo '<option value="' . $fila["ID"] . '">' . $fila["nombre"] . '</option>';
        $fila = $resultado->fetch_array();
    }
    $db->close();
    return $total_filas;
}
?>