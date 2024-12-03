<?php
// Controlador per eliminar un usuari pel correu
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require('../Model/usuari.php');

// Comprovem si hi ha un id per cridar a la funció eliminarLlibre
if (empty($_GET['correu'])) {
    $_SESSION['message'] = 'No hi ha cap usuari per eliminar';
    return;
} else {
    eliminarUsuari($_GET['correu']);

    $_SESSION['message'] = 'Usuari eliminat correctament';
    header('Location: ../inici');
    exit();
}
?>