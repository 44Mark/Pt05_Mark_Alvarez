<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('./Model/connexio.php'); 
require('./Model/llibres.php');
require('./Model/usuari.php');
unset($_SESSION['tot']); 
require('./Controlador/controlPaginacio.php');
require('./Controlador/timeout.php');

// Si la sessió correu està definida, significa que l'usuari està autenticat
if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
} else {
    $_SESSION['usuari_autenticat'] = false;
}

// Navbar
include('./Vista/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Artículos</title>
</head>
<body>
<div class="contenedor-central">
    <h1>Descobreix i comparteix els teus llibres preferits</h1>
    <div>
        <table class="tablaUsuarios">
            <thead>
                <tr>
                    <th>ISBN</th>
                    <th>Títol</th>
                    <th>Contingut</th>
                    <?php // Si l'usuari està autenticat, apareixeran els botons per modificar i eliminar els articles ?>
                    <?php if ($_SESSION['usuari_autenticat']): ?>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articlesToShow as $art): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($art['isbn']); ?></td>
                        <td><?php echo htmlspecialchars($art['titol']); ?></td>
                        <td><?php echo htmlspecialchars($art['cos']); ?></td>
                        <?php if ($_SESSION['usuari_autenticat']): ?>
                            <td><a href="Controlador/comprovmodificarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex">Modificar</a></td>
                            <td><a href="Controlador/eliminarLlibre.php?isbn=<?php echo $art['isbn']; ?>" class="botonindex" onclick="return confirm('Estàs segur que vols eliminar aquest llibre?');">Eliminar</a></td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php include_once('./Vista/paginacio.php'); ?>

        <?php // Si hi ha un missatge, el mostrem ?>
        <?php if (isset($_SESSION['message'])) {
            $missatge = $_SESSION['message'];
            echo "<p class='missatge'>$missatge</p>";
            unset($_SESSION['message']); 
        } ?>
    </div>
    </div>
</body>
</html>
