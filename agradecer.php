<?php
session_start();
if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

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
    $id_usuario = $_SESSION['id_usuario'];
    
    $sql = 'SELECT id, nombre_completo from alumnos WHERE id != ?';
    $stmt = $db->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    while ($fila = $resultado->fetch_assoc()) {
        echo '<option value="' . $fila["id"] . '">' . htmlspecialchars($fila["nombre_completo"]) . '</option>';
    }
    $stmt->close();
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
            <a href="bienvenida.php" class="nav-btn outline">INICIO / TABLÓN</a>
            <a href="agradecer.php" class="nav-btn active">AGRADECER</a>
            <a href="perfil.php" class="nav-btn outline">MI PERFIL</a>
        </div>
        <a href="logout.php" class="nav-btn login-btn">CERRAR SESIÓN</a>
    </nav>

    <main class="container">
        <div class="thank-you-card">
            <h2>QUIERO AGRADECER A...</h2>

            <?php
            if (isset($_SESSION['mensaje_agradecer'])) {
                echo '<div style="background-color: rgba(74, 222, 128, 0.2); border: 1px solid #4ade80; color: #4ade80; padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center;">' . $_SESSION['mensaje_agradecer'] . '</div>';
                unset($_SESSION['mensaje_agradecer']);
            }
            if (isset($_SESSION['error_agradecer'])) {
                echo '<div style="background-color: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #ef4444; padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center;">' . $_SESSION['error_agradecer'] . '</div>';
                unset($_SESSION['error_agradecer']);
            }
            ?>

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