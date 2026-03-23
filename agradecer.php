<?php
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

function mostrar_datos()
{
    $db = conectar();
    $sql = 'SELECT * from alumnos';
    $resultado = $db->query($sql);
    $fila = $resultado->fetch_array();
    while ($fila) {
        echo '<option value="' . $fila["id"] . '">' . $fila["nombre"] . '</option>';
        $fila = $resultado->fetch_array();
    }
    $db->close();
}
?>



<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimientos</title>
    <link rel="stylesheet" href="estilobuenov2_experimental.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="index.html" class="nav-btn outline">INICIO</a>
            <a href="agradecimientos.html" class="nav-btn outline">AGRADECIMIENTOS</a>
            <a href="agradecer.html" class="nav-btn active">AGRADECER</a>
        </div>
        <a href="login.html" class="nav-btn login-btn">LOGIN</a>
    </nav>

    <main class="container">
        <div class="thank-you-card">
            <h2>Quiero agradecer a</h2>

            <form action="process.php" method="POST" class="thank-you-form">
                <div class="form-group">
                    <div class="custom-select-wrapper">
                        <select name="person" id="person" class="custom-select">
                            <option value="" disabled selected hidden>Selecciona una opción (ej: PEPITO)</option>
                            <?php
                            mostrar_datos();
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="message" class="tracking-label">AGRADECIMIENTO</label>
                    <textarea name="message" id="message" class="custom-textarea" rows="4"
                        placeholder="Escribe tu mensaje aquí..."></textarea>
                </div>

                <button type="submit" class="submit-btn">Enviar Agradecimiento</button>
            </form>
        </div>
    </main>
</body>

</html>