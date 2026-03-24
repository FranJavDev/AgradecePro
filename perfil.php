<?php
session_start();
require 'pruebas/configdb.php';

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

$sql = "SELECT nombre_jesuita, imagen_jesuita, frase_jesuita, webalumno FROM alumnos WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $datos = $result->fetch_assoc();
} else {
    die("Error: No se pudieron recuperar los datos del perfil.");
}
$stmt->close();
$db->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Perfil Jesuita</title>
    <link rel="stylesheet" href="estilobuenov2_experimental.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="bienvenida.php" class="nav-btn outline">INICIO / TABLÓN</a>
            <a href="agradecer.php" class="nav-btn outline">AGRADECER</a>
            <a href="perfil.php" class="nav-btn active">MI PERFIL</a>
        </div>
        <a href="logout.php" class="nav-btn login-btn">CERRAR SESIÓN</a>
    </nav>

    <main class="container">
        <div class="thank-you-card" style="max-width: 600px;">
            <h2>EDITAR PERFIL JESUITA</h2>

            <?php
            if (isset($_SESSION['mensaje_perfil'])) {
                echo '<div style="background-color: rgba(74, 222, 128, 0.2); border: 1px solid #4ade80; color: #4ade80; padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center;">' . $_SESSION['mensaje_perfil'] . '</div>';
                unset($_SESSION['mensaje_perfil']);
            }
            if (isset($_SESSION['error_perfil'])) {
                echo '<div style="background-color: rgba(239, 68, 68, 0.2); border: 1px solid #ef4444; color: #ef4444; padding: 10px; border-radius: 8px; margin-bottom: 20px; text-align: center;">' . $_SESSION['error_perfil'] . '</div>';
                unset($_SESSION['error_perfil']);
            }
            ?>

            <form action="pruebas/update_profile.php" method="POST" class="thank-you-form">
                <div class="form-group">
                    <label for="nombre_jesuita" class="tracking-label">NOMBRE DEL JESUITA</label>
                    <input type="text" name="nombre_jesuita" id="nombre_jesuita" class="custom-input" 
                           value="<?php echo htmlspecialchars($datos['nombre_jesuita']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="imagen_jesuita" class="tracking-label">ENLACE / ARCHIVO DE IMAGEN</label>
                    <input type="text" name="imagen_jesuita" id="imagen_jesuita" class="custom-input" 
                           value="<?php echo htmlspecialchars($datos['imagen_jesuita']); ?>" placeholder="ej: miprimerjesuita.jpg o url web">
                </div>

                <div class="form-group">
                    <label for="frase_jesuita" class="tracking-label">FRASE IDENTIFICATIVA</label>
                    <textarea name="frase_jesuita" id="frase_jesuita" class="custom-textarea" rows="3" required><?php echo htmlspecialchars($datos['frase_jesuita']); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="webalumno" class="tracking-label">TU WEB / PORTFOLIO (Opcional)</label>
                    <input type="text" name="webalumno" id="webalumno" class="custom-input" 
                           value="<?php echo htmlspecialchars($datos['webalumno']); ?>">
                </div>

                <button type="submit" class="submit-btn" style="margin-top: 1.5rem;">GUARDAR CAMBIOS</button>
            </form>
            
            <div style="text-align: center; margin-top: 20px;">
                <a href="bienvenida.php" style="color: var(--text-secondary); text-decoration: none; font-size: 0.9rem;">← Volver al Tablón</a>
            </div>
        </div>
    </main>
</body>

</html>
