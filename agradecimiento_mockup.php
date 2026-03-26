<?php
session_start();

// Mock data predeclared
$nombreJesuita = "Jose Jesuita";
$fraseJesuita = "En todo amar y servir";
$fotoJesuita = 'https://ui-avatars.com/api/?name=Jose+Jesuita&background=8b5cf6&color=fff&size=200&font-size=0.4'; // Placeholder profile
$mensajeAgradecimiento = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Esto es una prueba 123 456 que locura estoy escribiendo un ejemplo";

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agradecimiento - Mockup</title>
    <link rel="stylesheet" href="estilobuenov2_experimental.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Caveat:wght@500;600&display=swap" rel="stylesheet">
</head>

<body>

    <main class="container">
        <div class="thank-you-card wide-card">
            <h2 class="mockup-title animate-fade-in-up delay-150">AGRADECIMIENTO</h2>
            
            <div class="mockup-card">
                <div class="mockup-left animate-fade-in-up delay-300">
                    <div class="jesuit-photo-wrapper">
                        <img src="<?php echo htmlspecialchars($fotoJesuita); ?>" alt="Foto Jesuita" class="jesuit-photo">
                    </div>
                    <div class="jesuit-name-label animate-fade-in-up delay-450"><?php echo htmlspecialchars($nombreJesuita); ?></div>
                    <div class="jesuit-phrase animate-fade-in-up delay-600"><?php echo htmlspecialchars($fraseJesuita); ?></div>
                </div>
                
                <div class="mockup-right animate-fade-in-up delay-750">
                    <div class="thank-you-text">
                        <?php echo nl2br(htmlspecialchars($mensajeAgradecimiento)); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>

</html>
