<?php
session_start();
require 'backend/configdb.php';

if (!isset($_SESSION['id_usuario'])) {
    header("Location: login.html");
    exit();
}

$id_usuario = $_SESSION['id_usuario'];

$db = new mysqli(SERVIDOR, USUARIO, PASSWORD, BBDD);
if ($db->connect_error) {
    die("Error de conexión: " . $db->connect_error);
}
$db->set_charset('utf8');

$sql = "SELECT id, nombre, username, nombreJesuita, img, frase, webAlumno FROM prueba_alumno WHERE id = " . $id_usuario;
$result = $db->query($sql);

if ($result && $result->num_rows > 0) {
    $datos = $result->fetch_assoc();
}
else {
    die("Error: No se pudieron recuperar los datos del usuario.");
}
$db->close();
?>

// ACLARACION!!!! Esto es una prueba de devolver datos, me he adelantado un poco, es un testeo, SOLO ES UN TESTEO


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - <?php echo htmlspecialchars($datos['nombre']); ?></title>
    <link rel="stylesheet" href="components/estilobuenov2_experimental.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        .user-data-list {
            list-style: none;
            padding: 0;
            margin: 20px 0;
            text-align: left;
            color: #cbd5e1;
            font-size: 1.05rem;
        }
        .user-data-list li {
            margin-bottom: 12px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .user-data-list li strong {
            color: #fff;
            display: inline-block;
            width: 170px;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="index.php" class="nav-btn outline">INICIO</a>
            <a href="agradecer.php" class="nav-btn outline">AGRADECER</a>
        </div>
        <a href="logout.php" class="nav-btn login-btn">CERRAR SESIÓN</a>
    </nav>

    <main class="container">
        <div class="thank-you-card" style="max-width: 600px; text-align: left;">
            <h2 style="color: #4ade80; text-align: center; margin-bottom: 10px;">¡Bienvenido, <?php echo htmlspecialchars($datos['nombre']); ?>!</h2>
            
            <div style="text-align: center; margin: 20px 0;">
                <p style="font-size: 1.2rem; font-style: italic; color: #94a3b8; padding: 0 20px;">
                    "<?php echo htmlspecialchars($datos['frase']); ?>"
                </p>
            </div>

            <h3 style="color: #fff; margin-top: 30px; border-bottom: 2px solid #334155; padding-bottom: 10px;">Tus Datos Estudiantiles</h3>
            <ul class="user-data-list">

                <!-- La funcion htmlspecialchars() convierte caracteres especiales en entidades HTML
                 Ciertos caracteres tienen un significado especial en HTML
                 y deben ser representados por entidades HTML si se desea preservar su significado.
                 Esta función devuelve un string con estas conversiones realizadas.
                 
                 LO DEJO COMO ACLARACION PUES NO SE HA VISTO EN CLASE-->
                <li><strong>Puesto (ID):</strong> <?php echo htmlspecialchars($datos['id']); ?></li>
                <li><strong>Usuario:</strong> <?php echo htmlspecialchars($datos['username']); ?></li>
                <li><strong>Referencia Jesuita:</strong> <?php echo htmlspecialchars($datos['nombreJesuita']); ?></li>
                <li><strong>Web del Alumno:</strong> <?php echo htmlspecialchars($datos['webAlumno']); ?></li>
            </ul>

            <div style="text-align: center; margin-top: 30px;">
                <a href="index.html" style="text-decoration: none;">
                    <button type="button" class="submit-btn" style="background-color: #3b82f6;">Ir a Inicio</button>
                </a>
            </div>
        </div>
    </main>
</body>

</html>
