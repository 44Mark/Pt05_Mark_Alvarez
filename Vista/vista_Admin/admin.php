<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require("../../Controlador/llistatAdmin.php");
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administración de Usuarios</title>
    <link rel="stylesheet" href="../../Vista/estils.css">
</head>
<body>
    <h1 class = "fons">Llistat d'Usuaris</h1>
    <div class="usuarios">
        <?php foreach ($usuaris as $usuari): ?>
            <div class="usuario">
                <p><strong>Nombre:</strong> <?php echo htmlspecialchars($usuari['nom']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($usuari['correu']); ?></p>
                <a href="Controlador/eliminarUsuari.php?correu=<?php echo $usuari['correu']; ?>" class="botoneliminar">
                    <img src="../../Vista/assets/images-work/eliminar.png" alt="Eliminar" style="width: 20px; height: 20px;">
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>