<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../Model/llibres.php');

// Comprovem si hi ha un ISBN
if (empty($_GET['isbn'])) {
    $_SESSION['message'] = 'No hi ha cap llibre per modificar';
    header('Location: ../Vista/index.php');
    exit(); 
} else {
    // Obtenim el llibre de la base de dades
    $isbn = $_GET['isbn'];
    $llibre = obtenirLlibre($isbn);
    
    // Guardem els valors del llibre a la sessió
    $_SESSION['isbn'] = $llibre['isbn'];
    $_SESSION['titol'] = $llibre['titol'];
    $_SESSION['cos'] = $llibre['cos'];

    // Redirigim a la vista de modificació amb les dades del llibre
    header('Location: ../modificar');
    exit();
}
?>
