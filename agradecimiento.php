<?php
include 'backend/configdb.php';
$_GET["id"] = 2; // en este caso es un ejemplo de ID 2 para hacer las pruebas


// Obtiene el mensaje de agradecimiento, el emisor y el receptor del mensaje
$sql = "select mensaje, idEmisor, idReceptor from agradecimientos
      where idAgradecimiento=" . $_GET["id"] . ";";
$resultado = $conexion->query($sql);
$fila = $resultado->fetch_array();

$mensaje = $fila["mensaje"];
$emisor = $fila["idEmisor"];
$receptor = $fila["idReceptor"];



//Obtiene el nombre del jesuita y su información de la tabla alumnos.
$sql = "select nombreJesuita, infoJesuita from alumnos
      where equipo=" . $emisor;
$resultado = $conexion->query($sql);
$fila = $resultado->fetch_array();


$jesuita = $fila["nombreJesuita"];
$infoJesuita = $fila["infoJesuita"];



//Obtiene el nombre alumno al que se le agradece de la tabla alumnos.
$sql = "select nombre from alumnos
      where equipo=" . $receptor;
$resultado = $conexion->query($sql);
$fila = $resultado->fetch_array();

$receptor = $fila["nombre"];

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimiento - Mockup</title>
    <link rel="stylesheet" href="components/estilobuenov2_experimental.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Caveat:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>

    <main class="container">
        <div class="thank-you-card wide-card">
            <h2 class="mockup-title animate-fade-in-up delay-150">AGRADECIMIENTO</h2>
            
            <div class="mockup-card">
                <div class="mockup-left animate-fade-in-up delay-300">
                    <div class="jesuit-photo-wrapper">
                        <!-- La funcion HTMLSPECIALCHARS la explico en bienvenida.php
                         SE QUE NO SE HA DADO EN CLASE, pero es una buena practica -->
                        <img src="<?php echo htmlspecialchars($fotoJesuita); ?>" alt="Foto Jesuita" class="jesuit-photo">
                    </div>
                    <div class="jesuit-name-label animate-fade-in-up delay-450"><?php echo htmlspecialchars($jesuita); ?></div>
                    <div class="jesuit-phrase animate-fade-in-up delay-600"><?php echo htmlspecialchars($infoJesuita); ?></div>
                </div>
                
                <div class="mockup-right animate-fade-in-up delay-750">
                    <div class="to-colleague-badge">
                        <span class="badge-icon">@</span>
                        Para: <?php echo htmlspecialchars($receptor); ?>
                    </div>
                    <div class="thank-you-text">
                        <?php echo nl2br(htmlspecialchars($mensaje)); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>


</html>
