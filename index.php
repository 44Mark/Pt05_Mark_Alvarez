<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('./Model/connexio.php'); 
require('./Model/llibres.php');
require('./Model/usuari.php');
require('./Controlador/timeout.php');

// Si la sessió correu està definida, significa que l'usuari està autenticat
if (isset($_SESSION['correu'])) {
    $_SESSION['usuari_autenticat'] = true;
} else {
    $_SESSION['usuari_autenticat'] = false;
}

// Navbar
include('./Vista/header/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Artículos</title>
</head>
<body>
<div class="contenedor-central">
    <h1>Descobreix i comparteix els teus llibres preferits</h1>
    
    <?php include('./Vista/num_Articles/desplegable.php'); ?>

    <?php include('./Vista/articles/articles.php'); ?>

    <?php include_once('./Vista/paginacio/paginacio.php'); ?>

    <?php if (isset($_SESSION['message'])) {
        $missatge = $_SESSION['message'];
        echo "<p class='missatge'>$missatge</p>";
        unset($_SESSION['message']); 
    } ?>
</div>
</body>
</html>