<?php
// Controlador creat per eliminar els llibres per l'ISBN
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../Model/llibres.php');

// Comprovem si hi ha un id per cridar a la funció eliminarLlibre
if (empty($_GET['isbn'])) {
    $_SESSION['message'] = 'No hi ha cap llibre per eliminar';
    return;
} else {
    eliminarLlibre($_GET['isbn']);

    $_SESSION['message'] = 'Llibre eliminat correctament';
    header('Location: ../inici');
    exit();
}
?>