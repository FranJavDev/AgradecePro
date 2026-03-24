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

// Obtener datos del alumno logueado
$sql = "SELECT id, nombre_completo, nickname, nombre_jesuita, imagen_jesuita, frase_jesuita, webalumno FROM alumnos WHERE id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $id_usuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result && $result->num_rows > 0) {
    $datos = $result->fetch_assoc();
} else {
    die("Error: No se pudieron recuperar los datos del usuario.");
}
$stmt->close();

// Obtener los agradecimientos recibidos, pero mostrando el jesuita del emisor
$sql_agradecimientos = "
    SELECT a.mensaje, a.fecha, e.nombre_jesuita, e.imagen_jesuita, e.frase_jesuita
    FROM agradecimientos a
    JOIN alumnos e ON a.idAlumnoEnvia = e.id
    WHERE a.idAlumnoRecibe = ?
    ORDER BY a.fecha DESC
";
$stmt_agr = $db->prepare($sql_agradecimientos);
$stmt_agr->bind_param("i", $id_usuario);
$stmt_agr->execute();
$res_agr = $stmt_agr->get_result();

$agradecimientos = [];
while ($row = $res_agr->fetch_assoc()) {
    $agradecimientos[] = $row;
}
$stmt_agr->close();
$db->close();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido - <?php echo htmlspecialchars($datos['nombre_completo']); ?></title>
    <link rel="stylesheet" href="estilobuenov2_experimental.css">
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
        .tablon-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 20px;
            margin-top: 20px;
        }
        .mensaje-card {
            background-color: rgba(15, 23, 42, 0.6);
            border: 1px solid var(--border-color);
            border-radius: 12px;
            padding: 20px;
            text-align: left;
        }
        .jesuita-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding-bottom: 10px;
        }
        .jesuita-img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
            background-color: #334155;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 0.8rem;
            overflow: hidden;
        }
        .jesuita-info h4 {
            color: #8b5cf6;
            margin: 0 0 5px 0;
            font-size: 1.1rem;
        }
        .jesuita-info p {
            color: #94a3b8;
            margin: 0;
            font-size: 0.85rem;
            font-style: italic;
        }
        .mensaje-body {
            color: #f8fafc;
            line-height: 1.5;
            font-size: 1rem;
        }
        .mensaje-fecha {
            margin-top: 15px;
            font-size: 0.75rem;
            color: #64748b;
            text-align: right;
        }
    </style>
</head>

<body>
    <nav class="navbar">
        <div class="nav-links">
            <a href="bienvenida.php" class="nav-btn active">INICIO / TABLÓN</a>
            <a href="agradecer.php" class="nav-btn outline">AGRADECER</a>
            <a href="perfil.php" class="nav-btn outline">MI PERFIL</a>
        </div>
        <a href="logout.php" class="nav-btn login-btn">CERRAR SESIÓN</a>
    </nav>

    <main class="container">
        <!-- Tarjeta de Perfil Personal (Reducida y adaptada) -->
        <div class="thank-you-card" style="max-width: 800px; margin-bottom: 30px; padding: 2rem;">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div style="text-align: left;">
                    <h2 style="color: #4ade80; margin-bottom: 5px;">¡Bienvenido, <?php echo htmlspecialchars($datos['nombre_completo']); ?>!</h2>
                    <p style="color: #94a3b8; font-size: 0.9rem;">Tu Jesuita: <strong style="color: #fff;"><?php echo htmlspecialchars($datos['nombre_jesuita']); ?></strong></p>
                </div>
                <div>
                    <a href="perfil.php" style="text-decoration: none;">
                        <button type="button" class="submit-btn" style="padding: 0.6rem 1.2rem; margin-top:0; font-size: 0.9rem;">Editar Perfil</button>
                    </a>
                </div>
            </div>
        </div>

        <!-- Tarjeta del Tablón de Agradecimientos -->
        <div class="thank-you-card" style="max-width: 800px; padding: 2rem 3rem;">
            <h2 style="color: #fff; border-bottom: 2px solid #334155; padding-bottom: 10px; margin-bottom: 20px;">Tablón de Agradecimientos Recibidos</h2>
            
            <?php if (empty($agradecimientos)): ?>
                <div style="text-align: center; padding: 40px 20px;">
                    <p style="color: #94a3b8; font-size: 1.1rem;">Aún no tienes agradecimientos.</p>
                    <p style="color: #64748b; font-size: 0.9rem; margin-top: 10px;">¡Anímate a enviar uno a tus compañeros!</p>
                </div>
            <?php else: ?>
                <div class="tablon-grid">
                    <?php foreach ($agradecimientos as $agr): ?>
                        <div class="mensaje-card">
                            <div class="jesuita-header">
                                <div class="jesuita-img">
                                    <?php 
                                    $img = $agr['imagen_jesuita'];
                                    if(!empty($img) && $img !== 'default_jesuita.png') {
                                        echo '<img src="imgJesuitas/' . htmlspecialchars($img) . '" alt="" style="width:100%; height:100%; object-fit:cover;" onerror="this.style.display=\'none\'">';
                                    } else {
                                        echo 'IMAGEN';
                                    }
                                    ?>
                                </div>
                                <div class="jesuita-info">
                                    <h4><?php echo htmlspecialchars($agr['nombre_jesuita']); ?></h4>
                                    <p>"<?php echo htmlspecialchars($agr['frase_jesuita']); ?>"</p>
                                </div>
                            </div>
                            <div class="mensaje-body">
                                <?php echo nl2br(htmlspecialchars($agr['mensaje'])); ?>
                            </div>
                            <div class="mensaje-fecha">
                                Enviado el <?php echo date('d/m/Y H:i', strtotime($agr['fecha'])); ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </main>
</body>

</html>
