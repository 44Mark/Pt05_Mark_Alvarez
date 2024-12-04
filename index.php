<?php
//L'index es la vista principal de la pàgina web, on es mostren els llibres i es poden fer cerques, ordenar-los i filtrar-los. Tot aixó de forma
// modular cridant a altres vista fent un include de les mateixes.

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once('./Model/connexio.php'); 
require('./Model/llibres.php');

// Comprovacions d'usuaris
include('./Controlador/comprovacionsUsers.php');
include('./Vista/header/header.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Artículos</title>
    <link rel="stylesheet" href="./Vista/estils.css">
</head>
<body>
<div class="contenedor-central">
    <h1>Descobreix i comparteix els teus llibres preferits</h1>
    
    <div class="contenidor-botons">
        <?php include('./Vista/ordenacio_Articles/ordenacio.php'); ?>

        <?php include('./Vista/barra_Busqueda/barra.php'); ?>

        <?php include('./Vista/desplegable_Articles/desplegable.php'); ?>
    </div>
    
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